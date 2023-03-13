define(['jquery'], function($) {
	var tip = {};
	tip.lang = {
		"success": "操作成功",
		"error": "操作失败",
		"exception": "网络异常",
		"processing": "处理中..."
	};
	$('#tip-msgbox').remove();
	$("body", window.document).append('<div id="tip-msgbox" class="msgbox"></div>');
	window.msgbox = $("#tip-msgbox", window.document);
	tip.confirm = function(msg, callback, cancel_callback) {
		msg = msg.replace(/&lt;/g, "<");
		msg = msg.replace(/&gt;/g, ">");
		myrequire(['jquery.confirm'], function() {
			$.confirm({
				title: '提示',
				content: msg,
				confirmButtonClass: 'btn-primary',
				cancelButtonClass: 'btn-default',
				confirmButton: '确 定',
				cancelButton: '取 消',
				animation: 'top',
				confirm: function() {
					if (callback && typeof(callback) == 'function') {
						callback()
					}
				},
				cancel: function() {
					if (cancel_callback && typeof(cancel_callback) == 'function') {
						cancel_callback()
					}
				}
			})
		})
	}, tip.prompt = function(msg, options, password) {
		var callback = null;
		var maxlength = null;
		var required = false;
		var input_type = password ? 'password' : 'text';
		if (typeof options == 'function') {
			callback = options
		} else if (typeof options == 'object') {
			maxlength = options.maxlength || null;
			callback = options.callback && typeof options.callback == 'function' ? options.callback : null;
			required = options.required || false
		}
		var inputid = 'prompt_' + (+new Date());
		var max = maxlength ? " maxlength='" + maxlength + "' " : '';
		myrequire(['jquery.confirm'], function() {
			$.alert({
				title: '提示',
				content: "<p>" + msg + "</p><p><input id='" + inputid + "' type='" + input_type + "' class='form-control' name='confirm' placeholder='" + msg + "' " + max + " /></p>",
				confirmButtonClass: 'btn-primary',
				confirmButton: '确 定',
				closeIcon: true,
				animation: 'top',
				keyboardEnabled: true,
				onOpen: function() {
					setTimeout(function() {
						$('#' + inputid).focus()
					}, 100)
				},
				confirm: function() {
					var value = $('#' + inputid).val();
					if ($.trim(value) == '' && required) {
						$('#' + inputid).focus();
						return false
					}
					if (callback && typeof(callback) == 'function') {
						callback(value)
					}
				}
			})
		})
	}, tip.promptlive = function(msg, options, password) {
		var callback = null;
		var maxlength = null;
		var required = false;
		var input_type = password ? 'password' : 'text';
		if (typeof options == 'function') {
			callback = options
		} else if (typeof options == 'object') {
			maxlength = options.maxlength || null;
			callback = options.callback && typeof options.callback == 'function' ? options.callback : null;
			required = options.required || false
		}
		var inputid = 'prompt_' + (+new Date());
		var max = maxlength ? " maxlength='" + maxlength + "' " : '';
		myrequire(['jquery.confirm'], function() {
			$.alert({
				title: '提示',
				content: "<p>" + msg + "</p><p><input id='" + inputid + "' type='" + input_type + "' class='form-control' name='confirm' placeholder='' " + max + " /></p>",
				confirmButtonClass: 'btn-primary',
				confirmButton: '确 定',
				closeIcon: true,
				animation: 'top',
				keyboardEnabled: true,
				onOpen: function() {
					setTimeout(function() {
						$('#' + inputid).focus()
					}, 100)
				},
				confirm: function() {
					var value = $('#' + inputid).val();
					if ($.trim(value) == '' && required) {
						$('#' + inputid).focus();
						return false
					}
					if (callback && typeof(callback) == 'function') {
						callback(value);
						return false
					}
				}
			})
		})
	}, tip.alert = function(msg, callback) {
		msg = msg.replace(/&lt;/g, "<");
		msg = msg.replace(/&gt;/g, ">");
		myrequire(['jquery.confirm'], function() {
			$.alert({
				title: '提示',
				content: msg,
				confirmButtonClass: 'btn-primary',
				confirmButton: '确 定',
				animation: 'top',
				confirm: function() {
					if (callback && typeof(callback) == 'function') {
						callback()
					}
				}
			})
		})
	}, tip.progress = function (msg, callback, cancel_callback) {
        msg = msg.replace(/&lt;/g,"<");
        msg = msg.replace(/&gt;/g,">");
        myrequire(['jquery.confirm'],function(){
            $.alert({
                title: '',
                content: "<div class='progress' style='height:auto;'><p class='msg text-center'>" + msg + "</p><p style='position:relative;height:6px;border-radius:7px;background:#ddd;border:1px solid #666;padding: 0 1px;'><span class='bar' style='position:relative;top:1px;display:block;height:2px;border-radius:3px;background:#2187e7;box-shadow:0px 0px 10px 1px rgba(0,198,255,0.4);width:0%;transition:width 0.6s;-moz-transition:width 0.6s;-webkit-transition:width 0.6s;-o-transition: width 2s;'></span></p><div class='buttons' style='margin:15px 0 0 0;padding:0'><button type='button' class='btn btn-primary'>暂 停</button/div></div>",
                confirmButtonClass: 'btn-primary',
                confirmButton: false,
                animation: 'top',
                closeIcon: false
            });
            $('.progress .buttons button').click(function () {
                if($(this).text()=='暂 停'){
                    $(this).text('继 续');
                    cancel_callback();
                }else{
                    $(this).text('暂 停');
                    callback();
					var jc = $.confirm({title: 'awesome'});
					jc.close();
				}
            })
        });

    },1;
	var Notify = function(element, options) {
			this.$element = $(element);
			this.options = $.extend({}, $.fn.notify.defaults, options);
			var cls = this.options.type ? "msg-" + this.options.type : "msg-success";
			var $note = '<span class="msg ' + cls + '">' + this.options.message + '</span>';
			this.$element.html($note);
			return this
		};
	Notify.prototype.show = function() {
		this.$element.addClass('in'), this.$element.append(this.$note);
		var autoClose = this.options.autoClose || true;
		if (autoClose) {
			var self = this;
			setTimeout(function() {
				self.close()
			}, this.options.delay || 2000)
		}
	}, Notify.prototype.close = function() {
		var self = this;
		self.$element.removeClass('in').transitionEnd(function() {
			self.$element.empty();
			if (self.options.onClosed) {
				self.options.onClosed(self)
			}
		});
		if (self.options.onClose) {
			self.options.onClose(self)
		}
	}, $.fn.notify = function(options) {
		return new Notify(this, options)
	}, $.fn.notify.defaults = {
		type: "success",
		delay: 3000,
		message: ''
	}, tip.msgbox = {
		show: function(options) {
			if (options.url) {
				options.url = options.url.replace(/&amp;/ig, "&");
				options.onClose = function() {
					redirect(options.url)
				}
			}
			if (options.message && options.message.length > 17) {
				tip.alert(options.message, function() {
					if (options.url) {
						redirect(options.url)
					}
				});
				return
			}
			notify = window.msgbox.notify(options), notify.show()
		},
		suc: function(msg, url, onClose, onClosed) {
			tip.msgbox.show({
				delay: 2000,
				type: "success",
				message: msg,
				url: url,
				onClose: onClose,
				onClosed: onClosed
			})
		},
		err: function(msg, url, onClose, onClosed) {
			tip.msgbox.show({
				delay: 2000,
				type: "error",
				message: msg,
				url: url,
				onClose: onClose,
				onClosed: onClosed
			})
		}
	}, tip.impower = function(msg, callback, cancel_callback) {
		msg = msg.replace(/&lt;/g, "<");
		msg = msg.replace(/&gt;/g, ">");
		myrequire(['jquery.confirm'], function() {
			$.confirm({
				title: '  ',
				content: msg,
				confirmButtonClass: 'btn-default',
				cancelButtonClass: 'btn-primary',
				confirmButton: '重新上传',
				cancelButton: '审核完成',
				animation: 'top',
				closeIcon: true,
				confirm: function() {
					if (callback && typeof(callback) == 'function') {
						callback()
					}
				},
				cancel: function() {
					if (cancel_callback && typeof(cancel_callback) == 'function') {
						cancel_callback()
					}
				}
			})
		})
	};
	window.tip = tip
});
