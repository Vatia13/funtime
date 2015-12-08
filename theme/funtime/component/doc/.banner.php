<div id="context-banner">
<?foreach($registry['ads3'] as $link):?>
<?if($link['type']==1):?>
 <?if($link['noindex']==1):?><noindex><?endif;?>
 <?if($link['show']==1):?><a class="link1" target="_blank" href="<?=$link['url']?>" <?if($link['nofollow']==1):?>rel="nofollow"<?endif;?>><?=$link['ankor']?></a><?endif;?>
 <?if($link['noindex']==1):?></noindex><?endif;?>
<?endif;?>
<?if($link['type']==2):?>
 <?if($link['noindex']==1):?><noindex><?endif;?>
 <?if($link['show']==1):?><a class="link1" target="_blank" href="<?=$link['url']?>" <?if($link['nofollow']==1):?>rel="nofollow"<?endif;?>><img src="<?=str_replace('../','/',$link['photo'])?>" title="<?=$link['ankor']?>" alt="<?=$link['ankor']?>" /></a><?endif;?>
 <?if($link['noindex']==1):?></noindex><?endif;?>
<?endif;?>
<?if($link['type']==3):?>
 <?if($link['show']==1):?><?=html_entity_decode($link['ankor'])?><?endif;?>
<?endif;?>
<?endforeach;?>
</div>