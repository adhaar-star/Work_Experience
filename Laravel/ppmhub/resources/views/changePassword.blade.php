<!DOCTYPE html>
<html>
    <head lang="en">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Change password</title>

        <link href="../assets/common/img/favicon.144x144.png" rel="apple-touch-icon" type="image/png" sizes="144x144">
        <link href="../assets/common/img/favicon.114x114.png" rel="apple-touch-icon" type="image/png" sizes="114x114">
        <link href="../assets/common/img/favicon.72x72.png" rel="apple-touch-icon" type="image/png" sizes="72x72">
        <link href="../assets/common/img/favicon.57x57.png" rel="apple-touch-icon" type="image/png">
        <link href="../assets/common/img/favicon.png" rel="icon" type="image/png">
        <link href="favicon.ico" rel="shortcut icon">

        <!-- HTML5 shim and Respond.js for < IE9 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Vendors Styles -->
        <!-- v1.0.0 -->
        <link rel="stylesheet" type="text/css" href="{{asset('vendors/bootstrap/dist/css/bootstrap.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('vendors/jscrollpane/style/jquery.jscrollpane.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('vendors/assets/vendors/ladda/dist/ladda-themeless.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('vendors/assets/vendors/select2/dist/css/select2.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('vendors/assets/vendors/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('vendors/assets/vendors/fullcalendar/dist/fullcalendar.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('vendors/assets/vendors/cleanhtmlaudioplayer/src/player.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('vendors/assets/vendors/cleanhtmlvideoplayer/src/player.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('vendors/assets/vendors/bootstrap-sweetalert/dist/sweetalert.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('vendors/assets/vendors/summernote/dist/summernote.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('vendors/assets/vendors/owl.carousel/dist/assets/owl.carousel.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('vendors/assets/vendors/ionrangeslider/css/ion.rangeSlider.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('vendors/assets/vendors/datatables/media/css/dataTables.bootstrap4.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('vendors/assets/vendors/c3/c3.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('vendors/assets/vendors/chartist/dist/chartist.min.css')}}">
        <!-- v1.4.0 -->
        <link rel="stylesheet" type="text/css" href="{{asset('vendors/nprogress/nprogress.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('vendors/jquery-steps/demo/css/jquery.steps.css')}}">
        <!-- v1.4.2 -->
        <link rel="stylesheet" type="text/css" href="{{asset('vendors/bootstrap-select/dist/css/bootstrap-select.min.css')}}">
        <!-- v1.7.0 -->
        <link rel="stylesheet" type="text/css" href="{{asset('vendors/dropify/dist/css/dropify.min.css')}}">

        <!-- Clean UI Styles -->
        <link rel="stylesheet" type="text/css" href="{{asset('vendors/common/css/source/main.css')}}">

        <!-- Vendors Scripts -->
        <!-- v1.0.0 -->
        <script src="{{asset('vendors/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('vendors/tether/dist/js/tether.min.js')}}"></script>
        <script src="{{asset('vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('vendors/jquery-mousewheel/jquery.mousewheel.min.js')}}"></script>
        <script src="{{asset('vendors/jscrollpane/script/jquery.jscrollpane.min.js')}}"></script>
        <script src="{{asset('vendors/spin.js/spin.js')}}"></script>
        <script src="{{asset('vendors/ladda/dist/ladda.min.js')}}"></script>
        <script src="{{asset('vendors/select2/dist/js/select2.full.min.js')}}"></script>
        <script src="{{asset('vendors/html5-form-validation/dist/jquery.validation.min.js')}}"></script>
        <script src="{{asset('vendors/jquery-typeahead/dist/jquery.typeahead.min.js')}}"></script>
        <script src="{{asset('vendors/jquery-mask-plugin/dist/jquery.mask.min.js')}}"></script>
        <script src="{{asset('vendors/autosize/dist/autosize.min.js')}}"></script>
        <script src="{{asset('vendors/bootstrap-show-password/bootstrap-show-password.min.js')}}"></script>
        <script src="{{asset('vendors/moment/min/moment.min.js')}}"></script>
        <script src="{{asset('vendors/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js')}}"></script>
        <script src="{{asset('vendors/fullcalendar/dist/fullcalendar.min.js')}}"></script>
        <script src="{{asset('vendors/cleanhtmlaudioplayer/src/jquery.cleanaudioplayer.js')}}"></script>
        <script src="{{asset('vendors/cleanhtmlvideoplayer/src/jquery.cleanvideoplayer.js')}}"></script>
        <script src="{{asset('vendors/bootstrap-sweetalert/dist/sweetalert.min.js')}}"></script>
        <script src="{{asset('vendors/remarkable-bootstrap-notify/dist/bootstrap-notify.min.js')}}"></script>
        <script src="{{asset('vendors/summernote/dist/summernote.min.js')}}"></script>
        <script src="{{asset('vendors/owl.carousel/dist/owl.carousel.min.js')}}"></script>
        <script src="{{asset('vendors/ionrangeslider/js/ion.rangeSlider.min.js')}}"></script>
        <script src="{{asset('vendors/nestable/jquery.nestable.js')}}"></script>
        <script src="{{asset('vendors/datatables/media/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('vendors/datatables/media/js/dataTables.bootstrap4.min.js')}}"></script>
        <script src="{{asset('vendors/datatables-fixedcolumns/js/dataTables.fixedColumns.js')}}"></script>
        <script src="{{asset('vendors/datatables-responsive/js/dataTables.responsive.js')}}"></script>
        <script src="{{asset('vendors/editable-table/mindmup-editabletable.js')}}"></script>
        <script src="{{asset('vendors/d3/d3.min.js')}}"></script>
        <script src="{{asset('vendors/c3/c3.min.js')}}"></script>
        <script src="{{asset('vendors/chartist/dist/chartist.min.js')}}"></script>
        <script src="{{asset('vendors/peity/jquery.peity.min.js')}}"></script>
        <!-- v1.0.1 -->
        <script src="{{asset('vendors/chartist-plugin-tooltip/dist/chartist-plugin-tooltip.min.js')}}"></script>
        <!-- v1.1.1 -->
        <script src="{{asset('vendors/gsap/src/minified/TweenMax.min.js')}}"></script>
        <script src="{{asset('vendors/hackertyper/hackertyper.js')}}"></script>
        <script src="{{asset('vendors/jquery-countTo/jquery.countTo.js')}}"></script>
        <!-- v1.4.0 -->
        <script src="{{asset('vendors/nprogress/nprogress.js')}}"></script>
        <script src="{{asset('vendors/jquery-steps/build/jquery.steps.min.js')}}"></script>
        <!-- v1.4.2 -->
        <script src="{{asset('vendors/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>
        <script src="{{asset('vendors/chart.js/src/Chart.bundle.min.js')}}"></script>
        <!-- v1.7.0 -->
        <script src="{{asset('vendors/dropify/dist/js/dropify.min.js')}}"></script>

        <!-- Clean UI Scripts -->
        <script src="{{asset('vendors/common/js/common.js')}}"></script>
        <script src="{{asset('vendors/common/js/demo.temp.js')}}"></script>
        <!-- live chat js -->
        <script type="text/javascript" src="http://www.ppmhub.com.au/public/jarvis/widget"></script>

    {!! Html::script('/js/jquery.validate.min.js') !!}
    {!! Html::script('/js/changepassword_validation.js') !!}
    </head>
    <body class="theme-default">

        <section class="page-content">
            <div class="page-content-inner" style="background-image: url({{asset('vendors/common/img/temp/login/4.jpg)')}}">

                <!-- Login Omega Page -->
                <div class="single-page-block-header">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="logo">
                                <a href="javascript: history.back();">
                                    <img src="{{asset('vendors/common/img/ppm_logo.png')}}" alt="Clean UI Admin Template" />
                                </a>
                            </div>
                        </div>                        
                    </div>
                </div>
                <div class="single-page-block">
                    <div class="single-page-block-inner effect-3d-element">
                        <div class="blur-placeholder"><!-- --></div>
                        <div class="single-page-block-form">
                            <h3 class="text-center">
                                <!--<i class="icmn-enter margin-right-10"></i>-->
                                Change Password
                            </h3>                           
                            <form id="changepassword" name="changepassword" method="POST" action="{{url('admin/changepassword')}}" >
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <!--<input id="validation-email" class="form-control" placeholder="Email or Username" name="email" type="text" data-validation="[EMAIL]">-->
                                    <div class="form-group">
                                        <input id="password"
                                               class="form-control password"
                                               name="password"
                                               type="password" 
                                               placeholder="Password">
                                        @if($errors->first('password'))
                                        <div style="color:red">
                                            {{$errors->first('password')}}
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input id="confirm_password"
                                           class="form-control password"
                                           name="confirm_password"
                                           type="password" 
                                           placeholder="Confirm Password">
                                    @if($errors->first('confirm_password'))
                                    <div style="color:red">
                                        {{$errors->first('confirm_password')}}
                                    </div>
                                    @endif
                                </div>
                                <div class="form-group">                                    
                                </div>
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-primary width-150">Save Password</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>                
                <!-- End Login Omega Page -->
            </div>
            <script type="text/javascript">
$(function () {
    $('#form-validation').click(function () {
        $('#loginform').submit();
    })
})
            </script>
            <!-- Page Scripts -->
            <script>
                $(function () {

                    // Add class to body for change layout settings
                    $('body').addClass('single-page single-page-inverse');

                    // Form Validation
                    $('#form-validation').validate({
                        submit: {
                            settings: {
                                inputContainer: '.form-group',
                                errorListClass: 'form-control-error',
                                errorClass: 'has-danger'
                            }
                        }
                    });

                    // Show/Hide Password
                    $('.password').password({
                        eyeClass: '',
                        eyeOpenClass: 'icmn-eye',
                        eyeCloseClass: 'icmn-eye-blocked'
                    });

                    // Set Background Image for Form Block
                    function setImage() {
                        var imgUrl = $('.page-content-inner').css('background-image');

                        $('.blur-placeholder').css('background-image', imgUrl);
                    }
                    ;

                    function changeImgPositon() {
                        var width = $(window).width(),
                                height = $(window).height(),
                                left = -(width - $('.single-page-block-inner').outerWidth()) / 2,
                                top = -(height - $('.single-page-block-inner').outerHeight()) / 2;


                        $('.blur-placeholder').css({
                            width: width,
                            height: height,
                            left: left,
                            top: top
                        });
                    }
                    ;

                    setImage();
                    changeImgPositon();

                    $(window).on('resize', function () {
                        changeImgPositon();
                    });

                    // Mouse Move 3d Effect
                    var rotation = function (e) {
                        var perX = (e.clientX / $(window).width()) - 0.5;
                        var perY = (e.clientY / $(window).height()) - 0.5;
                        TweenMax.to(".effect-3d-element", 0.4, {rotationY: 15 * perX, rotationX: 15 * perY, ease: Linear.easeNone, transformPerspective: 1000, transformOrigin: "center"})
                    };

                    if (!cleanUI.hasTouch) {
                        $('body').mousemove(rotation);
                    }

                });
            </script>
            <!-- End Page Scripts -->
        </section>

        <div class="main-backdrop"><!-- --></div>

    </body>
</html>