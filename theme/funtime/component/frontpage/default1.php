<?defined('_JEXEC') or die('Restricted access');?>
<div id="content">
    <div class="content">
        <?get_module('main-article');?>
    </div>

    <!-- BANNER PLACE-->
    <div class="index-banner-place">
        <div class="banner-place" style="width:800px;height:100px;line-height:100px;">
            <?if(function_exists('get_banner')):?>
                <?if(get_banner(1) == true):?>
                    <?=get_banner(1);?>
                <?else:?>
                    <span>სარეკლამო ბანერი (800x100)</span>
                <?endif;?>
            <?endif;?>
        </div>
    </div>
    <!-- END BANNER PLACE-->
    <div class="content">
        <div class="index-middle-place">

            <!-- BANNER PLACE -->
            <div class="index-vertical-banner">
                <div class="vertical-banner">
                    <?if(function_exists('get_banner')):?>
                        <?if(get_banner(16) == true):?>
                            <?=get_banner(16);?>
                        <?else:?>
                            <img src="<?=$theme?>images/banner-vertical.png"/>
                        <?endif;?>
                    <?endif;?>
                </div>
            </div>
            <!-- END BANNER PLACE-->
            <?get_module('two-article');?>

            <?get_module('saknatuna');?>
            <?if($registry['deviceType'] == 'computer'):?>
                <?get_module('test');?>
            <?endif;?>
        </div>
    </div>
    <!-- BANNER PLACE-->
    <div class="index-banner-place">
        <div class="banner-place" style="width:800px;height:100px;line-height:100px;">
            <?if(function_exists('get_banner')):?>
                <?if(get_banner(2) == true):?>
                    <?=get_banner(2);?>
                <?else:?>
                    <span>სარეკლამო ბანერი (800x100)</span>
                <?endif;?>
            <?endif;?>
        </div>
    </div>
    <!-- END BANNER PLACE-->
    <div class="content">
        <?get_module('five-article');?>
    </div>
    <!-- BANNER PLACE -->
    <div class="index-banner-place">
        <div class="banner-place" style="width:800px;height:100px;line-height:100px;">
            <?if(function_exists('get_banner')):?>
                <?if(get_banner(3) == true):?>
                    <?=get_banner(3);?>
                <?else:?>
                    <span>სარეკლამო ბანერი (800x100)</span>
                <?endif;?>
            <?endif;?>
        </div>
    </div>
    <!-- END BANNER PLACE-->


    <?//get_module('five-article');?>



</div>