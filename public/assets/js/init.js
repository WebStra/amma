$(document).ready(function() {
    $(".button-collapse").sideNav();

    // ecommerce
    $(".fb").fancybox({
        openEffect: 'none',
        closeEffect: 'none'
    });

    $('.dropdown_top_bar').dropdown({
        constrain_width: false,
        hover: true,
        belowOrigin: true,
    });
    $('ul.tabs').tabs();

    $('.navbar_dropdown').dropdown({
        inDuration: 300,
        outDuration: 225,
        constrain_width: true, // Does not change width of dropdown to that of the activator
        hover: true, // Activate on hover
        gutter: 0, // Spacing from edge
        belowOrigin: true, // Displays dropdown below the button
        //alignment: 'left' // Displays dropdown with edge aligned to the left of button
    });

    //add hover for product card

    $(".product_card .add_hover").click(function() {
        $(this).parents(".product_card").find(".hover").addClass("active");
    });
    $(".product_card .remove_hover").click(function() {
        $(this).parents(".product_card").find(".hover").removeClass("active");
    });
    //see more details
    $(".show_details").click(function() {

        var this_ = $(this).attr("data-show-id");

        if ($("#" + this_).hasClass("active")) {
            $("#" + this_).removeClass("active");
        } else {
            $("#" + this_).addClass("active");
        }
    });

    //activates materialize - select
    $('select:not(.no-init)').material_select();

    // owl carousell

    $('.owl-carousel.l-single').owlCarousel({
        //loop: true,
        margin: 10,
        // autoplay: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            993: {
                items: 1
            }
        }
    });
    $('.owl-carousel.m-l-single').owlCarousel({
        //loop: true,
        margin: 10,
        //autoplay: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 1
            }
        }
    });
    $('.owl-carousel.l-3').owlCarousel({
        //loop: true,
        margin: 10,
        //autoplay: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: true,
        navigation: true,
        navigationText: [
            "<i class='icon-chevron-left icon-white'><</i>",
            "<i class='icon-chevron-right icon-white'>></i>"
        ],
        responsive: {
            0: {
                items: 1
            },
            480: {
                items: 2
            },
            600: {
                items: 2
            },
            993: {
                items: 3
            }
        }
    });
    $('.owl-carousel.l-4').owlCarousel({
        loop: true,
        margin: 10,
        //autoplay: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: true,
        navigation: true,
        navigationText: [
            "<i class='icon-chevron-left icon-white'><</i>",
            "<i class='icon-chevron-right icon-white'>></i>"
        ],
        responsive: {
            0: {
                items: 1
            },
            480: {
                items: 2
            },
            600: {
                items: 3
            },
            993: {
                items: 4
            }
        }
    });


    //timer countdown


    //return time remaining
    function getTimeRemaining(endtime) {
        var t = Date.parse(endtime) - Date.parse(new Date());
        var seconds = Math.floor((t / 1000) % 60);
        var minutes = Math.floor((t / 1000 / 60) % 60);
        var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
        var days = Math.floor(t / (1000 * 60 * 60 * 24));
        return {
            'total': t,
            'days': days,
            'hours': hours,
            'minutes': minutes,
            'seconds': seconds
        };
    }

    // general function
    $.fn.countdown = function() {
        var clock = $(this);
        var daysSpan = $('.days', this);
        var hoursSpan = $('.hours', this);
        var minutesSpan = $('.minutes', this);
        var secondsSpan = $('.seconds', this);
        var endtime = $(this).attr("data-endtime");

        function updateClock() {
            var t = getTimeRemaining(endtime);
            daysSpan.html(t.days);
            hoursSpan.html(('0' + t.hours).slice(-2));
            minutesSpan.html(('0' + t.minutes).slice(-2));
            secondsSpan.html(('0' + t.seconds).slice(-2));
            if (t.total <= 0) {
                daysSpan.html("0");
                hoursSpan.html("0");
                minutesSpan.html("0");
                secondsSpan.html("0");
                clearInterval(timeinterval);

            }
        }

        updateClock(); // run function once at first to avoid delay
        var timeinterval = setInterval(updateClock, 1000);
    }

    $('.countdown').each(function() {
        $(this).countdown();
    });

    //slider with thumbnails

    $('#carousel').flexslider({
        animation: "slide",
        controlNav: false,
        animationLoop: false,
        slideshow: false,
        itemWidth: 111,
        itemMargin: 14,
        asNavFor: '#slider'
    });

    $('#slider').flexslider({
        animation: "slide",
        controlNav: false,
        animationLoop: false,
        slideshow: false,
        sync: "#carousel"
    });

    // counting



    $.fn.counting = function() {
        var this_ = $('input', this);
        var value = parseInt(this_.attr("value"), 10);

        function incrementValue() {
            value = isNaN(value) ? 0 : value;
            value++;
            this_.attr('value', value);
        }

        function decrementValue() {
            value = isNaN(value) ? 0 : value;
            value = value == 0 ? 1 : value;
            value--;
            this_.attr('value', value);
        }

        $(".in.left ", this).click(function() {
            decrementValue();
        });

        $(".in.right ", this).click(function() {
            incrementValue();
        });

    }

    $(".counting").counting();


    //star rating

    $(".starbox").starbox({
        average: 0.42,
        changeable: 'once',
        autoUpdateAverage: true,
        ghosting: true
    });


    //remove magnifier on mobile
    if ($(window).width() < 768) {

    }

    //clone btn 

    $(".add_clone_after").click(function(event) {
        var this_id = $(this).attr("data-id");
        var obj = $("#" + this_id + " .element.template").clone();
        $("#" + this_id + " .element").last().after(obj);
        $("#" + this_id + " .element").last().removeClass('template');
        $("#" + this_id + " .element").last().find("select").material_select();
    });

    //tabs to
    $(".tab-to").click(function() {
        $('ul.tabs').tabs('select_tab', 'achitarea');
    });

    function initialize() {
        var mapCanvas = document.getElementById('map');
        var mapOptions = {
            center: new google.maps.LatLng(47.046820, 28.888806),
            zoom: 15,
            scrollwheel: false,
            scaleControl: false,
            draggable: false,
            zoomControl: true,

            zoomControlOptions: {
                position: google.maps.ControlPosition.RIGHT_TOP
            },
            mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        var image = '/assets/images/ico/pin.png';
        var map = new google.maps.Map(mapCanvas, mapOptions);
        map.set('styles', [{
            "featureType": "landscape",
            "stylers": [{
                "saturation": -100
            }, {
                "lightness": 65
            }, {
                "visibility": "on"
            }]
        }, {
            "featureType": "poi",
            "stylers": [{
                "saturation": -100
            }, {
                "lightness": 51
            }, {
                "visibility": "simplified"
            }]
        }, {
            "featureType": "road.highway",
            "stylers": [{
                "saturation": -100
            }, {
                "visibility": "simplified"
            }]
        }, {
            "featureType": "road.arterial",
            "stylers": [{
                "saturation": -100
            }, {
                "lightness": 30
            }, {
                "visibility": "on"
            }]
        }, {
            "featureType": "road.local",
            "stylers": [{
                "saturation": -100
            }, {
                "lightness": 40
            }, {
                "visibility": "on"
            }]
        }, {
            "featureType": "transit",
            "stylers": [{
                "saturation": -100
            }, {
                "visibility": "simplified"
            }]
        }, {
            "featureType": "administrative.province",
            "stylers": [{
                "visibility": "off"
            }]
        }, {
            "featureType": "water",
            "elementType": "labels",
            "stylers": [{
                "visibility": "on"
            }, {
                "lightness": -25
            }, {
                "saturation": -100
            }]
        }, {
            "featureType": "water",
            "elementType": "geometry",
            "stylers": [{
                "hue": "#ffff00"
            }, {
                "lightness": -25
            }, {
                "saturation": -97
            }]
        }]);
        var beachMarker = new google.maps.Marker({
            position: {
                lat: 47.046820,
                lng: 28.888806
            },
            map: map,
            icon: image
        });

    }
    if (($("#map").length != 0)) {
        google.maps.event.addDomListener(window, 'load', initialize);
    }
    //$('#send-form').click();
    $('.filtru ul li a').click(function() {
        $( ".filtre-form" ).submit();
        //$('#send-form').click();
    });

    $('#sort-product').change(function(event) {
        var val = $(this).val();
        $('input[name="sort"]').val(val);
        setTimeout(function(){
            $( ".filtre-form" ).submit();
        },1500);
    });
    //$('select').material_select();
    if (($(".subscribe").length != 0)) {
        toastr.options = {
          "closeButton": false,
          "debug": false,
          "newestOnTop": false,
          "progressBar": false,
          "positionClass": "toast-top-right",
          "preventDuplicates": false,
          "onclick": null,
          "showDuration": "300",
          "hideDuration": "1000",
          "timeOut": "5000",
          "extendedTimeOut": "1000",
          "showEasing": "swing",
          "hideEasing": "linear",
          "showMethod": "fadeIn",
          "hideMethod": "fadeOut"
        }
        $('.subscribe').each(function() {
            var subscribe = $(this);
            var validator = subscribe.validate({
                onkeyup: false,
                errorClass: 'error',
                validClass: 'valid',
                errorPlacement: function(error, element) {
                    // Set positioning based on the elements position in the form
                    var elem = $(element);

                    // Check we have a valid error message
                    if (!error.is(':empty')) {
                        // Apply the tooltip only if it isn't valid
                        elem.filter(':not(.valid)').qtip({
                            overwrite: false,
                            content: error,
                            position: {
                                my: 'bottom left',
                                at: 'left top',
                                viewport: $(window),
                                adjust: {
                                   method: 'shift none'
                                }
                            },
                            show: {
                                event: false,
                                ready: true
                            },
                            hide: false,
                            style: {
                                classes: 'qtip-red qtip-shadow' // Make it red... the classic error colour!
                            }
                        }) // If we have a tooltip on this element already, just update its content
                        .qtip('option', 'content.text', error);
                    } // If the error is empty, remove the qTip
                    else {
                        elem.qtip('destroy');
                    }
                },
                success: $.noop,
                submitHandler: function (form) {
                    //toastr["success"]("I do not think that means what you think it means.");
                    var action = $(form).attr('action');
                    $.ajax({
                      type: 'POST',
                      url: action,
                      data: subscribe.serialize(),
                      success: function (data) {
                        var data = $.parseJSON(data);  
                        //var data = JSON.parse(data);
                        console.log(data);
                        if (data.type) {
                          toastr["success"]("Success.");
                        }else{
                            if (data.content.email.length > 0) {
                                toastr["error"](data.content.email);
                            }else{
                                toastr["error"]("Error.");
                            }
                          
                        }
                        $(form)[0].reset();
                      }
                 });
                 return false; // required to block normal submit since you used ajax
                }
            });
        });
    }

    toastr.options = {
      "closeButton": false,
      "debug": false,
      "newestOnTop": false,
      "progressBar": false,
      "positionClass": "toast-top-right",
      "preventDuplicates": false,
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "1000",
      "timeOut": "5000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }

    if (($(".send-form").length != 0)) {
        $('.send-form').each(function() {
            var subscribe = $(this);
            var validator = subscribe.validate({
                onkeyup: false,
                errorClass: 'error',
                validClass: 'valid',
                errorPlacement: function(error, element) {
                    // Set positioning based on the elements position in the form
                    var elem = $(element);

                    // Check we have a valid error message
                    if (!error.is(':empty')) {
                        // Apply the tooltip only if it isn't valid
                        elem.filter(':not(.valid)').qtip({
                            overwrite: false,
                            content: error,
                            position: {
                                my: 'left center',
                                at: 'right center',
                                viewport: $(window),
                                adjust: {
                                   method: 'shift none'
                                }
                            },
                            show: {
                                event: false,
                                ready: true
                            },
                            hide: false,
                            style: {
                                classes: 'qtip-red qtip-shadow' // Make it red... the classic error colour!
                            }
                        }) // If we have a tooltip on this element already, just update its content
                        .qtip('option', 'content.text', error);
                    } // If the error is empty, remove the qTip
                    else {
                        elem.qtip('destroy');
                    }
                },
                success: $.noop,
                submitHandler: function (form) {
                    //toastr["success"]("I do not think that means what you think it means.");
                    var action = $(form).attr('action');
                    $.ajax({
                      type: 'POST',
                      url: action,
                      data: subscribe.serialize(),
                      success: function (data) {
                        var data = $.parseJSON(data);  
                        //var data = JSON.parse(data);
                        console.log(data);
                        if (data.type) {
                          toastr["success"]("Success.");
                        }else{
                            if (data.content.email.length > 0) {
                                toastr["error"](data.content.email);
                            }else{
                                toastr["error"]("Error.");
                            }
                          
                        }
                        $(form)[0].reset();
                      }
                 });
                 return false; // required to block normal submit since you used ajax
                }
            });
        });
    }


    if (($(".addseller").length != 0)) {
        var subscribe = $(".addseller");
        var validator = subscribe.validate({
            onkeyup: false,
            errorClass: 'error',
            validClass: 'valid',
            errorPlacement: function(error, element) {
                // Set positioning based on the elements position in the form
                var elem = $(element);

                // Check we have a valid error message
                if (!error.is(':empty')) {
                    // Apply the tooltip only if it isn't valid
                    elem.filter(':not(.valid)').qtip({
                        overwrite: false,
                        content: error,
                        position: {
                            my: 'top right',
                            at: 'right bottom',
                            viewport: $(window),
                            adjust: {
                               method: 'shift none'
                            }
                        },
                        show: {
                            event: false,
                            ready: true
                        },
                        hide: false,
                        style: {
                            classes: 'qtip-red qtip-shadow' // Make it red... the classic error colour!
                        }
                    }) // If we have a tooltip on this element already, just update its content
                    .qtip('option', 'content.text', error);
                } // If the error is empty, remove the qTip
                else {
                    elem.qtip('destroy');
                }
            },
            success: $.noop
        });
    }
    // range slider
    if (($("#range1").length != 0)) {

        var slider    = document.getElementById('range1');
        var price_max = document.getElementById("price_max");
        var price_min = document.getElementById("price_min");
        var max       = parseInt($("#range1").attr('data-max'));
        //var min       = parseInt($("#range1").attr('data-min'));

        var start     = parseInt(price_min.value);
        var end       = parseInt(price_max.value);

        noUiSlider.create(slider, {
            start: [start, end],
            connect: true,
            tooltips: [
                wNumb({
                    decimals: 0
                }),
                wNumb({
                    decimals: 0
                })
            ],
            step: 100,
            range: {
                'min': 0,
                'max': max
            }

        });

        slider.noUiSlider.on('slide', function(){
            $( ".filtre-form" ).submit();
        });


        slider.noUiSlider.on('update', function( values, handle ) {
            var value = values[handle];
            if ( handle ) {
                price_max.value = Math.round(value);
            } else {
                price_min.value = Math.round(value);
            }
        });

        price_max.addEventListener('change', function(){
            slider.noUiSlider.set([null,this.value]);
        });

        price_min.addEventListener('change', function(){
            slider.noUiSlider.set([this.value,null]);
        });

    }
    // / ecommerce

$( ".show_categories" ).click(function() {
  $( ".categories-hide" ).slideToggle( "slow", function() {
    // Animation complete.
  });
});


}); // end of document ready
