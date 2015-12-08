<?php
$total_users = $DB->getOne('SELECT count(id) FROM #__users');
$total_news = $DB->getOne('SELECT count(id) FROM #__news WHERE moderate=0');
$total_news_all = $DB->getOne('SELECT count(id) FROM #__news');
$total_comm = $DB->getOne('SELECT count(id) FROM #__comments');

$total_advert_adv_pr = $DB->getOne('SELECT count(`#__real_prodaja`.`id`) FROM `#__real_prodaja` WHERE `#__real_prodaja`.`moderate`=1');
$totaladv=$total_advert_adv_pr;

$total_advert_adv_pr = $DB->getOne('SELECT count(`#__real_prodaja`.`id`) FROM `#__real_prodaja`');
$totaladv_all=$total_advert_adv_pr;

$totalcomplex= $DB->getOne('SELECT count(`#__complex`.`id`) FROM `#__complex`');
?>
<style>
.sidebar-left {
	width:24px;
	height:24px;
	position:absolute;
	top:5px;
	left:213px;
	background:url(/apanel/theme/images/left.png) 0 0 no-repeat;
}
.sidebar-right {
	width:24px;
	height:24px;
	position:absolute;
	top:10px;
	left:30px;
	background:url(/apanel/theme/images/right.png) 0 0 no-repeat;
}
.bgleft {background-color:#dfe6ee}
.left_content{width:195px;float:left;padding:30px 0 0 20px;position:relative}
.right_content{width:625px;float:left;padding:30px 0 0 30px;}
.l_mini {width:35px;}
.r_big {width:775px;}
</style>
<a href="javascript://" class="sidebar-left" id="ltbut" title="Свернуть/развернуть панель навигации"></a>
<div id="foo"></div>
<script type="text/javascript">
$(document).ready(function(){
/*    $(".sidebar-left").hover(function(){
		$(".left_content").addClass('bgleft');
		},
		function(){
		$(".left_content").removeClass('bgleft');
		});*/
    var showOrHide = parseInt($.cookie('showOrHide'));
	if(showOrHide==1) {
		$('#ltbut').toggleClass('sidebar-left');
		$('#ltbut').toggleClass('sidebar-right');
		  $('.sidebarmenu').toggle();
		  $('.sidebar_box').toggle();
		$('.left_content').toggleClass('l_mini');
		$('.right_content').toggleClass('r_big');
		}

    $(".sidebar-left, .sidebar-right").click(function(){
		if(showOrHide==0 || showOrHide==NaN)showOrHide=1; else showOrHide=0;
		$.cookie('showOrHide', showOrHide);
		$(this).toggleClass('sidebar-left');
		$(this).toggleClass('sidebar-right');
		  $('.sidebarmenu').toggle();
		  $('.sidebar_box').toggle();
		$('.left_content').toggleClass('l_mini');
		$('.right_content').toggleClass('r_big');
		});
	});
</script>


            <div class="sidebarmenu">
<?if(get_access('admin','realty','view',false)):?>
                <a class="menuitem_green submenuheader" href="">Недвижимость</a>
                <div class="submenu">
                    <ul>
                    <li><a href="?component=realty&section=sale">Каталог объектов</a></li>
                    <li><a href="?component=realty&section=saleadd">Добавить объект</a></li>
		<?if(get_access('admin','complex','view',false)):?>
                <!--    <li><a href="?component=complex">Жилые комплексы</a></li>-->
		<?endif?>
                    </ul>
                </div>
<?endif?>


<?if(get_access('admin','editors','view',false)):?>
                <a class="menuitem submenuheader" href="">Управление данными</a>
                <div class="submenu">
                    <ul>
                        <li><a href="?component=realtytype">Типы недвижимости</a></li>
                        <li><a href="?component=setregion">Редактор регионов</a></li>
			<li><a href="?component=editorarea">Редактор районов</a></li>
			<li><a href="?component=editorstreet">Редактор улиц</a></li>
			<li><a href="?component=editormetro">Редактор метро</a></li>
                    </ul>
                </div>
<?endif?>

<?if(get_access('admin','article','view',false)):?>
                <a class="menuitem submenuheader" href="">Материалы</a>
                <div class="submenu">
                    <ul>
	<?if(get_access('admin','article','edit',false)):?>
                    <li><a href="?component=article&section=add">Добавить материал</a></li>
	<?endif?>
                    <li><a href="?component=article">Менеджер материалов</a></li>
                    <li><a href="?component=category">Менеджер категорий</a></li>
                    <li><a href="?component=comment">Менеджер комментариев</a></li>
                    </ul>
                </div>
<?endif?>
<?if(get_access('admin','vote','view',false)):?>
                <a class="menuitem submenuheader" href="">Опросы</a>
                <div class="submenu">
                    <ul>
                    <li><a href="?component=votes">Все опросы</a></li>
                    <li><a href="?component=votes&section=add">Новый опрос</a></li>
                    </ul>
                </div>
<?endif?>
<?if(get_access('admin','user','view',false)):?>
                <a class="menuitem submenuheader" href="" >Пользователи</a>
                <div class="submenu">
                    <ul>
                    <li><a href="?component=users">Все пользователи</a></li>
                    <li><a href="?component=users&section=add">Добавить пользователя</a></li>
<?if(get_access('admin','group','view',false)):?>
	<?if(get_access('admin','group','edit',false) and $user->get_property('gid')==25):?>
                    <li><a href="?component=users&section=group">Группы пользователей</a></li>
	<?endif?>
<?endif?>
                    <!--<li><a href="?component=profile">Настройка анкеты</a></li>-->
                    </ul>
                </div>
<?endif?>
<?if(get_access('admin','tools','view',false)):?>
                <a class="menuitem submenuheader" href="">Инструменты</a>
                <div class="submenu">
                    <ul>
			<li><a href="?component=menubuilder">Конструктор меню</a></li>
			<li><a href="?component=mail">Почтовые рассылки</a></li>
			<li><a href="?component=links">Реклама на сайте</a></li>
			<li><a href="?component=parserfin">Парсер котировок</a></li>
			<li><a href="?component=export">Экспорт / Импорт CSV</a></li>
                        <li><a href="?component=logs">Логи</a></li>
                    </ul>
                </div>
<?endif?>                
<?if(get_access('admin','alert','view',false)):?>
                <a class="menuitem submenuheader" href="">Напоминания</a>
                <div class="submenu">
                    <ul>
			<li><a href="?component=alertclient">О клиентах</a></li>
			<li><a href="?component=alertflat">О квартирах</a></li>
                    </ul>
                </div>
<?endif?>
<?if(get_access('admin','docs','view',false)):?>
                <a class="menuitem submenuheader" href="">Договора</a>
                <div class="submenu">
                    <ul>
			<li><a href="?component=docs">Все договора</a></li>
			<li><a href="?component=docs&section=factory">Предприятия</a></li>
                    </ul>
                </div>
<?endif?>                 
<?if(get_access('admin','setting','view',false)):?>
                <a class="menuitem_red submenuheader" href="">Настройки</a>
                <div class="submenu">
                    <ul>
                    <li><a href="?component=settings">Настройки сайта</a></li>
                    <!--<li><a href="?component=setup">Настройки профиля админа</a></li>-->
                    <li><a href="?component=managerhome">Настройки шаблона</a></li>
                    <!--<li><a href="?component=setsearch">Настройки поиска</a></li>-->
                    </ul>
	        </div>                    
<?endif?>
            </div>
            
<?if(get_access('admin','stat','view',false)):?>
            <div class="sidebar_box">
                <div class="sidebar_box_top"></div>
                <div class="sidebar_box_content">
                <h3>Статистика</h3>
                <img src="<?=$theme_admin?>images/info.png" alt="" title="" class="sidebar_icon_right" />
                <p>
		<b>Объявлений</b>: <br/>
			- Опубликовано: <?=$totaladv?><br/>
			- На модерации: <?=$totaladv_all-$totaladv?><br/>
			- Всего: <?=$totaladv_all?><br/>
	        </p>                
                <p>
		<!--<b>Жилых комплексов</b>: <br/>
			- Всего: <?=$totalcomplex?><br/>
	        </p>-->

	        <p>                
		<b>Записей</b>: <br/>
			- Опубликовано: <?=$total_news?><br/>
			- На модерации: <?=$total_news_all-$total_news?><br/>
			- Всего: <?=$total_news_all?><br/>

	        </p>
	        <p>
		<b>Комментариев</b>: <?=$total_comm?><br/>
		<b>Пользователей</b>: <?=$total_users?> <br/>
	        </p>
                </div>
                <div class="sidebar_box_bottom"></div>
            </div>
<?endif?>


