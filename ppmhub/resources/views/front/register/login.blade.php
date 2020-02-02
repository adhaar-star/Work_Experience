@extends('layout.userpanel_nomenu')
@section('title','User | Login')

@section('body')
<style>
    #service {
        background-color: #0ca3d2;
    }
    .register-section {
        background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
        border-left: 0 none;
    }


    .login {
        position: relative;
        margin: 0 auto;
        padding: 20px 20px 20px;
        width: 340px;
        background: white;
        border-radius: 3px;
        -webkit-box-shadow: 0 0 200px rgba(255, 255, 255, 0.5), 0 1px 2px rgba(0, 0, 0, 0.3);
        box-shadow: 0 0 200px rgba(255, 255, 255, 0.5), 0 1px 2px rgba(0, 0, 0, 0.3);
    }
    .login:before {
        content: '';
        position: absolute;
        top: -8px;
        right: -8px;
        bottom: -8px;
        left: -8px;
        z-index: -1;
        background: rgba(0, 0, 0, 0.08);
        border-radius: 4px;
    }
    .login h1 {
        margin: -20px -20px 21px;
        line-height: 40px;
        font-size: 15px;
        font-weight: bold;
        color: #555;
        text-align: center;
        text-shadow: 0 1px white;
        background: #f3f3f3;
        border-bottom: 1px solid #cfcfcf;
        border-radius: 3px 3px 0 0;
        background-image: -webkit-linear-gradient(top, whiteffd, #eef2f5);
        background-image: -moz-linear-gradient(top, whiteffd, #eef2f5);
        background-image: -o-linear-gradient(top, whiteffd, #eef2f5);
        background-image: linear-gradient(to bottom, whiteffd, #eef2f5);
        -webkit-box-shadow: 0 1px whitesmoke;
        box-shadow: 0 1px whitesmoke;
    }
    .login p {
        margin: 20px 0 0;
    }
    .login p:first-child {
        margin-top: 0;
    }
    .login input[type=text], .login input[type=password] {
        width: 278px;
    }
    .login p.remember_me {
        float: left;
        line-height: 31px;
    }
    .login p.remember_me label {
        font-size: 12px;
        color: #777;
        cursor: pointer;
    }
    .login p.remember_me input {
        position: relative;
        bottom: 1px;
        margin-right: 4px;
        vertical-align: middle;
    }
    .login p.submit {
        text-align: right;
    }

    .login-help {
        margin: 20px 0;
        font-size: 11px;
        color: white;
        text-align: center;
        text-shadow: 0 1px #2a85a1;
    }
    .login-help a {
        color: #cce7fa;
        text-decoration: none;
    }
    .login-help a:hover {
        text-decoration: underline;
    }
    input {
        font-family: 'Lucida Grande', Tahoma, Verdana, sans-serif;
        font-size: 14px;
    }

    input[type=text], input[type=password] {
        margin: 5px;
        padding: 0 10px;
        width: 200px;
        height: 34px;
        color: #404040;
        background: white;
        border: 1px solid;
        border-color: #c4c4c4 #d1d1d1 #d4d4d4;
        border-radius: 2px;
        outline: 5px solid #eff4f7;
        -moz-outline-radius: 3px;
        -webkit-box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.12);
        box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.12);
    }
    input[type=text]:focus, input[type=password]:focus {
        border-color: #7dc9e2;
        outline-color: #dceefc;
        outline-offset: 0;
    }

    input[type=submit] {
        padding: 0 18px;
        height: 29px;
        font-size: 12px;
        font-weight: bold;
        color: #527881;
        text-shadow: 0 1px #e3f1f1;
        background: #cde5ef;
        border: 1px solid;
        border-color: #b4ccce #b3c0c8 #9eb9c2;
        border-radius: 16px;
        outline: 0;
        -webkit-box-sizing: content-box;
        -moz-box-sizing: content-box;
        box-sizing: content-box;
        background-image: -webkit-linear-gradient(top, #edf5f8, #cde5ef);
        background-image: -moz-linear-gradient(top, #edf5f8, #cde5ef);
        background-image: -o-linear-gradient(top, #edf5f8, #cde5ef);
        background-image: linear-gradient(to bottom, #edf5f8, #cde5ef);
        -webkit-box-shadow: inset 0 1px white, 0 1px 2px rgba(0, 0, 0, 0.15);
        box-shadow: inset 0 1px white, 0 1px 2px rgba(0, 0, 0, 0.15);
    }
    input[type=submit]:active {
        background: #cde5ef;
        border-color: #9eb9c2 #b3c0c8 #b4ccce;
        -webkit-box-shadow: inset 0 0 3px rgba(0, 0, 0, 0.2);
        box-shadow: inset 0 0 3px rgba(0, 0, 0, 0.2);
    }

    .otp-section {
        float: left;
        padding: 50px;
        position: relative;
        text-align: center;
        width: 100%;
    }
    .otp-section h4 {
        color: #fff;
        font-size: 20px;
        font-weight: 500;
        margin: 40px 0;
        position: relative;
    }
    .otp-img img {
        margin: 0 auto 30px;
        width: 30%;
    }
    .otp-input input {
        border:3px solid transparent;
        border-bottom: 3px dashed red;
        height: 50px;
        margin: auto auto 30px;
        outline: 0 none;
        width: 40%;
        background: transparent;
        box-shadow: none;
    }
    .otp-input input:focus {
        border:3px solid transparent;
        border-bottom: 3px dashed red;
    }
    .resend-otp p {
        color: #ccc;
        font-size: 16px;
        margin-bottom: 20px;
    }
    .resend-otp a {
        color: #e64000;
        font-size: 15px;
        font-weight: 700;
        position: relative;
    }
    .otp-submit input[type="submit"] {
        background: #e64000 none repeat scroll 0 0;
        border: 1px solid red;
        border-radius: 0;
        box-shadow: none;
        color: #fff;
        font-size: 16px;
        margin-bottom: 20px;
        padding: 4px 20px;
        text-shadow: none;
    }
</style>
<section id="service" class="section-padding">
    <div class="container">

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">

                <div class="register-section" style="display:block;">
                    <!--div class="login-icon">
                            <h3>Sign In to your Crystal PPM Account</h3>
                    </div-->
                    <div class="register-form1">

                        @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        @if (Session::has('message'))
                        <div class="alert alert-danger">
                            <ul>
                                <li>{{Session::get('message') }}</li>
                            </ul>
                        </div>
                        @endif



                        <div class="login">
                            <h1>Login</h1>
                            <form method="post" action="{{url('checklogin')}}">
                                {{ csrf_field() }}
                                <p><input type="text" name="email" id="email" value="" placeholder="Enter Email"></p>
                                <p><input type="password" name="password" id="password" value="" placeholder="Password"></p>
                                <p class="remember_me">
                                    <label>
                                        <input type="checkbox" name="remember_me" id="remember_me">
                                        Remember me on this computer
                                    </label>
                                </p>
                                <p class="submit" id="submit-login"><input type="submit" name="commit" value="Login"></p>
                            </form>
                        </div>
                    </div>
                    <div class="login-help">
                        <p>Forgot your password? <a href="#">Click here to reset it</a>.</p>
                    </div>
                </div>

                <!--div class="otp-section" style="display:none;">
                        <div class="otp-title">
                                <h4>Enter the OTP sent to your registered phone number!</h4>
                        </div>
                        
                        <form>
                                <div class="otp-input">
                                        <input type="text" class="otp-input-field">
                                </div>	
                                <div class="otp-submit">
                                        <input type="submit" name="otp-commit" value="Submit OTP">
                                </div>
                        </form>
                        <div class="resend-otp">
                                <p>Didn't get the OTP? </p>
                                <a href="#">Resend OTP ></a>
                        </div>
                </div-->


            </div>
        </div>      
    </div>
</section>	

<script>
    /*jQuery("#submit-login").click(function(){
     jQuery(".register-section").css("display", "none");
     jQuery(".otp-section").css("display", "block");
     });*/
</script>
        
      
@endsection
