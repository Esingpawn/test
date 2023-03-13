<?php defined('IN_IA') or exit('Access Denied');?><div style='max-height:500px;overflow:auto;min-width:850px;'>
<table class="table table-hover" style="min-width:850px;">
	<thead style="background: #f7f7f7;">
        <tr>
            <td>座位名称</td>
            <th style="width:100px;text-align: center;">操作</th>
        </tr>
    </thead>
    <tbody>   
        <?php  if(is_array($ds)) { foreach($ds as $row) { ?>
        <tr>
            <td><?php  echo $row['name'];?></td>
            <td style="text-align: center;"><a href="javascript:;" onclick='biz.selector.set(this, <?php  echo json_encode($row);?>)'>选择</a>
            <a href="<?php  echo web_url('seat/edit', array('id'=>$row['id']))?>" target='_blank'>查看</a></td>
        </tr>
        <?php  } } ?>
        <?php  if(count($ds)<=0) { ?>
        <tr>
            <td colspan='2' align='center'>当前商户未找到记录, 点击<a href="<?php  echo web_url('seat/edit', array('merchid'=>$merchid))?>" target='_blank'>【创建座位】</a></td>
        </tr>
		<?php  } ?>        
    </tbody>
</table>
</div>
