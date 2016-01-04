<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Funtime.ge ადმინისტრირება</title>
    <?php if($_GET['close'] == true):?>
        <script type="text/javascript">
            window.onload = function(){
                window.open('','_self').close();
            }
        </script>
    <?php endif;?>
<link rel="stylesheet" type="text/css" href="<?=$theme_admin;?>css/style.css?ver=0.2" />
<link rel="stylesheet" type="text/css" href="<?=$theme_admin;?>css/jquery.fancybox-1.3.4.css" />
<link rel="stylesheet" href="<?=$theme_admin;?>css/colorpicker.css" type="text/css" />
<link rel="stylesheet" media="screen" type="text/css" href="<?=$theme_admin;?>css/layout.css" />
    <link rel="stylesheet" href="<?=$theme_admin?>css/fullcalendar.css?ver=<?=rand(2,9999999)?>"/>
    <?php if($_GET['component'] <> 'bade'):?>
<script type="text/javascript" src="<?=$theme_admin;?>js/jquery-1.11.3.min.js"></script>

    <?if($_GET['component'] == "article" && $_GET['section'] == "edit"){?>
    <script type="text/javascript" src="<?=$theme_admin;?>js/jquery.guillotine.js"></script>
    <script type='text/javascript'>

        jQuery(function($) {

            var picture = $('#sample_picture');

            picture.load(function(){

                // Initialize plugin (with custom event)
                picture.guillotine({eventOnChange: 'guillotinechange'});

                // Display inital data
                var data = picture.guillotine('getData');
                //for(var key in data) { $('#'+key).html(data[key]); }

                // Bind button actions

                //$('#fit').click(function(){ picture.guillotine('fit'); });
                //$('#zoom_in').click(function(){ picture.guillotine('zoomIn'); });
                // $('#zoom_out').click(function(){ picture.guillotine('zoomOut'); });

                // Update data on change
                picture.on('guillotinechange', function(ev, data, action) {
                    data.scale = parseFloat(data.scale.toFixed(4));

                    $('#pleft').val(data.x);
                    $('#ptop').val(data.y);

                });
            });

            var picinside = $('#picture_inside');

            picinside.load(function(){
                var img = $(this);
                if (img.guillotine('instance')) img.guillotine('remove');
                var sz = $('input[name="newimgsz"]').val().split('x');
                // Initialize plugin (with custom event)
                $("#picinside div").css({width:sz[0],height:sz[1]});
                picinside.guillotine({eventOnChange: 'guillotinechange',width:sz[0],height:sz[1],zoomStep:0.1});

                // Display inital data
                var data = picinside.guillotine('getData');

                //for(var key in data) { $('#'+key).html(data[key]); }

                // Bind button actions

                //$('#fit').click(function(){ picture.guillotine('fit'); });
                //$('#zoom_in').click(function(){ picture.guillotine('zoomIn'); });
                // $('#zoom_out').click(function(){ picture.guillotine('zoomOut'); });

                // Update data on change
                picinside.on('guillotinechange', function(ev, data, action) {
                    data.scale = parseFloat(data.scale.toFixed(4));

                    jQuery('#inleft').val(data.x);
                    jQuery('#intop').val(data.y);


                });


            });


        });


    </script>
    <?}?>
<script type="text/javascript" src="<?=$theme_admin;?>js/jquery-migrate-1.2.1.min.js"></script>

        <script type="text/javascript" src="<?=$theme_admin;?>js/func.js?ver=<?=rand(0,9999);?>"></script>

    <script type="text/javascript" src="<?=$theme_admin;?>js/jquery.min.js"></script>

<script type="text/javascript" src="<?=$theme_admin;?>js/keyboards.js"></script>
<?if(!$_GET['component']):?>
    <script type="text/javascript" src="<?=$theme_admin;?>js/cal.js?ver=0.2"></script>
<?else:?>
<script type="text/javascript" src="<?=$theme_admin;?>js/cal1.js?ver=0.2"></script>
<?endif;?>
<?if($_GET['component'] == "article" && $_GET['section'] == "edit"){?>
    <link rel="stylesheet" media="screen" type="text/css" href="<?=$theme_admin;?>css/jquery.guillotine.css" />
    <script type="text/javascript" src="<?=$theme_admin;?>js/colorpicker1.js"></script>
    <script type="text/javascript" src="<?=$theme_admin;?>js/eye.js"></script>
    <script type="text/javascript" src="<?=$theme_admin;?>js/utils.js"></script>
    <script type="text/javascript" src="<?=$theme_admin;?>js/layout.js?ver=1.0.2"></script>

<?}?>

<script type="text/javascript" src="<?=$theme_admin;?>js/jquery.fancybox-1.3.4.pack.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function($){
        $('.calendar').simpleDatepicker();
    });
</script>
<script>
jQuery(document).ready(function ($) {
    $('.iframe-btn').fancybox({
        'width'		: 900,
        'height'	: 600,
        'type'		: 'iframe',
        'autoScale'    	: false
    });
});
</script>
    <?php else:?>
        <script type="text/javascript" src="<?=$theme_admin?>js/moment.min.js"></script>
        <script type="text/javascript" src="<?=$theme_admin;?>js/jquery.bade.min.js"></script>
        <script type="text/javascript" src="<?=$theme_admin;?>js/ge.js"></script>
        <script type="text/javascript" src="<?=$theme_admin?>js/fullcalendar.js"></script>
        <script type="text/javascript" src="<?=$theme_admin;?>js/func.js?ver=1"></script>
    <?php endif;?>

</head>
<body>
<div id="modal-window" style="position:fixed;width:100%;height:100%;display:none;z-index:999;left:0;top:0;background-color:#FFF; opacity:0.7;">
    <div style="position:relative;width:300px;height:300px;margin:10% auto;"><img src="/apanel/images/preloader.gif"/></div>
</div>
<div id="container">
<?if(!$user->is_loaded() and $com_path<>'install'):?>
		<?if($components)?><?require_once($theme_admin.'module/login/default.php');?>
<?else:?>
    <div id="header" align="center"><h1>Funtime.ge  გამარჯობა, <b><?=$user->get_property('realname'); ?></b></h1></div>

    <div id="wrapper">
        <div id="content">
            <?//if ($err>0) require_once($theme_admin.'component/error/default.php');?>
            <?require_once($theme_admin.'module/instruments/default.php');?>
            <?require_once($contents_view);?>
        </div>
    </div>
    <div id="navigation">
        <?//require_once($theme_admin.'module/left_sidebar/default.php');?>
    </div>
    <div id="extra">

    </div>
<?endif;?>
</div>
<script type="text/javascript" src="<?=$theme_admin;?>js/javascript.js?ver=0.5"></script>
</body>
</html>