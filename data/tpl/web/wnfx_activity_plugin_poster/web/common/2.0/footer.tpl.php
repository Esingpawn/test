<?php defined('IN_IA') or exit('Access Denied');?></div>
<div class="container-fluid footer text-center" role="footer" style="margin-bottom:65px;border:none">	
	<div class="copyright"><?php  if(empty($_W['setting']['copyright']['footerleft'])) { ?>Powered by <a href="http://www.w7.cc"><b>微擎</b></a> v<?php echo IMS_VERSION;?> &copy; 2014-2018 <a href="http://www.w7.cc">www.w7.cc</a><?php  } else { ?><?php  echo $_W['setting']['copyright']['footerleft'];?><?php  } ?></div>
	<div>
		<?php  if(!empty($_W['setting']['copyright']['policeicp']['policeicp_location']) && !empty($_W['setting']['copyright']['policeicp']['policeicp_code'])) { ?>
			<a target="_blank" href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=<?php  echo $_W['setting']['copyright']['policeicp']['policeicp_code']?>">
                &nbsp;&nbsp;<img src="./resource/images/icon-police.png" >
				<?php  echo $_W['setting']['copyright']['policeicp']['policeicp_location']?> <?php  echo $_W['setting']['copyright']['policeicp']['policeicp_code']?>号
			</a>
		<?php  } ?>
	</div>
</div>

</div>
</div>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include fx_template('common/2.0/footer-base', TEMPLATE_INCLUDEPATH)) : (include fx_template('common/2.0/footer-base', TEMPLATE_INCLUDEPATH));?>
<!--script>
	require(["slimscroll"],function(){
		$(".container").slimscroll({width:"auto",height:"calc(100vh - 120px)",opacity:.4});
		$(".container").parent().css({"margin-left":"200px"});
	});
</script-->
<style>
div.skin-2~div#tips-container{display:flex;left:50%;}
</style>
</body>
</html>