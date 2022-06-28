(function ($) {
    "use strict"; // Start of use strict
    /* ---------------------------------------------
     Scripts initialization
     --------------------------------------------- */
    //$(function () {
    //    var loc = window.location.href;
    //    //if (!/.html/.test(loc)) {
    //    //    if (/trang-chu.html/.test(loc)) {
    //    //        $('.body').addClass('home option9');
    //    //    }
    //    //    else {
    //    //        $('body').addClass('option9 category-page');
    //    //    }
    //    //}
    //    //else {
    //    //    $('body').addClass('option9 category-page');
    //    //}
    //    //Mau demo
    //    if (!/.html/.test(loc)) {
    //        if (/trang-chu.html/.test(loc)) {
    //            $('.body').addClass('home option3');
    //        }
    //        else {
    //            $('body').addClass('option3 category-page');
    //        }
    //    }
    //    else {
    //        $('body').addClass('option3 category-page');
    //    }
    //});
    $(function () {
        var loc = window.location.href;
        if (/.html/.test(loc)) {
            if (/trang-chu.html/.test(loc)) {
                $('body').addClass('home');
            }
            else {
                $('body').addClass('category-page');
            }
        }
        else {
            $('body').addClass('home');
        }
    });
    $(window).load(function () {
        // auto width megamenu
        auto_width_megamenu();
        resizeTopmenu();
        js_height_full();
        rep_menu();
        js_swithlist();
    });
    /* ---------------------------------------------
     Scripts ready
     --------------------------------------------- */
    $(document).ready(function () {
        js_height_full();
        rep_menu();
        //if ($('.parallax').length > 0) {
        //    $('.parallax').each(function () {
        //        $(this).parallax("50%", 0.1);
        //    })
        //}
        $('[data-toggle="tooltip"]').tooltip();
        /* Resize top menu*/
        resizeTopmenu();
        Product_slide();
        /* Zoom image */
        //if ($('#product-zoom').length > 0) {
        //    $('#product-zoom').elevateZoom({
        //        zoomType: "inner",
        //        cursor: "crosshair",
        //        zoomWindowFadeIn: 500,
        //        zoomWindowFadeOut: 750,
        //        gallery: 'gallery_01'
        //    });
        //}
        $('.form-action .addcart-link-qick').click(function () {
            $('.product-tab').find('.nav-tab li.:nth-child(2)').addClass("active");
        });
        if ($('#product-zoom').length > 0) {
            if ($(window).width() > 768) {
                $('#product-zoom').elevateZoom({ zoomType: "window", cursor: "crosshair", scrollZoom:"true", zoomWindowFadeIn: 500, zoomWindowFadeOut: 750, gallery: 'gallery_01' });
            }
        }
		//if ($(window).width() >= 768) {
          //  if ($('.pb-right-column .product-desc').length > 0) {
              //  var max_h = $('.pb-right-column .product-desc.nd1').height();
              //  if (max_h < 300) {
                 //   $('.nd1').css('height', 'auto');
                //    $('.show-more').hide();
               // }
               // else {
                  //  $('.nd1').css('height', '300px');
                   // $('.show-more').click(function (event) {
                      //  $('.show-more').slideToggle();
                     //   $('.pb-right-column .product-desc.nd1').css('height', 'auto');
                   // });
               // }
           // }
       // }
      //  else {
        //    $('.nd1').css('height', 'auto');
         //   $('.show-more').hide();
        //}
		$('.content-shop').find('.content-pro2').after('<div class=\"show-more2\" style=\"display:block;\" onclick=\"showArticle();\"><a id=\"xem-them\" href=\"javascript:;\" class=\"readmore\">Đọc thêm</a></div>');
		if ($(window).width() >= 768) {
			
            if ($('.content-pro2').length > 0) {
                var max_h2 = $('.content-pro2').height();
                if (max_h2 < 400) {
                    $('.content-pro2').css('height', 'auto');
                    $('.show-more2').hide();
                }
                else {
                    $('.content-pro2').css('height', '400px');
                    $('.show-more2').click(function (event) {
                        $('.show-more2').slideToggle();
                        $('.content-pro2').css('height', 'auto');
                    });
                }
            }
        }
        else {
            $('.content-pro2').css('height', 'auto');
            $('.show-more2').hide();
        }
        $(".product-gallery__thumb img").click(function () {
            $(".product-gallery__thumb").removeClass('active');
            $(this).parents('.product-gallery__thumb').addClass('active');
            var img_thumb = $(this).data('image');
            var total_index = $(this).parents('.product-gallery__thumb').index() + 1;
            $(".gallery-index .current").html(total_index);
            $('html, body').animate({
                scrollTop: $("#sliderproduct img[src='" + img_thumb + "']").offset().top
            }, 1000);
        });
        $(".product-gallery__thumb").first().addClass('active');
        /* Popup sizechart */
        if ($('#size_chart').length > 0) {
            $('#size_chart').fancybox();
        }
        /** OWL CAROUSEL**/
        $(".owl-carousel").each(function (index, el) {
            var config = $(this).data();
            config.navText = ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'];
            config.smartSpeed = "300";
            if ($(this).hasClass('owl-style2')) {
                config.animateOut = "fadeOut";
                config.animateIn = "fadeIn";
            }
            $(this).owlCarousel(config);
        });

        $(".owl-carousel-vertical").each(function (index, el) {
            var config = $(this).data();
            config.navText = ['<span class="icon-up"></spam>', '<span class="icon-down"></span>'];
            config.smartSpeed = "900";
            config.animateOut = "";
            config.animateIn = "fadeInUp";
            $(this).owlCarousel(config);
        });
        //Gallery Filters
        if ($('.filter-list').length) {
            $('.filter-list').mixItUp({});
        }
        //Tabs Box
        if ($('.tabs-box').length) {
            $('.tabs-box .tab-buttons .tab-btn').on('click', function (e) {
                e.preventDefault();
                var target = $($(this).attr('data-tab'));

                if ($(target).is(':visible')) {
                    return false;
                } else {
                    target.parents('.tabs-box').find('.tab-buttons').find('.tab-btn').removeClass('active-btn');
                    $(this).addClass('active-btn');
                    target.parents('.tabs-box').find('.tabs-content').find('.tab').fadeOut(0);
                    target.parents('.tabs-box').find('.tabs-content').find('.tab').removeClass('active-tab animated fadeIn');
                    $(target).fadeIn(300);
                    $(target).addClass('active-tab animated fadeIn');
                }
            });
        }
        //Projects Carousel
        if ($('.projects-carousel').length) {
            $('.projects-carousel').owlCarousel({
                loop: true,
                margin: 5,
                nav: true,
                smartSpeed: 700,
                autoplay: false,
                navText: ['<span class="fa fa-long-arrow-left"></span> prev', 'next<span class="fa fa-long-arrow-right"></span>'],
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 2
                    },
                    800: {
                        items: 3
                    },
                    1024: {
                        items: 4
                    },
                    1400: {
                        items: 4
                    }
                }
            });
        }
        /** COUNT DOWN **/
        $('[data-countdown]').each(function () {
            var $this = $(this), finalDate = $(this).data('countdown');
            $this.countdown(finalDate, function (event) {
                var fomat = '<span>%H</span><b></b><span>%M</span><b></b><span>%S</span>';
                $this.html(event.strftime(fomat));
            });
        });
        if ($('.countdown-lastest').length > 0) {
            var labels = ['Years', 'Months', 'Weeks', 'Days', 'Hrs', 'Mins', 'Secs'];
            var layout = '<span class="box-count"><span class="number">{dnn}</span> <span class="text">Days</span></span><span class="dot">:</span><span class="box-count"><span class="number">{hnn}</span> <span class="text">Hrs</span></span><span class="dot">:</span><span class="box-count"><span class="number">{mnn}</span> <span class="text">Mins</span></span><span class="dot">:</span><span class="box-count"><span class="number">{snn}</span> <span class="text">Secs</span></span>';
            $('.countdown-lastest').each(function () {
                var austDay = new Date($(this).data('y'), $(this).data('m') - 1, $(this).data('d'), $(this).data('h'), $(this).data('i'), $(this).data('s'));
                $(this).countdown({
                    until: austDay,
                    labels: labels,
                    layout: layout
                });
            });
        }
        /* Close top banner*/
        $(document).on('click', '.btn-close', function () {
            $(this).closest('.top-banner').animate({ height: 0, opacity: 0 }, 1000);
            return false;
        });
        /** SELECT CATEGORY **/
        $('.select-category').select2();
        /* Toggle nav menu*/
        $(document).on('click', '.toggle-menu', function () {
            $(this).closest('.nav-menu').find('.navbar-collapse').toggle();
            return false;
        });
        /** HOME SLIDE**/
        if ($('#home-slider').length > 0 && $('#contenhomeslider').length > 0) {
            var slider = $('#contenhomeslider').bxSlider(
                {
                    nextText: '<i class="fa fa-angle-right"></i>',
                    prevText: '<i class="fa fa-angle-left"></i>',
                    auto: true,
                    mode: 'fade'
                }

            );
        }
        /** Custom page sider**/
        if ($('#home-slider').length > 0 && $('#contenhomeslider-customPage').length > 0) {
            var slider = $('#contenhomeslider-customPage').bxSlider(
                {
                    nextText: '<i class="fa fa-angle-right"></i>',
                    prevText: '<i class="fa fa-angle-left"></i>',
                    auto: true,
                    pagerCustom: '#bx-pager',
                    nextSelector: '#bx-next',
                    prevSelector: '#bx-prev',
                }

            );
        }

        if ($('#home-slider').length > 0 && $('#slide-background').length > 0) {
            var slider = $('#slide-background').bxSlider(
                {
                    nextText: '<i class="fa fa-angle-right"></i>',
                    prevText: '<i class="fa fa-angle-left"></i>',
                    auto: true,
                    onSlideNext: function ($slideElement, oldIndex, newIndex) {
                        var corlor = $($slideElement).data('background');
                        $('#home-slider').css('background', corlor);
                    },
                    onSlidePrev: function ($slideElement, oldIndex, newIndex) {
                        var corlor = $($slideElement).data('background');
                        $('#home-slider').css('background', corlor);
                    }
                }

            );
            //slider.goToNextSlide();
        }
        $('.bxslider-background').bxSlider({
            useCSS: false,
            nextText: '<i class="fa fa-angle-right"></i>',
            prevText: '<i class="fa fa-angle-left"></i>',
            auto: true,
            onSliderLoad: function (currentIndex) {
                var current = $('.bxslider-background > li').eq(currentIndex);
                setTimeout(function () {
                    //current.find('.sl-description').show();
                    current.find('.caption').each(function () {
                        $(this).show().addClass('animated fadeInDown');
                    })
                }, 1000);
            },
            onSlideBefore: function (slideElement, oldIndex, newIndex) {
                //slideElement.find('.sl-description').hide();
                slideElement.find('.caption').each(function () {
                    $(this).hide().removeClass('animated fadeInDown');
                });
            },
            onSlideAfter: function (slideElement, oldIndex, newIndex) {
                //slideElement.find('.sl-description').show();
                setTimeout(function () {
                    slideElement.find('.caption').each(function () {
                        $(this).show().addClass('animated fadeInDown');
                    });
                }, 500);
            }
        });
        /* enter search*/
        $('#ctl00_hh_ctl00_TextBoxSearch').keydown(function (e) {
            if (e.keyCode == 13) {
                //alert(e.keyCode);
                var keywords = $("#ctl00_hh_ctl00_TextBoxSearch").val().replace(/ /g, '+');
                window.location = "/tags-name/tag.html?url=" + keywords;
                return false;
            }

        });
        /* elevator click*/
        $(document).on('click', 'a.btn-elevator', function (e) {
            e.preventDefault();
            var target = this.hash;
            if ($(document).find(target).length <= 0) {
                return false;
            }
            var $target = $(target);
            $('html, body').stop().animate({
                'scrollTop': $target.offset().top - 50
            }, 500);
            return false;
        });
        $('.float-contact').find('a.chat-hotline.chat-0 i').append('<span class="text-call">Hotline ANZ</span>');
        $('.float-contact').find('.chat-hotline.chat-1 i').append('<span class="text-call">Sales ANZ</span>');
        $('.float-contact').find('a.chat-hotline.chat-2 i').append('<span class="text-call">Support ANZ</span>');
        /* scroll top */
        $(document).on('click', '.scroll-top', function () {
            $('body,html').animate({ scrollTop: 0 }, 400);
            return false;
        });
        /** #brand-showcase */
        $(document).on('click', '.brand-showcase-logo li', function () {
            var id = $(this).data('tab');
            $(this).closest('.brand-showcase-logo').find('li').each(function () {
                $(this).removeClass('active');
            });
            $(this).closest('li').addClass('active');
            $('.brand-showcase-content').find('.brand-showcase-content-tab').each(function () {
                $(this).removeClass('active');
            });
            $('#' + id).addClass('active');
            return false;
        });
        /* #faq */
        $(function () {
            $(".expand").on("click", function () {
                // $(this).next().slideToggle(200);
                $expand = $(this).find(">:first-child");

                if ($expand.text() == "+") {
                    $expand.text("-");
                } else {
                    $expand.text("+");
                }
            });
        });
        // CATEGORY FILTER 
        $('.slider-range-price').each(function () {
            var value_min = $(".minprice").val();
            var value_max = $(".maxprice").val();
            var MaxPr = $(".tienmax").text();
            var unit = $(this).data('unit');
            var label_reasult = $(this).data('label-reasult');
            var t = $(this);
            $(this).slider({
                range: true,
                min: 0,
                max: MaxPr,
                values: [value_min, value_max],
                slide: function (event, ui) {
                    var result = label_reasult + " " + parseFloat(ui.values[0], 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString().replace(".00", "") + unit + ' - ' + parseFloat(ui.values[1], 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString().replace(".00", "") + unit; //parseFloat(ui.values[0], 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString().replace(".00", "")
                    console.log(t);
                    t.closest('.slider-range').find('.amount-range-price').html(result);
                    filterSystem(ui.values[0], ui.values[1]);
                }
            });
        });
        //goi lai khi Update panel
        if ($('.left-pro').length > 0) {
            if ($(window).width() > 768) {
                var prm = Sys.WebForms.PageRequestManager.getInstance();
                prm.add_endRequest(function () {
                    $('.slider-range-price').each(function () {
                        var value_min = $(".minprice").val();
                        var value_max = $(".maxprice").val();
                        var MaxPr = $(".tienmax").text();
                        var unit = $(this).data('unit');
                        var label_reasult = $(this).data('label-reasult');
                        var t = $(this);
                        $(this).slider({
                            range: true,
                            min: 0,
                            max: MaxPr,
                            values: [value_min, value_max],
                            slide: function (event, ui) {
                                var result = label_reasult + " " + parseFloat(ui.values[0], 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString().replace(".00", "") + unit + ' - ' + parseFloat(ui.values[1], 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString().replace(".00", "") + unit; //parseFloat(ui.values[0], 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString().replace(".00", "")
                                console.log(t);
                                t.closest('.slider-range').find('.amount-range-price').html(result);
                                filterSystem(ui.values[0], ui.values[1]);
                            }
                        });
                    });
                });
            }
        }
        function filterSystem(minPrice, maxPrice) {
            $('.range-number').each(function () {
                $(".minprice").val(minPrice);
                $(".maxprice").val(maxPrice);
            });
        }
        $("#myInput").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            $("#datatable tr").filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            });
        });

        if ($('.layered-filter-brand').length > 0) {
            if ($(window).width() > 768) {
                $('.filter-brand').addClass('open');
            }
            else {
                $('.filter-brand').removeClass('open');
            }
        }
		if ($('.category-slider').length > 0) {
            var list = $('.category-slider .item-slider .slider-thumb img');
            for (var i = 0; i < list.length; i++) {
                var src = list[i].getAttribute('src');
                var list2 = $('.category-slider .item-slider .slider-thumb');
                for (var j = 0; j < list2.length; j++) {
                    list2[i].style.backgroundImage = "url('" + src + "')";
                }
            }
        }
        /** Show and hide content **/
        if ($('.content-pro2').length > 0) {
            var max_h2 = $('.content-pro2').height();
            if (max_h2 < 1000) {
                $('.content-pro2').css('height', 'auto');
                $('.show-more').hide();
                $('.show-more2').hide();
            }
            else {
                if ($('.content-pro2').html.length > 0) {
                    $('.content-pro2').css('height', '1000px');
                }
                else {
                    $('.content-pro2').css('height', 'auto');
                    $('.show-more').hide();
                    $('.show-more2').hide();
                }
                $('.show-more').click(function (event) {
                    $('.show-more').slideToggle();
                    $('.content-pro2').css('height', 'auto');
                    $('.show-more2').show();
                });
                $('.show-more2').click(function (event) {
                    $('.show-more2').slideToggle();
                    $('.content-pro2').css('height', '1000');
                    $('.show-more').show();
                });
            }
        }
        /** ALL CAT **/
        $(document).on('click', '.open-cate', function () {
            $(this).closest('.vertical-menu-content').find('li.cat-link-orther').each(function () {
                $(this).slideDown();
            });
            $(this).addClass('colse-cate').removeClass('open-cate').html('Close');
        });
        /* Close category */
        $(document).on('click', '.colse-cate', function () {
            $(this).closest('.vertical-menu-content').find('li.cat-link-orther').each(function () {
                $(this).slideUp();
            });
            $(this).addClass('open-cate').removeClass('colse-cate').html('All Categories');
            return false;
        });
        // bar ontop click
        $(document).on('click', '.vertical-megamenus-ontop-bar', function () {
            $('#vertical-megamenus-ontop').find('.box-vertical-megamenus').slideToggle();
            $('#vertical-megamenus-ontop').toggleClass('active');
            return false;
        });
        // bar click
        $(document).on('click', '.navbar-toggle', function () {
            $('.navbar-toggle').toggleClass('active');
            return false;
        });
        // View grid list product 
        $(document).on('click', '.display-product-option .view-as-grid', function () {
            $(this).closest('.display-product-option').find('li').removeClass('selected');
            $(this).addClass('selected');
            $(this).closest('#view-product-list').find('.product-list').removeClass('list').addClass('grid');
            return false;
        });
        // View list list product 
        $(document).on('click', '.display-product-option .view-as-list', function () {
            $(this).closest('.display-product-option').find('li').removeClass('selected');
            $(this).addClass('selected');
            $(this).closest('#view-product-list').find('.product-list').removeClass('grid').addClass('list');
            return false;
        });
        /// tre menu category
        $(document).on('click', '.tree-menu li span', function () {
            $(this).closest('li').children('ul').slideToggle();
            if ($(this).closest('li').haschildren('ul')) {
                $(this).toggleClass('open');
            }
            return false;
        });
        /* Open menu on mobile */
        $(document).on('click', '.btn-open-mobile', function () {
            var width = $(window).width();
            if (width > 1024) {
                if ($('body').hasClass('home')) {
                    if ($('#nav-top-menu').hasClass('nav-ontop') || $('#header').hasClass('optop')) {
                        return;
                    } else {
                        return false;
                    }
                }
            }
            $(this).closest('.box-vertical-megamenus').find('.vertical-menu-content').slideToggle();
            $(this).closest('.title').toggleClass('active');
            return false;
        });
        /* Product qty */
        $(document).on('click', '.btn-plus-down', function () {
            var value = parseInt($('.qty-val').val());
            value = value - 1;
            if (value <= 0) return false;
            $('.qty-val').val(value);
            return false;
        });
        $(document).on('click', '.btn-plus-up', function () {
            var value = parseInt($('.qty-val').val());
            value = value + 1;
            if (value <= 0) return false;
            $('.qty-val').val(value);
            return false;
        });
        /* Product qty kieu 2 */
        $(document).ready(function () {
            var quantitiy = 0;
            $('.quantity-right-plus').click(function (e) {
                e.preventDefault();
                var quantity = parseInt($('.qty-vl').val());
                $('.qty-vl').val(quantity + 1);
            });

            $('.quantity-left-minus').click(function (e) {
                e.preventDefault();
                var quantity = parseInt($('.qty-vl').val());
                if (quantity > 0) {
                    $('.qty-vl').val(quantity - 1);
                }
            });
        });
        /* Close vertical */
        $(document).on('click', '*', function (e) {
            var container = $("#box-vertical-megamenus");
            if (!container.is(e.target) && container.has(e.target).length === 0) {
                if ($('body').hasClass('home')) {
                    if ($('#nav-top-menu').hasClass('nav-ontop')) {
                        return;
                    } else {
                        return;
                    }
                }
                container.find('.vertical-menu-content').hide();
                container.find('.title').removeClass('active');
            }
        });
        /* Send conttact*/
        $(document).on('click', '#btn-send-contact', function () {
            var subject = $('#subject').val(),
                email = $('#email').val(),
                order_reference = $('#order_reference').val(),
                message = $('#message').val();
            var data = {
                subject: subject,
                email: email,
                order_reference: order_reference,
                message: message
            };
            $.post('ajax_contact.php', data, function (result) {
                if (result.trim() === "done") {
                    $('#email').val('');
                    $('#order_reference').val('');
                    $('#message').val('');
                    $('#message-box-conact').html('<div class="alert alert-info">Your message was sent successfully. Thanks</div>');
                } else {
                    $('#message-box-conact').html(result);
                }
            });
        });
        //=============================Set Lang==================================
        $(".setLangForMe").click(function () {
            var anchorLink = $(this);
            var sall = anchorLink.attr('data-sall');
            var url = anchorLink.attr('data-url');
            var data = {
                sall: sall,
                url: url
            };
            anchorLink.attr("disabled", true);
            $.post(window.location.protocol + "//" + window.location.host + "/frontend/post/setLang.ashx", data, function (result) {
                var obj = JSON.parse(result.trim());
                if (obj.action === "1") {
                    console.log("success: " + result.message);
                }
                else {
                    console.log("error: " + result.message);
                }
                anchorLink.attr("disabled", false);
                var _url = obj.url;
                console.log("ket qua: " + result.trim());
                window.location.replace(window.location.protocol + "//" + window.location.host + _url);
            });
        });
        //======================================Cart ====================
        $(".addtowishlist").click(function () {
            var anchorLink = $(this);
            var itemCount = $(".wishlist-number").text().replace(/\,/g, '');
            if (itemCount === "") {
                itemCount = 0;
            }
            // AJAX Request
            var sectionID = anchorLink.attr('data-id');
            var cID = anchorLink.attr('data-wid');
            var data = {
                id: sectionID,
                cid: cID
            };
            $.post("./addtofavoriteunfavorite.html", data, function (data) {
                if (data.trim() === "1") {
                    anchorLink.removeClass("like");
                    anchorLink.addClass("liked");
                    itemCount = parseInt(itemCount) + 1;
                    $(".wishlist-number").html(itemCount);
                    $(".countFavouritePopup").html(itemCount);
                    $('.desc-like').css('opacity', 1);
                    $('.desc-like').css('top', '50px');
                    setTimeout(function () {
                        $('.desc-like').css('opacity', 0);
                        $('.desc-like').css('top', '-70px');
                    }, 2000);
                    //console.log("success 1");
                }
                else if (data.trim() === "-1") {
                    anchorLink.removeClass("liked");
                    anchorLink.addClass("like");
                    itemCount = parseInt(itemCount) - 1;
                    if (itemCount < 0) {
                        itemCount = 0;
                    }
                    $(".wishlist-number").html(itemCount);
                    $(".countFavouritePopup").html(itemCount);
                    $('.desc-like').css('opacity', 1);
                    $('.desc-like').css('top', '50px');
                    setTimeout(function () {
                        $('.desc-like').css('opacity', 0);
                        $('.desc-like').css('top', '-70px');
                    }, 2000);
                    //console.log("success -1");
                }
                else {
                    console.log("not success");
                }
                //console.log("ket qua: " + data.trim());
            });
        });
        if (window.Sys && Sys.WebForms && Sys.WebForms.PageRequestManager) {
            Sys.WebForms.PageRequestManager.getInstance().add_endRequest(function () { js_swithlist(); });
        }
        $(".addtocartlist").click(function () {
            var anchorLink = $(this);
            var itemCount = $(".cartlist-number").text().replace(/\,/g, '');
            if (itemCount === "") {
                itemCount = 0;
            }
            if (anchorLink.hasClass("like")) {
                // AJAX Request
                var sectionID = anchorLink.attr('data-id');
                var cID = anchorLink.attr('data-cid');
                var data = {
                    id: sectionID,
                    cid: cID
                };
                $.post("./addtoshoppingcartlist.html", data, function (data) {
                    if (data.trim() === "1") {
                        anchorLink.removeClass("like");
                        anchorLink.addClass("liked");
                        itemCount = parseInt(itemCount) + 1;
                        $(".cartlist-number").html(itemCount);
                        $(".countShoppingCartPopup").html(itemCount);
                        $('.desc-cart').css('opacity', 1);
                        $('.desc-cart').css('top', '50px');
                        setTimeout(function () {
                            $('.desc-cart').css('opacity', 0);
                            $('.desc-cart').css('top', '-70px');
                        }, 2500);
                        //console.log("success 1");
                    }
                    else if (data.trim() === "0") {
                        anchorLink.removeClass("like");
                        anchorLink.addClass("liked");
                        itemCount = parseInt(itemCount);
                        if (itemCount < 0) {
                            itemCount = 0;
                        }
                        $(".cartlist-number").html(itemCount);
                        $(".countShoppingCartPopup").html(itemCount);
                        $('.desc-cart').css('opacity', 1);
                        $('.desc-cart').css('top', '50px');
                        setTimeout(function () {
                            $('.desc-cart').css('opacity', 0);
                            $('.desc-cart').css('top', '-70px');
                        }, 3000);
                        //console.log("success 0");
                    }
                    else {
                        console.log("not success");
                    }
                    //console.log("ket qua: " + data.trim());
                });
            }
        });
        //===================================================Check Out ==================
        var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
        $(".TextBoxEmailCheckOut").focus(function () {
            $(this).css("border-color", "#d8d8d8");
        });
        $(".TextBoxEmailCheckOut").blur(function () {
            var email = $(this).val();
            if (email === "" || testEmail.test(email) === false) {
                $(this).css("border-color", "red");
            }
            else {
                $(this).css("border-color", "#d8d8d8");
            }
        });
        $(".TextBoxHoTenCheckOut").focus(function () {
            $(this).css("border-color", "#d8d8d8");
        });
        $(".TextBoxHoTenCheckOut").blur(function () {
            if ($(this).val() === "") {
                $(this).css("border-color", "red");
            }
            else {
                $(this).css("border-color", "#d8d8d8");
            }
        });
        $(".TextBoxDienThoaiCheckOut").focus(function () {
            $(this).css("border-color", "#d8d8d8");
        });
        $(".TextBoxDienThoaiCheckOut").blur(function () {
            if ($(this).val() === "") {
                $(this).css("border-color", "red");
            }
            else {
                $(this).css("border-color", "#d8d8d8");
            }
        });
        $(".TextBoxDiaChiCheckOut").focus(function () {
            $(this).css("border-color", "#d8d8d8");
        });
        $(".TextBoxDiaChiCheckOut").blur(function () {
            if ($(this).val() === "") {
                $(this).css("border-color", "red");
            }
            else {
                $(this).css("border-color", "#d8d8d8");
            }
        });
        $(".txtCaptchaCheckOut").focus(function () {
            $(this).css("border-color", "#d8d8d8");
        });
        $(".txtCaptchaCheckOut").blur(function () {
            if ($(this).val() === "") {
                $(this).css("border-color", "red");
            }
            else {
                $(this).css("border-color", "#d8d8d8");
            }
        });
        //===================================== Người Nhận
        $(".TextBoxHoTen2CheckOut").focus(function () {
            $(this).css("border-color", "#d8d8d8");
        });
        $(".TextBoxHoTen2CheckOut").blur(function () {
            if ($(this).val() === "") {
                $(this).css("border-color", "red");
            }
            else {
                $(this).css("border-color", "#d8d8d8");
            }
        });
        $(".TextBoxDienThoai2CheckOut").focus(function () {
            $(this).css("border-color", "#d8d8d8");
        });
        $(".TextBoxDienThoai2CheckOut").blur(function () {
            if ($(this).val() === "") {
                $(this).css("border-color", "red");
            }
            else {
                $(this).css("border-color", "#d8d8d8");
            }
        });
        $(".TextBoxDiaChi2CheckOut").focus(function () {
            $(this).css("border-color", "#d8d8d8");
        });
        $(".TextBoxDiaChi2CheckOut").blur(function () {
            if ($(this).val() === "") {
                $(this).css("border-color", "red");
            }
            else {
                $(this).css("border-color", "#d8d8d8");
            }
        });

        $(".sendCheckOut").click(function () {
            var has_empty = true;
            var email = $(".TextBoxEmailCheckOut").val();
            if (email === "" || testEmail.test(email) === false) {
                has_empty = false;
                $(".TextBoxEmailCheckOut").css("border-color", "red");
            }
            var name = $(".TextBoxHoTenCheckOut").val();
            if (name === "") {
                has_empty = false;
                $(".TextBoxHoTenCheckOut").css("border-color", "red");
            }
            var dienthoai = $(".TextBoxDienThoaiCheckOut").val();
            if (dienthoai === "") {
                has_empty = false;
                $(".TextBoxDienThoaiCheckOut").css("border-color", "red");
            }
            var diachi = $(".TextBoxDiaChiCheckOut").val();
            if (diachi === "") {
                has_empty = false;
                $(".TextBoxDiaChiCheckOut").css("border-color", "red");
            }
            // Nếu có thêm người nhận
            if ($('.CheckBoxOtherAddressCheckOut input').prop('checked')) {
                $(".frm-nhan").show(300);
                var tennhan = $(".TextBoxHoTen2CheckOut").val();
                if (tennhan === "") {
                    has_empty = false;
                    $(".TextBoxHoTen2CheckOut").css("border-color", "red");
                }
                var dtnhan = $(".TextBoxDienThoai2CheckOut").val();
                if (dtnhan === "") {
                    has_empty = false;
                    $(".TextBoxDienThoai2CheckOut").css("border-color", "red");
                }
                var dcnhan = $(".TextBoxDiaChi2CheckOut").val();
                if (dcnhan === "") {
                    has_empty = false;
                    $(".TextBoxDiaChi2CheckOut").css("border-color", "red");
                }
            }
            else {
                $(".frm-nhan").hide(300);
            }
            var capcha = $(".txtCaptchaCheckOut").val();
            if (capcha === "") {
                has_empty = false;
                $(".txtCaptchaCheckOut").css("border-color", "red");
            }
            else {
                var macode = $("input[name*='HiddenFieldCode']").val();
                if (capcha !== macode) {
                    has_empty = false;
                    $(".txtCaptchaCheckOut").css("border-color", "red");
                }
            }
            if (has_empty === false) {
                return false;
            }
            else {
                $(".sendCheckOut").val("Đang xử lý...");
            }
        });

        //==================================================== Comment ==================
        $(".TextBoxNameComment").focus(function () {
            $(this).css("border-color", "#d8d8d8");
        });
        $(".TextBoxNameComment").blur(function () {
            if ($(this).val() === "") {
                $(this).css("border-color", "red");
            }
            else {
                $(this).css("border-color", "#d8d8d8");
            }
        });
        $(".TextBoxEmailComment").focus(function () {
            $(this).css("border-color", "#d8d8d8");
        });
        $(".TextBoxEmailComment").blur(function () {
            var email = $(this).val();
            if (email === "" || testEmail.test(email) === false) {
                $(this).css("border-color", "red");
            }
            else {
                $(this).css("border-color", "#d8d8d8");
            }
        });
        $(".TextBoxNoiDungComment").focus(function () {
            $(this).css("border-color", "#d8d8d8");
        });
        $(".TextBoxNoiDungComment").blur(function () {
            var comment = $(this).val();
            if (comment === "" || comment.length < 25) {
                $(this).css("border-color", "red");
            }
            else {
                $(this).css("border-color", "#d8d8d8");
            }
        });
        $(".btnSendComment").click(function () {
            var fullname = $('.TextBoxNameComment').val();
            var email = $('.TextBoxEmailComment').val();
            var message = $('.TextBoxNoiDungComment').val();
            var pid = $("input[name*='HiddenFieldpIdComment']").val();
            var star = $("input[name*='HiddenFieldNumberStar']").val();
            var memid = $("input[name*='HiddenFieldMemId']").val();
            var has_empty = true;
            if (fullname === "" || fullname.length < 5) {
                has_empty = false;
                $(".TextBoxNameComment").css("border-color", "red");
            }
            if (email === "" || testEmail.test(email) === false) {
                has_empty = false;
                $(".TextBoxEmailComment").css("border-color", "red");
            }
            if (message === "" || message.length < 25) {
                has_empty = false;
                $(".TextBoxNoiDungComment").css("border-color", "red");
            }
            if (star === "" || star === "0") {
                has_empty = false;
                $(".error-comment").css("display", "block");
                $(".number-star").css("color", "red");
            }
            if (has_empty === false) {
                return false;
            }
            else {
                $('.btnSendComment').attr("disabled", true);
                $('#btnSentWait').show(200);
                var data = {
                    fullname: fullname,
                    email: email,
                    message: message,
                    pid: pid,
                    star: star,
                    memid: memid
                };
                $.post('./getdatacommentform.html', data, function (result) {
                    if (result.trim() === "success") {
                        $('.TextBoxNameComment').val('');
                        $('.TextBoxEmailComment').val('');
                        $('.TextBoxPhoneComment').val('');
                        $('.TextBoxNoiDungComment').val('');
                        $(".TextBoxNameComment").css("border-color", "#d8d8d8");
                        $(".TextBoxEmailComment").css("border-color", "#d8d8d8");
                        $(".TextBoxNoiDungComment").css("border-color", "#d8d8d8");
                        $("input[name*='HiddenFieldNumberStar']").val(0);
                        $('.starrr span').nextAll().removeClass('glyphicon-star');
                        $('.starrr span').prevAll().andSelf().addClass('glyphicon-star-empty');
                        $(".number-star").css("color", "#c7c7c7");
                        $('#btnSentWait').hide(200);
                        $('#senComment_success').show(200);
                        setTimeout(function () {
                            $('#senComment_success').hide(300);
                            $('.btnSendComment').attr("disabled", false);
                        }, 10000);
                        //console.log("success! " + result.trim());
                    } else {
                        $('#senComment_error').html(result);
                        $('#btnSentWait').hide(200);
                        $('#senComment_error').show(200);
                        setTimeout(function () {
                            //$('#senComment_error').hide(300);
                            $('.btnSendComment').attr("disabled", false);
                        }, 10000);
                        //console.log("not success! " + result.trim());
                    }
                });
            }
        });
        $(document).on('click', '.post-controls', function () {
            var type = "1";
            var anchorLink = $(this);
            var sectionCount = anchorLink.attr('data-num');
            sectionCount = parseInt(sectionCount) + 1;
            if (anchorLink.hasClass('like')) {
                type = "1";
                anchorLink.removeClass("like");
                anchorLink.addClass("liked");
                anchorLink.html("<i class='fa fa-thumbs-up'></i> <span>" + sectionCount + "</span> thích");
            }
            else {
                if (parseInt(sectionCount) > 0) {
                    sectionCount = parseInt(sectionCount) - 1;
                }
                type = "0";
                anchorLink.removeClass("liked");
                anchorLink.addClass("like");
                anchorLink.html("<i class='fa fa-thumbs-down'></i> <span>" + sectionCount + "</span> thích");
            }
            // AJAX Request
            var sectionID = anchorLink.attr('data-id');
            var data = {
                type: type,
                id: sectionID
            };
            $.post("./likeunlike.html", data, function (data) {
                if (data.trim() === "success") {
                    setTimeout(function () {
                        anchorLink.removeClass("liked");
                        anchorLink.addClass("like");
                        anchorLink.attr('data-num', sectionCount);
                    }, 10000);
                    //console.log("Liked success!");
                } else {
                    console.log("Liked not success! " + data.trim());
                }
            });
        });
        $(document).on('click', '.delete_cartorder', function () {
            // AJAX Request
            var anchorLink = $(this);
            var sectionID = anchorLink.attr('data-id');
            var cid = anchorLink.attr('data-cid');
            var type = anchorLink.attr('data-type');
            var danhsach = anchorLink.attr('data-list');
            var data = {
                type: type,
                cid: cid,
                id: sectionID
            };
            anchorLink.html("...");
            anchorLink.attr("disabled", false);
            $.post("./deleteshoppingcarttemp.html", data, function (data) {
                if (data.trim() === "v") { // đã xem
                    anchorLink.closest(danhsach).remove().fadeOut(300);
                    var itemCount = $(".viewdlist-number").text().replace(/\,/g, '');
                    if (itemCount === "") {
                        itemCount = 0;
                    }
                    itemCount = parseInt(itemCount) - 1;
                    if (itemCount < 0) {
                        itemCount = 0;
                    }
                    $(".viewdlist-number").html(itemCount);
                    //console.log("Delete success!");
                    if ($('#myTableViewed').length > 0) {
                        var rowCount = $('#myTableViewed >tbody >tr').length;
                        if (rowCount <= 0) {
                            $('#myTableViewed').hide(300);
                            if ($('#more_myTableViewed').length > 0) {
                                $('#more_myTableViewed').hide(300);
                            }
                            $('#thongbao_cart').show(300);
                        }
                    }
                    else {
                        if ($('#myListViewed').length > 0) {
                            var rowCount2 = $('#myListViewed li').length;
                            if (rowCount2 <= 0) {
                                $('#myListViewed').hide(300);
                                if ($('#more_myTableViewed').length > 0) {
                                    $('#more_myTableViewed').hide(300);
                                }
                                $('#thongbao_cart').show(300);
                            }
                        }
                    }

                }
                else if (data.trim() === "w") { // yêu thích
                    anchorLink.closest(danhsach).remove().fadeOut(300);
                    var itemCountwishlist = $(".wishlist-number").text().replace(/\,/g, '');
                    if (itemCountwishlist === "") {
                        itemCountwishlist = 0;
                    }
                    itemCountwishlist = parseInt(itemCountwishlist) - 1;
                    if (itemCountwishlist < 0) {
                        itemCountwishlist = 0;
                    }
                    $(".wishlist-number").html(itemCountwishlist);
                    //console.log("Delete success!");
                    var rowCountwishlist = ""; // $('#myTableWish >tbody >tr').length;
                    if (danhsach === "li") {
                        rowCountwishlist = $('#myTableWish li').length;
                    }
                    else {
                        rowCountwishlist = $('#myTableWish >tbody >tr').length;
                    }
                    if (rowCountwishlist <= 0) {
                        $('#myTableWish').hide(300);
                        $('.footer_swish').hide(300);
                        if ($('#sendform_swish').length > 0) {
                            $('#sendform_swish').hide(300);
                        }
                        if ($('#more_myTableWish').length > 0) {
                            $('#more_myTableWish').hide(300);
                        }
                        $('#thongbao_cart').show(300);
                    }

                }
                else if (data.trim() === "c") { // giỏ hàng
                    anchorLink.closest("tr").remove().fadeOut(300);
                    var itemCountcart = $(".cartlist-number").text().replace(/\,/g, '');
                    if (itemCountcart === "") {
                        itemCountcart = 0;
                    }
                    itemCountcart = parseInt(itemCountcart) - 1;
                    if (itemCountcart < 0) {
                        itemCountcart = 0;
                    }
                    $(".cartlist-number").html(itemCountcart);
                    //console.log("Delete success!");
                    var rowCountcart = $('#myTableCart >tbody >tr').length;
                    //if (danhsach === "li") {
                    //    rowCountcart = $('#myTableCart li').length;
                    //}
                    //else {
                    //    rowCountcart = $('#myTableCart >tbody >tr').length;
                    //}
                    if (rowCountcart <= 0) {
                        $('#myTableCart').hide(300);
                        $('.more_footerCart').hide(300);
                        if ($('#more_myTableCart').length > 0) {
                            $('#more_myTableCart').hide(300);
                        }
                        $('#thongbao_cart').show(300);
                    }
                    else {
                        // Tính lại Row
                        var sum = 0.0;
                        var quantity;
                        $('#myTableCart > tbody  > tr').each(function () {
                            quantity = $(this).find('.number_card_item').val();
                            var price = parseFloat($(this).find('.price_card_item').attr('data-price').replace(',', '.'));
                            var amount = quantity * price;
                            sum += amount;
                            $(this).find('.amount_card_item').text(formatDollar(amount));
                        });
                        $('.total_card_item').text(formatDollar(sum));
                    }

                }
                else {
                    anchorLink.html("<i class='fa fa-times'></i>");
                    anchorLink.attr("disabled", true);
                    console.log("Delete not success! " + data.trim());
                }
            });
        });
        function formatDollar(num) {
            var p = num.toFixed(2).split(".");
            return p[0].split("").reverse().reduce(function (acc, num, i, orig) {
                return num === "-" ? acc : num + (i && !(i % 3) ? "," : "") + acc;
            }, "");
        }
        //====================================================End Comment ==================
        /* Send conttact*/
        //$('.sky-form .custom-label').css('display', 'none');
        $(".TextBoxHoTenContact").focus(function () {
            $(this).css("border-color", "#d8d8d8");
        });
        $(".TextBoxHoTenContact").blur(function () {
            if ($(this).val() === "" || $(this).val().length < 5) {
                $(this).css("border-color", "red");
            }
            else {
                $(this).css("border-color", "#d8d8d8");
            }
        });
        $(".TextBoxEmailContact").focus(function () {
            $(this).css("border-color", "#d8d8d8");
        });
        $(".TextBoxEmailContact").blur(function () {
            var email = $(this).val();
            if (email === "" || testEmail.test(email) === false) {
                $(this).css("border-color", "red");
            }
            else {
                $(this).css("border-color", "#d8d8d8");
            }
        });
        $(".TextBoxPhoneContact").focus(function () {
            $(this).css("border-color", "#d8d8d8");
        });
        $(".TextBoxPhoneContact").blur(function () {
            if ($(this).val() === "" || $(this).val().length < 9) {
                $(this).css("border-color", "red");
            }
            else {
                $(this).css("border-color", "#d8d8d8");
            }
        });
        $(".TextBoxNoiDungContact").focus(function () {
            $(this).css("border-color", "#d8d8d8");
        });
        $(".TextBoxNoiDungContact").blur(function () {
            var comment = $(this).val();
            if (comment === "" || comment.length < 25) {
                $(this).css("border-color", "red");
            }
            else {
                $(this).css("border-color", "#d8d8d8");
            }
        });
        $(document).on('click', '.btnsend_contact', function () {
            var fullname = $('.TextBoxHoTenContact').val();
            var email = $('.TextBoxEmailContact').val();
            var phone = $('.TextBoxPhoneContact').val();
            var message = $('.TextBoxNoiDungContact').val();
            var pid = $("input[name*='HiddenFieldpIdContact']").val();

            var has_empty = true;
            if (fullname === "" || fullname.length < 5) {
                has_empty = false;
                $('.TextBoxHoTenContact').css("border-color", "red");
            }
            if (email === "" || testEmail.test(email) === false) {
                has_empty = false;
                $('.TextBoxEmailContact').css("border-color", "red");
            }
            if (phone === "" || phone.length < 9) {
                has_empty = false;
                $('.TextBoxPhoneContact').css("border-color", "red");
            }
            if (message === "" || message.length < 25) {
                has_empty = false;
                $('.TextBoxNoiDungContact').css("border-color", "red");
            }
            if (has_empty === false) {
                return false;
            }
            else {
                $('.btnsend_contact').attr("disabled", true);
                $('#btnSentWait').show(200);
                var data = {
                    fullname: fullname,
                    email: email,
                    phone: phone,
                    message: message,
                    pid: pid
                };
                $.post('./getdatacontactform.html', data, function (result) {
                    if (result.trim() === "success") {
                        $('.TextBoxHoTenContact').val('');
                        $('.TextBoxEmailContact').val('');
                        $('.TextBoxPhoneContact').val('');
                        $('.TextBoxNoiDungContact').val('');
                        $(".TextBoxHoTenContact").css("border-color", "#d8d8d8");
                        $(".TextBoxEmailContact").css("border-color", "#d8d8d8");
                        $(".TextBoxPhoneContact").css("border-color", "#d8d8d8");
                        $(".TextBoxNoiDungContact").css("border-color", "#d8d8d8");
                        $('#sencontact_success').show(200);
                        //console.log("success! " + result.trim());
                        //$('.btnsend_contact').attr("disabled", false);
                        $('#btnSentWait').hide(200);
                        setTimeout(function () {
                            $('#sencontact_success').hide(200);
                            $('.btnsend_contact').attr("disabled", false);
                        }, 10000);
                    } else {
                        $('#sencontact_error').html(result);
                        $('#sencontact_error').show(200);
                        $('.btnsend_contact').attr("disabled", false);
                        $('#btnSentWait').hide(200);
                        setTimeout(function () {
                            //$('#sencontact_error').hide(300);
                            $('.btnsend_contact').attr("disabled", false);
                        }, 10000);
                        //console.log("not success! " + result.trim());
                    }
                });
            }
        });
        /* End Send conttact*/
		 /* Send Popup*/
        $(".TextBoxHoTenPupup").focus(function () {
            $(this).css("border-color", "#d8d8d8");
        });
        $(".TextBoxHoTenPopup").blur(function () {
            if ($(this).val() === "" || $(this).val().length < 5) {
                $(this).css("border-color", "red");
            }
            else {
                $(this).css("border-color", "#d8d8d8");
            }
        });
        $(".TextBoxEmailPopup").focus(function () {
            $(this).css("border-color", "#d8d8d8");
        });
        $(".TextBoxEmailPopup").blur(function () {
            var email = $(this).val();
            if (email === "" || testEmail.test(email) === false) {
                $(this).css("border-color", "red");
            }
            else {
                $(this).css("border-color", "#d8d8d8");
            }
        });
        $(".TextBoxPhonePopup").focus(function () {
            $(this).css("border-color", "#d8d8d8");
        });
        $(".TextBoxPhonePopup").blur(function () {
            if ($(this).val() === "" || $(this).val().length < 9) {
                $(this).css("border-color", "red");
            }
            else {
                $(this).css("border-color", "#d8d8d8");
            }
        });
        $(".TextBoxTitlePopup").focus(function () {
            $(this).css("border-color", "#d8d8d8");
        });
        $(".TextBoxTitlePopup").blur(function () {
            if ($(this).val() === "" || $(this).val().length < 9) {
                $(this).css("border-color", "red");
            }
            else {
                $(this).css("border-color", "#d8d8d8");
            }
        });
        $(".TextBoxNoiDungPopup").focus(function () {
            $(this).css("border-color", "#d8d8d8");
        });
        $(".TextBoxNoiDungPopup").blur(function () {
            var comment = $(this).val();
            if (comment === "" || comment.length < 25) {
                $(this).css("border-color", "red");
            }
            else {
                $(this).css("border-color", "#d8d8d8");
            }
        });
        $(document).on('click', '.btnsend_Popup', function () {
            var fullname = $('.TextBoxHoTenPopup').val();
            var email = $('.TextBoxEmailPopup').val();
            var phone = $('.TextBoxPhonePopup').val();
            var tieude = $('.TextBoxTitlePopup').val();
            var message = $('.TextBoxNoiDungPopup').val();
            var pid = "0"; //$("input[name*='HiddenFieldpIdPopup']").val();

            var has_empty = true;
            if (fullname === "" || fullname.length < 5) {
                has_empty = false;
                $('.TextBoxHoTenPopup').css("border-color", "red");
            }
            if (email === "" || testEmail.test(email) === false) {
                has_empty = false;
                $('.TextBoxEmailPopup').css("border-color", "red");
            }
            if (phone === "" || phone.length < 9) {
                has_empty = false;
                $('.TextBoxPhonePopup').css("border-color", "red");
            }
            if (tieude === "" || tieude.length < 9) {
                has_empty = false;
                $('.TextBoxTitlePopup').css("border-color", "red");
            }
            if (message === "" || message.length < 25) {
                has_empty = false;
                $('.TextBoxNoiDungPopup').css("border-color", "red");
            }
            if (has_empty === false) {
                return false;
            }
            else {
                $('.btnsend_Popup').attr("disabled", true);
                $('#btnSentWait').show(200);
                var data = {
                    fullname: fullname,
                    email: email,
                    phone: phone,
                    tieude: tieude,
                    message: message,
                    pid: pid
                };
                $.post('./getdatapopupform.html', data, function (result) {
                    if (result.trim() === "success") {
                        $('.TextBoxHoTenPopup').val('');
                        $('.TextBoxEmailPopup').val('');
                        $('.TextBoxPhonePopup').val('');
                        $('.TextBoxTitlePopup').val('');
                        $('.TextBoxNoiDungPopup').val('');
                        $(".TextBoxHoTenPopup").css("border-color", "#d8d8d8");
                        $(".TextBoxEmailPopup").css("border-color", "#d8d8d8");
                        $(".TextBoxPhonePopup").css("border-color", "#d8d8d8");
                        $(".TextBoxNoiDungPopup").css("border-color", "#d8d8d8");
                        $('#sencontact_success').show(200);
                        //console.log("success! " + result.trim());
                        $('#btnSentWait').hide(200);
                        setTimeout(function () {
                            $('#sencontact_success').hide(200);
                            $('.btnsend_Popup').attr("disabled", false);
                        }, 10000);
                    } else {
                        $('#sencontact_error').html(result);
                        $('#sencontact_error').show(200);
                        $('.btnsend_Popup').attr("disabled", false);
                        $('#btnSentWait').hide(200);
                        setTimeout(function () {
                            $('.btnsend_Popup').attr("disabled", false);
                        }, 10000);
                        //console.log("not success! " + result.trim());
                    }
                });
            }
        });
        /* End Send Popup*/
		 /* Send Home*/
        $(".TextBoxHoTenSendHome").focus(function () {
            $(this).css("border-color", "#d8d8d8");
        });
        $(".TextBoxHoTenSendHome").blur(function () {
            if ($(this).val() === "" || $(this).val().length < 5) {
                $(this).css("border-color", "red");
            }
            else {
                $(this).css("border-color", "#d8d8d8");
            }
        });
        $(".TextBoxEmailSendHome").focus(function () {
            $(this).css("border-color", "#d8d8d8");
        });
        $(".TextBoxEmailSendHome").blur(function () {
            var email = $(this).val();
            if (email === "" || testEmail.test(email) === false) {
                $(this).css("border-color", "red");
            }
            else {
                $(this).css("border-color", "#d8d8d8");
            }
        });
        $(".TextBoxPhoneSendHome").focus(function () {
            $(this).css("border-color", "#d8d8d8");
        });
        $(".TextBoxPhoneSendHome").blur(function () {
            if ($(this).val() === "" || $(this).val().length < 9) {
                $(this).css("border-color", "red");
            }
            else {
                $(this).css("border-color", "#d8d8d8");
            }
        });
        $(".TextBoxTitleSendHome").focus(function () {
            $(this).css("border-color", "#d8d8d8");
        });
        $(".TextBoxTitleSendHome").blur(function () {
            if ($(this).val() === "" || $(this).val().length < 9) {
                $(this).css("border-color", "red");
            }
            else {
                $(this).css("border-color", "#d8d8d8");
            }
        });
        $(".TextBoxNoiDungSendHome").focus(function () {
            $(this).css("border-color", "#d8d8d8");
        });
        $(".TextBoxNoiDungSendHome").blur(function () {
            var comment = $(this).val();
            if (comment === "" || comment.length < 25) {
                $(this).css("border-color", "red");
            }
            else {
                $(this).css("border-color", "#d8d8d8");
            }
        });
        $(document).on('click', '.btnsend_SendHome', function () {
            var fullname = $('.TextBoxHoTenSendHome').val();
            var email = $('.TextBoxEmailSendHome').val();
            var phone = $('.TextBoxPhoneSendHome').val();
            var tieude = $('.TextBoxTitleSendHome').val();
            var message = $('.TextBoxNoiDungSendHome').val();
            var pid = $("input[name*='HiddenFieldpIdSendHome']").val();
            if (pid === '' || pid === 'undefined') {
                pid = "0";
            }
            var has_empty = true;
            if (fullname === "" || fullname.length < 5) {
                has_empty = false;
                $('.TextBoxHoTenSendHome').css("border-color", "red");
            }
            if (email === "" || testEmail.test(email) === false) {
                has_empty = false;
                $('.TextBoxEmailSendHome').css("border-color", "red");
            }
            if (phone === "" || phone.length < 9) {
                has_empty = false;
                $('.TextBoxPhoneSendHome').css("border-color", "red");
            }
            if (tieude === "" || tieude.length < 9) {
                has_empty = false;
                $('.TextBoxTitleSendHome').css("border-color", "red");
            }
            if (message === "" || message.length < 25) {
                has_empty = false;
                $('.TextBoxNoiDungSendHome').css("border-color", "red");
            }
            if (has_empty === false) {
                return false;
            }
            else {
                $('.btnsend_SendHome').attr("disabled", true);
                $('#btnSentWait').show(200);
                var data = {
                    fullname: fullname,
                    email: email,
                    phone: phone,
                    tieude: tieude,
                    message: message,
                    pid: pid
                };
                $.post('./getdatapopupform.html', data, function (result) {
                    if (result.trim() === "success") {
                        $('.TextBoxHoTenSendHome').val('');
                        $('.TextBoxEmailSendHome').val('');
                        $('.TextBoxPhoneSendHome').val('');
                        $('.TextBoxTitleSendHome').val('');
                        $('.TextBoxNoiDungSendHome').val('');
                        $(".TextBoxHoTenSendHome").css("border-color", "#d8d8d8");
                        $(".TextBoxEmailSendHome").css("border-color", "#d8d8d8");
                        $(".TextBoxPhoneSendHome").css("border-color", "#d8d8d8");
                        $(".TextBoxNoiDungSendHome").css("border-color", "#d8d8d8");
                        $('#sencontact_success').show(200);
                        //console.log("success! " + result.trim());
                        $('#btnSentWait').hide(200);
                        setTimeout(function () {
                            $('#sencontact_success').hide(200);
                            $('.btnsend_SendHome').attr("disabled", false);
                        }, 10000);
                    } else {
                        $('#sencontact_error').html(result);
                        $('#sencontact_error').show(200);
                        $('.btnsend_SendHome').attr("disabled", false);
                        $('#btnSentWait').hide(200);
                        setTimeout(function () {
                            $('.btnsend_SendHome').attr("disabled", false);
                        }, 10000);
                        //console.log("not success! " + result.trim());
                    }
                });
            }
        });
        /* End Send SendHome*/
        // Quick view
        //$(document).on('click', '.quick-view .search,a.quick-view', function () {
        //    var data = {
        //    }
        //    $.post('quick_view.html', data, function (response) {
        //        $.fancybox(response, {
        //            // fancybox API options
        //            fitToView: false,
        //            autoSize: false,
        //            closeClick: false,
        //            openEffect: 'none',
        //            closeEffect: 'none'
        //        }); // fancybox
        //        // OWL Product thumb
        //        $('.product-img-thumb .owl-carousel').owlCarousel(
        //            {
        //                dots: false,
        //                nav: true,
        //                navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
        //                margin: 21,
        //                responsive: {
        //                    // breakpoint from 0 up
        //                    0: {
        //                        items: 2,
        //                    },
        //                    // breakpoint from 480 up
        //                    480: {
        //                        items: 2,
        //                    },
        //                    // breakpoint from 768 up
        //                    768: {
        //                        items: 2,
        //                    },
        //                    1000: {
        //                        items: 3,
        //                    }
        //                }
        //            }
        //        );
        //    })
        //    return false;
        //})
        $('.fancybox').fancybox({
            prevEffect: 'none',
            nextEffect: 'none',

            closeBtn: false,
            arrows: false,
            nextClick: true,

            autoCenter: true,

            helpers: {
                thumbs: {
                    width: 75,
                    height: 75
                }
            },
            afterShow: function () {
                $('.zoomContainer').remove();
                $('img.fancybox-image').elevateZoom({
                    zoomType: "inner", 
					cursor: "crosshair",
                    zoomWindowFadeIn: 500,
                    zoomWindowFadeOut: 750
                });
            },
            afterClose: function () {
                $('.zoomContainer').remove();
            }
        });

        $(document).on('click', '.block-quickview .product-img-thumb a', function () {
            var image = $(this).data('image');
            $(this).closest('.product-image').find('.product-full img').attr('src', image);
            return false;
        })
		  if ($('.giuseart-nav').length) {
        $(".add-map").click(function () {
            var title = $(this).attr('data-title');
            var curentUrl = $(this).attr('data-href');
            //$("#loadViewPro").load(curentUrl);
            $(".bs-example-modal-lg").find('.modal-header > .modal-title').text(title);
            $(".bs-example-modal-lg").find('#loadViewPro').html(curentUrl);
            $('.bs-example-modal-lg').modal();
        });
        }
        $(".adprobook").click(function () {
            var sectionID = $(this).attr('data-id');
            var title = $(this).attr('data-title');
            $("#loadViewPro").load(location.href.substring(0, location.href.lastIndexOf('/')) + "/add-book/" + sectionID + ".aspx");
            $(".bs-example-modal-lg").find('.modal-header > .modal-title').text(title);
            $('.bs-example-modal-lg').modal();
        });
        $(".adbook").click(function () {
            var sectionID = $(this).attr('data-id');
            var title = $(this).attr('data-title');
            $("#loadViewPro").load(location.href.substring(0, location.href.lastIndexOf('/')) + "/send-book/" + sectionID + ".aspx");
            $(".bs-example-modal-lg").find('.modal-header > .modal-title').text(title);
            $('.bs-example-modal-lg').modal();
        });
        if ($('table').length > 0) {
            $(".center_column table").addClass('table table-bordered');
        }
        if ($('.products-style8').length > 0) {
            $('.products-style8').each(function () {
                $(this).find(".nav-tab2 li a").on('click', function (event) {
                    event.preventDefault();
                    $(this).parents('.products-style8').find(".nav-tab2 li").removeClass('active');
                    $(this).addClass('active');
                    var z_url = $(this).find('img').attr("src");
                    var z_Name = $(this).find('img').attr("alt");
                    $(this).parents('.products-style8').find(".product .product-container .product-thumb a img").attr("src", z_url.replace("Thumb_", ""));
                    $(this).parents('.products-style8').find(".tab-container .tab-panel .name-color").innerHTML(z_Name);
                });
            });
        }
		 if ($('.system-box').length > 0) {
            $('.system-box').each(function () {
                $(this).find(".nav-tab2 li a").on('click', function (event) {
                    event.preventDefault();
                    $(this).parents('.system-box').find(".nav-tab2 li").removeClass('active');
                    $(this).addClass('active');
                    $(this).parents('.system-box').find(".tab-system.tab-container .tab-panel").removeClass('active');
					$(this).addClass('active');
                });
            });
        }
        if ($('.box-center-home').length > 0) {
            $('.video').click(function () { this.paused ? this.play() : this.pause(); });
        }
        if ($('.partner').length > 0) {
            $('.category-page').find('.section-band-logo').hide();
        }

        //Poppup video
        if ($('.video-btn').length > 0) {
            $('.video-btn').fancybox();
        }
        //Video Light Box
        if ($('.btn-video').length > 0) {
            $('.btn-video').fancybox({
                openEffect: 'none',
                closeEffect: 'none',
                prevEffect: 'none',
                nextEffect: 'none',

                arrows: false,
                helpers: {
                    media: {},
                    buttons: {}
                }
            });
        }
        //Light Box
        if ($('.fancybox').length > 0) {
            $('.fancybox').fancybox({
                beforeShow: function () {
                    this.title = $(this.element).data("caption");
                },
                fullScreen: {
                    requestOnStart: true
                }
            }).attr('data-fancybox', 'gallery');
        }
        // Open form search in header 10
        $(document).on('click', '.form-search .icon', function () {
            $(this).closest('.form-search').find('.form-search-inner').fadeIn(600);
            $(this).closest('.form-search').find('.form-search-inner .input-serach input').focus();
        });
        /* Close form search in header 10*/
        $(document).on('click', '*', function (e) {
            var container = $(".form-search");
            var icon = $(".form-search .icon");
            if (!container.is(e.target) && container.has(e.target).length === 0 && !icon.is(e.target) && icon.has(e.target).length === 0) {
                container.find('.form-search-inner').fadeOut(600);
            }
        });

        //SLIDE FULL SCREEN
        var slideSection = $(".slide-fullscreen .item-slide");
        slideSection.each(function () {
            if ($(this).attr("data-background")) {
                $(this).css("background-image", "url(" + $(this).data("background") + ")");
            }
        });
        // 
        $(document).on('click', '.block-tab-category .bar', function () {
            $(this).toggleClass('active');
            $(this).closest('.block-tab-category').find('.tab-cat').toggleClass('show');
        });
        //testimonial-carousel
        if ($('.testimonial-carousel').length > 0) {
            var owl = $('.testimonial-carousel');
            owl.owlCarousel(
                {
                    margin: 30,
                    autoplay: false,
                    dots: false,
                    loop: true,
                    items: 3,
                    nav: true,
                    smartSpeed: 1000,
                    navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>']
                }
            );
            owl.trigger('next.owl.carousel');
            owl.on('changed.owl.carousel', function (event) {
                owl.find('.owl-item.active').removeClass('item-center');
                var caption = owl.find('.owl-item.active').first().next().find('.info').html();
                owl.closest('.block-testimonials,.block-testimonials2').find('.testimonial-caption').html(caption).addClass('zoomIn animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
                    $(this).removeClass('zoomIn animated');
                });;
                setTimeout(function () {
                    owl.find('.owl-item.active').first().next().addClass('item-center');
                    owl.find('.owl-item.active').first().next().addClass('zoomIn animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
                        $(this).removeClass('zoomIn animated');
                    });
                }, 100);
            });

        }
        if ($('.testimonial-carousel2').length > 0) {
            var owl = $('.testimonial-carousel2');
            owl.owlCarousel(
                {
                    margin: 0,
                    autoplay: true,
                    dots: false,
                    loop: true,
                    items: 3,
                    nav: false,
                    smartSpeed: 1000,
                    navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>']
                }
            );
            owl.trigger('next.owl.carousel');
            owl.on('changed.owl.carousel', function (event) {
                owl.find('.owl-item.active').removeClass('item-center');
                var caption = owl.find('.owl-item.active').first().next().find('.info').html();
                owl.closest('.block-testimonials,.block-testimonials2').find('.testimonial-caption').html(caption).addClass('fadeIn animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
                    $(this).removeClass('fadeIn animated');
                });
                setTimeout(function () {
                    owl.find('.owl-item.active').first().next().addClass('item-center');
                    owl.find('.owl-item.active').first().next().addClass('fadeIn animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
                        $(this).removeClass('fadeIn animated');
                    });
                }, 100);
            });
        }
        $('.list-brand').bxSlider({
            mode: 'vertical',
            minSlides: 4,
            maxSlides: 3,
            pager: false,
            useCSS: false
        });
        if ($('.box-product-carousel').length > 0) {
            var owl2 = $('.box-product-carousel');
            owl2.owlCarousel(
                {
                    margin: 0,
                    autoplay: true,
                    dots: false,
                    loop: false,
                    items: 1,
                    nav: true,
                    smartSpeed: 1000,
                    navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>']
                }
            );
        }
        $("#navbar .navbar-nav li a").click(function () {
            var pageId = $(this).attr("data-page");
            $("html, body").animate({ scrollTop: $("#" + pageId).offset().top }, 1000);
        });
        //$('#navbar .navbar-nav li a[href="#"]').click(function (event) {
        //    event.preventDefault();
        //});
        $('#navbar .navbar-nav li a.nav-link').click(function (event) {
            event.preventDefault();
        });
        //
        $(document).on('click', '.block-top-brands2 .list-brands a', function () {
            var tab = $(this).attr('href');
            $(this).closest('.list-brands').find('a.tab-nav').each(function () {
                $(this).removeClass('active');
            });
            $(this).addClass('active');
            $(this).closest('.block-top-brands2').find('.brand-products .tab-panel').each(function () {
                $(this).removeClass('active');
            });
            $(tab).addClass('active');
            return false;
        });
    });
    $(window).load(function () {
        if ($('.list-photo').length > 0) {
            $('.list-photo').masonry({
                "itemSelector": ".item",
                "columnWidth": ".grid-sizer"
            });
        }

    });
    $(document).ready(function () {
        // Get media - with autoplay disabled (audio or video)
        var media = $('video').not("[autoplay='autoplay']");
        var tolerancePixel = 40;

        function checkMedia() {
            // Get current browser top and bottom
            var scrollTop = $(window).scrollTop() + tolerancePixel;
            var scrollBottom = $(window).scrollTop() + $(window).height() - tolerancePixel;

            media.each(function (index, el) {
                var yTopMedia = $(this).offset().top;
                var yBottomMedia = $(this).height() + yTopMedia;

                if (scrollTop < yBottomMedia && scrollBottom > yTopMedia) { //view explaination in `In brief` section above
                    $(this).get(0).play();
                } else {
                    $(this).get(0).pause();
                }
            });

            //}
        }
        $(document).on('scroll', checkMedia);
    });
    /* ---------------------------------------------
     Scripts resize
     --------------------------------------------- */
    $(window).resize(function () {
        // auto width megamenu
        auto_width_megamenu();
        // Remove menu ontop
        remove_menu_ontop();
        // resize top menu
        resizeTopmenu();
        js_height_full();
        rep_menu();
        Product_slide();
    });
    /* ---------------------------------------------
     Scripts scroll
     --------------------------------------------- */
    $(window).scroll(function () {
        resizeTopmenu();
        rep_menu();
        Product_slide();
        /* Show hide scrolltop button */
        if ($(window).scrollTop() == 0) {
            $('.scroll-top').stop(false, true).fadeOut(600);
        } else {
            $('.scroll-top').stop(false, true).fadeIn(600);
        }
        /* Main menu on top */
        var h = $(window).scrollTop();
        var max_h = $('#header').height() + $('#top-banner').height();
        var width = $(window).width();
        if (width > 991) {
            if (h > 45) {
                $('#header').addClass('optop').removeClass('noptop');
                $('#nav-top-menu').addClass('nav-ontop');
            } else {
                $('#header').removeClass('optop').addClass('noptop');
                $('#nav-top-menu').removeClass('nav-ontop');
            }
            if (h > (max_h + vertical_menu_height) - 50) {
                // fix top menu

                $('#header').find('.vertical-menu-content').hide();
                //$('#nav-top-menu').find('.title').removeClass('active');
                // add cart box on top menu
                //$('.btn-cart .cart-block').appendTo('#shopping-cart-box-ontop .shopping-cart-box-ontop-content');
                //$('#shopping-cart-box-ontop').fadeIn();
                $('#user-info-top').appendTo('#user-info-opntop');
                //$('#header .header-search-box .form-inline').appendTo('#form-search-opntop');
            } else {

                if ($('body').hasClass('home')) {
                    $('#nav-top-menu').find('.vertical-menu-content').removeAttr('style');
                    if (width > 1024) {
                        $('#nav-top-menu').find('.vertical-menu-content').show();
                        $('.home #header').find('.vertical-menu-content').show();
                    } else {
                        $('#nav-top-menu').find('.vertical-menu-content').hide();
                    }
                    $('#nav-top-menu').find('.vertical-menu-content').removeAttr('style');
                }
                ///
                //$('#shopping-cart-box-ontop .cart-block').appendTo('.btn-cart');
                //$('#shopping-cart-box-ontop').fadeOut();
                $('#user-info-opntop #user-info-top').appendTo('.top-header .container');
                //$('#form-search-opntop .form-inline').appendTo('#header .header-search-box');
            }
        }
    });
    var vertical_menu_height = $('#box-vertical-megamenus .box-vertical-megamenus').innerHeight();
    /**==============================
    ***  Auto width megamenu
    ===============================**/
    function auto_width_megamenu() {
        var full_width = parseInt($('.container').innerWidth());
        //full_width = $( document ).width();
        var menu_width = parseInt($('.vertical-menu-content').actual('width'));
        $('.vertical-menu-content').find('.vertical-dropdown-menu').each(function () {
            $(this).width((full_width - menu_width) - 2);
        });
    }
    /**==============================
    ***  Remove menu on top
    ===============================**/
    function remove_menu_ontop() {
        var width = parseInt($(window).width());
        if (width < 768) {
            $('#nav-top-menu').removeClass('nav-ontop');
            if ($('body').hasClass('home')) {
                if (width > 1024)
                    $('#nav-top-menu').find('.vertical-menu-content').show();
                else {
                    $('#nav-top-menu').find('.vertical-menu-content').hide();
                }
            }
            ///
            $('#shopping-cart-box-ontop .cart-block').appendTo('#cart-block');
            $('#shopping-cart-box-ontop').fadeOut();
            $('#user-info-opntop #user-info-top').appendTo('.top-header .container');
            $('#form-search-opntop .form-inline').appendTo('#header .header-search-box');
            //left right
            $('#left_column .left-module').appendTo('#bottom_column');
        }
        else {
            $('#bottom_column .left-module').appendTo('#left_column');
        }
    }

    //if (".mega-menu".length > 0)
    //{
    //    var width = parseInt($(window).width());
    //    if (width < 768) {
    //        $(".dropdown-toggle").attr("data-toggle", "dropdown");
    //    }
    //}
    function Product_slide() {
        var width = $(window).width();
        if (width < 768) {
            $('#sliderproduct').addClass('box-product-carousel');
        }
        else {
            $('#sliderproduct').removeClass('box-product-carousel');
        }
    }
    /* Top menu*/
    function scrollCompensate() {
        var inner = document.createElement('p');
        inner.style.width = "100%";
        inner.style.height = "200px";
        var outer = document.createElement('div');
        outer.style.position = "absolute";
        outer.style.top = "0px";
        outer.style.left = "0px";
        outer.style.visibility = "hidden";
        outer.style.width = "200px";
        outer.style.height = "150px";
        outer.style.overflow = "hidden";
        outer.appendChild(inner);
        document.body.appendChild(outer);
        var w1 = parseInt(inner.offsetWidth);
        outer.style.overflow = 'scroll';
        var w2 = parseInt(inner.offsetWidth);
        if (w1 == w2) w2 = outer.clientWidth;
        document.body.removeChild(outer);
        return (w1 - w2);
    }

    function resizeTopmenu() {
        if ($(window).width() + scrollCompensate() >= 768) {
            var main_menu_w = $('#main-menu .navbar').innerWidth();

            if ($('#main-menu').hasClass('menu-option9') || $('#main-menu').hasClass('menu-option10') || $('#main-menu').hasClass('menu-option11') || $('#main-menu').hasClass('menu-option14')) {
                return false;
            }

            $("#main-menu ul.mega_dropdown").each(function () {
                var menu_width = $(this).innerWidth();
                var offset_left = $(this).position().left;
                if (menu_width > main_menu_w) {
                    $(this).css('width', main_menu_w + 'px');
                    $(this).css('left', '0');
                } else {
                    if ((menu_width + offset_left) > main_menu_w) {
                        var t = main_menu_w - menu_width;
                        var left = parseInt((t / 2));
                        $(this).css('left', left);
                    }
                }
            });
        }

        if ($(window).width() + scrollCompensate() < 1025) {
            $("#main-menu li.dropdown:not(.active) >a").attr('data-toggle', 'dropdown');
        } else {
            $("#main-menu li.dropdown >a").removeAttr('data-toggle');
        }
    }
    function js_swithlist() {
        //strFavouriteProductId
        (function ($) {
            if ($('.strFavouriteProductId').length > 0) {
                var productid = $(".strFavouriteProductId").html();
                if (productid.length > 0) {
                    var arr = productid.split(',');
                    $('body .addtowishlist').each(function () {
                        var anchorLink = $(this);
                        var sectionID = anchorLink.attr('data-id');
                        for (var i = 0; i < arr.length; i++) {
                            var aid = arr[i].trim();
                            if (aid === sectionID) {
                                if (anchorLink.hasClass('like')) {
                                    anchorLink.removeClass("like");
                                    anchorLink.addClass("liked");
                                }
                                else {
                                    anchorLink.addClass("liked");
                                }
                                break;
                            }
                            //console.log("success pid:" + sectionID + " - arr: " + aid);
                        }
                    });
                }
            }
        })(jQuery);
        (function ($) {
            if ($('.strShoppingCartProductId').length > 0) {
                var productid = $(".strShoppingCartProductId").html();
                if (productid.length > 0) {
                    var arr = productid.split(',');
                    $('body .addtocartlist').each(function () {
                        var anchorLink = $(this);
                        var sectionID = anchorLink.attr('data-id');
                        for (var i = 0; i < arr.length; i++) {
                            var aid = arr[i].trim();
                            if (aid === sectionID) {
                                if (anchorLink.hasClass('like')) {
                                    anchorLink.removeClass("like");
                                    anchorLink.addClass("liked");
                                }
                                else {
                                    anchorLink.addClass("liked");
                                }
                            }
                            //console.log("success pid:" + sectionID + " - arr: " + aid);
                        }
                    });
                }
            }
        })(jQuery);
    }
    /* ---------------------------------------------
     Height Full
     --------------------------------------------- */
    function js_height_full() {
        (function ($) {
            var heightSlide = $(window).outerHeight();
            $(".full-height").css("height", heightSlide);
        })(jQuery);
    }
    function rep_menu() {
        if ($(window).width() < 768) {
            $('#left_column .block').appendTo('#right_column');
        }
        else {
            $('#right_column .block').appendTo('#left_column');
        }
    }
})(jQuery); // End of use strict