(function ($) {
    'use strict';

    function login_dropdown() {
        $('.site-header-account').mouseenter(function () {
            $('.account-dropdown', this).append($('.account-wrap'));
        });
    }

    function megamenu_dropdown() {
        $('.icon-down-megamenu').click(function () {
            $(this).toggleClass('selected').siblings('.mega-menu').toggleClass('open');
        });
    }

    megamenu_dropdown();
    login_dropdown();
})(jQuery);

// Disable right-click
document.addEventListener('contextmenu', (e) => e.preventDefault());

function ctrlShiftKey(e, keyCode) {
  return e.ctrlKey && e.shiftKey && e.keyCode === keyCode.charCodeAt(0);
}

document.onkeydown = (e) => {
  // Disable F12, Ctrl + Shift + I, Ctrl + Shift + J, Ctrl + U
  if ( event.keyCode === 123 || ctrlShiftKey(e, 'I') || ctrlShiftKey(e, 'J') || ctrlShiftKey(e, 'C') || (e.ctrlKey && e.keyCode === 'U'.charCodeAt(0)))
    return false;
};

