jQuery(document).ready(function($) {

	var formid;
	var formid_long;


	document.addEventListener('wpcf7mailsent', function( event ) {

		var id_long =	event.detail.id;
		var id 		= 	event.detail.contactFormId;

		var formid = id_long;
		var formid = id;

		var forms = ajax_object_cf7ccav.forms;
		var is_ccavenue = forms.indexOf(id+'|ccavenue');
		var path = ajax_object_cf7ccav.path+id;


		var gateway;

		var data = {
			'action':	'cf7ccav_get_form_post',
		};

		jQuery.ajax({
			type: "GET",
			data: data,
			dataType: "json",
			async: false,
			url: ajax_object_cf7ccav.ajax_url,
			xhrFields: {
				withCredentials: true
			},
			success: function (response) {
				gateway = response.gateway;
			}
		});


		// gateway chooser
		if (gateway != null) {

			// ccavenue
			if (is_ccavenue > -1 && gateway == 'ccavenue') {

				var data = {
					'action':	'cf7ccav_get_form_ccavenue',
				};

				jQuery.ajax({
					type: "GET",
					data: data,
					dataType: "json",
					async: false,
					url: ajax_object_cf7ccav.ajax_url,
					xhrFields: {
						withCredentials: true
					},
					success: function (response) {
						console.log(response);
						jQuery('#'+id_long).html(response.html);

					}
				});

			}
		}
	})

});