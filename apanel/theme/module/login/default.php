<?defined('_JEXEC') or die('Restricted access');?>
<?if ( @!$user->is_loaded() ):?>
    <div class="header_login">
	    <div class="logo"><a href="http://it-solutions.ge"><img src="<?=$theme_admin?>images/logo.png" width="171" height="49" alt="it-solutions.ge" title="it-solutions.ge" border="0" /></a></div>
    </div>
         <div class="login_form">
         <h3>ადმინისტრირება</h3>
         <!--<a href="#" class="forgot_pass">Забыли пароль?</a> -->
         <form action="" method="post" class="niceform" name="loginform">

                    <dl>
                        <dt><label for="uname">მომხმარებელი:</label></dt>
                        <dd><input type="text" name="uname" size="54" /></dd>
                    </dl>
                    <dl>
                        <dt><label for="pwd">პაროლი:</label></dt>
                        <dd><input alt="password" type="password" name="pwd" size="54" /></dd>
                    </dl>

                    დამახსოვრება <input alt="remember" type="checkbox" name="remember" value="1"/>
                    
                     <dl class="submit">
                    <a onclick="document.loginform.submit();" class="btn-green">შესვლა</a>
                     </dl>
                    

                
         </form>
         </div>  
    <div class="footer_login">
    	<div class="left_footer_login">Powered by <a href="http://it-solutions.ge">it-solutions.ge</a></div>
    </div>

<?else:?>
	<?if ($user->is_active()):?>
	<div class="header">
	    <div class="logo"><a href="http://it-solutions.ge"><img src="<?=$theme_admin?>images/logo.png" width="171" height="49" alt="it-solutions" title="it-solutions.ge" border="0" /></a></div>
	    <div class="right_header">გამარჯობა <b><?=$user->get_property('username');?></b>, <a href="?logout=1" class="logout">გასვლა</a></div>
	</div>
	<?endif;?>
<?endif;?>
<script>
    $(function () {
        $(document).keyup(function (e) {
            if($('input[name="uname"]').val() != '' && $('input[name="pwd"]').val() != ''){
                if(e.keyCode == 13){
                    document.loginform.submit();
                }
            }
        });
    });
</script>