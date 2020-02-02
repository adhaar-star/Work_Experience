if (!Array.prototype.forEach) {

    Array.prototype.forEach = function (callback/*, thisArg*/) {

        var T, k;

        if (this == null) {
            throw new TypeError('this is null or not defined');
        }

        // 1. Let O be the result of calling toObject() passing the
        // |this| value as the argument.
        var O = Object(this);

        // 2. Let lenValue be the result of calling the Get() internal
        // method of O with the argument "length".
        // 3. Let len be toUint32(lenValue).
        var len = O.length >>> 0;

        // 4. If isCallable(callback) is false, throw a TypeError exception.
        // See: http://es5.github.com/#x9.11
        if (typeof callback !== 'function') {
            throw new TypeError(callback + ' is not a function');
        }

        // 5. If thisArg was supplied, let T be thisArg; else let
        // T be undefined.
        if (arguments.length > 1) {
            T = arguments[1];
        }

        // 6. Let k be 0.
        k = 0;

        // 7. Repeat while k < len.
        while (k < len) {

            var kValue;

            // a. Let Pk be ToString(k).
            //    This is implicit for LHS operands of the in operator.
            // b. Let kPresent be the result of calling the HasProperty
            //    internal method of O with argument Pk.
            //    This step can be combined with c.
            // c. If kPresent is true, then
            if (k in O) {

                // i. Let kValue be the result of calling the Get internal
                // method of O with argument Pk.
                kValue = O[k];

                // ii. Call the Call internal method of callback with T as
                // the this value and argument list containing kValue, k, and O.
                callback.call(T, kValue, k, O);
            }
            // d. Increase k by 1.
            k++;
        }
        // 8. return undefined.
    };
}



$(function () {
    // CUSTOM SCROLL
    if (!cleanUI.hasTouch) {
        $('.custom-scroll').each(function () {
            $(this).jScrollPane({
                autoReinitialise: true,
                autoReinitialiseDelay: 100
            });
            var api = $(this).data('jsp'),
                throttleTimeout;
            $(window).bind('resize', function () {
                if (!throttleTimeout) {
                    throttleTimeout = setTimeout(function () {
                        api.reinitialise();
                        throttleTimeout = null;
                    }, 50);
                }
            });
        });
    }

    // CSS STYLING & ANIMATIONS
    var cssAnimationData = {
            labels: ["S", "M", "T", "W", "T", "F", "S"],
            series: [
                [11, 14, 24, 16, 20, 16, 24]
            ]
        },
        cssAnimationOptions = {
            fullWidth: !0,
            chartPadding: {
                right: 2,
                left: 30
            },
            axisY: {
                position: 'end'
            }
        },
        cssAnimationResponsiveOptions = [
            [{
                axisX: {
                    labelInterpolationFnc: function (value, index) {
                        return index % 2 !== 0 ? !1 : value
                    }
                }
            }]
        ];
    new Chartist.Line(".example-left-menu-chart", cssAnimationData, cssAnimationOptions, cssAnimationResponsiveOptions);

    var topMenuChart = $("#topMenuChart").peity("bar", {
        fill: ['#01a8fe'],
        height: 22,
        width: 44
    });
    setInterval(function () {
        var random = Math.round(Math.random() * 10);
        var values = topMenuChart.text().split(",");
        values.shift();
        values.push(random);
        topMenuChart.text(values.join(",")).change()
    }, 1000);
});




if($('.error_container').length > 0){
    $('.error_container').fadeIn('slow').delay(4000).fadeOut('slow');
}
$('input.datepicker-only-init').datetimepicker({
    widgetPositioning: {
        horizontal: 'left'
    },
    icons: {
        time: "fa fa-clock-o",
        date: "fa fa-calendar",
        up: "fa fa-arrow-up",
        down: "fa fa-arrow-down",
        next: "fa fa-arrow-right",
        previous: "fa fa-arrow-left",
    },
    format: 'YYYY-MM-DD'
});
