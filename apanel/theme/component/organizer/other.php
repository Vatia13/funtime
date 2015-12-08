<?php defined('_JEXEC') or die('Restricted access'); ?>
<?if(get_access('admin','banners','view')):?>
<?if($registry['last_banners_count'] > 0):?>
    <div class="info_box">ყურადღება! 15 დღის შიგნით თავისუფლდება <?=$registry['last_banners_count'];?> საბანერო ადგილი</div>
    <div align="center">
        <button class="btn show_banners">მაჩვენე ბანერები რომლებიც თავისუფლდება 15 დღის შიგნით</button>
        <button class="btn hide_banners" style="display:none;">დამალე ბანერები</button>
    </div>
    <br>
    <div class="last_banners" style="display:none;"></div>
    <br><br>
<?endif;?>
<h3>სხვა შეთავაზებები</h3>
<?if(!empty($_GET['message'][0])):?>
    <div class="<?=$_GET['message'][0];?>_box"><?=$_GET['message'][1];?></div>
<?endif;?>
<a href="/apanel/index.php?component=organizer&section=addother" class="btn-green">შეთავაზების დამატება</a>
<a href="/apanel/index.php?component=organizer" style="padding:7px 15px;cursor:pointer;font-family:BPGMrgvlovani;background-color:cornflowerblue;max-width:140px;float:right;border-radius:5px;color:#FFF;text-align:center;">ორგანაიზერი</a>
<div class="fix"></div>
<form action="/apanel/index.php" method="get">
    <input type="hidden" value="organizer" name="component"/>
    <input type="hidden" value="other" name="section"/>
    <table class="formadd" width="100%">
        <tbody>
        <tr>
            <td>სტატუსი</td>
            <td>
                <select name="status">
                    <option value="0" >გაგზავნილი</option>
                    <option value="1" <?if($_GET['status'] == 1):?>selected<?endif;?>>დადებითი</option>
                    <option value="2" <?if($_GET['status'] == 2):?>selected<?endif;?>>უარყოფითი</option>
                </select>
            </td>
            <td>რუბრიკა</td>
            <td>


                <select name="cat" class="input_150">
                    <option value="">---</option>
                    <option value="1" <?select_value('cat',(($registry['banner'][0]['cat_id']) ? $registry['banner'][0]['cat_id'] : $_GET['cat']),1);?>>პირველი გვერდი</option>
                    <option value="2" <?select_value('cat',(($registry['banner'][0]['cat_id']) ? $registry['banner'][0]['cat_id'] : $_GET['cat']),2);?>>ტესტები</option>
                    <?$catnum = array();foreach($category as $cat):?>
                        <?foreach($cat as $ca):?>
                            <? if($user->get_property('gid') == 18 or $user->get_property('gid') == 21){?>
                                <? $authors = unserialize($ca['users']);?>
                                <?if(in_array($user->get_property('userID'),$authors)):?>
                                    <? $catnum[] = $ca['id']; ?>
                                <?endif;?>
                            <?}?>
                        <?endforeach;?>
                    <?endforeach;?>
                    <?foreach($category as $cat):?>
                        <?foreach($cat as $ca):?>
                            <? if($user->get_property('gid') == 18 or $user->get_property('gid') == 21){?>
                                <? $authors = unserialize($ca['users']);?>
                                <?if(in_array($user->get_property('userID'),$authors)):?>
                                    <?  if(count($catnum) < 2): ?>
                                        <option value="<?=$ca['id']?>" selected>- <?=$ca['name']?></option>
                                    <? else:?>
                                        <?if($ca['podcat']==0):?>
                                            <option value="<?=$ca['id']?>" <?select_value('cat',$_GET['cat'],$ca['id']);?>>- <?=$ca['name']?></option>
                                        <?else:?>
                                            <option value="<?=$ca['id']?>" <?select_value('cat',$_GET['cat'],$ca['id']);?>>--- <?=$ca['name']?></option>
                                        <?endif;?>
                                    <?endif;?>
                                <?endif;?>
                            <?}else{?>
                                <?if($ca['podcat']==0):?>
                                    <option value="<?=$ca['id']?>" <?select_value('cat',$_GET['cat'],$ca['id']);?>>- <?=$ca['name']?></option>
                                <?else:?>
                                    <option value="<?=$ca['id']?>" <?select_value('cat',$_GET['cat'],$ca['id']);?>>--- <?=$ca['name']?></option>
                                <?endif;?>
                            <?}?>
                        <?endforeach;?>
                    <?endforeach;?>
                </select>
            </td>
            <td>კომპანია</td>
            <td>
                <input type="text" value="<?=$_GET['company'];?>" name="company"/>
            </td>
            <td>საკონტაქტო (პირი / ტელეფნი / ელ.ფოსტა)</td>
            <td><input type="text" name="person" value="<?=$_GET['person'];?>" /></td>

            <td>
                <input type="submit" name="filter"  value="გაფილტვრა" class="btn-green" style="border:none"/>
            </td>
            <td width="15%"></td>
        </tr>
        </tbody>
    </table>
</form>
<table id="rounded-corner">
    <thead>
    <tr>
        <th scope="col" class="rounded">კომპანიის დასახელება</th>
        <th scope="col" class="rounded">საკონტაქტო პირი</th>
        <th scope="col" class="rounded">ტელეფონი</th>
        <th scope="col" class="rounded">რუბრიკა</th>
        <th scope="col" class="rounded">აღწერა</th>
        <th scope="col" class="rounded">ვადა</th>
        <th scope="col" class="rounded">პასუხი</th>
        <th scope="col" class="rounded"></th>
    </tr>
    </thead>
    <tbody>
    <?if(count($registry['banners']) > 0): $ready = array();?>
        <?foreach($registry['banners'] as $item): $info = unserialize($item['info']);?>
            <tr  <?if($item['status'] == '1'):?>style="background:green;"<?elseif($item['status']=='2'):?>style="background:red;"<?else:?><?endif;?>>
                <td><?if(!empty($item['company'])):?><?=$item['company'];?><?else:?><a href="/apanel/index.php?component=banner&section=add&cat=<?=$item['cat_id'];?>&title=<?=$item['title'];?>" style="width:100%;height:24px;display:block;"></a><?endif;?></td>
                <td><?=$info['person'];?></td>
                <td><?=$info['phone'];?></td>
                <td><? if($item['cat_id'] == 1):?>პირველი გვერდი<?elseif($item['cat_id']==2):?>ტესტები<?else:?><?=$item['name'];?><?endif;?></td>
                <td><?=$item['description'];?></td>


                <td>
                    <?=date('Y-m-d',strtotime($item['contact_at']));?> <?=(date('Y-m-d',strtotime($item['contact_at'])) == date('Y-m-d')) ? 'დღეს' : '';?> <?=(date('Y-m-d',strtotime($item['contact_at'])) == date('Y-m-d',strtotime('+1 days'))) ? 'ხვალ' : '';?> <?=(date('Y-m-d',strtotime($item['contact_at'])) == date('Y-m-d',strtotime('+2 days'))) ? 'ზეგ' : '';?>

                </td>
                <td width="240">
                    <?if($item['status'] == '1'):?>
                        დადებითი
                    <?elseif($item['status'] == '2'):?>
                        უარყოფითი
                    <?else:?>
                        <div>
                            <a href="/apanel/index.php?component=organizer&section=editother&edit=<?=$item['id'];?>&answer=1" style="display:inline-block;background-color:green;padding:5px 15px;border-radius:5px;color:#FFF;">დადებითი</a>
                            <a href="/apanel/index.php?component=organizer&section=editother&edit=<?=$item['id'];?>&answer=2" style="display:inline-block;background-color:red;padding:5px 15px;border-radius:5px;color:#FFF;">უარყოფითი</a>
                        </div>
                    <?endif;?>
                </td>
                <td align="center" class="option_icons">
                    <?if(get_access('admin','banners','edit')):?>
                        <a href="/apanel/index.php?component=organizer&section=editother&edit=<?=$item['id'];?>"><img src="<?=$theme_admin?>images/user_edit.png" alt="რედაქტირება" title="რედაქტირება" border="0" /></a>

                        <a onclick="confirmDelete(<?=$item['id'];?>)"><img src="<?=$theme_admin?>images/trash.png" alt="წაშლა" title="წაშლა" border="0" /></a>
                    <?endif;?>
                </td>
            </tr>
        <?endforeach;?>
    <?else:?>
        <tr><td colspan="6">ამ რუბრიკაზე არცერთი საბანერო პოზიცია არ მოიძებნა.</td></tr>
    <?endif;?>
    </tbody>
</table>
<?if ($total>1) echo '<center><div class="pagination" style="margin-bottom:10px; margin-top:10px;">'
    .$pervpage.$page2left.$page1left.'<span class="">'.$page.'</span>'.$page1right.$page2right
    .$nextpage.'</div></center>';?>
<script>
    function confirmDelete(id){
        var del = confirm('ნამდვილად გსურთ საბანერო პოზიცია #' + id + ' წაშლა?');
        if(del == true){
            window.location.href = '/apanel/index.php?component=organizer&del='+id;
        }
    }

    jQuery(document).ready(function($){
        $('.show_banners').click(function(){
            $.ajax({
                url:'/apanel/index.php?component=banner&section=ajax',
                type:'POST',
                data:{action:'last_banners'},
                success:function(data){
                    $('.show_banners').hide();
                    $('.hide_banners').show();
                    if(data == 0){
                        $('.last_banners').html('<font color="red">ჯერჯერობით არცერთ ბანერს არ ეწურება ვადა.</font>').show();
                    }else{
                        $('.last_banners').html(data).slideDown(400);
                    }

                }
            });
        });
        $('.hide_banners').click(function(){
            if($('.last_banners').is(':hidden')){
                $('.hide_banners').html('დამალე ბანერები');
            }else{
                $('.hide_banners').html('მაჩვენე ბანერები რომლებიც თავისუფლდება 15 დღის შიგნით');
            }
            $('.last_banners').slideToggle(400);

        });

    });
</script>
<?endif;?>