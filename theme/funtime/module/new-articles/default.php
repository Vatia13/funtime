<?defined('_JEXEC') or die('Restricted access');?>
<?if(count($registry['new-articles']) > 0):
if(strpos($registry['post'][0]['text'],'http://funtime.ge:80/img/lastnews.png')):
$outp = '<div class="new-articles"><ul><li><h3>ახალი სტატიები</h3></li>';
     foreach($registry['new-articles'] as $item): if($registry['post'][0]['cat_chpu'] <> $item['cat_chpu']):
         $outp .= '<li><a href="/'.$item['cat_chpu'].'/'.$item['chpu'].'/">'.$item['title'].' <img src="'.substr($item['thumbs'],2).'" width="220">';
         $outp .= '</a></li>';
    endif;endforeach;
    $outp .= '</ul></div>';
?>

<script>
    $(document).ready(function(){
        var style = $('#LastNews').attr('style');
        $('#LastNews').replaceWith('<div id="#LastNews" style="'+style+'"><?=$outp;?></div><br><br>');
        if($('#LastNews .new-articles li').length > 5){
            $('#LastNews .new-articles li:last-child').remove();
        }
        console.log('test');
    });
</script>
<?endif;?>
<?endif;?>