<?php

namespace App\Http\Controllers;

use App\GraphData;
use App\Matrix;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PIESystemController;
use App\Http\Controllers\EarningController;
use App\Http\Controllers\MatrixThriftController;
use App\Http\Controllers\TransactionLogger;
use App\Helpers;
use App\Mail\CycleCompleted;
use App\Mail\QuorumShift;
use App\Mail\ReferralBonus;
use App\Mail\ShortTermThriftCompleted;
use App\MatrixIncentive;
use App\MatrixTransaction;
use App\PIETransaction;
use Illuminate\Support\Facades\Mail;

class QuorumController extends Controller
{
    private $graph;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->graph = new GraphData();
        if (!$this->graph->isConnected()) {
            dd("DB is not running or connection cannot be made.");
        }
    }

    public function autoShift()
    {
        set_time_limit(0);
        $users = User::all();

        foreach ($users as $user) {
            $this->initiateQuorumShift($user->pin_unique_value);
        }
    }

    public function userMTShift()
    {
        set_time_limit(0);
        $user = Auth::user();
        $users = User::where(['is_matrix_thrift' => $user->id, 'is_thrift_completed' => 0])->get();

        foreach ($users as $user) {
            $this->initiateQuorumShift($user->pin_unique_value);
        }
    }

    // public function monoUserMTShift($user_id)
    // {
    //     set_time_limit(0);
    //     $user = User::where(['id' => $user_id, 'is_thrift_completed' => 0])->firstOrFail();
    //     $this->doShortTermThrift($user);
    // }



    /**
     *
     */
    public function initiateQuorumShift($user_id = null)
    {
        set_time_limit(0);
        // Check if URL has a parameter. If User ID provided, then use that ID
        if ($user_id == null) {
            $user = Auth::user();
        } else {
            $user = User::where('pin_unique_value', $user_id)->firstOrFail();
        }

        self::doQuorumShift_0($user);
        self::doQuorumShift_1($user);
        self::doQuorumShift_2($user);
        self::doQuorumShift_3($user);
        self::doQuorumShift_4($user);
        self::handleQuorum_5($user);
    }

    /**
     * Moves user from Q0 to Q1
     * @param $user User model instance
     */
    public function doShortTermThrift($user)
    {
        set_time_limit(0);
        // STT has a life span of 90 days
        // if STT cycles before 30 days user gets #1000 else #user gets 200

        $date_created = $user->created_at->format('Y-m-d');

        $datediff = time() - (int) strtotime($date_created);

        $days = (int) round($datediff / (60 * 60 * 24));

        if ($days == 30) {
            if ($this->isSTTCompleted($user)) {
                $this->handleSTT($user, $days);
                dump("User: " . $user->id . " STT completed");
            }else{
                dump("User: " . $user->id . " STT not completed");
            }
        } elseif ($days == 90) {
            $this->handleSTT($user, $days);
            dump("90 days completed");
        } else {
            dump("User: " . $user->id . " not qualified. Current days: " . $days);
        }
    }

    private function handleSTT($user, $days)
    {
        // The next matrix user will be shifted to
        $next_matrix = 1;
        $current_matrix = 0;

        // Move User to Quorum 1
        // Update User Current Matrix
        $this->graph->updateCurrentMatrix($user->pin_unique_value, $next_matrix);
        User::where('id', $user->id)->update(['current_matrix' => $next_matrix]);

        // Update User Matrix
        Matrix::updateUserMatrix($user->id, $next_matrix);

        // Handle Earnings
        $earning = new EarningController();
        $earning->doSTTEarnings($user, $days);

        // If User is Matrix Thrift, Transfer Earning to Owner and disable account
        $matrix_thrift = new MatrixThriftController();
        $matrix_thrift->transferMatrixThriftEarningToOwner($user);
        $matrix_thrift->disableMatrixThrift($user);

        // Send Mail: Short Term Thrift Completed
        // $content = [$user, $next_matrix, $current_matrix];
        // Mail::to($user)->send(new ShortTermThriftCompleted($content));
    }

    private function isSTTCompleted($user)
    {
        // Base: 9
        $result = $this->graph->countOfUsersByLevel($user->pin_unique_value, 2);

        $no_of_users = $result->value('no_of_users');

        // Base: 9
        if ((int) $no_of_users == 9)
            return true;
        else
            false;
    }

    /**
     * Moves user from Q0 to Q1
     * @param $user User model instance
     */
    private function doQuorumShift_0($user)
    {
        // The next matrix user will be shifted to
        $next_matrix = 1;
        $current_matrix = 0;

        // Is user in Q0
        if ($user->current_matrix == $current_matrix) {

            // Base: 9
            $result = $this->graph->countOfUsersByLevel($user->pin_unique_value, 2);

            $no_of_users = $result->value('no_of_users');

            // Base: 9
            if ((int) $no_of_users == 9) {

                // Move User to Quorum 1
                // Update User Current Matrix
                $this->graph->updateCurrentMatrix($user->pin_unique_value, $next_matrix);
                User::where('id', $user->id)->update(['current_matrix' => $next_matrix]);

                // Update User Matrix
                Matrix::updateUserMatrix($user->id, $next_matrix);

                // Handle Earnings
                // $earning = new EarningController();
                // $earning->doQ0Earnings($user);

                // If User is not a Matrix Thrift
                // MT cannot do PIE

                if ((int) $user->is_matrix_thrift == 0) {

                    // Deposit #5 PIE Units in user's name
                    $pie = new PIESystemController();
                    $pie_price = Helpers::settings('pie_price_upgraded');
                    $_pie = $pie->createPIEAccount($user->id, 5 * $pie_price, 5, 'pie_bonus', 13);

                    // Log PIE Transactions
                    PIETransaction::create([
                        'user_id' => $user->id,
                        'pie_id' => $_pie->id,
                        'entry' => 'credit',
                        'paymentmethod' => 12,
                        'amount' => 5 * $pie_price,
                        'comment' => 'Purchase of 5 PIE Units'
                    ]);

                    // Pay Sponsor in PIE #1 Unit
                    $sponsor_pie = $pie->createPIEAccount($user->sponsor_id, 1 * $pie_price, 1, 'sponsor_bonus', 13);

                    // Log PIE Transactions
                    PIETransaction::create([
                        'user_id' => $user->sponsor_id,
                        'pie_id' => $sponsor_pie->id,
                        'entry' => 'credit',
                        'paymentmethod' => 12,
                        'amount' => 1 * $pie_price,
                        'comment' => 'Sponsor bonus'
                    ]);

                    // Log Incentives
                    MatrixIncentive::create([
                        'user_id' => $user->id,
                        'level' => $user->current_matrix,
                    ]);

                    // Send Mail
                    $sponsor_user = User::where('id', $user->sponsor_id)->first();
                    Mail::to($sponsor_user)->send(new ReferralBonus($sponsor_user));
                }

                // If User is Matrix Thrift, Transfer Earning to Owner and disable account
                if ((int) $user->is_matrix_thrift != 0) {
                    $matrix_thrift = new MatrixThriftController();
                    $matrix_thrift->transferMatrixThriftEarningToOwner($user);
                    $matrix_thrift->disableMatrixThrift($user);
                }

                // Send Mail
                $content = [$user, $next_matrix, $current_matrix];
                Mail::to($user)->send(new CycleCompleted($content));
            }
        }
    }


    /**
     * Moves user from Q1 to Q2
     * @param $user User model instance
     */
    private function doQuorumShift_1($user)
    {
        // Refresh User class
        $user = $user->fresh();
        // The next matrix user will be shifted to
        $next_matrix = 2;
        $current_matrix = 1;

        // Is User in Q1
        if ($user->current_matrix == $current_matrix) {

            // Base: 81
            $result = $this->graph->countOfUsersByLevel($user->pin_unique_value, 4);

            $no_of_users = $result->value('no_of_users');

            // Fetch $required_no_of_users from database
            if ($no_of_users == 81) {
                // Move User to Quorum 2
                // Update User Current Matrix
                $this->graph->updateCurrentMatrix($user->pin_unique_value, $next_matrix);
                User::where('id', $user->id)->update(['current_matrix' => $next_matrix]);

                // Update User Matrix
                Matrix::updateUserMatrix($user->id, $next_matrix);

                // Log Incentives
                MatrixIncentive::create([
                    'user_id' => $user->id,
                    'level' => $user->current_matrix,
                ]);

                // Handle Earnings
                $earning = new EarningController();
                $earning->doQ1Earnings($user);

                // Send Mail
                $content = [$user, $next_matrix, $current_matrix];
                Mail::to($user)->send(new CycleCompleted($content));
            }
        }
    }


    /**
     * Moves user from Q2 to Q3
     * @param $user User model instance
     */
    private function doQuorumShift_2($user)
    {
        // Refresh User class
        $user = $user->fresh();

        // The next matrix user will be shifted to
        $next_matrix = 3;
        $current_matrix = 2;

        // Is user in Q2
        if ($user->current_matrix == $current_matrix) {

            // Base: 729
            $result = $this->graph->countOfUsersByLevel($user->pin_unique_value, 6);

            $no_of_users = $result->value('no_of_users');

            if ($no_of_users == 729) {
                // Move User to Quorum 2
                // Update User Current Matrix
                $this->graph->updateCurrentMatrix($user->pin_unique_value, $next_matrix);
                User::where('id', $user->id)->update(['current_matrix' => $next_matrix]);

                // Update User Matrix
                Matrix::updateUserMatrix($user->id, $next_matrix);

                // Log Incentives
                MatrixIncentive::create([
                    'user_id' => $user->id,
                    'level' => $user->current_matrix,
                ]);

                // Handle Earnings
                $earning = new EarningController();
                $earning->doQ2Earnings($user);

                // Send Mail
                $content = [$user, $next_matrix, $current_matrix];
                Mail::to($user)->send(new CycleCompleted($content));
            }
        }
    }


    /**
     * Moves user from Q3 to Q4
     * @param $user User model instance
     */
    private function doQuorumShift_3($user)
    {
        // Refresh User class
        $user = $user->fresh();

        // The next matrix user will be shifted to
        $next_matrix = 4;
        $current_matrix = 3;

        // Base: 6561
        $result = $this->graph->countOfUsersByLevel($user->pin_unique_value, 8);

        if ($user->current_matrix == $current_matrix) {

            // Base: 6561
            $result = $this->graph->countOfUsersByLevel($user->pin_unique_value, 8);

            $no_of_users = $result->value('no_of_users');

            // Fetch $required_no_of_users from database
            if ($no_of_users == 6561) {
                // Move User to Quorum 4
                // Update User Current Matrix
                $this->graph->updateCurrentMatrix($user->pin_unique_value, $next_matrix);
                User::where('id', $user->id)->update(['current_matrix' => $next_matrix]);

                // Update User Matrix
                Matrix::updateUserMatrix($user->id, $next_matrix);

                // Log Incentives
                MatrixIncentive::create([
                    'user_id' => $user->id,
                    'level' => $user->current_matrix,
                ]);

                // Handle Earnings
                $earning = new EarningController();
                $earning->doQ3Earnings($user);

                // Send Mail
                $content = [$user, $next_matrix, $current_matrix];
                Mail::to($user)->send(new CycleCompleted($content));
            }
        }
    }


    /**
     * Moves user from Q4 to Q5
     * @param $user User model instance
     */
    private function doQuorumShift_4($user)
    {
        // Refresh User class
        $user = $user->fresh();

        // The next matrix user will be shifted to
        $next_matrix = 5;
        $current_matrix = 4;

        // Is user in Q4
        if ($user->current_matrix == $current_matrix) {

            // Base: 59049
            $result = $this->graph->countOfUsersByLevel($user->pin_unique_value, 10);

            $no_of_users = $result->value('no_of_users');

            // Fetch $required_no_of_users from database
            if ($no_of_users == 59049) {
                // Move User to Quorum 5
                // Update User Current Matrix
                $this->graph->updateCurrentMatrix($user->pin_unique_value, $next_matrix);
                User::where('id', $user->id)->update(['current_matrix' => $next_matrix]);

                // Update User Matrix
                Matrix::updateUserMatrix($user->id, $next_matrix);

                // Log Incentives
                MatrixIncentive::create([
                    'user_id' => $user->id,
                    'level' => $user->current_matrix,
                ]);

                // Handle Earnings
                $earning = new EarningController();
                $earning->doQ4Earnings($user);

                // Send Mail
                $content = [$user, $next_matrix, $current_matrix];
                Mail::to($user)->send(new CycleCompleted($content));
            }
        }
    }

    /**
     * This is the final stage
     * User is paid as levels are completed
     */
    public function handleQuorum_5($user)
    {
        // Refresh User class
        $user = $user->fresh();

        // The next matrix user will be shifted to
        $next_matrix = 5;
        $current_matrix = 4;


        // Is user in Q5
        if ($user->current_matrix == $current_matrix) {
            // Check if Level 1 and Level 2 of the hierarchy is filled.
            // Base: 531441
            $result = $this->graph->countOfUsersByLevel($user->pin_unique_value, 12);
            // $result = $this->graph->noOfUsersAtThisLevel($user->pin_unique_value, 2, $current_matrix);
            $no_of_users_level_1 = $result->value('no_of_users');
            // Check if level 3
            // Base: 1594323
            $result = $this->graph->countOfUsersByLevel($user->pin_unique_value, 13);
            // $result = $this->graph->noOfUsersAtThisLevel($user->pin_unique_value, 3, $current_matrix);
            $no_of_users_level_2 = $result->value('no_of_users');

            // Fetch $required_no_of_users from database
            if ($no_of_users_level_1 == 531441) {
                // Move User to Quorum 5
                // Update User Current Matrix
                $this->graph->updateCurrentMatrix($user->pin_unique_value, $next_matrix);
                User::where('id', $user->id)->update(['current_matrix' => $next_matrix]);

                // Update User Matrix
                Matrix::updateUserMatrix($user->id, $next_matrix);

                // Handle Earnings
                $earning = new EarningController();
                $earning->doQ5_1Earnings($user);
            } elseif ($no_of_users_level_2 == 1594323) {

                // Handle Earnings
                $earning = new EarningController();
                $earning->doQ5_2Earnings($user);
            }
        }
    }

    /**
     * This is the final stage
     * User is paid as levels are completed
     */
    // public function handleQuorum_5($user)
    // {
    //     // Refresh User class
    //     $user = $user->fresh();

    //     // The next matrix user will be shifted to
    //     $next_matrix = 5;
    //     $current_matrix = 4;


    //     // Is user in Q5
    //     if ($user->current_matrix == $current_matrix) {
    //         // Check if Level 1 and Level 2 of the hierarchy is filled.
    //         $result = $this->graph->noOfUsersAtThisLevel($user->pin_unique_value, 2, $current_matrix);
    //         $no_of_users_level_1 = $result->value('no_of_users');
    //         // Check if level 3
    //         $result = $this->graph->noOfUsersAtThisLevel($user->pin_unique_value, 3, $current_matrix);
    //         $no_of_users_level_2 = $result->value('no_of_users');

    //         // Fetch $required_no_of_users from database
    //         if ($no_of_users_level_1 == 12) {
    //             // Move User to Quorum 4
    //             // Update User Current Matrix
    //             $this->graph->updateCurrentMatrix($user->pin_unique_value, $next_matrix);
    //             User::where('id', $user->id)->update(['current_matrix' => $next_matrix]);

    //             // Update User Matrix
    //             Matrix::updateUserMatrix($user->id, $next_matrix);
    //             // dump("Updated Current Matrix");

    //             // Handle Earnings
    //             $earning = new EarningController();
    //             $earning->doQ5_1Earnings($user);

    //             // dump("Paid Q5 First Earning");
    //         } elseif ($no_of_users_level_2 == 39) {

    //             // Handle Earnings
    //             $earning = new EarningController();
    //             $earning->doQ5_2Earnings($user);

    //             // dump("Paid Q5 Second Earning");
    //         }
    //     }
    // }
}
