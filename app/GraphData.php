<?php



namespace App;



require_once 'Neo4j/vendor/autoload.php';



use GraphAware\Neo4j\Client\ClientBuilder;



class GraphData

{

    private $client;



    function __construct()

    {

        $this->client = ClientBuilder::create()

            ->addConnection('bolt', 'bolt://' . env('NEO4J_USERNAME') . ':' . env('NEO4J_PASSWORD') . '@' . env('NEO4J_HOST') . ':' . env('NEO4J_PORT'))

            // ->addConnection('bolt', 'bolt://neo4j:binaryplan@localhost:7687') // Example for BOLT connection configuration (port is optional)

            // ->addConnection('default', 'http://neo4j:Xs3WpFmYEZWBHhT@199.192.28.179:7474')

            ->build();

    }



    public function isConnected()

    {

        try {

            $this->client->run('RETURN 1 AS x');

            return true;

        } catch (\Exception $ex) {

            abort(503, 'GraphGB Service Unavailable');

            return false;

        }

    }



    public function createData($data)

    {

        $this->client->run(

            'CREATE (n:' . env('NEO4J_TREE_LABEL') . ' {

                join_date: {join_date},

                current_matrix: {current_matrix},

                children: {children},

                sponsor_id: {sponsor_id},

                parent_id: {parent_id},

                position: {position},

                pin_unique_value: {pin_unique_value},

                user_id: toInteger({user_id}),

                is_matrix_thrift: {is_matrix_thrift},

                username: {username}

            })',

            [

                'join_date' => date('Y-m-d'),

                'current_matrix' => $data->current_matrix,

                'children' => 0,

                'sponsor_id' => $data->sponsor_id,

                'parent_id' => $data->parent_id,

                'position' => $data->position,

                'pin_unique_value' => $data->pin_unique_value,

                'user_id' => $data->id,

                'is_matrix_thrift' => $data->is_matrix_thrift,

                'username' => $data->username

            ]

        );

    }



    public function truncate()

    {

        try {

            $this->client->run('MATCH (n:' . env('NEO4J_TREE_LABEL') . ') DETACH DELETE n');

            $this->client->run('MATCH (n:' . env('NEO4J_RECHARGE_LABEL') . ') DETACH DELETE n');

        } catch (\GraphAware\Neo4j\Client\Exception\Neo4jException $ex) {

            abort(503, 'GraphGB Service Unavailable');

            dump($ex);

        }

    }



    /**

     *

     */

    public function hasHowManyChildren($pin_unique_value)

    {

        $result = $this->client->run(

            '

            MATCH (a:' . env('NEO4J_TREE_LABEL') . ' { pin_unique_value: {pin_unique_value}}) RETURN size((a)-->()) as relationship

        ',

            [

                'pin_unique_value' => $pin_unique_value

            ]

        );



        return $result->getRecord()->value("relationship");

    }



    /** */

    public function getFirstLevelChildren($pin_unique_value)

    {

        try {

            $result = $this->client->run('

                MATCH (n:' . env('NEO4J_TREE_LABEL') . ' {pin_unique_value: {pin_unique_value}})-[:PARENTS*1..1]->(m) RETURN m

            ', [

                'pin_unique_value' => $pin_unique_value

            ]);



            return $result->getRecords();

        } catch (\Exception $ex) {

            abort(503, 'GraphGB Service Unavailable');

            dd($ex);

        }

    }



    /** */

    public function createSingleRelationship($data)

    {

        try {

            $result = $this->client->run(

                '

                MATCH (a:' . env('NEO4J_TREE_LABEL') . ' {pin_unique_value: {parent_id}}),(b:' . env('NEO4J_TREE_LABEL') . ' {parent_id: {parent_id}})

                WHERE b.pin_unique_value = {pin_unique_value}

                CREATE (a)-[r:PARENTS]->(b)

            ',

                [

                    'parent_id' => $data->parent_id,

                    'pin_unique_value' => $data->pin_unique_value,

                ]

            );

        } catch (\Exception $ex) {

            abort(503, 'GraphGB Service Unavailable');

            dd($ex);

        }

    }



    /** */

    public function getFreeSpaces($pin_unique_value)

    {

        // MATCH (a:' . env('NEO4J_TREE_LABEL') . ' { pin_unique_value: {pin_unique_value}})-[r:PARENTS*0..5]->(m)

        // WHERE size((m)-->()) < 2

        // RETURN size((m)-->()) as no_of_children, m.pin_unique_value as pin_unique_value, count(r) as depth ORDER BY depth LIMIT 1

        try {

            $result = $this->client->run(

                '

                MATCH (n:' . env('NEO4J_TREE_LABEL') . ' {pin_unique_value:{pin_unique_value}})-[r:PARENTS*0..2]->(b)

                WHERE size((b)-->()) < 2

                RETURN b.pin_unique_value as pin_unique_value, size(r) as depth, size((b)-->()) as no_of_children ORDER BY depth, b.user_id ASC LIMIT 1

            ',

                [

                    'pin_unique_value' => $pin_unique_value,

                ]

            );



            return $result->firstRecord();

        } catch (\Exception $ex) {

            abort(503, 'GraphGB Service Unavailable');

            dd($ex);

        }

    }



    /** */

    public function getFreeSpacesTrinary($pin_unique_value)

    {

        try {

            $result = $this->client->run(

                '

                MATCH (n:' . env('NEO4J_TREE_LABEL') . ' {pin_unique_value:{pin_unique_value}})-[r:PARENTS*0..]->(b)

                WHERE size((b)-->()) < 3

                RETURN b.pin_unique_value as pin_unique_value, size(r) as depth, size((b)-->()) as no_of_children ORDER BY depth, b.user_id ASC LIMIT 1

            ',

                [

                    'pin_unique_value' => $pin_unique_value,

                ]

            );



            return $result->firstRecord();

        } catch (\Exception $ex) {

            abort(503, 'GraphGB Service Unavailable');

            dd($ex);

        }

    }



    /** */

    public function getTotalGraphUsers()

    {

        try {

            $result = $this->client->run('

                MATCH (a:' . env('NEO4J_TREE_LABEL') . ')

                RETURN count(a) as total_graph_users

            ');



            return $result->getRecord()->value('total_graph_users');

        } catch (\Exception $ex) {

            abort(503, 'GraphGB Service Unavailable');

            dd($ex);

        }

    }



    /**

     * This return a Object containing a count of the number

     * of users from the current user to the maximum $level

     *

     * @param string $pin_unique_value - This is the user's ID

     * @param int $level - This is level is max level of search

     * @param int $current_matrix - This is the search requirement. All members must be at this matrix

     * @return int $count - This is the number of users at this $level

     */

    public function noOfUsersAtThisLevel($pin_unique_value, $level, $current_matrix)

    {

        try {

            $result = $this->client->run('

                MATCH (n:' . env('NEO4J_TREE_LABEL') . ' {pin_unique_value: {pin_unique_value}})-[:PARENTS*1..' . $level . ']->(m)

                WHERE m.current_matrix >= {current_matrix}

                RETURN COUNT(m) as no_of_users

            ', [

                'pin_unique_value' => $pin_unique_value,

                'level' => $level,

                'current_matrix' => $current_matrix

            ]);



            return $result->getRecord();

        } catch (\Exception $ex) {

            abort(503, 'GraphGB Service Unavailable');

            dd($ex);

        }

    }



    /**

     * This return a Object containing a count of the number

     * of users only from the current user to the maximum $level

     *

     * @param string $pin_unique_value - This is the user's ID

     * @param int $level - This is level is max level of search

     * @return int $count - This is the number of users at this $level

     */

    public function countOfUsersByLevel($pin_unique_value, $level)

    {

        try {

            $result = $this->client->run('

                MATCH (n:' . env('NEO4J_TREE_LABEL') . ' {pin_unique_value: {pin_unique_value}})-[:PARENTS*' . $level . '..' . $level . ']->(m)

                RETURN COUNT(m) as no_of_users

            ', [

                'pin_unique_value' => $pin_unique_value,

                'level' => $level,

            ]);



            return $result->getRecord();

        } catch (\Exception $ex) {

            abort(503);

        }

    }



    /**

     * This return a Object containing a count of the number

     * of users from the current user to the maximum $level

     *

     * @param string $pin_unique_value - This is the user's ID

     * @param int $new_current_matrix - The new current matrix

     * @return int $count - This is the number of users at this $level

     */

    public function updateCurrentMatrix($pin_unique_value, $new_current_matrix)

    {

        try {

            $result = $this->client->run('

                MATCH (n:' . env('NEO4J_TREE_LABEL') . ' {pin_unique_value: {pin_unique_value}})

                SET n.current_matrix = {new_current_matrix}

                RETURN n as user

            ', [

                'pin_unique_value' => $pin_unique_value,

                'new_current_matrix' => $new_current_matrix

            ]);



            return $result->getRecord();

        } catch (\Exception $ex) {

            abort(503, 'GraphGB Service Unavailable');

            dd($ex);

        }

    }



    /**

     * Return the users in the system based on this $level

     *

     * @param int $user_id

     * @param int $level

     * @param int $current_matrix

     */

    public function getUsersAtLevel($user_id, $level, $current_matrix)

    {

        try {

            $result = $this->client->run('

                MATCH (n:' . env('NEO4J_TREE_LABEL') . ' {user_id: {user_id}})-[:PARENTS*0..' . $level . ']->(m)

                WHERE m.current_matrix >= {current_matrix}

                RETURN m.user_id as users ORDER BY m.user_id ASC

            ', [

                'user_id' => (int) $user_id,

                'level' => $level,

                'current_matrix' => $current_matrix

            ]);



            return $result->getRecords();

        } catch (\Exception $ex) {

            abort(503, 'GraphGB Service Unavailable');

            dd($ex);

        }

    }





    /**

     *

     * @param int $user_id

     */

    public function getUserGeneology($user_id)

    {

        try {

            $result = $this->client->run('

                MATCH (n:' . env('NEO4J_TREE_LABEL') . ' {user_id: {user_id}})-[:PARENTS*1..1]->(m)

                RETURN m.user_id as users

            ', [

                'user_id' => (int) $user_id

            ]);



            return $result->getRecords();

        } catch (\Exception $ex) {

            abort(503, 'GraphGB Service Unavailable');

            dd($ex);

        }

    }



    /**

     *

     * @param int $user_id

     */

    public function isRelatedToUser($user_id, $downline_id)

    {

        try {

            $result = $this->client->run('

                MATCH (n:' . env('NEO4J_TREE_LABEL') . ' {user_id: {user_id}})-[:PARENTS*0..]->(m)

                WHERE m.user_id = {downline_id}

                RETURN TRUE as res

            ', [

                'user_id' => (int) $user_id,

                'downline_id' => (int) $downline_id

            ]);



            return $result->getRecord()->value('res');

        } catch (\Exception $ex) {

            return false;

        }

    }



    /********************************************************************************

     * Iscube Networks

     * Referral System

     *

     ********************************************************************************/



    public function referralCreateData($data)

    {

        try {

            $this->client->run(

                'CREATE (n:' . env('NEO4J_RECHARGE_LABEL') . ' {

                join_date: {join_date},

                parent_id: {parent_id},

                sponsor_id: {sponsor_id},

                username: {username},

                user_id: {user_id}

            })',

                [

                    'join_date' => date('Y-m-d'),

                    'parent_id' => $data->parent_id,

                    'sponsor_id' => $data->sponsor_id,

                    'username' => $data->username,

                    'user_id' => $data->id

                ]

            );

        } catch (\Exception $ex) {

            abort(503, 'GraphGB Service Unavailable');

            dd($ex);

        }

    }



    public function referralCreateRelationship($data)

    {

        try {

            $this->client->run(

                '

                MATCH (a:' . env('NEO4J_RECHARGE_LABEL') . ' {user_id: {sponsor_id} }),(b:' . env('NEO4J_RECHARGE_LABEL') . ' {user_id: {user_id}})

                WHERE b.user_id = {user_id}

                CREATE (a)-[r:PARENTS]->(b)

            ',

                [

                    'sponsor_id' => (int) $data->sponsor_id,

                    'user_id' => (int) $data->id,

                ]

            );

        } catch (\Exception $ex) {

            abort(503, 'GraphGB Service Unavailable');

            dd($ex);

        }

    }



    public function referralGetUplines($user_id)

    {

        try {

            $result = $this->client->run(

                '

                MATCH (n)-[:PARENTS*1..2]->(m:' . env('NEO4J_RECHARGE_LABEL') . ' {user_id: {user_id}})

                RETURN n.user_id as user_id',

                [

                    'user_id' => $user_id,

                ]

            );



            return $result->getRecords();

        } catch (\Exception $ex) {

            abort(503, 'GraphGB Service Unavailable');

            dd($ex);

        }

    }



    public function referralGetUsersAtLevel($user_id)

    {

        try {

            $result = $this->client->run('

                MATCH (n:' . env('NEO4J_RECHARGE_LABEL') . ' {user_id: {user_id}})-[:PARENTS*0..2]->(m)

                RETURN m.user_id as users ORDER BY m.user_id ASC

            ', [

                'user_id' => (int) $user_id,

            ]);



            return $result->getRecords();

        } catch (\Exception $ex) {

            abort(503, 'GraphGB Service Unavailable');

            dd($ex);

        }

    }



    public function referralGetUsersAtLevelForDashboard($user_id)

    {

        try {

            $result = $this->client->run('

                MATCH (n:' . env('NEO4J_RECHARGE_LABEL') . ' {user_id: {user_id}})-[:PARENTS*1..2]->(m)

                RETURN m.user_id as users ORDER BY m.user_id ASC

            ', [

                'user_id' => (int) $user_id,

            ]);



            return $result->getRecords();

        } catch (\Exception $ex) {

            abort(503, 'GraphGB Service Unavailable');

            dd($ex);

        }

    }



    /**

     *

     * @param int $user_id

     */

    public function getUserDownlinesByStep($user_id, $step)

    {

        try {

            $result = $this->client->run('

                MATCH (p:' . env('NEO4J_TREE_LABEL') . ' {user_id: {user_id}})-[:PARENTS*0..]->(m)

                RETURN m.user_id as users ORDER BY m.user_id SKIP ' . $step . ' LIMIT 10

            ', [

                'user_id' => (int) $user_id,

                'step' => (int) $step

            ]);



            return $result->getRecords();

        } catch (\Exception $ex) {

            dd($ex);


            abort(503, 'GraphGB Service Unavailable');

            dd($ex);

        }

    }



    /**

     *

     * @param int $user_id

     */

    public function getUserDownlines($user_id)

    {

        try {

            $result = $this->client->run('

                MATCH (p:' . env('NEO4J_TREE_LABEL') . ' {user_id: {user_id}})-[:PARENTS*1..]->(m)

                RETURN COUNT(m.user_id) as count

            ', [

                'user_id' => (int) $user_id,

            ]);



            return $result->getRecord();

        } catch (\Exception $ex) {

            abort(503, 'GraphGB Service Unavailable');

            dd($ex);

        }

    }

}

