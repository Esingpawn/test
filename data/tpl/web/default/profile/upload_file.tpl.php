<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('profile/common', TEMPLATE_INCLUDEPATH)) : (include template('profile/common', TEMPLATE_INCLUDEPATH));?>
<div class="main">
	<form id="form21" action="<?php  echo url('profile/common/upload_file')?>" method="post" class="we7-form form" enctype="multipart/form-data">
		<div class="alert we7-page-alert">
				设置JS接口安全域名，需要上传的文件。 
		</div>
		<table class="we7-table table-hover table-form">
			<col width="150px"/>
			<col />
			<col width="150px"/>
			<tr>
				<th>上传js接口文件</th>
				<th></th>
				<th></th>
			</tr>
			<tr>
				<td>上传文件</td>
				<td class="color-gray"></td>
				<td class="text-right">
					<div class="link-group">
						<a href="javascript:;"  data-toggle="modal" data-target="#jsauth_acid">修改</a>
					</div>
				</td>
			</tr>
		</table>
		<div class="modal fade" id="jsauth_acid" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="we7-modal-dialog modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
							<div class="modal-title">选择公众号</div>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<label class="col-xs-12 col-sm-3 col-md-2 control-label">上传文件</label>
								<div class="col-sm-8">
									<input type="file" name="file" value="">
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
							<input type="submit" class="btn btn-primary" name="submit" value="上传" />
							<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
						</div>
					</div>
				</div>
			</div>
	</form>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>

