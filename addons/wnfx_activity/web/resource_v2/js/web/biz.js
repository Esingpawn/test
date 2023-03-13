define(["jquery"], function($) {
	var biz = {
		url: function(t, e, a) {
			if (a) var i = "./merchant.php?c=site&a=entry&m=" + module_name + "&do=web&r=" + t.replace(/\//gi, ".");
			else i = "./index.php?c=site&a=entry&m=" + module_name + "&do=web&r=" + t.replace(/\//gi, ".");
			return e && ("object" == typeof e ? i += "&" + $.toQueryString(e) : "string" == typeof e && (i += "&" + e)), i;
			console.log(i);
		}
	};
	return biz.selector = {
		select: function(t) {
			var e = void 0 === (t = $.extend({}, t || {})).name ? "default" : t.name,
				a = e + "-selector-modal";
			if (modalObj = $("#" + a), modalObj.length <= 0) {
				var i = '<div id="' + a + '"  class="modal fade" tabindex="-1" style="z-index: 2080">';
				i += '<div class="modal-dialog" style="width: 920px;">', i += '<div class="modal-content">', i += '<div class="modal-header"><button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button><h3>数据选择器</h3></div>', i += '<div class="modal-body" >', i += '<div class="row">', i += '<div class="input-group">', i += '<input type="text" class="form-control" name="keyword" id="' + e + '_input" placeholder="' + (void 0 === t.placeholder ? "" : t.placeholder) + '" />', i += '<span class="input-group-btn"><button type="button" class="btn btn-default" onclick="biz.selector.search(this, \'' + e + "');\">搜索</button></span>", i += "</div>", i += "</div>", i += '<div class="content" style="padding-top:5px;" data-name="' + e + '"></div>', i += "</div>", i += '<div class="modal-footer"><a href="#" class="btn btn-default" data-dismiss="modal" aria-hidden="true">关闭</a></div>', i += "</div>", i += "</div>", modalObj = $(i += "</div>"), modalObj.on("show.bs.modal", function() {
					"1" == t.autosearch && $.get(t.url, {
						keyword: ""
					}, function(t) {
						$(".content", modalObj).html(t)
					})
				})
			}
			modalObj.modal("show")
		},
		search: function(t, e) {
			var a = $(t).closest(".modal").find("#" + e + "_input"),
				i = $("#" + e + "_selector"),
				l = !0;
			"1" == i.data("nokeywords") && (l = !1);
			var d = $.trim(a.val());
			if ("" == d && l) a.focus();
			else {
				var o = $("#" + e + "-selector-modal");
				$(".content", o).html("正在搜索...."), $.get(i.data("url"), {
					keyword: d
				}, function(t) {
					$(".content", o).html(t)
				})
			}
		},
		remove: function(t, e) {
			var a = $("#" + e + "_selector"),
				i = "image" == a.data("type") ? ".multi-item" : ".multi-audio-item";
			i = "image" == a.data("type") ? ".multi-item" : "coupon" == a.data("type") ? ".multi-product-item" : "coupon_cp" == a.data("type") ? ".multi-product-item" : "coupon_share" == a.data("type") ? ".multi-product-item" : "coupon_shares" == a.data("type") ? ".multi-product-item" : ".multi-audio-item", $(t).closest(i).remove(), biz.selector.refresh(e)
		},
		set: function(obj, data) {
			var name = $(obj).closest(".content").data("name"),
				modalObj = $("#" + name + "-selector-modal"),
				selector = $("#" + name + "_selector"),
				container = $(".container", selector),
				key = selector.data("key") || "id",
				text = selector.data("text") || "title",
				thumb = selector.data("thumb") || "thumb",
				multi = selector.data("multi") || 0,
				type = selector.data("type") || "image",
				callback = selector.data("callback") || "",
				css = "image" == type ? ".multi-item" : ".multi-audio-item";
			if (0 < $(css + "[data-" + key + '="' + data[key] + '"]', container).length) 0 === multi && modalObj.modal("hide"),1 === multi && tip.msgbox.err("已经存在了！");
			else if ("coupon_cp" == type && 3 <= $(".setticket").length) tip.msgbox.err("您已经选择了三张优惠券，若要更换请删除其他优惠券！");
			else if ("coupon_share" == type && 3 <= $(".shareticket").length) tip.msgbox.err("您已经选择了三张优惠券，若要更换请删除其他优惠券！");
			else if ("coupon_shares" == type && 3 <= $(".sharesticket").length) tip.msgbox.err("您已经选择了三张优惠券，若要更换请删除其他优惠券！");
			else {
				var id = 0 === multi ? name : name + "[]",
					html = "";
				if ("image" == type ? (html += '<div class="multi-item" data-' + key + '="' + data[key] + '" data-name="' + name + '">', html += '<img class="img-responsive img-thumbnail" src="' + data[thumb] + '" onerror="this.src=\'../addons/'+module_name+'/static/images/nopic.png\'" style="width:100px;height:100px;">', html += '<div class="img-nickname">' + data[text] + "</div>", html += '<input type="hidden" value="' + data[key] + '" name="' + id + '">', html += "<em onclick=\"biz.selector.remove(this,'" + name + '\')"  class="close">×</em>', html += "</div>") : "coupon" == type ? (html += "<tr class='multi-product-item' data-" + key + "='" + data[key] + "'>", html += "<input type='hidden' class='form-control img-textname' readonly='' value='" + data[text] + "'>", html += "<input type='hidden' value='" + data[key] + "' name='couponid[]'>", html += "<td style='width:80px;'><img src='" + data[thumb] + "' style='width:70px;border:1px solid #ccc;padding:1px'></td>", html += "<td style='width:220px;'>" + data[text] + "</td>", html += "<td><input class='form-control valid' type='text' value='' name='coupontotal" + data[key] + "'></td>", html += "<td><input class='form-control valid' type='text' value='' name='couponlimit" + data[key] + "'></td>", html += "<td style='width:80px;'><button class='btn btn-default' onclick='biz.selector.remove(this,\"" + name + "\")' type='button'><i class='fa fa-remove'></i></button></td></tr>") : "coupon_cp" == type ? (html += "<tr class='multi-product-item setticket' data-" + key + "='" + data[key] + "'>", html += "<input type='hidden' class='form-control img-textname' readonly='' value='" + data[text] + "'>", html += "<input type='hidden' value='" + data[key] + "' name='couponid[]'>", html += "<td style='width:80px;'><img src='" + data[thumb] + "' style='width:70px;border:1px solid #ccc;padding:1px'></td>", html += "<td style='width:220px;'>" + data[text] + "</td>", html += "<td></td>", html += "<td></td>", html += "<td style='width:80px;'><button class='btn btn-default' onclick='biz.selector.remove(this,\"" + name + "\")' type='button'><i class='fa fa-remove'></i></button></td></tr>") : "coupon_share" == type ? (html += "<tr class='multi-product-item shareticket' data-" + key + "='" + data[key] + "'>", html += "<input type='hidden' class='form-control img-textname' readonly='' value='" + data[text] + "'>", html += "<input type='hidden' value='" + data[key] + "' name='couponid[]'>", html += "<td style='width:80px;'><img src='" + data[thumb] + "' style='width:70px;border:1px solid #ccc;padding:1px'></td>", html += "<td style='width:220px;'>" + data[text] + "</td>", html += "<td></td>", html += "<td><input class='form-control valid' type='text' value='1' name='couponnum" + data[key] + "'></td>", html += "<td style='width:80px;'><button class='btn btn-default' onclick='biz.selector.remove(this,\"" + name + "\")' type='button'><i class='fa fa-remove'></i></button></td></tr>") : "coupon_shares" == type ? (html += "<tr class='multi-product-item sharesticket' data-" + key + "='" + data[key] + "'>", html += "<input type='hidden' class='form-control img-textname' readonly='' value='" + data[text] + "'>", html += "<input type='hidden' value='" + data[key] + "' name='couponids[]'>", html += "<td style='width:80px;'><img src='" + data[thumb] + "' style='width:70px;border:1px solid #ccc;padding:1px' class='img_share'></td>", html += "<td style='width:220px;'>" + data[text] + "</td>", html += "<td></td>", html += "<td><input class='form-control valid' type='text' value='1' name='couponsnum" + data[key] + "'></td>", html += "<td style='width:80px;'><button class='btn btn-default' onclick='biz.selector.remove(this,\"" + name + "\")' type='button'><i class='fa fa-remove'></i></button></td></tr>") : (html += "<div class='multi-audio-item' data-" + key + "='" + data[key] + "' data-name='" + name + "'>", html += "<div class='input-group'><input type='hidden' name='" + id + "' value='" + data[key] + "'> ", html += "<input type='text' class='form-control img-textname' readonly='' value='" + data[text] + "'>", html += "<div class='input-group-btn'><button class='btn btn-default' onclick='biz.selector.remove(this,\"" + name + "\")' type='button'><i class='fa fa-remove'></i></button></div></div></div>"), 0 === multi ? (container.html(html), modalObj.modal("hide")) : container.append(html), biz.selector.refresh(name), "" !== callback) {
					var callfunc = eval(callback);
					void 0 !== callfunc && callfunc(data, obj)
				}
			}
		},
		refresh: function(t) {
			var e = "",
				a = $("#" + t + "_selector"),
				i = a.data("type") || "image";
			"image" == i ? $(".multi-item", a).each(function() {
				e += " " + $(this).find(".img-nickname").html(), 1 < $(".multi-item", a).length && (e += "; ")
			}) : "coupon" == i ? $(".multi-product-item", a).each(function() {
				e += " " + $(this).find(".img-textname").val(), 1 < $(".multi-product-item", a).length && (e += "; ")
			}) : "coupon_cp" == i ? $(".multi-product-item", a).each(function() {
				e += " " + $(this).find(".img-textname").val(), 1 < $(".multi-product-item", a).length && (e += "; ")
			}) : "coupon_share" == i ? $(".multi-product-item", a).each(function() {
				e += " " + $(this).find(".img-textname").val(), 1 < $(".multi-product-item", a).length && (e += "; ")
			}) : "coupon_shares" == i ? $(".multi-product-item", a).each(function() {
				e += " " + $(this).find(".img-textname").val(), 1 < $(".multi-product-item", a).length && (e += "; ")
			}) : $(".multi-audio-item", a).each(function() {
				e += " " + $(this).find(".img-textname").val(), 1 < $(".multi-audio-item", a).length && (e += "; ")
			}), $("#" + t + "_text", a).val(e)
		}
	}, biz.selector_new = {
		select: function(t) {
			var e = void 0 === (t = $.extend({}, t || {})).name ? "default" : t.name,
				a = e + "-selector-modal";
			if (modalObj = $("#" + a), typeof window._url && (window._url = ""), window._url = t.url, modalObj.length <= 0) {
				var i = '<div id="' + a + '"  class="modal fade" tabindex="-1">';
				i += '<div class="modal-dialog" style="width: 920px;">', i += '<div class="modal-content">', i += '<div class="modal-header"><button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button><h3>数据选择器</h3></div>', i += '<div class="modal-body" >', i += '<div class="row">', i += '<div class="input-group">', i += '<input type="text" class="form-control" name="keyword" id="' + e + '_input" placeholder="' + (void 0 === t.placeholder ? "" : t.placeholder) + '" />', i += '<span class="input-group-btn"><button type="button" class="btn btn-default" onclick="biz.selector_new.search(this, \'' + e + "');\">搜索</button></span>", i += "</div>", i += "</div>", i += '<div class="content" style="padding-top:5px;" data-name="' + e + '"></div>', i += "</div>", i += '<div class="modal-footer"><a href="#" class="btn btn-default" data-dismiss="modal" aria-hidden="true">关闭</a></div>', i += "</div>", i += "</div>", modalObj = $(i += "</div>"), modalObj.on("show.bs.modal", function() {
					"1" == t.autosearch && $.get(_url, {
						keyword: ""
					}, function(t) {
						$(".content", modalObj).html(t)
					})
				})
			}
			modalObj.modal("show")
		},
		search: function(t, e) {
			var a = $(t).closest(".modal").find("#" + e + "_input"),
				i = $("#" + e + "_selector"),
				l = !0;
			"1" == i.data("nokeywords") && (l = !1);
			var d = $.trim(a.val());
			if ("" == d && l) a.focus();
			else {
				var o = $("#" + e + "-selector-modal");
				$(".content", o).html("正在搜索...."), $.get(i.data("url"), {
					keyword: d
				}, function(t) {
					$(".content", o).html(t)
				})
			}
		},
		remove: function(t, e) {
			var a = "image" == $("#" + e + "_selector").data("type") ? ".multi-item" : ".multi-product-item";
			$(t).closest(a).remove(), biz.selector_new.refresh(e)
		},
		set: function(obj, data) {
			var name = $(obj).closest(".content").data("name"),
				modalObj = $("#" + name + "-selector-modal"),
				selector = $("#" + name + "_selector"),
				key = selector.data("key") || "id",
				text = selector.data("text") || "title",
				thumb = selector.data("thumb") || "thumb",
				multi = selector.data("multi") || 0,
				type = selector.data("type") || "image",
				callback = selector.data("callback") || "",
				css = "image" == type ? ".multi-item" : ".multi-product-item",
				optionurl = selector.data("optionurl") || "",
				selectorid = selector.data("selectorid") || "",
				container = $(".container", selector);
			if (0 < $(css + "[data-" + key + '="' + data[key] + '"]', container).length) 0 === multi && modalObj.modal("hide");
			else {
				var id = 0 === multi ? name : name + "[]",
					html = "";
				if ("image" == type) html += '<div class="multi-item" data-' + key + '="' + data[key] + '" data-name="' + name + '">', html += '<img class="img-responsive img-thumbnail" src="' + data[thumb] + '" >', html += '<div class="img-nickname">' + data[text] + "</div>", html += '<input type="hidden" value="' + data[key] + '" name="' + id + '">', html += "<em onclick=\"biz.selector_new.remove(this,'" + name + '\')"  class="close">×</em>', html += "</div>";
				else if ("product" == type) {
					var optionurl = "" == optionurl ? "sale.package.hasoption" : optionurl,
						url = "index.php?c=site&a=entry&m="+module_name+"&do=web&r=" + optionurl + "&goodsid=" + data[key] + "&selectorid=" + selectorid;
					html += '<tr class="multi-product-item" data-' + key + '="' + data[key] + '" data-name="' + name + '">', html += "<input type='hidden' name='" + id + "' value='" + data[key] + "'> ", html += "<input type='hidden' class='form-control img-textname' value='" + data[text] + "'>", html += '<td style="width:80px;"><img src="' + data[thumb] + '" style="width:70px;border:1px solid #ccc;padding:1px" /></td>', html += '<td style="width:220px;">' + data[text] + "</td>", html += "<td><a class='btn btn-default btn-sm' data-toggle='ajaxModal' href='" + url + "' id='" + selectorid + "optiontitle" + data[key] + "'>设置</a><input type='hidden' id='" + selectorid + "packagegoods" + data[key] + "' value='' name='" + selectorid + "packagegoods[" + data[key] + "]'></td>", html += '<td><a href="javascript:void(0);" class="btn btn-default btn-sm" onclick="biz.selector_new.remove(this,\'' + name + '\')" title="删除">', html += '<i class="fa fa-times"></i></a></td></tr>'
				} else if ("fullback" == type) {
					var optionurl = "" == optionurl ? "sale.fullback.hasoption" : optionurl,
						url = "index.php?c=site&a=entry&m="+module_name+"&do=web&r=" + optionurl + "&goodsid=" + data[key] + "&selectorid=" + selectorid;
					html += '<tr class="multi-product-item" data-' + key + '="' + data[key] + '" data-name="' + name + '">', html += "<input type='hidden' name='" + id + "' value='" + data[key] + "'> ", html += "<input type='hidden' class='form-control img-textname' value='" + data[text] + "'>", html += '<td style="width:80px;"><img src="' + data[thumb] + '" style="width:70px;border:1px solid #ccc;padding:1px" /></td>', html += '<td style="width:220px;">' + data[text] + "</td>", html += "<td><a class='btn btn-default btn-sm' data-toggle='ajaxModal' href='" + url + "' id='" + selectorid + "optiontitle" + data[key] + "'>设置</a><input type='hidden' id='" + selectorid + "fullbackgoods" + data[key] + "' value='' name='" + selectorid + "fullbackgoods[" + data[key] + "]'></td>", html += '<td><a href="javascript:void(0);" class="btn btn-default btn-sm" onclick="biz.selector_new.remove(this,\'' + name + '\')" title="删除">', html += '<i class="fa fa-times"></i></a></td></tr>'
				} else if ("live" == type) {
					var optionurl = "" == optionurl ? "live.room.hasoption" : optionurl,
						url = "index.php?c=site&a=entry&m="+module_name+"&do=web&r=" + optionurl + "&goodsid=" + data[key] + "&selectorid=" + selectorid;
					html += '<tr class="multi-product-item" data-' + key + '="' + data[key] + '" data-name="' + name + '">', html += "<input type='hidden' name='" + id + "' value='" + data[key] + "'> ", html += "<input type='hidden' class='form-control img-textname' value='" + data[text] + "'>", html += '<td style="width:80px;"><img src="' + data[thumb] + '" style="width:70px;border:1px solid #ccc;padding:1px" /></td>', html += '<td style="width:220px;">' + data[text] + "</td>", html += "<td><a class='btn btn-default btn-sm' data-toggle='ajaxModal' href='" + url + "' id='" + selectorid + "optiontitle" + data[key] + "'>设置</a><input type='hidden' id='" + selectorid + "livegoods" + data[key] + "' value='' name='" + selectorid + "livegoods[" + data[key] + "]'></td>", html += '<td><a href="javascript:void(0);" class="btn btn-default btn-sm" onclick="biz.selector_new.remove(this,\'' + name + '\')" title="删除">', html += '<i class="fa fa-times"></i></a></td></tr>'
				} else "card" == type ? (html += '<tr class="multi-product-item" data-' + key + '="' + data[key] + '" data-name="' + name + '">', html += "<input type='hidden' name='" + id + "' value='" + data[key] + "'> ", html += "<input type='hidden' class='form-control img-textname' value='" + data[text] + "'>", html += '<td style="width:80px;"><img src="' + data[thumb] + '" style="width:70px;border:1px solid #ccc;padding:1px" /></td>', html += '<td style="width:220px;">' + data[text] + "<input type='hidden' id='" + selectorid + "packagegoods" + data[key] + "' value='' name='" + selectorid + "packagegoods[" + data[key] + "]'></td>", html += '<td><a href="javascript:void(0);" class="btn btn-default btn-sm" onclick="biz.selector_new.remove(this,\'' + name + '\')" title="删除">', html += '<i class="fa fa-times"></i></a></td></tr>') : (html += "<div class='111 multi-audio-item' data-" + key + "='" + data[key] + "' data-name='" + name + "'>", html += "<div class='input-group'><input type='hidden' name='" + id + "' value='" + data[key] + "'> ", html += "<input type='text' class='form-control img-textname' readonly='' value='" + data[text] + "'>", html += "<div class='input-group-btn'><button class='btn btn-default' onclick='biz.selector_new.remove(this,\"" + name + "\")' type='button'><i class='fa fa-remove'></i></button></div></div></div>");
				if (0 === multi ? (container.html(html), modalObj.modal("hide")) : $("#param-items" + selectorid).append(html), biz.selector_new.refresh(name), "" !== callback) {
					var callfunc = eval(callback);
					void 0 !== callfunc && callfunc(data, obj)
				}
			}
		},
		refresh: function(t) {
			var e = "",
				a = $("#" + t + "_selector");
			"image" == (a.data("type") || "image") ? $(".multi-item", a).each(function() {
				e += " " + $(this).find(".img-nickname").html(), 1 < $(".multi-item", a).length && (e += "; ")
			}) : $(".multi-product-item", a).each(function() {
				e += " " + $(this).find(".img-textname").val(), 1 < $(".multi-product-item", a).length && (e += "; ")
			}), $("#" + t + "_text", a).val(e)
		}
	}, biz.selector_open = {
		callback: function() {},
		select: function(t) {
			t = $.extend({}, t || {}), biz.selector_open.callback = void 0 !== t.callback && t.callback;
			var e = void 0 === (biz.selector_open.params = t).name ? "default" : t.name,
				a = e + "-selector-modal";
			if (modalObj = $("#" + a), modalObj.length <= 0) {
				var i = '<div id="' + a + '"  class="modal fade" tabindex="-1">';
				i += '<div class="modal-dialog" style="width: 920px;">', i += '<div class="modal-content">', i += '<div class="modal-header"><button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button><h3>数据选择器</h3></div>', i += '<div class="modal-body" >', i += '<div class="row">', i += '<div class="input-group">', i += '<input type="text" class="form-control" name="keyword" id="' + e + '_input" placeholder="' + (void 0 === t.placeholder ? "" : t.placeholder) + '" />', i += '<span class="input-group-btn"><button type="button" class="btn btn-default" onclick="biz.selector_open.search(this, \'' + e + "');\">搜索</button></span>", i += "</div>", i += "</div>", i += '<div class="content" style="padding-top:5px;" data-name="' + e + '"></div>', i += "</div>", i += '<div class="modal-footer"><a href="#" class="btn btn-default" data-dismiss="modal" aria-hidden="true">关闭</a></div>', i += "</div>", i += "</div>", modalObj = $(i += "</div>"), modalObj.on("show.bs.modal", function() {
					"1" == t.autosearch && $.get(t.url, {
						keyword: ""
					}, function(t) {
						$(".content", modalObj).html(t)
					})
				})
			}
			modalObj.modal("show")
		},
		search: function(t, e) {
			var a = $(t).closest(".modal").find("#" + e + "_input"),
				i = ($("#" + e + "_selector"), !0),
				l = biz.selector_open.params;
			"1" == l.nokeywords && (i = !1);
			var d = $.trim(a.val());
			if ("" == d && i) a.focus();
			else {
				var o = $("#" + e + "-selector-modal");
				$(".content", o).html("正在搜索...."), $.get(l.url, {
					keyword: d
				}, function(t) {
					$(".content", o).html(t)
				})
			}
		},
		remove: function(t, e) {
			var a = "image" == biz.selector_open.params.type ? ".multi-item" : ".multi-audio-item";
			$(t).closest(a).remove(), biz.selector_open.refresh(e)
		},
		set: function(t, e) {
			var a = $(t).closest(".content").data("name"),
				i = $("#" + a + "-selector-modal");
			$("#" + a + "_selector");
			0 === (biz.selector_open.params.multi || 0) && i.modal("hide"), "function" == typeof biz.selector_open.callback && biz.selector_open.callback(e, t)
		}
	}, biz.map = function(t, l, e) {
		var d = $("#map-dialog");
		if (0 === d.length) {
			var a = '<div class="embed-responsive embed-responsive-16by9"><iframe  class="embed-responsive-item" src="' + e + '" scrolling="no"></iframe></div>';
			(d = util.dialog("请选择地点", a, '<button type="button" class="btn btn-default" data-dismiss="modal">取消</button><button type="button" class="btn btn-primary">确认</button>', {
				containerName: "map-dialog"
			})).find(".modal-dialog").css("width", "80%"), d.modal({
				keyboard: !1
			}), d.find(".input-group :text").keydown(function(t) {
				if (13 == t.keyCode) {
					var e = $(this).val();
					searchAddress(e)
				}
			}), d.find(".input-group button").click(function() {
				var t = $(this).parent().prev().val();
				searchAddress(t)
			})
		}
		d.find("button.btn-primary").off("click"), d.find("button.btn-primary").on("click", function() {
			if ($.isFunction(l)) {
				var t = d.find("iframe").contents().find("#poi_json").val();
				if ($.isEmpty(t)) return void tip.msgbox.err("尚未选择坐标!");
				var e = JSON.parse(d.find("iframe").contents().find("#poi_json").val()),
					a = d.find("iframe").contents().find("#addr_cur").val(),
					i = {
						lng: e.lng,
						lat: e.lat,
						label: a
					};
				l(i)
			}
			d.modal("hide")
		}), d.modal("show")
	}, util.maps = function(t, l, e) {
		var d = $("#map-dialog");
		if (0 === d.length) {
			var a = '<div class="embed-responsive embed-responsive-16by9"><iframe  class="embed-responsive-item" src="' + e + '" scrolling="no"></iframe></div>';
			(d = util.dialog("请选择地点", a, '<button type="button" class="btn btn-default" data-dismiss="modal">取消</button><button type="button" class="btn btn-primary">确认</button>', {
				containerName: "map-dialog"
			})).find(".modal-dialog").css("width", "80%"), d.modal({
				keyboard: !1
			}), d.find(".input-group :text").keydown(function(t) {
				if (13 == t.keyCode) {
					var e = $(this).val();
					searchAddress(e)
				}
			}), d.find(".input-group button").click(function() {
				var t = $(this).parent().prev().val();
				searchAddress(t)
			})
		}
		d.find("button.btn-primary").off("click"), d.find("button.btn-primary").on("click", function() {
			if ($.isFunction(l)) {
				var t = d.find("iframe").contents().find("#poi_json").val();
				if ($.isEmpty(t)) return void tip.msgbox.err("尚未选择坐标!");
				var e = JSON.parse(d.find("iframe").contents().find("#poi_json").val()),
					a = d.find("iframe").contents().find("#addr_cur").val(),
					ad = d.find("iframe").contents().find("#ad_info").val(),
					i = {
						lng: e.lng,
						lat: e.lat,
						label: a,
						adinfo: ad
					};
				l(i)
			}
			d.modal("hide")
		}), d.modal("show")
	}, biz.TxMapToBdMap = function(t, e) {
		var a = new Object,
			i = 52.35987755982988,
			l = new Number(e),
			d = new Number(t),
			o = Math.sqrt(l * l + d * d) + 2e-5 * Math.sin(d * i),
			n = Math.atan2(d, l) + 3e-6 * Math.cos(l * i),
			s = o * Math.cos(n) + .0065,
			m = o * Math.sin(n) + .006;
		return a.lng = s, a.lat = m, a
	}, biz.BdMapToTxMap = function(t, e) {
		var a = new Object,
			i = 52.35987755982988,
			l = new Number(e - .0065),
			d = new Number(t - .006),
			o = Math.sqrt(l * l + d * d) - 2e-5 * Math.sin(d * i),
			n = Math.atan2(d, l) - 3e-6 * Math.cos(l * i),
			s = o * Math.cos(n),
			m = o * Math.sin(n);
		return a.lng = s, a.lat = m, a
	},biz.ProgressBar = function(e, callback, urls, msg) {
		var obj=$(e), 
			page=1, 
			timeOut=0, 
			len=0, 
			param='',
			modal_form=obj.parents('form.form-ajax');
		msg = msg==undefined ? '数据处理中请稍后' : msg;
		var RunAjax = function(i){
			$.ajax({
				type: "POST",
				url: urls[0]+'&page='+i,
				data: param,
				async : false,//是否为同步
				dataType: 'json',
				success: function(ret) {
					console.log(ret);
					if (ret.status)	{
						var number = 100*i/len, f = number>=0.1 ? number.toFixed(1):(number<0.01?number.toFixed(5):number.toFixed(2));
						if (i == len) f = 100;
						$(".jconfirm").find(".progress .msg").html(msg + ' -- '+f+"%"),$(".jconfirm").find(".progress .bar").css('width',f+"%");
						if (i == len) {
							$(".jconfirm-box").css({'margin-left':'auto','margin-right':'auto'}).animate({opacity:0.01}, 150, function(){
								$('.jconfirm').remove();
								if ($.isFunction(callback)) {
									callback(ret.result)
								}
							});										
						}else{
							page++;
							timeOut = setTimeout(function() {RunAjax(page)}, 300);
						}
					}else
						tip.msgbox.err(ret.result.message || tip.lang.error, ret.result.url);
				},
				error:function(ret){
					console.log(ret);
					tip.msgbox.err(tip.lang.exception);
				}
			});
		},starter = function(){//开始
			RunAjax(page);
		},stoper = function(){//清除						
			clearTimeout(timeOut);
		}
		tip.progress(msg + ' -- 0%', function(){
			starter();
		}, function() {
			stoper();
		});	
		if (modal_form.length > 0) {
			myrequire(['jquery.form'],function() {
				var options = {
					type: 'POST',     // 设置表单提交方式
					url: urls[0],    // 设置表单提交URL,默认为表单Form上action的路径
					dataType: 'json',    // 返回数据类型
					beforeSubmit: function(formData, jqForm, option){    // 表单提交之前的回调函数，一般用户表单验证
						// formData: 数组对象,提交表单时,Form插件会以Ajax方式自动提交这些数据,格式Json数组,形如[{name:userName, value:admin},{name:passWord, value:123}]
						// jqForm: jQuery对象,，封装了表单的元素   
						// options: options对象
						var str = $.param(formData);    // name=admin&passWord=123
						var dom = jqForm[0];    // 将jqForm转换为DOM对象
						var name = dom.name.value;    // 访问jqForm的DOM元素
						/* 表单提交前的操作 */
						return true;  // 只要不返回false,表单都会提交  
					},
					success: function(ret, statusText, xhr, $form){  // 成功后的回调函数(返回数据由responseText获得)
						console.log(ret);
						len = ret.result.tpage, param = $.param($form.serializeArray());
						if (!ret.status || ret.result.tpage-1 < 0) {
							$(".jconfirm").find(".progress .msg").html(msg + ' -- '+100+"%"),$(".jconfirm").find(".progress .bar").css('width',100+"%");
							$('.jconfirm').remove();
							tip.msgbox.err(ret.result.message || tip.lang.error, ret.result.url);
							return false;
						}
						var number = 100*1/len, 
							f = number>=0.1 ? number.toFixed(1):(number<0.01?number.toFixed(5):number.toFixed(2));
						$(".jconfirm").find(".progress .msg").html(msg + ' -- '+f+"%"),$(".jconfirm").find(".progress .bar").css('width',f+"%");
						if (ret.result.tpage-1==0) {
							$(".jconfirm-box").css({'margin-left':'auto','margin-right':'auto'}).animate({opacity:0.01}, 150, function(){
								$('.jconfirm').remove();
								if ($.isFunction(callback)) {
									callback(ret.result)
								}
							});	
						}else{
							page++;
							setTimeout(function() {RunAjax(page)}, 300);
						}
					},  
					error: function(xhr, status, err) {
						console.log(xhr);
						console.log(status);
						console.log(err);
						tip.msgbox.err('操作失败!');
					},
					clearForm: false,
					resetForm: false
				}; 			    
				// 2.绑定ajaxSubmit()
				modal_form.ajaxSubmit(options);
				return false;   //防止表单自动提交
			});
		}else{
			//starter();
		}
		return false;
	}, window.biz = biz, biz
});