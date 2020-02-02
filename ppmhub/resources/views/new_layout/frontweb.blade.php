<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8"/>
        <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
        <title>Online Project Planning Software | @yield('title')</title>
        <!-- Favicon | Icon Script -->
        <link rel="icon" type="image/png" href="{{asset('new_images/common/icon.png')}}" />
        <!-- Material UI Stylesheet -->
        <link href="{{asset('font-awesome-4.7.0/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('materialize/css/materialize.min.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('new_css/common.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('new_css/frontweb.css')}}" rel="stylesheet" type="text/css"/>
        <script async
        src="https://www.googletagmanager.com/gtag/js?id={{env('GOOGLE_ANALYTICS_APP_KEY')}}"></script>
        <script>
window.dataLayer = window.dataLayer || [];
function gtag() {
    dataLayer.push(arguments)
}
;
gtag('js', new Date());

gtag('config', '{{env("GOOGLE_ANALYTICS_APP_KEY")}}');
        </script>
    </head>
    <body>
        <header>
            <div class="container-wide">
                <div class="left">
                    <a href="{{url('/')}}" class="logo"><img src="{{asset('new_images/common/logo.png')}}" width="140"></a>
                </div>
                <div class="right hide-on-large-only mobile-menu-icon">
                    <i class="fa fa-bars" aria-hidden="true"></i>
                </div>
                <div class="right nav-container">
                    <div class="hide-on-large-only mobile-menu-close">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </div>
                    <nav class="z-depth-0">
                        <ul>
                            <li>
                                <a href="#">Features</a>
                            </li>
                            <li>
                                <a href="{{url('/pricing')}}">Pricing</a>
                            </li>
                            <li>
                                <a href="#">How it Works</a>
                            </li>
                            <li>
                                <a href="#">Customers</a>
                            </li>
                            <li>
                                <a href="#">Support</a>
                            </li>
                            <li>
                                <a href="#" class="btn-login waves-effect">Login</a>
                            </li>
                            <li>
                                <a class="btn login-btn waves-effect" href="{{url('register')}}">Register</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </header>

        <!-- Start of Content -->
        @section('body')
        @show
        <!-- End of Content -->

        <!-- Login and Register Model -->
        <div id="login-register" class="modal">
            <div class="modal-content">
                <div class="row">
                    <div class="col s12">
                        <ul class="tabs">
                            <li class="tab col s12"><a class="active" href="#login">Login</a></li>
                            <li class="tab col s6" style="display: none;"><a href="#register">Register</a></li>
                        </ul>
                    </div>
                    <div id="login" class="col s12">
                        <form id="login-form" method="post" action="{{url('api/v1/checklogin')}}">
                            <div class="row">
                                <div class="input-field col s12">
                                    <input type="email" name="email" id="email" />
                                    <label for="email">Email ID</label>
                                </div>
                                <div class="input-field col s12">
                                    <input type="password" name="password" id="password" />
                                    <label for="password">Password</label>
                                </div>
                                <div class="input-field col s12">
                                    <button type="submit" class="btn waves-effect">Login</button>
                                    <a class="btn-flat waves-effect modal-close">Cancel</a>
                                    <a class="tab col s6 waves-effect" href="/register">Sign Up ?</a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div id="register" class="col s12" style="display:none;">
                        <form id="register-form" method="post" action="{{url('api/v1/store')}}">
                            <div class="input-field col s12 m6">
                                <input type="text" name="name" id="firstname" />
                                <label for="firstname">Firstname</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <input type="text" name="lname" id="lastname" />
                                <label for="lastname">Lastname</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <input type="text" name="company_name" id="companyname" />
                                <label for="companyname">Company Name</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <input type="text" name="web" id="web" />
                                <label for="web">Website</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <input type="text" name="email" id="emailid" />
                                <label for="emailid">Email Address</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <input type="text" name="phone" maxlength="9" id="phone" />
                                <label for="phone">Phone Number (+61)</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <input type="password" name="password" id="pass" />
                                <label for="pass">Password</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <input type="password" name="confirm_password" id="repass" />
                                <label for="repass">Repeat Password</label>
                            </div>
                            <div class="col s12">
                                <p>
                                    <input type="checkbox" class="filled-in" name="agree" id="agree" />
                                    <label for="agree">I agree with our terms and conditions</label>
                                </p>
                            </div>
                            <div class="input-field col s12">
                                <button type="submit" class="btn waves-effect">Register</button>
                                <a class="btn-flat waves-effect modal-close">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="otp" class="modal">
        <div class="modal-content">
            <div class="row">
                <div class="col s12">
                    <form id="otp-form" method="post" action="">
                        <div class="col s12">
                            <p>Enter the OTP sent to your registered phone number!</p>
                        </div>
                        <div class="input-field col s12">
                            <input type="text" name="verify_code" id="verify_code">
                            <label for="verify_code">OTP</label>
                        </div>
                        <div class="input-field col s12">
                            <button type="submit" class="btn waves-effect">Submit</button>
                            <a class="btn-flat waves-effect modal-close">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <div class="container" >
            <div class="row">
                <div class="col s12 m4 hmenu-list">
                    <h6 class="clm-title">KSA Tech</h6>
                    <a target="_blank" href="http://ksatech.com.au/">Home</a>
                    <a target="_blank" href="http://www.ksatech.com.au/contact-2/">Contact</a>
                    <a target="_blank" href="http://www.ksatech.com.au/privacy-policy">Privacy Policy</a>
                </div>
                <div class="col s12 m4 social-media-links">
                    <h6 class="clm-title">Connect With Us</h6>
                    <a target="_blank" href="https://www.facebook.com/ksatech" class="tooltipped" data-position="bottom" data-tooltip="Facebook" data-delay="50"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                    <a target="_blank" href="http://google.com/+KsatechAu" class="tooltipped" data-position="bottom" data-tooltip="Google+" data-delay="50"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
                    <a target="_blank" href="http://www.linkedin.com/company/ksa-tech-consulting" class="tooltipped" data-position="bottom" data-tooltip="Linkedin" data-delay="50"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                </div>
                <div class="col s12 m4 vmenu-list">
                    <h6 class="clm-title">Recent Blog Posts</h6>
                    <a target="_blank" href="http://www.ksatech.com.au/what-is-sap-portfolio-initiative/">What is SAP Portfolio Initiative?</a>
                    <a target="_blank" href="http://www.ksatech.com.au/how-can-sap-ppm-help-your-business/">How can SAP PPM help your business?</a>
                    <a target="_blank" href="http://www.ksatech.com.au/what-is-portfolio-item/">What is Portfolio Item?</a>
                    <a target="_blank" href="http://www.ksatech.com.au/project-progress-calculations/">Project Progress Calculations</a>
                    <a target="_blank" href="http://www.ksatech.com.au/sap-ppm-bucket/">What is SAP PPM Bucket?</a>
                </div>
                <div class="col s12 copyright-text">
                    <p><i>© Copyright 2015 KSA Tech</i></p>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery and Material UI JavaScripts -->
    <script src="{{asset('vendors/jquery/dist/jquery.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('materialize/js/materialize.min.js')}}" type="text/javascript"></script>
    <!-- Jarvis Live Chat JavaScript -->
    <!-- <script type="text/javascript" src="{{asset('jarvis/widget')}}"></script> -->
    <script src="{{asset('new_js/frontweb.js')}}" type="text/javascript"></script>
</body>
</html>
