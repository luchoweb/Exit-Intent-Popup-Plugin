function getCookie(name) {
  const value = `; ${document.cookie}`;
  const parts = value.split(`; ${name}=`);
  if (parts.length === 2) return parts.pop().split(";").shift();
}

function setPopupCookie() {
  const maxAge = 60 * 60 * 24 * 30;
  document.cookie = `exit-intent=opened;max-age=${maxAge};path=/`;
}

(function ($) {
  $.ajax({
		type: "GET",
		url: my_ajax_object.ajax_url,
		data: {
			action: "get_popup_data",
		},
		dataType: "json",
		success: function (response) {
			$(".exit-intent-popup__title").text(response.title);
			$(".exit-intent-popup__subhead").text(response.subhead);
			$(".exit-intent-popup__content").text(response.content);
			$(".exit-intent-popup__col--img img").attr("src", response.image);
		},
		error: function (response) {
			console.error(response.statusText);
			return false;
		},
	});

  const mailFormat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/g;

  $.exitIntent("enable");

  $(document).bind("exitintent", function () {
    const hasPopupCookie = getCookie("exit-intent");

    if (!hasPopupCookie) $(".exit-intent-popup").addClass("opened");

    $(".js-close-popup").on("click", function () {
      $(".exit-intent-popup").removeClass("opened");
      setPopupCookie();
    });

    $(".js-popup-register").on("click", function () {
      const email = $("#email").val().trim();

      if (!email.match(mailFormat)) {
        $(".js-form-input").addClass("error");
        $(".js-form-error").slideDown();
        return;
      }

      location.assign(`/register?email=${email}`);
      setPopupCookie();
    });

    $(".js-form-input").on("keyup", function () {
      if (!$(this).val().match(mailFormat)) {
        $(this).addClass("error");
        $(".js-form-error").slideDown();
      } else {
        $(this).removeClass("error");
        $(".js-form-error").slideUp();
      }
    });
  });
})(jQuery);
