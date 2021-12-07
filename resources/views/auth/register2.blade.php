@extends('layouts.website')
@section('title', 'Registration')
@section('content')
<div class="hk-wrapper">
    <!-- Main Content -->

        <!-- Main Content -->
        <div class="hk-pg-wrapper hk-auth-wrapper">
                <header class="d-flex justify-content-end align-items-center">
                    <div class="btn-group btn-group-sm">
                        <a href="https://iscubecommunity.com/" class="btn btn-outline-secondary">Homepage</a>
                    </div>
                </header>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-12 pa-0">
                            <div class="auth-form-wrap pt-xl-0 pt-70">
                                <div class="auth-form w-xl-30 w-lg-55 w-sm-75 w-100">
                                    <a class="auth-brand text-center d-block mb-10"  href="https://iscubecommunity.com/">
                                        <img class="brand-img" src="{{ asset('/assets/dist/img/iscube-logo.png') }}" alt="ISCUBE logo" />
                                    </a>
                                    <h1 class="display-4 mb-10 text-center">Sign up for free</h1>
                                    <!--- passive income, shopping, cashback, recharge & earn and more-->
                                    <div class="card">
                                      <div class="card-body">
                                            <p>To access all ISCUBE products and services,</p>
                                              <li>You must be 18 years and above.</li>
                                              <li>Only 1 account allowed per user.</li>
                                              <li>Your details must tally with your bank account and BVN.</li>
                                      </div>
                                    </div>

                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <form action="{{ route('auth.register') }}" autocomplete="off" method="post" accept-charset="utf-8">
                                        @csrf
                                            <div class="form-row">
                                            <div class="col-md-6 form-group">
                                                <div class="input-group">
                                                    <input class="form-control" onchange="confirmUniqueUsername()" placeholder="Username" type="text" name="username" value="{{ old('username') }}" required>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><span class="feather-icon"><i data-feather="user"></i></span></span>
                                                    </div>
                                                </div>
                                                <small class="form-text font-weight-bold" id="unique_username"></small>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <div class="input-group">
                                                    <input class="form-control" placeholder="Phone Number" type="text" name="phone" value="{{ old('phone') }}" required>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><span class="feather-icon"><i data-feather="phone"></i></span></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input class="form-control" onchange="confirmUniqueEmail()" placeholder="Email" type="email" name="email" value="{{ old('email') }}" required>
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><span class="feather-icon"><i data-feather="mail"></i></span></span>
                                                </div>
                                            </div>
                                            <small class="form-text font-weight-bold" id="unique_email"></small>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input class="form-control" onchange="fetchReferralInfo()" placeholder="Referrer username" type="text" name="referrer" value="@if(!empty(old('referrer'))){{old('referrer')}}@elseif(!empty($username)){{ $username }}@endif" @isset($username) readonly @endisset required>
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><span class="feather-icon"><i data-feather="user"></i></span></span>
                                                </div>
                                            </div>
                                            <small class="form-text font-weight-bold" id="referrer_info"></small>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input class="form-control" placeholder="Password" type="password" name="password" min="5" required>
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><span class="feather-icon"><i data-feather="lock"></i></span></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input class="form-control" placeholder="Confirm Password" type="password" name="password_confirmation" min="5" required>
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><span class="feather-icon"><i data-feather="lock"></i></span></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-25">
                                            <label class="font-14">By clicking on Register, you agree to our <a href="#" data-toggle="modal" data-target="#modalTerms">Terms</a> and that you have read our <a href="#" data-toggle="modal" data-target="#modalPrivacy">Privacy Policy</a>.</label>
                                        </div>
                                        <button class="btn btn-success btn-block" id="submit" type="submit">Register</button>
                                        <p class="text-center">Already have an account? <a href="{{ url('/auth/login') }}">Log In</a></p>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Main Content -->
    <!-- /Main Content -->

    <!-- Modal -->
    <div class="modal fade" id="modalTerms" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                    <div class="modal-header">
                            <h5 class="modal-title">Terms and Conditions</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <p>These Terms and Conditions are legally binding on all members &ndash;free or upgraded that use the website at <a href="http://www.iscubenetworks.com/">www.Iscubenetworks.com</a>&nbsp;or&nbsp;<a href="https://www.iscubecommunity.com/">www.iscubecommunity.com</a></p>
                        <p><strong><strong>About ISCUBE</strong></strong></p>
                        <p>ISCUBE simply stands for &ldquo;Invite&nbsp;Someone to&nbsp;Come&nbsp;Up and&nbsp;Be&nbsp;Empowered&rdquo;. It is a multi-purpose platform powered by Iscube International Company Limited, a private liability company incorporated in Nigeria in 2012 with <u>RC: 1016852</u></p>
                        <p>Our services include among others, free/paid Skill(s) Acquisitions, Empowerment, Short Term Thrift (PIE, STT &amp; NMT), Online Store, Cashback shopping. Others are Local and International Electronic Airtime Recharge, Bills Payment, WebPOS, Small Business Development, and more.</p>
                        <p><strong><strong>Use of Site</strong></strong></p>
                        <p>You may only use this site to browse the content, make legitimate sales or purchases and shall not use this site for any other purposes, including without limitation, to make any speculative, false or fraudulent sales or purchase. This site and the content provided in this site may not be copied, reproduced, republished, uploaded, posted, transmitted or distributed. &lsquo;Deep-linking&rsquo;, &rsquo;embedding&rsquo; or using analogous technology is strictly prohibited. Unauthorized use of this site and/or the materials contained on this site may violate applicable copyright, trademark or other intellectual property laws or other laws.</p>
                        <p><strong><strong>Disclaimer of Warranty</strong></strong></p>
                        <p>The contents of this site are provided &ldquo;as is&rdquo; without warranty of any kind, either expressed or implied, including but not limited to warranties of merchantability, fitness for a purpose and non-infringement. The owner of this site, the authors of these contents and in general anybody connected to this site in any way, from now on collectively called &ldquo;Providers&rdquo;, assume no responsibility for errors or omissions in these contents.</p>
                        <p>The Providers further do not warrant, guarantee or make any representation regarding the safety, reliability, accuracy, correctness or completeness of these contents. The Providers shall not be liable for any direct, indirect, general, special, incidental or consequential damages (including -without limitation data loss, lost revenues and lost profit) which may result from the inability to use or the correct or incorrect use, abuse, or misuse of these contents, even if the Providers have been informed of the possibilities of such damages. The Providers cannot assume any obligation or responsibility. The use of these contents is forbidden in those places where the law does not allow this disclaimer to take full effect.</p>
                        <p><strong><strong>Our Rights</strong></strong></p>
                        <p>We reserve the right to:</p>
                        <ol>
                        <li>Modify or withdraw, temporarily or permanently, the Website (or any part of) with or without notice to you and you confirm that we shall not be liable to you or any third party for any modification to or withdrawal of the Website; and/or</li>
                        <li>Change these Conditions from time to time and your continued use of the Website (or any part of) following such change shall be deemed to be your acceptance of such change. It is your responsibility to check regularly to determine whether the Conditions have been changed. If you do not agree to any change to the Conditions then you must immediately stop using the Website.</li>
                        <li>We will use our reasonable endeavours to maintain the Website and our services even the PIE Short Term Thrift Plan. The Website is subject to change from time to time. You will not be eligible for any compensation because you cannot use any part of the Website or because of a failure/change in the PIE DT Plan, suspension or withdrawal of all or part of the Website due to circumstances beyond our control.</li>
                        </ol>
                        <p><strong><strong>&nbsp;</strong></strong></p>
                        <p><strong><strong>Product Plans</strong></strong></p>
                        <p>We are purely positioned to provide two major direct services to all members which enable them to have the entrepreneurial skill to survive today&rsquo;s economy.</p>
                        <p>We give users, especially the younger generation the needed opportunity to develop their future for a better tomorrow today.</p>
                        <p>We provide the platform to enable all members to showcase and sell what they have to the world through our e-commerce platform at valstores.com.</p>
                        <p><strong><strong>Product Fees</strong></strong></p>
                        <p>You become a Member by registering free to have access to our entire product and services. It&rsquo;s optional to upgrade according to the terms stated therein and upgrade fee is not refundable, but when you work the business, your PIE units may be activated to LTT unit which stands to earn added value over time, and your access to our platform indicates you completely agree with our terms and conditions.</p>
                        <p>When you click to make registration with us, legal obligations arise and your right to refund of monies charged to your credit card or paid in any other way agreed by us, are limited by our terms &amp; conditions. You must not make any registration through this site unless you understand and agree to all our terms and conditions. Once registration is made, it is deemed that you have read and understood the terms and conditions for such registration or upgrade. If you have any queries please contact us before making any registration or upgrade for any service through this website.</p>
                        <p><strong><strong>Minimum Age</strong></strong></p>
                        <p>Members must be at least 18 years and older to participate.</p>
                        <p><strong><strong>Client / Member Id</strong></strong><strong><strong><br /></strong></strong>Each Member will receive a unique Member Username that will be connected to their profile.</p>
                        <p><strong><strong>&nbsp;</strong></strong></p>
                        <p><strong><strong>Taxes and Representation</strong></strong></p>
                        <p>Each Client/Member is fully responsible for their personal or business tax and will not hold the Company &ndash; Iscube International Company Ltd liable for any such taxes personal or otherwise. Each Member is an independent Representative and not an employee of ISCUBE, as such; each person is completely responsible for their own taxes.</p>
                        <p><strong><strong>Advertising Conduct</strong></strong></p>
                        <p>You agree not to post or make any content:</p>
                        <ul>
                        <li>that violates any law;</li>
                        <li>that is copyrighted or patented, protected by trade secret or trademark, or otherwise subject to third party proprietary rights, including privacy and publicity rights, unless you are the owner of such rights or have permission or a license from their rightful owner to post the material and to grant ISCUBE International Company Limited all of the license rights granted herein;</li>
                        <li>that infringes any of the foregoing intellectual property rights of any party, or is Content that you do not have a right to make available under any law or under contractual or fiduciary relationships;</li>
                        <li>that is harmful, abusive, unlawful, threatening, harassing, defamatory, pornographic, libellous, invasive of another&rsquo;s privacy or other rights, or harms or could harm minors in any way;</li>
                        <li>that harasses, degrades, intimidates or is hateful toward an individual or group of individuals on the basis of religion, gender, sexual orientation, race, ethnicity, age, or disability;</li>
                        <li>that includes personal or identifying information about another person without that person&rsquo;s explicit consent;</li>
                        <li>that impersonates any person or entity, including, but not limited to, an Iscube International Company Ltd employee, or falsely states or otherwise misrepresents an affiliation with a person or entity;</li>
                        <li>that employs misleading email addresses, or forged headers or otherwise manipulated identifiers in order to disguise the origin of Content transmitted through the Service.</li>
                        </ul>
                        <p><strong><strong>&nbsp;</strong></strong></p>
                        <p><strong><strong>Copyright</strong></strong></p>
                        <p>All content included owned and operated by Iscube International Company Ltd such as text, graphics, logos, button icons, images etc belonging to Iscube International Company Ltd or its content suppliers and is protected by International copyright laws. All software used by Iscube International Company Ltd is the property of the Company.</p>
                        <p><strong><strong>Trademarks and use of Company name</strong></strong><strong><strong><br /></strong></strong>The Company name: ISCUBE International Company Ltd, Trademark, logos can only be used by obtaining written consent from the Company. Should it be approved by the Company then it must be clearly stated that the Member is an &ldquo;Independent Member user.&rdquo;</p>
                        <p><strong><strong>&nbsp;</strong></strong></p>
                        <p><strong><strong>Indemnification</strong></strong><strong><strong><br /></strong></strong>You agree to defend, indemnify and hold harmless ISCUBE International Company Ltd and its officers, subsidiaries, affiliates, successors, assigns, directors, officers, agents, service providers, suppliers and employees, from and against any and all claims, damages, obligations, losses, liabilities, costs or debt, and expenses (including but not limited to attorneys&rsquo; fees) arising from: (i) your use of and access to the Website and/or the Service; (ii) your violation of any term of these Terms; (iii) your violation of any third party right, including without limitation any copyright, trademark, trade secret or other property, or privacy right; or (iv) any claim that your Content caused damage to a third party. This defence and indemnification obligation will survive termination, modification or expiration of these Terms and your use of the Service and the Website.</p>
                        <p><strong><strong>&nbsp;</strong></strong></p>
                        <p><strong><strong>Updating&nbsp;these Terms and Conditions</strong></strong></p>
                        <p>We reserve the right to change, modify, add to or remove from portions or the whole of these Terms and Conditions from time to time. Changes to these Terms and Conditions will become effective upon such changes being posted to this Website. It is the User&rsquo;s obligation to periodically check these Terms and Conditions at the Website for changes or updates. The User&rsquo;s continued use of this Website following the posting of changes or updates will be considered notice of the User&rsquo;s acceptance to abide by and be bound by these Terms and Conditions, including such changes or updates.</p>
                        <p><strong><strong>Acceptance of Terms &amp; Conditions</strong></strong></p>
                        <p>By completing your registration with ISCUBE and by creating a Member account you are confirming that you have read this agreement and agree to all the conditions herein.</p>
                        <p><strong><strong>Company Contact Details</strong></strong><strong><strong><br /></strong></strong><strong><strong>Registered Address</strong></strong>: 11 Aiyetoro Street, BQ Flat, Aguda Surulere, Lagos, Nigeria.<br /><strong><strong>Email address</strong></strong>:&nbsp;<a href="mailto:info@iscubenetworks.com">info@iscubenetworks.com<br /></a><strong><strong>Phone numbers</strong></strong>: +2348112237055</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalPrivacy" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                    <div class="modal-header">
                            <h5 class="modal-title">Privacy Policy</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        {{-- <p>Privacy Policy</p> --}}
                        <p>At ISCUBE we are committed to protecting your privacy. This privacy policy is applicable to all the web pages on this website.</p>
                        <p>All the information gathered in the online form on the website is used to personally identify users that subscribe to this service. The information will not be used for anything other than that which is stated in the Terms &amp; Conditions of use for this service. We will not sell any information provided or made available to us to anyone.</p>
                        <p>The Site may collect certain information about your visit, such as the name of the Internet service provider and the Internet Protocol (IP) address through which you access the Internet; the date and time you access the Site; the pages that you access while at the Site and the Internet address of the Web site from which you linked directly to our site. This information is used to help improve the Site, analyze trends, and administer the Site.</p>
                        <p><em><em>We may need to change this policy from time to time in order to address new issues and reflect changes on our site</em></em>. We may post those changes here so that you will always know what information we gather, how we might use that information, and whether we will disclose that information to anyone. Please refer back to this policy regularly. If you have any questions or concerns about our privacy policy, please send us an E-mail.</p>
                        <p>By using this website, you signify your acceptance of our Privacy Policy. If you do not agree to this policy, please do not use our site. Your continued use of the website following the posting of changes to these terms will mean that you accept those changes.</p>
                        <p><strong><strong>Cookie/Tracking Technology</strong></strong></p>
                        <p>The Site may use cookie and tracking technology depending on the features offered. Cookie and tracking technology are useful for gathering information such as browser type and operating system, tracking the number of visitors to the Site, and understanding how visitors use the Site. Cookies can also help customize the Site for visitors. Personal information cannot be collected via cookies and other tracking technology; however, if you previously provided personally identifiable information, cookies may be tied to such information. Aggregate cookie and tracking information may be shared with third parties.<strong><strong>&nbsp;</strong></strong></p>
                        <p><strong><strong>Third Party Links</strong></strong></p>
                        <p>In an attempt to provide increased value to our Users, we may provide links to other websites or resources. You acknowledge and agree that we are not responsible or liable, directly or indirectly, for the privacy practices or the content (including misrepresentative or defamatory content) of such websites, including (without limitation) any advertising, products or other materials or services on or available from such websites or resources, nor for any damage, loss or offence caused or alleged to be caused by, or in connection with, the use of or reliance on any such content, goods or services available on such external sites or resources.</p>
                        <p>&nbsp;</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#exampleModal').on('show.bs.modal', event => {
            var button = $(event.relatedTarget);
            var modal = $(this);
            // Use above variables to manipulate the DOM

        });
    </script>
</div>
@endsection

@section('scripts')
    <script>
        function fetchReferralInfo() {
            referral_username = $('input[name="referrer"]').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method: "GET",
                url: '{{ url("/fetch-user-info") }}',
                data: { referrer: referral_username }
            })
            .fail(function (error) {
                $("#submit").attr("disabled", true);
                $('#referrer_info').html("<b class='text-danger'>User not found</b>");
            })
            .done(function( msg ) {
                $("#submit").attr("disabled", false);
                data = JSON.parse(msg)
                $('#referrer_info').html("<b class='text-success'>You were referred by: </b><b>" + data.fname + " " + data.lname + "</b>");
            });
        }

        function confirmUniqueUsername() {
            username = $('input[name="username"]').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method: "GET",
                url: '{{ url("/is-username-unique") }}',
                data: { username: username }
            })
            .fail(function (error) {
                $("#submit").attr("disabled", false);
                $('#unique_username').html("<b class='text-success'>Username available!</b>");
            })
            .done(function( msg ) {
                $("#submit").attr("disabled", true);
                $('#unique_username').html("<b class='text-danger'>Username already taken!</b>");
            });
        }

        function confirmUniqueEmail() {
            email = $('input[name="email"]').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method: "GET",
                url: '{{ url("/is-email-unique") }}',
                data: { email: email }
            })
            .fail(function (error) {
                $("#submit").attr("disabled", false);
                $('#unique_email').html("<b class='text-success'>E-mail available!</b>");
            })
            .done(function( msg ) {
                $("#submit").attr("disabled", true);
                $('#unique_email').html("<b class='text-danger'>E-mail already used!</b>");
            });
        }
    </script>
@endsection
