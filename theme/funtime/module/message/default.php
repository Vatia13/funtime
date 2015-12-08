<?php defined('_JEXEC') or die('Restricted access');?>
<div class="black-background"></div>
<div class="message-form">
    <div>
      <a onclick="closeMessage()" class="close-message-form">X</a>
      <span style="font-size:18px;color:#009900;"></span>
      <form method="post" name="message" onSubmit="return sendMessage(this)">
        <input type="email" name="mails" placeholder="ელ.ფოსტა" class="form-control">
          <br>
        <input type="text" name="author" placeholder="ავტორი" class="form-control">
          <br>
        <textarea name="textvalue" placeholder="სათაური, ლიდი , ტექსტი"  class="form-control" style="width:400px;height:400px"></textarea>
          <br><br>
          <input type="submit" name="sendmessage" style="display:none;">
          <a onclick="makeClick('sendmessage')" class="button-success">გაგზავნა</a>
      </form>
    </div>
</div>