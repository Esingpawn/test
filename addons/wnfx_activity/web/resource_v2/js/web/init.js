define(["jquery", "bootstrap"], function($, bs) {
	function _bindCssEvent(a, i) {
		var o = this;

		function n(t) {
			if (t.target === this) {
				i.call(this, t);
				for (var e = 0; e < a.length; e++) o.off(a[e], n)
			}
		}
		if (i) for (var t = 0; t < a.length; t++) o.on(a[t], n)
	}
	window.redirect = function(t) {
		location.href = t
	}, $(document).on("click", "[data-toggle=refresh]", function(t) {
		t && t.preventDefault();
		var e = $(t.target).data("href");
		e ? window.location = e : window.location.reload()
	}), $(document).on("click", "[data-toggle=back]", function(t) {
		t && t.preventDefault();
		var e = $(t.target).data("href");
		e ? window.location = e : window.history.back()
	}), $.fn.animationEnd = function(t) {
		return _bindCssEvent.call(this, ["webkitAnimationEnd", "animationend"], t), this
	}, $.fn.transitionEnd = function(t) {
		return _bindCssEvent.call(this, ["webkitTransitionEnd", "transitionend"], t), this
	}, $.fn.transition = function(t) {
		"string" != typeof t && (t += "ms");
		for (var e = 0; e < this.length; e++) {
			var a = this[e].style;
			a.webkitTransitionDuration = a.MozTransitionDuration = a.transitionDuration = t
		}
		return this
	}, $.fn.transform = function(t) {
		for (var e = 0; e < this.length; e++) {
			var a = this[e].style;
			a.webkitTransform = a.MozTransform = a.transform = t
		}
		return this
	}, $.toQueryPair = function(t, e) {
		return void 0 === e ? t : t + "=" + encodeURIComponent(null === e ? "" : String(e))
	}, $.toQueryString = function(t) {
		var e = [];
		for (var a in t) {
			var i = t[a = encodeURIComponent(a)];
			if (i && i.constructor == Array) {
				for (var o, n = [], r = 0, l = i.length; r < l; r++) o = i[r], n.push($.toQueryPair(a, o));
				e = concat(n)
			} else e.push($.toQueryPair(a, i))
		}
		return e.join("&")
	}, myrequire(["web/table"]), myrequire(["jquery.gcjs"]), myrequire(["web/tip"]), myrequire(["tooltipbox"]), (0 < $("form.form-validate").length || 0 < $("form.form-modal").length) && myrequire(["web/form"], function(t) {
		t.init()
	}), myrequire(["web/biz"]), 0 < $(".select2").length && myrequire(["select2"], function() {
		$(".select2").each(function() {
			$(this).select2({})
		})
	}), myrequire(["web/table"]), 0 < $(".js-switch").length && myrequire(["switchery"], function() {
		$(".js-switch").switchery()
	}), 0 < $(".js-clip").length && myrequire(["clipboard"], function(t) {
		new t(".js-clip", {
			text: function(t) {
				return $(t).data("url") || $(t).data("href")
			}
		}).on("success", function(t) {
			tip.msgbox.suc("复制成功")
		})
	}), $.fn.append2 = function(t, e) {
		var a = $("body").html().length;
		this.append(t);
		var i = 1,
			o = setInterval(function() {
				i++;
				(a != $("body").html().length || 1e3 < i) && (clearInterval(o), e && e())
			}, 1)
	}, $('[data-toggle="popover"]').popover(), $(document).on("click", '[data-toggle="ajaxModal"]', function(e) {
		e.preventDefault();
		var obj = $(this),
			confirm = obj.data("confirm"),
			handler = function() {
				$("#ajaxModal").remove(), e.preventDefault();
				var url = obj.data("href") || obj.attr("href"),
					data = obj.data("set"),
					modal;
				$.ajax(url, {
					type: "get",
					dataType: "html",
					cache: !1,
					data: data
				}).done(function(html) {
					if ('{"result' == html.substr(0, 8) && (json = eval("(" + html + ")"), 0 == json.status)) return msg = "object" == typeof json.result ? json.result.message : json.result, void tip.msgbox.err(msg || tip.lang.err);
					modal = $('<div class="modal fade" id="ajaxModal"></div>'), $(document.body).append(modal), modal.modal("show"), myrequire(["jquery.gcjs"], function() {
						modal.append2(html, function() {
							0 < $("form.form-validate", modal).length && ($("button[type='submit']", modal).length && $("button[type='submit']", modal).attr("disabled", !0), myrequire(["web/form"], function(t) {
								t.init(), $("button[type='submit']", modal).length && $("button[type='submit']", modal).removeAttr("disabled")
							}))
						})
					})
				})
			},
			a;
		confirm ? tip.confirm(confirm, handler) : handler()
	}), $(document).on("click", '[data-toggle="ajaxPost"]', function(e) {
		e.preventDefault();
		var obj = $(this),
			confirm = obj.data("confirm"),
			url = obj.data("href") || obj.attr("href"),
			data = obj.data("set") || {},
			html = obj.html();
		handler = function() {
			e.preventDefault(), "1" != obj.attr("submitting") && (obj.html('<i class="fa fa-spinner fa-spin"></i>').attr("submitting", 1), $.post(url, {
				data: data
			}, function(ret) {
				ret = eval("(" + ret + ")"), 1 == ret.status ? tip.msgbox.suc(ret.result.message || tip.lang.success, ret.result.url) : (tip.msgbox.err(ret.result.message || tip.lang.error, ret.result.url), obj.removeAttr("submitting").html(html))
			}).fail(function() {
				obj.removeAttr("submitting").html(html), tip.msgbox.err(tip.lang.exception)
			}))
		}, confirm && tip.confirm(confirm, handler), confirm || handler()
	}), $(document).on("click", '[data-toggle="ajaxEdit"]', function(e) {
		var obj = $(this),
			url = obj.data("href") || obj.attr("href"),
			data = obj.data("set") || {},
			html = $.trim(obj.text()),
			required = obj.data("required") || !0,
			edit = obj.data("edit") || "input",
			oldval = $.trim($(this).text());
		e.preventDefault(), submit = function() {
			e.preventDefault();
			var val = $.trim(input.val());
			if (required && "" == val) tip.msgbox.err(tip.lang.empty);
			else {
				if (val == html) return input.remove(), void obj.html(val).show();
				url ? $.post(url, {
					value: val
				}, function(ret) {
					ret = eval("(" + ret + ")"), 1 == ret.status ? obj.html(val).show() : tip.msgbox.err(ret.result.message, ret.result.url), input.remove()
				}).fail(function() {
					input.remove(), tip.msgbox.err(tip.lang.exception)
				}) : (input.remove(), obj.html(val).show()), obj.trigger("valueChange", [val, oldval])
			}
		}, obj.hide().html('<i class="fa fa-spinner fa-spin"></i>');
		var input = $('<input type="text" class="form-control input-sm" style="width: 80%;display: inline;" />');
		"textarea" == edit && (input = $('<textarea type="text" class="form-control" style="resize:none" rows=3 ></textarea>')), obj.after(input), input.val(html).select().blur(function() {
			submit(input)
		}).keypress(function(t) {
			13 == t.which && submit(input)
		})
	}), $(document).on("click", '[data-toggle="ajaxSwitch"]', function(e) {
		e.preventDefault();
		var obj = $(this),
			confirm = obj.data("msg") || obj.data("confirm"),
			othercss = obj.data("switch-css"),
			other = obj.data("switch-other"),
			refresh = obj.data("switch-refresh") || !1;
		if ("1" != obj.attr("submitting")) {
			var value = obj.data("switch-value"),
				value0 = obj.data("switch-value0"),
				value1 = obj.data("switch-value1");
			if (void 0 !== value && void 0 !== value0 && void 0 !== value1) {
				var url, css, text, newvalue, newurl, newcss, newtext;
				value0 = value0.split("|"), value1 = value1.split("|"), newcss = value == value0[0] ? (url = value0[3], css = value0[2], text = value0[1], newvalue = value1[0], newtext = value1[1], value1[2]) : (url = value1[3], css = value1[2], text = value1[1], newvalue = value0[0], newtext = value0[1], value0[2]);
				var html = obj.html(),
					submit = function() {
						$.post(url).done(function(data) {
							data = eval("(" + data + ")"), 1 == data.status ? (other && othercss && "1" == newvalue && $(othercss).each(function() {
								$(this).data("switch-value") == newvalue && (this.className = css, $(this).data("switch-value", value).html(text || html))
							}), obj.data("switch-value", newvalue), obj.html(newtext || html), obj[0].className = newcss, refresh && location.reload()) : (obj.html(html), tip.msgbox.err(data.result.message || tip.lang.error, data.result.url)), obj.removeAttr("submitting")
						}).fail(function() {
							obj.removeAttr("submitting"), obj.button("reset"), tip.msgbox.err(tip.lang.exception)
						})
					},
					a;
				confirm ? tip.confirm(confirm, function() {
					obj.html('<i class="fa fa-spinner fa-spin"></i>').attr("submitting", 1), submit()
				}) : (obj.html('<i class="fa fa-spinner fa-spin"></i>').attr("submitting", 1), submit())
			}
		}
	}), $(document).on("click", '[data-toggle="selectUrl"]', function() {
		$("#selectUrl").remove();
		var _input = $(this).data("input"),
			_type = $(this).data("type"),
			_full = $(this).data("full"),
			_platform = $(this).data("platform"),
			_callback = $(this).data("callback") || !1,
			_cbfunction = !! _callback && eval("(" + _callback + ")");
		if (_input || _callback) {
			var merch = $(".diy-phone").data("merch"),
				url = biz.url("util/selecturl", null, merch),
				store = $(".diy-phone").data("store");
			store && (url = biz.url("store/diypage/selecturl")), _full && (url += "&full=1"), _platform && (url = url + "&platform=" + _platform), _type && (url = url + "&type=" + _type), 0 < $(_input).length && $(_input).val() && (url += "&url=" + encodeURIComponent($(_input).val())), $.ajax(url, {
				type: "get",
				dataType: "html",
				cache: !1
			}).done(function(t) {
				modal = $('<div class="modal fade" id="selectUrl"></div>'), $(document.body).append(modal), modal.modal("show"), modal.append2(t, function() {
					$(document).off("click", "#selectUrl nav").on("click", "#selectUrl nav", function() {
						var t = $.trim($(this).data("href")),
							e = $.trim($(this).data("type"));
						if ("" != e && "topmenu_data" == e) {
							var a = $.trim($(this).data("condition")),
								i = $.trim($(this).data("tab"));
							if ("goodsids" == i) {
								a = "";
								if ($("[data-name*='goodsid']").each(function(t, e) {
									a += $(this).data("id") + ","
								}), "" == a) return void tip.msgbox.err("请选择商品")
							} else if ("stores" == i) {
								a = "";
								if ($("[data-name*='stores']").each(function(t, e) {
									$(this).is(":checked") && (a += $(this).data("id") + ",")
								}), "" == a) return void tip.msgbox.err("请选择门店")
							}
							$(_input).val(i + "=" + a).trigger("change"), "groups" != i && "category" != i && "goodsids" != i || _cbfunction(i)
						} else _input ? $(_input).val(t).trigger("change") : _cbfunction && _cbfunction(t);
						modal.find(".close").click()
					})
				})
			})
		}
	}), $(document).on("click", '[data-toggle="selectImg"]', function() {
		var i = $(this).data("input"),
			o = $(this).data("img"),
			n = $(this).data("full"),
			t = 0 < $(".diy-phone").length ? $(".diy-phone").data("merch") : "",
			e = {};
		t && (e.dest_dir = "merch/" + t), require(["jquery", "util"], function(a, t) {
			t.image("", function(t) {
				var e = t.attachment;
				n && (e = t.url), i && a(i).val(e).trigger("change"), o && a(o).attr("src", t.url)
			}, e)
		})
	}), $(document).on("click", '[data-toggle="selectIcon"]', function() {
		var e = $(this).data("input"),
			a = $(this).data("element");
		if (e || a) {
			var t = $(".diy-phone").data("merch"),
				i = biz.url("util/selecticon", null, t);
			$.ajax(i, {
				type: "get",
				dataType: "html",
				cache: !1
			}).done(function(t) {
				modal = $('<div class="modal fade" id="selectIcon"></div>'), $(document.body).append(modal), modal.modal("show"), modal.append2(t, function() {
					$(document).off("click", "#selectIcon nav").on("click", "#selectIcon nav", function() {
						var t = $.trim($(this).data("class"));
						e && $(e).val(t).trigger("change"), a && $(a).removeAttr("class").addClass("icon " + t), modal.find(".close").click()
					})
				})
			})
		}
	}), $(document).on("click", '[data-toggle="selectIcon3"]', function() {
		var a = $(this).data("element"),
			i = $(this).data("input");
		if (i || a) {
			var t = biz.url("util/selecticon3");
			$.ajax(t, {
				type: "get",
				dataType: "html",
				cache: !1
			}).done(function(t) {
				var e = $("#selectIcon3");
				e.length || (console.log(e), $(document.body).append($('<div class="modal fade" id="selectIcon3"></div>'))), e.modal("show"), e.append2(t, function() {
					$(document).off("click", "#selectIcon3 nav").on("click", "#selectIcon3 nav", function() {
						var t = $.trim($(this).data("class"));
						i && $(i).val(t).trigger("change"), a && $(a).removeAttr("class").addClass("icox " + t), e.find(".close").click()
					})
				})
			})
		}
	}), $(document).on("click", '[data-toggle="selectAudio"]', function() {
		var i = $(this).data("input"),
			o = $(this).data("full");
		require(["jquery", "util"], function(a, t) {
			t.audio("", function(t) {
				var e = t.attachment;
				o && (e = t.url), i && a(i).val(e).trigger("change")
			})
		})
	}), $(document).on("click", '[data-toggle="selectVideo"]', function() {
		var i = $(this).data("input"),
			o = $(this).data("full"),
			e = $(this).data("network");
		require(["jquery", "util"], function(a, t) {
			t.audio("", function(t) {
				var e = t.attachment;
				!o && t.attachment || (e = t.url), i && a(i).val(e).trigger("change")
			}, {
				type: "video",
				netWorkVideo: e
			})
		})
	}), $(document).on("click", '[data-toggle="previewVideoDel"]', function(t) {
		t.stopPropagation();
		var e = $(this).data("element");
		$(e).val("")
	}), $(document).on("click", '[data-toggle="previewVideo"]', function() {
		var t = $(this).data("input");
		if (t) {
			var e = $(t).data("url") || $(t).val();
			e && "" != e ? (0 == e.indexOf("videos/") && (e = window.sysinfo.attachurl + e), $("#previewVideo").length < 1 ? $("body").append('<div class="modal fade" id="previewVideo"><div class="modal-dialog" style="min-width: 400px !important;"><div class="modal-content"><div class="modal-header"><button data-dismiss="modal" class="close" type="button">×</button><h4 class="modal-title">视频预览</h4></div><div class="modal-body" style="padding: 0; background: #000;"><video src="' + e + '" style="height: 450px; width: 100%; display: block;" controls="controls"></video><iframe src="../../../resource/js/web/' + e + '" style="height: 450px; width: 100%; border: 0;"></iframe></div></div></div></div>') : ($("#previewVideo video").attr("src", e), $("#previewVideo iframe").attr("src", e)), -1 < e.indexOf("v.qq.com") ? ($("#previewVideo video").remove(), $("#previewVideo iframe").show()) : ($("#previewVideo video").show(), $("#previewVideo iframe").remove()), $("#previewVideo").modal(), $("#previewVideo").on("hidden.bs.modal", function() {
				$(this).find("video").attr("src", ""), $(this).find("iframe").attr("src", "")
			})) : tip.msgbox.err("未选择视频")
		}
	}), $(window).resize(function() {
		$(window).width() <= 1440 ? ($(".wb-panel-fold").removeClass("in").html('<i class="icow icow-info"></i> 消息提醒'), $(".wb-panel").removeClass("in"), $(".wb-container").addClass("right-panel")) : ($(".wb-panel-fold").addClass("in").html('<i class="fa fa-angle-double-right"></i> 收起面板'), $(".wb-panel").addClass("in"), $(".wb-container").removeClass("right-panel"))
	}), $(window).scroll(function() {
		200 < $(window).scrollTop() ? $(".fixed-header").addClass("active") : $(".fixed-header").removeClass("active")
	}), $(".wb-nav-fold").click(function() {
		var t = $(this).closest(".wb-nav");
		t.hasClass("fold") ? (t.removeClass("fold"), $(".wb-header .logo").removeClass("small"), $(".fast-nav").removeClass("indent"), util.cookie.set("foldnav", 0)) : (t.addClass("fold"), $(".wb-header .logo").addClass("small"), $(".fast-nav").addClass("indent"), util.cookie.set("foldnav", 1))
	}), $(".wb-subnav-fold").click(function() {
		var t = $(this).closest(".wb-subnav");
		t.hasClass("fold") ? t.removeClass("fold") : t.addClass("fold")
	}), $(".menu-header").click(function() {
		$(this).hasClass("active") ? ($(this).next("ul").eq(0).hide(), $(this).find(".menu-icon").removeClass("fa-caret-down").addClass("fa-caret-right"), $(this).removeClass("active")) : ($(this).next("ul").eq(0).show(), $(this).find(".menu-icon").removeClass("fa-caret-right").addClass("fa-caret-down"), $(this).addClass("active"))
	}), $(".wb-header-btn").click(function() {
		if ($(".wb-topbar-search").hasClass("expand-search")) {
			$(".wb-search-box").focus();
			var t = $.trim($(".wb-search-box").val());
			if ("" != t) return void(location.href = "./index.php?c=site&a=entry&m="+module_name+"&do=system&r=sys.search&keyword=" + t)
		}
	}), $(".wb-search-box").bind("input propertychange", function() {
		var i = $.trim($(this).val()),
			t = $(this).data("merch") || 0;
		if ("" == i) return $(".wb-search-result ul").empty(), $(".wb-search-result").hide(), void $(".wb-search-box").val("");
		$.getJSON(biz.url("system.sys.fastlist", null, t), {
			keyword: i
		}, function(t) {
			var e = t.result,
				a = "";
				console.log(t);
			$(".wb-search-result ul").empty(),e.menu.length<1?a='<li class="empty-data"><a>"暂未搜索到与"'+i+'"相关功能"</a></li>':$.each(e.menu,function(t,e){a+='<li><a href="'+e.url+'">'+e.title+"</a></li>"}),$(".wb-search-result ul").html(a),$(".wb-search-result").show()})}),$(".wb-header-logout").click(function(){var t=$(this).closest("li").data("href");
			tip.confirm("当前已登录，确认退出？",function(){location.href=t})}),$(".wb-panel-fold").click(function(){$(this).toggleClass("in"),$(".wb-panel").toggleClass("in"),$(this).hasClass("in")?($(this).html('<i class="fa fa-angle-double-right"></i> 收起面板'),util.cookie.set("foldpanel",0),$(".wb-container").removeClass("right-panel")):($(this).html('<i class="icow icow-info"></i> 消息提醒'),util.cookie.set("foldpanel",1),$(".wb-container").addClass("right-panel"))}),$(".wb-shortcut").click(function(){$(this).hasClass("active")?($(this).removeClass("active"),$(".fast-nav").removeClass("in")):($(this).addClass("active"),$(".fast-nav").addClass("in"))}),$(".fast-list.menu a").hover(function(){$(this).addClass("active").siblings().removeClass("active");var t=$(this).data("tab");$(".fast-list.list [data-tab='"+t+"']").addClass("in").siblings(".in").removeClass("in"),$(".funbar-panel").hide(),$("#funbar-name").val(""),$("#funbar-color").val("#666666")}),$(".funbar-add-btn").click(function(){$(".funbar-panel").show(),$("#funbar-bold-0").prop("checked","checked")}),$(".funbar-cancel-btn").click(function(){$(".funbar-panel").hide(),$("#funbar-name").val(""),$("#funbar-color").val("#666666")}),$(".funbar-save-btn").click(function(){var a=$.trim($("#funbar-name").val());
			if ("" != a) {
				var i = $("#funbar-color").val(),
					o = $("#funbar-bold-1").is(":checked") ? 1 : 0,
					n = $("#funbar-link").val(),
					t = {
						href: n,
						text: a,
						color: i,
						bold: o
					};
				$.post(biz.url("sysset/funbar/post"), {
					funbardata: t
				}, function(t) {
					if (1 == t.status) {
						var e = '<a href="' + n + '" style=" ';
						1 == o && (e += "font-weight: bold;"), "#666666" != i && (e += "color: " + i + ";"), e += '">' + a + "</a>", $("#funbar-list").prepend(e), $(".funbar-panel").hide(), $("#funbar-name").val(""), $("#funbar-color").val("#666666")
					} else tip.msgbox.err("保存失败请重试！")
				}, "json")
			} else tip.msgbox.err("请输入导航名称")
		}), $("#btn-clear-history").click(function() {
			var t = $(this).data("merch") || 0;
			tip.confirm("确认清除最近访问吗？", function() {
				$.post(biz.url("clearhistory", null, t), {
					type: 0
				}, function(t) {
					$(".fast-list.history").remove()
				})
			})
		}), $(document).click(function(t) {
			$(t.target).closest(".wb-shortcut").length || $(t.target).closest(".fast-nav").length || ($(".wb-shortcut").removeClass("active"), $(".fast-nav").removeClass("in"))
		}), 0 < $(".form-editor-group").length && ($(".form-editor-group .form-editor-btn").click(function() {
			var t = $(this).closest(".form-editor-group");
			t.find(".form-editor-show").hide(), t.find(".form-editor-edit").css("display", "table")
		}), $(".form-editor-group .form-editor-finish").click(function() {
			if (!$(this).closest(".form-group").hasClass("has-error")) {
				var t = $(this).closest(".form-editor-group");
				t.find(".form-editor-show").show(), t.find(".form-editor-edit").hide();
				var e = t.find(".form-editor-input"),
					a = $.trim(e.val());
				t.find(".form-editor-text").text(a)
			}
		})), $("img").error(function() {
			$(this).attr("src", "../web/resource_v2/images/nopic.png")
		}),util.cookie.get("foldpanel")!=0 ? (
				$(".wb-panel-fold").removeClass("in").html('<i class="icow icow-info"></i> 消息提醒'),$(".wb-panel").removeClass("in"), $(".wb-container").addClass("right-panel")):(
				$(".wb-panel-fold").addClass("in").html('<i class="fa fa-angle-double-right"></i> 收起面板'),$(".wb-panel").addClass("in"),$(".wb-container").removeClass("right-panel")
		),util.cookie.get("foldnav")==1 ? (
			$(".wb-nav").addClass("fold"), $(".wb-header .logo").addClass("small"),$(".fast-nav").addClass("indent")):(
			$(".wb-nav").removeClass("fold"), $(".wb-header .logo").removeClass("small"),$(".fast-nav").removeClass("indent")
		)
	});