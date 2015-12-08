<?php defined('_JEXEC') or die('Restricted access'); ?>
<? if($user->get_property('userID')==1 OR $user->get_property('gid')<=24):?>

    <h2>ჩემი ნამუშევრები</h2>

    <form method="get" name="myfilter" action="/apanel/index.php">
        <input type="hidden" name="component" value="myrubrics" />
        <table class="formadd" width="100%">
            <thead>
            <tr>
                <th align="left">თარიღი</th>
                <th align="left"></th>

                <th width="90%"></th>
            </tr>
            </thead>
            <tbody>
            <tr>


                <td>
                    <input type="text" name="from" value="<?if(isset($_GET['from'])):?><?=$_GET['from'];?><?endif;?>" class="calendar input_80" placeholder="დან"/>
                </td>
                <td>
                    <input type="text" name="to" value="<?if(isset($_GET['to'])):?><?=$_GET['to'];?><?endif;?>" class="calendar input_80" placeholder="მდე"/>
                </td>
                <td align="left"><a onclick="document.myfilter.submit();" class="btn-blue">ძებნა</a></td>
            </tr>
            </tbody>
        </table>
    </form>
    <? if(count($all)>0):?>
        <table id="rounded-corner">
            <thead>
            <tr>
                <th scope="col" class="rounded-company">ID</th>
                <th scope="col" class="rounded">სათაური</th>
                <th scope="col" class="rounded">რუბრიკა</th>
                <th scope="col" class="rounded">ავტორი</th>
                <th scope="col" class="rounded">გაგზავნის თარიღი</th>

            </tr>
            </thead>
            <tbody>
            <?foreach($all as $num):
			    $send_time = unserialize($num['send_time']);
                if($user->get_property('gid') == 18):
                    $send_time = $send_time[0];
                endif;
                if($user->get_property('gid') == 22):
                    $send_time = $send_time[1];
                endif;
                if($user->get_property('gid') == 23):
                    $send_time = $send_time[2];
                endif;
			?>
                <tr><td class="tab-cell-1"><?=$num['id']?></td>
                    <td>
                        <a href="#" class="news-url"><?=$num['title']?></a>

                    </td>
                    <td class="tab-cell-1">
                        <?if($num['podcat']>0):?>
                            <?foreach($category as $cat):?>
                                <?if($cat[0]['id']==$num['podcat']):?><?=$cat[0]['name']?><?endif?>
                            <?endforeach?>
                            >>
                        <?endif;?>
                        <?=$num['name']?>
                    </td>
                    <td>
                        <?=$num['realname']?>
                    </td>
                    <td class="tab-cell-1"><?=date('d-m-y H:i',$num['date'])?></td>


                </tr>

            <?endforeach;?>
            </tbody>
        </table>
        <?if ($total>1) echo '<center><div class="pagination" style="margin-bottom:10px; margin-top:10px;">'
            .$pervpage.$page2left.$page1left.'<span class="">'.$page.'</span>'.$page1right.$page2right
            .$nextpage.'</div></center>';?>

    <?else:?>
        <p>ნამუშევრები არ მოიძებნა.</p>
    <?endif?>


<?else:?>


<?endif?>