<?php
/**
 *
 * CMS osRealty 2.1.x
 * Autor: Roman Chernyshov
 * E-mail: support@osRealty.ru
 * URL: www.osRealty.ru
 *
 */

defined('_JEXEC') or die('Restricted access');
if ($err==1) echo 'Пожалуйста активируйте вашу учетную запись.';
if ($err==2) echo 'Неверно указан логин или пароль';
if ($err==3) echo 'Неверно указан e-mail адрес';
if ($err==4) echo 'Пароль не совпадает';
if ($err==5) echo 'Не указан Никнейм';
if ($err==6) echo 'Не указан R-кошелек';
if ($err==7) echo 'Ошибка: Пользователь с таким ником уже существует';

