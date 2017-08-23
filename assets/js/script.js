/**
 * Theme Front end main js
 *
 */

(function($) {

    $(document).ready(function() {

        var $rtl = ( $("body").hasClass("rtl-body") ) ? true : false;


/***************************************************************************************************************************************/

        /**
         * Vertical Menu Accordion
         */

        var _SedVMenu = $('#sed_vertical_header_vertical_menu');

        _SedVMenu.find('li.menu-item.menu-item-has-children > .menu-toggle-oc').click(function(e){

            //e.preventDefault();

            var $this = $(this);

            if ($this.next().hasClass('active')) {
                $this.next().removeClass('active');
                $this.next().slideUp(350);
                $this.prev().removeClass('active');
            } else {
                $this.parent().parent().find('li .sub-menu').removeClass('active');
                $this.parent().parent().find('li .sub-menu').slideUp(350);
                $this.next().addClass('active');
                $this.next().slideDown(350);
                $this.parent().parent().find('li > a').removeClass('active');
                $this.prev().addClass('active');
            }

        });

        var $currentMenuItem = _SedVMenu.find(">.current-menu-item.menu-item-has-children");

        if( $currentMenuItem.length == 0 ){

            $currentMenuItem = _SedVMenu.find(">.current-menu-parent.menu-item-has-children");

        }

        if( $currentMenuItem.length > 0 ){

            $currentMenuItem.find(">a").addClass('active');

            $currentMenuItem.find(">ul.sub-menu").addClass('active');
            $currentMenuItem.find(">ul.sub-menu").slideDown(350);

        }

        /**
         * Vertical Menu Accordion
         */

        var scrollbarContainer =  $(".sed-shop-faq-wrapper"),
            scrollbarHeight =  $( window ).height() - 200;

        scrollbarContainer.css({
            height : scrollbarHeight + 'px',
        });


        scrollbarContainer.mCustomScrollbar({
            autoHideScrollbar:true ,
            advanced:{
                updateOnBrowserResize:true, /*update scrollbars on browser resize (for layouts based on percentages): boolean*/
                updateOnContentResize:true,
            },
            scrollButtons:{
                enable:false
            },
        });

        var scrollbarContainer_2 =  $(".sed-shop-faq-single"),
            scrollbarHeight_2 =  $( window ).height() - 200;

        scrollbarContainer_2.css({
            height : scrollbarHeight_2 + 'px',
        });


        scrollbarContainer_2.mCustomScrollbar({
            autoHideScrollbar:true ,
            advanced:{
                updateOnBrowserResize:true, /*update scrollbars on browser resize (for layouts based on percentages): boolean*/
                updateOnContentResize:true,
            },
            scrollButtons:{
                enable:false
            },
        });


        /**
         * FAQ Accordion
         */

        var _faqAccordionEl = $(".sed-shop-faq-wrapper-inner");

        _faqAccordionEl.accordion({
            heightStyle     : "content",
            active          : 0,
            collapsible     : true,
            icons           :false
        });

        console.log(_faqAccordionEl);

        /**
         * Single Products
         */
        $(".single_open_add_to_cart_dialog").on("click" , function(){

            var $dialog = $("#sed-add-to-cart-dialog");

            $dialog.addClass( 'active' );

            var $conetntForm = $(".add-to-cart-dialog-form-conetnt");

            if( $conetntForm.length > 0 ) {

                var fields = $(".product-options .product-option-value").serializeArray(),
                    $labels = $(".product-options .product-option-label"),
                    $html = '';

                console.log(fields);

                $.each(fields, function (index, val) {

                    $html += '<div class="tanin-form-item-content"><span class="input-label">' + $labels.eq( index ).text() + ': </span><span class="input-val">' + val.value + '</span></div>';

                });

                $conetntForm.html( $html );

                var quantity = $("#tanin_product_quantity").find(".product-option-value").val();

                $("form.tanin-main-form-cart").find(".quantity > input.qty").val( quantity );

            }

        });

        $(".add-to-cart-dialog-close").on("click" , function(){
            $("#sed-add-to-cart-dialog").removeClass( 'active' );
        });

        $("#sed-add-to-cart-dialog").on('click', function (e) {

            if ( !$(e.target).hasClass("add-to-cart-dialog-inner") && $(e.target).parents(".add-to-cart-dialog-inner:first").length == 0 ) {

                $(this).removeClass( 'active' );
            }

        });


        /*$('.item-column').livequery(function(){
            var ItemId            = $(this).attr("id"),
                Item              = $( "#" + ItemId ),
                popupContainerid  = Item.find(".sed_popup").attr("id"),
                iconselectorid    = Item.find(".project-view-icon").attr("id"),
                popupContainer    = $( "#" + popupContainerid ),
                iconselector      = $( "#" + iconselectorid ),
                iconClose         = Item.find(".sed_popup_container .close");

            iconselector.click(function(event) {

                event.preventDefault();

                if(!popupContainer.hasClass('in') && !popupContainer.hasClass('show')){
                    popupContainer.addClass('in');
                    popupContainer.addClass('show');
                }

            });

            iconClose.click(function(event) {

                if(popupContainer.hasClass('in') && popupContainer.hasClass('show')){
                    popupContainer.removeClass('in');
                    popupContainer.removeClass('show');
                }

            });

            popupContainer.on('click', function (e) {

                if ( !$(e.target).hasClass("sed_popup_container") && $(e.target).parents(".sed_popup_container:first").length == 0 ) {

                    if($(this).hasClass('in') && $(this).hasClass('show')){
                        $(this).removeClass('in');
                        $(this).removeClass('show');
                    }
                }
            });

        });

        */

        /**
         * Loading
         */

        var removePreloader = function() {
            setTimeout(function() {
                jQuery('.preloader').hide();
            }, 1500);
        };

        removePreloader();

    });


})(jQuery);
