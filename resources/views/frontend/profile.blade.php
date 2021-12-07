@extends('layouts.app.main')

@section('title', 'Profile')

@section('content')



    <!-- Main Content -->

    <div class="hk-pg-wrapper">

        <!-- Container -->

        <div class="container-fluid">

            <!-- Row -->

            <div class="row">

                <div class="col-xl-12 pa-0">

                    <div class="profile-cover-wrap overlay-wrap">

                        <div class="profile-cover-img" style="background-color:cadetblue;"></div>

                        <div class="bg-overlay bg-trans-dark-60"></div>

                        <div class="container profile-cover-content py-50">

                            <div class="hk-row">

                                <div class="col-lg-6">

                                    <div class="media align-items-center">

                                        <div class="media-img-wrap  d-flex">

                                            <div class="avatar">

                                                <span class="avatar-text avatar-text-inv-success rounded-circle">

                                                    <span class="initial-wrap">

                                                        <span class="fa fa-user fa-lg"></span>

                                                    </span>

                                                </span>

                                            </div>

                                        </div>

                                        <div class="media-body">

                                            <div class="text-white text-capitalize display-6 mb-5 font-weight-400">{{ Auth::user()->fname ?? "" }} {{ Auth::user()->lname ?? "" }}</div>

                                            <div class="font-14 text-white"><span class="mr-5"><span class="font-weight-500 pr-5">https://{{ request()->getHost() }}/ref/{{ Auth::user()->username }}</span></span></div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="bg-white shadow-bottom">

                        <div class="container">

                            <ul class="nav nav-light nav-tabs" role="tablist">

                                <li class="nav-item">

                                    <a class="d-flex h-60p align-items-center nav-link active">My Profile</a>

                                </li>

                            </ul>

                        </div>

                    </div>

                    <div class="tab-content mt-sm-60 mt-30">

                        <div class="tab-pane fade show active" role="tabpanel">

                            <div class="container">

                                <div class="hk-row">



                                    <!-- Profile Form -->

                                    <div class="col-lg-8">

                                        <div class="card card-profile-feed">

                                            <div class="card-header card-header-action">

                                                <div class="media align-items-center">

                                                    <div class="media-body">

                                                        <div class="text-capitalize font-weight-500 text-dark">Edit Profile Details</div>

                                                    </div>

                                                </div>

                                            </div>



                                            {{-- Include error --}}

                                            @include('layouts.partials.error')

                                            {{-- /Include error --}}



                                            <form action="{{ route('updateprofile') }}" id="payment-form" method="post" accept-charset="utf-8">

                                                @csrf

                                                <div class="card-body">

                                                    <div class="row">

                                                        <div class="col-md-6 form-group">

                                                            <label for="username">Username</label>

                                                            <input type="text" name="username" id="username" class="form-control" value="{{ Auth::user()->username }}" aria-describedby="usernameHelpBlock" readonly>

                                                            <small id="usernameHelpBlock" class="form-text text-muted">Your Username cannot be changed.</small>

                                                        </div>

                                                        <div class="col-md-6 form-group">

                                                            <label for="useremail">Email Address</label>

                                                            <input type="email" name="useremail" id="useremail" class="form-control" value="{{ Auth::user()->email }}" aria-describedby="emailHelpBlock" readonly>

                                                            <small id="emailHelpBlock" class="form-text text-muted">Your Email address cannot be changed.</small>

                                                        </div>

                                                    </div>

                                                    <div class="row">

                                                        <div class="col-md-6 form-group">

                                                            <label for="userfirstname">First Name</label>

                                                            <input type="text" name="userfirstname" id="userfirstname" class="form-control" placeholder="Your First Name" aria-describedby="firstnameHelpBlock" value="{{ Auth::user()->fname ?? old('userfirstname') }}" required>

                                                            <small id="firstnameHelpBlock" class="form-text">This should correspond with your bank details.</small>

                                                        </div>

                                                        <div class="col-md-6 form-group">

                                                            <label for="userlastname">Last Name</label>

                                                            <input type="text" name="userlastname" id="userlastname" class="form-control" placeholder="Your Last Name or Surname" aria-describedby="lastnameHelpBlock" value="{{ Auth::user()->lname ?? old('userlastname') }}" required>

                                                            <small id="lastnameHelpBlock" class="form-text">This should correspond with your bank details.</small>

                                                        </div>

                                                    </div>

                                                    <div class="row">

                                                        <div class="col-md-6 form-group">

                                                            <label for="userphone">Phone Number</label>

                                                            <input type="text" @if(Auth::user()->phone != '') readonly @else name="userphone" @endif id="userphone" class="form-control" value="{{ Auth::user()->phone ?? old('userphone') }}" placeholder="Eg: 07011223344" aria-describedby="phoneHelpBlock" >

                                                            <small id="phoneHelpBlock" class="form-text text-muted">Please use a functional phone number.</small>

                                                        </div>

                                                        <div class="col-md-6 form-group">

                                                            <label for="usergender">Gender</label>

                                                            <select name="usergender" id="usergender" class="form-control" aria-describedby="genderHelpBlock" required>

                                                                <option value="" {{ (Auth::user()->gender == '')? 'selected' : '' }}>Choose One</option>

                                                                <option value="m" {{ (Auth::user()->gender == 'm')? 'selected' : '' }}>Male</option>

                                                                <option value="f"  {{ (Auth::user()->gender == 'f')? 'selected' : '' }}>Female</option>

                                                            </select>

                                                            <small id="genderHelpBlock" class="form-text text-muted">Select your gender from the list.</small>

                                                        </div>

                                                        <div class="col-md-6 form-group">

                                                            <label for="userbvn">Date of Birth</label>

                                                            <input name="dob" type="date" id="userdob" class="form-control" aria-describedby="abvnHelpBlock" value="{{ Auth::user()->dob ?? old('dob') }}" required>

                                                            <small id="abvnHelpBlock" class="form-text">You must be 18 and above.</small>

                                                        </div>

                                                    </div>

                                                    <h6 class="text-on-line"><span>Bank Details</span></h6>

                                                    <div class="row">

                                                        <div class="col-md-6 form-group">

                                                            <label for="useraccountname">*Account Name</label>

                                                            <input type="text" name="useraccountname" id="useraccountname" class="form-control" placeholder="Your Bank Account Name" aria-describedby="anameHelpBlock" value="{{ Auth::user()->account_name ?? old('useraccountname') }}" required>

                                                            <small id="anameHelpBlock" class="form-text">Your bank account name. Should correspond with your first and last name.</small>

                                                        </div>

                                                        <div class="col-md-6 form-group">

                                                            <label for="useraccountnumber">*Account Number</label>

                                                            <input type="text" name="useraccountnumber" id="useraccountnumber" class="form-control" placeholder="Your Bank Account Number" aria-describedby="anumberHelpBlock" value="{{ Auth::user()->account_number ?? old('useraccountnumber') }}" required>

                                                            <small id="anumberHelpBlock" class="form-text text-muted">Your account number in NUBAN format (10 digits only).</small>

                                                        </div>

                                                        <div class="col-md-6 form-group">

                                                            <label for="userbankid">*Bank Name </label>

                                                            <select name="userbankid" id="userbankid" class="form-control" aria-describedby="bnameHelpBlock" required>

                                                                <option value="" {{ (Auth::user()->bank_code == '')? 'selected': '' }}>Choose One</option>

                                                                <option value="044" {{ (Auth::user()->bank_code == '044')? 'selected' : '' }}>Access Bank Nigeria Plc</option>

                                                                <option value="050" {{ (Auth::user()->bank_code == '050')? 'selected' : '' }}>Ecobank Nigeria Plc</option>

                                                                <option value="084" {{ (Auth::user()->bank_code == '084')? 'selected' : '' }}>Enterprise Bank Plc</option>

                                                                <option value="070" {{ (Auth::user()->bank_code == '070')? 'selected' : '' }}>Fidelity Bank Plc</option>

                                                                <option value="011" {{ (Auth::user()->bank_code == '011')? 'selected' : '' }}>First Bank of Nigeria Plc</option>

                                                                <option value="214" {{ (Auth::user()->bank_code == '214')? 'selected' : '' }}>First City Monument Bank (FCMB)</option>

                                                                <option value="058" {{ (Auth::user()->bank_code == '058')? 'selected' : '' }}>Guaranty Trust Bank Plc (GTB)</option>

                                                                <option value="030" {{ (Auth::user()->bank_code == '030')? 'selected' : '' }}>Heritage Bank</option>

                                                                <option value="082" {{ (Auth::user()->bank_code == '082')? 'selected' : '' }}>Keystone Bank Ltd</option>

                                                                <option value="221" {{ (Auth::user()->bank_code == '221')? 'selected' : '' }}>Stanbic IBTC Bank Plc</option>

                                                                <option value="232" {{ (Auth::user()->bank_code == '232')? 'selected' : '' }}>Sterling Bank Plc</option>

                                                                <option value="032" {{ (Auth::user()->bank_code == '032')? 'selected' : '' }}>Union Bank Nigeria Plc</option>

                                                                <option value="033" {{ (Auth::user()->bank_code == '033')? 'selected' : '' }}>United Bank for Africa Plc (UBA)</option>

                                                                <option value="215" {{ (Auth::user()->bank_code == '215')? 'selected' : '' }}>Unity Bank Plc</option>

                                                                <option value="035" {{ (Auth::user()->bank_code == '035')? 'selected' : '' }}>WEMA Bank Plc</option>

                                                                <option value="057" {{ (Auth::user()->bank_code == '057')? 'selected' : '' }}>Zenith Bank Plc</option>

                                                                <option value="014" {{ (Auth::user()->bank_code == '014')? 'selected' : '' }}>MainStreet Bank</option>

                                                                <option value="076" {{ (Auth::user()->bank_code == '076')? 'selected' : '' }}>Skye Bank</option>

                                                            </select>

                                                            <small id="bnameHelpBlock" class="form-text text-muted">Select the name of your bank from the list.</small>

                                                        </div>

                                                    </div>

                                                    <h6 class="text-on-line"><span>Security</span></h6>

                                                    <div class="row">

                                                        <div class="col-md-6 form-group">

                                                            <label for="userpassword">Password</label>

                                                            <input type="password" name="userpassword" id="userpassword" class="form-control" placeholder="xxxxxxxx" aria-describedby="passwordHelpBlock" required>

                                                            <small id="passwordHelpBlock" class="form-text text-muted">Enter password for authorization.</small>

                                                        </div>

                                                        {{-- <div class="col-md-6 form-group">

                                                            <label for="usercpassword">Confirm Password</label>

                                                            <input type="password" name="userpassword_confirmation" id="usercpassword" class="form-control" placeholder="xxxxxxxx" aria-describedby="passwordcHelpBlock" required>

                                                            <small id="passwordcHelpBlock" class="form-text text-muted">Re-type your new password again.</small>

                                                        </div> --}}

                                                    </div>

                                                </div>

                                                <div class="card-footer justify-content-end">

                                                    <button type="submit" class="btn btn-primary">Save Changes</button>

                                                </div>

                                            </form>

                                        </div>

                                    </div>

                                    <!-- /Profile Form -->

                                    <!-- Profile Details -->

                                    <div class="col-lg-4">

                                        <div class="card card-profile-feed">

                                            <div class="card-header card-header-action">

                                                <div class="media align-items-center">

                                                    <div class="media-body">

                                                        <div class="text-capitalize font-weight-500 text-dark">Profile Details</div>

                                                    </div>

                                                </div>

                                            </div>

                                            <div class="row text-center">

                                                <div class="col-4 border-right pr-0">

                                                    <div class="pa-15">

                                                        <span class="d-block display-6 text-dark mb-5">{{ Auth::user()->count_pie_accounts }}</span>

                                                        <span class="d-block text-capitalize font-14">PIE units</span>

                                                    </div>

                                                </div>

                                                <div class="col-4 border-right px-0">

                                                    <div class="pa-15">

                                                        <span class="d-block display-6 text-dark mb-5">{{ Auth::user()->matrix_thrifts_count }}</span>

                                                        <span class="d-block text-capitalize font-14">STT Packs</span>

                                                    </div>

                                                </div>

                                                <div class="col-4 pl-0">

                                                    <div class="pa-15">

                                                        <span class="d-block display-6 text-dark mb-5">{{ count(Auth::user()->referrals) }}</span>

                                                        <span class="d-block text-capitalize font-14">referrals</span>

                                                    </div>

                                                </div>

                                            </div>

                                            <ul class="list-group list-group-flush">

                                                <li class="list-group-item"><span><i class="ion ion-md-person font-18 text-light-20 mr-10"></i><span>Sponsor:</span></span><span class="ml-5 text-dark"> {{ Auth::user()->sponsor }} </span></li>

                                                <li class="list-group-item"><span><i class="ion ion-md-clock font-18 text-light-20 mr-10"></i><span>Last Login:</span></span><span class="ml-5 text-dark"> {{ date_format(date_create(Auth::user()->last_login_at), 'jS M, Y') }} @ {{ date_format(date_create(Auth::user()->last_login_at), 'h:iA') }} </span></li>

                                                <li class="list-group-item"><span><i class="ion ion-md-calendar font-18 text-light-20 mr-10"></i><span>Date Joined:</span></span><span class="ml-5 text-dark">{{ Auth::user()->created_at->format('jS M, Y')  }} @ {{ Auth::user()->created_at->format('h:iA')  }}</span></li>

                                            </ul>

                                            </div>

                                    </div>

                                    <!-- /Profile Details -->

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <!-- /Row -->

        </div>

        <!-- /Container -->



        @include('layouts.app.footer')

    </div>

    <!-- /Main Content -->



@endsection

