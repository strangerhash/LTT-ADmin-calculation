@extends('administrator.layouts.app-master')

@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <div class="page-title-box">
                        <h4 class="font-size-18">Dashboard</h4>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item active">Iscube Admin Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card mini-stat bg-primary text-white">
                        <div class="card-body">
                            <div class="mb-4">
                                <div class="float-left mini-stat-img mr-4">
                                    <img src="{{ asset('admin_assets/images/services-icon/01.png') }}" alt="">
                                </div>
                                <h6 class="font-size-12 text-uppercase mt-0 text-white-20">Total Visitors</h6>
                                <h4 class="font-weight-medium font-size-24">{{ $total_tracking_users }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card mini-stat bg-primary text-white">
                        <div class="card-body">
                            <div class="mb-4">
                                <div class="float-left mini-stat-img mr-4">
                                    <img src="{{ asset('admin_assets/images/services-icon/02.png') }}" alt="">
                                </div>
                                <h6 class="font-size-12 text-uppercase mt-0 text-white-20">Visitors Yesterday </h6>
                                <h4 class="font-weight-medium font-size-24">{{ $total_yesterday_users }}</h4>
                            </div>
                        </div> 
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card mini-stat bg-primary text-white">
                        <div class="card-body">
                            <div class="mb-4">
                                <div class="float-left mini-stat-img mr-4">
                                    <img src="{{ asset('admin_assets/images/services-icon/03.png') }}" alt="">
                                </div>
                                <h6 class="font-size-12 text-uppercase mt-0 text-white-20">Visitors This Month</h6>
                                <h4 class="font-weight-medium font-size-24">{{ $thismonth_trackingusers }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card mini-stat bg-primary text-white">
                        <div class="card-body">
                            <div class="mb-4">
                                <div class="float-left mini-stat-img mr-4">
                                    <img src="{{ asset('admin_assets/images/services-icon/04.png') }}" alt="">
                                </div>

                                <h6 class="font-size-12 text-uppercase mt-0 text-white-20">Visitors Last Month </h6>
                                <h4 class="font-weight-medium font-size-24">{{ $lastmonth_tracking_users }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card mini-stat bg-primary text-white">
                        <div class="card-body">
                            <div class="mb-4">
                                <div class="float-left mini-stat-img mr-4">
                                    <img src="{{ asset('admin_assets/images/services-icon/01.png') }}" alt="">
                                </div>
                                <h6 class="font-size-12 text-uppercase mt-0 text-white-20">Upgraded Members</h6>
                                <h4 class="font-weight-medium font-size-24">{{ $registeredUsers }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card mini-stat bg-primary text-white">
                        <div class="card-body">
                            <div class="mb-4">
                                <div class="float-left mini-stat-img mr-4">
                                    <img src="{{ asset('admin_assets/images/services-icon/02.png') }}" alt="">
                                </div>
                                <h6 class="font-size-12 text-uppercase mt-0 text-white-20">Upgraded Members Yesterday</h6>
                                <h4 class="font-weight-medium font-size-24">{{ $upgradedUsers }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card mini-stat bg-primary text-white">
                        <div class="card-body">
                            <div class="mb-4">
                                <div class="float-left mini-stat-img mr-4">
                                    <img src="{{ asset('admin_assets/images/services-icon/03.png') }}" alt="">
                                </div>
                                <h6 class="font-size-12 text-uppercase mt-0 text-white-20">Upgraded Members This Month </h6>
                                <h4 class="font-weight-medium font-size-24">{{ $totalSTT }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card mini-stat bg-primary text-white">
                        <div class="card-body">
                            <div class="mb-4">
                                <div class="float-left mini-stat-img mr-4">
                                    <img src="{{ asset('admin_assets/images/services-icon/04.png') }}" alt="">
                                </div>

                                <h6 class="font-size-12 text-uppercase mt-0 text-white-20">Upgraded Members Last Month </h6>
                                <h4 class="font-weight-medium font-size-24">{{ $totalLTT }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


                <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card mini-stat bg-primary text-white">
                        <div class="card-body">
                            <div class="mb-4">
                                <div class="float-left mini-stat-img mr-4">
                                    <img src="{{ asset('admin_assets/images/services-icon/01.png') }}" alt="">
                                </div>
                                <h6 class="font-size-12 text-uppercase mt-0 text-white-20">Registered Users</h6>
                                <h4 class="font-weight-medium font-size-24">{{ $registeredUsers }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card mini-stat bg-primary text-white">
                        <div class="card-body">
                            <div class="mb-4">
                                <div class="float-left mini-stat-img mr-4">
                                    <img src="{{ asset('admin_assets/images/services-icon/02.png') }}" alt="">
                                </div>
                                <h6 class="font-size-12 text-uppercase mt-0 text-white-20">Upgraded Users</h6>
                                <h4 class="font-weight-medium font-size-24">{{ $upgradedUsers }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card mini-stat bg-primary text-white">
                        <div class="card-body">
                            <div class="mb-4">
                                <div class="float-left mini-stat-img mr-4">
                                    <img src="{{ asset('admin_assets/images/services-icon/03.png') }}" alt="">
                                </div>
                                <h6 class="font-size-12 text-uppercase mt-0 text-white-20">Total STT</h6>
                                <h4 class="font-weight-medium font-size-24">{{ $totalSTT }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card mini-stat bg-primary text-white">
                        <div class="card-body">
                            <div class="mb-4">
                                <div class="float-left mini-stat-img mr-4">
                                    <img src="{{ asset('admin_assets/images/services-icon/04.png') }}" alt="">
                                </div>

                                <h6 class="font-size-12 text-uppercase mt-0 text-white-20">Total LTT</h6>
                                <h4 class="font-weight-medium font-size-24">{{ $totalLTT }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="row">
                <div class="col-xl-9">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Daily Registration vs Upgrade for the last 10 days</h4>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div>
                                        <div id="chart-with-area" class="ct-chart earning ct-golden-section">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end row -->
                        </div>
                    </div>
                    <!-- end card -->
                </div>

                <div class="col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div>
                                <h4 class="card-title mb-4">Sales Analytics</h4>
                            </div>
                            <div class="wid-peity mb-4">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div>
                                            <p class="text-muted">STT</p>
                                            <h5 class="mb-4">1,542</h5>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <span class="peity-line" data-width="100%"
                                                data-peity='{ "fill": ["rgba(2, 164, 153,0.3)"],"stroke": ["rgba(2, 164, 153,0.8)"]}'
                                                data-height="60">6,2,8,4,3,8,1,3,6,5,9,2,8,1,4,8,9,8,2,1</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="wid-peity mb-4">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div>
                                            <p class="text-muted">LTT</p>
                                            <h5 class="mb-4">6,451</h5>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <span class="peity-line" data-width="100%"
                                                data-peity='{ "fill": ["rgba(2, 164, 153,0.3)"],"stroke": ["rgba(2, 164, 153,0.8)"]}'
                                                data-height="60">6,2,8,4,-3,8,1,-3,6,-5,9,2,-8,1,4,8,9,8,2,1</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div>
                                            <p class="text-muted">Recharge</p>
                                            <h5>84,574</h5>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <span class="peity-line" data-width="100%"
                                                data-peity='{ "fill": ["rgba(2, 164, 153,0.3)"],"stroke": ["rgba(2, 164, 153,0.8)"]}'
                                                data-height="60">6,2,8,4,3,8,1,3,6,5,9,2,8,1,4,8,9,8,2,1</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Sales Report</h4>

                            <div class="cleafix">
                                <p class="float-left"><i class="mdi mdi-calendar mr-1 text-primary"></i> Jan 01
                                    - Jan 31</p>
                                <h5 class="font-18 text-right">$4230</h5>
                            </div>

                            <div id="ct-donut" class="ct-chart wid"></div>

                            <div class="mt-4">
                                <table class="table mb-0">
                                    <tbody>
                                        <tr>
                                            <td><span class="badge badge-primary">Desk</span></td>
                                            <td>Desktop</td>
                                            <td class="text-right">54.5%</td>
                                        </tr>
                                        <tr>
                                            <td><span class="badge badge-success">Mob</span></td>
                                            <td>Mobile</td>
                                            <td class="text-right">28.0%</td>
                                        </tr>
                                        <tr>
                                            <td><span class="badge badge-warning">Tab</span></td>
                                            <td>Tablets</td>
                                            <td class="text-right">17.5%</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Activity</h4>
                            <ol class="activity-feed">
                                <li class="feed-item">
                                    <div class="feed-item-list">
                                        <span class="date">Jan 22</span>
                                        <span class="activity-text">Responded to need “Volunteer
                                            Activities”</span>
                                    </div>
                                </li>
                                <li class="feed-item">
                                    <div class="feed-item-list">
                                        <span class="date">Jan 20</span>
                                        <span class="activity-text">At vero eos et accusamus et iusto odio
                                            dignissimos ducimus qui deleniti atque...<a href="#"
                                                class="text-success">Read more</a></span>
                                    </div>
                                </li>
                                <li class="feed-item">
                                    <div class="feed-item-list">
                                        <span class="date">Jan 19</span>
                                        <span class="activity-text">Joined the group “Boardsmanship
                                            Forum”</span>
                                    </div>
                                </li>
                                <li class="feed-item">
                                    <div class="feed-item-list">
                                        <span class="date">Jan 17</span>
                                        <span class="activity-text">Responded to need “In-Kind
                                            Opportunity”</span>
                                    </div>
                                </li>
                                <li class="feed-item">
                                    <div class="feed-item-list">
                                        <span class="date">Jan 16</span>
                                        <span class="activity-text">Sed ut perspiciatis unde omnis iste natus
                                            error sit rem.</span>
                                    </div>
                                </li>
                            </ol>
                            <div class="text-center">
                                <a href="#" class="btn btn-primary">Load More</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-5">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card text-center">
                                <div class="card-body">
                                    <div class="py-4">
                                        <i
                                            class="ion ion-ios-checkmark-circle-outline display-4 text-success"></i>

                                        <h5 class="text-primary mt-4">Order Successful</h5>
                                        <p class="text-muted">Thanks you so much for your order.</p>
                                        <div class="mt-4">
                                            <a href="" class="btn btn-primary btn-sm">Chack Status</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="card bg-primary">
                                <div class="card-body">
                                    <div class="text-center text-white py-4">
                                        <h5 class="mt-0 mb-4 text-white-50 font-size-16">Top Product Sale</h5>
                                        <h1>1452</h1>
                                        <p class="font-size-14 pt-1">Computer</p>
                                        <p class="text-white-50 mb-0">At solmen va esser necessi far uniform
                                            myth... <a href="#" class="text-white">View more</a></p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-4">Client Reviews</h4>
                                    <p class="text-muted mb-3 pb-4">" Everyone realizes why a new common
                                        language would be desirable one could refuse to pay expensive
                                        translators it would be necessary. "</p>
                                    <div class="float-right mt-2">
                                        <a href="#" class="text-primary">
                                            <i class="mdi mdi-arrow-right h5"></i>
                                        </a>
                                    </div>
                                    <h6 class="mb-0"><img src="{{ asset('admin_assets/images/users/user-3.jpg') }}" alt=""
                                            class="avatar-sm rounded-circle mr-2"> James Athey</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Latest Trasaction</h4>
                            <div class="table-responsive">
                                <table class="table table-hover table-centered table-nowrap mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col">(#) Id</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Amount</th>
                                            <th scope="col" colspan="2">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">#14256</th>
                                            <td>
                                                <div>
                                                    <img src="{{ asset('admin_assets/images/users/user-2.jpg') }}" alt=""
                                                        class="avatar-xs rounded-circle mr-2"> Philip Smead
                                                </div>
                                            </td>
                                            <td>15/1/2018</td>
                                            <td>$94</td>
                                            <td><span class="badge badge-success">Delivered</span></td>
                                            <td>
                                                <div>
                                                    <a href="#" class="btn btn-primary btn-sm">Edit</a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">#14257</th>
                                            <td>
                                                <div>
                                                    <img src="{{ asset('admin_assets/images/users/user-3.jpg') }}" alt=""
                                                        class="avatar-xs rounded-circle mr-2"> Brent Shipley
                                                </div>
                                            </td>
                                            <td>16/1/2019</td>
                                            <td>$112</td>
                                            <td><span class="badge badge-warning">Pending</span></td>
                                            <td>
                                                <div>
                                                    <a href="#" class="btn btn-primary btn-sm">Edit</a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">#14258</th>
                                            <td>
                                                <div>
                                                    <img src="{{ asset('admin_assets/images/users/user-4.jpg') }}" alt=""
                                                        class="avatar-xs rounded-circle mr-2"> Robert Sitton
                                                </div>
                                            </td>
                                            <td>17/1/2019</td>
                                            <td>$116</td>
                                            <td><span class="badge badge-success">Delivered</span></td>
                                            <td>
                                                <div>
                                                    <a href="#" class="btn btn-primary btn-sm">Edit</a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">#14259</th>
                                            <td>
                                                <div>
                                                    <img src="{{ asset('admin_assets/images/users/user-5.jpg') }}" alt=""
                                                        class="avatar-xs rounded-circle mr-2"> Alberto Jackson
                                                </div>
                                            </td>
                                            <td>18/1/2019</td>
                                            <td>$109</td>
                                            <td><span class="badge badge-danger">Cancel</span></td>
                                            <td>
                                                <div>
                                                    <a href="#" class="btn btn-primary btn-sm">Edit</a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">#14260</th>
                                            <td>
                                                <div>
                                                    <img src="{{ asset('admin_assets/images/users/user-6.jpg') }}" alt=""
                                                        class="avatar-xs rounded-circle mr-2"> David Sanchez
                                                </div>
                                            </td>
                                            <td>19/1/2019</td>
                                            <td>$120</td>
                                            <td><span class="badge badge-success">Delivered</span></td>
                                            <td>
                                                <div>
                                                    <a href="#" class="btn btn-primary btn-sm">Edit</a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">#14261</th>
                                            <td>
                                                <div>
                                                    <img src="{{ asset('admin_assets/images/users/user-2.jpg') }}" alt=""
                                                        class="avatar-xs rounded-circle mr-2"> Philip Smead
                                                </div>
                                            </td>
                                            <td>15/1/2018</td>
                                            <td>$94</td>
                                            <td><span class="badge badge-warning">Pending</span></td>
                                            <td>
                                                <div>
                                                    <a href="#" class="btn btn-primary btn-sm">Edit</a>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Chat</h4>
                            <div class="chat-conversation">
                                <ul class="conversation-list" data-simplebar style="max-height: 367px;">
                                    <li class="clearfix">
                                        <div class="chat-avatar">
                                            <img src="{{ asset('admin_assets/images/users/user-2.jpg') }}"
                                                class="avatar-xs rounded-circle" alt="male">
                                            <span class="time">10:00</span>
                                        </div>
                                        <div class="conversation-text">
                                            <div class="ctext-wrap">
                                                <span class="user-name">John Deo</span>
                                                <p>
                                                    Hello!
                                                </p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="clearfix odd">
                                        <div class="chat-avatar">
                                            <img src="{{ asset('admin_assets/images/users/user-3.jpg') }}"
                                                class="avatar-xs rounded-circle" alt="Female">
                                            <span class="time">10:01</span>
                                        </div>
                                        <div class="conversation-text">
                                            <div class="ctext-wrap">
                                                <span class="user-name">Smith</span>
                                                <p>
                                                    Hi, How are you? What about our next meeting?
                                                </p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="clearfix">
                                        <div class="chat-avatar">
                                            <img src="{{ asset('admin_assets/images/users/user-2.jpg') }}"
                                                class="avatar-xs rounded-circle" alt="male">
                                            <span class="time">10:04</span>
                                        </div>
                                        <div class="conversation-text">
                                            <div class="ctext-wrap">
                                                <span class="user-name">John Deo</span>
                                                <p>
                                                    Yeah everything is fine
                                                </p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="clearfix odd">
                                        <div class="chat-avatar">
                                            <img src="{{ asset('admin_assets/images/users/user-3.jpg') }}"
                                                class="avatar-xs rounded-circle" alt="male">
                                            <span class="time">10:05</span>
                                        </div>
                                        <div class="conversation-text">
                                            <div class="ctext-wrap">
                                                <span class="user-name">Smith</span>
                                                <p>
                                                    Wow that's great
                                                </p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="clearfix odd">
                                        <div class="chat-avatar">
                                            <img src="{{ asset('admin_assets/images/users/user-3.jpg') }}"
                                                class="avatar-xs rounded-circle" alt="male">
                                            <span class="time">10:08</span>
                                        </div>
                                        <div class="conversation-text">
                                            <div class="ctext-wrap">
                                                <span class="user-name mb-2">Smith</span>

                                                <img src="{{ asset('admin_assets/images/small/img-1.jpg') }}" alt="" height="48"
                                                    class="rounded mr-2">
                                                <img src="{{ asset('admin_assets/images/small/img-2.jpg') }}" alt="" height="48"
                                                    class="rounded">
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <div class="row">
                                    <div class="col-sm-9 col-8 chat-inputbar">
                                        <input type="text" class="form-control chat-input"
                                            placeholder="Enter your text">
                                    </div>
                                    <div class="col-sm-3 col-4 chat-send">
                                        <button type="submit" class="btn btn-success btn-block">Send</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->



        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->



    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    © <script>document.write(new Date().getFullYear())</script> Veltrix<span class="d-none d-sm-inline-block"> - Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesbrand.</span>
                </div>
            </div>
        </div>
    </footer>

</div>
@endsection

@section('scripts')
    <script>
        new Chartist.Line(
            "#chart-with-area",
            {
                labels: [

                ],
                series: [
                    [
                        5, 9, 7, 8, 5, 3, 5, 4, 1, 3, 2, 5, 4, 3, 5, 4
                    ],
                    [
                        5, 1, 8, 8, 2, 3, 5, 4, 4, 3, 2, 4, 0, 0, 3, 9
                    ]
                ]
            },
            {
                low: 0,
                showArea: !0,
                plugins: [
                     Chartist.plugins.tooltip()
                ]
            }
        );
    </script>
@endsection
