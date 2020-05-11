 jQuery(document).ready(function($) {
	 $('.block-3_sliders').slick({
	    nextArrow: '<img class="slick-btn-next" src="assets/img/next.png" alt="next">',
	    prevArrow: '<img class="slick-btn-prev" src="assets/img/prev.png" alt="prev">',
	    slidesToShow: 3,
	    slidesToScroll: 1,
	    dots:false,
	    infinite: true
	 });

	 $('.block-4_sliders').slick({
	    nextArrow: '<img class="slick-btn-next_2" src="assets/img/next.png" alt="next">',
	    prevArrow: '<img class="slick-btn-prev_2" src="assets/img/prev.png" alt="prev">',
	    slidesToShow: 2,
	    slidesToScroll: 1,
	    dots:false,
	    infinite: true
	 });

	 // $('.pop-up').magnificPopup();

	 $('.pop-up').magnificPopup({
		type: 'inline',
		preloader: false,
		focus: '#name',

		// When elemened is focused, some mobile browsers in some cases zoom in
		// It looks not nice, so we disable it:
		callbacks: {
			beforeOpen: function() {
				if($(window).width() < 700) {
					this.st.focus = false;
				} else {
					this.st.focus = '#name';
				}
			}
		}
	});



	 $("#popup-form").submit(function() {
		 var login = $("#login").val().trim();
		 var password = $("#password").val().trim();

		 $.ajax({
			 url: '/vendor/signin.php',
			 type: "POST",
			 cache: false,
			 data: {'login': login, 'password':password},
			 beforeSend: function () {
				 $("#btn").prop("disabled", true);
			 },
			 success: function (data) {
			 	if(!data)
			 		alert("Ошибка авторизации!");
			 	else {
					$("#popup-form").trigger("reset");
					$(".mfp-close").click();
					location.reload();
				}
				 $("#btn").prop("disabled", false);
			 }
		 });


		 return false;
	 });


 });


