jQuery(document).ready(function($) {
    $('#return-request-form').on('submit', function(e) {
        e.preventDefault();
        var data = $(this).serialize();
        $.post(wrm_ajax.ajax_url, data, function(response) {
            alert(response.data);
        });
    });
});
