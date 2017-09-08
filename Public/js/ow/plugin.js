/**
 * 
 * @authors Your Name (you@example.org)
 * @date    2016-12-03 15:56:38
 * @version $Id$
 */
;
(function($) {
	$.fn.numberAnimate = function(setting) {
		var defaults = {
			speed: 1000, //动画速度
			num: "", //初始化�?
			iniAnimate: true, //是否要初始化动画效果
			symbol: '', //默认的分割符号，千，万，千万
			dot: 0, //保留几位小数�?
			pst: "" //是否�? 百分�?
		}
		//如果setting为空，就取default的�?
		var setting = $.extend(defaults, setting);

		//如果对象有多个，提示出错
		if($(this).length > 1) {
			alert("just only one obj!");
			return;
		}

		//如果未设置初始化值。提示出�?
		if(setting.num == "") {
			alert("must set a num!");
			return;
		}
		var nHtml = '<div class="mt-number-animate-dom" data-num="{{num}}">\
            <span class="mt-number-animate-span">0</span>\
            <span class="mt-number-animate-span">1</span>\
            <span class="mt-number-animate-span">2</span>\
            <span class="mt-number-animate-span">3</span>\
            <span class="mt-number-animate-span">4</span>\
            <span class="mt-number-animate-span">5</span>\
            <span class="mt-number-animate-span">6</span>\
            <span class="mt-number-animate-span">7</span>\
            <span class="mt-number-animate-span">8</span>\
            <span class="mt-number-animate-span">9</span>\
            <span class="mt-number-animate-span">.</span>\
          </div>';

		//数字处理
		var numToArr = function(num) {
			num = parseFloat(num).toFixed(setting.dot);
			if(typeof(num) == 'number') {
				var arrStr = num.toString().split("");
			} else {
				var arrStr = num.split("");
			}
			//console.log(arrStr);
			return arrStr;
		}

		//设置DOM symbol:分割符号
		var setNumDom = function(arrStr) {
			var shtml = '<div class="mt-number-animate">';
			for(var i = 0, len = arrStr.length; i < len; i++) {
				if(i != 0 && (len - i) % 3 == 0 && setting.symbol != "" && arrStr[i] != ".") {
					shtml += '<div class="mt-number-animate-dot">' + setting.symbol + '</div>' + nHtml.replace("{{num}}", arrStr[i]);
				} else {
					shtml += nHtml.replace("{{num}}", arrStr[i]);
				}
			}
			if(setting.pst) {
				shtml += '%</div>';
			} else {
				shtml += '</div>';
			}
			return shtml;
		}

		//执行动画
		var runAnimate = function($parent) {
			$parent.find(".mt-number-animate-dom").each(function() {
				var num = $(this).attr("data-num");
				num = (num == "." ? 10 : num);
				var spanHei = $(this).height() / 11; //11为元素个�?
				var thisTop = -num * spanHei + "px";
				if(thisTop != $(this).css("top")) {
					if(setting.iniAnimate) {
						//HTML5不支�?
						if(!window.applicationCache) {
							$(this).animate({
								top: thisTop
							}, setting.speed);
						} else {
							$(this).css({
								'transform': 'translateY(' + thisTop + ')',
								'-ms-transform': 'translateY(' + thisTop + ')',
								/* IE 9 */
								'-moz-transform': 'translateY(' + thisTop + ')',
								/* Firefox */
								'-webkit-transform': 'translateY(' + thisTop + ')',
								/* Safari �? Chrome */
								'-o-transform': 'translateY(' + thisTop + ')',
								'-ms-transition': setting.speed / 1000 + 's',
								'-moz-transition': setting.speed / 1000 + 's',
								'-webkit-transition': setting.speed / 1000 + 's',
								'-o-transition': setting.speed / 1000 + 's',
								'transition': setting.speed / 1000 + 's'
							});
						}
					} else {
						setting.iniAnimate = true;
						$(this).css({
							top: thisTop
						});
					}
				}
			});
		}

		//初始�?
		var init = function($parent) {
			//初始�?
			$parent.html(setNumDom(numToArr(setting.num)));
			runAnimate($parent);
		};

		//重置参数
		this.resetData = function(num) {
			var newArr = numToArr(num);
			var $dom = $(this).find(".mt-number-animate-dom");
			if($dom.length < newArr.length) {
				$(this).html(setNumDom(numToArr(num)));
			} else {
				$dom.each(function(index, el) {
					$(this).attr("data-num", newArr[index]);
				});
			}
			runAnimate($(this));
		}
		//init
		init($(this));
		return this;
	}
})(jQuery);

/* == jquery mousewheel plugin == Version: 3.1.13, License: MIT License (MIT) */
! function(a) {
	"function" == typeof define && define.amd ? define(["jquery"], a) : "object" == typeof exports ? module.exports = a : a(jQuery)
}(function(a) {
	function b(b) {
		var g = b || window.event,
			h = i.call(arguments, 1),
			j = 0,
			l = 0,
			m = 0,
			n = 0,
			o = 0,
			p = 0;
		if(b = a.event.fix(g), b.type = "mousewheel", "detail" in g && (m = -1 * g.detail), "wheelDelta" in g && (m = g.wheelDelta), "wheelDeltaY" in g && (m = g.wheelDeltaY), "wheelDeltaX" in g && (l = -1 * g.wheelDeltaX), "axis" in g && g.axis === g.HORIZONTAL_AXIS && (l = -1 * m, m = 0), j = 0 === m ? l : m, "deltaY" in g && (m = -1 * g.deltaY, j = m), "deltaX" in g && (l = g.deltaX, 0 === m && (j = -1 * l)), 0 !== m || 0 !== l) {
			if(1 === g.deltaMode) {
				var q = a.data(this, "mousewheel-line-height");
				j *= q, m *= q, l *= q
			} else if(2 === g.deltaMode) {
				var r = a.data(this, "mousewheel-page-height");
				j *= r, m *= r, l *= r
			}
			if(n = Math.max(Math.abs(m), Math.abs(l)), (!f || f > n) && (f = n, d(g, n) && (f /= 40)), d(g, n) && (j /= 40, l /= 40, m /= 40), j = Math[j >= 1 ? "floor" : "ceil"](j / f), l = Math[l >= 1 ? "floor" : "ceil"](l / f), m = Math[m >= 1 ? "floor" : "ceil"](m / f), k.settings.normalizeOffset && this.getBoundingClientRect) {
				var s = this.getBoundingClientRect();
				o = b.clientX - s.left, p = b.clientY - s.top
			}
			return b.deltaX = l, b.deltaY = m, b.deltaFactor = f, b.offsetX = o, b.offsetY = p, b.deltaMode = 0, h.unshift(b, j, l, m), e && clearTimeout(e), e = setTimeout(c, 200), (a.event.dispatch || a.event.handle).apply(this, h)
		}
	}

	function c() {
		f = null
	}

	function d(a, b) {
		return k.settings.adjustOldDeltas && "mousewheel" === a.type && b % 120 === 0
	}
	var e, f, g = ["wheel", "mousewheel", "DOMMouseScroll", "MozMousePixelScroll"],
		h = "onwheel" in document || document.documentMode >= 9 ? ["wheel"] : ["mousewheel", "DomMouseScroll", "MozMousePixelScroll"],
		i = Array.prototype.slice;
	if(a.event.fixHooks)
		for(var j = g.length; j;) a.event.fixHooks[g[--j]] = a.event.mouseHooks;
	var k = a.event.special.mousewheel = {
		version: "3.1.12",
		setup: function() {
			if(this.addEventListener)
				for(var c = h.length; c;) this.addEventListener(h[--c], b, !1);
			else this.onmousewheel = b;
			a.data(this, "mousewheel-line-height", k.getLineHeight(this)), a.data(this, "mousewheel-page-height", k.getPageHeight(this))
		},
		teardown: function() {
			if(this.removeEventListener)
				for(var c = h.length; c;) this.removeEventListener(h[--c], b, !1);
			else this.onmousewheel = null;
			a.removeData(this, "mousewheel-line-height"), a.removeData(this, "mousewheel-page-height")
		},
		getLineHeight: function(b) {
			var c = a(b),
				d = c["offsetParent" in a.fn ? "offsetParent" : "parent"]();
			return d.length || (d = a("body")), parseInt(d.css("fontSize"), 10) || parseInt(c.css("fontSize"), 10) || 16
		},
		getPageHeight: function(b) {
			return a(b).height()
		},
		settings: {
			adjustOldDeltas: !0,
			normalizeOffset: !0
		}
	};
	a.fn.extend({
		mousewheel: function(a) {
			return a ? this.bind("mousewheel", a) : this.trigger("mousewheel")
		},
		unmousewheel: function(a) {
			return this.unbind("mousewheel", a)
		}
	})
});
! function(a) {
	"function" == typeof define && define.amd ? define(["jquery"], a) : "object" == typeof exports ? module.exports = a : a(jQuery)
}(function(a) {
	function b(b) {
		var g = b || window.event,
			h = i.call(arguments, 1),
			j = 0,
			l = 0,
			m = 0,
			n = 0,
			o = 0,
			p = 0;
		if(b = a.event.fix(g), b.type = "mousewheel", "detail" in g && (m = -1 * g.detail), "wheelDelta" in g && (m = g.wheelDelta), "wheelDeltaY" in g && (m = g.wheelDeltaY), "wheelDeltaX" in g && (l = -1 * g.wheelDeltaX), "axis" in g && g.axis === g.HORIZONTAL_AXIS && (l = -1 * m, m = 0), j = 0 === m ? l : m, "deltaY" in g && (m = -1 * g.deltaY, j = m), "deltaX" in g && (l = g.deltaX, 0 === m && (j = -1 * l)), 0 !== m || 0 !== l) {
			if(1 === g.deltaMode) {
				var q = a.data(this, "mousewheel-line-height");
				j *= q, m *= q, l *= q
			} else if(2 === g.deltaMode) {
				var r = a.data(this, "mousewheel-page-height");
				j *= r, m *= r, l *= r
			}
			if(n = Math.max(Math.abs(m), Math.abs(l)), (!f || f > n) && (f = n, d(g, n) && (f /= 40)), d(g, n) && (j /= 40, l /= 40, m /= 40), j = Math[j >= 1 ? "floor" : "ceil"](j / f), l = Math[l >= 1 ? "floor" : "ceil"](l / f), m = Math[m >= 1 ? "floor" : "ceil"](m / f), k.settings.normalizeOffset && this.getBoundingClientRect) {
				var s = this.getBoundingClientRect();
				o = b.clientX - s.left, p = b.clientY - s.top
			}
			return b.deltaX = l, b.deltaY = m, b.deltaFactor = f, b.offsetX = o, b.offsetY = p, b.deltaMode = 0, h.unshift(b, j, l, m), e && clearTimeout(e), e = setTimeout(c, 200), (a.event.dispatch || a.event.handle).apply(this, h)
		}
	}

	function c() {
		f = null
	}

	function d(a, b) {
		return k.settings.adjustOldDeltas && "mousewheel" === a.type && b % 120 === 0
	}
	var e, f, g = ["wheel", "mousewheel", "DOMMouseScroll", "MozMousePixelScroll"],
		h = "onwheel" in document || document.documentMode >= 9 ? ["wheel"] : ["mousewheel", "DomMouseScroll", "MozMousePixelScroll"],
		i = Array.prototype.slice;
	if(a.event.fixHooks)
		for(var j = g.length; j;) a.event.fixHooks[g[--j]] = a.event.mouseHooks;
	var k = a.event.special.mousewheel = {
		version: "3.1.12",
		setup: function() {
			if(this.addEventListener)
				for(var c = h.length; c;) this.addEventListener(h[--c], b, !1);
			else this.onmousewheel = b;
			a.data(this, "mousewheel-line-height", k.getLineHeight(this)), a.data(this, "mousewheel-page-height", k.getPageHeight(this))
		},
		teardown: function() {
			if(this.removeEventListener)
				for(var c = h.length; c;) this.removeEventListener(h[--c], b, !1);
			else this.onmousewheel = null;
			a.removeData(this, "mousewheel-line-height"), a.removeData(this, "mousewheel-page-height")
		},
		getLineHeight: function(b) {
			var c = a(b),
				d = c["offsetParent" in a.fn ? "offsetParent" : "parent"]();
			return d.length || (d = a("body")), parseInt(d.css("fontSize"), 10) || parseInt(c.css("fontSize"), 10) || 16
		},
		getPageHeight: function(b) {
			return a(b).height()
		},
		settings: {
			adjustOldDeltas: !0,
			normalizeOffset: !0
		}
	};
	a.fn.extend({
		mousewheel: function(a) {
			return a ? this.bind("mousewheel", a) : this.trigger("mousewheel")
		},
		unmousewheel: function(a) {
			return this.unbind("mousewheel", a)
		}
	})
});
/* == malihu jquery custom scrollbar plugin == Version: 3.1.5, License: MIT License (MIT) */
! function(e) {
	"function" == typeof define && define.amd ? define(["jquery"], e) : "undefined" != typeof module && module.exports ? module.exports = e : e(jQuery, window, document)
}(function(e) {
	! function(t) {
		var o = "function" == typeof define && define.amd,
			a = "undefined" != typeof module && module.exports,
			n = "https:" == document.location.protocol ? "https:" : "http:",
			i = "cdnjs.cloudflare.com/ajax/libs/jquery-mousewheel/3.1.13/jquery.mousewheel.min.js";
		o || (a ? require("jquery-mousewheel")(e) : e.event.special.mousewheel || e("head").append(decodeURI("%3Cscript src=" + n + "//" + i + "%3E%3C/script%3E"))), t()
	}(function() {
		var t, o = "mCustomScrollbar",
			a = "mCS",
			n = ".mCustomScrollbar",
			i = {
				setTop: 0,
				setLeft: 0,
				axis: "y",
				scrollbarPosition: "inside",
				scrollInertia: 950,
				autoDraggerLength: !0,
				alwaysShowScrollbar: 0,
				snapOffset: 0,
				mouseWheel: {
					enable: !0,
					scrollAmount: "auto",
					axis: "y",
					deltaFactor: "auto",
					disableOver: ["select", "option", "keygen", "datalist", "textarea"]
				},
				scrollButtons: {
					scrollType: "stepless",
					scrollAmount: "auto"
				},
				keyboard: {
					enable: !0,
					scrollType: "stepless",
					scrollAmount: "auto"
				},
				contentTouchScroll: 25,
				documentTouchScroll: !0,
				advanced: {
					autoScrollOnFocus: "input,textarea,select,button,datalist,keygen,a[tabindex],area,object,[contenteditable='true']",
					updateOnContentResize: !0,
					updateOnImageLoad: "auto",
					autoUpdateTimeout: 60
				},
				theme: "light",
				callbacks: {
					onTotalScrollOffset: 0,
					onTotalScrollBackOffset: 0,
					alwaysTriggerOffsets: !0
				}
			},
			r = 0,
			l = {},
			s = window.attachEvent && !window.addEventListener ? 1 : 0,
			c = !1,
			d = ["mCSB_dragger_onDrag", "mCSB_scrollTools_onDrag", "mCS_img_loaded", "mCS_disabled", "mCS_destroyed", "mCS_no_scrollbar", "mCS-autoHide", "mCS-dir-rtl", "mCS_no_scrollbar_y", "mCS_no_scrollbar_x", "mCS_y_hidden", "mCS_x_hidden", "mCSB_draggerContainer", "mCSB_buttonUp", "mCSB_buttonDown", "mCSB_buttonLeft", "mCSB_buttonRight"],
			u = {
				init: function(t) {
					var t = e.extend(!0, {}, i, t),
						o = f.call(this);
					if(t.live) {
						var s = t.liveSelector || this.selector || n,
							c = e(s);
						if("off" === t.live) return void m(s);
						l[s] = setTimeout(function() {
							c.mCustomScrollbar(t), "once" === t.live && c.length && m(s)
						}, 500)
					} else m(s);
					return t.setWidth = t.set_width ? t.set_width : t.setWidth, t.setHeight = t.set_height ? t.set_height : t.setHeight, t.axis = t.horizontalScroll ? "x" : p(t.axis), t.scrollInertia = t.scrollInertia > 0 && t.scrollInertia < 17 ? 17 : t.scrollInertia, "object" != typeof t.mouseWheel && 1 == t.mouseWheel && (t.mouseWheel = {
						enable: !0,
						scrollAmount: "auto",
						axis: "y",
						preventDefault: !1,
						deltaFactor: "auto",
						normalizeDelta: !1,
						invert: !1
					}), t.mouseWheel.scrollAmount = t.mouseWheelPixels ? t.mouseWheelPixels : t.mouseWheel.scrollAmount, t.mouseWheel.normalizeDelta = t.advanced.normalizeMouseWheelDelta ? t.advanced.normalizeMouseWheelDelta : t.mouseWheel.normalizeDelta, t.scrollButtons.scrollType = g(t.scrollButtons.scrollType), h(t), e(o).each(function() {
						var o = e(this);
						if(!o.data(a)) {
							o.data(a, {
								idx: ++r,
								opt: t,
								scrollRatio: {
									y: null,
									x: null
								},
								overflowed: null,
								contentReset: {
									y: null,
									x: null
								},
								bindEvents: !1,
								tweenRunning: !1,
								sequential: {},
								langDir: o.css("direction"),
								cbOffsets: null,
								trigger: null,
								poll: {
									size: {
										o: 0,
										n: 0
									},
									img: {
										o: 0,
										n: 0
									},
									change: {
										o: 0,
										n: 0
									}
								}
							});
							var n = o.data(a),
								i = n.opt,
								l = o.data("mcs-axis"),
								s = o.data("mcs-scrollbar-position"),
								c = o.data("mcs-theme");
							l && (i.axis = l), s && (i.scrollbarPosition = s), c && (i.theme = c, h(i)), v.call(this), n && i.callbacks.onCreate && "function" == typeof i.callbacks.onCreate && i.callbacks.onCreate.call(this), e("#mCSB_" + n.idx + "_container img:not(." + d[2] + ")").addClass(d[2]), u.update.call(null, o)
						}
					})
				},
				update: function(t, o) {
					var n = t || f.call(this);
					return e(n).each(function() {
						var t = e(this);
						if(t.data(a)) {
							var n = t.data(a),
								i = n.opt,
								r = e("#mCSB_" + n.idx + "_container"),
								l = e("#mCSB_" + n.idx),
								s = [e("#mCSB_" + n.idx + "_dragger_vertical"), e("#mCSB_" + n.idx + "_dragger_horizontal")];
							if(!r.length) return;
							n.tweenRunning && Q(t), o && n && i.callbacks.onBeforeUpdate && "function" == typeof i.callbacks.onBeforeUpdate && i.callbacks.onBeforeUpdate.call(this), t.hasClass(d[3]) && t.removeClass(d[3]), t.hasClass(d[4]) && t.removeClass(d[4]), l.css("max-height", "none"), l.height() !== t.height() && l.css("max-height", t.height()), _.call(this), "y" === i.axis || i.advanced.autoExpandHorizontalScroll || r.css("width", x(r)), n.overflowed = y.call(this), M.call(this), i.autoDraggerLength && S.call(this), b.call(this), T.call(this);
							var c = [Math.abs(r[0].offsetTop), Math.abs(r[0].offsetLeft)];
							"x" !== i.axis && (n.overflowed[0] ? s[0].height() > s[0].parent().height() ? B.call(this) : (G(t, c[0].toString(), {
								dir: "y",
								dur: 0,
								overwrite: "none"
							}), n.contentReset.y = null) : (B.call(this), "y" === i.axis ? k.call(this) : "yx" === i.axis && n.overflowed[1] && G(t, c[1].toString(), {
								dir: "x",
								dur: 0,
								overwrite: "none"
							}))), "y" !== i.axis && (n.overflowed[1] ? s[1].width() > s[1].parent().width() ? B.call(this) : (G(t, c[1].toString(), {
								dir: "x",
								dur: 0,
								overwrite: "none"
							}), n.contentReset.x = null) : (B.call(this), "x" === i.axis ? k.call(this) : "yx" === i.axis && n.overflowed[0] && G(t, c[0].toString(), {
								dir: "y",
								dur: 0,
								overwrite: "none"
							}))), o && n && (2 === o && i.callbacks.onImageLoad && "function" == typeof i.callbacks.onImageLoad ? i.callbacks.onImageLoad.call(this) : 3 === o && i.callbacks.onSelectorChange && "function" == typeof i.callbacks.onSelectorChange ? i.callbacks.onSelectorChange.call(this) : i.callbacks.onUpdate && "function" == typeof i.callbacks.onUpdate && i.callbacks.onUpdate.call(this)), N.call(this)
						}
					})
				},
				scrollTo: function(t, o) {
					if("undefined" != typeof t && null != t) {
						var n = f.call(this);
						return e(n).each(function() {
							var n = e(this);
							if(n.data(a)) {
								var i = n.data(a),
									r = i.opt,
									l = {
										trigger: "external",
										scrollInertia: r.scrollInertia,
										scrollEasing: "mcsEaseInOut",
										moveDragger: !1,
										timeout: 60,
										callbacks: !0,
										onStart: !0,
										onUpdate: !0,
										onComplete: !0
									},
									s = e.extend(!0, {}, l, o),
									c = Y.call(this, t),
									d = s.scrollInertia > 0 && s.scrollInertia < 17 ? 17 : s.scrollInertia;
								c[0] = X.call(this, c[0], "y"), c[1] = X.call(this, c[1], "x"), s.moveDragger && (c[0] *= i.scrollRatio.y, c[1] *= i.scrollRatio.x), s.dur = ne() ? 0 : d, setTimeout(function() {
									null !== c[0] && "undefined" != typeof c[0] && "x" !== r.axis && i.overflowed[0] && (s.dir = "y", s.overwrite = "all", G(n, c[0].toString(), s)), null !== c[1] && "undefined" != typeof c[1] && "y" !== r.axis && i.overflowed[1] && (s.dir = "x", s.overwrite = "none", G(n, c[1].toString(), s))
								}, s.timeout)
							}
						})
					}
				},
				stop: function() {
					var t = f.call(this);
					return e(t).each(function() {
						var t = e(this);
						t.data(a) && Q(t)
					})
				},
				disable: function(t) {
					var o = f.call(this);
					return e(o).each(function() {
						var o = e(this);
						if(o.data(a)) {
							o.data(a);
							N.call(this, "remove"), k.call(this), t && B.call(this), M.call(this, !0), o.addClass(d[3])
						}
					})
				},
				destroy: function() {
					var t = f.call(this);
					return e(t).each(function() {
						var n = e(this);
						if(n.data(a)) {
							var i = n.data(a),
								r = i.opt,
								l = e("#mCSB_" + i.idx),
								s = e("#mCSB_" + i.idx + "_container"),
								c = e(".mCSB_" + i.idx + "_scrollbar");
							r.live && m(r.liveSelector || e(t).selector), N.call(this, "remove"), k.call(this), B.call(this), n.removeData(a), $(this, "mcs"), c.remove(), s.find("img." + d[2]).removeClass(d[2]), l.replaceWith(s.contents()), n.removeClass(o + " _" + a + "_" + i.idx + " " + d[6] + " " + d[7] + " " + d[5] + " " + d[3]).addClass(d[4])
						}
					})
				}
			},
			f = function() {
				return "object" != typeof e(this) || e(this).length < 1 ? n : this
			},
			h = function(t) {
				var o = ["rounded", "rounded-dark", "rounded-dots", "rounded-dots-dark"],
					a = ["rounded-dots", "rounded-dots-dark", "3d", "3d-dark", "3d-thick", "3d-thick-dark", "inset", "inset-dark", "inset-2", "inset-2-dark", "inset-3", "inset-3-dark"],
					n = ["minimal", "minimal-dark"],
					i = ["minimal", "minimal-dark"],
					r = ["minimal", "minimal-dark"];
				t.autoDraggerLength = e.inArray(t.theme, o) > -1 ? !1 : t.autoDraggerLength, t.autoExpandScrollbar = e.inArray(t.theme, a) > -1 ? !1 : t.autoExpandScrollbar, t.scrollButtons.enable = e.inArray(t.theme, n) > -1 ? !1 : t.scrollButtons.enable, t.autoHideScrollbar = e.inArray(t.theme, i) > -1 ? !0 : t.autoHideScrollbar, t.scrollbarPosition = e.inArray(t.theme, r) > -1 ? "outside" : t.scrollbarPosition
			},
			m = function(e) {
				l[e] && (clearTimeout(l[e]), $(l, e))
			},
			p = function(e) {
				return "yx" === e || "xy" === e || "auto" === e ? "yx" : "x" === e || "horizontal" === e ? "x" : "y"
			},
			g = function(e) {
				return "stepped" === e || "pixels" === e || "step" === e || "click" === e ? "stepped" : "stepless"
			},
			v = function() {
				var t = e(this),
					n = t.data(a),
					i = n.opt,
					r = i.autoExpandScrollbar ? " " + d[1] + "_expand" : "",
					l = ["<div id='mCSB_" + n.idx + "_scrollbar_vertical' class='mCSB_scrollTools mCSB_" + n.idx + "_scrollbar mCS-" + i.theme + " mCSB_scrollTools_vertical" + r + "'><div class='" + d[12] + "'><div id='mCSB_" + n.idx + "_dragger_vertical' class='mCSB_dragger' style='position:absolute;'><div class='mCSB_dragger_bar' /></div><div class='mCSB_draggerRail' /></div></div>", "<div id='mCSB_" + n.idx + "_scrollbar_horizontal' class='mCSB_scrollTools mCSB_" + n.idx + "_scrollbar mCS-" + i.theme + " mCSB_scrollTools_horizontal" + r + "'><div class='" + d[12] + "'><div id='mCSB_" + n.idx + "_dragger_horizontal' class='mCSB_dragger' style='position:absolute;'><div class='mCSB_dragger_bar' /></div><div class='mCSB_draggerRail' /></div></div>"],
					s = "yx" === i.axis ? "mCSB_vertical_horizontal" : "x" === i.axis ? "mCSB_horizontal" : "mCSB_vertical",
					c = "yx" === i.axis ? l[0] + l[1] : "x" === i.axis ? l[1] : l[0],
					u = "yx" === i.axis ? "<div id='mCSB_" + n.idx + "_container_wrapper' class='mCSB_container_wrapper' />" : "",
					f = i.autoHideScrollbar ? " " + d[6] : "",
					h = "x" !== i.axis && "rtl" === n.langDir ? " " + d[7] : "";
				i.setWidth && t.css("width", i.setWidth), i.setHeight && t.css("height", i.setHeight), i.setLeft = "y" !== i.axis && "rtl" === n.langDir ? "989999px" : i.setLeft, t.addClass(o + " _" + a + "_" + n.idx + f + h).wrapInner("<div id='mCSB_" + n.idx + "' class='mCustomScrollBox mCS-" + i.theme + " " + s + "'><div id='mCSB_" + n.idx + "_container' class='mCSB_container' style='position:relative; top:" + i.setTop + "; left:" + i.setLeft + ";' dir='" + n.langDir + "' /></div>");
				var m = e("#mCSB_" + n.idx),
					p = e("#mCSB_" + n.idx + "_container");
				"y" === i.axis || i.advanced.autoExpandHorizontalScroll || p.css("width", x(p)), "outside" === i.scrollbarPosition ? ("static" === t.css("position") && t.css("position", "relative"), t.css("overflow", "visible"), m.addClass("mCSB_outside").after(c)) : (m.addClass("mCSB_inside").append(c), p.wrap(u)), w.call(this);
				var g = [e("#mCSB_" + n.idx + "_dragger_vertical"), e("#mCSB_" + n.idx + "_dragger_horizontal")];
				g[0].css("min-height", g[0].height()), g[1].css("min-width", g[1].width())
			},
			x = function(t) {
				var o = [t[0].scrollWidth, Math.max.apply(Math, t.children().map(function() {
						return e(this).outerWidth(!0)
					}).get())],
					a = t.parent().width();
				return o[0] > a ? o[0] : o[1] > a ? o[1] : "100%"
			},
			_ = function() {
				var t = e(this),
					o = t.data(a),
					n = o.opt,
					i = e("#mCSB_" + o.idx + "_container");
				if(n.advanced.autoExpandHorizontalScroll && "y" !== n.axis) {
					i.css({
						width: "auto",
						"min-width": 0,
						"overflow-x": "scroll"
					});
					var r = Math.ceil(i[0].scrollWidth);
					3 === n.advanced.autoExpandHorizontalScroll || 2 !== n.advanced.autoExpandHorizontalScroll && r > i.parent().width() ? i.css({
						width: r,
						"min-width": "100%",
						"overflow-x": "inherit"
					}) : i.css({
						"overflow-x": "inherit",
						position: "absolute"
					}).wrap("<div class='mCSB_h_wrapper' style='position:relative; left:0; width:999999px;' />").css({
						width: Math.ceil(i[0].getBoundingClientRect().right + .4) - Math.floor(i[0].getBoundingClientRect().left),
						"min-width": "100%",
						position: "relative"
					}).unwrap()
				}
			},
			w = function() {
				var t = e(this),
					o = t.data(a),
					n = o.opt,
					i = e(".mCSB_" + o.idx + "_scrollbar:first"),
					r = oe(n.scrollButtons.tabindex) ? "tabindex='" + n.scrollButtons.tabindex + "'" : "",
					l = ["<a href='#' class='" + d[13] + "' " + r + " />", "<a href='#' class='" + d[14] + "' " + r + " />", "<a href='#' class='" + d[15] + "' " + r + " />", "<a href='#' class='" + d[16] + "' " + r + " />"],
					s = ["x" === n.axis ? l[2] : l[0], "x" === n.axis ? l[3] : l[1], l[2], l[3]];
				n.scrollButtons.enable && i.prepend(s[0]).append(s[1]).next(".mCSB_scrollTools").prepend(s[2]).append(s[3])
			},
			S = function() {
				var t = e(this),
					o = t.data(a),
					n = e("#mCSB_" + o.idx),
					i = e("#mCSB_" + o.idx + "_container"),
					r = [e("#mCSB_" + o.idx + "_dragger_vertical"), e("#mCSB_" + o.idx + "_dragger_horizontal")],
					l = [n.height() / i.outerHeight(!1), n.width() / i.outerWidth(!1)],
					c = [parseInt(r[0].css("min-height")), Math.round(l[0] * r[0].parent().height()), parseInt(r[1].css("min-width")), Math.round(l[1] * r[1].parent().width())],
					d = s && c[1] < c[0] ? c[0] : c[1],
					u = s && c[3] < c[2] ? c[2] : c[3];
				r[0].css({
					height: d,
					"max-height": r[0].parent().height() - 10
				}).find(".mCSB_dragger_bar").css({
					"line-height": c[0] + "px"
				}), r[1].css({
					width: u,
					"max-width": r[1].parent().width() - 10
				})
			},
			b = function() {
				var t = e(this),
					o = t.data(a),
					n = e("#mCSB_" + o.idx),
					i = e("#mCSB_" + o.idx + "_container"),
					r = [e("#mCSB_" + o.idx + "_dragger_vertical"), e("#mCSB_" + o.idx + "_dragger_horizontal")],
					l = [i.outerHeight(!1) - n.height(), i.outerWidth(!1) - n.width()],
					s = [l[0] / (r[0].parent().height() - r[0].height()), l[1] / (r[1].parent().width() - r[1].width())];
				o.scrollRatio = {
					y: s[0],
					x: s[1]
				}
			},
			C = function(e, t, o) {
				var a = o ? d[0] + "_expanded" : "",
					n = e.closest(".mCSB_scrollTools");
				"active" === t ? (e.toggleClass(d[0] + " " + a), n.toggleClass(d[1]), e[0]._draggable = e[0]._draggable ? 0 : 1) : e[0]._draggable || ("hide" === t ? (e.removeClass(d[0]), n.removeClass(d[1])) : (e.addClass(d[0]), n.addClass(d[1])))
			},
			y = function() {
				var t = e(this),
					o = t.data(a),
					n = e("#mCSB_" + o.idx),
					i = e("#mCSB_" + o.idx + "_container"),
					r = null == o.overflowed ? i.height() : i.outerHeight(!1),
					l = null == o.overflowed ? i.width() : i.outerWidth(!1),
					s = i[0].scrollHeight,
					c = i[0].scrollWidth;
				return s > r && (r = s), c > l && (l = c), [r > n.height(), l > n.width()]
			},
			B = function() {
				var t = e(this),
					o = t.data(a),
					n = o.opt,
					i = e("#mCSB_" + o.idx),
					r = e("#mCSB_" + o.idx + "_container"),
					l = [e("#mCSB_" + o.idx + "_dragger_vertical"), e("#mCSB_" + o.idx + "_dragger_horizontal")];
				if(Q(t), ("x" !== n.axis && !o.overflowed[0] || "y" === n.axis && o.overflowed[0]) && (l[0].add(r).css("top", 0), G(t, "_resetY")), "y" !== n.axis && !o.overflowed[1] || "x" === n.axis && o.overflowed[1]) {
					var s = dx = 0;
					"rtl" === o.langDir && (s = i.width() - r.outerWidth(!1), dx = Math.abs(s / o.scrollRatio.x)), r.css("left", s), l[1].css("left", dx), G(t, "_resetX")
				}
			},
			T = function() {
				function t() {
					r = setTimeout(function() {
						e.event.special.mousewheel ? (clearTimeout(r), W.call(o[0])) : t()
					}, 100)
				}
				var o = e(this),
					n = o.data(a),
					i = n.opt;
				if(!n.bindEvents) {
					if(I.call(this), i.contentTouchScroll && D.call(this), E.call(this), i.mouseWheel.enable) {
						var r;
						t()
					}
					P.call(this), U.call(this), i.advanced.autoScrollOnFocus && H.call(this), i.scrollButtons.enable && F.call(this), i.keyboard.enable && q.call(this), n.bindEvents = !0
				}
			},
			k = function() {
				var t = e(this),
					o = t.data(a),
					n = o.opt,
					i = a + "_" + o.idx,
					r = ".mCSB_" + o.idx + "_scrollbar",
					l = e("#mCSB_" + o.idx + ",#mCSB_" + o.idx + "_container,#mCSB_" + o.idx + "_container_wrapper," + r + " ." + d[12] + ",#mCSB_" + o.idx + "_dragger_vertical,#mCSB_" + o.idx + "_dragger_horizontal," + r + ">a"),
					s = e("#mCSB_" + o.idx + "_container");
				n.advanced.releaseDraggableSelectors && l.add(e(n.advanced.releaseDraggableSelectors)), n.advanced.extraDraggableSelectors && l.add(e(n.advanced.extraDraggableSelectors)), o.bindEvents && (e(document).add(e(!A() || top.document)).unbind("." + i), l.each(function() {
					e(this).unbind("." + i)
				}), clearTimeout(t[0]._focusTimeout), $(t[0], "_focusTimeout"), clearTimeout(o.sequential.step), $(o.sequential, "step"), clearTimeout(s[0].onCompleteTimeout), $(s[0], "onCompleteTimeout"), o.bindEvents = !1)
			},
			M = function(t) {
				var o = e(this),
					n = o.data(a),
					i = n.opt,
					r = e("#mCSB_" + n.idx + "_container_wrapper"),
					l = r.length ? r : e("#mCSB_" + n.idx + "_container"),
					s = [e("#mCSB_" + n.idx + "_scrollbar_vertical"), e("#mCSB_" + n.idx + "_scrollbar_horizontal")],
					c = [s[0].find(".mCSB_dragger"), s[1].find(".mCSB_dragger")];
				"x" !== i.axis && (n.overflowed[0] && !t ? (s[0].add(c[0]).add(s[0].children("a")).css("display", "block"), l.removeClass(d[8] + " " + d[10])) : (i.alwaysShowScrollbar ? (2 !== i.alwaysShowScrollbar && c[0].css("display", "none"), l.removeClass(d[10])) : (s[0].css("display", "none"), l.addClass(d[10])), l.addClass(d[8]))), "y" !== i.axis && (n.overflowed[1] && !t ? (s[1].add(c[1]).add(s[1].children("a")).css("display", "block"), l.removeClass(d[9] + " " + d[11])) : (i.alwaysShowScrollbar ? (2 !== i.alwaysShowScrollbar && c[1].css("display", "none"), l.removeClass(d[11])) : (s[1].css("display", "none"), l.addClass(d[11])), l.addClass(d[9]))), n.overflowed[0] || n.overflowed[1] ? o.removeClass(d[5]) : o.addClass(d[5])
			},
			O = function(t) {
				var o = t.type,
					a = t.target.ownerDocument !== document && null !== frameElement ? [e(frameElement).offset().top, e(frameElement).offset().left] : null,
					n = A() && t.target.ownerDocument !== top.document && null !== frameElement ? [e(t.view.frameElement).offset().top, e(t.view.frameElement).offset().left] : [0, 0];
				switch(o) {
					case "pointerdown":
					case "MSPointerDown":
					case "pointermove":
					case "MSPointerMove":
					case "pointerup":
					case "MSPointerUp":
						return a ? [t.originalEvent.pageY - a[0] + n[0], t.originalEvent.pageX - a[1] + n[1], !1] : [t.originalEvent.pageY, t.originalEvent.pageX, !1];
					case "touchstart":
					case "touchmove":
					case "touchend":
						var i = t.originalEvent.touches[0] || t.originalEvent.changedTouches[0],
							r = t.originalEvent.touches.length || t.originalEvent.changedTouches.length;
						return t.target.ownerDocument !== document ? [i.screenY, i.screenX, r > 1] : [i.pageY, i.pageX, r > 1];
					default:
						return a ? [t.pageY - a[0] + n[0], t.pageX - a[1] + n[1], !1] : [t.pageY, t.pageX, !1]
				}
			},
			I = function() {
				function t(e, t, a, n) {
					if(h[0].idleTimer = d.scrollInertia < 233 ? 250 : 0, o.attr("id") === f[1]) var i = "x",
						s = (o[0].offsetLeft - t + n) * l.scrollRatio.x;
					else var i = "y",
						s = (o[0].offsetTop - e + a) * l.scrollRatio.y;
					G(r, s.toString(), {
						dir: i,
						drag: !0
					})
				}
				var o, n, i, r = e(this),
					l = r.data(a),
					d = l.opt,
					u = a + "_" + l.idx,
					f = ["mCSB_" + l.idx + "_dragger_vertical", "mCSB_" + l.idx + "_dragger_horizontal"],
					h = e("#mCSB_" + l.idx + "_container"),
					m = e("#" + f[0] + ",#" + f[1]),
					p = d.advanced.releaseDraggableSelectors ? m.add(e(d.advanced.releaseDraggableSelectors)) : m,
					g = d.advanced.extraDraggableSelectors ? e(!A() || top.document).add(e(d.advanced.extraDraggableSelectors)) : e(!A() || top.document);
				m.bind("contextmenu." + u, function(e) {
					e.preventDefault()
				}).bind("mousedown." + u + " touchstart." + u + " pointerdown." + u + " MSPointerDown." + u, function(t) {
					if(t.stopImmediatePropagation(), t.preventDefault(), ee(t)) {
						c = !0, s && (document.onselectstart = function() {
							return !1
						}), L.call(h, !1), Q(r), o = e(this);
						var a = o.offset(),
							l = O(t)[0] - a.top,
							u = O(t)[1] - a.left,
							f = o.height() + a.top,
							m = o.width() + a.left;
						f > l && l > 0 && m > u && u > 0 && (n = l, i = u), C(o, "active", d.autoExpandScrollbar)
					}
				}).bind("touchmove." + u, function(e) {
					e.stopImmediatePropagation(), e.preventDefault();
					var a = o.offset(),
						r = O(e)[0] - a.top,
						l = O(e)[1] - a.left;
					t(n, i, r, l)
				}), e(document).add(g).bind("mousemove." + u + " pointermove." + u + " MSPointerMove." + u, function(e) {
					if(o) {
						var a = o.offset(),
							r = O(e)[0] - a.top,
							l = O(e)[1] - a.left;
						if(n === r && i === l) return;
						t(n, i, r, l)
					}
				}).add(p).bind("mouseup." + u + " touchend." + u + " pointerup." + u + " MSPointerUp." + u, function() {
					o && (C(o, "active", d.autoExpandScrollbar), o = null), c = !1, s && (document.onselectstart = null), L.call(h, !0)
				})
			},
			D = function() {
				function o(e) {
					if(!te(e) || c || O(e)[2]) return void(t = 0);
					t = 1, b = 0, C = 0, d = 1, y.removeClass("mCS_touch_action");
					var o = I.offset();
					u = O(e)[0] - o.top, f = O(e)[1] - o.left, z = [O(e)[0], O(e)[1]]
				}

				function n(e) {
					if(te(e) && !c && !O(e)[2] && (T.documentTouchScroll || e.preventDefault(), e.stopImmediatePropagation(), (!C || b) && d)) {
						g = K();
						var t = M.offset(),
							o = O(e)[0] - t.top,
							a = O(e)[1] - t.left,
							n = "mcsLinearOut";
						if(E.push(o), W.push(a), z[2] = Math.abs(O(e)[0] - z[0]), z[3] = Math.abs(O(e)[1] - z[1]), B.overflowed[0]) var i = D[0].parent().height() - D[0].height(),
							r = u - o > 0 && o - u > -(i * B.scrollRatio.y) && (2 * z[3] < z[2] || "yx" === T.axis);
						if(B.overflowed[1]) var l = D[1].parent().width() - D[1].width(),
							h = f - a > 0 && a - f > -(l * B.scrollRatio.x) && (2 * z[2] < z[3] || "yx" === T.axis);
						r || h ? (U || e.preventDefault(), b = 1) : (C = 1, y.addClass("mCS_touch_action")), U && e.preventDefault(), w = "yx" === T.axis ? [u - o, f - a] : "x" === T.axis ? [null, f - a] : [u - o, null], I[0].idleTimer = 250, B.overflowed[0] && s(w[0], R, n, "y", "all", !0), B.overflowed[1] && s(w[1], R, n, "x", L, !0)
					}
				}

				function i(e) {
					if(!te(e) || c || O(e)[2]) return void(t = 0);
					t = 1, e.stopImmediatePropagation(), Q(y), p = K();
					var o = M.offset();
					h = O(e)[0] - o.top, m = O(e)[1] - o.left, E = [], W = []
				}

				function r(e) {
					if(te(e) && !c && !O(e)[2]) {
						d = 0, e.stopImmediatePropagation(), b = 0, C = 0, v = K();
						var t = M.offset(),
							o = O(e)[0] - t.top,
							a = O(e)[1] - t.left;
						if(!(v - g > 30)) {
							_ = 1e3 / (v - p);
							var n = "mcsEaseOut",
								i = 2.5 > _,
								r = i ? [E[E.length - 2], W[W.length - 2]] : [0, 0];
							x = i ? [o - r[0], a - r[1]] : [o - h, a - m];
							var u = [Math.abs(x[0]), Math.abs(x[1])];
							_ = i ? [Math.abs(x[0] / 4), Math.abs(x[1] / 4)] : [_, _];
							var f = [Math.abs(I[0].offsetTop) - x[0] * l(u[0] / _[0], _[0]), Math.abs(I[0].offsetLeft) - x[1] * l(u[1] / _[1], _[1])];
							w = "yx" === T.axis ? [f[0], f[1]] : "x" === T.axis ? [null, f[1]] : [f[0], null], S = [4 * u[0] + T.scrollInertia, 4 * u[1] + T.scrollInertia];
							var y = parseInt(T.contentTouchScroll) || 0;
							w[0] = u[0] > y ? w[0] : 0, w[1] = u[1] > y ? w[1] : 0, B.overflowed[0] && s(w[0], S[0], n, "y", L, !1), B.overflowed[1] && s(w[1], S[1], n, "x", L, !1)
						}
					}
				}

				function l(e, t) {
					var o = [1.5 * t, 2 * t, t / 1.5, t / 2];
					return e > 90 ? t > 4 ? o[0] : o[3] : e > 60 ? t > 3 ? o[3] : o[2] : e > 30 ? t > 8 ? o[1] : t > 6 ? o[0] : t > 4 ? t : o[2] : t > 8 ? t : o[3]
				}

				function s(e, t, o, a, n, i) {
					e && G(y, e.toString(), {
						dur: t,
						scrollEasing: o,
						dir: a,
						overwrite: n,
						drag: i
					})
				}
				var d, u, f, h, m, p, g, v, x, _, w, S, b, C, y = e(this),
					B = y.data(a),
					T = B.opt,
					k = a + "_" + B.idx,
					M = e("#mCSB_" + B.idx),
					I = e("#mCSB_" + B.idx + "_container"),
					D = [e("#mCSB_" + B.idx + "_dragger_vertical"), e("#mCSB_" + B.idx + "_dragger_horizontal")],
					E = [],
					W = [],
					R = 0,
					L = "yx" === T.axis ? "none" : "all",
					z = [],
					P = I.find("iframe"),
					H = ["touchstart." + k + " pointerdown." + k + " MSPointerDown." + k, "touchmove." + k + " pointermove." + k + " MSPointerMove." + k, "touchend." + k + " pointerup." + k + " MSPointerUp." + k],
					U = void 0 !== document.body.style.touchAction && "" !== document.body.style.touchAction;
				I.bind(H[0], function(e) {
					o(e)
				}).bind(H[1], function(e) {
					n(e)
				}), M.bind(H[0], function(e) {
					i(e)
				}).bind(H[2], function(e) {
					r(e)
				}), P.length && P.each(function() {
					e(this).bind("load", function() {
						A(this) && e(this.contentDocument || this.contentWindow.document).bind(H[0], function(e) {
							o(e), i(e)
						}).bind(H[1], function(e) {
							n(e)
						}).bind(H[2], function(e) {
							r(e)
						})
					})
				})
			},
			E = function() {
				function o() {
					return window.getSelection ? window.getSelection().toString() : document.selection && "Control" != document.selection.type ? document.selection.createRange().text : 0
				}

				function n(e, t, o) {
					d.type = o && i ? "stepped" : "stepless", d.scrollAmount = 10, j(r, e, t, "mcsLinearOut", o ? 60 : null)
				}
				var i, r = e(this),
					l = r.data(a),
					s = l.opt,
					d = l.sequential,
					u = a + "_" + l.idx,
					f = e("#mCSB_" + l.idx + "_container"),
					h = f.parent();
				f.bind("mousedown." + u, function() {
					t || i || (i = 1, c = !0)
				}).add(document).bind("mousemove." + u, function(e) {
					if(!t && i && o()) {
						var a = f.offset(),
							r = O(e)[0] - a.top + f[0].offsetTop,
							c = O(e)[1] - a.left + f[0].offsetLeft;
						r > 0 && r < h.height() && c > 0 && c < h.width() ? d.step && n("off", null, "stepped") : ("x" !== s.axis && l.overflowed[0] && (0 > r ? n("on", 38) : r > h.height() && n("on", 40)), "y" !== s.axis && l.overflowed[1] && (0 > c ? n("on", 37) : c > h.width() && n("on", 39)))
					}
				}).bind("mouseup." + u + " dragend." + u, function() {
					t || (i && (i = 0, n("off", null)), c = !1)
				})
			},
			W = function() {
				function t(t, a) {
					if(Q(o), !z(o, t.target)) {
						var r = "auto" !== i.mouseWheel.deltaFactor ? parseInt(i.mouseWheel.deltaFactor) : s && t.deltaFactor < 100 ? 100 : t.deltaFactor || 100,
							d = i.scrollInertia;
						if("x" === i.axis || "x" === i.mouseWheel.axis) var u = "x",
							f = [Math.round(r * n.scrollRatio.x), parseInt(i.mouseWheel.scrollAmount)],
							h = "auto" !== i.mouseWheel.scrollAmount ? f[1] : f[0] >= l.width() ? .9 * l.width() : f[0],
							m = Math.abs(e("#mCSB_" + n.idx + "_container")[0].offsetLeft),
							p = c[1][0].offsetLeft,
							g = c[1].parent().width() - c[1].width(),
							v = "y" === i.mouseWheel.axis ? t.deltaY || a : t.deltaX;
						else var u = "y",
							f = [Math.round(r * n.scrollRatio.y), parseInt(i.mouseWheel.scrollAmount)],
							h = "auto" !== i.mouseWheel.scrollAmount ? f[1] : f[0] >= l.height() ? .9 * l.height() : f[0],
							m = Math.abs(e("#mCSB_" + n.idx + "_container")[0].offsetTop),
							p = c[0][0].offsetTop,
							g = c[0].parent().height() - c[0].height(),
							v = t.deltaY || a;
						"y" === u && !n.overflowed[0] || "x" === u && !n.overflowed[1] || ((i.mouseWheel.invert || t.webkitDirectionInvertedFromDevice) && (v = -v), i.mouseWheel.normalizeDelta && (v = 0 > v ? -1 : 1), (v > 0 && 0 !== p || 0 > v && p !== g || i.mouseWheel.preventDefault) && (t.stopImmediatePropagation(), t.preventDefault()), t.deltaFactor < 5 && !i.mouseWheel.normalizeDelta && (h = t.deltaFactor, d = 17), G(o, (m - v * h).toString(), {
							dir: u,
							dur: d
						}))
					}
				}
				if(e(this).data(a)) {
					var o = e(this),
						n = o.data(a),
						i = n.opt,
						r = a + "_" + n.idx,
						l = e("#mCSB_" + n.idx),
						c = [e("#mCSB_" + n.idx + "_dragger_vertical"), e("#mCSB_" + n.idx + "_dragger_horizontal")],
						d = e("#mCSB_" + n.idx + "_container").find("iframe");
					d.length && d.each(function() {
						e(this).bind("load", function() {
							A(this) && e(this.contentDocument || this.contentWindow.document).bind("mousewheel." + r, function(e, o) {
								t(e, o)
							})
						})
					}), l.bind("mousewheel." + r, function(e, o) {
						t(e, o)
					})
				}
			},
			R = new Object,
			A = function(t) {
				var o = !1,
					a = !1,
					n = null;
				if(void 0 === t ? a = "#empty" : void 0 !== e(t).attr("id") && (a = e(t).attr("id")), a !== !1 && void 0 !== R[a]) return R[a];
				if(t) {
					try {
						var i = t.contentDocument || t.contentWindow.document;
						n = i.body.innerHTML
					} catch(r) {}
					o = null !== n
				} else {
					try {
						var i = top.document;
						n = i.body.innerHTML
					} catch(r) {}
					o = null !== n
				}
				return a !== !1 && (R[a] = o), o
			},
			L = function(e) {
				var t = this.find("iframe");
				if(t.length) {
					var o = e ? "auto" : "none";
					t.css("pointer-events", o)
				}
			},
			z = function(t, o) {
				var n = o.nodeName.toLowerCase(),
					i = t.data(a).opt.mouseWheel.disableOver,
					r = ["select", "textarea"];
				return e.inArray(n, i) > -1 && !(e.inArray(n, r) > -1 && !e(o).is(":focus"))
			},
			P = function() {
				var t, o = e(this),
					n = o.data(a),
					i = a + "_" + n.idx,
					r = e("#mCSB_" + n.idx + "_container"),
					l = r.parent(),
					s = e(".mCSB_" + n.idx + "_scrollbar ." + d[12]);
				s.bind("mousedown." + i + " touchstart." + i + " pointerdown." + i + " MSPointerDown." + i, function(o) {
					c = !0, e(o.target).hasClass("mCSB_dragger") || (t = 1)
				}).bind("touchend." + i + " pointerup." + i + " MSPointerUp." + i, function() {
					c = !1
				}).bind("click." + i, function(a) {
					if(t && (t = 0, e(a.target).hasClass(d[12]) || e(a.target).hasClass("mCSB_draggerRail"))) {
						Q(o);
						var i = e(this),
							s = i.find(".mCSB_dragger");
						if(i.parent(".mCSB_scrollTools_horizontal").length > 0) {
							if(!n.overflowed[1]) return;
							var c = "x",
								u = a.pageX > s.offset().left ? -1 : 1,
								f = Math.abs(r[0].offsetLeft) - u * (.9 * l.width())
						} else {
							if(!n.overflowed[0]) return;
							var c = "y",
								u = a.pageY > s.offset().top ? -1 : 1,
								f = Math.abs(r[0].offsetTop) - u * (.9 * l.height())
						}
						G(o, f.toString(), {
							dir: c,
							scrollEasing: "mcsEaseInOut"
						})
					}
				})
			},
			H = function() {
				var t = e(this),
					o = t.data(a),
					n = o.opt,
					i = a + "_" + o.idx,
					r = e("#mCSB_" + o.idx + "_container"),
					l = r.parent();
				r.bind("focusin." + i, function() {
					var o = e(document.activeElement),
						a = r.find(".mCustomScrollBox").length,
						i = 0;
					o.is(n.advanced.autoScrollOnFocus) && (Q(t), clearTimeout(t[0]._focusTimeout), t[0]._focusTimer = a ? (i + 17) * a : 0, t[0]._focusTimeout = setTimeout(function() {
						var e = [ae(o)[0], ae(o)[1]],
							a = [r[0].offsetTop, r[0].offsetLeft],
							s = [a[0] + e[0] >= 0 && a[0] + e[0] < l.height() - o.outerHeight(!1), a[1] + e[1] >= 0 && a[0] + e[1] < l.width() - o.outerWidth(!1)],
							c = "yx" !== n.axis || s[0] || s[1] ? "all" : "none";
						"x" === n.axis || s[0] || G(t, e[0].toString(), {
							dir: "y",
							scrollEasing: "mcsEaseInOut",
							overwrite: c,
							dur: i
						}), "y" === n.axis || s[1] || G(t, e[1].toString(), {
							dir: "x",
							scrollEasing: "mcsEaseInOut",
							overwrite: c,
							dur: i
						})
					}, t[0]._focusTimer))
				})
			},
			U = function() {
				var t = e(this),
					o = t.data(a),
					n = a + "_" + o.idx,
					i = e("#mCSB_" + o.idx + "_container").parent();
				i.bind("scroll." + n, function() {
					0 === i.scrollTop() && 0 === i.scrollLeft() || e(".mCSB_" + o.idx + "_scrollbar").css("visibility", "hidden")
				})
			},
			F = function() {
				var t = e(this),
					o = t.data(a),
					n = o.opt,
					i = o.sequential,
					r = a + "_" + o.idx,
					l = ".mCSB_" + o.idx + "_scrollbar",
					s = e(l + ">a");
				s.bind("contextmenu." + r, function(e) {
					e.preventDefault()
				}).bind("mousedown." + r + " touchstart." + r + " pointerdown." + r + " MSPointerDown." + r + " mouseup." + r + " touchend." + r + " pointerup." + r + " MSPointerUp." + r + " mouseout." + r + " pointerout." + r + " MSPointerOut." + r + " click." + r, function(a) {
					function r(e, o) {
						i.scrollAmount = n.scrollButtons.scrollAmount, j(t, e, o)
					}
					if(a.preventDefault(), ee(a)) {
						var l = e(this).attr("class");
						switch(i.type = n.scrollButtons.scrollType, a.type) {
							case "mousedown":
							case "touchstart":
							case "pointerdown":
							case "MSPointerDown":
								if("stepped" === i.type) return;
								c = !0, o.tweenRunning = !1, r("on", l);
								break;
							case "mouseup":
							case "touchend":
							case "pointerup":
							case "MSPointerUp":
							case "mouseout":
							case "pointerout":
							case "MSPointerOut":
								if("stepped" === i.type) return;
								c = !1, i.dir && r("off", l);
								break;
							case "click":
								if("stepped" !== i.type || o.tweenRunning) return;
								r("on", l)
						}
					}
				})
			},
			q = function() {
				function t(t) {
					function a(e, t) {
						r.type = i.keyboard.scrollType, r.scrollAmount = i.keyboard.scrollAmount, "stepped" === r.type && n.tweenRunning || j(o, e, t)
					}
					switch(t.type) {
						case "blur":
							n.tweenRunning && r.dir && a("off", null);
							break;
						case "keydown":
						case "keyup":
							var l = t.keyCode ? t.keyCode : t.which,
								s = "on";
							if("x" !== i.axis && (38 === l || 40 === l) || "y" !== i.axis && (37 === l || 39 === l)) {
								if((38 === l || 40 === l) && !n.overflowed[0] || (37 === l || 39 === l) && !n.overflowed[1]) return;
								"keyup" === t.type && (s = "off"), e(document.activeElement).is(u) || (t.preventDefault(), t.stopImmediatePropagation(), a(s, l))
							} else if(33 === l || 34 === l) {
								if((n.overflowed[0] || n.overflowed[1]) && (t.preventDefault(), t.stopImmediatePropagation()), "keyup" === t.type) {
									Q(o);
									var f = 34 === l ? -1 : 1;
									if("x" === i.axis || "yx" === i.axis && n.overflowed[1] && !n.overflowed[0]) var h = "x",
										m = Math.abs(c[0].offsetLeft) - f * (.9 * d.width());
									else var h = "y",
										m = Math.abs(c[0].offsetTop) - f * (.9 * d.height());
									G(o, m.toString(), {
										dir: h,
										scrollEasing: "mcsEaseInOut"
									})
								}
							} else if((35 === l || 36 === l) && !e(document.activeElement).is(u) && ((n.overflowed[0] || n.overflowed[1]) && (t.preventDefault(), t.stopImmediatePropagation()), "keyup" === t.type)) {
								if("x" === i.axis || "yx" === i.axis && n.overflowed[1] && !n.overflowed[0]) var h = "x",
									m = 35 === l ? Math.abs(d.width() - c.outerWidth(!1)) : 0;
								else var h = "y",
									m = 35 === l ? Math.abs(d.height() - c.outerHeight(!1)) : 0;
								G(o, m.toString(), {
									dir: h,
									scrollEasing: "mcsEaseInOut"
								})
							}
					}
				}
				var o = e(this),
					n = o.data(a),
					i = n.opt,
					r = n.sequential,
					l = a + "_" + n.idx,
					s = e("#mCSB_" + n.idx),
					c = e("#mCSB_" + n.idx + "_container"),
					d = c.parent(),
					u = "input,textarea,select,datalist,keygen,[contenteditable='true']",
					f = c.find("iframe"),
					h = ["blur." + l + " keydown." + l + " keyup." + l];
				f.length && f.each(function() {
					e(this).bind("load", function() {
						A(this) && e(this.contentDocument || this.contentWindow.document).bind(h[0], function(e) {
							t(e)
						})
					})
				}), s.attr("tabindex", "0").bind(h[0], function(e) {
					t(e)
				})
			},
			j = function(t, o, n, i, r) {
				function l(e) {
					u.snapAmount && (f.scrollAmount = u.snapAmount instanceof Array ? "x" === f.dir[0] ? u.snapAmount[1] : u.snapAmount[0] : u.snapAmount);
					var o = "stepped" !== f.type,
						a = r ? r : e ? o ? p / 1.5 : g : 1e3 / 60,
						n = e ? o ? 7.5 : 40 : 2.5,
						s = [Math.abs(h[0].offsetTop), Math.abs(h[0].offsetLeft)],
						d = [c.scrollRatio.y > 10 ? 10 : c.scrollRatio.y, c.scrollRatio.x > 10 ? 10 : c.scrollRatio.x],
						m = "x" === f.dir[0] ? s[1] + f.dir[1] * (d[1] * n) : s[0] + f.dir[1] * (d[0] * n),
						v = "x" === f.dir[0] ? s[1] + f.dir[1] * parseInt(f.scrollAmount) : s[0] + f.dir[1] * parseInt(f.scrollAmount),
						x = "auto" !== f.scrollAmount ? v : m,
						_ = i ? i : e ? o ? "mcsLinearOut" : "mcsEaseInOut" : "mcsLinear",
						w = !!e;
					return e && 17 > a && (x = "x" === f.dir[0] ? s[1] : s[0]), G(t, x.toString(), {
						dir: f.dir[0],
						scrollEasing: _,
						dur: a,
						onComplete: w
					}), e ? void(f.dir = !1) : (clearTimeout(f.step), void(f.step = setTimeout(function() {
						l()
					}, a)))
				}

				function s() {
					clearTimeout(f.step), $(f, "step"), Q(t)
				}
				var c = t.data(a),
					u = c.opt,
					f = c.sequential,
					h = e("#mCSB_" + c.idx + "_container"),
					m = "stepped" === f.type,
					p = u.scrollInertia < 26 ? 26 : u.scrollInertia,
					g = u.scrollInertia < 1 ? 17 : u.scrollInertia;
				switch(o) {
					case "on":
						if(f.dir = [n === d[16] || n === d[15] || 39 === n || 37 === n ? "x" : "y", n === d[13] || n === d[15] || 38 === n || 37 === n ? -1 : 1], Q(t), oe(n) && "stepped" === f.type) return;
						l(m);
						break;
					case "off":
						s(), (m || c.tweenRunning && f.dir) && l(!0)
				}
			},
			Y = function(t) {
				var o = e(this).data(a).opt,
					n = [];
				return "function" == typeof t && (t = t()), t instanceof Array ? n = t.length > 1 ? [t[0], t[1]] : "x" === o.axis ? [null, t[0]] : [t[0], null] : (n[0] = t.y ? t.y : t.x || "x" === o.axis ? null : t, n[1] = t.x ? t.x : t.y || "y" === o.axis ? null : t), "function" == typeof n[0] && (n[0] = n[0]()), "function" == typeof n[1] && (n[1] = n[1]()), n
			},
			X = function(t, o) {
				if(null != t && "undefined" != typeof t) {
					var n = e(this),
						i = n.data(a),
						r = i.opt,
						l = e("#mCSB_" + i.idx + "_container"),
						s = l.parent(),
						c = typeof t;
					o || (o = "x" === r.axis ? "x" : "y");
					var d = "x" === o ? l.outerWidth(!1) - s.width() : l.outerHeight(!1) - s.height(),
						f = "x" === o ? l[0].offsetLeft : l[0].offsetTop,
						h = "x" === o ? "left" : "top";
					switch(c) {
						case "function":
							return t();
						case "object":
							var m = t.jquery ? t : e(t);
							if(!m.length) return;
							return "x" === o ? ae(m)[1] : ae(m)[0];
						case "string":
						case "number":
							if(oe(t)) return Math.abs(t);
							if(-1 !== t.indexOf("%")) return Math.abs(d * parseInt(t) / 100);
							if(-1 !== t.indexOf("-=")) return Math.abs(f - parseInt(t.split("-=")[1]));
							if(-1 !== t.indexOf("+=")) {
								var p = f + parseInt(t.split("+=")[1]);
								return p >= 0 ? 0 : Math.abs(p)
							}
							if(-1 !== t.indexOf("px") && oe(t.split("px")[0])) return Math.abs(t.split("px")[0]);
							if("top" === t || "left" === t) return 0;
							if("bottom" === t) return Math.abs(s.height() - l.outerHeight(!1));
							if("right" === t) return Math.abs(s.width() - l.outerWidth(!1));
							if("first" === t || "last" === t) {
								var m = l.find(":" + t);
								return "x" === o ? ae(m)[1] : ae(m)[0]
							}
							return e(t).length ? "x" === o ? ae(e(t))[1] : ae(e(t))[0] : (l.css(h, t), void u.update.call(null, n[0]))
					}
				}
			},
			N = function(t) {
				function o() {
					return clearTimeout(f[0].autoUpdate), 0 === l.parents("html").length ? void(l = null) : void(f[0].autoUpdate = setTimeout(function() {
						return c.advanced.updateOnSelectorChange && (s.poll.change.n = i(), s.poll.change.n !== s.poll.change.o) ? (s.poll.change.o = s.poll.change.n, void r(3)) : c.advanced.updateOnContentResize && (s.poll.size.n = l[0].scrollHeight + l[0].scrollWidth + f[0].offsetHeight + l[0].offsetHeight + l[0].offsetWidth, s.poll.size.n !== s.poll.size.o) ? (s.poll.size.o = s.poll.size.n, void r(1)) : !c.advanced.updateOnImageLoad || "auto" === c.advanced.updateOnImageLoad && "y" === c.axis || (s.poll.img.n = f.find("img").length, s.poll.img.n === s.poll.img.o) ? void((c.advanced.updateOnSelectorChange || c.advanced.updateOnContentResize || c.advanced.updateOnImageLoad) && o()) : (s.poll.img.o = s.poll.img.n, void f.find("img").each(function() {
							n(this)
						}))
					}, c.advanced.autoUpdateTimeout))
				}

				function n(t) {
					function o(e, t) {
						return function() {
							return t.apply(e, arguments)
						}
					}

					function a() {
						this.onload = null, e(t).addClass(d[2]), r(2)
					}
					if(e(t).hasClass(d[2])) return void r();
					var n = new Image;
					n.onload = o(n, a), n.src = t.src
				}

				function i() {
					c.advanced.updateOnSelectorChange === !0 && (c.advanced.updateOnSelectorChange = "*");
					var e = 0,
						t = f.find(c.advanced.updateOnSelectorChange);
					return c.advanced.updateOnSelectorChange && t.length > 0 && t.each(function() {
						e += this.offsetHeight + this.offsetWidth
					}), e
				}

				function r(e) {
					clearTimeout(f[0].autoUpdate), u.update.call(null, l[0], e)
				}
				var l = e(this),
					s = l.data(a),
					c = s.opt,
					f = e("#mCSB_" + s.idx + "_container");
				return t ? (clearTimeout(f[0].autoUpdate), void $(f[0], "autoUpdate")) : void o()
			},
			V = function(e, t, o) {
				return Math.round(e / t) * t - o
			},
			Q = function(t) {
				var o = t.data(a),
					n = e("#mCSB_" + o.idx + "_container,#mCSB_" + o.idx + "_container_wrapper,#mCSB_" + o.idx + "_dragger_vertical,#mCSB_" + o.idx + "_dragger_horizontal");
				n.each(function() {
					Z.call(this)
				})
			},
			G = function(t, o, n) {
				function i(e) {
					return s && c.callbacks[e] && "function" == typeof c.callbacks[e]
				}

				function r() {
					return [c.callbacks.alwaysTriggerOffsets || w >= S[0] + y, c.callbacks.alwaysTriggerOffsets || -B >= w]
				}

				function l() {
					var e = [h[0].offsetTop, h[0].offsetLeft],
						o = [x[0].offsetTop, x[0].offsetLeft],
						a = [h.outerHeight(!1), h.outerWidth(!1)],
						i = [f.height(), f.width()];
					t[0].mcs = {
						content: h,
						top: e[0],
						left: e[1],
						draggerTop: o[0],
						draggerLeft: o[1],
						topPct: Math.round(100 * Math.abs(e[0]) / (Math.abs(a[0]) - i[0])),
						leftPct: Math.round(100 * Math.abs(e[1]) / (Math.abs(a[1]) - i[1])),
						direction: n.dir
					}
				}
				var s = t.data(a),
					c = s.opt,
					d = {
						trigger: "internal",
						dir: "y",
						scrollEasing: "mcsEaseOut",
						drag: !1,
						dur: c.scrollInertia,
						overwrite: "all",
						callbacks: !0,
						onStart: !0,
						onUpdate: !0,
						onComplete: !0
					},
					n = e.extend(d, n),
					u = [n.dur, n.drag ? 0 : n.dur],
					f = e("#mCSB_" + s.idx),
					h = e("#mCSB_" + s.idx + "_container"),
					m = h.parent(),
					p = c.callbacks.onTotalScrollOffset ? Y.call(t, c.callbacks.onTotalScrollOffset) : [0, 0],
					g = c.callbacks.onTotalScrollBackOffset ? Y.call(t, c.callbacks.onTotalScrollBackOffset) : [0, 0];
				if(s.trigger = n.trigger, 0 === m.scrollTop() && 0 === m.scrollLeft() || (e(".mCSB_" + s.idx + "_scrollbar").css("visibility", "visible"), m.scrollTop(0).scrollLeft(0)), "_resetY" !== o || s.contentReset.y || (i("onOverflowYNone") && c.callbacks.onOverflowYNone.call(t[0]), s.contentReset.y = 1), "_resetX" !== o || s.contentReset.x || (i("onOverflowXNone") && c.callbacks.onOverflowXNone.call(t[0]), s.contentReset.x = 1), "_resetY" !== o && "_resetX" !== o) {
					if(!s.contentReset.y && t[0].mcs || !s.overflowed[0] || (i("onOverflowY") && c.callbacks.onOverflowY.call(t[0]), s.contentReset.x = null), !s.contentReset.x && t[0].mcs || !s.overflowed[1] || (i("onOverflowX") && c.callbacks.onOverflowX.call(t[0]), s.contentReset.x = null), c.snapAmount) {
						var v = c.snapAmount instanceof Array ? "x" === n.dir ? c.snapAmount[1] : c.snapAmount[0] : c.snapAmount;
						o = V(o, v, c.snapOffset)
					}
					switch(n.dir) {
						case "x":
							var x = e("#mCSB_" + s.idx + "_dragger_horizontal"),
								_ = "left",
								w = h[0].offsetLeft,
								S = [f.width() - h.outerWidth(!1), x.parent().width() - x.width()],
								b = [o, 0 === o ? 0 : o / s.scrollRatio.x],
								y = p[1],
								B = g[1],
								T = y > 0 ? y / s.scrollRatio.x : 0,
								k = B > 0 ? B / s.scrollRatio.x : 0;
							break;
						case "y":
							var x = e("#mCSB_" + s.idx + "_dragger_vertical"),
								_ = "top",
								w = h[0].offsetTop,
								S = [f.height() - h.outerHeight(!1), x.parent().height() - x.height()],
								b = [o, 0 === o ? 0 : o / s.scrollRatio.y],
								y = p[0],
								B = g[0],
								T = y > 0 ? y / s.scrollRatio.y : 0,
								k = B > 0 ? B / s.scrollRatio.y : 0
					}
					b[1] < 0 || 0 === b[0] && 0 === b[1] ? b = [0, 0] : b[1] >= S[1] ? b = [S[0], S[1]] : b[0] = -b[0], t[0].mcs || (l(), i("onInit") && c.callbacks.onInit.call(t[0])), clearTimeout(h[0].onCompleteTimeout), J(x[0], _, Math.round(b[1]), u[1], n.scrollEasing), !s.tweenRunning && (0 === w && b[0] >= 0 || w === S[0] && b[0] <= S[0]) || J(h[0], _, Math.round(b[0]), u[0], n.scrollEasing, n.overwrite, {
						onStart: function() {
							n.callbacks && n.onStart && !s.tweenRunning && (i("onScrollStart") && (l(), c.callbacks.onScrollStart.call(t[0])), s.tweenRunning = !0, C(x), s.cbOffsets = r())
						},
						onUpdate: function() {
							n.callbacks && n.onUpdate && i("whileScrolling") && (l(), c.callbacks.whileScrolling.call(t[0]))
						},
						onComplete: function() {
							if(n.callbacks && n.onComplete) {
								"yx" === c.axis && clearTimeout(h[0].onCompleteTimeout);
								var e = h[0].idleTimer || 0;
								h[0].onCompleteTimeout = setTimeout(function() {
									i("onScroll") && (l(), c.callbacks.onScroll.call(t[0])), i("onTotalScroll") && b[1] >= S[1] - T && s.cbOffsets[0] && (l(), c.callbacks.onTotalScroll.call(t[0])), i("onTotalScrollBack") && b[1] <= k && s.cbOffsets[1] && (l(), c.callbacks.onTotalScrollBack.call(t[0])), s.tweenRunning = !1, h[0].idleTimer = 0, C(x, "hide")
								}, e)
							}
						}
					})
				}
			},
			J = function(e, t, o, a, n, i, r) {
				function l() {
					S.stop || (x || m.call(), x = K() - v, s(), x >= S.time && (S.time = x > S.time ? x + f - (x - S.time) : x + f - 1, S.time < x + 1 && (S.time = x + 1)), S.time < a ? S.id = h(l) : g.call())
				}

				function s() {
					a > 0 ? (S.currVal = u(S.time, _, b, a, n), w[t] = Math.round(S.currVal) + "px") : w[t] = o + "px", p.call()
				}

				function c() {
					f = 1e3 / 60, S.time = x + f, h = window.requestAnimationFrame ? window.requestAnimationFrame : function(e) {
						return s(), setTimeout(e, .01)
					}, S.id = h(l)
				}

				function d() {
					null != S.id && (window.requestAnimationFrame ? window.cancelAnimationFrame(S.id) : clearTimeout(S.id), S.id = null)
				}

				function u(e, t, o, a, n) {
					switch(n) {
						case "linear":
						case "mcsLinear":
							return o * e / a + t;
						case "mcsLinearOut":
							return e /= a, e--, o * Math.sqrt(1 - e * e) + t;
						case "easeInOutSmooth":
							return e /= a / 2, 1 > e ? o / 2 * e * e + t : (e--, -o / 2 * (e * (e - 2) - 1) + t);
						case "easeInOutStrong":
							return e /= a / 2, 1 > e ? o / 2 * Math.pow(2, 10 * (e - 1)) + t : (e--, o / 2 * (-Math.pow(2, -10 * e) + 2) + t);
						case "easeInOut":
						case "mcsEaseInOut":
							return e /= a / 2, 1 > e ? o / 2 * e * e * e + t : (e -= 2, o / 2 * (e * e * e + 2) + t);
						case "easeOutSmooth":
							return e /= a, e--, -o * (e * e * e * e - 1) + t;
						case "easeOutStrong":
							return o * (-Math.pow(2, -10 * e / a) + 1) + t;
						case "easeOut":
						case "mcsEaseOut":
						default:
							var i = (e /= a) * e,
								r = i * e;
							return t + o * (.499999999999997 * r * i + -2.5 * i * i + 5.5 * r + -6.5 * i + 4 * e)
					}
				}
				e._mTween || (e._mTween = {
					top: {},
					left: {}
				});
				var f, h, r = r || {},
					m = r.onStart || function() {},
					p = r.onUpdate || function() {},
					g = r.onComplete || function() {},
					v = K(),
					x = 0,
					_ = e.offsetTop,
					w = e.style,
					S = e._mTween[t];
				"left" === t && (_ = e.offsetLeft);
				var b = o - _;
				S.stop = 0, "none" !== i && d(), c()
			},
			K = function() {
				return window.performance && window.performance.now ? window.performance.now() : window.performance && window.performance.webkitNow ? window.performance.webkitNow() : Date.now ? Date.now() : (new Date).getTime()
			},
			Z = function() {
				var e = this;
				e._mTween || (e._mTween = {
					top: {},
					left: {}
				});
				for(var t = ["top", "left"], o = 0; o < t.length; o++) {
					var a = t[o];
					e._mTween[a].id && (window.requestAnimationFrame ? window.cancelAnimationFrame(e._mTween[a].id) : clearTimeout(e._mTween[a].id), e._mTween[a].id = null, e._mTween[a].stop = 1)
				}
			},
			$ = function(e, t) {
				try {
					delete e[t]
				} catch(o) {
					e[t] = null
				}
			},
			ee = function(e) {
				return !(e.which && 1 !== e.which)
			},
			te = function(e) {
				var t = e.originalEvent.pointerType;
				return !(t && "touch" !== t && 2 !== t)
			},
			oe = function(e) {
				return !isNaN(parseFloat(e)) && isFinite(e)
			},
			ae = function(e) {
				var t = e.parents(".mCSB_container");
				return [e.offset().top - t.offset().top, e.offset().left - t.offset().left]
			},
			ne = function() {
				function e() {
					var e = ["webkit", "moz", "ms", "o"];
					if("hidden" in document) return "hidden";
					for(var t = 0; t < e.length; t++)
						if(e[t] + "Hidden" in document) return e[t] + "Hidden";
					return null
				}
				var t = e();
				return t ? document[t] : !1
			};
		e.fn[o] = function(t) {
			return u[t] ? u[t].apply(this, Array.prototype.slice.call(arguments, 1)) : "object" != typeof t && t ? void e.error("Method " + t + " does not exist") : u.init.apply(this, arguments)
		}, e[o] = function(t) {
			return u[t] ? u[t].apply(this, Array.prototype.slice.call(arguments, 1)) : "object" != typeof t && t ? void e.error("Method " + t + " does not exist") : u.init.apply(this, arguments)
		}, e[o].defaults = i, window[o] = !0, e(window).bind("load", function() {
			e(n)[o](), e.extend(e.expr[":"], {
				mcsInView: e.expr[":"].mcsInView || function(t) {
					var o, a, n = e(t),
						i = n.parents(".mCSB_container");
					if(i.length) return o = i.parent(), a = [i[0].offsetTop, i[0].offsetLeft], a[0] + ae(n)[0] >= 0 && a[0] + ae(n)[0] < o.height() - n.outerHeight(!1) && a[1] + ae(n)[1] >= 0 && a[1] + ae(n)[1] < o.width() - n.outerWidth(!1)
				},
				mcsInSight: e.expr[":"].mcsInSight || function(t, o, a) {
					var n, i, r, l, s = e(t),
						c = s.parents(".mCSB_container"),
						d = "exact" === a[3] ? [
							[1, 0],
							[1, 0]
						] : [
							[.9, .1],
							[.6, .4]
						];
					if(c.length) return n = [s.outerHeight(!1), s.outerWidth(!1)], r = [c[0].offsetTop + ae(s)[0], c[0].offsetLeft + ae(s)[1]], i = [c.parent()[0].offsetHeight, c.parent()[0].offsetWidth], l = [n[0] < i[0] ? d[0] : d[1], n[1] < i[1] ? d[0] : d[1]], r[0] - i[0] * l[0][0] < 0 && r[0] + n[0] - i[0] * l[0][1] >= 0 && r[1] - i[1] * l[1][0] < 0 && r[1] + n[1] - i[1] * l[1][1] >= 0
				},
				mcsOverflow: e.expr[":"].mcsOverflow || function(t) {
					var o = e(t).data(a);
					if(o) return o.overflowed[0] || o.overflowed[1]
				}
			})
		})
	})
});

/*!
 * imagesLoaded PACKAGED v4.1.1
 * JavaScript is all like "You images are done yet or what?"
 * MIT License
 */

! function(t, e) {
	"function" == typeof define && define.amd ? define("ev-emitter/ev-emitter", e) : "object" == typeof module && module.exports ? module.exports = e() : t.EvEmitter = e()
}("undefined" != typeof window ? window : this, function() {
	function t() {}
	var e = t.prototype;
	return e.on = function(t, e) {
		if(t && e) {
			var i = this._events = this._events || {},
				n = i[t] = i[t] || [];
			return -1 == n.indexOf(e) && n.push(e), this
		}
	}, e.once = function(t, e) {
		if(t && e) {
			this.on(t, e);
			var i = this._onceEvents = this._onceEvents || {},
				n = i[t] = i[t] || {};
			return n[e] = !0, this
		}
	}, e.off = function(t, e) {
		var i = this._events && this._events[t];
		if(i && i.length) {
			var n = i.indexOf(e);
			return -1 != n && i.splice(n, 1), this
		}
	}, e.emitEvent = function(t, e) {
		var i = this._events && this._events[t];
		if(i && i.length) {
			var n = 0,
				o = i[n];
			e = e || [];
			for(var r = this._onceEvents && this._onceEvents[t]; o;) {
				var s = r && r[o];
				s && (this.off(t, o), delete r[o]), o.apply(this, e), n += s ? 0 : 1, o = i[n]
			}
			return this
		}
	}, t
}),
function(t, e) {
	"use strict";
	"function" == typeof define && define.amd ? define(["ev-emitter/ev-emitter"], function(i) {
		return e(t, i)
	}) : "object" == typeof module && module.exports ? module.exports = e(t, require("ev-emitter")) : t.imagesLoaded = e(t, t.EvEmitter)
}(window, function(t, e) {
	function i(t, e) {
		for(var i in e) t[i] = e[i];
		return t
	}

	function n(t) {
		var e = [];
		if(Array.isArray(t)) e = t;
		else if("number" == typeof t.length)
			for(var i = 0; i < t.length; i++) e.push(t[i]);
		else e.push(t);
		return e
	}

	function o(t, e, r) {
		return this instanceof o ? ("string" == typeof t && (t = document.querySelectorAll(t)), this.elements = n(t), this.options = i({}, this.options), "function" == typeof e ? r = e : i(this.options, e), r && this.on("always", r), this.getImages(), h && (this.jqDeferred = new h.Deferred), void setTimeout(function() {
			this.check()
		}.bind(this))) : new o(t, e, r)
	}

	function r(t) {
		this.img = t
	}

	function s(t, e) {
		this.url = t, this.element = e, this.img = new Image
	}
	var h = t.jQuery,
		a = t.console;
	o.prototype = Object.create(e.prototype), o.prototype.options = {}, o.prototype.getImages = function() {
		this.images = [], this.elements.forEach(this.addElementImages, this)
	}, o.prototype.addElementImages = function(t) {
		"IMG" == t.nodeName && this.addImage(t), this.options.background === !0 && this.addElementBackgroundImages(t);
		var e = t.nodeType;
		if(e && d[e]) {
			for(var i = t.querySelectorAll("img"), n = 0; n < i.length; n++) {
				var o = i[n];
				this.addImage(o)
			}
			if("string" == typeof this.options.background) {
				var r = t.querySelectorAll(this.options.background);
				for(n = 0; n < r.length; n++) {
					var s = r[n];
					this.addElementBackgroundImages(s)
				}
			}
		}
	};
	var d = {
		1: !0,
		9: !0,
		11: !0
	};
	return o.prototype.addElementBackgroundImages = function(t) {
		var e = getComputedStyle(t);
		if(e)
			for(var i = /url\((['"])?(.*?)\1\)/gi, n = i.exec(e.backgroundImage); null !== n;) {
				var o = n && n[2];
				o && this.addBackground(o, t), n = i.exec(e.backgroundImage)
			}
	}, o.prototype.addImage = function(t) {
		var e = new r(t);
		this.images.push(e)
	}, o.prototype.addBackground = function(t, e) {
		var i = new s(t, e);
		this.images.push(i)
	}, o.prototype.check = function() {
		function t(t, i, n) {
			setTimeout(function() {
				e.progress(t, i, n)
			})
		}
		var e = this;
		return this.progressedCount = 0, this.hasAnyBroken = !1, this.images.length ? void this.images.forEach(function(e) {
			e.once("progress", t), e.check()
		}) : void this.complete()
	}, o.prototype.progress = function(t, e, i) {
		this.progressedCount++, this.hasAnyBroken = this.hasAnyBroken || !t.isLoaded, this.emitEvent("progress", [this, t, e]), this.jqDeferred && this.jqDeferred.notify && this.jqDeferred.notify(this, t), this.progressedCount == this.images.length && this.complete(), this.options.debug && a && a.log("progress: " + i, t, e)
	}, o.prototype.complete = function() {
		var t = this.hasAnyBroken ? "fail" : "done";
		if(this.isComplete = !0, this.emitEvent(t, [this]), this.emitEvent("always", [this]), this.jqDeferred) {
			var e = this.hasAnyBroken ? "reject" : "resolve";
			this.jqDeferred[e](this)
		}
	}, r.prototype = Object.create(e.prototype), r.prototype.check = function() {
		var t = this.getIsImageComplete();
		return t ? void this.confirm(0 !== this.img.naturalWidth, "naturalWidth") : (this.proxyImage = new Image, this.proxyImage.addEventListener("load", this), this.proxyImage.addEventListener("error", this), this.img.addEventListener("load", this), this.img.addEventListener("error", this), void(this.proxyImage.src = this.img.src))
	}, r.prototype.getIsImageComplete = function() {
		return this.img.complete && void 0 !== this.img.naturalWidth
	}, r.prototype.confirm = function(t, e) {
		this.isLoaded = t, this.emitEvent("progress", [this, this.img, e])
	}, r.prototype.handleEvent = function(t) {
		var e = "on" + t.type;
		this[e] && this[e](t)
	}, r.prototype.onload = function() {
		this.confirm(!0, "onload"), this.unbindEvents()
	}, r.prototype.onerror = function() {
		this.confirm(!1, "onerror"), this.unbindEvents()
	}, r.prototype.unbindEvents = function() {
		this.proxyImage.removeEventListener("load", this), this.proxyImage.removeEventListener("error", this), this.img.removeEventListener("load", this), this.img.removeEventListener("error", this)
	}, s.prototype = Object.create(r.prototype), s.prototype.check = function() {
		this.img.addEventListener("load", this), this.img.addEventListener("error", this), this.img.src = this.url;
		var t = this.getIsImageComplete();
		t && (this.confirm(0 !== this.img.naturalWidth, "naturalWidth"), this.unbindEvents())
	}, s.prototype.unbindEvents = function() {
		this.img.removeEventListener("load", this), this.img.removeEventListener("error", this)
	}, s.prototype.confirm = function(t, e) {
		this.isLoaded = t, this.emitEvent("progress", [this, this.element, e])
	}, o.makeJQueryPlugin = function(e) {
		e = e || t.jQuery, e && (h = e, h.fn.imagesLoaded = function(t, e) {
			var i = new o(this, t, e);
			return i.jqDeferred.promise(h(this))
		})
	}, o.makeJQueryPlugin(), o
});

/*!
 * Masonry PACKAGED v4.1.1
 * Cascading grid layout library
 * http://masonry.desandro.com
 * MIT License
 * by David DeSandro
 */

! function(t, e) {
	"function" == typeof define && define.amd ? define("jquery-bridget/jquery-bridget", ["jquery"], function(i) {
		return e(t, i)
	}) : "object" == typeof module && module.exports ? module.exports = e(t, require("jquery")) : t.jQueryBridget = e(t, t.jQuery)
}(window, function(t, e) {
	"use strict";

	function i(i, r, a) {
		function h(t, e, n) {
			var o, r = "$()." + i + '("' + e + '")';
			return t.each(function(t, h) {
				var u = a.data(h, i);
				if(!u) return void s(i + " not initialized. Cannot call methods, i.e. " + r);
				var d = u[e];
				if(!d || "_" == e.charAt(0)) return void s(r + " is not a valid method");
				var l = d.apply(u, n);
				o = void 0 === o ? l : o
			}), void 0 !== o ? o : t
		}

		function u(t, e) {
			t.each(function(t, n) {
				var o = a.data(n, i);
				o ? (o.option(e), o._init()) : (o = new r(n, e), a.data(n, i, o))
			})
		}
		a = a || e || t.jQuery, a && (r.prototype.option || (r.prototype.option = function(t) {
			a.isPlainObject(t) && (this.options = a.extend(!0, this.options, t))
		}), a.fn[i] = function(t) {
			if("string" == typeof t) {
				var e = o.call(arguments, 1);
				return h(this, t, e)
			}
			return u(this, t), this
		}, n(a))
	}

	function n(t) {
		!t || t && t.bridget || (t.bridget = i)
	}
	var o = Array.prototype.slice,
		r = t.console,
		s = "undefined" == typeof r ? function() {} : function(t) {
			r.error(t)
		};
	return n(e || t.jQuery), i
}),
function(t, e) {
	"function" == typeof define && define.amd ? define("ev-emitter/ev-emitter", e) : "object" == typeof module && module.exports ? module.exports = e() : t.EvEmitter = e()
}("undefined" != typeof window ? window : this, function() {
	function t() {}
	var e = t.prototype;
	return e.on = function(t, e) {
		if(t && e) {
			var i = this._events = this._events || {},
				n = i[t] = i[t] || [];
			return -1 == n.indexOf(e) && n.push(e), this
		}
	}, e.once = function(t, e) {
		if(t && e) {
			this.on(t, e);
			var i = this._onceEvents = this._onceEvents || {},
				n = i[t] = i[t] || {};
			return n[e] = !0, this
		}
	}, e.off = function(t, e) {
		var i = this._events && this._events[t];
		if(i && i.length) {
			var n = i.indexOf(e);
			return -1 != n && i.splice(n, 1), this
		}
	}, e.emitEvent = function(t, e) {
		var i = this._events && this._events[t];
		if(i && i.length) {
			var n = 0,
				o = i[n];
			e = e || [];
			for(var r = this._onceEvents && this._onceEvents[t]; o;) {
				var s = r && r[o];
				s && (this.off(t, o), delete r[o]), o.apply(this, e), n += s ? 0 : 1, o = i[n]
			}
			return this
		}
	}, t
}),
function(t, e) {
	"use strict";
	"function" == typeof define && define.amd ? define("get-size/get-size", [], function() {
		return e()
	}) : "object" == typeof module && module.exports ? module.exports = e() : t.getSize = e()
}(window, function() {
	"use strict";

	function t(t) {
		var e = parseFloat(t),
			i = -1 == t.indexOf("%") && !isNaN(e);
		return i && e
	}

	function e() {}

	function i() {
		for(var t = {
				width: 0,
				height: 0,
				innerWidth: 0,
				innerHeight: 0,
				outerWidth: 0,
				outerHeight: 0
			}, e = 0; u > e; e++) {
			var i = h[e];
			t[i] = 0
		}
		return t
	}

	function n(t) {
		var e = getComputedStyle(t);
		return e || a("Style returned " + e + ". Are you running this code in a hidden iframe on Firefox? See http://bit.ly/getsizebug1"), e
	}

	function o() {
		if(!d) {
			d = !0;
			var e = document.createElement("div");
			e.style.width = "200px", e.style.padding = "1px 2px 3px 4px", e.style.borderStyle = "solid", e.style.borderWidth = "1px 2px 3px 4px", e.style.boxSizing = "border-box";
			var i = document.body || document.documentElement;
			i.appendChild(e);
			var o = n(e);
			r.isBoxSizeOuter = s = 200 == t(o.width), i.removeChild(e)
		}
	}

	function r(e) {
		if(o(), "string" == typeof e && (e = document.querySelector(e)), e && "object" == typeof e && e.nodeType) {
			var r = n(e);
			if("none" == r.display) return i();
			var a = {};
			a.width = e.offsetWidth, a.height = e.offsetHeight;
			for(var d = a.isBorderBox = "border-box" == r.boxSizing, l = 0; u > l; l++) {
				var c = h[l],
					f = r[c],
					m = parseFloat(f);
				a[c] = isNaN(m) ? 0 : m
			}
			var p = a.paddingLeft + a.paddingRight,
				g = a.paddingTop + a.paddingBottom,
				y = a.marginLeft + a.marginRight,
				v = a.marginTop + a.marginBottom,
				_ = a.borderLeftWidth + a.borderRightWidth,
				E = a.borderTopWidth + a.borderBottomWidth,
				z = d && s,
				b = t(r.width);
			b !== !1 && (a.width = b + (z ? 0 : p + _));
			var x = t(r.height);
			return x !== !1 && (a.height = x + (z ? 0 : g + E)), a.innerWidth = a.width - (p + _), a.innerHeight = a.height - (g + E), a.outerWidth = a.width + y, a.outerHeight = a.height + v, a
		}
	}
	var s, a = "undefined" == typeof console ? e : function(t) {
			console.error(t)
		},
		h = ["paddingLeft", "paddingRight", "paddingTop", "paddingBottom", "marginLeft", "marginRight", "marginTop", "marginBottom", "borderLeftWidth", "borderRightWidth", "borderTopWidth", "borderBottomWidth"],
		u = h.length,
		d = !1;
	return r
}),
function(t, e) {
	"use strict";
	"function" == typeof define && define.amd ? define("desandro-matches-selector/matches-selector", e) : "object" == typeof module && module.exports ? module.exports = e() : t.matchesSelector = e()
}(window, function() {
	"use strict";
	var t = function() {
		var t = Element.prototype;
		if(t.matches) return "matches";
		if(t.matchesSelector) return "matchesSelector";
		for(var e = ["webkit", "moz", "ms", "o"], i = 0; i < e.length; i++) {
			var n = e[i],
				o = n + "MatchesSelector";
			if(t[o]) return o
		}
	}();
	return function(e, i) {
		return e[t](i)
	}
}),
function(t, e) {
	"function" == typeof define && define.amd ? define("fizzy-ui-utils/utils", ["desandro-matches-selector/matches-selector"], function(i) {
		return e(t, i)
	}) : "object" == typeof module && module.exports ? module.exports = e(t, require("desandro-matches-selector")) : t.fizzyUIUtils = e(t, t.matchesSelector)
}(window, function(t, e) {
	var i = {};
	i.extend = function(t, e) {
		for(var i in e) t[i] = e[i];
		return t
	}, i.modulo = function(t, e) {
		return(t % e + e) % e
	}, i.makeArray = function(t) {
		var e = [];
		if(Array.isArray(t)) e = t;
		else if(t && "number" == typeof t.length)
			for(var i = 0; i < t.length; i++) e.push(t[i]);
		else e.push(t);
		return e
	}, i.removeFrom = function(t, e) {
		var i = t.indexOf(e); - 1 != i && t.splice(i, 1)
	}, i.getParent = function(t, i) {
		for(; t != document.body;)
			if(t = t.parentNode, e(t, i)) return t
	}, i.getQueryElement = function(t) {
		return "string" == typeof t ? document.querySelector(t) : t
	}, i.handleEvent = function(t) {
		var e = "on" + t.type;
		this[e] && this[e](t)
	}, i.filterFindElements = function(t, n) {
		t = i.makeArray(t);
		var o = [];
		return t.forEach(function(t) {
			if(t instanceof HTMLElement) {
				if(!n) return void o.push(t);
				e(t, n) && o.push(t);
				for(var i = t.querySelectorAll(n), r = 0; r < i.length; r++) o.push(i[r])
			}
		}), o
	}, i.debounceMethod = function(t, e, i) {
		var n = t.prototype[e],
			o = e + "Timeout";
		t.prototype[e] = function() {
			var t = this[o];
			t && clearTimeout(t);
			var e = arguments,
				r = this;
			this[o] = setTimeout(function() {
				n.apply(r, e), delete r[o]
			}, i || 100)
		}
	}, i.docReady = function(t) {
		var e = document.readyState;
		"complete" == e || "interactive" == e ? t() : document.addEventListener("DOMContentLoaded", t)
	}, i.toDashed = function(t) {
		return t.replace(/(.)([A-Z])/g, function(t, e, i) {
			return e + "-" + i
		}).toLowerCase()
	};
	var n = t.console;
	return i.htmlInit = function(e, o) {
		i.docReady(function() {
			var r = i.toDashed(o),
				s = "data-" + r,
				a = document.querySelectorAll("[" + s + "]"),
				h = document.querySelectorAll(".js-" + r),
				u = i.makeArray(a).concat(i.makeArray(h)),
				d = s + "-options",
				l = t.jQuery;
			u.forEach(function(t) {
				var i, r = t.getAttribute(s) || t.getAttribute(d);
				try {
					i = r && JSON.parse(r)
				} catch(a) {
					return void(n && n.error("Error parsing " + s + " on " + t.className + ": " + a))
				}
				var h = new e(t, i);
				l && l.data(t, o, h)
			})
		})
	}, i
}),
function(t, e) {
	"function" == typeof define && define.amd ? define("outlayer/item", ["ev-emitter/ev-emitter", "get-size/get-size"], e) : "object" == typeof module && module.exports ? module.exports = e(require("ev-emitter"), require("get-size")) : (t.Outlayer = {}, t.Outlayer.Item = e(t.EvEmitter, t.getSize))
}(window, function(t, e) {
	"use strict";

	function i(t) {
		for(var e in t) return !1;
		return e = null, !0
	}

	function n(t, e) {
		t && (this.element = t, this.layout = e, this.position = {
			x: 0,
			y: 0
		}, this._create())
	}

	function o(t) {
		return t.replace(/([A-Z])/g, function(t) {
			return "-" + t.toLowerCase()
		})
	}
	var r = document.documentElement.style,
		s = "string" == typeof r.transition ? "transition" : "WebkitTransition",
		a = "string" == typeof r.transform ? "transform" : "WebkitTransform",
		h = {
			WebkitTransition: "webkitTransitionEnd",
			transition: "transitionend"
		}[s],
		u = {
			transform: a,
			transition: s,
			transitionDuration: s + "Duration",
			transitionProperty: s + "Property",
			transitionDelay: s + "Delay"
		},
		d = n.prototype = Object.create(t.prototype);
	d.constructor = n, d._create = function() {
		this._transn = {
			ingProperties: {},
			clean: {},
			onEnd: {}
		}, this.css({
			position: "absolute"
		})
	}, d.handleEvent = function(t) {
		var e = "on" + t.type;
		this[e] && this[e](t)
	}, d.getSize = function() {
		this.size = e(this.element)
	}, d.css = function(t) {
		var e = this.element.style;
		for(var i in t) {
			var n = u[i] || i;
			e[n] = t[i]
		}
	}, d.getPosition = function() {
		var t = getComputedStyle(this.element),
			e = this.layout._getOption("originLeft"),
			i = this.layout._getOption("originTop"),
			n = t[e ? "left" : "right"],
			o = t[i ? "top" : "bottom"],
			r = this.layout.size,
			s = -1 != n.indexOf("%") ? parseFloat(n) / 100 * r.width : parseInt(n, 10),
			a = -1 != o.indexOf("%") ? parseFloat(o) / 100 * r.height : parseInt(o, 10);
		s = isNaN(s) ? 0 : s, a = isNaN(a) ? 0 : a, s -= e ? r.paddingLeft : r.paddingRight, a -= i ? r.paddingTop : r.paddingBottom, this.position.x = s, this.position.y = a
	}, d.layoutPosition = function() {
		var t = this.layout.size,
			e = {},
			i = this.layout._getOption("originLeft"),
			n = this.layout._getOption("originTop"),
			o = i ? "paddingLeft" : "paddingRight",
			r = i ? "left" : "right",
			s = i ? "right" : "left",
			a = this.position.x + t[o];
		e[r] = this.getXValue(a), e[s] = "";
		var h = n ? "paddingTop" : "paddingBottom",
			u = n ? "top" : "bottom",
			d = n ? "bottom" : "top",
			l = this.position.y + t[h];
		e[u] = this.getYValue(l), e[d] = "", this.css(e), this.emitEvent("layout", [this])
	}, d.getXValue = function(t) {
		var e = this.layout._getOption("horizontal");
		return this.layout.options.percentPosition && !e ? t / this.layout.size.width * 100 + "%" : t + "px"
	}, d.getYValue = function(t) {
		var e = this.layout._getOption("horizontal");
		return this.layout.options.percentPosition && e ? t / this.layout.size.height * 100 + "%" : t + "px"
	}, d._transitionTo = function(t, e) {
		this.getPosition();
		var i = this.position.x,
			n = this.position.y,
			o = parseInt(t, 10),
			r = parseInt(e, 10),
			s = o === this.position.x && r === this.position.y;
		if(this.setPosition(t, e), s && !this.isTransitioning) return void this.layoutPosition();
		var a = t - i,
			h = e - n,
			u = {};
		u.transform = this.getTranslate(a, h), this.transition({
			to: u,
			onTransitionEnd: {
				transform: this.layoutPosition
			},
			isCleaning: !0
		})
	}, d.getTranslate = function(t, e) {
		var i = this.layout._getOption("originLeft"),
			n = this.layout._getOption("originTop");
		return t = i ? t : -t, e = n ? e : -e, "translate3d(" + t + "px, " + e + "px, 0)"
	}, d.goTo = function(t, e) {
		this.setPosition(t, e), this.layoutPosition()
	}, d.moveTo = d._transitionTo, d.setPosition = function(t, e) {
		this.position.x = parseInt(t, 10), this.position.y = parseInt(e, 10)
	}, d._nonTransition = function(t) {
		this.css(t.to), t.isCleaning && this._removeStyles(t.to);
		for(var e in t.onTransitionEnd) t.onTransitionEnd[e].call(this)
	}, d.transition = function(t) {
		if(!parseFloat(this.layout.options.transitionDuration)) return void this._nonTransition(t);
		var e = this._transn;
		for(var i in t.onTransitionEnd) e.onEnd[i] = t.onTransitionEnd[i];
		for(i in t.to) e.ingProperties[i] = !0, t.isCleaning && (e.clean[i] = !0);
		if(t.from) {
			this.css(t.from);
			var n = this.element.offsetHeight;
			n = null
		}
		this.enableTransition(t.to), this.css(t.to), this.isTransitioning = !0
	};
	var l = "opacity," + o(a);
	d.enableTransition = function() {
		if(!this.isTransitioning) {
			var t = this.layout.options.transitionDuration;
			t = "number" == typeof t ? t + "ms" : t, this.css({
				transitionProperty: l,
				transitionDuration: t,
				transitionDelay: this.staggerDelay || 0
			}), this.element.addEventListener(h, this, !1)
		}
	}, d.onwebkitTransitionEnd = function(t) {
		this.ontransitionend(t)
	}, d.onotransitionend = function(t) {
		this.ontransitionend(t)
	};
	var c = {
		"-webkit-transform": "transform"
	};
	d.ontransitionend = function(t) {
		if(t.target === this.element) {
			var e = this._transn,
				n = c[t.propertyName] || t.propertyName;
			if(delete e.ingProperties[n], i(e.ingProperties) && this.disableTransition(), n in e.clean && (this.element.style[t.propertyName] = "", delete e.clean[n]), n in e.onEnd) {
				var o = e.onEnd[n];
				o.call(this), delete e.onEnd[n]
			}
			this.emitEvent("transitionEnd", [this])
		}
	}, d.disableTransition = function() {
		this.removeTransitionStyles(), this.element.removeEventListener(h, this, !1), this.isTransitioning = !1
	}, d._removeStyles = function(t) {
		var e = {};
		for(var i in t) e[i] = "";
		this.css(e)
	};
	var f = {
		transitionProperty: "",
		transitionDuration: "",
		transitionDelay: ""
	};
	return d.removeTransitionStyles = function() {
		this.css(f)
	}, d.stagger = function(t) {
		t = isNaN(t) ? 0 : t, this.staggerDelay = t + "ms"
	}, d.removeElem = function() {
		this.element.parentNode.removeChild(this.element), this.css({
			display: ""
		}), this.emitEvent("remove", [this])
	}, d.remove = function() {
		return s && parseFloat(this.layout.options.transitionDuration) ? (this.once("transitionEnd", function() {
			this.removeElem()
		}), void this.hide()) : void this.removeElem()
	}, d.reveal = function() {
		delete this.isHidden, this.css({
			display: ""
		});
		var t = this.layout.options,
			e = {},
			i = this.getHideRevealTransitionEndProperty("visibleStyle");
		e[i] = this.onRevealTransitionEnd, this.transition({
			from: t.hiddenStyle,
			to: t.visibleStyle,
			isCleaning: !0,
			onTransitionEnd: e
		})
	}, d.onRevealTransitionEnd = function() {
		this.isHidden || this.emitEvent("reveal")
	}, d.getHideRevealTransitionEndProperty = function(t) {
		var e = this.layout.options[t];
		if(e.opacity) return "opacity";
		for(var i in e) return i
	}, d.hide = function() {
		this.isHidden = !0, this.css({
			display: ""
		});
		var t = this.layout.options,
			e = {},
			i = this.getHideRevealTransitionEndProperty("hiddenStyle");
		e[i] = this.onHideTransitionEnd, this.transition({
			from: t.visibleStyle,
			to: t.hiddenStyle,
			isCleaning: !0,
			onTransitionEnd: e
		})
	}, d.onHideTransitionEnd = function() {
		this.isHidden && (this.css({
			display: "none"
		}), this.emitEvent("hide"))
	}, d.destroy = function() {
		this.css({
			position: "",
			left: "",
			right: "",
			top: "",
			bottom: "",
			transition: "",
			transform: ""
		})
	}, n
}),
function(t, e) {
	"use strict";
	"function" == typeof define && define.amd ? define("outlayer/outlayer", ["ev-emitter/ev-emitter", "get-size/get-size", "fizzy-ui-utils/utils", "./item"], function(i, n, o, r) {
		return e(t, i, n, o, r)
	}) : "object" == typeof module && module.exports ? module.exports = e(t, require("ev-emitter"), require("get-size"), require("fizzy-ui-utils"), require("./item")) : t.Outlayer = e(t, t.EvEmitter, t.getSize, t.fizzyUIUtils, t.Outlayer.Item)
}(window, function(t, e, i, n, o) {
	"use strict";

	function r(t, e) {
		var i = n.getQueryElement(t);
		if(!i) return void(h && h.error("Bad element for " + this.constructor.namespace + ": " + (i || t)));
		this.element = i, u && (this.$element = u(this.element)), this.options = n.extend({}, this.constructor.defaults), this.option(e);
		var o = ++l;
		this.element.outlayerGUID = o, c[o] = this, this._create();
		var r = this._getOption("initLayout");
		r && this.layout()
	}

	function s(t) {
		function e() {
			t.apply(this, arguments)
		}
		return e.prototype = Object.create(t.prototype), e.prototype.constructor = e, e
	}

	function a(t) {
		if("number" == typeof t) return t;
		var e = t.match(/(^\d*\.?\d*)(\w*)/),
			i = e && e[1],
			n = e && e[2];
		if(!i.length) return 0;
		i = parseFloat(i);
		var o = m[n] || 1;
		return i * o
	}
	var h = t.console,
		u = t.jQuery,
		d = function() {},
		l = 0,
		c = {};
	r.namespace = "outlayer", r.Item = o, r.defaults = {
		containerStyle: {
			position: "relative"
		},
		initLayout: !0,
		originLeft: !0,
		originTop: !0,
		resize: !0,
		resizeContainer: !0,
		transitionDuration: "0.4s",
		hiddenStyle: {
			opacity: 0,
			transform: "scale(0.001)"
		},
		visibleStyle: {
			opacity: 1,
			transform: "scale(1)"
		}
	};
	var f = r.prototype;
	n.extend(f, e.prototype), f.option = function(t) {
		n.extend(this.options, t)
	}, f._getOption = function(t) {
		var e = this.constructor.compatOptions[t];
		return e && void 0 !== this.options[e] ? this.options[e] : this.options[t]
	}, r.compatOptions = {
		initLayout: "isInitLayout",
		horizontal: "isHorizontal",
		layoutInstant: "isLayoutInstant",
		originLeft: "isOriginLeft",
		originTop: "isOriginTop",
		resize: "isResizeBound",
		resizeContainer: "isResizingContainer"
	}, f._create = function() {
		this.reloadItems(), this.stamps = [], this.stamp(this.options.stamp), n.extend(this.element.style, this.options.containerStyle);
		var t = this._getOption("resize");
		t && this.bindResize()
	}, f.reloadItems = function() {
		this.items = this._itemize(this.element.children)
	}, f._itemize = function(t) {
		for(var e = this._filterFindItemElements(t), i = this.constructor.Item, n = [], o = 0; o < e.length; o++) {
			var r = e[o],
				s = new i(r, this);
			n.push(s)
		}
		return n
	}, f._filterFindItemElements = function(t) {
		return n.filterFindElements(t, this.options.itemSelector)
	}, f.getItemElements = function() {
		return this.items.map(function(t) {
			return t.element
		})
	}, f.layout = function() {
		this._resetLayout(), this._manageStamps();
		var t = this._getOption("layoutInstant"),
			e = void 0 !== t ? t : !this._isLayoutInited;
		this.layoutItems(this.items, e), this._isLayoutInited = !0
	}, f._init = f.layout, f._resetLayout = function() {
		this.getSize()
	}, f.getSize = function() {
		this.size = i(this.element)
	}, f._getMeasurement = function(t, e) {
		var n, o = this.options[t];
		o ? ("string" == typeof o ? n = this.element.querySelector(o) : o instanceof HTMLElement && (n = o), this[t] = n ? i(n)[e] : o) : this[t] = 0
	}, f.layoutItems = function(t, e) {
		t = this._getItemsForLayout(t), this._layoutItems(t, e), this._postLayout()
	}, f._getItemsForLayout = function(t) {
		return t.filter(function(t) {
			return !t.isIgnored
		})
	}, f._layoutItems = function(t, e) {
		if(this._emitCompleteOnItems("layout", t), t && t.length) {
			var i = [];
			t.forEach(function(t) {
				var n = this._getItemLayoutPosition(t);
				n.item = t, n.isInstant = e || t.isLayoutInstant, i.push(n)
			}, this), this._processLayoutQueue(i)
		}
	}, f._getItemLayoutPosition = function() {
		return {
			x: 0,
			y: 0
		}
	}, f._processLayoutQueue = function(t) {
		this.updateStagger(), t.forEach(function(t, e) {
			this._positionItem(t.item, t.x, t.y, t.isInstant, e)
		}, this)
	}, f.updateStagger = function() {
		var t = this.options.stagger;
		return null === t || void 0 === t ? void(this.stagger = 0) : (this.stagger = a(t), this.stagger)
	}, f._positionItem = function(t, e, i, n, o) {
		n ? t.goTo(e, i) : (t.stagger(o * this.stagger), t.moveTo(e, i))
	}, f._postLayout = function() {
		this.resizeContainer()
	}, f.resizeContainer = function() {
		var t = this._getOption("resizeContainer");
		if(t) {
			var e = this._getContainerSize();
			e && (this._setContainerMeasure(e.width, !0), this._setContainerMeasure(e.height, !1))
		}
	}, f._getContainerSize = d, f._setContainerMeasure = function(t, e) {
		if(void 0 !== t) {
			var i = this.size;
			i.isBorderBox && (t += e ? i.paddingLeft + i.paddingRight + i.borderLeftWidth + i.borderRightWidth : i.paddingBottom + i.paddingTop + i.borderTopWidth + i.borderBottomWidth), t = Math.max(t, 0), this.element.style[e ? "width" : "height"] = t + "px"
		}
	}, f._emitCompleteOnItems = function(t, e) {
		function i() {
			o.dispatchEvent(t + "Complete", null, [e])
		}

		function n() {
			s++, s == r && i()
		}
		var o = this,
			r = e.length;
		if(!e || !r) return void i();
		var s = 0;
		e.forEach(function(e) {
			e.once(t, n)
		})
	}, f.dispatchEvent = function(t, e, i) {
		var n = e ? [e].concat(i) : i;
		if(this.emitEvent(t, n), u)
			if(this.$element = this.$element || u(this.element), e) {
				var o = u.Event(e);
				o.type = t, this.$element.trigger(o, i)
			} else this.$element.trigger(t, i)
	}, f.ignore = function(t) {
		var e = this.getItem(t);
		e && (e.isIgnored = !0)
	}, f.unignore = function(t) {
		var e = this.getItem(t);
		e && delete e.isIgnored
	}, f.stamp = function(t) {
		t = this._find(t), t && (this.stamps = this.stamps.concat(t), t.forEach(this.ignore, this))
	}, f.unstamp = function(t) {
		t = this._find(t), t && t.forEach(function(t) {
			n.removeFrom(this.stamps, t), this.unignore(t)
		}, this)
	}, f._find = function(t) {
		return t ? ("string" == typeof t && (t = this.element.querySelectorAll(t)), t = n.makeArray(t)) : void 0
	}, f._manageStamps = function() {
		this.stamps && this.stamps.length && (this._getBoundingRect(), this.stamps.forEach(this._manageStamp, this))
	}, f._getBoundingRect = function() {
		var t = this.element.getBoundingClientRect(),
			e = this.size;
		this._boundingRect = {
			left: t.left + e.paddingLeft + e.borderLeftWidth,
			top: t.top + e.paddingTop + e.borderTopWidth,
			right: t.right - (e.paddingRight + e.borderRightWidth),
			bottom: t.bottom - (e.paddingBottom + e.borderBottomWidth)
		}
	}, f._manageStamp = d, f._getElementOffset = function(t) {
		var e = t.getBoundingClientRect(),
			n = this._boundingRect,
			o = i(t),
			r = {
				left: e.left - n.left - o.marginLeft,
				top: e.top - n.top - o.marginTop,
				right: n.right - e.right - o.marginRight,
				bottom: n.bottom - e.bottom - o.marginBottom
			};
		return r
	}, f.handleEvent = n.handleEvent, f.bindResize = function() {
		t.addEventListener("resize", this), this.isResizeBound = !0
	}, f.unbindResize = function() {
		t.removeEventListener("resize", this), this.isResizeBound = !1
	}, f.onresize = function() {
		this.resize()
	}, n.debounceMethod(r, "onresize", 100), f.resize = function() {
		this.isResizeBound && this.needsResizeLayout() && this.layout()
	}, f.needsResizeLayout = function() {
		var t = i(this.element),
			e = this.size && t;
		return e && t.innerWidth !== this.size.innerWidth
	}, f.addItems = function(t) {
		var e = this._itemize(t);
		return e.length && (this.items = this.items.concat(e)), e
	}, f.appended = function(t) {
		var e = this.addItems(t);
		e.length && (this.layoutItems(e, !0), this.reveal(e))
	}, f.prepended = function(t) {
		var e = this._itemize(t);
		if(e.length) {
			var i = this.items.slice(0);
			this.items = e.concat(i), this._resetLayout(), this._manageStamps(), this.layoutItems(e, !0), this.reveal(e), this.layoutItems(i)
		}
	}, f.reveal = function(t) {
		if(this._emitCompleteOnItems("reveal", t), t && t.length) {
			var e = this.updateStagger();
			t.forEach(function(t, i) {
				t.stagger(i * e), t.reveal()
			})
		}
	}, f.hide = function(t) {
		if(this._emitCompleteOnItems("hide", t), t && t.length) {
			var e = this.updateStagger();
			t.forEach(function(t, i) {
				t.stagger(i * e), t.hide()
			})
		}
	}, f.revealItemElements = function(t) {
		var e = this.getItems(t);
		this.reveal(e)
	}, f.hideItemElements = function(t) {
		var e = this.getItems(t);
		this.hide(e)
	}, f.getItem = function(t) {
		for(var e = 0; e < this.items.length; e++) {
			var i = this.items[e];
			if(i.element == t) return i
		}
	}, f.getItems = function(t) {
		t = n.makeArray(t);
		var e = [];
		return t.forEach(function(t) {
			var i = this.getItem(t);
			i && e.push(i)
		}, this), e
	}, f.remove = function(t) {
		var e = this.getItems(t);
		this._emitCompleteOnItems("remove", e), e && e.length && e.forEach(function(t) {
			t.remove(), n.removeFrom(this.items, t)
		}, this)
	}, f.destroy = function() {
		var t = this.element.style;
		t.height = "", t.position = "", t.width = "", this.items.forEach(function(t) {
			t.destroy()
		}), this.unbindResize();
		var e = this.element.outlayerGUID;
		delete c[e], delete this.element.outlayerGUID, u && u.removeData(this.element, this.constructor.namespace)
	}, r.data = function(t) {
		t = n.getQueryElement(t);
		var e = t && t.outlayerGUID;
		return e && c[e]
	}, r.create = function(t, e) {
		var i = s(r);
		return i.defaults = n.extend({}, r.defaults), n.extend(i.defaults, e), i.compatOptions = n.extend({}, r.compatOptions), i.namespace = t, i.data = r.data, i.Item = s(o), n.htmlInit(i, t), u && u.bridget && u.bridget(t, i), i
	};
	var m = {
		ms: 1,
		s: 1e3
	};
	return r.Item = o, r
}),
function(t, e) {
	"function" == typeof define && define.amd ? define(["outlayer/outlayer", "get-size/get-size"], e) : "object" == typeof module && module.exports ? module.exports = e(require("outlayer"), require("get-size")) : t.Masonry = e(t.Outlayer, t.getSize)
}(window, function(t, e) {
	var i = t.create("masonry");
	return i.compatOptions.fitWidth = "isFitWidth", i.prototype._resetLayout = function() {
		this.getSize(), this._getMeasurement("columnWidth", "outerWidth"), this._getMeasurement("gutter", "outerWidth"), this.measureColumns(), this.colYs = [];
		for(var t = 0; t < this.cols; t++) this.colYs.push(0);
		this.maxY = 0
	}, i.prototype.measureColumns = function() {
		if(this.getContainerWidth(), !this.columnWidth) {
			var t = this.items[0],
				i = t && t.element;
			this.columnWidth = i && e(i).outerWidth || this.containerWidth
		}
		var n = this.columnWidth += this.gutter,
			o = this.containerWidth + this.gutter,
			r = o / n,
			s = n - o % n,
			a = s && 1 > s ? "round" : "floor";
		r = Math[a](r), this.cols = Math.max(r, 1)
	}, i.prototype.getContainerWidth = function() {
		var t = this._getOption("fitWidth"),
			i = t ? this.element.parentNode : this.element,
			n = e(i);
		this.containerWidth = n && n.innerWidth
	}, i.prototype._getItemLayoutPosition = function(t) {
		t.getSize();
		var e = t.size.outerWidth % this.columnWidth,
			i = e && 1 > e ? "round" : "ceil",
			n = Math[i](t.size.outerWidth / this.columnWidth);
		n = Math.min(n, this.cols);
		for(var o = this._getColGroup(n), r = Math.min.apply(Math, o), s = o.indexOf(r), a = {
				x: this.columnWidth * s,
				y: r
			}, h = r + t.size.outerHeight, u = this.cols + 1 - o.length, d = 0; u > d; d++) this.colYs[s + d] = h;
		return a
	}, i.prototype._getColGroup = function(t) {
		if(2 > t) return this.colYs;
		for(var e = [], i = this.cols + 1 - t, n = 0; i > n; n++) {
			var o = this.colYs.slice(n, n + t);
			e[n] = Math.max.apply(Math, o)
		}
		return e
	}, i.prototype._manageStamp = function(t) {
		var i = e(t),
			n = this._getElementOffset(t),
			o = this._getOption("originLeft"),
			r = o ? n.left : n.right,
			s = r + i.outerWidth,
			a = Math.floor(r / this.columnWidth);
		a = Math.max(0, a);
		var h = Math.floor(s / this.columnWidth);
		h -= s % this.columnWidth ? 0 : 1, h = Math.min(this.cols - 1, h);
		for(var u = this._getOption("originTop"), d = (u ? n.top : n.bottom) + i.outerHeight, l = a; h >= l; l++) this.colYs[l] = Math.max(d, this.colYs[l])
	}, i.prototype._getContainerSize = function() {
		this.maxY = Math.max.apply(Math, this.colYs);
		var t = {
			height: this.maxY
		};
		return this._getOption("fitWidth") && (t.width = this._getContainerFitWidth()), t
	}, i.prototype._getContainerFitWidth = function() {
		for(var t = 0, e = this.cols; --e && 0 === this.colYs[e];) t++;
		return(this.cols - t) * this.columnWidth - this.gutter
	}, i.prototype.needsResizeLayout = function() {
		var t = this.containerWidth;
		return this.getContainerWidth(), t != this.containerWidth
	}, i
});

/**
 * Swiper 3.4.0
 * Most modern mobile touch slider and framework with hardware accelerated transitions
 * 
 * http://www.idangero.us/swiper/
 * 
 * Copyright 2016, Vladimir Kharlampidi
 * The iDangero.us
 * http://www.idangero.us/
 * 
 * Licensed under MIT
 * 
 * Released on: October 16, 2016
 */
! function() {
	"use strict";

	function e(e) {
		e.fn.swiper = function(a) {
			var s;
			return e(this).each(function() {
				var e = new t(this, a);
				s || (s = e)
			}), s
		}
	}
	var a, t = function(e, i) {
		function n(e) {
			return Math.floor(e)
		}

		function o() {
			var e = S.params.autoplay,
				a = S.slides.eq(S.activeIndex);
			a.attr("data-swiper-autoplay") && (e = a.attr("data-swiper-autoplay") || S.params.autoplay), S.autoplayTimeoutId = setTimeout(function() {
				S.params.loop ? (S.fixLoop(), S._slideNext(), S.emit("onAutoplay", S)) : S.isEnd ? i.autoplayStopOnLast ? S.stopAutoplay() : (S._slideTo(0), S.emit("onAutoplay", S)) : (S._slideNext(), S.emit("onAutoplay", S))
			}, e)
		}

		function l(e, t) {
			var s = a(e.target);
			if(!s.is(t))
				if("string" == typeof t) s = s.parents(t);
				else if(t.nodeType) {
				var i;
				return s.parents().each(function(e, a) {
					a === t && (i = t)
				}), i ? t : void 0
			}
			if(0 !== s.length) return s[0]
		}

		function p(e, a) {
			a = a || {};
			var t = window.MutationObserver || window.WebkitMutationObserver,
				s = new t(function(e) {
					e.forEach(function(e) {
						S.onResize(!0), S.emit("onObserverUpdate", S, e)
					})
				});
			s.observe(e, {
				attributes: "undefined" == typeof a.attributes || a.attributes,
				childList: "undefined" == typeof a.childList || a.childList,
				characterData: "undefined" == typeof a.characterData || a.characterData
			}), S.observers.push(s)
		}

		function d(e) {
			e.originalEvent && (e = e.originalEvent);
			var a = e.keyCode || e.charCode;
			if(!S.params.allowSwipeToNext && (S.isHorizontal() && 39 === a || !S.isHorizontal() && 40 === a)) return !1;
			if(!S.params.allowSwipeToPrev && (S.isHorizontal() && 37 === a || !S.isHorizontal() && 38 === a)) return !1;
			if(!(e.shiftKey || e.altKey || e.ctrlKey || e.metaKey || document.activeElement && document.activeElement.nodeName && ("input" === document.activeElement.nodeName.toLowerCase() || "textarea" === document.activeElement.nodeName.toLowerCase()))) {
				if(37 === a || 39 === a || 38 === a || 40 === a) {
					var t = !1;
					if(S.container.parents("." + S.params.slideClass).length > 0 && 0 === S.container.parents("." + S.params.slideActiveClass).length) return;
					var s = {
							left: window.pageXOffset,
							top: window.pageYOffset
						},
						i = window.innerWidth,
						r = window.innerHeight,
						n = S.container.offset();
					S.rtl && (n.left = n.left - S.container[0].scrollLeft);
					for(var o = [
							[n.left, n.top],
							[n.left + S.width, n.top],
							[n.left, n.top + S.height],
							[n.left + S.width, n.top + S.height]
						], l = 0; l < o.length; l++) {
						var p = o[l];
						p[0] >= s.left && p[0] <= s.left + i && p[1] >= s.top && p[1] <= s.top + r && (t = !0)
					}
					if(!t) return
				}
				S.isHorizontal() ? (37 !== a && 39 !== a || (e.preventDefault ? e.preventDefault() : e.returnValue = !1), (39 === a && !S.rtl || 37 === a && S.rtl) && S.slideNext(), (37 === a && !S.rtl || 39 === a && S.rtl) && S.slidePrev()) : (38 !== a && 40 !== a || (e.preventDefault ? e.preventDefault() : e.returnValue = !1), 40 === a && S.slideNext(), 38 === a && S.slidePrev())
			}
		}

		function u() {
			var e = "onwheel",
				a = e in document;
			if(!a) {
				var t = document.createElement("div");
				t.setAttribute(e, "return;"), a = "function" == typeof t[e]
			}
			return !a && document.implementation && document.implementation.hasFeature && document.implementation.hasFeature("", "") !== !0 && (a = document.implementation.hasFeature("Events.wheel", "3.0")), a
		}

		function c(e) {
			e.originalEvent && (e = e.originalEvent);
			var a = 0,
				t = S.rtl ? -1 : 1,
				s = m(e);
			if(S.params.mousewheelForceToAxis)
				if(S.isHorizontal()) {
					if(!(Math.abs(s.pixelX) > Math.abs(s.pixelY))) return;
					a = s.pixelX * t
				} else {
					if(!(Math.abs(s.pixelY) > Math.abs(s.pixelX))) return;
					a = s.pixelY
				}
			else a = Math.abs(s.pixelX) > Math.abs(s.pixelY) ? -s.pixelX * t : -s.pixelY;
			if(0 !== a) {
				if(S.params.mousewheelInvert && (a = -a), S.params.freeMode) {
					var i = S.getWrapperTranslate() + a * S.params.mousewheelSensitivity,
						r = S.isBeginning,
						n = S.isEnd;
					if(i >= S.minTranslate() && (i = S.minTranslate()), i <= S.maxTranslate() && (i = S.maxTranslate()), S.setWrapperTransition(0), S.setWrapperTranslate(i), S.updateProgress(), S.updateActiveIndex(), (!r && S.isBeginning || !n && S.isEnd) && S.updateClasses(), S.params.freeModeSticky ? (clearTimeout(S.mousewheel.timeout), S.mousewheel.timeout = setTimeout(function() {
							S.slideReset()
						}, 300)) : S.params.lazyLoading && S.lazy && S.lazy.load(), S.emit("onScroll", S, e), S.params.autoplay && S.params.autoplayDisableOnInteraction && S.stopAutoplay(), 0 === i || i === S.maxTranslate()) return
				} else {
					if((new window.Date).getTime() - S.mousewheel.lastScrollTime > 60)
						if(a < 0)
							if(S.isEnd && !S.params.loop || S.animating) {
								if(S.params.mousewheelReleaseOnEdges) return !0
							} else S.slideNext(), S.emit("onScroll", S, e);
					else if(S.isBeginning && !S.params.loop || S.animating) {
						if(S.params.mousewheelReleaseOnEdges) return !0
					} else S.slidePrev(), S.emit("onScroll", S, e);
					S.mousewheel.lastScrollTime = (new window.Date).getTime()
				}
				return e.preventDefault ? e.preventDefault() : e.returnValue = !1, !1
			}
		}

		function m(e) {
			var a = 10,
				t = 40,
				s = 800,
				i = 0,
				r = 0,
				n = 0,
				o = 0;
			return "detail" in e && (r = e.detail), "wheelDelta" in e && (r = -e.wheelDelta / 120), "wheelDeltaY" in e && (r = -e.wheelDeltaY / 120), "wheelDeltaX" in e && (i = -e.wheelDeltaX / 120), "axis" in e && e.axis === e.HORIZONTAL_AXIS && (i = r, r = 0), n = i * a, o = r * a, "deltaY" in e && (o = e.deltaY), "deltaX" in e && (n = e.deltaX), (n || o) && e.deltaMode && (1 === e.deltaMode ? (n *= t, o *= t) : (n *= s, o *= s)), n && !i && (i = n < 1 ? -1 : 1), o && !r && (r = o < 1 ? -1 : 1), {
				spinX: i,
				spinY: r,
				pixelX: n,
				pixelY: o
			}
		}

		function h(e, t) {
			e = a(e);
			var s, i, r, n = S.rtl ? -1 : 1;
			s = e.attr("data-swiper-parallax") || "0", i = e.attr("data-swiper-parallax-x"), r = e.attr("data-swiper-parallax-y"), i || r ? (i = i || "0", r = r || "0") : S.isHorizontal() ? (i = s, r = "0") : (r = s, i = "0"), i = i.indexOf("%") >= 0 ? parseInt(i, 10) * t * n + "%" : i * t * n + "px", r = r.indexOf("%") >= 0 ? parseInt(r, 10) * t + "%" : r * t + "px", e.transform("translate3d(" + i + ", " + r + ",0px)")
		}

		function g(e) {
			return 0 !== e.indexOf("on") && (e = e[0] !== e[0].toUpperCase() ? "on" + e[0].toUpperCase() + e.substring(1) : "on" + e), e
		}
		if(!(this instanceof t)) return new t(e, i);
		var f = {
				direction: "horizontal",
				touchEventsTarget: "container",
				initialSlide: 0,
				speed: 300,
				autoplay: !1,
				autoplayDisableOnInteraction: !0,
				autoplayStopOnLast: !1,
				iOSEdgeSwipeDetection: !1,
				iOSEdgeSwipeThreshold: 20,
				freeMode: !1,
				freeModeMomentum: !0,
				freeModeMomentumRatio: 1,
				freeModeMomentumBounce: !0,
				freeModeMomentumBounceRatio: 1,
				freeModeMomentumVelocityRatio: 1,
				freeModeSticky: !1,
				freeModeMinimumVelocity: .02,
				autoHeight: !1,
				setWrapperSize: !1,
				virtualTranslate: !1,
				effect: "slide",
				coverflow: {
					rotate: 50,
					stretch: 0,
					depth: 100,
					modifier: 1,
					slideShadows: !0
				},
				flip: {
					slideShadows: !0,
					limitRotation: !0
				},
				cube: {
					slideShadows: !0,
					shadow: !0,
					shadowOffset: 20,
					shadowScale: .94
				},
				fade: {
					crossFade: !1
				},
				parallax: !1,
				zoom: !1,
				zoomMax: 3,
				zoomMin: 1,
				zoomToggle: !0,
				scrollbar: null,
				scrollbarHide: !0,
				scrollbarDraggable: !1,
				scrollbarSnapOnRelease: !1,
				keyboardControl: !1,
				mousewheelControl: !1,
				mousewheelReleaseOnEdges: !1,
				mousewheelInvert: !1,
				mousewheelForceToAxis: !1,
				mousewheelSensitivity: 1,
				mousewheelEventsTarged: "container",
				hashnav: !1,
				hashnavWatchState: !1,
				history: !1,
				replaceState: !1,
				breakpoints: void 0,
				spaceBetween: 0,
				slidesPerView: 1,
				slidesPerColumn: 1,
				slidesPerColumnFill: "column",
				slidesPerGroup: 1,
				centeredSlides: !1,
				slidesOffsetBefore: 0,
				slidesOffsetAfter: 0,
				roundLengths: !1,
				touchRatio: 1,
				touchAngle: 45,
				simulateTouch: !0,
				shortSwipes: !0,
				longSwipes: !0,
				longSwipesRatio: .5,
				longSwipesMs: 300,
				followFinger: !0,
				onlyExternal: !1,
				threshold: 0,
				touchMoveStopPropagation: !0,
				touchReleaseOnEdges: !1,
				uniqueNavElements: !0,
				pagination: null,
				paginationElement: "span",
				paginationClickable: !1,
				paginationHide: !1,
				paginationBulletRender: null,
				paginationProgressRender: null,
				paginationFractionRender: null,
				paginationCustomRender: null,
				paginationType: "bullets",
				resistance: !0,
				resistanceRatio: .85,
				nextButton: null,
				prevButton: null,
				watchSlidesProgress: !1,
				watchSlidesVisibility: !1,
				grabCursor: !1,
				preventClicks: !0,
				preventClicksPropagation: !0,
				slideToClickedSlide: !1,
				lazyLoading: !1,
				lazyLoadingInPrevNext: !1,
				lazyLoadingInPrevNextAmount: 1,
				lazyLoadingOnTransitionStart: !1,
				preloadImages: !0,
				updateOnImagesReady: !0,
				loop: !1,
				loopAdditionalSlides: 0,
				loopedSlides: null,
				control: void 0,
				controlInverse: !1,
				controlBy: "slide",
				normalizeSlideIndex: !0,
				allowSwipeToPrev: !0,
				allowSwipeToNext: !0,
				swipeHandler: null,
				noSwiping: !0,
				noSwipingClass: "swiper-no-swiping",
				passiveListeners: !0,
				containerModifierClass: "swiper-container-",
				slideClass: "swiper-slide",
				slideActiveClass: "swiper-slide-active",
				slideDuplicateActiveClass: "swiper-slide-duplicate-active",
				slideVisibleClass: "swiper-slide-visible",
				slideDuplicateClass: "swiper-slide-duplicate",
				slideNextClass: "swiper-slide-next",
				slideDuplicateNextClass: "swiper-slide-duplicate-next",
				slidePrevClass: "swiper-slide-prev",
				slideDuplicatePrevClass: "swiper-slide-duplicate-prev",
				wrapperClass: "swiper-wrapper",
				bulletClass: "swiper-pagination-bullet",
				bulletActiveClass: "swiper-pagination-bullet-active",
				buttonDisabledClass: "swiper-button-disabled",
				paginationCurrentClass: "swiper-pagination-current",
				paginationTotalClass: "swiper-pagination-total",
				paginationHiddenClass: "swiper-pagination-hidden",
				paginationProgressbarClass: "swiper-pagination-progressbar",
				paginationClickableClass: "swiper-pagination-clickable",
				paginationModifierClass: "swiper-pagination-",
				lazyLoadingClass: "swiper-lazy",
				lazyStatusLoadingClass: "swiper-lazy-loading",
				lazyStatusLoadedClass: "swiper-lazy-loaded",
				lazyPreloaderClass: "swiper-lazy-preloader",
				notificationClass: "swiper-notification",
				preloaderClass: "preloader",
				zoomContainerClass: "swiper-zoom-container",
				observer: !1,
				observeParents: !1,
				a11y: !1,
				prevSlideMessage: "Previous slide",
				nextSlideMessage: "Next slide",
				firstSlideMessage: "This is the first slide",
				lastSlideMessage: "This is the last slide",
				paginationBulletMessage: "Go to slide {{index}}",
				runCallbacksOnInit: !0
			},
			v = i && i.virtualTranslate;
		i = i || {};
		var w = {};
		for(var y in i)
			if("object" != typeof i[y] || null === i[y] || (i[y].nodeType || i[y] === window || i[y] === document || "undefined" != typeof s && i[y] instanceof s || "undefined" != typeof jQuery && i[y] instanceof jQuery)) w[y] = i[y];
			else {
				w[y] = {};
				for(var x in i[y]) w[y][x] = i[y][x]
			}
		for(var T in f)
			if("undefined" == typeof i[T]) i[T] = f[T];
			else if("object" == typeof i[T])
			for(var b in f[T]) "undefined" == typeof i[T][b] && (i[T][b] = f[T][b]);
		var S = this;
		if(S.params = i, S.originalParams = w, S.classNames = [], "undefined" != typeof a && "undefined" != typeof s && (a = s), ("undefined" != typeof a || (a = "undefined" == typeof s ? window.Dom7 || window.Zepto || window.jQuery : s)) && (S.$ = a, S.currentBreakpoint = void 0, S.getActiveBreakpoint = function() {
				if(!S.params.breakpoints) return !1;
				var e, a = !1,
					t = [];
				for(e in S.params.breakpoints) S.params.breakpoints.hasOwnProperty(e) && t.push(e);
				t.sort(function(e, a) {
					return parseInt(e, 10) > parseInt(a, 10)
				});
				for(var s = 0; s < t.length; s++) e = t[s], e >= window.innerWidth && !a && (a = e);
				return a || "max"
			}, S.setBreakpoint = function() {
				var e = S.getActiveBreakpoint();
				if(e && S.currentBreakpoint !== e) {
					var a = e in S.params.breakpoints ? S.params.breakpoints[e] : S.originalParams,
						t = S.params.loop && a.slidesPerView !== S.params.slidesPerView;
					for(var s in a) S.params[s] = a[s];
					S.currentBreakpoint = e, t && S.destroyLoop && S.reLoop(!0)
				}
			}, S.params.breakpoints && S.setBreakpoint(), S.container = a(e), 0 !== S.container.length)) {
			if(S.container.length > 1) {
				var C = [];
				return S.container.each(function() {
					C.push(new t(this, i))
				}), C
			}
			S.container[0].swiper = S, S.container.data("swiper", S), S.classNames.push(S.params.containerModifierClass + S.params.direction), S.params.freeMode && S.classNames.push(S.params.containerModifierClass + "free-mode"), S.support.flexbox || (S.classNames.push(S.params.containerModifierClass + "no-flexbox"), S.params.slidesPerColumn = 1), S.params.autoHeight && S.classNames.push(S.params.containerModifierClass + "autoheight"), (S.params.parallax || S.params.watchSlidesVisibility) && (S.params.watchSlidesProgress = !0), S.params.touchReleaseOnEdges && (S.params.resistanceRatio = 0), ["cube", "coverflow", "flip"].indexOf(S.params.effect) >= 0 && (S.support.transforms3d ? (S.params.watchSlidesProgress = !0, S.classNames.push(S.params.containerModifierClass + "3d")) : S.params.effect = "slide"), "slide" !== S.params.effect && S.classNames.push(S.params.containerModifierClass + S.params.effect), "cube" === S.params.effect && (S.params.resistanceRatio = 0, S.params.slidesPerView = 1, S.params.slidesPerColumn = 1, S.params.slidesPerGroup = 1, S.params.centeredSlides = !1, S.params.spaceBetween = 0, S.params.virtualTranslate = !0, S.params.setWrapperSize = !1), "fade" !== S.params.effect && "flip" !== S.params.effect || (S.params.slidesPerView = 1, S.params.slidesPerColumn = 1, S.params.slidesPerGroup = 1, S.params.watchSlidesProgress = !0, S.params.spaceBetween = 0, S.params.setWrapperSize = !1, "undefined" == typeof v && (S.params.virtualTranslate = !0)), S.params.grabCursor && S.support.touch && (S.params.grabCursor = !1), S.wrapper = S.container.children("." + S.params.wrapperClass), S.params.pagination && (S.paginationContainer = a(S.params.pagination), S.params.uniqueNavElements && "string" == typeof S.params.pagination && S.paginationContainer.length > 1 && 1 === S.container.find(S.params.pagination).length && (S.paginationContainer = S.container.find(S.params.pagination)), "bullets" === S.params.paginationType && S.params.paginationClickable ? S.paginationContainer.addClass(S.params.paginationModifierClass + "clickable") : S.params.paginationClickable = !1, S.paginationContainer.addClass(S.params.paginationModifierClass + S.params.paginationType)), (S.params.nextButton || S.params.prevButton) && (S.params.nextButton && (S.nextButton = a(S.params.nextButton), S.params.uniqueNavElements && "string" == typeof S.params.nextButton && S.nextButton.length > 1 && 1 === S.container.find(S.params.nextButton).length && (S.nextButton = S.container.find(S.params.nextButton))), S.params.prevButton && (S.prevButton = a(S.params.prevButton), S.params.uniqueNavElements && "string" == typeof S.params.prevButton && S.prevButton.length > 1 && 1 === S.container.find(S.params.prevButton).length && (S.prevButton = S.container.find(S.params.prevButton)))), S.isHorizontal = function() {
				return "horizontal" === S.params.direction
			}, S.rtl = S.isHorizontal() && ("rtl" === S.container[0].dir.toLowerCase() || "rtl" === S.container.css("direction")), S.rtl && S.classNames.push(S.params.containerModifierClass + "rtl"), S.rtl && (S.wrongRTL = "-webkit-box" === S.wrapper.css("display")), S.params.slidesPerColumn > 1 && S.classNames.push(S.params.containerModifierClass + "multirow"), S.device.android && S.classNames.push(S.params.containerModifierClass + "android"), S.container.addClass(S.classNames.join(" ")), S.translate = 0, S.progress = 0, S.velocity = 0, S.lockSwipeToNext = function() {
				S.params.allowSwipeToNext = !1, S.params.allowSwipeToPrev === !1 && S.params.grabCursor && S.unsetGrabCursor()
			}, S.lockSwipeToPrev = function() {
				S.params.allowSwipeToPrev = !1, S.params.allowSwipeToNext === !1 && S.params.grabCursor && S.unsetGrabCursor()
			}, S.lockSwipes = function() {
				S.params.allowSwipeToNext = S.params.allowSwipeToPrev = !1, S.params.grabCursor && S.unsetGrabCursor()
			}, S.unlockSwipeToNext = function() {
				S.params.allowSwipeToNext = !0, S.params.allowSwipeToPrev === !0 && S.params.grabCursor && S.setGrabCursor()
			}, S.unlockSwipeToPrev = function() {
				S.params.allowSwipeToPrev = !0, S.params.allowSwipeToNext === !0 && S.params.grabCursor && S.setGrabCursor()
			}, S.unlockSwipes = function() {
				S.params.allowSwipeToNext = S.params.allowSwipeToPrev = !0, S.params.grabCursor && S.setGrabCursor()
			}, S.setGrabCursor = function(e) {
				S.container[0].style.cursor = "move", S.container[0].style.cursor = e ? "-webkit-grabbing" : "-webkit-grab", S.container[0].style.cursor = e ? "-moz-grabbin" : "-moz-grab", S.container[0].style.cursor = e ? "grabbing" : "grab"
			}, S.unsetGrabCursor = function() {
				S.container[0].style.cursor = ""
			}, S.params.grabCursor && S.setGrabCursor(), S.imagesToLoad = [], S.imagesLoaded = 0, S.loadImage = function(e, a, t, s, i, r) {
				function n() {
					r && r()
				}
				var o;
				e.complete && i ? n() : a ? (o = new window.Image, o.onload = n, o.onerror = n, s && (o.sizes = s), t && (o.srcset = t), a && (o.src = a)) : n()
			}, S.preloadImages = function() {
				function e() {
					"undefined" != typeof S && null !== S && (void 0 !== S.imagesLoaded && S.imagesLoaded++, S.imagesLoaded === S.imagesToLoad.length && (S.params.updateOnImagesReady && S.update(), S.emit("onImagesReady", S)))
				}
				S.imagesToLoad = S.container.find("img");
				for(var a = 0; a < S.imagesToLoad.length; a++) S.loadImage(S.imagesToLoad[a], S.imagesToLoad[a].currentSrc || S.imagesToLoad[a].getAttribute("src"), S.imagesToLoad[a].srcset || S.imagesToLoad[a].getAttribute("srcset"), S.imagesToLoad[a].sizes || S.imagesToLoad[a].getAttribute("sizes"), !0, e)
			}, S.autoplayTimeoutId = void 0, S.autoplaying = !1, S.autoplayPaused = !1, S.startAutoplay = function() {
				return "undefined" == typeof S.autoplayTimeoutId && (!!S.params.autoplay && (!S.autoplaying && (S.autoplaying = !0, S.emit("onAutoplayStart", S), void o())))
			}, S.stopAutoplay = function(e) {
				S.autoplayTimeoutId && (S.autoplayTimeoutId && clearTimeout(S.autoplayTimeoutId), S.autoplaying = !1, S.autoplayTimeoutId = void 0, S.emit("onAutoplayStop", S))
			}, S.pauseAutoplay = function(e) {
				S.autoplayPaused || (S.autoplayTimeoutId && clearTimeout(S.autoplayTimeoutId), S.autoplayPaused = !0, 0 === e ? (S.autoplayPaused = !1, o()) : S.wrapper.transitionEnd(function() {
					S && (S.autoplayPaused = !1, S.autoplaying ? o() : S.stopAutoplay())
				}))
			}, S.minTranslate = function() {
				return -S.snapGrid[0]
			}, S.maxTranslate = function() {
				return -S.snapGrid[S.snapGrid.length - 1]
			}, S.updateAutoHeight = function() {
				var e = [],
					a = 0;
				if("auto" !== S.params.slidesPerView && S.params.slidesPerView > 1)
					for(r = 0; r < Math.ceil(S.params.slidesPerView); r++) {
						var t = S.activeIndex + r;
						if(t > S.slides.length) break;
						e.push(S.slides.eq(t)[0])
					} else e.push(S.slides.eq(S.activeIndex)[0]);
				for(r = 0; r < e.length; r++)
					if("undefined" != typeof e[r]) {
						var s = e[r].offsetHeight;
						a = s > a ? s : a
					}
				a && S.wrapper.css("height", a + "px")
			}, S.updateContainerSize = function() {
				var e, a;
				e = "undefined" != typeof S.params.width ? S.params.width : S.container[0].clientWidth, a = "undefined" != typeof S.params.height ? S.params.height : S.container[0].clientHeight, 0 === e && S.isHorizontal() || 0 === a && !S.isHorizontal() || (e = e - parseInt(S.container.css("padding-left"), 10) - parseInt(S.container.css("padding-right"), 10), a = a - parseInt(S.container.css("padding-top"), 10) - parseInt(S.container.css("padding-bottom"), 10), S.width = e, S.height = a, S.size = S.isHorizontal() ? S.width : S.height)
			}, S.updateSlidesSize = function() {
				S.slides = S.wrapper.children("." + S.params.slideClass), S.snapGrid = [], S.slidesGrid = [], S.slidesSizesGrid = [];
				var e, a = S.params.spaceBetween,
					t = -S.params.slidesOffsetBefore,
					s = 0,
					i = 0;
				if("undefined" != typeof S.size) {
					"string" == typeof a && a.indexOf("%") >= 0 && (a = parseFloat(a.replace("%", "")) / 100 * S.size), S.virtualSize = -a, S.rtl ? S.slides.css({
						marginLeft: "",
						marginTop: ""
					}) : S.slides.css({
						marginRight: "",
						marginBottom: ""
					});
					var r;
					S.params.slidesPerColumn > 1 && (r = Math.floor(S.slides.length / S.params.slidesPerColumn) === S.slides.length / S.params.slidesPerColumn ? S.slides.length : Math.ceil(S.slides.length / S.params.slidesPerColumn) * S.params.slidesPerColumn, "auto" !== S.params.slidesPerView && "row" === S.params.slidesPerColumnFill && (r = Math.max(r, S.params.slidesPerView * S.params.slidesPerColumn)));
					var o, l = S.params.slidesPerColumn,
						p = r / l,
						d = p - (S.params.slidesPerColumn * p - S.slides.length);
					for(e = 0; e < S.slides.length; e++) {
						o = 0;
						var u = S.slides.eq(e);
						if(S.params.slidesPerColumn > 1) {
							var c, m, h;
							"column" === S.params.slidesPerColumnFill ? (m = Math.floor(e / l), h = e - m * l, (m > d || m === d && h === l - 1) && ++h >= l && (h = 0, m++), c = m + h * r / l, u.css({
								"-webkit-box-ordinal-group": c,
								"-moz-box-ordinal-group": c,
								"-ms-flex-order": c,
								"-webkit-order": c,
								order: c
							})) : (h = Math.floor(e / p), m = e - h * p), u.css("margin-" + (S.isHorizontal() ? "top" : "left"), 0 !== h && S.params.spaceBetween && S.params.spaceBetween + "px").attr("data-swiper-column", m).attr("data-swiper-row", h)
						}
						"none" !== u.css("display") && ("auto" === S.params.slidesPerView ? (o = S.isHorizontal() ? u.outerWidth(!0) : u.outerHeight(!0), S.params.roundLengths && (o = n(o))) : (o = (S.size - (S.params.slidesPerView - 1) * a) / S.params.slidesPerView, S.params.roundLengths && (o = n(o)), S.isHorizontal() ? S.slides[e].style.width = o + "px" : S.slides[e].style.height = o + "px"), S.slides[e].swiperSlideSize = o, S.slidesSizesGrid.push(o), S.params.centeredSlides ? (t = t + o / 2 + s / 2 + a, 0 === e && (t = t - S.size / 2 - a), Math.abs(t) < .001 && (t = 0), i % S.params.slidesPerGroup === 0 && S.snapGrid.push(t), S.slidesGrid.push(t)) : (i % S.params.slidesPerGroup === 0 && S.snapGrid.push(t), S.slidesGrid.push(t), t = t + o + a), S.virtualSize += o + a, s = o, i++)
					}
					S.virtualSize = Math.max(S.virtualSize, S.size) + S.params.slidesOffsetAfter;
					var g;
					if(S.rtl && S.wrongRTL && ("slide" === S.params.effect || "coverflow" === S.params.effect) && S.wrapper.css({
							width: S.virtualSize + S.params.spaceBetween + "px"
						}), S.support.flexbox && !S.params.setWrapperSize || (S.isHorizontal() ? S.wrapper.css({
							width: S.virtualSize + S.params.spaceBetween + "px"
						}) : S.wrapper.css({
							height: S.virtualSize + S.params.spaceBetween + "px"
						})), S.params.slidesPerColumn > 1 && (S.virtualSize = (o + S.params.spaceBetween) * r, S.virtualSize = Math.ceil(S.virtualSize / S.params.slidesPerColumn) - S.params.spaceBetween, S.isHorizontal() ? S.wrapper.css({
							width: S.virtualSize + S.params.spaceBetween + "px"
						}) : S.wrapper.css({
							height: S.virtualSize + S.params.spaceBetween + "px"
						}), S.params.centeredSlides)) {
						for(g = [], e = 0; e < S.snapGrid.length; e++) S.snapGrid[e] < S.virtualSize + S.snapGrid[0] && g.push(S.snapGrid[e]);
						S.snapGrid = g
					}
					if(!S.params.centeredSlides) {
						for(g = [], e = 0; e < S.snapGrid.length; e++) S.snapGrid[e] <= S.virtualSize - S.size && g.push(S.snapGrid[e]);
						S.snapGrid = g, Math.floor(S.virtualSize - S.size) - Math.floor(S.snapGrid[S.snapGrid.length - 1]) > 1 && S.snapGrid.push(S.virtualSize - S.size)
					}
					0 === S.snapGrid.length && (S.snapGrid = [0]), 0 !== S.params.spaceBetween && (S.isHorizontal() ? S.rtl ? S.slides.css({
						marginLeft: a + "px"
					}) : S.slides.css({
						marginRight: a + "px"
					}) : S.slides.css({
						marginBottom: a + "px"
					})), S.params.watchSlidesProgress && S.updateSlidesOffset()
				}
			}, S.updateSlidesOffset = function() {
				for(var e = 0; e < S.slides.length; e++) S.slides[e].swiperSlideOffset = S.isHorizontal() ? S.slides[e].offsetLeft : S.slides[e].offsetTop
			}, S.updateSlidesProgress = function(e) {
				if("undefined" == typeof e && (e = S.translate || 0), 0 !== S.slides.length) {
					"undefined" == typeof S.slides[0].swiperSlideOffset && S.updateSlidesOffset();
					var a = -e;
					S.rtl && (a = e), S.slides.removeClass(S.params.slideVisibleClass);
					for(var t = 0; t < S.slides.length; t++) {
						var s = S.slides[t],
							i = (a + (S.params.centeredSlides ? S.minTranslate() : 0) - s.swiperSlideOffset) / (s.swiperSlideSize + S.params.spaceBetween);
						if(S.params.watchSlidesVisibility) {
							var r = -(a - s.swiperSlideOffset),
								n = r + S.slidesSizesGrid[t],
								o = r >= 0 && r < S.size || n > 0 && n <= S.size || r <= 0 && n >= S.size;
							o && S.slides.eq(t).addClass(S.params.slideVisibleClass)
						}
						s.progress = S.rtl ? -i : i
					}
				}
			}, S.updateProgress = function(e) {
				"undefined" == typeof e && (e = S.translate || 0);
				var a = S.maxTranslate() - S.minTranslate(),
					t = S.isBeginning,
					s = S.isEnd;
				0 === a ? (S.progress = 0, S.isBeginning = S.isEnd = !0) : (S.progress = (e - S.minTranslate()) / a, S.isBeginning = S.progress <= 0, S.isEnd = S.progress >= 1), S.isBeginning && !t && S.emit("onReachBeginning", S), S.isEnd && !s && S.emit("onReachEnd", S), S.params.watchSlidesProgress && S.updateSlidesProgress(e), S.emit("onProgress", S, S.progress)
			}, S.updateActiveIndex = function() {
				var e, a, t, s = S.rtl ? S.translate : -S.translate;
				for(a = 0; a < S.slidesGrid.length; a++) "undefined" != typeof S.slidesGrid[a + 1] ? s >= S.slidesGrid[a] && s < S.slidesGrid[a + 1] - (S.slidesGrid[a + 1] - S.slidesGrid[a]) / 2 ? e = a : s >= S.slidesGrid[a] && s < S.slidesGrid[a + 1] && (e = a + 1) : s >= S.slidesGrid[a] && (e = a);
				S.params.normalizeSlideIndex && (e < 0 || "undefined" == typeof e) && (e = 0), t = Math.floor(e / S.params.slidesPerGroup), t >= S.snapGrid.length && (t = S.snapGrid.length - 1), e !== S.activeIndex && (S.snapIndex = t, S.previousIndex = S.activeIndex, S.activeIndex = e, S.updateClasses(), S.updateRealIndex())
			}, S.updateRealIndex = function() {
				S.realIndex = S.slides.eq(S.activeIndex).attr("data-swiper-slide-index") || S.activeIndex
			}, S.updateClasses = function() {
				S.slides.removeClass(S.params.slideActiveClass + " " + S.params.slideNextClass + " " + S.params.slidePrevClass + " " + S.params.slideDuplicateActiveClass + " " + S.params.slideDuplicateNextClass + " " + S.params.slideDuplicatePrevClass);
				var e = S.slides.eq(S.activeIndex);
				e.addClass(S.params.slideActiveClass), i.loop && (e.hasClass(S.params.slideDuplicateClass) ? S.wrapper.children("." + S.params.slideClass + ":not(." + S.params.slideDuplicateClass + ')[data-swiper-slide-index="' + S.realIndex + '"]').addClass(S.params.slideDuplicateActiveClass) : S.wrapper.children("." + S.params.slideClass + "." + S.params.slideDuplicateClass + '[data-swiper-slide-index="' + S.realIndex + '"]').addClass(S.params.slideDuplicateActiveClass));
				var t = e.next("." + S.params.slideClass).addClass(S.params.slideNextClass);
				S.params.loop && 0 === t.length && (t = S.slides.eq(0), t.addClass(S.params.slideNextClass));
				var s = e.prev("." + S.params.slideClass).addClass(S.params.slidePrevClass);
				if(S.params.loop && 0 === s.length && (s = S.slides.eq(-1), s.addClass(S.params.slidePrevClass)), i.loop && (t.hasClass(S.params.slideDuplicateClass) ? S.wrapper.children("." + S.params.slideClass + ":not(." + S.params.slideDuplicateClass + ')[data-swiper-slide-index="' + t.attr("data-swiper-slide-index") + '"]').addClass(S.params.slideDuplicateNextClass) : S.wrapper.children("." + S.params.slideClass + "." + S.params.slideDuplicateClass + '[data-swiper-slide-index="' + t.attr("data-swiper-slide-index") + '"]').addClass(S.params.slideDuplicateNextClass), s.hasClass(S.params.slideDuplicateClass) ? S.wrapper.children("." + S.params.slideClass + ":not(." + S.params.slideDuplicateClass + ')[data-swiper-slide-index="' + s.attr("data-swiper-slide-index") + '"]').addClass(S.params.slideDuplicatePrevClass) : S.wrapper.children("." + S.params.slideClass + "." + S.params.slideDuplicateClass + '[data-swiper-slide-index="' + s.attr("data-swiper-slide-index") + '"]').addClass(S.params.slideDuplicatePrevClass)), S.paginationContainer && S.paginationContainer.length > 0) {
					var r, n = S.params.loop ? Math.ceil((S.slides.length - 2 * S.loopedSlides) / S.params.slidesPerGroup) : S.snapGrid.length;
					if(S.params.loop ? (r = Math.ceil((S.activeIndex - S.loopedSlides) / S.params.slidesPerGroup), r > S.slides.length - 1 - 2 * S.loopedSlides && (r -= S.slides.length - 2 * S.loopedSlides), r > n - 1 && (r -= n), r < 0 && "bullets" !== S.params.paginationType && (r = n + r)) : r = "undefined" != typeof S.snapIndex ? S.snapIndex : S.activeIndex || 0, "bullets" === S.params.paginationType && S.bullets && S.bullets.length > 0 && (S.bullets.removeClass(S.params.bulletActiveClass), S.paginationContainer.length > 1 ? S.bullets.each(function() {
							a(this).index() === r && a(this).addClass(S.params.bulletActiveClass)
						}) : S.bullets.eq(r).addClass(S.params.bulletActiveClass)), "fraction" === S.params.paginationType && (S.paginationContainer.find("." + S.params.paginationCurrentClass).text(r + 1), S.paginationContainer.find("." + S.params.paginationTotalClass).text(n)), "progress" === S.params.paginationType) {
						var o = (r + 1) / n,
							l = o,
							p = 1;
						S.isHorizontal() || (p = o, l = 1), S.paginationContainer.find("." + S.params.paginationProgressbarClass).transform("translate3d(0,0,0) scaleX(" + l + ") scaleY(" + p + ")").transition(S.params.speed)
					}
					"custom" === S.params.paginationType && S.params.paginationCustomRender && (S.paginationContainer.html(S.params.paginationCustomRender(S, r + 1, n)), S.emit("onPaginationRendered", S, S.paginationContainer[0]))
				}
				S.params.loop || (S.params.prevButton && S.prevButton && S.prevButton.length > 0 && (S.isBeginning ? (S.prevButton.addClass(S.params.buttonDisabledClass), S.params.a11y && S.a11y && S.a11y.disable(S.prevButton)) : (S.prevButton.removeClass(S.params.buttonDisabledClass), S.params.a11y && S.a11y && S.a11y.enable(S.prevButton))), S.params.nextButton && S.nextButton && S.nextButton.length > 0 && (S.isEnd ? (S.nextButton.addClass(S.params.buttonDisabledClass), S.params.a11y && S.a11y && S.a11y.disable(S.nextButton)) : (S.nextButton.removeClass(S.params.buttonDisabledClass), S.params.a11y && S.a11y && S.a11y.enable(S.nextButton))))
			}, S.updatePagination = function() {
				if(S.params.pagination && S.paginationContainer && S.paginationContainer.length > 0) {
					var e = "";
					if("bullets" === S.params.paginationType) {
						for(var a = S.params.loop ? Math.ceil((S.slides.length - 2 * S.loopedSlides) / S.params.slidesPerGroup) : S.snapGrid.length, t = 0; t < a; t++) e += S.params.paginationBulletRender ? S.params.paginationBulletRender(S, t, S.params.bulletClass) : "<" + S.params.paginationElement + ' class="' + S.params.bulletClass + '"></' + S.params.paginationElement + ">";
						S.paginationContainer.html(e), S.bullets = S.paginationContainer.find("." + S.params.bulletClass), S.params.paginationClickable && S.params.a11y && S.a11y && S.a11y.initPagination()
					}
					"fraction" === S.params.paginationType && (e = S.params.paginationFractionRender ? S.params.paginationFractionRender(S, S.params.paginationCurrentClass, S.params.paginationTotalClass) : '<span class="' + S.params.paginationCurrentClass + '"></span> / <span class="' + S.params.paginationTotalClass + '"></span>', S.paginationContainer.html(e)), "progress" === S.params.paginationType && (e = S.params.paginationProgressRender ? S.params.paginationProgressRender(S, S.params.paginationProgressbarClass) : '<span class="' + S.params.paginationProgressbarClass + '"></span>', S.paginationContainer.html(e)), "custom" !== S.params.paginationType && S.emit("onPaginationRendered", S, S.paginationContainer[0])
				}
			}, S.update = function(e) {
				function a() {
					S.rtl ? -S.translate : S.translate;
					s = Math.min(Math.max(S.translate, S.maxTranslate()), S.minTranslate()), S.setWrapperTranslate(s), S.updateActiveIndex(), S.updateClasses()
				}
				if(S.updateContainerSize(), S.updateSlidesSize(), S.updateProgress(), S.updatePagination(), S.updateClasses(), S.params.scrollbar && S.scrollbar && S.scrollbar.set(), e) {
					var t, s;
					S.controller && S.controller.spline && (S.controller.spline = void 0), S.params.freeMode ? (a(), S.params.autoHeight && S.updateAutoHeight()) : (t = ("auto" === S.params.slidesPerView || S.params.slidesPerView > 1) && S.isEnd && !S.params.centeredSlides ? S.slideTo(S.slides.length - 1, 0, !1, !0) : S.slideTo(S.activeIndex, 0, !1, !0), t || a())
				} else S.params.autoHeight && S.updateAutoHeight()
			}, S.onResize = function(e) {
				S.params.breakpoints && S.setBreakpoint();
				var a = S.params.allowSwipeToPrev,
					t = S.params.allowSwipeToNext;
				S.params.allowSwipeToPrev = S.params.allowSwipeToNext = !0, S.updateContainerSize(), S.updateSlidesSize(), ("auto" === S.params.slidesPerView || S.params.freeMode || e) && S.updatePagination(), S.params.scrollbar && S.scrollbar && S.scrollbar.set(), S.controller && S.controller.spline && (S.controller.spline = void 0);
				var s = !1;
				if(S.params.freeMode) {
					var i = Math.min(Math.max(S.translate, S.maxTranslate()), S.minTranslate());
					S.setWrapperTranslate(i), S.updateActiveIndex(), S.updateClasses(), S.params.autoHeight && S.updateAutoHeight()
				} else S.updateClasses(), s = ("auto" === S.params.slidesPerView || S.params.slidesPerView > 1) && S.isEnd && !S.params.centeredSlides ? S.slideTo(S.slides.length - 1, 0, !1, !0) : S.slideTo(S.activeIndex, 0, !1, !0);
				S.params.lazyLoading && !s && S.lazy && S.lazy.load(), S.params.allowSwipeToPrev = a, S.params.allowSwipeToNext = t
			}, S.touchEventsDesktop = {
				start: "mousedown",
				move: "mousemove",
				end: "mouseup"
			}, window.navigator.pointerEnabled ? S.touchEventsDesktop = {
				start: "pointerdown",
				move: "pointermove",
				end: "pointerup"
			} : window.navigator.msPointerEnabled && (S.touchEventsDesktop = {
				start: "MSPointerDown",
				move: "MSPointerMove",
				end: "MSPointerUp"
			}), S.touchEvents = {
				start: S.support.touch || !S.params.simulateTouch ? "touchstart" : S.touchEventsDesktop.start,
				move: S.support.touch || !S.params.simulateTouch ? "touchmove" : S.touchEventsDesktop.move,
				end: S.support.touch || !S.params.simulateTouch ? "touchend" : S.touchEventsDesktop.end
			}, (window.navigator.pointerEnabled || window.navigator.msPointerEnabled) && ("container" === S.params.touchEventsTarget ? S.container : S.wrapper).addClass("swiper-wp8-" + S.params.direction), S.initEvents = function(e) {
				var a = e ? "off" : "on",
					t = e ? "removeEventListener" : "addEventListener",
					s = "container" === S.params.touchEventsTarget ? S.container[0] : S.wrapper[0],
					r = S.support.touch ? s : document,
					n = !!S.params.nested;
				if(S.browser.ie) s[t](S.touchEvents.start, S.onTouchStart, !1), r[t](S.touchEvents.move, S.onTouchMove, n), r[t](S.touchEvents.end, S.onTouchEnd, !1);
				else {
					if(S.support.touch) {
						var o = !("touchstart" !== S.touchEvents.start || !S.support.passiveListener || !S.params.passiveListeners) && {
							passive: !0,
							capture: !1
						};
						s[t](S.touchEvents.start, S.onTouchStart, o), s[t](S.touchEvents.move, S.onTouchMove, n), s[t](S.touchEvents.end, S.onTouchEnd, o)
					}(i.simulateTouch && !S.device.ios && !S.device.android || i.simulateTouch && !S.support.touch && S.device.ios) && (s[t]("mousedown", S.onTouchStart, !1), document[t]("mousemove", S.onTouchMove, n), document[t]("mouseup", S.onTouchEnd, !1))
				}
				window[t]("resize", S.onResize), S.params.nextButton && S.nextButton && S.nextButton.length > 0 && (S.nextButton[a]("click", S.onClickNext), S.params.a11y && S.a11y && S.nextButton[a]("keydown", S.a11y.onEnterKey)), S.params.prevButton && S.prevButton && S.prevButton.length > 0 && (S.prevButton[a]("click", S.onClickPrev), S.params.a11y && S.a11y && S.prevButton[a]("keydown", S.a11y.onEnterKey)), S.params.pagination && S.params.paginationClickable && (S.paginationContainer[a]("click", "." + S.params.bulletClass, S.onClickIndex), S.params.a11y && S.a11y && S.paginationContainer[a]("keydown", "." + S.params.bulletClass, S.a11y.onEnterKey)), (S.params.preventClicks || S.params.preventClicksPropagation) && s[t]("click", S.preventClicks, !0)
			}, S.attachEvents = function() {
				S.initEvents()
			}, S.detachEvents = function() {
				S.initEvents(!0)
			}, S.allowClick = !0, S.preventClicks = function(e) {
				S.allowClick || (S.params.preventClicks && e.preventDefault(), S.params.preventClicksPropagation && S.animating && (e.stopPropagation(), e.stopImmediatePropagation()))
			}, S.onClickNext = function(e) {
				e.preventDefault(), S.isEnd && !S.params.loop || S.slideNext()
			}, S.onClickPrev = function(e) {
				e.preventDefault(), S.isBeginning && !S.params.loop || S.slidePrev()
			}, S.onClickIndex = function(e) {
				e.preventDefault();
				var t = a(this).index() * S.params.slidesPerGroup;
				S.params.loop && (t += S.loopedSlides), S.slideTo(t)
			}, S.updateClickedSlide = function(e) {
				var t = l(e, "." + S.params.slideClass),
					s = !1;
				if(t)
					for(var i = 0; i < S.slides.length; i++) S.slides[i] === t && (s = !0);
				if(!t || !s) return S.clickedSlide = void 0, void(S.clickedIndex = void 0);
				if(S.clickedSlide = t, S.clickedIndex = a(t).index(), S.params.slideToClickedSlide && void 0 !== S.clickedIndex && S.clickedIndex !== S.activeIndex) {
					var r, n = S.clickedIndex;
					if(S.params.loop) {
						if(S.animating) return;
						r = a(S.clickedSlide).attr("data-swiper-slide-index"), S.params.centeredSlides ? n < S.loopedSlides - S.params.slidesPerView / 2 || n > S.slides.length - S.loopedSlides + S.params.slidesPerView / 2 ? (S.fixLoop(), n = S.wrapper.children("." + S.params.slideClass + '[data-swiper-slide-index="' + r + '"]:not(.' + S.params.slideDuplicateClass + ")").eq(0).index(), setTimeout(function() {
							S.slideTo(n)
						}, 0)) : S.slideTo(n) : n > S.slides.length - S.params.slidesPerView ? (S.fixLoop(), n = S.wrapper.children("." + S.params.slideClass + '[data-swiper-slide-index="' + r + '"]:not(.' + S.params.slideDuplicateClass + ")").eq(0).index(), setTimeout(function() {
							S.slideTo(n)
						}, 0)) : S.slideTo(n)
					} else S.slideTo(n)
				}
			};
			var z, M, E, P, I, k, L, D, B, H, G = "input, select, textarea, button, video",
				X = Date.now(),
				Y = [];
			S.animating = !1, S.touches = {
				startX: 0,
				startY: 0,
				currentX: 0,
				currentY: 0,
				diff: 0
			};
			var A, O;
			S.onTouchStart = function(e) {
				if(e.originalEvent && (e = e.originalEvent), A = "touchstart" === e.type, A || !("which" in e) || 3 !== e.which) {
					if(S.params.noSwiping && l(e, "." + S.params.noSwipingClass)) return void(S.allowClick = !0);
					if(!S.params.swipeHandler || l(e, S.params.swipeHandler)) {
						var t = S.touches.currentX = "touchstart" === e.type ? e.targetTouches[0].pageX : e.pageX,
							s = S.touches.currentY = "touchstart" === e.type ? e.targetTouches[0].pageY : e.pageY;
						if(!(S.device.ios && S.params.iOSEdgeSwipeDetection && t <= S.params.iOSEdgeSwipeThreshold)) {
							if(z = !0, M = !1, E = !0, I = void 0, O = void 0, S.touches.startX = t, S.touches.startY = s, P = Date.now(), S.allowClick = !0, S.updateContainerSize(), S.swipeDirection = void 0, S.params.threshold > 0 && (D = !1), "touchstart" !== e.type) {
								var i = !0;
								a(e.target).is(G) && (i = !1), document.activeElement && a(document.activeElement).is(G) && document.activeElement.blur(), i && e.preventDefault()
							}
							S.emit("onTouchStart", S, e)
						}
					}
				}
			}, S.onTouchMove = function(e) {
				if(e.originalEvent && (e = e.originalEvent), !A || "mousemove" !== e.type) {
					if(e.preventedByNestedSwiper) return S.touches.startX = "touchmove" === e.type ? e.targetTouches[0].pageX : e.pageX, void(S.touches.startY = "touchmove" === e.type ? e.targetTouches[0].pageY : e.pageY);
					if(S.params.onlyExternal) return S.allowClick = !1, void(z && (S.touches.startX = S.touches.currentX = "touchmove" === e.type ? e.targetTouches[0].pageX : e.pageX, S.touches.startY = S.touches.currentY = "touchmove" === e.type ? e.targetTouches[0].pageY : e.pageY, P = Date.now()));
					if(A && S.params.touchReleaseOnEdges && !S.params.loop)
						if(S.isHorizontal()) {
							if(S.touches.currentX < S.touches.startX && S.translate <= S.maxTranslate() || S.touches.currentX > S.touches.startX && S.translate >= S.minTranslate()) return
						} else if(S.touches.currentY < S.touches.startY && S.translate <= S.maxTranslate() || S.touches.currentY > S.touches.startY && S.translate >= S.minTranslate()) return;
					if(A && document.activeElement && e.target === document.activeElement && a(e.target).is(G)) return M = !0, void(S.allowClick = !1);
					if(E && S.emit("onTouchMove", S, e), !(e.targetTouches && e.targetTouches.length > 1)) {
						if(S.touches.currentX = "touchmove" === e.type ? e.targetTouches[0].pageX : e.pageX, S.touches.currentY = "touchmove" === e.type ? e.targetTouches[0].pageY : e.pageY, "undefined" == typeof I) {
							var t;
							S.isHorizontal() && S.touches.currentY === S.touches.startY || !S.isHorizontal() && S.touches.currentX !== S.touches.startX ? I = !1 : (t = 180 * Math.atan2(Math.abs(S.touches.currentY - S.touches.startY), Math.abs(S.touches.currentX - S.touches.startX)) / Math.PI, I = S.isHorizontal() ? t > S.params.touchAngle : 90 - t > S.params.touchAngle)
						}
						if(I && S.emit("onTouchMoveOpposite", S, e), "undefined" == typeof O && S.browser.ieTouch && (S.touches.currentX === S.touches.startX && S.touches.currentY === S.touches.startY || (O = !0)), z) {
							if(I) return void(z = !1);
							if(O || !S.browser.ieTouch) {
								S.allowClick = !1, S.emit("onSliderMove", S, e), e.preventDefault(), S.params.touchMoveStopPropagation && !S.params.nested && e.stopPropagation(), M || (i.loop && S.fixLoop(), L = S.getWrapperTranslate(), S.setWrapperTransition(0), S.animating && S.wrapper.trigger("webkitTransitionEnd transitionend oTransitionEnd MSTransitionEnd msTransitionEnd"), S.params.autoplay && S.autoplaying && (S.params.autoplayDisableOnInteraction ? S.stopAutoplay() : S.pauseAutoplay()), H = !1, !S.params.grabCursor || S.params.allowSwipeToNext !== !0 && S.params.allowSwipeToPrev !== !0 || S.setGrabCursor(!0)), M = !0;
								var s = S.touches.diff = S.isHorizontal() ? S.touches.currentX - S.touches.startX : S.touches.currentY - S.touches.startY;
								s *= S.params.touchRatio, S.rtl && (s = -s), S.swipeDirection = s > 0 ? "prev" : "next", k = s + L;
								var r = !0;
								if(s > 0 && k > S.minTranslate() ? (r = !1, S.params.resistance && (k = S.minTranslate() - 1 + Math.pow(-S.minTranslate() + L + s, S.params.resistanceRatio))) : s < 0 && k < S.maxTranslate() && (r = !1, S.params.resistance && (k = S.maxTranslate() + 1 - Math.pow(S.maxTranslate() - L - s, S.params.resistanceRatio))), r && (e.preventedByNestedSwiper = !0), !S.params.allowSwipeToNext && "next" === S.swipeDirection && k < L && (k = L), !S.params.allowSwipeToPrev && "prev" === S.swipeDirection && k > L && (k = L), S.params.threshold > 0) {
									if(!(Math.abs(s) > S.params.threshold || D)) return void(k = L);
									if(!D) return D = !0, S.touches.startX = S.touches.currentX, S.touches.startY = S.touches.currentY, k = L, void(S.touches.diff = S.isHorizontal() ? S.touches.currentX - S.touches.startX : S.touches.currentY - S.touches.startY)
								}
								S.params.followFinger && ((S.params.freeMode || S.params.watchSlidesProgress) && S.updateActiveIndex(), S.params.freeMode && (0 === Y.length && Y.push({
									position: S.touches[S.isHorizontal() ? "startX" : "startY"],
									time: P
								}), Y.push({
									position: S.touches[S.isHorizontal() ? "currentX" : "currentY"],
									time: (new window.Date).getTime()
								})), S.updateProgress(k), S.setWrapperTranslate(k))
							}
						}
					}
				}
			}, S.onTouchEnd = function(e) {
				if(e.originalEvent && (e = e.originalEvent), E && S.emit("onTouchEnd", S, e), E = !1, z) {
					S.params.grabCursor && M && z && (S.params.allowSwipeToNext === !0 || S.params.allowSwipeToPrev === !0) && S.setGrabCursor(!1);
					var t = Date.now(),
						s = t - P;
					if(S.allowClick && (S.updateClickedSlide(e), S.emit("onTap", S, e), s < 300 && t - X > 300 && (B && clearTimeout(B), B = setTimeout(function() {
							S && (S.params.paginationHide && S.paginationContainer.length > 0 && !a(e.target).hasClass(S.params.bulletClass) && S.paginationContainer.toggleClass(S.params.paginationHiddenClass), S.emit("onClick", S, e))
						}, 300)), s < 300 && t - X < 300 && (B && clearTimeout(B), S.emit("onDoubleTap", S, e))), X = Date.now(), setTimeout(function() {
							S && (S.allowClick = !0)
						}, 0), !z || !M || !S.swipeDirection || 0 === S.touches.diff || k === L) return void(z = M = !1);
					z = M = !1;
					var i;
					if(i = S.params.followFinger ? S.rtl ? S.translate : -S.translate : -k, S.params.freeMode) {
						if(i < -S.minTranslate()) return void S.slideTo(S.activeIndex);
						if(i > -S.maxTranslate()) return void(S.slides.length < S.snapGrid.length ? S.slideTo(S.snapGrid.length - 1) : S.slideTo(S.slides.length - 1));
						if(S.params.freeModeMomentum) {
							if(Y.length > 1) {
								var r = Y.pop(),
									n = Y.pop(),
									o = r.position - n.position,
									l = r.time - n.time;
								S.velocity = o / l, S.velocity = S.velocity / 2, Math.abs(S.velocity) < S.params.freeModeMinimumVelocity && (S.velocity = 0), (l > 150 || (new window.Date).getTime() - r.time > 300) && (S.velocity = 0)
							} else S.velocity = 0;
							S.velocity = S.velocity * S.params.freeModeMomentumVelocityRatio, Y.length = 0;
							var p = 1e3 * S.params.freeModeMomentumRatio,
								d = S.velocity * p,
								u = S.translate + d;
							S.rtl && (u = -u);
							var c, m = !1,
								h = 20 * Math.abs(S.velocity) * S.params.freeModeMomentumBounceRatio;
							if(u < S.maxTranslate()) S.params.freeModeMomentumBounce ? (u + S.maxTranslate() < -h && (u = S.maxTranslate() - h), c = S.maxTranslate(), m = !0, H = !0) : u = S.maxTranslate();
							else if(u > S.minTranslate()) S.params.freeModeMomentumBounce ? (u - S.minTranslate() > h && (u = S.minTranslate() + h), c = S.minTranslate(), m = !0, H = !0) : u = S.minTranslate();
							else if(S.params.freeModeSticky) {
								var g, f = 0;
								for(f = 0; f < S.snapGrid.length; f += 1)
									if(S.snapGrid[f] > -u) {
										g = f;
										break
									}
								u = Math.abs(S.snapGrid[g] - u) < Math.abs(S.snapGrid[g - 1] - u) || "next" === S.swipeDirection ? S.snapGrid[g] : S.snapGrid[g - 1], S.rtl || (u = -u)
							}
							if(0 !== S.velocity) p = S.rtl ? Math.abs((-u - S.translate) / S.velocity) : Math.abs((u - S.translate) / S.velocity);
							else if(S.params.freeModeSticky) return void S.slideReset();
							S.params.freeModeMomentumBounce && m ? (S.updateProgress(c), S.setWrapperTransition(p), S.setWrapperTranslate(u), S.onTransitionStart(), S.animating = !0, S.wrapper.transitionEnd(function() {
								S && H && (S.emit("onMomentumBounce", S), S.setWrapperTransition(S.params.speed), S.setWrapperTranslate(c), S.wrapper.transitionEnd(function() {
									S && S.onTransitionEnd()
								}))
							})) : S.velocity ? (S.updateProgress(u), S.setWrapperTransition(p), S.setWrapperTranslate(u), S.onTransitionStart(), S.animating || (S.animating = !0, S.wrapper.transitionEnd(function() {
								S && S.onTransitionEnd()
							}))) : S.updateProgress(u), S.updateActiveIndex()
						}
						return void((!S.params.freeModeMomentum || s >= S.params.longSwipesMs) && (S.updateProgress(), S.updateActiveIndex()))
					}
					var v, w = 0,
						y = S.slidesSizesGrid[0];
					for(v = 0; v < S.slidesGrid.length; v += S.params.slidesPerGroup) "undefined" != typeof S.slidesGrid[v + S.params.slidesPerGroup] ? i >= S.slidesGrid[v] && i < S.slidesGrid[v + S.params.slidesPerGroup] && (w = v, y = S.slidesGrid[v + S.params.slidesPerGroup] - S.slidesGrid[v]) : i >= S.slidesGrid[v] && (w = v, y = S.slidesGrid[S.slidesGrid.length - 1] - S.slidesGrid[S.slidesGrid.length - 2]);
					var x = (i - S.slidesGrid[w]) / y;
					if(s > S.params.longSwipesMs) {
						if(!S.params.longSwipes) return void S.slideTo(S.activeIndex);
						"next" === S.swipeDirection && (x >= S.params.longSwipesRatio ? S.slideTo(w + S.params.slidesPerGroup) : S.slideTo(w)), "prev" === S.swipeDirection && (x > 1 - S.params.longSwipesRatio ? S.slideTo(w + S.params.slidesPerGroup) : S.slideTo(w))
					} else {
						if(!S.params.shortSwipes) return void S.slideTo(S.activeIndex);
						"next" === S.swipeDirection && S.slideTo(w + S.params.slidesPerGroup), "prev" === S.swipeDirection && S.slideTo(w)
					}
				}
			}, S._slideTo = function(e, a) {
				return S.slideTo(e, a, !0, !0)
			}, S.slideTo = function(e, a, t, s) {
				"undefined" == typeof t && (t = !0), "undefined" == typeof e && (e = 0), e < 0 && (e = 0), S.snapIndex = Math.floor(e / S.params.slidesPerGroup), S.snapIndex >= S.snapGrid.length && (S.snapIndex = S.snapGrid.length - 1);
				var i = -S.snapGrid[S.snapIndex];
				if(S.params.autoplay && S.autoplaying && (s || !S.params.autoplayDisableOnInteraction ? S.pauseAutoplay(a) : S.stopAutoplay()), S.updateProgress(i), S.params.normalizeSlideIndex)
					for(var r = 0; r < S.slidesGrid.length; r++) - Math.floor(100 * i) >= Math.floor(100 * S.slidesGrid[r]) && (e = r);
				return !(!S.params.allowSwipeToNext && i < S.translate && i < S.minTranslate()) && (!(!S.params.allowSwipeToPrev && i > S.translate && i > S.maxTranslate() && (S.activeIndex || 0) !== e) && ("undefined" == typeof a && (a = S.params.speed), S.previousIndex = S.activeIndex || 0, S.activeIndex = e, S.updateRealIndex(), S.rtl && -i === S.translate || !S.rtl && i === S.translate ? (S.params.autoHeight && S.updateAutoHeight(), S.updateClasses(), "slide" !== S.params.effect && S.setWrapperTranslate(i), !1) : (S.updateClasses(), S.onTransitionStart(t), 0 === a || S.browser.lteIE9 ? (S.setWrapperTranslate(i), S.setWrapperTransition(0), S.onTransitionEnd(t)) : (S.setWrapperTranslate(i), S.setWrapperTransition(a), S.animating || (S.animating = !0, S.wrapper.transitionEnd(function() {
					S && S.onTransitionEnd(t)
				}))), !0)))
			}, S.onTransitionStart = function(e) {
				"undefined" == typeof e && (e = !0), S.params.autoHeight && S.updateAutoHeight(), S.lazy && S.lazy.onTransitionStart(), e && (S.emit("onTransitionStart", S), S.activeIndex !== S.previousIndex && (S.emit("onSlideChangeStart", S), S.activeIndex > S.previousIndex ? S.emit("onSlideNextStart", S) : S.emit("onSlidePrevStart", S)))
			}, S.onTransitionEnd = function(e) {
				S.animating = !1, S.setWrapperTransition(0), "undefined" == typeof e && (e = !0), S.lazy && S.lazy.onTransitionEnd(), e && (S.emit("onTransitionEnd", S), S.activeIndex !== S.previousIndex && (S.emit("onSlideChangeEnd", S), S.activeIndex > S.previousIndex ? S.emit("onSlideNextEnd", S) : S.emit("onSlidePrevEnd", S))), S.params.history && S.history && S.history.setHistory(S.params.history, S.activeIndex), S.params.hashnav && S.hashnav && S.hashnav.setHash()
			}, S.slideNext = function(e, a, t) {
				if(S.params.loop) {
					if(S.animating) return !1;
					S.fixLoop();
					S.container[0].clientLeft;
					return S.slideTo(S.activeIndex + S.params.slidesPerGroup, a, e, t)
				}
				return S.slideTo(S.activeIndex + S.params.slidesPerGroup, a, e, t)
			}, S._slideNext = function(e) {
				return S.slideNext(!0, e, !0)
			}, S.slidePrev = function(e, a, t) {
				if(S.params.loop) {
					if(S.animating) return !1;
					S.fixLoop();
					S.container[0].clientLeft;
					return S.slideTo(S.activeIndex - 1, a, e, t)
				}
				return S.slideTo(S.activeIndex - 1, a, e, t)
			}, S._slidePrev = function(e) {
				return S.slidePrev(!0, e, !0)
			}, S.slideReset = function(e, a, t) {
				return S.slideTo(S.activeIndex, a, e)
			}, S.disableTouchControl = function() {
				return S.params.onlyExternal = !0, !0
			}, S.enableTouchControl = function() {
				return S.params.onlyExternal = !1, !0
			}, S.setWrapperTransition = function(e, a) {
				S.wrapper.transition(e), "slide" !== S.params.effect && S.effects[S.params.effect] && S.effects[S.params.effect].setTransition(e), S.params.parallax && S.parallax && S.parallax.setTransition(e), S.params.scrollbar && S.scrollbar && S.scrollbar.setTransition(e), S.params.control && S.controller && S.controller.setTransition(e, a), S.emit("onSetTransition", S, e)
			}, S.setWrapperTranslate = function(e, a, t) {
				var s = 0,
					i = 0,
					r = 0;
				S.isHorizontal() ? s = S.rtl ? -e : e : i = e, S.params.roundLengths && (s = n(s), i = n(i)), S.params.virtualTranslate || (S.support.transforms3d ? S.wrapper.transform("translate3d(" + s + "px, " + i + "px, " + r + "px)") : S.wrapper.transform("translate(" + s + "px, " + i + "px)")), S.translate = S.isHorizontal() ? s : i;
				var o, l = S.maxTranslate() - S.minTranslate();
				o = 0 === l ? 0 : (e - S.minTranslate()) / l, o !== S.progress && S.updateProgress(e), a && S.updateActiveIndex(), "slide" !== S.params.effect && S.effects[S.params.effect] && S.effects[S.params.effect].setTranslate(S.translate), S.params.parallax && S.parallax && S.parallax.setTranslate(S.translate), S.params.scrollbar && S.scrollbar && S.scrollbar.setTranslate(S.translate), S.params.control && S.controller && S.controller.setTranslate(S.translate, t), S.emit("onSetTranslate", S, S.translate)
			}, S.getTranslate = function(e, a) {
				var t, s, i, r;
				return "undefined" == typeof a && (a = "x"), S.params.virtualTranslate ? S.rtl ? -S.translate : S.translate : (i = window.getComputedStyle(e, null), window.WebKitCSSMatrix ? (s = i.transform || i.webkitTransform, s.split(",").length > 6 && (s = s.split(", ").map(function(e) {
					return e.replace(",", ".")
				}).join(", ")), r = new window.WebKitCSSMatrix("none" === s ? "" : s)) : (r = i.MozTransform || i.OTransform || i.MsTransform || i.msTransform || i.transform || i.getPropertyValue("transform").replace("translate(", "matrix(1, 0, 0, 1,"), t = r.toString().split(",")), "x" === a && (s = window.WebKitCSSMatrix ? r.m41 : 16 === t.length ? parseFloat(t[12]) : parseFloat(t[4])), "y" === a && (s = window.WebKitCSSMatrix ? r.m42 : 16 === t.length ? parseFloat(t[13]) : parseFloat(t[5])), S.rtl && s && (s = -s), s || 0)
			}, S.getWrapperTranslate = function(e) {
				return "undefined" == typeof e && (e = S.isHorizontal() ? "x" : "y"), S.getTranslate(S.wrapper[0], e)
			}, S.observers = [], S.initObservers = function() {
				if(S.params.observeParents)
					for(var e = S.container.parents(), a = 0; a < e.length; a++) p(e[a]);
				p(S.container[0], {
					childList: !1
				}), p(S.wrapper[0], {
					attributes: !1
				})
			}, S.disconnectObservers = function() {
				for(var e = 0; e < S.observers.length; e++) S.observers[e].disconnect();
				S.observers = []
			}, S.createLoop = function() {
				S.wrapper.children("." + S.params.slideClass + "." + S.params.slideDuplicateClass).remove();
				var e = S.wrapper.children("." + S.params.slideClass);
				"auto" !== S.params.slidesPerView || S.params.loopedSlides || (S.params.loopedSlides = e.length), S.loopedSlides = parseInt(S.params.loopedSlides || S.params.slidesPerView, 10), S.loopedSlides = S.loopedSlides + S.params.loopAdditionalSlides, S.loopedSlides > e.length && (S.loopedSlides = e.length);
				var t, s = [],
					i = [];
				for(e.each(function(t, r) {
						var n = a(this);
						t < S.loopedSlides && i.push(r), t < e.length && t >= e.length - S.loopedSlides && s.push(r), n.attr("data-swiper-slide-index", t)
					}), t = 0; t < i.length; t++) S.wrapper.append(a(i[t].cloneNode(!0)).addClass(S.params.slideDuplicateClass));
				for(t = s.length - 1; t >= 0; t--) S.wrapper.prepend(a(s[t].cloneNode(!0)).addClass(S.params.slideDuplicateClass))
			}, S.destroyLoop = function() {
				S.wrapper.children("." + S.params.slideClass + "." + S.params.slideDuplicateClass).remove(), S.slides.removeAttr("data-swiper-slide-index")
			}, S.reLoop = function(e) {
				var a = S.activeIndex - S.loopedSlides;
				S.destroyLoop(), S.createLoop(), S.updateSlidesSize(), e && S.slideTo(a + S.loopedSlides, 0, !1)
			}, S.fixLoop = function() {
				var e;
				S.activeIndex < S.loopedSlides ? (e = S.slides.length - 3 * S.loopedSlides + S.activeIndex, e += S.loopedSlides, S.slideTo(e, 0, !1, !0)) : ("auto" === S.params.slidesPerView && S.activeIndex >= 2 * S.loopedSlides || S.activeIndex > S.slides.length - 2 * S.params.slidesPerView) && (e = -S.slides.length + S.activeIndex + S.loopedSlides, e += S.loopedSlides, S.slideTo(e, 0, !1, !0))
			}, S.appendSlide = function(e) {
				if(S.params.loop && S.destroyLoop(), "object" == typeof e && e.length)
					for(var a = 0; a < e.length; a++) e[a] && S.wrapper.append(e[a]);
				else S.wrapper.append(e);
				S.params.loop && S.createLoop(), S.params.observer && S.support.observer || S.update(!0)
			}, S.prependSlide = function(e) {
				S.params.loop && S.destroyLoop();
				var a = S.activeIndex + 1;
				if("object" == typeof e && e.length) {
					for(var t = 0; t < e.length; t++) e[t] && S.wrapper.prepend(e[t]);
					a = S.activeIndex + e.length
				} else S.wrapper.prepend(e);
				S.params.loop && S.createLoop(), S.params.observer && S.support.observer || S.update(!0), S.slideTo(a, 0, !1)
			}, S.removeSlide = function(e) {
				S.params.loop && (S.destroyLoop(), S.slides = S.wrapper.children("." + S.params.slideClass));
				var a, t = S.activeIndex;
				if("object" == typeof e && e.length) {
					for(var s = 0; s < e.length; s++) a = e[s], S.slides[a] && S.slides.eq(a).remove(), a < t && t--;
					t = Math.max(t, 0)
				} else a = e, S.slides[a] && S.slides.eq(a).remove(), a < t && t--, t = Math.max(t, 0);
				S.params.loop && S.createLoop(), S.params.observer && S.support.observer || S.update(!0), S.params.loop ? S.slideTo(t + S.loopedSlides, 0, !1) : S.slideTo(t, 0, !1)
			}, S.removeAllSlides = function() {
				for(var e = [], a = 0; a < S.slides.length; a++) e.push(a);
				S.removeSlide(e)
			}, S.effects = {
				fade: {
					setTranslate: function() {
						for(var e = 0; e < S.slides.length; e++) {
							var a = S.slides.eq(e),
								t = a[0].swiperSlideOffset,
								s = -t;
							S.params.virtualTranslate || (s -= S.translate);
							var i = 0;
							S.isHorizontal() || (i = s, s = 0);
							var r = S.params.fade.crossFade ? Math.max(1 - Math.abs(a[0].progress), 0) : 1 + Math.min(Math.max(a[0].progress, -1), 0);
							a.css({
								opacity: r
							}).transform("translate3d(" + s + "px, " + i + "px, 0px)")
						}
					},
					setTransition: function(e) {
						if(S.slides.transition(e), S.params.virtualTranslate && 0 !== e) {
							var a = !1;
							S.slides.transitionEnd(function() {
								if(!a && S) {
									a = !0, S.animating = !1;
									for(var e = ["webkitTransitionEnd", "transitionend", "oTransitionEnd", "MSTransitionEnd", "msTransitionEnd"], t = 0; t < e.length; t++) S.wrapper.trigger(e[t])
								}
							})
						}
					}
				},
				flip: {
					setTranslate: function() {
						for(var e = 0; e < S.slides.length; e++) {
							var t = S.slides.eq(e),
								s = t[0].progress;
							S.params.flip.limitRotation && (s = Math.max(Math.min(t[0].progress, 1), -1));
							var i = t[0].swiperSlideOffset,
								r = -180 * s,
								n = r,
								o = 0,
								l = -i,
								p = 0;
							if(S.isHorizontal() ? S.rtl && (n = -n) : (p = l, l = 0, o = -n, n = 0), t[0].style.zIndex = -Math.abs(Math.round(s)) + S.slides.length, S.params.flip.slideShadows) {
								var d = S.isHorizontal() ? t.find(".swiper-slide-shadow-left") : t.find(".swiper-slide-shadow-top"),
									u = S.isHorizontal() ? t.find(".swiper-slide-shadow-right") : t.find(".swiper-slide-shadow-bottom");
								0 === d.length && (d = a('<div class="swiper-slide-shadow-' + (S.isHorizontal() ? "left" : "top") + '"></div>'), t.append(d)), 0 === u.length && (u = a('<div class="swiper-slide-shadow-' + (S.isHorizontal() ? "right" : "bottom") + '"></div>'), t.append(u)), d.length && (d[0].style.opacity = Math.max(-s, 0)), u.length && (u[0].style.opacity = Math.max(s, 0))
							}
							t.transform("translate3d(" + l + "px, " + p + "px, 0px) rotateX(" + o + "deg) rotateY(" + n + "deg)")
						}
					},
					setTransition: function(e) {
						if(S.slides.transition(e).find(".swiper-slide-shadow-top, .swiper-slide-shadow-right, .swiper-slide-shadow-bottom, .swiper-slide-shadow-left").transition(e), S.params.virtualTranslate && 0 !== e) {
							var t = !1;
							S.slides.eq(S.activeIndex).transitionEnd(function() {
								if(!t && S && a(this).hasClass(S.params.slideActiveClass)) {
									t = !0, S.animating = !1;
									for(var e = ["webkitTransitionEnd", "transitionend", "oTransitionEnd", "MSTransitionEnd", "msTransitionEnd"], s = 0; s < e.length; s++) S.wrapper.trigger(e[s])
								}
							})
						}
					}
				},
				cube: {
					setTranslate: function() {
						var e, t = 0;
						S.params.cube.shadow && (S.isHorizontal() ? (e = S.wrapper.find(".swiper-cube-shadow"), 0 === e.length && (e = a('<div class="swiper-cube-shadow"></div>'), S.wrapper.append(e)), e.css({
							height: S.width + "px"
						})) : (e = S.container.find(".swiper-cube-shadow"), 0 === e.length && (e = a('<div class="swiper-cube-shadow"></div>'), S.container.append(e))));
						for(var s = 0; s < S.slides.length; s++) {
							var i = S.slides.eq(s),
								r = 90 * s,
								n = Math.floor(r / 360);
							S.rtl && (r = -r, n = Math.floor(-r / 360));
							var o = Math.max(Math.min(i[0].progress, 1), -1),
								l = 0,
								p = 0,
								d = 0;
							s % 4 === 0 ? (l = 4 * -n * S.size, d = 0) : (s - 1) % 4 === 0 ? (l = 0, d = 4 * -n * S.size) : (s - 2) % 4 === 0 ? (l = S.size + 4 * n * S.size, d = S.size) : (s - 3) % 4 === 0 && (l = -S.size, d = 3 * S.size + 4 * S.size * n), S.rtl && (l = -l), S.isHorizontal() || (p = l, l = 0);
							var u = "rotateX(" + (S.isHorizontal() ? 0 : -r) + "deg) rotateY(" + (S.isHorizontal() ? r : 0) + "deg) translate3d(" + l + "px, " + p + "px, " + d + "px)";
							if(o <= 1 && o > -1 && (t = 90 * s + 90 * o, S.rtl && (t = 90 * -s - 90 * o)), i.transform(u), S.params.cube.slideShadows) {
								var c = S.isHorizontal() ? i.find(".swiper-slide-shadow-left") : i.find(".swiper-slide-shadow-top"),
									m = S.isHorizontal() ? i.find(".swiper-slide-shadow-right") : i.find(".swiper-slide-shadow-bottom");
								0 === c.length && (c = a('<div class="swiper-slide-shadow-' + (S.isHorizontal() ? "left" : "top") + '"></div>'), i.append(c)), 0 === m.length && (m = a('<div class="swiper-slide-shadow-' + (S.isHorizontal() ? "right" : "bottom") + '"></div>'), i.append(m)), c.length && (c[0].style.opacity = Math.max(-o, 0)), m.length && (m[0].style.opacity = Math.max(o, 0))
							}
						}
						if(S.wrapper.css({
								"-webkit-transform-origin": "50% 50% -" + S.size / 2 + "px",
								"-moz-transform-origin": "50% 50% -" + S.size / 2 + "px",
								"-ms-transform-origin": "50% 50% -" + S.size / 2 + "px",
								"transform-origin": "50% 50% -" + S.size / 2 + "px"
							}), S.params.cube.shadow)
							if(S.isHorizontal()) e.transform("translate3d(0px, " + (S.width / 2 + S.params.cube.shadowOffset) + "px, " + -S.width / 2 + "px) rotateX(90deg) rotateZ(0deg) scale(" + S.params.cube.shadowScale + ")");
							else {
								var h = Math.abs(t) - 90 * Math.floor(Math.abs(t) / 90),
									g = 1.5 - (Math.sin(2 * h * Math.PI / 360) / 2 + Math.cos(2 * h * Math.PI / 360) / 2),
									f = S.params.cube.shadowScale,
									v = S.params.cube.shadowScale / g,
									w = S.params.cube.shadowOffset;
								e.transform("scale3d(" + f + ", 1, " + v + ") translate3d(0px, " + (S.height / 2 + w) + "px, " + -S.height / 2 / v + "px) rotateX(-90deg)")
							}
						var y = S.isSafari || S.isUiWebView ? -S.size / 2 : 0;
						S.wrapper.transform("translate3d(0px,0," + y + "px) rotateX(" + (S.isHorizontal() ? 0 : t) + "deg) rotateY(" + (S.isHorizontal() ? -t : 0) + "deg)")
					},
					setTransition: function(e) {
						S.slides.transition(e).find(".swiper-slide-shadow-top, .swiper-slide-shadow-right, .swiper-slide-shadow-bottom, .swiper-slide-shadow-left").transition(e), S.params.cube.shadow && !S.isHorizontal() && S.container.find(".swiper-cube-shadow").transition(e)
					}
				},
				coverflow: {
					setTranslate: function() {
						for(var e = S.translate, t = S.isHorizontal() ? -e + S.width / 2 : -e + S.height / 2, s = S.isHorizontal() ? S.params.coverflow.rotate : -S.params.coverflow.rotate, i = S.params.coverflow.depth, r = 0, n = S.slides.length; r < n; r++) {
							var o = S.slides.eq(r),
								l = S.slidesSizesGrid[r],
								p = o[0].swiperSlideOffset,
								d = (t - p - l / 2) / l * S.params.coverflow.modifier,
								u = S.isHorizontal() ? s * d : 0,
								c = S.isHorizontal() ? 0 : s * d,
								m = -i * Math.abs(d),
								h = S.isHorizontal() ? 0 : S.params.coverflow.stretch * d,
								g = S.isHorizontal() ? S.params.coverflow.stretch * d : 0;
							Math.abs(g) < .001 && (g = 0), Math.abs(h) < .001 && (h = 0), Math.abs(m) < .001 && (m = 0), Math.abs(u) < .001 && (u = 0), Math.abs(c) < .001 && (c = 0);
							var f = "translate3d(" + g + "px," + h + "px," + m + "px)  rotateX(" + c + "deg) rotateY(" + u + "deg)";
							if(o.transform(f), o[0].style.zIndex = -Math.abs(Math.round(d)) + 1, S.params.coverflow.slideShadows) {
								var v = S.isHorizontal() ? o.find(".swiper-slide-shadow-left") : o.find(".swiper-slide-shadow-top"),
									w = S.isHorizontal() ? o.find(".swiper-slide-shadow-right") : o.find(".swiper-slide-shadow-bottom");
								0 === v.length && (v = a('<div class="swiper-slide-shadow-' + (S.isHorizontal() ? "left" : "top") + '"></div>'), o.append(v)), 0 === w.length && (w = a('<div class="swiper-slide-shadow-' + (S.isHorizontal() ? "right" : "bottom") + '"></div>'), o.append(w)), v.length && (v[0].style.opacity = d > 0 ? d : 0), w.length && (w[0].style.opacity = -d > 0 ? -d : 0)
							}
						}
						if(S.browser.ie) {
							var y = S.wrapper[0].style;
							y.perspectiveOrigin = t + "px 50%"
						}
					},
					setTransition: function(e) {
						S.slides.transition(e).find(".swiper-slide-shadow-top, .swiper-slide-shadow-right, .swiper-slide-shadow-bottom, .swiper-slide-shadow-left").transition(e)
					}
				}
			}, S.lazy = {
				initialImageLoaded: !1,
				loadImageInSlide: function(e, t) {
					if("undefined" != typeof e && ("undefined" == typeof t && (t = !0), 0 !== S.slides.length)) {
						var s = S.slides.eq(e),
							i = s.find("." + S.params.lazyLoadingClass + ":not(." + S.params.lazyStatusLoadedClass + "):not(." + S.params.lazyStatusLoadingClass + ")");
						!s.hasClass(S.params.lazyLoadingClass) || s.hasClass(S.params.lazyStatusLoadedClass) || s.hasClass(S.params.lazyStatusLoadingClass) || (i = i.add(s[0])), 0 !== i.length && i.each(function() {
							var e = a(this);
							e.addClass(S.params.lazyStatusLoadingClass);
							var i = e.attr("data-background"),
								r = e.attr("data-src"),
								n = e.attr("data-srcset"),
								o = e.attr("data-sizes");
							S.loadImage(e[0], r || i, n, o, !1, function() {
								if(i ? (e.css("background-image", 'url("' + i + '")'), e.removeAttr("data-background")) : (n && (e.attr("srcset", n), e.removeAttr("data-srcset")), o && (e.attr("sizes", o), e.removeAttr("data-sizes")), r && (e.attr("src", r), e.removeAttr("data-src"))), e.addClass(S.params.lazyStatusLoadedClass).removeClass(S.params.lazyStatusLoadingClass), s.find("." + S.params.lazyPreloaderClass + ", ." + S.params.preloaderClass).remove(), S.params.loop && t) {
									var a = s.attr("data-swiper-slide-index");
									if(s.hasClass(S.params.slideDuplicateClass)) {
										var l = S.wrapper.children('[data-swiper-slide-index="' + a + '"]:not(.' + S.params.slideDuplicateClass + ")");
										S.lazy.loadImageInSlide(l.index(), !1)
									} else {
										var p = S.wrapper.children("." + S.params.slideDuplicateClass + '[data-swiper-slide-index="' + a + '"]');
										S.lazy.loadImageInSlide(p.index(), !1)
									}
								}
								S.emit("onLazyImageReady", S, s[0], e[0])
							}), S.emit("onLazyImageLoad", S, s[0], e[0])
						})
					}
				},
				load: function() {
					var e, t = S.params.slidesPerView;
					if("auto" === t && (t = 0), S.lazy.initialImageLoaded || (S.lazy.initialImageLoaded = !0), S.params.watchSlidesVisibility) S.wrapper.children("." + S.params.slideVisibleClass).each(function() {
						S.lazy.loadImageInSlide(a(this).index())
					});
					else if(t > 1)
						for(e = S.activeIndex; e < S.activeIndex + t; e++) S.slides[e] && S.lazy.loadImageInSlide(e);
					else S.lazy.loadImageInSlide(S.activeIndex);
					if(S.params.lazyLoadingInPrevNext)
						if(t > 1 || S.params.lazyLoadingInPrevNextAmount && S.params.lazyLoadingInPrevNextAmount > 1) {
							var s = S.params.lazyLoadingInPrevNextAmount,
								i = t,
								r = Math.min(S.activeIndex + i + Math.max(s, i), S.slides.length),
								n = Math.max(S.activeIndex - Math.max(i, s), 0);
							for(e = S.activeIndex + t; e < r; e++) S.slides[e] && S.lazy.loadImageInSlide(e);
							for(e = n; e < S.activeIndex; e++) S.slides[e] && S.lazy.loadImageInSlide(e)
						} else {
							var o = S.wrapper.children("." + S.params.slideNextClass);
							o.length > 0 && S.lazy.loadImageInSlide(o.index());
							var l = S.wrapper.children("." + S.params.slidePrevClass);
							l.length > 0 && S.lazy.loadImageInSlide(l.index())
						}
				},
				onTransitionStart: function() {
					S.params.lazyLoading && (S.params.lazyLoadingOnTransitionStart || !S.params.lazyLoadingOnTransitionStart && !S.lazy.initialImageLoaded) && S.lazy.load()
				},
				onTransitionEnd: function() {
					S.params.lazyLoading && !S.params.lazyLoadingOnTransitionStart && S.lazy.load()
				}
			}, S.scrollbar = {
				isTouched: !1,
				setDragPosition: function(e) {
					var a = S.scrollbar,
						t = S.isHorizontal() ? "touchstart" === e.type || "touchmove" === e.type ? e.targetTouches[0].pageX : e.pageX || e.clientX : "touchstart" === e.type || "touchmove" === e.type ? e.targetTouches[0].pageY : e.pageY || e.clientY,
						s = t - a.track.offset()[S.isHorizontal() ? "left" : "top"] - a.dragSize / 2,
						i = -S.minTranslate() * a.moveDivider,
						r = -S.maxTranslate() * a.moveDivider;
					s < i ? s = i : s > r && (s = r), s = -s / a.moveDivider, S.updateProgress(s), S.setWrapperTranslate(s, !0)
				},
				dragStart: function(e) {
					var a = S.scrollbar;
					a.isTouched = !0, e.preventDefault(), e.stopPropagation(), a.setDragPosition(e), clearTimeout(a.dragTimeout), a.track.transition(0), S.params.scrollbarHide && a.track.css("opacity", 1), S.wrapper.transition(100), a.drag.transition(100), S.emit("onScrollbarDragStart", S)
				},
				dragMove: function(e) {
					var a = S.scrollbar;
					a.isTouched && (e.preventDefault ? e.preventDefault() : e.returnValue = !1, a.setDragPosition(e), S.wrapper.transition(0), a.track.transition(0), a.drag.transition(0), S.emit("onScrollbarDragMove", S))
				},
				dragEnd: function(e) {
					var a = S.scrollbar;
					a.isTouched && (a.isTouched = !1, S.params.scrollbarHide && (clearTimeout(a.dragTimeout), a.dragTimeout = setTimeout(function() {
						a.track.css("opacity", 0), a.track.transition(400)
					}, 1e3)), S.emit("onScrollbarDragEnd", S), S.params.scrollbarSnapOnRelease && S.slideReset())
				},
				draggableEvents: function() {
					return S.params.simulateTouch !== !1 || S.support.touch ? S.touchEvents : S.touchEventsDesktop
				}(),
				enableDraggable: function() {
					var e = S.scrollbar,
						t = S.support.touch ? e.track : document;
					a(e.track).on(e.draggableEvents.start, e.dragStart), a(t).on(e.draggableEvents.move, e.dragMove), a(t).on(e.draggableEvents.end, e.dragEnd)
				},
				disableDraggable: function() {
					var e = S.scrollbar,
						t = S.support.touch ? e.track : document;
					a(e.track).off(S.draggableEvents.start, e.dragStart), a(t).off(S.draggableEvents.move, e.dragMove), a(t).off(S.draggableEvents.end, e.dragEnd)
				},
				set: function() {
					if(S.params.scrollbar) {
						var e = S.scrollbar;
						e.track = a(S.params.scrollbar), S.params.uniqueNavElements && "string" == typeof S.params.scrollbar && e.track.length > 1 && 1 === S.container.find(S.params.scrollbar).length && (e.track = S.container.find(S.params.scrollbar)), e.drag = e.track.find(".swiper-scrollbar-drag"), 0 === e.drag.length && (e.drag = a('<div class="swiper-scrollbar-drag"></div>'), e.track.append(e.drag)), e.drag[0].style.width = "", e.drag[0].style.height = "", e.trackSize = S.isHorizontal() ? e.track[0].offsetWidth : e.track[0].offsetHeight, e.divider = S.size / S.virtualSize, e.moveDivider = e.divider * (e.trackSize / S.size), e.dragSize = e.trackSize * e.divider, S.isHorizontal() ? e.drag[0].style.width = e.dragSize + "px" : e.drag[0].style.height = e.dragSize + "px", e.divider >= 1 ? e.track[0].style.display = "none" : e.track[0].style.display = "", S.params.scrollbarHide && (e.track[0].style.opacity = 0)
					}
				},
				setTranslate: function() {
					if(S.params.scrollbar) {
						var e, a = S.scrollbar,
							t = (S.translate || 0, a.dragSize);
						e = (a.trackSize - a.dragSize) * S.progress, S.rtl && S.isHorizontal() ? (e = -e, e > 0 ? (t = a.dragSize - e, e = 0) : -e + a.dragSize > a.trackSize && (t = a.trackSize + e)) : e < 0 ? (t = a.dragSize + e, e = 0) : e + a.dragSize > a.trackSize && (t = a.trackSize - e), S.isHorizontal() ? (S.support.transforms3d ? a.drag.transform("translate3d(" + e + "px, 0, 0)") : a.drag.transform("translateX(" + e + "px)"), a.drag[0].style.width = t + "px") : (S.support.transforms3d ? a.drag.transform("translate3d(0px, " + e + "px, 0)") : a.drag.transform("translateY(" + e + "px)"), a.drag[0].style.height = t + "px"), S.params.scrollbarHide && (clearTimeout(a.timeout), a.track[0].style.opacity = 1, a.timeout = setTimeout(function() {
							a.track[0].style.opacity = 0, a.track.transition(400)
						}, 1e3))
					}
				},
				setTransition: function(e) {
					S.params.scrollbar && S.scrollbar.drag.transition(e)
				}
			}, S.controller = {
				LinearSpline: function(e, a) {
					this.x = e, this.y = a, this.lastIndex = e.length - 1;
					var t, s;
					this.x.length;
					this.interpolate = function(e) {
						return e ? (s = i(this.x, e), t = s - 1, (e - this.x[t]) * (this.y[s] - this.y[t]) / (this.x[s] - this.x[t]) + this.y[t]) : 0
					};
					var i = function() {
						var e, a, t;
						return function(s, i) {
							for(a = -1, e = s.length; e - a > 1;) s[t = e + a >> 1] <= i ? a = t : e = t;
							return e
						}
					}()
				},
				getInterpolateFunction: function(e) {
					S.controller.spline || (S.controller.spline = S.params.loop ? new S.controller.LinearSpline(S.slidesGrid, e.slidesGrid) : new S.controller.LinearSpline(S.snapGrid, e.snapGrid))
				},
				setTranslate: function(e, a) {
					function s(a) {
						e = a.rtl && "horizontal" === a.params.direction ? -S.translate : S.translate, "slide" === S.params.controlBy && (S.controller.getInterpolateFunction(a), r = -S.controller.spline.interpolate(-e)), r && "container" !== S.params.controlBy || (i = (a.maxTranslate() - a.minTranslate()) / (S.maxTranslate() - S.minTranslate()), r = (e - S.minTranslate()) * i + a.minTranslate()), S.params.controlInverse && (r = a.maxTranslate() - r), a.updateProgress(r), a.setWrapperTranslate(r, !1, S), a.updateActiveIndex()
					}
					var i, r, n = S.params.control;
					if(S.isArray(n))
						for(var o = 0; o < n.length; o++) n[o] !== a && n[o] instanceof t && s(n[o]);
					else n instanceof t && a !== n && s(n)
				},
				setTransition: function(e, a) {
					function s(a) {
						a.setWrapperTransition(e, S), 0 !== e && (a.onTransitionStart(), a.wrapper.transitionEnd(function() {
							r && (a.params.loop && "slide" === S.params.controlBy && a.fixLoop(), a.onTransitionEnd())
						}))
					}
					var i, r = S.params.control;
					if(S.isArray(r))
						for(i = 0; i < r.length; i++) r[i] !== a && r[i] instanceof t && s(r[i]);
					else r instanceof t && a !== r && s(r)
				}
			}, S.hashnav = {
				onHashCange: function(e, a) {
					var t = document.location.hash.replace("#", ""),
						s = S.slides.eq(S.activeIndex).attr("data-hash");
					t !== s && S.slideTo(S.wrapper.children("." + S.params.slideClass + '[data-hash="' + t + '"]').index());
				},
				attachEvents: function(e) {
					var t = e ? "off" : "on";
					a(window)[t]("hashchange", S.hashnav.onHashCange)
				},
				setHash: function() {
					if(S.hashnav.initialized && S.params.hashnav)
						if(S.params.replaceState && window.history && window.history.replaceState) window.history.replaceState(null, null, "#" + S.slides.eq(S.activeIndex).attr("data-hash") || "");
						else {
							var e = S.slides.eq(S.activeIndex),
								a = e.attr("data-hash") || e.attr("data-history");
							document.location.hash = a || ""
						}
				},
				init: function() {
					if(S.params.hashnav && !S.params.history) {
						S.hashnav.initialized = !0;
						var e = document.location.hash.replace("#", "");
						if(e) {
							for(var a = 0, t = 0, s = S.slides.length; t < s; t++) {
								var i = S.slides.eq(t),
									r = i.attr("data-hash") || i.attr("data-history");
								if(r === e && !i.hasClass(S.params.slideDuplicateClass)) {
									var n = i.index();
									S.slideTo(n, a, S.params.runCallbacksOnInit, !0)
								}
							}
							S.params.hashnavWatchState && S.hashnav.attachEvents()
						}
					}
				},
				destroy: function() {
					S.params.hashnavWatchState && S.hashnav.attachEvents(!0)
				}
			}, S.history = {
				init: function() {
					if(S.params.history) {
						if(!window.history || !window.history.pushState) return S.params.history = !1, void(S.params.hashnav = !0);
						S.history.initialized = !0, this.paths = this.getPathValues(), (this.paths.key || this.paths.value) && (this.scrollToSlide(0, this.paths.value, S.params.runCallbacksOnInit), S.params.replaceState || window.addEventListener("popstate", this.setHistoryPopState))
					}
				},
				setHistoryPopState: function() {
					S.history.paths = S.history.getPathValues(), S.history.scrollToSlide(S.params.speed, S.history.paths.value, !1)
				},
				getPathValues: function() {
					var e = window.location.pathname.slice(1).split("/"),
						a = e.length,
						t = e[a - 2],
						s = e[a - 1];
					return {
						key: t,
						value: s
					}
				},
				setHistory: function(e, a) {
					if(S.history.initialized && S.params.history) {
						var t = S.slides.eq(a),
							s = this.slugify(t.attr("data-history"));
						window.location.pathname.includes(e) || (s = e + "/" + s), S.params.replaceState ? window.history.replaceState(null, null, s) : window.history.pushState(null, null, s)
					}
				},
				slugify: function(e) {
					return e.toString().toLowerCase().replace(/\s+/g, "-").replace(/[^\w\-]+/g, "").replace(/\-\-+/g, "-").replace(/^-+/, "").replace(/-+$/, "")
				},
				scrollToSlide: function(e, a, t) {
					if(a)
						for(var s = 0, i = S.slides.length; s < i; s++) {
							var r = S.slides.eq(s),
								n = this.slugify(r.attr("data-history"));
							if(n === a && !r.hasClass(S.params.slideDuplicateClass)) {
								var o = r.index();
								S.slideTo(o, e, t)
							}
						} else S.slideTo(0, e, t)
				}
			}, S.disableKeyboardControl = function() {
				S.params.keyboardControl = !1, a(document).off("keydown", d)
			}, S.enableKeyboardControl = function() {
				S.params.keyboardControl = !0, a(document).on("keydown", d)
			}, S.mousewheel = {
				event: !1,
				lastScrollTime: (new window.Date).getTime()
			}, S.params.mousewheelControl && (S.mousewheel.event = navigator.userAgent.indexOf("firefox") > -1 ? "DOMMouseScroll" : u() ? "wheel" : "mousewheel"), S.disableMousewheelControl = function() {
				if(!S.mousewheel.event) return !1;
				var e = S.container;
				return "container" !== S.params.mousewheelEventsTarged && (e = a(S.params.mousewheelEventsTarged)), e.off(S.mousewheel.event, c), !0
			}, S.enableMousewheelControl = function() {
				if(!S.mousewheel.event) return !1;
				var e = S.container;
				return "container" !== S.params.mousewheelEventsTarged && (e = a(S.params.mousewheelEventsTarged)), e.on(S.mousewheel.event, c), !0
			}, S.parallax = {
				setTranslate: function() {
					S.container.children("[data-swiper-parallax], [data-swiper-parallax-x], [data-swiper-parallax-y]").each(function() {
						h(this, S.progress)
					}), S.slides.each(function() {
						var e = a(this);
						e.find("[data-swiper-parallax], [data-swiper-parallax-x], [data-swiper-parallax-y]").each(function() {
							var a = Math.min(Math.max(e[0].progress, -1), 1);
							h(this, a)
						})
					})
				},
				setTransition: function(e) {
					"undefined" == typeof e && (e = S.params.speed), S.container.find("[data-swiper-parallax], [data-swiper-parallax-x], [data-swiper-parallax-y]").each(function() {
						var t = a(this),
							s = parseInt(t.attr("data-swiper-parallax-duration"), 10) || e;
						0 === e && (s = 0), t.transition(s)
					})
				}
			}, S.zoom = {
				scale: 1,
				currentScale: 1,
				isScaling: !1,
				gesture: {
					slide: void 0,
					slideWidth: void 0,
					slideHeight: void 0,
					image: void 0,
					imageWrap: void 0,
					zoomMax: S.params.zoomMax
				},
				image: {
					isTouched: void 0,
					isMoved: void 0,
					currentX: void 0,
					currentY: void 0,
					minX: void 0,
					minY: void 0,
					maxX: void 0,
					maxY: void 0,
					width: void 0,
					height: void 0,
					startX: void 0,
					startY: void 0,
					touchesStart: {},
					touchesCurrent: {}
				},
				velocity: {
					x: void 0,
					y: void 0,
					prevPositionX: void 0,
					prevPositionY: void 0,
					prevTime: void 0
				},
				getDistanceBetweenTouches: function(e) {
					if(e.targetTouches.length < 2) return 1;
					var a = e.targetTouches[0].pageX,
						t = e.targetTouches[0].pageY,
						s = e.targetTouches[1].pageX,
						i = e.targetTouches[1].pageY,
						r = Math.sqrt(Math.pow(s - a, 2) + Math.pow(i - t, 2));
					return r
				},
				onGestureStart: function(e) {
					var t = S.zoom;
					if(!S.support.gestures) {
						if("touchstart" !== e.type || "touchstart" === e.type && e.targetTouches.length < 2) return;
						t.gesture.scaleStart = t.getDistanceBetweenTouches(e)
					}
					return t.gesture.slide && t.gesture.slide.length || (t.gesture.slide = a(this), 0 === t.gesture.slide.length && (t.gesture.slide = S.slides.eq(S.activeIndex)), t.gesture.image = t.gesture.slide.find("img, svg, canvas"), t.gesture.imageWrap = t.gesture.image.parent("." + S.params.zoomContainerClass), t.gesture.zoomMax = t.gesture.imageWrap.attr("data-swiper-zoom") || S.params.zoomMax, 0 !== t.gesture.imageWrap.length) ? (t.gesture.image.transition(0), void(t.isScaling = !0)) : void(t.gesture.image = void 0)
				},
				onGestureChange: function(e) {
					var a = S.zoom;
					if(!S.support.gestures) {
						if("touchmove" !== e.type || "touchmove" === e.type && e.targetTouches.length < 2) return;
						a.gesture.scaleMove = a.getDistanceBetweenTouches(e)
					}
					a.gesture.image && 0 !== a.gesture.image.length && (S.support.gestures ? a.scale = e.scale * a.currentScale : a.scale = a.gesture.scaleMove / a.gesture.scaleStart * a.currentScale, a.scale > a.gesture.zoomMax && (a.scale = a.gesture.zoomMax - 1 + Math.pow(a.scale - a.gesture.zoomMax + 1, .5)), a.scale < S.params.zoomMin && (a.scale = S.params.zoomMin + 1 - Math.pow(S.params.zoomMin - a.scale + 1, .5)), a.gesture.image.transform("translate3d(0,0,0) scale(" + a.scale + ")"))
				},
				onGestureEnd: function(e) {
					var a = S.zoom;
					!S.support.gestures && ("touchend" !== e.type || "touchend" === e.type && e.changedTouches.length < 2) || a.gesture.image && 0 !== a.gesture.image.length && (a.scale = Math.max(Math.min(a.scale, a.gesture.zoomMax), S.params.zoomMin), a.gesture.image.transition(S.params.speed).transform("translate3d(0,0,0) scale(" + a.scale + ")"), a.currentScale = a.scale, a.isScaling = !1, 1 === a.scale && (a.gesture.slide = void 0))
				},
				onTouchStart: function(e, a) {
					var t = e.zoom;
					t.gesture.image && 0 !== t.gesture.image.length && (t.image.isTouched || ("android" === e.device.os && a.preventDefault(), t.image.isTouched = !0, t.image.touchesStart.x = "touchstart" === a.type ? a.targetTouches[0].pageX : a.pageX, t.image.touchesStart.y = "touchstart" === a.type ? a.targetTouches[0].pageY : a.pageY))
				},
				onTouchMove: function(e) {
					var a = S.zoom;
					if(a.gesture.image && 0 !== a.gesture.image.length && (S.allowClick = !1, a.image.isTouched && a.gesture.slide)) {
						a.image.isMoved || (a.image.width = a.gesture.image[0].offsetWidth, a.image.height = a.gesture.image[0].offsetHeight, a.image.startX = S.getTranslate(a.gesture.imageWrap[0], "x") || 0, a.image.startY = S.getTranslate(a.gesture.imageWrap[0], "y") || 0, a.gesture.slideWidth = a.gesture.slide[0].offsetWidth, a.gesture.slideHeight = a.gesture.slide[0].offsetHeight, a.gesture.imageWrap.transition(0));
						var t = a.image.width * a.scale,
							s = a.image.height * a.scale;
						if(!(t < a.gesture.slideWidth && s < a.gesture.slideHeight)) {
							if(a.image.minX = Math.min(a.gesture.slideWidth / 2 - t / 2, 0), a.image.maxX = -a.image.minX, a.image.minY = Math.min(a.gesture.slideHeight / 2 - s / 2, 0), a.image.maxY = -a.image.minY, a.image.touchesCurrent.x = "touchmove" === e.type ? e.targetTouches[0].pageX : e.pageX, a.image.touchesCurrent.y = "touchmove" === e.type ? e.targetTouches[0].pageY : e.pageY, !a.image.isMoved && !a.isScaling) {
								if(S.isHorizontal() && Math.floor(a.image.minX) === Math.floor(a.image.startX) && a.image.touchesCurrent.x < a.image.touchesStart.x || Math.floor(a.image.maxX) === Math.floor(a.image.startX) && a.image.touchesCurrent.x > a.image.touchesStart.x) return void(a.image.isTouched = !1);
								if(!S.isHorizontal() && Math.floor(a.image.minY) === Math.floor(a.image.startY) && a.image.touchesCurrent.y < a.image.touchesStart.y || Math.floor(a.image.maxY) === Math.floor(a.image.startY) && a.image.touchesCurrent.y > a.image.touchesStart.y) return void(a.image.isTouched = !1)
							}
							e.preventDefault(), e.stopPropagation(), a.image.isMoved = !0, a.image.currentX = a.image.touchesCurrent.x - a.image.touchesStart.x + a.image.startX, a.image.currentY = a.image.touchesCurrent.y - a.image.touchesStart.y + a.image.startY, a.image.currentX < a.image.minX && (a.image.currentX = a.image.minX + 1 - Math.pow(a.image.minX - a.image.currentX + 1, .8)), a.image.currentX > a.image.maxX && (a.image.currentX = a.image.maxX - 1 + Math.pow(a.image.currentX - a.image.maxX + 1, .8)), a.image.currentY < a.image.minY && (a.image.currentY = a.image.minY + 1 - Math.pow(a.image.minY - a.image.currentY + 1, .8)), a.image.currentY > a.image.maxY && (a.image.currentY = a.image.maxY - 1 + Math.pow(a.image.currentY - a.image.maxY + 1, .8)), a.velocity.prevPositionX || (a.velocity.prevPositionX = a.image.touchesCurrent.x), a.velocity.prevPositionY || (a.velocity.prevPositionY = a.image.touchesCurrent.y), a.velocity.prevTime || (a.velocity.prevTime = Date.now()), a.velocity.x = (a.image.touchesCurrent.x - a.velocity.prevPositionX) / (Date.now() - a.velocity.prevTime) / 2, a.velocity.y = (a.image.touchesCurrent.y - a.velocity.prevPositionY) / (Date.now() - a.velocity.prevTime) / 2, Math.abs(a.image.touchesCurrent.x - a.velocity.prevPositionX) < 2 && (a.velocity.x = 0), Math.abs(a.image.touchesCurrent.y - a.velocity.prevPositionY) < 2 && (a.velocity.y = 0), a.velocity.prevPositionX = a.image.touchesCurrent.x, a.velocity.prevPositionY = a.image.touchesCurrent.y, a.velocity.prevTime = Date.now(), a.gesture.imageWrap.transform("translate3d(" + a.image.currentX + "px, " + a.image.currentY + "px,0)")
						}
					}
				},
				onTouchEnd: function(e, a) {
					var t = e.zoom;
					if(t.gesture.image && 0 !== t.gesture.image.length) {
						if(!t.image.isTouched || !t.image.isMoved) return t.image.isTouched = !1, void(t.image.isMoved = !1);
						t.image.isTouched = !1, t.image.isMoved = !1;
						var s = 300,
							i = 300,
							r = t.velocity.x * s,
							n = t.image.currentX + r,
							o = t.velocity.y * i,
							l = t.image.currentY + o;
						0 !== t.velocity.x && (s = Math.abs((n - t.image.currentX) / t.velocity.x)), 0 !== t.velocity.y && (i = Math.abs((l - t.image.currentY) / t.velocity.y));
						var p = Math.max(s, i);
						t.image.currentX = n, t.image.currentY = l;
						var d = t.image.width * t.scale,
							u = t.image.height * t.scale;
						t.image.minX = Math.min(t.gesture.slideWidth / 2 - d / 2, 0), t.image.maxX = -t.image.minX, t.image.minY = Math.min(t.gesture.slideHeight / 2 - u / 2, 0), t.image.maxY = -t.image.minY, t.image.currentX = Math.max(Math.min(t.image.currentX, t.image.maxX), t.image.minX), t.image.currentY = Math.max(Math.min(t.image.currentY, t.image.maxY), t.image.minY), t.gesture.imageWrap.transition(p).transform("translate3d(" + t.image.currentX + "px, " + t.image.currentY + "px,0)")
					}
				},
				onTransitionEnd: function(e) {
					var a = e.zoom;
					a.gesture.slide && e.previousIndex !== e.activeIndex && (a.gesture.image.transform("translate3d(0,0,0) scale(1)"), a.gesture.imageWrap.transform("translate3d(0,0,0)"), a.gesture.slide = a.gesture.image = a.gesture.imageWrap = void 0, a.scale = a.currentScale = 1)
				},
				toggleZoom: function(e, t) {
					var s = e.zoom;
					if(s.gesture.slide || (s.gesture.slide = e.clickedSlide ? a(e.clickedSlide) : e.slides.eq(e.activeIndex), s.gesture.image = s.gesture.slide.find("img, svg, canvas"), s.gesture.imageWrap = s.gesture.image.parent("." + e.params.zoomContainerClass)), s.gesture.image && 0 !== s.gesture.image.length) {
						var i, r, n, o, l, p, d, u, c, m, h, g, f, v, w, y, x, T;
						"undefined" == typeof s.image.touchesStart.x && t ? (i = "touchend" === t.type ? t.changedTouches[0].pageX : t.pageX, r = "touchend" === t.type ? t.changedTouches[0].pageY : t.pageY) : (i = s.image.touchesStart.x, r = s.image.touchesStart.y), s.scale && 1 !== s.scale ? (s.scale = s.currentScale = 1, s.gesture.imageWrap.transition(300).transform("translate3d(0,0,0)"), s.gesture.image.transition(300).transform("translate3d(0,0,0) scale(1)"), s.gesture.slide = void 0) : (s.scale = s.currentScale = s.gesture.imageWrap.attr("data-swiper-zoom") || e.params.zoomMax, t ? (x = s.gesture.slide[0].offsetWidth, T = s.gesture.slide[0].offsetHeight, n = s.gesture.slide.offset().left, o = s.gesture.slide.offset().top, l = n + x / 2 - i, p = o + T / 2 - r, c = s.gesture.image[0].offsetWidth, m = s.gesture.image[0].offsetHeight, h = c * s.scale, g = m * s.scale, f = Math.min(x / 2 - h / 2, 0), v = Math.min(T / 2 - g / 2, 0), w = -f, y = -v, d = l * s.scale, u = p * s.scale, d < f && (d = f), d > w && (d = w), u < v && (u = v), u > y && (u = y)) : (d = 0, u = 0), s.gesture.imageWrap.transition(300).transform("translate3d(" + d + "px, " + u + "px,0)"), s.gesture.image.transition(300).transform("translate3d(0,0,0) scale(" + s.scale + ")"))
					}
				},
				attachEvents: function(e) {
					var t = e ? "off" : "on";
					if(S.params.zoom) {
						var s = (S.slides, !("touchstart" !== S.touchEvents.start || !S.support.passiveListener || !S.params.passiveListeners) && {
							passive: !0,
							capture: !1
						});
						S.support.gestures ? (S.slides[t]("gesturestart", S.zoom.onGestureStart, s), S.slides[t]("gesturechange", S.zoom.onGestureChange, s), S.slides[t]("gestureend", S.zoom.onGestureEnd, s)) : "touchstart" === S.touchEvents.start && (S.slides[t](S.touchEvents.start, S.zoom.onGestureStart, s), S.slides[t](S.touchEvents.move, S.zoom.onGestureChange, s), S.slides[t](S.touchEvents.end, S.zoom.onGestureEnd, s)), S[t]("touchStart", S.zoom.onTouchStart), S.slides.each(function(e, s) {
							a(s).find("." + S.params.zoomContainerClass).length > 0 && a(s)[t](S.touchEvents.move, S.zoom.onTouchMove)
						}), S[t]("touchEnd", S.zoom.onTouchEnd), S[t]("transitionEnd", S.zoom.onTransitionEnd), S.params.zoomToggle && S.on("doubleTap", S.zoom.toggleZoom)
					}
				},
				init: function() {
					S.zoom.attachEvents()
				},
				destroy: function() {
					S.zoom.attachEvents(!0)
				}
			}, S._plugins = [];
			for(var N in S.plugins) {
				var W = S.plugins[N](S, S.params[N]);
				W && S._plugins.push(W)
			}
			return S.callPlugins = function(e) {
				for(var a = 0; a < S._plugins.length; a++) e in S._plugins[a] && S._plugins[a][e](arguments[1], arguments[2], arguments[3], arguments[4], arguments[5])
			}, S.emitterEventListeners = {}, S.emit = function(e) {
				S.params[e] && S.params[e](arguments[1], arguments[2], arguments[3], arguments[4], arguments[5]);
				var a;
				if(S.emitterEventListeners[e])
					for(a = 0; a < S.emitterEventListeners[e].length; a++) S.emitterEventListeners[e][a](arguments[1], arguments[2], arguments[3], arguments[4], arguments[5]);
				S.callPlugins && S.callPlugins(e, arguments[1], arguments[2], arguments[3], arguments[4], arguments[5])
			}, S.on = function(e, a) {
				return e = g(e), S.emitterEventListeners[e] || (S.emitterEventListeners[e] = []), S.emitterEventListeners[e].push(a), S
			}, S.off = function(e, a) {
				var t;
				if(e = g(e), "undefined" == typeof a) return S.emitterEventListeners[e] = [], S;
				if(S.emitterEventListeners[e] && 0 !== S.emitterEventListeners[e].length) {
					for(t = 0; t < S.emitterEventListeners[e].length; t++) S.emitterEventListeners[e][t] === a && S.emitterEventListeners[e].splice(t, 1);
					return S
				}
			}, S.once = function(e, a) {
				e = g(e);
				var t = function() {
					a(arguments[0], arguments[1], arguments[2], arguments[3], arguments[4]), S.off(e, t)
				};
				return S.on(e, t), S
			}, S.a11y = {
				makeFocusable: function(e) {
					return e.attr("tabIndex", "0"), e
				},
				addRole: function(e, a) {
					return e.attr("role", a), e
				},
				addLabel: function(e, a) {
					return e.attr("aria-label", a), e
				},
				disable: function(e) {
					return e.attr("aria-disabled", !0), e
				},
				enable: function(e) {
					return e.attr("aria-disabled", !1), e
				},
				onEnterKey: function(e) {
					13 === e.keyCode && (a(e.target).is(S.params.nextButton) ? (S.onClickNext(e), S.isEnd ? S.a11y.notify(S.params.lastSlideMessage) : S.a11y.notify(S.params.nextSlideMessage)) : a(e.target).is(S.params.prevButton) && (S.onClickPrev(e), S.isBeginning ? S.a11y.notify(S.params.firstSlideMessage) : S.a11y.notify(S.params.prevSlideMessage)), a(e.target).is("." + S.params.bulletClass) && a(e.target)[0].click())
				},
				liveRegion: a('<span class="' + S.params.notificationClass + '" aria-live="assertive" aria-atomic="true"></span>'),
				notify: function(e) {
					var a = S.a11y.liveRegion;
					0 !== a.length && (a.html(""), a.html(e))
				},
				init: function() {
					S.params.nextButton && S.nextButton && S.nextButton.length > 0 && (S.a11y.makeFocusable(S.nextButton), S.a11y.addRole(S.nextButton, "button"), S.a11y.addLabel(S.nextButton, S.params.nextSlideMessage)), S.params.prevButton && S.prevButton && S.prevButton.length > 0 && (S.a11y.makeFocusable(S.prevButton), S.a11y.addRole(S.prevButton, "button"), S.a11y.addLabel(S.prevButton, S.params.prevSlideMessage)), a(S.container).append(S.a11y.liveRegion)
				},
				initPagination: function() {
					S.params.pagination && S.params.paginationClickable && S.bullets && S.bullets.length && S.bullets.each(function() {
						var e = a(this);
						S.a11y.makeFocusable(e), S.a11y.addRole(e, "button"), S.a11y.addLabel(e, S.params.paginationBulletMessage.replace(/{{index}}/, e.index() + 1))
					})
				},
				destroy: function() {
					S.a11y.liveRegion && S.a11y.liveRegion.length > 0 && S.a11y.liveRegion.remove()
				}
			}, S.init = function() {
				S.params.loop && S.createLoop(), S.updateContainerSize(), S.updateSlidesSize(), S.updatePagination(), S.params.scrollbar && S.scrollbar && (S.scrollbar.set(), S.params.scrollbarDraggable && S.scrollbar.enableDraggable()), "slide" !== S.params.effect && S.effects[S.params.effect] && (S.params.loop || S.updateProgress(), S.effects[S.params.effect].setTranslate()), S.params.loop ? S.slideTo(S.params.initialSlide + S.loopedSlides, 0, S.params.runCallbacksOnInit) : (S.slideTo(S.params.initialSlide, 0, S.params.runCallbacksOnInit), 0 === S.params.initialSlide && (S.parallax && S.params.parallax && S.parallax.setTranslate(), S.lazy && S.params.lazyLoading && (S.lazy.load(), S.lazy.initialImageLoaded = !0))), S.attachEvents(), S.params.observer && S.support.observer && S.initObservers(), S.params.preloadImages && !S.params.lazyLoading && S.preloadImages(), S.params.zoom && S.zoom && S.zoom.init(), S.params.autoplay && S.startAutoplay(), S.params.keyboardControl && S.enableKeyboardControl && S.enableKeyboardControl(), S.params.mousewheelControl && S.enableMousewheelControl && S.enableMousewheelControl(), S.params.hashnavReplaceState && (S.params.replaceState = S.params.hashnavReplaceState), S.params.history && S.history && S.history.init(), S.params.hashnav && S.hashnav && S.hashnav.init(), S.params.a11y && S.a11y && S.a11y.init(), S.emit("onInit", S)
			}, S.cleanupStyles = function() {
				S.container.removeClass(S.classNames.join(" ")).removeAttr("style"), S.wrapper.removeAttr("style"), S.slides && S.slides.length && S.slides.removeClass([S.params.slideVisibleClass, S.params.slideActiveClass, S.params.slideNextClass, S.params.slidePrevClass].join(" ")).removeAttr("style").removeAttr("data-swiper-column").removeAttr("data-swiper-row"), S.paginationContainer && S.paginationContainer.length && S.paginationContainer.removeClass(S.params.paginationHiddenClass), S.bullets && S.bullets.length && S.bullets.removeClass(S.params.bulletActiveClass), S.params.prevButton && a(S.params.prevButton).removeClass(S.params.buttonDisabledClass), S.params.nextButton && a(S.params.nextButton).removeClass(S.params.buttonDisabledClass), S.params.scrollbar && S.scrollbar && (S.scrollbar.track && S.scrollbar.track.length && S.scrollbar.track.removeAttr("style"), S.scrollbar.drag && S.scrollbar.drag.length && S.scrollbar.drag.removeAttr("style"))
			}, S.destroy = function(e, a) {
				S.detachEvents(), S.stopAutoplay(), S.params.scrollbar && S.scrollbar && S.params.scrollbarDraggable && S.scrollbar.disableDraggable(), S.params.loop && S.destroyLoop(), a && S.cleanupStyles(), S.disconnectObservers(), S.params.zoom && S.zoom && S.zoom.destroy(), S.params.keyboardControl && S.disableKeyboardControl && S.disableKeyboardControl(), S.params.mousewheelControl && S.disableMousewheelControl && S.disableMousewheelControl(), S.params.a11y && S.a11y && S.a11y.destroy(), S.params.history && !S.params.replaceState && window.removeEventListener("popstate", S.history.setHistoryPopState), S.params.hashnav && S.hashnav && S.hashnav.destroy(), S.emit("onDestroy"), e !== !1 && (S = null)
			}, S.init(), S
		}
	};
	t.prototype = {
		isSafari: function() {
			var e = navigator.userAgent.toLowerCase();
			return e.indexOf("safari") >= 0 && e.indexOf("chrome") < 0 && e.indexOf("android") < 0
		}(),
		isUiWebView: /(iPhone|iPod|iPad).*AppleWebKit(?!.*Safari)/i.test(navigator.userAgent),
		isArray: function(e) {
			return "[object Array]" === Object.prototype.toString.apply(e)
		},
		browser: {
			ie: window.navigator.pointerEnabled || window.navigator.msPointerEnabled,
			ieTouch: window.navigator.msPointerEnabled && window.navigator.msMaxTouchPoints > 1 || window.navigator.pointerEnabled && window.navigator.maxTouchPoints > 1,
			lteIE9: function() {
				var e = document.createElement("div");
				return e.innerHTML = "<!--[if lte IE 9]><i></i><![endif]-->", 1 === e.getElementsByTagName("i").length
			}()
		},
		device: function() {
			var e = navigator.userAgent,
				a = e.match(/(Android);?[\s\/]+([\d.]+)?/),
				t = e.match(/(iPad).*OS\s([\d_]+)/),
				s = e.match(/(iPod)(.*OS\s([\d_]+))?/),
				i = !t && e.match(/(iPhone\sOS)\s([\d_]+)/);
			return {
				ios: t || i || s,
				android: a
			}
		}(),
		support: {
			touch: window.Modernizr && Modernizr.touch === !0 || function() {
				return !!("ontouchstart" in window || window.DocumentTouch && document instanceof DocumentTouch)
			}(),
			transforms3d: window.Modernizr && Modernizr.csstransforms3d === !0 || function() {
				var e = document.createElement("div").style;
				return "webkitPerspective" in e || "MozPerspective" in e || "OPerspective" in e || "MsPerspective" in e || "perspective" in e
			}(),
			flexbox: function() {
				for(var e = document.createElement("div").style, a = "alignItems webkitAlignItems webkitBoxAlign msFlexAlign mozBoxAlign webkitFlexDirection msFlexDirection mozBoxDirection mozBoxOrient webkitBoxDirection webkitBoxOrient".split(" "), t = 0; t < a.length; t++)
					if(a[t] in e) return !0
			}(),
			observer: function() {
				return "MutationObserver" in window || "WebkitMutationObserver" in window
			}(),
			passiveListener: function() {
				var e = !1;
				try {
					var a = Object.defineProperty({}, "passive", {
						get: function() {
							e = !0
						}
					});
					window.addEventListener("testPassiveListener", null, a)
				} catch(e) {}
				return e
			}(),
			gestures: function() {
				return "ongesturestart" in window
			}()
		},
		plugins: {}
	};
	for(var s = (function() {
			var e = function(e) {
					var a = this,
						t = 0;
					for(t = 0; t < e.length; t++) a[t] = e[t];
					return a.length = e.length, this
				},
				a = function(a, t) {
					var s = [],
						i = 0;
					if(a && !t && a instanceof e) return a;
					if(a)
						if("string" == typeof a) {
							var r, n, o = a.trim();
							if(o.indexOf("<") >= 0 && o.indexOf(">") >= 0) {
								var l = "div";
								for(0 === o.indexOf("<li") && (l = "ul"), 0 === o.indexOf("<tr") && (l = "tbody"), 0 !== o.indexOf("<td") && 0 !== o.indexOf("<th") || (l = "tr"), 0 === o.indexOf("<tbody") && (l = "table"), 0 === o.indexOf("<option") && (l = "select"), n = document.createElement(l), n.innerHTML = a, i = 0; i < n.childNodes.length; i++) s.push(n.childNodes[i])
							} else
								for(r = t || "#" !== a[0] || a.match(/[ .<>:~]/) ? (t || document).querySelectorAll(a) : [document.getElementById(a.split("#")[1])], i = 0; i < r.length; i++) r[i] && s.push(r[i])
						} else if(a.nodeType || a === window || a === document) s.push(a);
					else if(a.length > 0 && a[0].nodeType)
						for(i = 0; i < a.length; i++) s.push(a[i]);
					return new e(s)
				};
			return e.prototype = {
				addClass: function(e) {
					if("undefined" == typeof e) return this;
					for(var a = e.split(" "), t = 0; t < a.length; t++)
						for(var s = 0; s < this.length; s++) this[s].classList.add(a[t]);
					return this
				},
				removeClass: function(e) {
					for(var a = e.split(" "), t = 0; t < a.length; t++)
						for(var s = 0; s < this.length; s++) this[s].classList.remove(a[t]);
					return this
				},
				hasClass: function(e) {
					return !!this[0] && this[0].classList.contains(e)
				},
				toggleClass: function(e) {
					for(var a = e.split(" "), t = 0; t < a.length; t++)
						for(var s = 0; s < this.length; s++) this[s].classList.toggle(a[t]);
					return this
				},
				attr: function(e, a) {
					if(1 === arguments.length && "string" == typeof e) return this[0] ? this[0].getAttribute(e) : void 0;
					for(var t = 0; t < this.length; t++)
						if(2 === arguments.length) this[t].setAttribute(e, a);
						else
							for(var s in e) this[t][s] = e[s], this[t].setAttribute(s, e[s]);
					return this
				},
				removeAttr: function(e) {
					for(var a = 0; a < this.length; a++) this[a].removeAttribute(e);
					return this
				},
				data: function(e, a) {
					if("undefined" != typeof a) {
						for(var t = 0; t < this.length; t++) {
							var s = this[t];
							s.dom7ElementDataStorage || (s.dom7ElementDataStorage = {}), s.dom7ElementDataStorage[e] = a
						}
						return this
					}
					if(this[0]) {
						var i = this[0].getAttribute("data-" + e);
						return i ? i : this[0].dom7ElementDataStorage && e in this[0].dom7ElementDataStorage ? this[0].dom7ElementDataStorage[e] : void 0
					}
				},
				transform: function(e) {
					for(var a = 0; a < this.length; a++) {
						var t = this[a].style;
						t.webkitTransform = t.MsTransform = t.msTransform = t.MozTransform = t.OTransform = t.transform = e
					}
					return this
				},
				transition: function(e) {
					"string" != typeof e && (e += "ms");
					for(var a = 0; a < this.length; a++) {
						var t = this[a].style;
						t.webkitTransitionDuration = t.MsTransitionDuration = t.msTransitionDuration = t.MozTransitionDuration = t.OTransitionDuration = t.transitionDuration = e
					}
					return this
				},
				on: function(e, t, s, i) {
					function r(e) {
						var i = e.target;
						if(a(i).is(t)) s.call(i, e);
						else
							for(var r = a(i).parents(), n = 0; n < r.length; n++) a(r[n]).is(t) && s.call(r[n], e)
					}
					var n, o, l = e.split(" ");
					for(n = 0; n < this.length; n++)
						if("function" == typeof t || t === !1)
							for("function" == typeof t && (s = arguments[1], i = arguments[2] || !1), o = 0; o < l.length; o++) this[n].addEventListener(l[o], s, i);
						else
							for(o = 0; o < l.length; o++) this[n].dom7LiveListeners || (this[n].dom7LiveListeners = []), this[n].dom7LiveListeners.push({
								listener: s,
								liveListener: r
							}), this[n].addEventListener(l[o], r, i);
					return this
				},
				off: function(e, a, t, s) {
					for(var i = e.split(" "), r = 0; r < i.length; r++)
						for(var n = 0; n < this.length; n++)
							if("function" == typeof a || a === !1) "function" == typeof a && (t = arguments[1], s = arguments[2] || !1), this[n].removeEventListener(i[r], t, s);
							else if(this[n].dom7LiveListeners)
						for(var o = 0; o < this[n].dom7LiveListeners.length; o++) this[n].dom7LiveListeners[o].listener === t && this[n].removeEventListener(i[r], this[n].dom7LiveListeners[o].liveListener, s);
					return this
				},
				once: function(e, a, t, s) {
					function i(n) {
						t(n), r.off(e, a, i, s)
					}
					var r = this;
					"function" == typeof a && (a = !1, t = arguments[1], s = arguments[2]), r.on(e, a, i, s)
				},
				trigger: function(e, a) {
					for(var t = 0; t < this.length; t++) {
						var s;
						try {
							s = new window.CustomEvent(e, {
								detail: a,
								bubbles: !0,
								cancelable: !0
							})
						} catch(t) {
							s = document.createEvent("Event"), s.initEvent(e, !0, !0), s.detail = a
						}
						this[t].dispatchEvent(s)
					}
					return this
				},
				transitionEnd: function(e) {
					function a(r) {
						if(r.target === this)
							for(e.call(this, r), t = 0; t < s.length; t++) i.off(s[t], a)
					}
					var t, s = ["webkitTransitionEnd", "transitionend", "oTransitionEnd", "MSTransitionEnd", "msTransitionEnd"],
						i = this;
					if(e)
						for(t = 0; t < s.length; t++) i.on(s[t], a);
					return this
				},
				width: function() {
					return this[0] === window ? window.innerWidth : this.length > 0 ? parseFloat(this.css("width")) : null
				},
				outerWidth: function(e) {
					return this.length > 0 ? e ? this[0].offsetWidth + parseFloat(this.css("margin-right")) + parseFloat(this.css("margin-left")) : this[0].offsetWidth : null
				},
				height: function() {
					return this[0] === window ? window.innerHeight : this.length > 0 ? parseFloat(this.css("height")) : null
				},
				outerHeight: function(e) {
					return this.length > 0 ? e ? this[0].offsetHeight + parseFloat(this.css("margin-top")) + parseFloat(this.css("margin-bottom")) : this[0].offsetHeight : null
				},
				offset: function() {
					if(this.length > 0) {
						var e = this[0],
							a = e.getBoundingClientRect(),
							t = document.body,
							s = e.clientTop || t.clientTop || 0,
							i = e.clientLeft || t.clientLeft || 0,
							r = window.pageYOffset || e.scrollTop,
							n = window.pageXOffset || e.scrollLeft;
						return {
							top: a.top + r - s,
							left: a.left + n - i
						}
					}
					return null
				},
				css: function(e, a) {
					var t;
					if(1 === arguments.length) {
						if("string" != typeof e) {
							for(t = 0; t < this.length; t++)
								for(var s in e) this[t].style[s] = e[s];
							return this
						}
						if(this[0]) return window.getComputedStyle(this[0], null).getPropertyValue(e)
					}
					if(2 === arguments.length && "string" == typeof e) {
						for(t = 0; t < this.length; t++) this[t].style[e] = a;
						return this
					}
					return this
				},
				each: function(e) {
					for(var a = 0; a < this.length; a++) e.call(this[a], a, this[a]);
					return this
				},
				html: function(e) {
					if("undefined" == typeof e) return this[0] ? this[0].innerHTML : void 0;
					for(var a = 0; a < this.length; a++) this[a].innerHTML = e;
					return this
				},
				text: function(e) {
					if("undefined" == typeof e) return this[0] ? this[0].textContent.trim() : null;
					for(var a = 0; a < this.length; a++) this[a].textContent = e;
					return this
				},
				is: function(t) {
					if(!this[0]) return !1;
					var s, i;
					if("string" == typeof t) {
						var r = this[0];
						if(r === document) return t === document;
						if(r === window) return t === window;
						if(r.matches) return r.matches(t);
						if(r.webkitMatchesSelector) return r.webkitMatchesSelector(t);
						if(r.mozMatchesSelector) return r.mozMatchesSelector(t);
						if(r.msMatchesSelector) return r.msMatchesSelector(t);
						for(s = a(t), i = 0; i < s.length; i++)
							if(s[i] === this[0]) return !0;
						return !1
					}
					if(t === document) return this[0] === document;
					if(t === window) return this[0] === window;
					if(t.nodeType || t instanceof e) {
						for(s = t.nodeType ? [t] : t, i = 0; i < s.length; i++)
							if(s[i] === this[0]) return !0;
						return !1
					}
					return !1
				},
				index: function() {
					if(this[0]) {
						for(var e = this[0], a = 0; null !== (e = e.previousSibling);) 1 === e.nodeType && a++;
						return a
					}
				},
				eq: function(a) {
					if("undefined" == typeof a) return this;
					var t, s = this.length;
					return a > s - 1 ? new e([]) : a < 0 ? (t = s + a, new e(t < 0 ? [] : [this[t]])) : new e([this[a]])
				},
				append: function(a) {
					var t, s;
					for(t = 0; t < this.length; t++)
						if("string" == typeof a) {
							var i = document.createElement("div");
							for(i.innerHTML = a; i.firstChild;) this[t].appendChild(i.firstChild)
						} else if(a instanceof e)
						for(s = 0; s < a.length; s++) this[t].appendChild(a[s]);
					else this[t].appendChild(a);
					return this
				},
				prepend: function(a) {
					var t, s;
					for(t = 0; t < this.length; t++)
						if("string" == typeof a) {
							var i = document.createElement("div");
							for(i.innerHTML = a, s = i.childNodes.length - 1; s >= 0; s--) this[t].insertBefore(i.childNodes[s], this[t].childNodes[0])
						} else if(a instanceof e)
						for(s = 0; s < a.length; s++) this[t].insertBefore(a[s], this[t].childNodes[0]);
					else this[t].insertBefore(a, this[t].childNodes[0]);
					return this
				},
				insertBefore: function(e) {
					for(var t = a(e), s = 0; s < this.length; s++)
						if(1 === t.length) t[0].parentNode.insertBefore(this[s], t[0]);
						else if(t.length > 1)
						for(var i = 0; i < t.length; i++) t[i].parentNode.insertBefore(this[s].cloneNode(!0), t[i])
				},
				insertAfter: function(e) {
					for(var t = a(e), s = 0; s < this.length; s++)
						if(1 === t.length) t[0].parentNode.insertBefore(this[s], t[0].nextSibling);
						else if(t.length > 1)
						for(var i = 0; i < t.length; i++) t[i].parentNode.insertBefore(this[s].cloneNode(!0), t[i].nextSibling)
				},
				next: function(t) {
					return new e(this.length > 0 ? t ? this[0].nextElementSibling && a(this[0].nextElementSibling).is(t) ? [this[0].nextElementSibling] : [] : this[0].nextElementSibling ? [this[0].nextElementSibling] : [] : [])
				},
				nextAll: function(t) {
					var s = [],
						i = this[0];
					if(!i) return new e([]);
					for(; i.nextElementSibling;) {
						var r = i.nextElementSibling;
						t ? a(r).is(t) && s.push(r) : s.push(r), i = r
					}
					return new e(s)
				},
				prev: function(t) {
					return new e(this.length > 0 ? t ? this[0].previousElementSibling && a(this[0].previousElementSibling).is(t) ? [this[0].previousElementSibling] : [] : this[0].previousElementSibling ? [this[0].previousElementSibling] : [] : [])
				},
				prevAll: function(t) {
					var s = [],
						i = this[0];
					if(!i) return new e([]);
					for(; i.previousElementSibling;) {
						var r = i.previousElementSibling;
						t ? a(r).is(t) && s.push(r) : s.push(r), i = r
					}
					return new e(s)
				},
				parent: function(e) {
					for(var t = [], s = 0; s < this.length; s++) e ? a(this[s].parentNode).is(e) && t.push(this[s].parentNode) : t.push(this[s].parentNode);
					return a(a.unique(t))
				},
				parents: function(e) {
					for(var t = [], s = 0; s < this.length; s++)
						for(var i = this[s].parentNode; i;) e ? a(i).is(e) && t.push(i) : t.push(i), i = i.parentNode;
					return a(a.unique(t))
				},
				find: function(a) {
					for(var t = [], s = 0; s < this.length; s++)
						for(var i = this[s].querySelectorAll(a), r = 0; r < i.length; r++) t.push(i[r]);
					return new e(t)
				},
				children: function(t) {
					for(var s = [], i = 0; i < this.length; i++)
						for(var r = this[i].childNodes, n = 0; n < r.length; n++) t ? 1 === r[n].nodeType && a(r[n]).is(t) && s.push(r[n]) : 1 === r[n].nodeType && s.push(r[n]);
					return new e(a.unique(s))
				},
				remove: function() {
					for(var e = 0; e < this.length; e++) this[e].parentNode && this[e].parentNode.removeChild(this[e]);
					return this
				},
				add: function() {
					var e, t, s = this;
					for(e = 0; e < arguments.length; e++) {
						var i = a(arguments[e]);
						for(t = 0; t < i.length; t++) s[s.length] = i[t], s.length++
					}
					return s
				}
			}, a.fn = e.prototype, a.unique = function(e) {
				for(var a = [], t = 0; t < e.length; t++) a.indexOf(e[t]) === -1 && a.push(e[t]);
				return a
			}, a
		}()), i = ["jQuery", "Zepto", "Dom7"], r = 0; r < i.length; r++) window[i[r]] && e(window[i[r]]);
	var n;
	n = "undefined" == typeof s ? window.Dom7 || window.Zepto || window.jQuery : s, n && ("transitionEnd" in n.fn || (n.fn.transitionEnd = function(e) {
		function a(r) {
			if(r.target === this)
				for(e.call(this, r), t = 0; t < s.length; t++) i.off(s[t], a)
		}
		var t, s = ["webkitTransitionEnd", "transitionend", "oTransitionEnd", "MSTransitionEnd", "msTransitionEnd"],
			i = this;
		if(e)
			for(t = 0; t < s.length; t++) i.on(s[t], a);
		return this
	}), "transform" in n.fn || (n.fn.transform = function(e) {
		for(var a = 0; a < this.length; a++) {
			var t = this[a].style;
			t.webkitTransform = t.MsTransform = t.msTransform = t.MozTransform = t.OTransform = t.transform = e
		}
		return this
	}), "transition" in n.fn || (n.fn.transition = function(e) {
		"string" != typeof e && (e += "ms");
		for(var a = 0; a < this.length; a++) {
			var t = this[a].style;
			t.webkitTransitionDuration = t.MsTransitionDuration = t.msTransitionDuration = t.MozTransitionDuration = t.OTransitionDuration = t.transitionDuration = e
		}
		return this
	}), "outerWidth" in n.fn || (n.fn.outerWidth = function(e) {
		return this.length > 0 ? e ? this[0].offsetWidth + parseFloat(this.css("margin-right")) + parseFloat(this.css("margin-left")) : this[0].offsetWidth : null
	})), window.Swiper = t
}(), "undefined" != typeof module ? module.exports = window.Swiper : "function" == typeof define && define.amd && define([], function() {
	"use strict";
	return window.Swiper
});
//# sourceMappingURL=maps/swiper.min.js.map