@extends('layout.app')
@section('title','User | OTP Verify')

@section('body')
<style>
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

                <div class="register-section">
                    <div class="register-icon">
                        <h3>OTP Crystal PPM</h3>
                    </div>
                    <div class="register-form">

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


                        <div class="otp-section" >
                            <div class="otp-title">
                                <h4>Enter the OTP sent to your registered phone number!</h4>
                            </div>
                            <form action="<?php echo url('logincheckotp'); ?>/{{Request::segment(2)}}" method="POST">
                                {{ csrf_field() }}

                                <input type="hidden" name="id" value="{{Request::segment(2)}}"/> 
                                <div class="otp-input">
                                    <input type="text" name="verify_code" class="otp-input-field" value="" required>
                                </div>	
                                <div class="otp-submit">
                                    <input type="submit" name="otp-commit" value="Submit OTP">
                                </div>
                            </form>
                            <div class="resend-otp">
                                <p>Didn't get the OTP? </p>
                                <a href="#">Resend OTP ></a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>      
    </div>
</section>		




@endsection