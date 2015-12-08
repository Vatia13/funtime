<?defined('_JEXEC') or die('Restricted access');?>

<div id="content">
    <div class="content">
        <?get_module('main-article');?>


    <!-- BANNER PLACE-->
    <div class="index-banner-place">
        <div class="banner-place" style="width:800px;height:100px;line-height:100px;">
            <?if(function_exists('get_banner')):?>
                <?if(get_banner('F1',1) == true):?>
                    <?=get_banner('F1',1);?>
                <?else:?>
                    <span>სარეკლამო ბანერი (800x100)</span>
                <?endif;?>
            <?endif;?>
        </div>
    </div>
    <!-- END BANNER PLACE-->

        <div class="index-middle-place">

            <!-- BANNER PLACE -->
            <div class="index-vertical-banner">
                <div class="vertical-banner">
                    <?if(function_exists('get_banner')):?>
                        <?if(get_banner('F4',1) == true):?>
                            <?=get_banner('F4',1);?>
                        <?else:?>
                            <img src="/img/uploads/files/%E1%83%91%E1%83%90%E1%83%9C%E1%83%94%E1%83%A0%E1%83%94%E1%83%91%E1%83%98/vertical.png"/>
                        <?endif;?>
                    <?endif;?>
                </div>
            </div>
            <!-- END BANNER PLACE-->
            <?get_module('two-article');?>

            <?get_module('saknatuna');?>
            <div class="fix"></div>
            <?if($registry['deviceType'] == 'computer' or $registry['deviceType'] == 'tablet'):?>
                <?get_module('test');?>
            <?endif;?>
        </div>

    <!-- BANNER PLACE-->
    <div class="index-banner-place">
        <div class="banner-place" style="width:800px;height:100px;line-height:100px;">
            <?if(function_exists('get_banner')):?>
                <?if(get_banner('F2',1) == true):?>
                    <?=get_banner('F2',1);?>
                <?else:?>
                    <span>სარეკლამო ბანერი (800x100)</span>
                <?endif;?>
            <?endif;?>
        </div>
    </div>
    <!-- END BANNER PLACE-->

        <?get_module('five-article');?>

    <!-- BANNER PLACE -->
    <div class="index-banner-place">
        <div class="banner-place" style="width:800px;height:100px;line-height:100px;">
            <?if(function_exists('get_banner')):?>
                <?if(get_banner('F3',1) == true):?>
                    <?=get_banner('F3',1);?>
                <?else:?>
                    <span>სარეკლამო ბანერი (800x100)</span>
                <?endif;?>
            <?endif;?>
        </div>
    </div>
    <!-- END BANNER PLACE-->


    <?get_module('loadmore');?>
    </div>



</div>