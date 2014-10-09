(function($){
	function carousel(target, page) {
		return (function() {
			var $car = $(".carousel[data-carousel='"+target+"']");
			var url = (page == 'login') ? '' : '?'+page;

			$car.find(".content-carousel.active").removeClass('active');
			$car.find(".content-carousel[data-page='"+page+"']").addClass('active');

			history.pushState({}, '', 'login.php'+url);
		});
	}

	$(document).ready(function(){
		$("#register-link").bind('click', carousel('login', 'register') );
		$("#password-link").bind('click', carousel('login', 'password') );
		$(".login-back").bind('click', carousel('login', 'login') );

		$(".button-toggle").bind('click', function(){
			$("#"+$(this).attr('data-toggle')).toggleClass('hidden');
		});
	});
})(jQuery);