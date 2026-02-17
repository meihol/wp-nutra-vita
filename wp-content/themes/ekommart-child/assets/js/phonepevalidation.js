jQuery(document).ready(function($) {
    $('#phonepeform').validate({
        rules: {
            billing_first_name: {
                required: true
            },
            billing_last_name: {
                required: true
            },
            billing_phonenumber: {
                required: true,
                digits: true,
                minlength: 10,
                maxlength: 10
            },
            billing_email: {
                required: true
            },
            amount: {
                required: true
            },
        },
        messages: {
            billing_first_name: {
                required: "Please enter first name"
            },
            billing_last_name: {
                required: "Please enter last name"
            },
            billing_phonenumber: {
                required: "Please enter phone number",
                digits: "Phone number don't have alphabets",
                minlength: "Please enter phone number properly",
                maxlength: "Please enter phone number properly"
            },
            billing_email: {
                required: "Please enter email"
            },
            amount: {
                required: "Please enter amount"
            },
        }
    })
})