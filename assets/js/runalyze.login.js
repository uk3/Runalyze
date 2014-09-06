(function($){
	$(document).ready(function(){
		$("#register-link").bind('click', function(){
			$("#register").removeClass('hidden');
			$("#login").css('margin-top', -$("#login").outerHeight());
		});

		$("#password-link").bind('click', function(){
			$("#password").removeClass('hidden');
			$("#login").css('margin-top', -$("#login").outerHeight());
		});

		$("#register .login-back, #password .login-back").bind('click', function(){
			$("#register, #password").addClass('hidden');
			$("#login").css('margin-top', 0);
		});

		$(".button-toggle").bind('click', function(){
			$("#"+$(this).attr('data-toggle')).toggleClass('hidden');
		});

		if ($("#login").is('.hidden')) {
			$("#login").css('margin-top', -$("#login").outerHeight()).removeClass('hidden');
		}
	});
})(jQuery);