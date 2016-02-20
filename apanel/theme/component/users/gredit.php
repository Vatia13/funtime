<?defined('_JEXEC') or die('Restricted accessA');?>
<?if(get_access('admin','group','edit')):?>
<h2>ჯგუფის რედაქტირება</h2>
<form method="post" name="accessform" action="?component=users&section=group"/>
<input type="hidden" name="event" value="users"/>
<input type="hidden" name="gredit" value="1"/>
<input type="hidden" name="idd" value="<?=$registry['groupitem'][0]['id']?>"/>
<table class="formadd">
<tr><td class="td1">ჯგუფის დასახელება</td><td><input class="inputbox" type="text" name="name" value="<?=$registry['groupitem'][0]['name']?>"/></td></tr>
</table>
<h3>უფლებების მინიჭება</h3>
<table class="formadd">
<tr>
	<td class="td1 w150"></td>
	<td align="center">ნახვა</td>
	<td align="center">რედაქტირება</td>
	<td align="center">წაშლა</td>
	<td align="center">მხოლოდ თავისი</td>
</tr>

<tr>
	<td class="td1 w150">სტატიები</td>
	<td align="center"><input class="" type="checkbox" name="accessA[article][view]" value="1" <?if(intval($registry['groupitem'][0]['accessA']['article']['view'])==1):?>checked<?endif?>></td>
	<td align="center"><input class="" type="checkbox" name="accessA[article][edit]" value="1" <?if(intval($registry['groupitem'][0]['accessA']['article']['edit'])==1):?>checked<?endif?>></td>
	<td align="center"><input class="" type="checkbox" name="accessA[article][del]" value="1" <?if(intval($registry['groupitem'][0]['accessA']['article']['del'])==1):?>checked<?endif?>></td>
	<td align="center"><input class="" type="checkbox" name="accessA[article][onmy]" value="1" <?if(intval($registry['groupitem'][0]['accessA']['article']['onmy'])==1):?>checked<?endif?>></td>
</tr>
<tr>
	<td class="td1 w150">რუბრიკები</td>
	<td align="center"><input class="" type="checkbox" name="accessA[category][view]" value="1" <?if(intval($registry['groupitem'][0]['accessA']['category']['view'])==1):?>checked<?endif?>></td>
	<td align="center"><input class="" type="checkbox" name="accessA[category][edit]" value="1" <?if(intval($registry['groupitem'][0]['accessA']['category']['edit'])==1):?>checked<?endif?>></td>
	<td align="center"><input class="" type="checkbox" name="accessA[category][del]" value="1" <?if(intval($registry['groupitem'][0]['accessA']['category']['del'])==1):?>checked<?endif?>></td>
	<td align="center"></td>
</tr>
<tr>
	<td class="td1 w150">ტესტები</td>
	<td align="center"><input class="" type="checkbox" name="accessA[tests][view]" value="1" <?if(intval($registry['groupitem'][0]['accessA']['tests']['view'])==1):?>checked<?endif?>></td>
	<td align="center"><input class="" type="checkbox" name="accessA[tests][edit]" value="1" <?if(intval($registry['groupitem'][0]['accessA']['tests']['edit'])==1):?>checked<?endif?>></td>
	<td align="center"><input class="" type="checkbox" name="accessA[tests][del]" value="1" <?if(intval($registry['groupitem'][0]['accessA']['tests']['del'])==1):?>checked<?endif?>></td>
	<td align="center"></td>
</tr>
    <tr>
        <td class="td1 w150">გამარჯვებულები</td>
        <td align="center"><input class="" type="checkbox" name="accessA[winners][view]" value="1" <?if(intval($registry['groupitem'][0]['accessA']['winners']['view'])==1):?>checked<?endif?>></td>
        <td align="center"></td>
    </tr>
    <tr>
        <td class="td1 w150">კონტაქტი</td>
        <td align="center"><input class="" type="checkbox" name="accessA[contact][view]" value="1" <?if(intval($registry['groupitem'][0]['accessA']['contact']['view'])==1):?>checked<?endif?>></td>
        <td align="center"><input class="" type="checkbox" name="accessA[contact][edit]" value="1" <?if(intval($registry['groupitem'][0]['accessA']['contact']['edit'])==1):?>checked<?endif?>></td>
    </tr>
<tr>
	<td class="td1 w150">მომხმარებლები</td>
	<td align="center"><input class="" type="checkbox" name="accessA[user][view]" value="1" <?if(intval($registry['groupitem'][0]['accessA']['user']['view'])==1):?>checked<?endif?>></td>
	<td align="center"><input class="" type="checkbox" name="accessA[user][edit]" value="1" <?if(intval($registry['groupitem'][0]['accessA']['user']['edit'])==1):?>checked<?endif?>></td>
	<td align="center"><input class="" type="checkbox" name="accessA[user][del]" value="1" <?if(intval($registry['groupitem'][0]['accessA']['user']['del'])==1):?>checked<?endif?>></td>
	<td align="center"><input class="" type="checkbox" name="accessA[user][onmy]" value="1" <?if(intval($registry['groupitem'][0]['accessA']['user']['onmy'])==1):?>checked<?endif?>></td>
</tr>
<tr>
	<td class="td1 w150">მომხმარებელთა ჯგუფები</td>
	<td align="center"><input class="" type="checkbox" name="accessA[group][view]" value="1" <?if(intval($registry['groupitem'][0]['accessA']['group']['view'])==1):?>checked<?endif?>></td>
	<td align="center"><input class="" type="checkbox" name="accessA[group][edit]" value="1" <?if(intval($registry['groupitem'][0]['accessA']['group']['edit'])==1):?>checked<?endif?>></td>
	<td align="center"><input class="" type="checkbox" name="accessA[group][del]" value="1" <?if(intval($registry['groupitem'][0]['accessA']['group']['del'])==1):?>checked<?endif?>></td>
	<td align="center"></td>
</tr>
<tr>
	<td class="td1 w150">პრეზენტაცია</td>
	<td align="center"><input class="" type="checkbox" name="accessA[presentation][view]" value="1" <?if(intval($registry['groupitem'][0]['accessA']['presentation']['view'])==1):?>checked<?endif?>></td>
	<td align="center"><input class="" type="checkbox" name="accessA[presentation][edit]" value="1" <?if(intval($registry['groupitem'][0]['accessA']['presentation']['edit'])==1):?>checked<?endif?>></td>
	<td align="center"><input class="" type="checkbox" name="accessA[presentation][del]" value="1" <?if(intval($registry['groupitem'][0]['accessA']['presentation']['del'])==1):?>checked<?endif?>></td>
	<td align="center"></td>
</tr>
<tr>
	<td class="td1 w150">ფოტო-კონკურსი</td>
	<td align="center"><input class="" type="checkbox" name="accessA[competition][view]" value="1" <?if(intval($registry['groupitem'][0]['accessA']['competition']['view'])==1):?>checked<?endif?>></td>
	<td align="center"><input class="" type="checkbox" name="accessA[competition][edit]" value="1" <?if(intval($registry['groupitem'][0]['accessA']['competition']['edit'])==1):?>checked<?endif?>></td>
	<td align="center"><input class="" type="checkbox" name="accessA[competition][del]" value="1" <?if(intval($registry['groupitem'][0]['accessA']['competition']['del'])==1):?>checked<?endif?>></td>
	<td align="center"></td>
</tr>
<!--
<tr>
	<td class="td1 w150">Опросы</td>
	<td align="center"><input class="" type="checkbox" name="accessA[vote][view]" value="1" <?if(intval($registry['groupitem'][0]['accessA']['vote']['view'])==1):?>checked<?endif?>></td>
	<td align="center"><input class="" type="checkbox" name="accessA[vote][edit]" value="1" <?if(intval($registry['groupitem'][0]['accessA']['vote']['edit'])==1):?>checked<?endif?>></td>
	<td align="center"><input class="" type="checkbox" name="accessA[vote][del]" value="1" <?if(intval($registry['groupitem'][0]['accessA']['vote']['del'])==1):?>checked<?endif?>></td>
	<td align="center"><input class="" type="checkbox" name="accessA[vote][onmy]" value="1" <?if(intval($registry['groupitem'][0]['accessA']['vote']['onmy'])==1):?>checked<?endif?>></td>
</tr>-->

<tr>
	<td class="td1 w150">ინსტრუმენტები</td>
	<td align="center"><input class="" type="checkbox" name="accessA[tools][view]" value="1" <?if(intval($registry['groupitem'][0]['accessA']['tools']['view'])==1):?>checked<?endif?>></td>
	<td align="center"><input class="" type="checkbox" name="accessA[tools][edit]" value="1" <?if(intval($registry['groupitem'][0]['accessA']['tools']['edit'])==1):?>checked<?endif?>></td>
	<td align="center"><input class="" type="checkbox" name="accessA[tools][del]" value="1" <?if(intval($registry['groupitem'][0]['accessA']['tools']['del'])==1):?>checked<?endif?>></td>
	<td align="center"></td>
</tr>



<tr>
	<td class="td1 w150">პარამეტრები</td>
	<td align="center"><input class="" type="checkbox" name="accessA[setting][view]" value="1" <?if(intval($registry['groupitem'][0]['accessA']['setting']['view'])==1):?>checked<?endif?>></td>
	<td align="center"><input class="" type="checkbox" name="accessA[setting][edit]" value="1" <?if(intval($registry['groupitem'][0]['accessA']['setting']['edit'])==1):?>checked<?endif?>></td>
	<td align="center"><input class="" type="checkbox" name="accessA[setting][del]" value="1" <?if(intval($registry['groupitem'][0]['accessA']['setting']['del'])==1):?>checked<?endif?>></td>
	<td align="center"></td>
</tr>
    <tr>
        <td class="td1 w150">ბანერები</td>
        <td align="center"><input class="" type="checkbox" name="accessA[banners][view]" value="1" <?if(intval($registry['groupitem'][0]['accessA']['banners']['view'])==1):?>checked<?endif?>></td>
        <td align="center"><input class="" type="checkbox" name="accessA[banners][edit]" value="1" <?if(intval($registry['groupitem'][0]['accessA']['banners']['edit'])==1):?>checked<?endif?>></td>
        <td align="center"></td>
    </tr>
    <tr>
        <td class="td1 w150">ფოტო</td>
        <td align="center"><input class="" type="checkbox" name="accessA[library][view]" value="1" <?if(intval($registry['groupitem'][0]['accessA']['library']['view'])==1):?>checked<?endif?>></td>
        <td align="center"></td>
    </tr>
<tr>
	<td class="td1 w150">სტატისტიკა</td>
	<td align="center"><input class="" type="checkbox" name="accessA[stat][view]" value="1" <?if(intval($registry['groupitem'][0]['accessA']['stat']['view'])==1):?>checked<?endif?>></td>
	<td align="center"></td>
	<td align="center"></td>
	<td align="center"></td>
</tr>
<tr>
    <td> <a onclick="document.accessform.submit();" class="btn-green left">შენახვა</a></td>
    <td></td>
    <td></td>
    <td></td>
</tr>
</table>


<a href="index.php?component=users&section=group" class="back">&larr; უკან</a>
</form>
<?endif;?>