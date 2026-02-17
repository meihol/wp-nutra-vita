(function ($) {
    "use strict";

    function createCookie(name, value, days) {
        var expires;

        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = "; expires=" + date.toGMTString();
        } else {
            expires = "";
        }
        document.cookie = encodeURIComponent(name) + "=" + encodeURIComponent(value) + expires + "; path=/";
    }

    $(window).on('elementor/frontend/init', () => {
        elementorFrontend.hooks.addAction('frontend/element_ready/ekommart-deal-topbar.default', ($scope) => {
            $(document).ready(function () {
                var $topbar = $scope.find('.ekommart-deal-topbar'),
                    $close = $scope.find('.deal-topbar-close');
                setTimeout(function () {
                    $topbar.show();
                },1500);

                $close.click(function(e){
                    e.preventDefault();
                    $topbar.addClass('hide-up');
                    createCookie('deal-topbar-hide', false, 1);
                });
            });

        });
    });

})(jQuery);