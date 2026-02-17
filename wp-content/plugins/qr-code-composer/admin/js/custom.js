(function($) {
	
	$(window).load(function() {
		
		 $('.rightside').fadeIn(300);
		
	});
		$(window).scroll(function() {
    if ($(window).scrollTop() > 200) {
             $('.bulptinyprowarp').fadeIn(300);
    }
});

    $(document).ready(function() {
        "use strict";
        $("#elemtvide").videoPopup();
        $("#orderemail").videoPopup();
        $("#qrcauto").videoPopup();
        $("#qclinks").videoPopup();
        $("#qcphone").videoPopup();
        $("#qcwhatapp").videoPopup();
        $("#qcwifi").videoPopup();
        $("#qrcmap").videoPopup();
        $("#qrcevent").videoPopup();
        $("#qrcbbpress").videoPopup();
        $("#qrcbdypress").videoPopup();
        $("#qrcdokan").videoPopup();
        $("#qrcvcardfs").videoPopup();
        $('.qrcdesings').submit(function() {
            $('.qrcs_desingcrt').addClass("fancyLoaderCss");
            $('.qrcsdhicr_dsigns').hide();
            var b = $(this).serialize();
            $.post('options.php', b).error(function() {
                alert('error')
            }).success(function() {
                $(".qrcs_desingcrt").removeClass("fancyLoaderCss");
                $('.qrcsdhicr_dsigns').show();
                $('.qrcsdhicr_dsigns').html('<span class="dashicons dashicons-saved"></span>')
            });
            return !1
        });
        $('.qrccurrentqrcs').submit(function() {
            $('.qrcs_sdhicrt').addClass("fancyLoaderCss");
            $('.qrcsdhicr_djkfhjhj').hide();
            var b = $(this).serialize();
            $.post('options.php', b).error(function() {
                alert('error')
            }).success(function() {
                $(".qrcs_sdhicrt").removeClass("fancyLoaderCss");
                $('.qrcsdhicr_djkfhjhj').show();
                $('.qrcsdhicr_djkfhjhj').html('<span class="dashicons dashicons-saved"></span>')
            });
            return !1
        });

        $('.qrcpro_vacradsubmits').submit(function() {
            $('.qrcvcard_sdhi').addClass("fancyLoaderCss");
            $('.qrcvcard_djkfhjhj').hide();
            var b = $(this).serialize();
            $.post('options.php', b).error(function() {
                alert('error')
            }).success(function() {
                $(".qrcvcard_sdhi").removeClass("fancyLoaderCss");
                $('.qrcvcard_djkfhjhj').show();
                $('.qrcvcard_djkfhjhj').html('<span class="dashicons dashicons-saved"></span>')
            });
            return !1
        });
        $('.qrcpro_integration').submit(function() {
            $('.qrcintegrates').addClass("fancyLoaderCss");
            $('.qrcintegrates_djkfhjhj').hide();
            var b = $(this).serialize();
            $.post('options.php', b).error(function() {
                alert('error')
            }).success(function() {
                $(".qrcintegrates").removeClass("fancyLoaderCss");
                $('.qrcintegrates_djkfhjhj').show();
                $('.qrcintegrates_djkfhjhj').html('<span class="dashicons dashicons-saved"></span>')
            });
            return !1
        });
		
		
		

        $('.qrcprodemo').datetimepicker({
            timepicker: false,
            format: 'Y/m/d'
        });
        $('.qrcprodemo1').datetimepicker({
            datepicker: false,
            format: 'H:i'
        });
        $('.qrcprodemo2').datetimepicker({
            timepicker: false,
            format: 'Y/m/d'
        });
        $('.qrcprodemo3').datetimepicker({
            datepicker: false,
            format: 'H:i'
        });

        function bbpressoptions() {
            $('.bbpressoptions').on('change', function() {
                if ($(this).val() == 'none' || $(this).val() == 'url') {
                    $('.bbpressremovefiled').hide();

                } else {
                    $('.bbpressremovefiled').show()
                }

                if ($(this).val() == 'shortcode') {
                    $('.shortcodes').show();
                } else {
                    $('.shortcodes').hide();

                }
            });

            if ($('.bbpressoptions').val() == 'none' || $('.bbpressoptions').val() == 'url') {
                $('.bbpressremovefiled').hide();

            } else {
                $('.bbpressremovefiled').show()
            }
            if ($('.bbpressoptions').val() == 'shortcode') {
                $('.shortcodes').show();
            } else {
                $('.shortcodes').hide();

            }
        }
        bbpressoptions();

        function qrbudypressoptions() {


            $('.qrbudypressoptions').on('change', function() {
                if ($(this).val() == 'none' || $(this).val() == 'url') {
                    $('.budypressremovefiled').hide();

                } else {
                    $('.budypressremovefiled').show()
                }

                if ($(this).val() == 'shortcode') {
                    $('.shortcodesr').show();
                } else {
                    $('.shortcodesr').hide();

                }
            });

            if ($('.qrbudypressoptions').val() == 'none' || $('.qrbudypressoptions').val() == 'url') {
                $('.budypressremovefiled').hide();

            } else {
                $('.budypressremovefiled').show()
            }
            if ($('.qrbudypressoptions').val() == 'shortcode') {
                $('.shortcodesr').show();
            } else {
                $('.shortcodesr').hide();

            }

        }
        qrbudypressoptions();

        function qrcdokhanoptions() {


            $('.dokanqrc').on('change', function() {
                if ($(this).val() == 'none' || $(this).val() == 'url') {
                    $('.dokanremovefiled').hide();

                } else {
                    $('.dokanremovefiled').show()
                }

                if ($(this).val() == 'shortcode') {
                    $('.shortcodesdokan').show();
                } else {
                    $('.shortcodesdokan').hide();

                }
            });

            if ($('.dokanqrc').val() == 'none' || $('.dokanqrc').val() == 'url') {
                $('.dokanremovefiled').hide();

            } else {
                $('.dokanremovefiled').show()
            }
            if ($('.dokanqrc').val() == 'shortcode') {
                $('.shortcodesdokan').show();
            } else {
                $('.shortcodesdokan').hide();

            }

        }
        qrcdokhanoptions();


    });
	$(document).ready(function(){

        $("#qrcppagelocation").on("change", function () {
            if ($(this).val() == "inatab") {
                $(".ptab_name").show();
            } else {
                $(".ptab_name").hide();
            }
        });
        if ($("#qrcppagelocation").val() == "inatab") {
            $(".ptab_name").show();
        } else {
            $(".ptab_name").hide();
        }

	$("#qrchidefrontend").on("click", function() {
	if ($(this).is(":checked")){
$("div#qrccomsposerprviewss").css('opacity','0.3');
	}else {
$("div#qrccomsposerprviewss").css('opacity','1');
		
	}
	});
	if ($("#qrchidefrontend").is(":checked")){
		$("div#qrccomsposerprviewss").css('opacity','0.3');
	}else {
	$("div#qrccomsposerprviewss").css('opacity','1');
		
	}


	});
	$(document).ready(function(){
      $("input[name='qrc_composer_settings[page]").on("click", function () {
         if ($(this).is(":checked")) {
            $(".qr_checkbox_page").hide();
         } else {
            $(".qr_checkbox_page").show();
         }
      });
      if ($("input[name='qrc_autogenerate[page]']").is(":checked")) {
            $(".qr_checkbox_page").hide();
      } else {
            $(".qr_checkbox_page").show();
      }
	$("#qrcpopupenbl").on("click", function() {
	if ($(this).is(":checked")){
		$(".qrc_popup_preview").show();
		$(".qrcnewqr_popup_btndesign").show();
		$(".removePopupsecte").show();
		$("tr.qrcnewfeatures.qrcodevsbity").css({'pointer-events': 'none','opacity': 0.3});
		$(".qrc_prev_manage").css('opacity','0.3');
	}else {
	$(".qrc_popup_preview").hide();
	$(".qrcnewqr_popup_btndesign").hide();
	$(".removePopupsecte").hide();
		$("tr.qrcnewfeatures.qrcodevsbity").css({'pointer-events': 'all','opacity': 1});
		$(".qrc_prev_manage").css('opacity','1');
	
	}
	});
	if ($("#qrcpopupenbl").is(":checked")){
		$(".qrc_popup_preview").show();
		$(".qrcnewqr_popup_btndesign").show();
		$(".removePopupsecte").show();
		$("tr.qrcnewfeatures.qrcodevsbity").css({'pointer-events': 'none','opacity': 0.3});
			$(".qrc_prev_manage").css('opacity','0.3');	
		
	}else {
	$(".qrc_popup_preview").hide();
	$(".qrcnewqr_popup_btndesign").hide();
		$(".removePopupsecte").hide();
		$("tr.qrcnewfeatures.qrcodevsbity").css({'pointer-events': 'all','opacity': 1});
				$(".qrc_prev_manage").css('opacity','1');		
	}
			$('#qrc_design_type').on('change', function() {
			if ($(this).val() == 'tooltip') {
			$('#qrc_tooltipdesignwrap').show();
			$('#qrc_popupdesignwrap').hide();
			$('#popModal_ex1').show();
			$('#popModal_ex2').hide();

			}if($(this).val() == 'popup'){
			$('#popModal_ex1').hide();
			$('#qrc_tooltipdesignwrap').hide();
			$('#qrc_popupdesignwrap').show();
			$('#popModal_ex2').show();
			}
			});
			
			if ($('#qrc_design_type').val() == 'tooltip') {
			$('#popModal_ex1').show();
			$('#popModal_ex2').hide();
			$('#qrc_tooltipdesignwrap').show();
			$('#qrc_popupdesignwrap').hide();			
			
			

			}if($('#qrc_design_type').val() == 'popup'){
			$('#popModal_ex1').hide();
			$('#popModal_ex2').show();
			$('#qrc_tooltipdesignwrap').hide();
			$('#qrc_popupdesignwrap').show();			
			
			
			}		
			
			
			

	});

(function($) {


}(jQuery) );




    $(document).ready(function() {
		
		
        $("#qr_download_fntsz").on("input", function() {
            
            $("#result,#result2").css('font-size', $(this).val()+ 'px');
        });
        $("#qrcpopup_fntsize").on("input", function() {
            
            $('#popModal_ex1,#popModal_ex2').css('font-size', $(this).val()+ 'px');
        });
        $("#qrc_dwnbtn_brdius").on("input", function() {
            
            $("#result,#result2").css('border-radius', $(this).val()+ 'px');
        });
        $("#qrcpopup_brdius").on("input", function() {
            
            $('#popModal_ex1,#popModal_ex2').css('border-radius', $(this).val()+ 'px');
        });

		
        $("#qrcpopuptext").on("input", function() {
            
            $("#popModal_ex2,#popModal_ex1").text($(this).val());
        });
		
		
        $("#inputetxtas").on("input", function() {
            
            $("#result,#result2").text($(this).val());
        });

        $('.qrcremovedownlaod').on('change', function() {
            if ($(this).val() == 'yes') {
                $('.qrdemodownload').hide();
                $('.removealsscolors').hide();

            } else {
                $('.qrdemodownload').show();
                $('.removealsscolors').show();
            }
        });

        if ($('.qrcremovedownlaod').val() == 'yes') {
            $('.qrdemodownload').hide();
            $('.removealsscolors').hide();

        } else {
            $('.qrdemodownload').show();
            $('.removealsscolors').show();

        }



        $('#qrcpopup_bg').wpColorPicker({
            change: function(event, ui) {
                var theColor = ui.color.toString();
                $('#popModal_ex1,#popModal_ex2').css("background", theColor);
            },
		clear: function (event) {
			
		document.getElementById('qrcpopup_bg').value = 'transparent';	
	
		$('#popModal_ex1,#popModal_ex2').css("background", 'transparent');

		}				
        });
        $('#qrcpopup_color').wpColorPicker({
            change: function(event, ui) {
                var theColor = ui.color.toString();
                $('#popModal_ex1,#popModal_ex2').css("color", theColor);
            }
        });

        $('#qrcpopup_brclr').wpColorPicker({
            change: function(event, ui) {
                var theColor = ui.color.toString();
                $('#popModal_ex1,#popModal_ex2').css("border-color", theColor);
            },
		clear: function (event) {
		document.getElementById('qrcpopup_brclr').value = 'transparent';	
		$('#popModal_ex1,#popModal_ex2').css("border-color", 'transparent');

		}			
			
			
        });
        $('#qr_download_brclr').wpColorPicker({
            change: function(event, ui) {
                var theColor = ui.color.toString();
                $('#result,#result2').css("border-color", theColor);
            },
		clear: function (event) {
		document.getElementById('qr_download_brclr').value = 'transparent';
     $('#result,#result2').css("border-color", 'transparent');
	
    }
        });
        $('.qrc-btn-color-picker').wpColorPicker({
            change: function(event, ui) {
                var theColor = ui.color.toString();
                $('#result,#result2').css("color", theColor);
            },
			
			clear: function (event) {

     $('#result,#result2').css("color", '#000000');
	
    }	
			
			
        });
        $('.qrc-btn-bg-picker').wpColorPicker({
            change: function(event, ui) {
                var theColor = ui.color.toString();
                $('#result,#result2').css("background", theColor);
            },

		clear: function (event) {
		document.getElementById('qr_dwnbtnbg_color').value = 'transparent';
     $('#result,#result2').css("background", 'transparent');
	
    }		
			
			
			
			
			
			
			
			
			
        });


    });

   $(document).ready(function () {
      $("#removeautodisplay").on("click", function () {
         if ($(this).is(":checked")) {
            $("tr.wcalignme,tr.qrcchangeprodtab,.qr_checkbox,.qr_checkbox_page").hide();
         } else {
            $("tr.wcalignme,tr.qrcchangeprodtab,.qr_checkbox,.qr_checkbox_page").show();
         }
      });
         if ($("#removeautodisplay").is(":checked")) {
            $("tr.wcalignme,tr.qrcchangeprodtab,.qr_checkbox,.qr_checkbox_page").hide();
         } else {
            $("tr.wcalignme,tr.qrcchangeprodtab,.qr_checkbox,.qr_checkbox_page").show();
         }
   });
      $("input[name='qrc_autogenerate[page]']").on("click", function () {
         if ($(this).is(":checked")) {
            $(".qr_checkbox_page").hide();
         } else {
            $(".qr_checkbox_page").show();
         }
      });
      if ($("input[name='qrc_autogenerate[page]']").is(":checked")) {
            $(".qr_checkbox_page").hide();
      } else {
            $(".qr_checkbox_page").show();
      }
    $(document).ready(function() {
        $('#qr_print_tzx_ty').on('change', function() {
            $('#qr_print_product_ty').hide();
            if ($(this).val() == 'product_cat') {
                $('#qr_print_product_ty').show();
                $('#qr_print_cat_ty').hide()
            } else {
                $('#qr_print_product_ty').hide();
                $('#qr_print_cat_ty').show()
            }
        });
      $('.removeautodisplay th').append("<p>Disable QR Code automatically displayed on the frontend after the content.</p>");

      $('.removemetabox th').append("<p>Disable QR Code From Backend Metabox </p>");		
		
		
		$('.alignme th').append("<p>Choose the alignment of the QR code, by default it will be on the left</p>");
        $('.wcalignme th').append("<p>Choose the QR Code location on the Single product page, by default In a Tab</p>");
        $('.ptab_name th').append("<p>The QR code is located in the tab called QR Code on the product page. Rename tab name</p>");
        $('.qr_checkbox th').append("<p>Disable the QR code for specific post type that you wish to prevent the QR code on.</p>");
        $('.qr_checkbox_page th').append("<p>Disable the QR code for specific pages that you wish to prevent the QR code on. Also can remove QR code from page, post, product, custom post using meta field</p>");
        $('.qr_stcode_management th').append("<p>This is the shortcode for generating QR code of current page, current page url will be used as content of QR code.</p>");
        $('.qr_code_custom_text th').append("<p>Creating QR codes with custom links, static text or numbers as QR code content.</p>");
        $('.qr_code_phonenumber th').append("<p>Creating QR codes with Phone or Mobile number as QR code content.</p>");
        $('.qr_code_mail_text th').append("<p>Creating QR codes with WhatsApp Number as QR code content.</p>");
        $('.qr_code_wifi_text th').append("<p>Creating QR codes with WIFI Access as QR code content.</p>");
        $('.qr_code_event_text th').append("<p>Creating QR codes with Event Management as QR code content.</p>");
        $('.qr_code_maps_text th').append("<p>Creating QR codes with Google Map Location as QR code content.</p>");
        $('.qrc_metavcard_display th').append("<p>Automatically displaying QR Code for WooCommerce customers.</p>");


        $('.qr_code_vcard th').append("<p>A simple vCard QR code based on the information on the side. If you want to generate more, use the  <a href='https://qrcode.woocommercebarcode.com/wp-admin/admin.php?page=qrc_shortcode'> shortcode generator for vCard</a></p>");
        $('.qrc_vacrdtempe th').append("<p>vCard Templates is a feature for displaying vCard information on the frontend. <a href='https://wordpressqrcode.com/card/elizabeth-i-brown/'>View Demo</a></p>");
		        $('.qrc_vacrdauodisplay th').append("<p>Meta vCard QR code will be automatically displayed on the frontend after the content.</p>");
		
		
        $('.qr_checkbox_vcrad th').append("<p>Clicking the switcher button next to the post type name will enable the vCard meta field for that post type<a href='https://wordpressqrcode.com/docs/automatically-display-vcard/' target='_blank'> Read Docs</a></p>");

        $('.qrc_userdsiplay th').append("<p>The plugin generates auto QR codes for user profiles, vCard QR code are generated from user profile information, If you want to close <a href='profile.php/#qrcuserQRcode'>Look Profile Page</a> | <a href='https://wordpressqrcode.com/wp-profile-qr-code/'>View Demo</a></p>");
        $('.qrc_bbpress_display th').append("<p>Forum Memeber QR Code Generator for BB Press. QR code of memeber's profile URL and memeber's vCard QR code. <a href='https://wordpressqrcode.com/forums/users/dipashi/'> View Demo</a></p>");
        $('.qrc_bdypress_display th').append("<p>  Profile QR Code Generator for Buddy Press. QR code of user's profile URL and user's vCard QR code. <a href='https://wordpressqrcode.com/members/dipashi/profile/qr-code/'> View Demo</a></p>");
        $('.qrc_dokan_display th').append("<p>Vendor QR code generator for Dokan. QR code of vendor's profile URL and vendor's vCard QR code. <a href='https://wordpressqrcode.com/store/sharabindubakshi/'> View Demo</a></p>");

    })
})(jQuery);
(function($) {

	
jQuery(document).ready(function($) {

  // Suffix that will be used on the classes of the content divs.
  var tab_suffix = '-tab';

  // Not necessary, just to enable people to choose whatever tab_suffix they want.
  function escape_regexp(str) {
    return str.replace(/[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g, "\\$&");
  }

  // Get the class ending with tab_suffix from an element.
  function get_tab_name_from_class(el) {
    var tab_class_pattern = new RegExp('\\S*' + escape_regexp(tab_suffix));
    if ($(el) && $(el).attr('class')) {
      return $(el).attr('class').match(tab_class_pattern)[0];
    }
  }

  // Update the dom with the selected tab.
  function hash_content_update() {

    var active_section,
      tab_names;

    // Get all classes ending with -tab from div elements directly inside .qrctab-content.
    tab_names = $('div.qrctab-content > div').map(function() {
      var tab_name = get_tab_name_from_class($(this));
      if (tab_name) {
        return tab_name.split(tab_suffix)[0];
      }
    }).get();

    if (tab_names.length > 0) {

      // Show first tab initially.
      active_section = tab_names[0];

      // Check if the url hash matches one of the tab names.
      if (document.location.href.split('#')[1] && tab_names.indexOf(document.location.href.split('#')[1]) > -1) {
        active_section = document.location.href.split('#')[1];
      }
      // Handle tab contents.
      $('div.qrctab-content div.active').removeClass('active');
      $('div.qrctab-content div.' + active_section + tab_suffix).addClass('active');

      // Handle tab menu.
      $('div.tab-nav ul li.active').removeClass('active');
      $('div.tab-nav ul li a[href="#' + active_section + '"]').closest('li').addClass('active');

    }

  }

  // Set listener for hashchange
  $(window).bind('hashchange', function() {
    hash_content_update();
  });

  // Run the initial content update.
  hash_content_update();

});

}(jQuery));

(function($) {
    $(document).ready(function() {
        "use strict";
		$("#qrc-vides").videoPopup();
		$("#qrc-prints").videoPopup();
		$("#qrc-shortcoe").videoPopup();
		$("#qrc-find").videoPopup();
		$("#qrc-oder").videoPopup();
		$("#qrc-pdf").videoPopup();
		$("#qrc-downl").videoPopup();
		});

}(jQuery));