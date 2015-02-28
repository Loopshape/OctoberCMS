/*

 MAIN JAVASCRIPT
 RequireJS & AngularJS Templatescript Management

 Programmed by: Arjuna Noorsanto
 (c)created 2015 with OctoberCMS

 http://loop.arcturus.uberspace.de

*/
var preloader = '';
console.log('\n\nLOOPSHAPE presents:\nGRUNT+COMPOSER+FOUNDATION+ANGULAR TEMPLATE\n');
console.log('\n(c)reated 2015 with OctoberCMS\nProgrammed by Arjuna Noorsanto\n');
console.log('Contact: awebgo.net@gmail.com\n\n');
console.log('Starting App!\n\n');
require.config({

    baseUrl: './themes/loopshape/bower_components',

    paths: {
        angular: '//ajax.googleapis.com/ajax/libs/angularjs/1.3.11/angular.min',

        jquery: '//code.jquery.com/jquery-2.0.0.min',
        jqueryui: '//code.jquery.com/ui/1.11.2/jquery-ui.min',
        
        sailsjs: '/public/assets/js/dependencies/sails.io',

        equalheights: 'jQuery-Equal-Heights/jQuery.equalHeights',

        //mustache : 'mustache/mustache.min',

        eventemitter: 'eventEmitter/EventEmitter.min',
        eventie: 'eventie',

        threejs: '//cdnjs.cloudflare.com/ajax/libs/three.js/r70/three.min',

        cookie: 'jquery-cookie/src/jquery.cookie',
        sticky: 'stickyjs/stickyjs',
        tipsy: 'tooltipsy/tooltipsy.min',

        fclock: 'FlipClock/compiled/flipclock.min',
        //moment: '//cdnjs.cloudflare.com/ajax/libs/moment.js/2.5.1/moment.min',

        imgloaded: 'imagesloaded/imagesloaded',

        audiojs: '/themes/loopshape/bower_components/audiojs/audiojs/audio.min',

        carousel: 'jquery_carousel',

        videojs: '//vjs.zencdn.net/4.11/video',
        bigvideo: 'BigVideo.js/lib/bigvideo',
        
        chartjs: 'Chart.js/Chart.min',

        simpleweather: 'simpleWeather/jquery.simpleWeather.min',

        framework: './../../../modules/system/assets/js/framework',
        frameworkextras: './../../../modules/system/assets/js/framework.extras'
    },

    shim: {
        angular: {
            exports: 'angular'
        },

        jquery: {
            deps: ['angular'],
            exports: '$'
        },
        jqueryui: {
            deps: ['angular', 'jquery']
        },
        
        sailsjs: {
            deps: ['angular', 'jquery'],
            exports: 'sailsjs'
        },

        equalheights: {
            deps: ['angular', 'jquery'],
            exports: 'equalheights'
        },

        /*
		mustache : {
		    deps : ['angular', 'jquery'],
		    exports : 'mustache'
		},
        */

        cookie: {
            deps: ['angular', 'jquery'],
            exports: 'cookie'
        },
        sticky: {
            deps: ['angular', 'jquery'],
            exports: 'sticky'
        },
        tipsy: {
            deps: ['angular', 'jquery'],
            exports: 'tooltipsy'
        },
        fclock: {
            deps: ['angular', 'jquery'],
            exports: 'FlipClock'
        },
        
        /*
        moment: {
            deps: ['angular', 'jquery'],
            exports: 'moment'
        },
        */
        
        eventemitter: {
            deps: ['angular', 'jquery']
        },

        videojs: {
            deps: ['angular', 'jquery']
        },
        bigvideo: {
            deps: ['angular', 'jquery', 'videojs']
        },
        imgloaded: {
            deps: ['angular', 'jquery'],
            exports: 'imagesloaded'
        },
        audiojs: {
            deps: ['angular', 'jquery'],
            exports: 'audiojs'
        },

        carousel: {
            deps: ['angular', 'jquery'],
            exports: 'carousel'
        },
        
        chartjs: {
            deps: ['angular', 'jquery'],
            exports: 'Chart'
        },

        simpleweather: {
            deps: ['angular', 'jquery'],
            exports: 'simpleWeather'
        },

        framework: {
            deps: ['angular', 'jquery'],
            exports: 'framework'
        },
        frameworkextras: {
            deps: ['jquery', 'framework'],
            exports: 'frameworkextras'
        },
        threejs: {
            deps: ['jquery'],
            exports: 'ThreeJS'
        }

    },

    waitSeconds: 0

}), define(['angular', 'jquery', 'jqueryui', 'sailsjs', /*'mustache',*/ 'equalheights', 'cookie', 'sticky', 'tipsy', 'fclock', /*'moment',*/ 'eventemitter', 'videojs', 'bigvideo', 'imgloaded', 'audiojs', 'carousel', 'framework', 'frameworkextras', 'threejs', 'chartjs', 'simpleweather'], function (angular, $, ui, sailsjs, /*Mustache,*/ equalHeights, cookie, sticky, tooltipsy, FlipClock, /*moment,*/ eventemitter, videojs, BigVideo, imagesloaded, audiojs, carousel, framework, frameworkextras, threejs, Chart, simpleWeather) {

    // PRELOADED SCRIPTS

    if (preloader !== undefined)
        preloader = new GSPreloader({
            radius: 64,
            dotSize: 32,
            dotCount: 6,
            colors: ["#883322", "#22aa22", "#ffcc11", "#2244ee"], //have as many or as few colors as you want.
            boxOpacity: 0,
            boxBorder: "30px solid transparent",
            animationOffset: 1.8, //jump 1.8 seconds into the animation for a more active part of the spinning initially (just looks a bit better in my opinion)
        });

    //open the preloader
    preloader.active(true);

    //for testing: click the window to toggle open/close the preloader
    /*
	document.onclick = document.ontouchstart = function() {
	preloader.active( !preloader.active() );
	};
	*/

    //this is the whole preloader class/function
    function GSPreloader(options) {
        options = options || {};
        var parent = options.parent || document.body,
            element = this.element = document.createElement("div"),
            radius = options.radius || 64,
            dotSize = options.dotSize || 16,
            animationOffset = options.animationOffset || 1.8, //jumps to a more active part of the animation initially (just looks cooler especially when the preloader isn't displayed for very long)
            createDot = function (rotation) {
                var dot = document.createElement("div");
                element.appendChild(dot);
                TweenLite.set(dot, {
                    width: dotSize,
                    height: dotSize,
                    transformOrigin: (-radius + "px 0px"),
                    x: radius,
                    backgroundColor: colors[colors.length - 1],
                    borderRadius: "50%",
                    force3D: true,
                    position: "absolute",
                    rotation: rotation
                });
                dot.className = options.dotClass || "preloader-dot";
                return dot;
            },
            i = options.dotCount || 3,
            rotationIncrement = 360 / i,
            colors = options.colors || ["#61AC27", "black"],
            animation = new TimelineLite({
                paused: true
            }),
            dots = [],
            isActive = false,
            box = document.createElement("div"),
            tl,
            dot,
            closingAnimation,
            j;
        colors.push(colors.shift());

        //setup background box
        /*
		TweenLite.set(box, {
			width : radius * 2 + 70,
			height : radius * 2 + 70,
			borderRadius : "420px",
			backgroundColor : options.boxColor || "transparent",
			border : options.boxBorder || "0px solid transparent",
			position : "absolute",
			xPercent : -50,
			yPercent : -33,
			opacity : ((options.boxOpacity !== null) ? options.boxOpacity : 0.3)
		});
		box.className = options.boxClass || "preloader-box";
		element.appendChild(box);
        */

        parent.appendChild(element);
        TweenLite.set(element, {
            position: "fixed",
            top: "58%",
            left: "50%",
            perspective: 600,
            overflow: "visible",
            zIndex: 2000
        });

        /*
		animation.from(box, 0.1, {
			opacity : 0,
			scale : 0.25,
			ease : Power1.easeOut
		}, animationOffset);
		*/

        while (--i > -1) {
            dot = createDot(i * rotationIncrement);
            dots.unshift(dot);
            animation.from(dot, 0.1, {
                scale: 0.01,
                opacity: 0,
                ease: Power1.easeOut
            }, animationOffset);
            //tuck the repeating parts of the animation into a nested TimelineMax (the intro shouldn't be repeated)
            tl = new TimelineMax({
                repeat: -1,
                repeatDelay: 0.25
            });
            for (j = 0; j < colors.length; j++) {
                tl.to(dot, 2.5, {
                        rotation: "-=360",
                        ease: Power2.easeInOut
                    }, j * 2.9)
                    .to(dot, 1.2, {
                        skewX: "+=360",
                        backgroundColor: colors[j],
                        ease: Power2.easeInOut
                    }, 1.6 + 2.9 * j);
            }
            //stagger its placement into the master timeline
            animation.add(tl, i * 0.07);
        }
        if (TweenLite.render) {
            TweenLite.render();
            //trigger the from() tweens' lazy-rendering (otherwise it'd take one tick to render everything in the beginning state, thus things may flash on the screen for a moment initially). There are other ways around this, but TweenLite.render() is probably the simplest in this case.
        }

        //call preloader.active(true) to open the preloader, preloader.active(false) to close it, or preloader.active() to get the current state.
        this.active = function (show) {
            $('body')
                .addClass('httpreq');
            if (!arguments.length) {
                return isActive;
            }
            if (isActive != show) {
                isActive = show;
                if (closingAnimation) {
                    closingAnimation.kill();
                    //in case the preloader is made active/inactive/active/inactive really fast and there's still a closing animation running, kill it.
                }
                if (isActive) {
                    element.style.visibility = "visible";
                    TweenLite.set([element, box], {
                        rotation: 0
                    });
                    animation.play(animationOffset);
                } else {
                    closingAnimation = new TimelineLite();
                    if (animation.time() < animationOffset + 0.3) {
                        animation.pause();
                        closingAnimation.to(element, 1, {
                                rotation: -360,
                                ease: Power1.easeInOut
                            })
                            .to(box, 1, {
                                rotation: 360,
                                ease: Power1.easeInOut
                            }, 0);
                    }
                    closingAnimation.staggerTo(dots, 0.3, {
                            scale: 0.01,
                            opacity: 0,
                            ease: Power1.easeIn,
                            overwrite: false
                        }, 0.05, 0)
                        .to(box, 0.4, {
                            opacity: 0,
                            scale: 0.2,
                            ease: Power2.easeIn,
                            overwrite: false
                        }, 0)
                        .call(function () {
                            $('body')
                                .removeClass('httpreq');
                            animation.pause();
                            closingAnimation = null;
                        })
                        .set(element, {
                            visibility: "hidden"
                        });
                }
            }
            return this;
        };
    }
        
    if($('#workChart').length) {
        
        var chartoptions = {
            // Boolean - Whether to animate the chart
            animation: true,
            // Number - Number of animation steps
            animationSteps: 60,
            // String - Animation easing effect
            animationEasing: "easeOutQuart",
            // Boolean - If we should show the scale at all
            showScale: true,
            // Boolean - If we want to override with a hard coded scale
            scaleOverride: false,
            // ** Required if scaleOverride is true **
            // Number - The number of steps in a hard coded scale
            scaleSteps: null,
            // Number - The value jump in the hard coded scale
            scaleStepWidth: null,
            // Number - The scale starting value
            scaleStartValue: null,
            // String - Colour of the scale line
            scaleLineColor: "rgba(0,0,0,.1)",
            // Number - Pixel width of the scale line
            scaleLineWidth: 1,
            // Boolean - Whether to show labels on the scale
            scaleShowLabels: true,
            // Interpolated JS string - can access value
            scaleLabel: "<%=value%>",
            // Boolean - Whether the scale should stick to integers, not floats even if drawing space is there
            scaleIntegersOnly: true,
            // Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
            scaleBeginAtZero: false,
            // String - Scale label font declaration for the scale label
            scaleFontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif",
            // Number - Scale label font size in pixels
            scaleFontSize: 12,
            // String - Scale label font weight style
            scaleFontStyle: "normal",
            // String - Scale label font colour
            scaleFontColor: "#666",
            // Boolean - whether or not the chart should be responsive and resize when the browser does.
            responsive: true,
            // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
            maintainAspectRatio: true,
            // Boolean - Determines whether to draw tooltips on the canvas or not
            showTooltips: true,
            // Function - Determines whether to execute the customTooltips function instead of drawing the built in tooltips (See [Advanced - External Tooltips](#advanced-usage-custom-tooltips))
            customTooltips: false,
            // Array - Array of string names to attach tooltip events
            tooltipEvents: ["mousemove", "touchstart", "touchmove"],
            // String - Tooltip background colour
            tooltipFillColor: "rgba(0,0,0,0.8)",
            // String - Tooltip label font declaration for the scale label
            tooltipFontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif",
            // Number - Tooltip label font size in pixels
            tooltipFontSize: 32,
            // String - Tooltip font weight style
            tooltipFontStyle: "normal",
            // String - Tooltip label font colour
            tooltipFontColor: "#fff",
            // String - Tooltip title font declaration for the scale label
            tooltipTitleFontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif",
            // Number - Tooltip title font size in pixels
            tooltipTitleFontSize: 14,
            // String - Tooltip title font weight style
            tooltipTitleFontStyle: "bold",
            // String - Tooltip title font colour
            tooltipTitleFontColor: "#fff",
            // Number - pixel width of padding around tooltip text
            tooltipYPadding: 6,
            // Number - pixel width of padding around tooltip text
            tooltipXPadding: 6,
            // Number - Size of the caret on the tooltip
            tooltipCaretSize: 8,
            // Number - Pixel radius of the tooltip border
            tooltipCornerRadius: 6,
            // Number - Pixel offset from point x to tooltip edge
            tooltipXOffset: 10,
            // String - Template string for single tooltips
            tooltipTemplate: "<%if (label){%><%=label%>: <%}%><%= value %>",
            // String - Template string for multiple tooltips
            multiTooltipTemplate: "<%= value %>",
        
            onAnimationProgress: function(){},
            onAnimationComplete: function(){}
        }
        
        // ChartJS DATA
        var chartdata = {
            labels: ["January", "February", "March", "April", "May", "June", "July"],
            datasets: [
                {
                    label: "My First dataset",
                    fillColor: "rgba(220,220,220,0.2)",
                    strokeColor: "rgba(220,220,220,1)",
                    pointColor: "rgba(220,220,220,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(220,220,220,1)",
                    data: [65, 59, 80, 81, 56, 55, 40]
                },
                {
                    label: "My Second dataset",
                    fillColor: "rgba(151,187,205,0.2)",
                    strokeColor: "rgba(151,187,205,1)",
                    pointColor: "rgba(151,187,205,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(151,187,205,1)",
                    data: [28, 48, 40, 19, 86, 27, 90]
                }
            ]
        };
        
        // Get the context of the canvas element we want to select
        var ctx = $("#workChart").get(0).getContext("2d");
        var canvasWorkChart = new Chart(ctx).Line(chartdata, chartoptions);
        
    }

    var $audioplayer = $(function () {
        // Setup the player to autoplay the next track
        var a = audiojs.createAll({
            trackEnded: function () {
                var next = $('ol li.playing')
                    .next();
                if (!next.length)
                    next = $('ol li')
                    .first();
                next.addClass('playing')
                    .siblings()
                    .removeClass('playing');
                audio.load($('a', next)
                    .attr('data-src'));
                audio.play();
            }
        });

        // Load in the first track
        var audio = a[0];
        first = $('ol a')
            .attr('data-src');
        $('ol li')
            .first()
            .addClass('playing');
        if (audio === null)
            audio.load(first);

        // Load in a track on click
        $('ol li')
            .click(function (e) {
                e.preventDefault();
                $(this)
                    .addClass('playing')
                    .siblings()
                    .removeClass('playing');
                audio.load($('a', this)
                    .attr('data-src'));
                audio.play();
            });

        // Keyboard shortcuts
        $(document)
            .keydown(function (e) {

                var unicode = e.charCode ? e.charCode : e.keyCode;

                // right arrow
                if (unicode == 39) {
                    var next = $('li.playing')
                        .next();
                    if (!next.length)
                        next = $('ol li')
                        .first();
                    next.click();

                    // back arrow
                } else if (unicode == 37) {
                    var prev = $('li.playing')
                        .prev();
                    if (!prev.length)
                        prev = $('ol li')
                        .last();
                    prev.click();

                    // spacebar
                } else if (unicode == 32) {
                    audio.playPause();
                }

            });
    });

    // MAIN ROUTINE

    var $pageMem = null;

    function init() {
        w = $(window);
        container = $('#contentContainer');
        carousel = $('#carouselContainer');
        item = $('.carouselItem');
        itemLength = $('.carouselItem')
            .length;
        fps = $('#fps');
        rY = 360 / itemLength;
        radius = Math.round((250) / Math.tan(Math.PI / itemLength));

        // set container 3d props
        TweenMax.set(container, {
            perspective: 600
        });
        TweenMax.set(carousel, {
            z: -(radius)
        });

        // create carousel item props

        for (var i = 0; i < itemLength; i++) {
            var $item = item.eq(i);
            var $block = $item.find('.carouselItemInner');

            //thanks @chrisgannon!        
            TweenMax.set($item, {
                rotationY: rY * i,
                z: radius,
                transformOrigin: "50% 50% " + -radius + "px"
            });

            animateIn($item, $block);
        }

        // set mouse x and y props and looper ticker
        window.addEventListener("mousemove", onMouseMove, false);
        ticker = setInterval(looper, 1000 / 60);
    }

    function animateIn($item, $block) {
        var $nrX = 360 * getRandomInt(2);
        var $nrY = 360 * getRandomInt(2);

        var $nx = -(2000) + getRandomInt(4000);
        var $ny = -(2000) + getRandomInt(4000);
        var $nz = -4000 + getRandomInt(4000);

        var $s = 1.5 + (getRandomInt(10) * 0.1);
        var $d = 1 - (getRandomInt(8) * 0.1);

        TweenMax.set($item, {
            autoAlpha: 1,
            delay: $d
        });
        TweenMax.set($block, {
            z: $nz,
            rotationY: $nrY,
            rotationX: $nrX,
            x: $nx,
            y: $ny,
            autoAlpha: 0
        });
        TweenMax.to($block, $s, {
            delay: $d,
            rotationY: 0,
            rotationX: 0,
            z: 0,
            ease: Expo.easeInOut
        });
        TweenMax.to($block, $s - 0.5, {
            delay: $d,
            x: 0,
            y: 0,
            autoAlpha: 1,
            ease: Expo.easeInOut
        });
    }

    function onMouseMove(event) {
        mouseX = -(-(window.innerWidth * 0.5) + event.pageX) * 0.0025;
        mouseY = -(-(window.innerHeight * 0.5) + event.pageY) * 0.01;
        mouseZ = -(radius) - (Math.abs(-(window.innerHeight * 0.5) + event.pageY) - 200);
    }

    // loops and sets the carousel 3d properties
    function looper() {
        addX += mouseX;
        TweenMax.to(carousel, 1, {
            rotationY: addX,
            rotationX: mouseY,
            ease: Quint.easeOut
        });
        TweenMax.set(carousel, {
            z: mouseZ
        });
        fps.text('Framerate: ' + counter.tick() + '/60 FPS');
    }

    function getRandomInt($n) {
        return Math.floor((Math.random() * $n) + 1);
    }

    // set and cache variables
    var w, container, item, radius, itemLength, rY, ticker, fps;
    var mouseX = 0;
    var mouseY = 0;
    var mouseZ = 0;
    var addX = 0;


    // fps counter created by: https://gist.github.com/sharkbrainguy/1156092,
    // no need to create my own :)
    var fps_counter = {

        tick: function () {
            // this has to clone the array every tick so that
            // separate instances won't share state 
            this.times = this.times.concat(+new Date());
            var seconds, times = this.times;

            if (times.length > this.span + 1) {
                times.shift(); // ditch the oldest time
                seconds = (times[times.length - 1] - times[0]) / 1000;
                return Math.round(this.span / seconds);
            } else return null;
        },

        times: [],
        span: 20
    };
    var counter = Object.create(fps_counter);

    // Docs at http://simpleweatherjs.com
    /* Does your browser support geolocation? */
    function loadWeather(location, woeid) {
        $.simpleWeather({
            location: location,
            woeid: woeid,
            unit: 'c',
            success: function (weather) {
                html = '<h2><i class="icon-' + weather.code + '"></i> ' + weather.temp + '°' + weather.units.temp + '</h2>';
                html += '<ul><li>' + weather.city + ', ' + weather.region + '</li>';
                html += '<li class="currently">' + weather.currently + '</li>';
                //html += '<li>'+weather.alt.temp+'°C</li></ul>';  

                $("#weather")
                    .html(html);
            },
            error: function (error) {
                $("#weather")
                    .html('<p>' + error + '</p>');
            }
        });
    }

    /* Get your location stored in your cookie-session */
    if ($.cookie('loopshape_location_coords')) {
        var posArr = $.cookie('loopshape_location_coords');
        console.log('CookieCoords: ' + posArr);
        loadWeather(posArr);
    }

    /* Where in the world are you? */
    $('.js-geolocation')
        .on('click', function () {
            var $el = $(this);
            navigator.geolocation.getCurrentPosition(function (position) {
                loadWeather(position.coords.latitude + ',' + position.coords.longitude); //load weather using your lat/lng coordinates from browser
                $.cookie('loopshape_location_coords', position.coords.latitude + ',' + position.coords.longitude);
                $('*[id^="tooltipsy"]')
                    .remove();
                $el.remove();
            });
        });

    /*
        DOCUMENT READY SCRIPTS
    */

    var bodyMouseX = 0,
        bodyMouseY = 0;

    $(document)
        .ready(function () {

            var $screenWidth = $(window)
                .width();

            $('body')
                .on('mousemove', function (e) {
                    bodyMouseX = e.pageX;
                    bodyMouseY = e.pageY;

                    if (!$.cookie('cookieLawBanner'))
                        return;

                    if (bodyMouseY < $('#pageContent')
                        .offset()
                        .top || bodyMouseY > ($('#pageContent')
                            .offset()
                            .top + 220) || bodyMouseX < ($screenWidth / 5) || bodyMouseX > ($screenWidth / 1.5)) {
                        $('#contentContainer')
                            .fadeOut('slow');
                    } else {
                        if (bodyMouseX < ($screenWidth / 5) || bodyMouseX > ($screenWidth / 1.5))
                            return;
                        $('#contentContainer')
                            .fadeIn('slow');
                    }
                });

            if ("geolocation" in navigator) {
                $('.js-geolocation')
                    .show();
            } else {
                $('.js-geolocation')
                    .hide();
            }

            $('#gs_tti50 input')
                .attr('style', '');

            $('div[class^="stripe-"]')
                .fadeOut('fast');

            $('.preloader-box,.preloader-dot')
                .css({
                    'display': 'none',
                    'visibility': 'hidden',
                    'opacity': '0'
                });

            $('a.song')
                .on('click', function () {
                    $(this)
                        .addClass('played')
                        .addClass('active');
                    return true;
                });

            var BV = new $.BigVideo();

            // doc ready branch
            $('input#gsc-i-id1')
                .attr('placeholder', 'Google Suche');

            // LINK CLICK-HANDLER
            $('a:not(a.internal,a.song,a.lnxScrollToTop,a.gsst_a,.socialMedias a)')
                .each(function () {

                    var $link = $(this)
                        .prop('href'),
                        $title = $(this)
                        .prop('title');


                    $(this)
                        .on('click', function () {

                            $elem = $(this);

                            preloader.active(true);
                            $('.stripe-loading-indicator,.preloader-box,.preloader-dot')
                                .css({
                                    'display': 'block',
                                    'visibility': 'visible',
                                    'opacity': '1'
                                });

                            //$pageMem = $('html').clone().html();

                            setTimeout(function () {
                                if ($elem.prop('target') !== '_blank') {
                                    window.open($link, '_self');
                                } else {
                                    window.open($link, '_blank'); //window.location.href = $link;
                                }
                            }, 250);

                            return false;
                        });
                });

            $('.progress')
                .find('span')
                .each(function () {
                    $(this)
                        .removeClass('red')
                        .addClass('green');
                });

            var startpage = null;
            if (window.location.href === 'http://loop.arcturus.uberspace.de/') {
                startpage = true;
            } else {
                startpage = false;
            }

            var firstRun = true;

            if (!$.cookie('cookieLawBanner')) {
                $('#cookieLawBanner')
                    .slideDown('slow')
                    .on('click', function () {
                        $(this)
                            .slideUp('slow', function () {
                                setTimeout(function () {
                                    $.cookie('cookieLawBanner', 'true');
                                    $.cookie('bigVideoPlayer', 'true');
                                }, 250);
                            });
                    });
            }

            var clock = $('.clock')
                .FlipClock({
                    clockFace: 'TwentyFourHourClock'
                });

            $('.hastip')
                .tooltipsy({
                    alignTo: 'cursor',
                    offset: [15, 15],
                    css: {
                        'padding': '7px',
                        'max-width': '200px'
                    }
                });

            $('.html5Logo')
                .on('click', function () {
                    if (!$.cookie('bigVideoPlayer')) {
                        BV.getPlayer()
                            .pause();
                        $.cookie('bigVideoPlayer', 'true');
                    }
                    var hrefBuffer = $(this)
                        .data('href');
                    setTimeout(function () {
                        window.location.href = hrefBuffer;
                    }, 250);
                });

            setTimeout(function () {
                $('.html5Logo,.leadingHeadline')
                    .each(function () {
                        $(this)
                            .animate({
                                'opacity': '+=0.99'
                            }, 2000);
                    });
            }, 3000);


            $(window)
                .resize(function () {
                    if ($(window)
                        .width() > 1280) {
                        /*
                        $('#page')
                            .css('min-height', $(window)
                                .height() + 100);
                        */
                        //$('#blogSide').css('height', $('#blog').innerHeight());
                        $("#navi")
                            .sticky({
                                topSpacing: 0,
                                getWidthFrom: '#page',
                                responsiveWidth: true
                            });
                    } else {
                        $("#navi")
                            .unstick();
                    }
                    $('.is-sticky').removeClass('is-sticky');
                });


            $(function () {

                /*
			if (!$.cookie('bigVideoPlayer')) {
				BV.init();
				BV.show('//archive.org/download/HardDriveSpinning/HardDriveH264.mp4', {
					ambient : true
				});
			} else {
			*/
			
			/*
                $('#frameOnboard')
                    .css('background-color', 'rgba(187,193,200,1)');
                $('body #frame section#frameTeaser *')
                    .css({
                        'border-color': 'transparent',
                        'border-bottom-width': '0',
                        'border': 'none'
                    });
                $('body #frame section#frameTeaser *')
                    .css('-webkit-box-shadow', 'none');
                $('body #frame section#frameTeaser *')
                    .css('box-shadow', 'none');

                $('body #frame section#frameOnboard')
                    .css({
                        '-webkit-box-shadow': 'inset 0 0 40px 0 rgba(0,0,0,1)',
                        'box-shadow': 'inset 0 0 40px 0 rgba(0,0,0,1)',
                        'border': '2px solid #012'
                    });
                return;
                //}
            */

            });

            if ($(window)
                .width() > 1280) {
                /*
                $('#page')
                    .css('min-height', $(window)
                        .height() + 100);
                */
                //$('#blogSide').css('height', $('#blog').innerHeight());
                $("#navi")
                    .sticky({
                        topSpacing: 0,
                        getWidthFrom: '#page',
                        responsiveWidth: true
                    });
            } else {
                $("#navi")
                    .unstick();
            }

            if (!$.cookie('loopshape_location_coords')) {
                loadWeather('Berlin', 'DE');
                $('.js-geolocation')
                    .show();
            } else {
                $('.js-geolocation')
                    .remove();
            }

            // BOKE BACKGROUND
            if ($('#bg')
                .length) {

                var canvas = $('#bg')
                    .children('canvas'),
                    background = canvas[0],
                    foreground1 = canvas[1],
                    foreground2 = canvas[2],
                    config = {
                        circle: {
                            amount: 8,
                            layer: 3,
                            color: [68, 100, 128],
                            alpha: 0.3
                        },
                        line: {
                            amount: 16,
                            layer: 3,
                            color: [124, 148, 164],
                            alpha: 0.3
                        },
                        speed: 0, //0.25,
                        angle: 42
                    };

                if (background.getContext) {
                    var bctx = background.getContext('2d'),
                        fctx1 = foreground1.getContext('2d'),
                        fctx2 = foreground2.getContext('2d'),
                        M = window.Math, // Cached Math
                        degree = config.angle / 360 * M.PI * 2,
                        circles = [],
                        lines = [],
                        wWidth, wHeight, timer;

                    requestAnimationFrame = window.requestAnimationFrame ||
                        window.mozRequestAnimationFrame ||
                        window.webkitRequestAnimationFrame ||
                        window.msRequestAnimationFrame ||
                        window.oRequestAnimationFrame ||
                        function (callback, element) {
                            setTimeout(callback, 1000 / 60);
                        };

                    cancelAnimationFrame = window.cancelAnimationFrame ||
                        window.mozCancelAnimationFrame ||
                        window.webkitCancelAnimationFrame ||
                        window.msCancelAnimationFrame ||
                        window.oCancelAnimationFrame ||
                        clearTimeout;

                    var setCanvasHeight = function () {
                        wWidth = $(window)
                            .width();
                        wHeight = $(window)
                            .height(),

                            canvas.each(function () {
                                this.width = wWidth;
                                this.height = wHeight;
                            });
                    };

                    var drawCircle = function (x, y, radius, color, alpha) {
                        var gradient = fctx1.createRadialGradient(x, y, radius, x, y, 0);
                        gradient.addColorStop(0, 'rgba(' + color[0] + ',' + color[1] + ',' + color[2] + ',' + alpha + ')');
                        gradient.addColorStop(1, 'rgba(' + color[0] + ',' + color[1] + ',' + color[2] + ',' + (alpha - 0.1) + ')');

                        fctx1.beginPath();
                        fctx1.arc(x, y, radius, 0, M.PI * 2, true);
                        fctx1.fillStyle = gradient;
                        fctx1.fill();
                    };

                    var drawLine = function (x, y, width, color, alpha) {
                        var endX = x + M.sin(degree) * width,
                            endY = y - M.cos(degree) * width,
                            gradient = fctx2.createLinearGradient(x, y, endX, endY);
                        gradient.addColorStop(0, 'rgba(' + color[0] + ',' + color[1] + ',' + color[2] + ',' + alpha + ')');
                        gradient.addColorStop(1, 'rgba(' + color[0] + ',' + color[1] + ',' + color[2] + ',' + (alpha - 0.1) + ')');

                        fctx2.beginPath();
                        fctx2.moveTo(x, y);
                        fctx2.lineTo(endX, endY);
                        fctx2.lineWidth = 3;
                        fctx2.lineCap = 'round';
                        fctx2.strokeStyle = gradient;
                        fctx2.stroke();
                    };

                    var drawBack = function () {
                        bctx.clearRect(0, 0, wWidth, wHeight);

                        var gradient = [];

                        gradient[0] = bctx.createRadialGradient(wWidth * 0.3, wHeight * 0.1, 0, wWidth * 0.3, wHeight * 0.1, wWidth * 0.9);
                        gradient[0].addColorStop(0, 'rgba(16, 18, 24,0.75)');
                        gradient[0].addColorStop(1, 'transparent');

                        bctx.translate(wWidth, 0);
                        bctx.scale(-1, 1);
                        bctx.beginPath();
                        bctx.fillStyle = gradient[0];
                        bctx.fillRect(0, 0, wWidth, wHeight);

                        gradient[1] = bctx.createRadialGradient(wWidth * 0.1, wHeight * 0.1, 0, wWidth * 0.3, wHeight * 0.1, wWidth);
                        gradient[1].addColorStop(0, 'rgba(16, 24, 32,0.75)');
                        gradient[1].addColorStop(1, 'transparent');

                        bctx.translate(wWidth, 0);
                        bctx.scale(-1, 1);
                        bctx.beginPath();
                        bctx.fillStyle = gradient[1];
                        bctx.fillRect(0, 0, wWidth, wHeight);

                        gradient[2] = bctx.createRadialGradient(wWidth * 0.1, wHeight * 0.5, 0, wWidth * 0.1, wHeight * 0.5, wWidth * 0.5);
                        gradient[2].addColorStop(0, 'rgba(16, 32, 48,0.75)');
                        gradient[2].addColorStop(1, 'transparent');

                        bctx.beginPath();
                        bctx.fillStyle = gradient[2];
                        bctx.fillRect(0, 0, wWidth, wHeight);
                    };

                    var animate = function () {
                        var sin = M.sin(degree),
                            cos = M.cos(degree);

                        if (config.circle.amount > 0 && config.circle.layer > 0) {
                            fctx1.clearRect(0, 0, wWidth, wHeight);
                            for (var i = 0, len = circles.length; i < len; i++) {
                                var item = circles[i],
                                    x = item.x,
                                    y = item.y,
                                    radius = item.radius * 4,
                                    speed = item.speed;

                                if (x > wWidth + radius) {
                                    x = -radius;
                                } else if (x < -radius) {
                                    x = wWidth + radius
                                } else {
                                    x += sin * speed;
                                }

                                if (y > wHeight + radius) {
                                    y = -radius;
                                } else if (y < -radius) {
                                    y = wHeight + radius;
                                } else {
                                    y -= cos * speed;
                                }

                                item.x = x;
                                item.y = y;
                                drawCircle(x, y, radius, item.color, item.alpha);
                            }
                        }

                        if (config.line.amount > 0 && config.line.layer > 0) {
                            fctx2.clearRect(0, 0, wWidth, wHeight);
                            for (var j = 0, len = lines.length; j < len; j++) {
                                var item = lines[j],
                                    x = item.x,
                                    y = item.y,
                                    width = item.width,
                                    speed = item.speed;

                                if (x > wWidth + width * sin) {
                                    x = -width * sin;
                                } else if (x < -width * sin) {
                                    x = wWidth + width * sin;
                                } else {
                                    x += sin * speed;
                                }

                                if (y > wHeight + width * cos) {
                                    y = -width * cos;
                                } else if (y < -width * cos) {
                                    y = wHeight + width * cos;
                                } else {
                                    y -= cos * speed;
                                }

                                item.x = x;
                                item.y = y;
                                drawLine(x, y, width, item.color, item.alpha);
                            }
                        }

                        timer = requestAnimationFrame(animate);
                    };

                    var createItem = function () {
                        circles = [];
                        lines = [];

                        if (config.circle.amount > 0 && config.circle.layer > 0) {
                            for (var i = 0; i < config.circle.amount / config.circle.layer; i++) {
                                for (var j = 0; j < config.circle.layer; j++) {
                                    circles.push({
                                        x: M.random() * wWidth,
                                        y: M.random() * wHeight,
                                        radius: M.random() * (20 + j * 5) + (20 + j * 5),
                                        color: config.circle.color,
                                        alpha: M.random() * 0.2 + (config.circle.alpha - j * 0.1),
                                        speed: config.speed * (1 + j * 0.5)
                                    });
                                }
                            }
                        }

                        if (config.line.amount > 0 && config.line.layer > 0) {
                            for (var m = 0; m < config.line.amount / config.line.layer; m++) {
                                for (var n = 0; n < config.line.layer; n++) {
                                    lines.push({
                                        x: M.random() * wWidth,
                                        y: M.random() * wHeight,
                                        width: M.random() * (20 + n * 5) + (20 + n * 5),
                                        color: config.line.color,
                                        alpha: M.random() * 0.2 + (config.line.alpha - n * 0.1),
                                        speed: config.speed * (1 + n * 0.5)
                                    });
                                }
                            }
                        }

                        cancelAnimationFrame(timer);
                        timer = requestAnimationFrame(animate);
                        drawBack();
                    };

                    $(document)
                        .ready(function () {
                            setCanvasHeight();
                            createItem();
                        });
                    $(window)
                        .resize(function () {
                            setCanvasHeight();
                            createItem();
                        });
                }

            }

            var blogNr = 1;
            $("ul.post-list > li > h3 > a")
                .each(function () {
                    var _href = $(this)
                        .prop('href'),
                        _title = $(this)
                        .prop('title');
                    $(this)
                        .parent()
                        .parent()
                        .append('<a class="blogPostCommentCount" href="' + _href + '#disqus_thread" title="' + _title + '"></a>');
                    blogNr++;
                });
            var disqus_shortname = 'loopshape';
            (function () {
                var s = document.createElement('script');
                s.async = true;
                s.type = 'text/javascript';
                s.src = '//' + disqus_shortname + '.disqus.com/count.js';
                (document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0])
                .appendChild(s);
            }());

            $('#calendar .day')
                .on('click', function () {
                    $el = $(this);
                    $el.parent()
                        .find('.selected')
                        .removeClass('selected');
                    $el.addClass('selected')
                        .css({
                            'color': 'ff6',
                            'background-color': '#fe2'
                        });
                });

            if ($('ul.pagination')
                .length) {
                var $pagination = '<ul class="pagination">' + $('ul.pagination')
                    .clone()
                    .html() + '</ul>';
                $('ul.post-list')
                    .prepend($pagination);
            }

            /*
            $('#pageTeaser .colWrapper > .columns')
                .eq(1)
                .css({
                    'min-height': $('#pageTeaser .colWrapper > .columns')
                        .eq(0)
                        .height()
                });
            */
            
            $('.gsc-input-box .gsib_a')
                .append('<div id="searchDate"><p><span class="day">TT</span>-<span class="month">MM</span>-<span class="year">JJJJ</span></p></div>');

            var d = new Date();

            var thisMonth = d.getMonth() + 1;
            var thisDay = d.getDate();
            var thisYear = d.getFullYear();

            $('#searchDate')
                .find('.day')
                .html(thisDay);
            $('#searchDate')
                .find('.month')
                .html(thisMonth);
            $('#searchDate')
                .find('.year')
                .html(thisYear);

            var $topLeft = $('img[id^="frameBorder"]')
                .eq(1);
            var $topRight = $('img[id^="frameBorder"]')
                .eq(0);
            var $bottomLeft = $('img[id^="frameBorder"]')
                .eq(3);
            var $bottomRight = $('img[id^="frameBorder"]')
                .eq(2);

            /*
            $('img[id^="frameBorder"]')
                .on('click', function () {
                    $topLeft.css({
                        'left': '-2400px'
                    });
                    $topRight.css({
                        'right': '-2400px'
                    });
                    $bottomLeft.css({
                        'left': '-2400px'
                    });
                    $bottomRight.css({
                        'right': '-2400px'
                    });
                });
            */
            
            var app = require(['../assets/javascript/app']);
            
            //return true;
        });

    return true;
});
