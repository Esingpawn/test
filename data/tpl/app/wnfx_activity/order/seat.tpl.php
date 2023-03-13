<?php defined('IN_IA') or exit('Access Denied');?><?php  if(checkplugin('seat') && $activity['switch']['seat']) { ?>
var seats = $("input[name='seats']").val(), 
    chosenum = seats == '' ? 0 : seats.split(',').length, 
    paynum = parseInt($('.js-pay-num').val());
if (chosenum != paynum) {
    if (chosenum > paynum)
        util.tips('只可选择 ' + paynum + ' 个座位！');
    else
        util.tips('请再选择 ' + (paynum - chosenum) + ' 个座位！');
    sc.get($("#seat_temp").val().split(',')).status('selected');
    $('#seats_chose').find('li').remove();
    $('#seat_show').text('');
    sc.find('selected').each(function() {	
        var index = $.inArray(this.settings.id, $("#seat_temp").val().split(','));
        if (index >= 0){
            $('<li class="mui-icon mui-icon-closeempty">' + (this.settings.row + 1) + '排' + this.settings.label + '座</li>').attr('id', 'cart-item-' + this.settings.id).data('seatId', this.settings.id).appendTo($('#seats_chose'));
            $('#seat_show').text((this.settings.row + 1) + '排' + this.settings.label + '座、');
        }else
            sc.get([this.settings.id]).status('available');
    });
    location.href = location.href + '#seatbox';
    mui('#seatbox').popover('toggle');
    pinch();
    return false;
}
<?php  } ?>