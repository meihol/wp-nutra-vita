(function($) {
    'use strict';
$(document).ready(function () {	
    function QRCShortcode() {
        jQuery(".qrc_canvass").each(function() {
			
			console.log(datas.size);
            var options = {
				shape: datas.shape,
                width: datas.size,
                height: datas.size,
                data: $(this).data('text'),
				margin: datas.quiet,
                dotsOptions: {
                    color: datas.color,
                },
                backgroundOptions: {
                    color: datas.background,
                },
				qrOptions: {
                    errorCorrectionLevel: datas.ecLevel,
                },
            };

            var ereer = $(this).attr('id');
            var $Mqrds = '#' + ereer;
            var container = document.querySelector($Mqrds);
			/* jshint esversion: 6 */
            const qrcode = new QRCodeStyling(options);
            if (qrcode) {
                qrcode.append(container);
            }

        });
    }
    QRCShortcode();


    function QRCShortcodeButon() {
        jQuery(".qrcdownloads").each(function(index) {
            $(this).on("click", function() {
                var ereer = $(this).closest('.qrcprowrapper').children('.qrc_canvass').attr('id');
                var $Mqrds = '#' + ereer + ' canvas';
                var image = document.querySelector($Mqrds).toDataURL("image/png").replace("image/png", "image/octet-stream");
                this.setAttribute("href", image);
            });
        });

    }
    QRCShortcodeButon();

    function qrcpromodalwrapperQRS() {
        jQuery(".qrcpromodalwrapper").each(function() {
            var modlabutton = $(this).find('.qrc-modal-toggle');
            var modla = $(this).find('.qrc_modal');
            $(modlabutton).on('click', function(e) {
                e.preventDefault();
                $(modla).toggleClass('is-visible');
            });

        });

    }
    qrcpromodalwrapperQRS();
	});
	
}(jQuery));






