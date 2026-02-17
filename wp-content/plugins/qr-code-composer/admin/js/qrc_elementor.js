(function($) {

    function QRC_ELEmntora() {
	
        var UqrCOde = function($scope) {
            var $carousel = $scope.find(".qrc_elecanvas");
            var $btn_canvas = $scope.find(".qrc_btn_canvas");
            var $sliderDynamicId = '#' + $carousel.attr('id');
            var $btn_DynamicId = '#' + $btn_canvas.attr('id');
            $($sliderDynamicId).each(function() {
				 var options = {
				width: $carousel.data('qrwidth'),
				height: $carousel.data('qrwidth'),
				type: "canvas",
				data:$carousel.data('qrcontent'),
				dotsOptions: {
				color: $carousel.data('qrcolor'),
				},
				backgroundOptions: {
				color: $carousel.data('qrbgcolor'),
				}

			}
            var ereer = $(this).attr('id');
            var $Mqrds = '#' + ereer;
            var container = document.querySelector($Mqrds);
            const qrcode = new QRCodeStyling(options);
            if (qrcode) {
                qrcode.append(container);
            }				

            });	
            jQuery(".qrc_btn_canvas").each(function(index) {
                $(this).on("click", function() {
                    var QCByrnlink = $(this).closest('.qrcswholewtapper').children('.qrc_elecanvas').attr('id');
                    var $Mqrdsbtns = '#' + QCByrnlink + ' canvas';
                    var image = document.querySelector($Mqrdsbtns).toDataURL("image/png").replace("image/png", "image/octet-stream");
                    this.setAttribute("href", image)
                });
            });	
        };
        $(window).on('elementor/frontend/init', function() {
            elementorFrontend.hooks.addAction('frontend/element_ready/qrcode_elemntsa.default', UqrCOde)
        })
    }
    QRC_ELEmntora();

})(jQuery)