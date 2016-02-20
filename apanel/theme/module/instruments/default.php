<?defined('_JEXEC') or die('Restricted access');?>
<div class="instruments">
    <ul>
        <li><a <?if($user->get_property('gid') == 20):?>href="/apanel/index.php?component=bade"<?else:?>href="/apanel/index.php"<?endif;?>><span class="home"></span> <br> მთავარი</a></li>
        <?if($user->get_property('gid') == 24 or $user->get_property('gid') == 25 or $user->get_property('gid') == 20):?>
            <li><a href="/apanel/index.php?component=organizer"><span class="organizer"></span> <br> ორგანაიზერი</a></li>
        <?endif;?>
        <?if($user->get_property('gid') == 24 or $user->get_property('gid') == 25 or $user->get_property('gid') == 20):?>
            <li style="position:relative;top:19px;"><a href="/apanel/index.php?component=banner"><span class="banner_admin"></span> <br> ბანერების <br>ადმინისტრატორი</a></li>
        <?endif;?>
        <?if(get_access('admin','article','view',false) && $user->get_property('gid') != 30):?>
        <li><a href="/apanel/index.php?news=1"><span class="bade"></span> <br> სტატიები</a></li>
        <?endif;?>
        <?if($user->get_property('gid') == 24 or $user->get_property('gid') == 25 or $user->get_property('gid') == 21 or in_array($user->get_property('username'),array('statistika','mkevlishvili'))):?>
        <li><a href="/apanel/index.php?component=statistic"><span class="statistic"></span> <br> სტატისტიკა</a></li>
        <?endif;?>
        <?if($user->get_property('gid') != 24 && $user->get_property('gid') != 25 && $user->get_property('gid') != 19 && $user->get_property('gid') != 20 && $user->get_property('gid') != 30):?>
            <li><a href="/apanel/index.php?component=myrubrics"><span class="myrubrics"></span> <br> ნამუშევრები</a></li>
        <?endif;?>
        <?if(get_access('admin','category','view',false)):?>
        <li><a href="/apanel/index.php?component=category&sec=post"><span class="rubrics"></span> <br> რუბრიკები</a></li>
        <?php endif;?>
        <?if($user->get_property('gid') == 24 or $user->get_property('gid') == 25):?>
        <li><a href="http://funtime.ge/apanel/index.php?news=1&cache=clear"><span class="cache"></span> <br> ქეშის გაწმენდა</a></li>
        <?php endif;?>
        <?if(get_access('admin','tests','view',false)):?>
        <li><a href="/apanel/index.php?component=test"><span class="itests"></span> <br> ტესტები</a></li>
        <?endif;?>
        <?if(get_access('admin','winners','view',false)):?>
        <li><a href="/apanel/index.php?component=winners"><span class="winners"></span> <br> გამარჯვებულები</a></li>
        <?endif;?>
        <?if(get_access('admin','contact','view',false)):?>
            <li><a href="/apanel/index.php?component=contact"><span class="contacts"></span> <br> კონტაქტი</a></li>
        <?endif;?>
        <?if(get_access('admin','user','view',false)):?>
        <li><a href="/apanel/index.php?component=users"><span class="users"></span> <br> მომხმარებლები</a></li>
        <?endif;?>
        <?if(get_access('admin','banners','view',false)):?>
        <li><a href="/apanel/index.php?component=banners"><span class="banners"></span> <br> ბანერები</a></li>
        <?endif;?>
        <?if(get_access('admin','library','view',false)):?>
        <li><a href="/apanel/index.php?component=library"><span class="pictures"></span> <br> ფოტო</a></li>
        <?endif;?>
        <?if(get_access('admin','group','view',false)):?>
        <li><a href="/apanel/index.php?component=users&section=group"><span class="security"></span> <br> უფლებები</a></li>
        <?endif;?>
        <?if(@get_access('admin','setting','view',false)):?>
        <li><a href="/apanel/index.php?component=settings"><span class="settings"></span> <br> პარამეტრები</a></li>
        <?endif;?>
         <?if(@get_access('admin','presentation','view',false)):?>
        <li><a href="/apanel/index.php?component=presentation&sec=1"><span class="presentation"></span> <br> პრეზენტაცია</a></li>
        <?endif;?>
        <?if(@get_access('admin','competition','view',false)):?>
        <li><a href="/apanel/index.php?component=competition"><span class="competition"></span> <br> ფოტოკონკურსი</a></li>
        <?endif;?>
        <li><a href="?logout=1"><span class="logoff"></span> <br> გასვლა</a></li>
    </ul>
</div>
