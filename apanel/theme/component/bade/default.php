<?php
/**
 *
 * CMS It-Solutions 0.1
 * Author: Vati Child
 * E-mail: vatia0@gmail.com
 * URL: www.it-solutions.ge
 *
 */

defined('_JEXEC') or die('Restricted access');
if(get_access('admin','article','view')):
?>
<h3 class="left">ბადე</h3>


<script>

    jQuery(document).ready(function($) {

        $('#bade').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'agendaWeek'

            },

            buttonText: {
                prevYear: "წინა წელი",
                nextYear: "შემდეგი წელი",
                year: 'წელი', // TODO: locale files need to specify this
                today: 'დღეს',
                month: 'თვე',
                week: 'კვირა',
                day: 'დღე'
            },
            dayClick: function(date, jsEvent, view) {
                //document.location.href = '/apanel/index.php?component=article&section=add&Y='+date.format('YYYY')+'&M='+date.format('MM')+'&D='+date.format('DD')+'&H='+date.format('HH')+'&I='+date.format('mm');
                $('#addrubric').show();
                jQuery('input[name="date"]').val(date.format('YYYY-MM-DD HH:mm'));
            },
            lang: 'ge',
            contentHeight: 710,
            defaultView:'agendaWeek',
            slotDuration: '01:00:00',
            defaultDate: '<?=date('Y-m-d');?>',
            allDaySlot: false,
            firstDay:'<?=date('w');?>',
            minTime: '10:00:00',
            maxTime: '24:00:00',
            editable: false,
            eventLimit: true, // allow "more" link when too many events
            timeFormat: 'H(:mm)',
            events: function(start, end, timezone, callback) {
                $.ajax({
                    url: 'http://funtime.ge/apanel/index.php?component=bade&parse=json',
                    dataType: 'json',
                    type:'POST',
                    data: {
                        // our hypothetical feed requires UNIX timestamps
                        start: start.unix(),
                        end: end.unix()
                    },
                    success: function(doc) {
                        var events = doc;

                        callback(events);
                    }
                });
            }//'http://funtime.ge/apanel/index.php?component=bade&parse=json&day='+$('input[name="json"]').val()
        });

    });

    function saveRubric(){
        var id = jQuery('select[name="rubric"]').val();
        var date = jQuery('input[name="date"]').val();
        jQuery.ajax({
            url:'/apanel/index.php?component=bade&section=ajax',
            type:'POST',
            data:{id:id,date:date,action:'load_date'},
            success:function(data){
                if(data == 'success'){
                    jQuery('#addrubric').hide();
                    location.reload();
                }
            }
        })

    }

    function checkImage(user,date,cat,e,action,gid){
        var value = e.val();
        if(date > 0 && cat > 0){
            jQuery.ajax({
                url:'/apanel/index.php?component=bade&section=ajax',
                type:'POST',
                data:{user:user,date:date,cat:cat,value:value,action:action},
                success:function(data){
                    if(data == 'success' || data == 'success1' || data == 'success2'){
                        if(gid == 30){
                            if(data == 'success1'){
                                e.parent('div').parent('div').parent('a').css({'backgroundColor':'grey'});
                            }else if(data=='success2'){
                                e.parent('div').parent('div').parent('a').css({'backgroundColor':'red'});
                            }else{
                                e.parent('div').parent('div').parent('a').css({'backgroundColor':'green'});
                            }
                        }
                        if(value == 1){
                            e.val(0);
                        }else{
                            e.val(1);
                        }

                    }
                }
            })
        }
    }


</script>
<div style="clear:both;"></div>
<hr>
<div id="addrubric" style="position:fixed;width:100%;height:100%;z-index:1000;display:none;">
<div style="position:relative;width:240px;padding:10px;text-align:center;height:130px;margin:0 auto;background-color:#FFF;border:1px solid #e7e7e7;border-radius:6px;">
    <a onClick="jQuery('#addrubric').hide();" style="display:block;float:right;color:#424242;padding:5px;font-size:18px;margin-bottom:5px;cursor:pointer">[x]</a>
    <div class="fix"></div>
    <select name="rubric">
    <option value="">აირჩიეთ რუბრიკა</option>
    <?foreach($category as $cat):?>
        <?foreach($cat as $ca):?>
            <?if($ca['podcat']==0):?>
                <option value="<?=$ca['id']?>"  <?if(($ca['id']==$_COOKIE['filter-cat'] and empty($_POST['filter-cat'])) or $ca['id']==$_POST['filter-cat']):?>selected<?endif;?>>- <?=$ca['name']?></option>
            <?else:?>
                <option value="<?=$ca['id']?>"  <?if(($ca['id']==$_COOKIE['filter-cat'] and empty($_POST['filter-cat'])) or $ca['id']==$_POST['filter-cat']):?>selected<?endif;?>>--- <?=$ca['name']?></option>
            <?endif;?>
        <?endforeach;?>
    <?endforeach;?>
</select>
    <input type="hidden" name="date" value="">

    <a onClick="saveRubric()" class="btn-blue" style="margin-top:10px;">Save</a>
</div>
</div>
<div id='bade'></div>
<?endif;?>