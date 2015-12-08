<?defined('_JEXEC') or die('Restricted access');?>
<h1>У вас нет прав для доступа к данной странице.</h1>
<?if ($user->get_property('gid')==0):?>
<p><a href="/forum/login.php" class="link4">Авторизируйтесь пожалуйста.</a></p>
<?endif?>
<p>Возможные причины ошибки:</p>
<ul>
<li>Доступ к этой странице ограничен Администрацией</li>
</ul>