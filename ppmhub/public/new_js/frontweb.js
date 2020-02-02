$(document).ready(function() {

	var ajaxOpt = {
		form: '',
		otpid: ''
	};

	// Onload Initialization

	resize_init();
	$('select').material_select();


	// jQuery Events

	$('header .mobile-menu-icon i').click(function() {
		$('header .nav-container').addClass('opened');
	});

	$('header .mobile-menu-close i').click(function() {
		$('header .nav-container').removeClass('opened');
	});

	$('section.top-bg .top-content .btn-try').click(function(e) {
		e.preventDefault();
		$('#login-register').modal('open');
		setTimeout(function() {
			$('ul.tabs').tabs('select_tab', 'register');
		}, 310);
	});

	$('header nav .btn-login').click(function(e) {
		e.preventDefault();
		$('#login-register').modal('open');
		setTimeout(function() {
			$('ul.tabs').tabs('select_tab', 'login');
		}, 310);
	});

	$('section.features .btn-try').click(function(e) {
		e.preventDefault();
		$('#login-register').modal('open');
		setTimeout(function() {
			$('ul.tabs').tabs('select_tab', 'register');
		}, 310);
	});

	$('#login-register form').submit(function(e) {
		e.preventDefault();
		ajaxOpt.form = $(this).parent().attr('id');
		$.ajax({
			url: $(this).attr('action'),
			method: 'POST',
			data: $(this).serialize(),
			success: function(data) {
				if(data.error == false) {
					ajaxOpt.otpid = data.pid;
					$('#otp-form').attr('action', data.otpurl);
					$('#otp').modal('open');
					$('#login-register').modal('close');
				} else if(data.error == true) {
					Materialize.toast(data.message, 4000, 'error-toast');
				}
			},
			statusCode: {
				422: function(errors) {
					for(i in errors.responseJSON) {
						Materialize.toast(errors.responseJSON[i][0], 4000, 'error-toast');
					}
				}
			}
		});
	});

	$('#otp-form').submit(function(e) {
		e.preventDefault();
		$.ajax({
			url: $(this).attr('action'),
			method: 'POST',
			data: $(this).serialize(),
			success: function(data) {
				if(data.error == false) {
					window.location.href = data.redirect;
				} else if(data.error == true) {
					Materialize.toast(data.message, 4000, 'error-toast');
				}
			},
			statusCode: {
				422: function(errors) {
					for(i in errors.responseJSON) {
						Materialize.toast(errors.responseJSON[i][0], 4000, 'error-toast');
					}
				}
			}
		});
	});


	// Resize Initialization

	$(window).resize(function() {
		resize_init();
	});


	// Scroll Activities

	$(window).scroll(function() {
		if(window.scrollY > 0) {
			$('header').addClass('scrolled');
		} else {
			$('header').removeClass('scrolled');
		}
	});
});

// Support Functions

function resize_init() {
	$('section.top-bg .top .top-content').css('min-height', ($(window).height()-70));
	if(window.scrollY > 0) {
		$('header').addClass('scrolled');
	} else {
		$('header').removeClass('scrolled');
	}
}