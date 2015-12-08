<?php
/**
 * Created by Vati Child.
 * E-mail: vatia0@gmail.com
 * Date: 11/23/14
 * Time: 10:00 PM
 */

defined('_JEXEC') or die('Restricted access');
session_start();
$_SESSION = array();
include_once($_SERVER['DOCUMENT_ROOT'].'/captcha/simple-php-captcha.php');

$_SESSION['captcha'] = simple_php_captcha();

$registry['contact'] = $DB->getAll("SELECT * FROM #__contact WHERE id=1");

if ($_POST['stage']=='process')
{
    session_start();

    if (!empty($_POST['name']))
    {
        if (email_check($_POST['email']))
        {
            if($_SESSION['captcha']['code']==$_POST['capcha']){
                $to      = $registry['emailsup'];
                $subject = 'funtime.ge -'.(!empty($_POST['subject'])) ? $_POST['subject'] : 'კონტაქტი';
                $message = htmlspecialchars($_POST['msg']);
                mail_utf8($registry['contact'][0]['email'],htmlspecialchars($_POST['name']),$_POST['email'],$subject, $message);

                header("location:/com/contacts?success=true");

            }else{
                $message[0] = "error";
                $message[1] ='შეცდომა თქვენ შეიყვანეთ არასწორი კოდი ფოტოსურათიდან.';
            }
        }else{
            $message[0]="error";
            $message[1]='არასწორი ელ.ფოსტა';
        }
    }else{
        $message[0]="error";
        $message[1]='გთხოვთ მიუთითოთ თქვენი სახელი';
    }
}