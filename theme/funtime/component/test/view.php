<? defined('_JEXEC') or die('Restricted access'); ?>
<div id="content">
    <div class="testpage">
        <div class="content">
        <!-- BANNER PLACE-->
        <?$top_banner = ($registry['test'][0]['type']==1) ? 3 : (($registry['test'][0]['type']==2) ? 4 : 2);?>
        <div class="index-banner-place">
            <div class="banner-place" style="width:800px;height:100px;line-height:100px;">
                <?if(function_exists('get_banner')):?>
                    <?if(get_banner('F1',$top_banner) == true):?>
                        <?=get_banner('F1',$top_banner);?>
                    <?else:?>
                        <object data="/img/F1_800x100.swf" type="application/x-shockwave-flash" width="800" height="100"><param name="wmode" value="opaque" /></object>
                    <?endif;?>
                <?endif;?>
            </div>
        </div>
        <!-- END BANNER PLACE-->
            <?if(get_banner('ბრენდირება L',$registry['post'][0]['cat_id']) == true):?>
            <div class="brand_left">
                    <?=get_banner('ბრენდირება L',$registry['post'][0]['cat_id']);?>
            </div>
            <?endif;?>
            <?if(get_banner('ბრენდირება R',$registry['post'][0]['cat_id']) == true):?>
            <div class="brand_right">
                    <?=get_banner('ბრენდირება R',$registry['post'][0]['cat_id']);?>
            </div>
            <?endif;?>

            <div class="test-title">

        <img src="<?=$registry['test'][0]['img'];?>" align="left" height="130"><h2><?=$registry['test'][0]['title'];?></h2>
        <span><?=$registry['test'][0]['lid'];?></span>
        </div>
        <div class="fix"></div>
        <?if(!isset($_POST['submit'])):?>
        <?if(count($registry['test']) > 0):?>
            <?php if(count($registry['question']) > 0):?>
        <form action="" method="post" name="test" onsubmit="checkTest(this);return false;">

            <ol>
                <?$i=-1;foreach($registry['question'] as $q):$i++;?>

                <li>
                    <?=$q;?>
                    <dl>
                        <?for($a=0;$a<count($registry['answer'][$registry['answer_keys'][$i]]);$a++):?>
                        <dt><input type="radio" name="ans[<?=$i;?>]" value="<?=$a?>"><?=$registry['answer'][$registry['answer_keys'][$i]][$a];?></dt>
                        <?endfor?>
                    </dl>
                </li>
                <?endforeach;?>
            </ol>
            <div class="fix"></div>
            <div class="error_box" style="display:none;"></div>
            <input type="submit" id="testres" name="submit" value="შედეგის ნახვა" class="button-success" style="border:none;position:relative;left:41%;" >
            <br>
            <br>
            <a href="/com/test/" class="all-tests" target="_blank">ყველა ტესტის ნახვა</a>
        </form>
                <?else:?>
                <center><p style="color:red;">კითხვები არ მოიძებნა</p></center>
            <?endif;?>

                <br><br>
                <div class="fix" ></div>
                <br><br><br>
                <!-- BANNER PLACE-->
                <?$bot_banner = ($registry['test'][0]['type']==1) ? 3 : (($registry['test'][0]['type']==2) ? 4 : 2);?>

                <div class="index-banner-place">
                    <div class="banner-place" style="width:800px;height:100px;line-height:100px;">
                        <?if(function_exists('get_banner')):?>
                            <?if(get_banner('F2',$bot_banner) == true):?>
                                <?=get_banner('F2',$bot_banner);?>
                            <?else:?>
                                <object data="/img/F2_800x100.swf" type="application/x-shockwave-flash" width="800" height="100"><param name="wmode" value="opaque" /></object>
                            <?endif;?>
                        <?endif;?>
                    </div>
                </div>
                <!-- END BANNER PLACE-->
                <div class="fix"></div><br>

                <div class="fb-comments" data-href="http://funtime.ge/com/test/view/<?=$registry['test'][0]['id'];?>" data-numposts="8" data-colorscheme="light" width="100%"></div>
        <?else:?>
            <div class="error_box">ტესტი რომელშიც თქვენ ცდილობთ შეღწევას არ არსებობს.</div>
        <?endif;?>
        <?else:?>
            <?if($registry['test'][0]['type'] == 1):?>
                <?@include_once(".vik.php");?>
            <?else:?>
                <?@include_once(".tes.php");?>
            <?endif;?>

            <br><br>
            <div class="fix" ></div>
            <br><br><br>
            <!-- BANNER PLACE-->
            <?$bot_banner = ($registry['test'][0]['type']==1) ? 3 : (($registry['test'][0]['type']==2) ? 4 : 2);?>

            <div class="index-banner-place">
                <div class="banner-place" style="width:800px;height:100px;line-height:100px;">
                    <?if(function_exists('get_banner')):?>
                        <?if(get_banner('F2',$bot_banner) == true):?>
                            <?=get_banner('F2',$bot_banner);?>
                        <?else:?>
                            <object data="/img/F2_800x100.swf" type="application/x-shockwave-flash" width="800" height="100"><param name="wmode" value="opaque" /></object>
                        <?endif;?>
                    <?endif;?>
                </div>
            </div>
            <!-- END BANNER PLACE-->
            <div class="fix"></div><br>

            <div class="fb-comments" data-href="http://funtime.ge/com/test/view/<?=$registry['test'][0]['id'];?>" data-numposts="8" data-colorscheme="light" width="100%"></div>
        </div>
            <?endif;?>


    </div>
</div>