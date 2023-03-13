<?php defined('IN_IA') or exit('Access Denied');?><div class="input-group">
    <span class="input-group-addon">1个<?php  echo $creditName;?> 抵扣</span>
    <input type="text" name="deduction[money]" value="<?php  echo $marketing[3]['money'];?>" class="form-control">
    <span class="input-group-addon">元</span>
</div>
<div class="input-group" style="margin-top:10px;">
    <span class="input-group-addon">每单最多抵扣</span>
    <input type="text" name="deduction[deduct]" value="<?php  echo $marketing[3]['deduct'];?>" class="form-control">
    <span class="input-group-addon"> 元</span>
</div>
<label class="checkbox-inline" for="manydeduct">
<input id="manydeduct" type="checkbox" value="1" <?php  if($marketing[3]['manydeduct']==1) { ?>checked<?php  } ?> name="deduction[manydeduct]"> 允许多件累计抵扣</label>
<span class="help-block">如果设置0，则不支持<?php  echo $creditName;?>抵扣</span>