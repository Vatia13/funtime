<?php defined('_JEXEC') or die('Restricted access');?>
<?php if($registry['post'][0]['test'] > 0) {?>
<div class="fix"></div>
<div id="victorina">
<br>
<h3 style="font-family:'BPGIngiri2008Regular';color:#ff5704;margin:0;"><?=$registry['test'][0]['title'];?></h3>
<hr>
<?if(!$_POST['result'] && $registry['check_vic'] <= 0):?>
<img src="<?=$registry['test'][0]['img'];?>" align="left" height="130"> <span style="font-family:'BPGIngiri2008Regular';margin-left:10px;"><?=$registry['test'][0]['lid'];?></span>
<div class="fix"></div>
<div class="testpage">
<form action="" method="post" name="test" onsubmit="checkTest(this);return false;">

    <ol>
        <?$i=-1;foreach($registry['question'] as $q):$i++;?>

            <li>
                <?=$q;?>
                <dl>
                    <?for($a=0;$a<count($registry['answer'][$registry['answer_keys'][$i]]);$a++):?>
                        <dt><input type="radio" name="ans[<?=$i;?>]" value="<?=$a?>"><?=$registry['answer'][$registry['answer_keys'][$i]][$a];?></dt>
                    <?endfor?>
                </dl>
            </li>
        <?endforeach;?>
    </ol>
    <div class="fix"></div>
    <div class="error_box" style="display:none;"></div>
    <input type="submit" id="testres" name="result" value="შედეგის ნახვა" class="button-success" style="border:none;position:relative;left:41%;" >
<br>
</form>
    </div>
<?else:
    $sum = array();
    foreach($registry['point'] as $point):
        $sum [] = max($point);
    endforeach;
    $sum = array_sum($sum);

    ?>
    <div class="test-result" align="center">
        <?if($registry['myres'] >= $registry['qnum'] || $registry['check_vic'] == 1):?>
            <?if($registry['myres'] > 0):?>თქვენ დააგროვეთ <span><?=$sum;?></span> ქულიდან <span><?=$registry['myres'];?></span> ქულა<?endif;?>

            <?if($registry['winners'] < 10):?>

                <h3>
                    გილოცავთ! თქვენ გაიმარჯვეთ და იმისთვის რომ მიიღოთ კინო <span>„რუსთაველის“</span> ორი ბილეთი, შესაბამის ველებში მიუთითეთ თქვენი სახელი,გვარი და ტელეფონის ნომერი.
                </h3>
            <div class="error_box" style="display:none;"></div>
            <div class="form-place" style="font-family:'BPGIngiri2008Regular';color:#009900;">
                <?if($registry['check_winner'] > 0):?>
                    <p>გმადლობთ, თქვენ 24 საათის განმავლობაში დაგიკავშირდებიან.</p>
                    <?else:?>
            <form style="width:250px;margin:0 auto;position:relative;" method="post" onsubmit="return sendWinner(this);">
                <p><input type="text" placeholder="სახელი, გვარი" name="name" class="form-control"/></p>
                <p><input type="text" placeholder="ტელეფონის ნომერი" name="phone" class="form-control"/></p>
                <p><input type="submit" name="winner" value="გაგზავნა" class="button-secondary" style="border:none;"/></p>
            </form>
                <?endif;?>
            </div>
             <?else:?>
                <h3>გილოცავთ! თქვენ წარმატებით გაიარეთ ტესტი, სამწუხაროდ 10 გამარჯვებული უკვე გამოვლინდა. სცადეთ შემდეგ ოთხშაბათს, 17:00 საათზე.</h3>
            <?endif;?>
        <?elseif($registry['myres'] < $registry['qnum'] || $registry['check_vic'] == 2):?>
            <h3>სამწუხაროდ თქვენ ვერ გახდით ვიქტორინის გამარჯვებული.</h3>
        <?endif;?>
                    <br>
        <a class="facebook-btn" href="http://www.facebook.com/sharer.php?u=http://<?=$_SERVER['SERVER_NAME'];?>/<?=$registry['post'][0]['cat_chpu'];?>/<?=$registry['post'][0]['chpu'];?>/"
           onclick="shareWindow('Facebook',this);return false;" ></a>
    </div>
    <script>
        $("html, body").animate({ scrollTop: $('#victorina').offset().top - 220 }, 100);
        var sendWinner = function(e){
            var name = $('input[name="name"]',e).val();
            var phone = $('input[name="phone"]',e).val();
            var cid = '<?=$registry['post'][0]['test'];?>';
            if(name != "" && phone != ""){
                $.ajax({
                    url:'/lib/ajax-admin.php',
                    type:'POST',
                    data:{name:name,phone:phone,id:cid,action:'addWinner'},
                    success:function(data){
                        if(data == 1){
                            $(".form-place").html("<p>გმადლობთ, თქვენ 1 კვირის განმავლობაში დაგიკავშირდებიან.</p>");
                        }else{
                            $(".form-place").html("<span color='red'>ვერ ხერხდება ბაზასთან დაკავშირება გთხოვთ მოგვიანებით სცადოთ.</span>");
                        }
                    }
                });
            }else{
                $('.test-result .error_box').show().html("გთხოვთ ჩაწეროთ სახელი, გვარი და ტელეფონი");
            }
            return false;
        }
    </script>
<?endif;?>
<div style="font-family:'BPGIngiri2008Regular';">
    <?if($registry['winners'] >= 10):?>
        <p>ვიქტორინაში გამოვლინდა 10 გამარჯვებული. სცადეთ შემდეგ ოთხშაბათს, 17:00 საათზე.</p>
    <?else:?>
    გამოვლინდა <?=$registry['winners'];?> გამარჯვებული.
    <?endif;?>
</div>

<hr>
</div>
<?}?>