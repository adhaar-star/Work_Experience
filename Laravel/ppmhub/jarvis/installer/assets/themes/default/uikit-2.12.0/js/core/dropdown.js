/*! UIkit 2.12.0 | http://www.getuikit.com | (c) 2014 YOOtheme | MIT License */
(function ($, UI) {

    "use strict";

    var active = false, hoverIdle;

    UI.component('dropdown', {

        defaults: {
            'mode': 'hover',
            'remaintime': 800,
            'justify': false,
            'boundary': UI.$win,
            'delay': 0
        },

        remainIdle: false,

        init: function () {

            var $this = this;

            this.dropdown = this.find(".uk-dropdown");

            this.centered = this.dropdown.hasClass("uk-dropdown-center");
            this.justified = this.options.justify ? $(this.options.justify) : false;

            this.boundary = $(this.options.boundary);
            this.flipped = this.dropdown.hasClass('uk-dropdown-flip');

            if (!this.boundary.length) {
                this.boundary = UI.$win;
            }

            if (this.options.mode == "click" || UI.support.touch) {

                this.on("click", function (e) {

                    var $target = $(e.target);

                    if (!$target.parents(".uk-dropdown").length) {

                        if ($target.is("a[href='#']") || $target.parent().is("a[href='#']") || ($this.dropdown.length && !$this.dropdown.is(":visible"))) {
                            e.preventDefault();
                        }

                        $target.blur();
                    }

                    if (!$this.element.hasClass("uk-open")) {

                        $this.show();

                    } else {

                        if ($target.is("a:not(.js-uk-prevent)") || $target.is(".uk-dropdown-close") || !$this.dropdown.find(e.target).length) {
                            $this.hide();
                        }
                    }
                });

            } else {

                this.on("mouseenter", function (e) {

                    if ($this.remainIdle) {
                        clearTimeout($this.remainIdle);
                    }

                    if (hoverIdle) {
                        clearTimeout(hoverIdle);
                    }

                    hoverIdle = setTimeout($this.show.bind($this), $this.options.delay);

                }).on("mouseleave", function () {

                    if (hoverIdle) {
                        clearTimeout(hoverIdle);
                    }

                    $this.remainIdle = setTimeout(function () {
                        $this.hide();
                    }, $this.options.remaintime);

                }).on("click", function (e) {

                    var $target = $(e.target);

                    if ($this.remainIdle) {
                        clearTimeout($this.remainIdle);
                    }

                    if ($target.is("a[href='#']") || $target.parent().is("a[href='#']")) {
                        e.preventDefault();
                    }

                    $this.show();
                });
            }
        },

        show: function () {

            UI.$html.off("click.outer.dropdown");

            if (active && active[0] != this.element[0]) {
                active.removeClass("uk-open");
            }

            if (hoverIdle) {
                clearTimeout(hoverIdle);
            }

            this.checkDimensions();
            this.element.addClass("uk-open");
            this.trigger('uk.dropdown.show', [this]);

            UI.Utils.checkDisplay(this.dropdown, true);
            active = this.element;

            this.registerOuterClick();
        },

        hide: function () {
            this.element.removeClass("uk-open");
            this.remainIdle = false;

            if (active && active[0] == this.element[0]) active = false;
        },

        registerOuterClick: function () {

            var $this = this;

            UI.$html.off("click.outer.dropdown");

            setTimeout(function () {

                UI.$html.on("click.outer.dropdown", function (e) {

                    if (hoverIdle) {
                        clearTimeout(hoverIdle);
                    }

                    var $target = $(e.target);

                    if (active && active[0] == $this.element[0] && ($target.is("a:not(.js-uk-prevent)") || $target.is(".uk-dropdown-close") || !$this.dropdown.find(e.target).length)) {
                        $this.hide();
                        UI.$html.off("click.outer.dropdown");
                    }
                });
            }, 10);
        },

        checkDimensions: function () {

            if (!this.dropdown.length) return;

            if (this.justified && this.justified.length) {
                this.dropdown.css("min-width", "");
            }

            var $this = this,
                dropdown = this.dropdown.css("margin-" + $.UIkit.langdirection, ""),
                offset = dropdown.show().offset(),
                width = dropdown.outerWidth(),
                boundarywidth = this.boundary.width(),
                boundaryoffset = this.boundary.offset() ? this.boundary.offset().left : 0;

            // centered dropdown
            if (this.centered) {
                dropdown.css("margin-" + $.UIkit.langdirection, (parseFloat(width) / 2 - dropdown.parent().width() / 2) * -1);
                offset = dropdown.offset();

                // reset dropdown
                if ((width + offset.left) > boundarywidth || offset.left < 0) {
                    dropdown.css("margin-" + $.UIkit.langdirection, "");
                    offset = dropdown.offset();
                }
            }

            // justify dropdown
            if (this.justified && this.justified.length) {

                var jwidth = this.justified.outerWidth();

                dropdown.css("min-width", jwidth);

                if ($.UIkit.langdirection == 'right') {

                    var right1 = boundarywidth - (this.justified.offset().left + jwidth),
                        right2 = boundarywidth - (dropdown.offset().left + dropdown.outerWidth());

                    dropdown.css("margin-right", right1 - right2);

                } else {
                    dropdown.css("margin-left", this.justified.offset().left - offset.left);
                }

                offset = dropdown.offset();

            }

            if ((width + (offset.left - boundaryoffset)) > boundarywidth) {
                dropdown.addClass("uk-dropdown-flip");
                offset = dropdown.offset();
            }

            if ((offset.left - boundaryoffset) < 0) {

                dropdown.addClass("uk-dropdown-stack");

                if (dropdown.hasClass("uk-dropdown-flip")) {

                    if (!this.flipped) {
                        dropdown.removeClass("uk-dropdown-flip");
                        offset = dropdown.offset();
                        dropdown.addClass("uk-dropdown-flip");
                    }

                    setTimeout(function () {

                        if ((dropdown.offset().left - boundaryoffset) < 0 || !$this.flipped && (dropdown.outerWidth() + (offset.left - boundaryoffset)) < boundarywidth) {
                            dropdown.removeClass("uk-dropdown-flip");
                        }
                    }, 0);
                }

                this.trigger('uk.dropdown.stack', [this]);
            }

            dropdown.css("display", "");
        }

    });

    var triggerevent = UI.support.touch ? "click" : "mouseenter";

    // init code
    UI.$html.on(triggerevent + ".dropdown.uikit", "[data-uk-dropdown]", function (e) {

        var ele = $(this);

        if (!ele.data("dropdown")) {

            var dropdown = UI.dropdown(ele, UI.Utils.options(ele.data("uk-dropdown")));

            if (triggerevent == "click" || (triggerevent == "mouseenter" && dropdown.options.mode == "hover")) {
                dropdown.element.trigger(triggerevent);
            }

            if (dropdown.element.find('.uk-dropdown').length) {
                e.preventDefault();
            }
        }
    });

})(jQuery, jQuery.UIkit);
