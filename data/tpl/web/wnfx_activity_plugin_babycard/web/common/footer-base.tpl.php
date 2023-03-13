<?php defined('IN_IA') or exit('Access Denied');?>    </div>
    <div class="container-fluid footer text-center" role="footer" style="<?php echo substr(IMS_VERSION, 0, 1)>=2?'':''?>">	
        <div class="copyright">
        <?php  if(empty($_W['setting']['copyright']['footerleft'])) { ?>
        	Powered by <a href="http://www.we7.cc"><b>微擎</b></a> v<?php echo IMS_VERSION;?> © 2014-2015 <a href="http://www.we7.cc">www.we7.cc</a>
        <?php  } else { ?>
        	<?php  echo $_W['setting']['copyright']['footerleft'];?>
        <?php  } ?></div>
        <?php  if(!empty($_W['setting']['copyright']['icp'])) { ?><div>备案号：<a href="http://www.miitbeian.gov.cn" target="_blank"><?php  echo $_W['setting']['copyright']['icp'];?></a></div><?php  } ?>
    </div>
    <?php  if(!empty($_W['setting']['copyright']['statcode'])) { ?><?php  echo $_W['setting']['copyright']['statcode'];?><?php  } ?>
</div>
<script>
//会员搜索
function search_members() {
	if( $.trim($('#member-kwd').val())==''){
		util.tips('请输入关键词');
		$('#member-kwd').focus();
		return;
	}
	$("#module-member").html("正在搜索....")
	$.get("?c=site&a=entry&m=wnfx_activity&do=member&ac=member&op=selectmember", {
		keyword: $.trim($('#member-kwd').val())
	}, function(dat){
		$('#module-member').html(dat);
	});
}
</script>
</body>
</html>