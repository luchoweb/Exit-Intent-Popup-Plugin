jQuery(document).ready(function () {
  jQuery("#popup-form").on("submit", function (event) {
    event.preventDefault();

		jQuery(".form-btn").attr("disabled", "disabled");
    jQuery(".alert-error").hide();

    const title = jQuery("#popup-title").val();
    const subhead = jQuery("#popup-subhead").val();
    const content = jQuery("#popup-content").val();
    const image = jQuery("#popup-image").val();

    const data = {
      action: "submit_popup_data",
      title,
      subhead,
      content,
      image,
    };

    if (title && subhead && content && image) {
      jQuery.ajax({
        type: "POST",
        url: ajaxurl,
        data: data,
        dataType: "html",
        success: function (response) {
          jQuery(".alert-error").hide();
          jQuery(".alert-success").text("Changes are saved!").show();
        },
        error: function (response) {
          jQuery(".alert-error")
            .text(`${response.statusText}. Please try again.`)
            .show();
          jQuery(".alert-success").hide();
          return false;
        },
      });
    } else {
			jQuery(".alert-success").hide();
      jQuery(".alert-error").text("All fields are required!").show();
    }

		jQuery(".form-btn").removeAttr("disabled");
  });

	jQuery.ajax({
		type: "GET",
		url: ajaxurl,
		data: {
			action: "get_popup_data",
		},
		dataType: "json",
		success: function (response) {
			jQuery("#popup-title").val(response.title);
			jQuery("#popup-subhead").val(response.subhead);
			jQuery("#popup-content").val(response.content);
			jQuery("#popup-image").val(response.image);
      jQuery(".js-loading-msg").hide();
      jQuery("#popup-form").show();
		},
		error: function (response) {
      jQuery(".alert-error").text(response.statusText).show();
			return false;
		},
	});
});
