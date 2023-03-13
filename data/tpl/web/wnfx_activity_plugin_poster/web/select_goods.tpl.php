<?php defined('IN_IA') or exit('Access Denied');?><div style='max-height:450px;overflow:auto;'>
<table class="table table-hover">
    <thead>
        <th>商品</th>
        <th>选取</th>
    </thead>
    <tbody>   
        <?php  if(is_array($goods)) { foreach($goods as $row) { ?>
        <tr>
            <td><?php  echo $row['title'];?></td>
            <td style="width:10%;"><a href="javascript:;" onclick='select_goods(<?php  echo json_encode($row);?>)' id="<?php  echo $row['id'];?>" data-dismiss="modal" aria-hidden="true">选择</a></td>
        </tr>
        <?php  } } ?>
        <?php  if(count($goods)<=0) { ?>
        <tr> 
            <td colspan='4' align='center'>未找到</td>
        </tr>
        <?php  } ?>
    </tbody>
</table>
</div>