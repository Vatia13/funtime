<?php
/**
 * Created by Vati Child.
 * E-mail: vatia0@gmail.com
 * Date: 11/23/14
 * Time: 10:00 PM
 */

class ajax{
   private $DB;
   private $registry;
   private $p;
   public function __construct($DB,$prefix,$registry){
        $this->DB = $DB;
        $this->p = $prefix;
        $this->registry = $registry;
   }

   public function block_article($args = array()){
       if($args['user'] > 0){
        $block = $this->DB->getOne("SELECT user_block FROM {$this->p}news WHERE id={$args["post"]}");
           if($block <= 0){
               $this->DB->execute("UPDATE {$this->p}news SET user_block={$args["user"]} WHERE id={$args["post"]} ");
               die("1");
           }else{
               $user = $this->DB->getOne("SELECT realname FROM {$this->p}users WHERE id={$block}");
               die("სტატია დაბლოკილია ".$user."-ს მიერ.");
           }
       }
    }

    public function unblock_article($args = array()){
        if($args['user'] > 0){
            $block = $this->DB->getOne("SELECT user_block FROM {$this->p}news WHERE id={$args["post"]}");
            if($block == $args['user']){
                $this->DB->execute("UPDATE {$this->p}news SET user_block=0 WHERE id={$args["post"]} ");
                die("1");
            }else{
                $user = $this->DB->getOne("SELECT realname FROM {$this->p}users WHERE id={$block}");
                die("სტატია დაბლოკილია ".$user."-ს მიერ.");
            }
        }
    }

    public function load_cat($args = array()){
        $output = '';
        $id = intval($args['cid']);
        $num = intval($args['num']);
        $last_id = intval($args['last_id']);
        $time = time();
        $last = $this->DB->getOne("SELECT {$this->p}news.id FROM {$this->p}news WHERE id > 0 and cat={$id} and {$this->p}news.moderate=1 and {$this->p}news.date <= {$time} order by {$this->p}news.date ASC");
        if($last == $last_id):
            $output = "".$last_id."";
        else:
            $registry['posts'] = $this->DB->getAll('SELECT '.$this->p.'news.*,'.$this->p.'category.name,'.$this->p.'category.cat_chpu,'.$this->p.'category.id as cat_id,'.$this->p.'users.realname FROM '.$this->p.'news
                                         LEFT JOIN '.$this->p.'category ON '.$this->p.'category.id = '.$this->p.'news.cat
                                         LEFT JOIN '.$this->p.'users ON '.$this->p.'users.id = '.$this->p.'news.user
                                         WHERE '.$this->p.'category.id = "'.$id.'" and '.$this->p.'news.moderate=1 and '.$this->p.'news.date <= '.$time.' order by '.$this->p.'news.date DESC LIMIT '.$num.',12');
            if($registry['posts'][0]['id'] > 0){
                foreach($registry['posts'] as $item):
                    $title_length = string_length($item['title']);
                    if(!empty($item['title_short'])){
                        $short_length = string_length($item['title_short']);
                        $short_text = $item['title_short'];
                    }else{
                        $short_length = string_length($item['text_short']);
                        $short_text = $item['text_short'];
                    }
                    $content_length = $title_length + $short_length;
                    $short_length = 165 - $title_length;
                    $reg['slide'] = get_serialize($item['slide']);
if(count($reg['slide']['img']) > 1):
    $foto = '<h3 style="background-image:url(/theme/funtime/images/main_icon.png);background-repeat:no-repeat;background-position:right 10px center;padding:30px 50px 27px 10px;"></h3>';
endif;
                    $output.='<li data-last_id="'.$item['id'].'">
        <a href="http://'.$_SERVER['SERVER_NAME'].'/'.$item['cat_chpu'].'/'.$item['chpu'].'/"><img src="'.substr($item['thumbs'],2).'" width="558"/>'.$foto.'</a>
        <div class="category-post-title"><a href="http://'.$_SERVER['SERVER_NAME'].'/'.$item['cat_chpu'].'/'.$item['chpu'].'/">'.title_filter($item['title'],60).'</a></div>
        <div class="category-post-short"><i>'.title_filter($short_text,$short_length).'</i></div>
        <div class="category-post-time">
            <table class="time-like">
                <tr>
                    <td><i>'.gedate('l H:i',$item['date']).' | '.gedate('d.m.Y',$item['date']).'</i></td>
                      <td valign="center">
                            <span>ავტორი:</span> '.$item['realname'].'
                       </td>
                </tr>
                <tr>
                    <td><div class="fb-like" data-href="http://'.$_SERVER['SERVER_NAME'].'/'.$item['cat_chpu'].'/'.$item['chpu'].'/" data-width="80" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div> <div class="fb-share-button" data-href="http://'.$_SERVER['SERVER_NAME'].'/'.$item['cat_chpu'].'/'.$item['chpu'].'/" data-layout="button_count"></div></td>
                    <td></td>
                </tr>
            </table>
        </div>

    </li>';
                endforeach;
            }else{
                $output = '0';
            }
        endif;
        die($output);
    }

    public function load_sak($args = array()){
        $output = '';
        $id = intval($args['cid']);
        $num = intval($args['num']);
        $last_id = intval($args['last_id']);
        $time = time();
        $last = $this->DB->getOne("SELECT {$this->p}news.id FROM {$this->p}news WHERE id > 0 and cat={$id} and {$this->p}news.moderate=1 and {$this->p}news.date <= {$time} order by {$this->p}news.date ASC");
        if($last == $last_id):
            $output = "".$last_id."";
        else:
            $registry['posts'] = $this->DB->getAll('SELECT '.$this->p.'news.*,'.$this->p.'category.name,'.$this->p.'category.cat_chpu,'.$this->p.'category.id as cat_id FROM '.$this->p.'news
                                         LEFT JOIN '.$this->p.'category ON '.$this->p.'category.id = '.$this->p.'news.cat
                                         WHERE '.$this->p.'category.id = "'.$id.'" and '.$this->p.'news.moderate=1 and '.$this->p.'news.date <= '.$time.' order by '.$this->p.'news.date DESC LIMIT '.$num.',14');
            if($registry['posts'][0]['id'] > 0){

        foreach($registry['posts'] as $item):
            $output .= '<li data-last_id="'.$item['id'].'">
                <div class="saknatuno-image"><a href="http://'.$_SERVER['SERVER_NAME'].'/'.$item['cat_chpu'].'/'.$item['chpu'].'/"><img src="'.substr($item['thumbs'],2).'" width="215" align="left"/></a></div>
                <a href="http://'.$_SERVER['SERVER_NAME'].'/'.$item['cat_chpu'].'/'.$item['chpu'].'/">'.$item['title'].'</a>
                <br>
                <div class="saknatuno-time"><span>'.gedate('H:i',$item['date']).' </span> / <span> '.gedate('d.m.Y',$item['date']).'</span></div>
                <div class="fix"></div>
            </li>';
        endforeach;

            }else{
                $output = '0';
            }
        endif;
        die($output);
    }

    function load_search($args=array()){
        $output = '';
        $value = $args['txt'];
        $num = intval($args['num']);
        $last_id = intval($args['last_id']);
        $time = time();
        if($value == "archive"){
            $sql_search = "";
            $sql_count = "";
        }else{
            $sql_search = '('.$this->p.'news.title LIKE "%'.$value.'%" or '.$this->p.'news.text LIKE "%'.$value.'%") and ';
            $sql_count = "({$this->p}news.title LIKE '%{$value}%' or {$this->p}news.text LIKE '%{$value}%') and";
        }
        $last = $this->DB->getOne("SELECT {$this->p}news.id FROM {$this->p}news WHERE {$sql_count} {$this->p}news.moderate=1 and {$this->p}news.date <= {$time} order by {$this->p}news.date ASC");
        if($last == $last_id):
            $output .= "".$last_id."";
        else:
            $registry['search'] = $this->DB->getAll('SELECT '.$this->p.'news.*,'.$this->p.'users.realname,'.$this->p.'category.name,'.$this->p.'category.cat_chpu,'.$this->p.'category.id as cat_id FROM '.$this->p.'news
                                         LEFT JOIN '.$this->p.'category ON '.$this->p.'category.id = '.$this->p.'news.cat
                                         LEFT JOIN '.$this->p.'users ON '.$this->p.'users.id = '.$this->p.'news.user
                                         WHERE '.$sql_search .' '.$this->p.'news.moderate=1 and '.$this->p.'news.date <= '.$time.' order by '.$this->p.'news.date DESC LIMIT '.$num.',21');
            if($registry['search'][0]['id'] > 0){
            foreach($registry['search'] as $item):
                $reg['slide'] = get_serialize($item['slide']);
if(count($reg['slide']['img']) > 1):
    $style = "background-image:url('/theme/funtime/images/main_icon.png');background-repeat:no-repeat;background-size:30px 30px;background-position:right 10px center;padding:10px 50px 7px 10px;";
else:
    $style = "padding:10px 10px 7px 10px;";
endif;
                $title_length = string_length($item['title']);
                if(!empty($item['title_short'])){
                    $short_length = string_length($item['title_short']);
                    $short_text = $item['title_short'];
                }else{
                    $short_length = string_length($item['text_short']);
                    $short_text = $item['text_short'];
                }
                $content_length = $title_length + $short_length;
                $short_length = 135 - $title_length;
                $output .= '<li data-last_id="'.$item['id'].'">
<a href="http://'.$_SERVER['SERVER_NAME'].'/'.$item['cat_chpu'].'/"><h3 style="'.$style.'">'.$item['name'].'</h3></a>
<a href="http://'.$_SERVER['SERVER_NAME'].'/'.$item['cat_chpu'].'/'.$item['chpu'].'/"><img src="'.substr($item['thumbs'],2).'" width="363" title="'.$item['title'].'" height="225"/></a>
<br><br>
<div class="search-post-title"><a href="http://'.$_SERVER['SERVER_NAME'].'/'.$item['cat_chpu'].'/'.$item['chpu'].'/">'.title_filter($item['title'],60).'</a></div>
<div class="search-post-short">'.title_filter($short_text,$short_length).'</div>
<table class="time-like-short">
    <tr>
        <td>'.gedate('l H:i',$item['date']).' | '.gedate('d.m.Y',$item['date']).'</td>
             <td valign="center">
                            <span>ავტორი:</span> '.$item['realname'].'
                        </td>
                    </tr>
                    <tr>
                        <td><div class="fb-like" data-href="http://'.$_SERVER['SERVER_NAME'].'/'.$item['cat_chpu'].'/'.$item['chpu'].'/" data-width="80" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div> <div class="fb-share-button" data-href="http://'.$_SERVER['SERVER_NAME'].'/'.$item['cat_chpu'].'/'.$item['chpu'].'/" data-layout="button_count"></div></td>
                        <td></td>
                    </tr>
</table>
</li>';
            endforeach;
            }else{
                $output .= '0';
            }
        endif;
        die($output);
    }


    function sendMessage($args){
         $author = PHP_slashes(htmlspecialchars(strip_tags($args['author'])));
         $text = PHP_slashes(htmlspecialchars(strip_tags($args['text'])));
         $mailsup = $this->DB->getOne('SELECT value FROM '.$this->p.'setting WHERE name="emailsup"');
         if(!empty($author) && !empty($text)){
             $headers = '';
             $text = "ავტორი: ".$author."\r\n" .  "ტექსტი: " . $text;
             $to      = $mailsup;
             $subject = 'funtime.ge - წერილი თავისუფალ ტრიბუნას';
             $message = $text;
             $headers .= 'From: '.$args['email'].' ' . "\r\n";
             $headers .= 'Reply-To: '.$to.'' . "\r\n";
             $headers .= "MIME-Version: 1.0\r\n";
             $headers .= "Content-Type: text/html; charset=utf-8\r\n";
             mail($to, $subject, $message, $headers);
             die("1");
         }else{
             die("0");
         }
    }


    function LoadMobile($args=array()){
        $output = '';
        $num = intval($args['num']) + 3;
        $last_id = intval($args['last_id']);
        $time = time();
        $last = $this->DB->getOne("SELECT {$this->p}news.id FROM {$this->p}news WHERE id > 0 and osr_news.cat!=116 and osr_news.moderate=1 and osr_news.date <= {$time} order by osr_news.date ASC");
        if($last == $last_id):
            $output = "".$last_id."";
        else:
            $registry['posts'] = $this->DB->getAll('SELECT osr_news.*,'.$this->p.'category.cat_chpu FROM osr_news
                                         LEFT JOIN osr_category ON osr_category.id = osr_news.cat
                                         WHERE osr_news.cat!=116 and '.$this->p.'news.moderate=1 and osr_news.date <= '.$time.' order by osr_news.date DESC LIMIT '.$num.',4');
            if($registry['posts'][0]['id'] > 0){
                    foreach($registry['posts'] as $item):
                        $output .= '<li class="mob"  data-last_id="'.$item['id'].'">
                                       <ul>
                                        <li><a href="http://'.$_SERVER['SERVER_NAME'].'/'.$item['cat_chpu'].'/'.$item['chpu'].'/">'.$item['title'].'</a><div class="five-time"><span>'.gedate('l H:i',$item['date']).' </span> <span> '.gedate('d.m.Y',$item['date']).'</span></div></li>
                                        <li><a href="http://'.$_SERVER['SERVER_NAME'].'/'.$item['cat_chpu'].'/'.$item['chpu'].'/"><img src="'.substr($item['thumbs'],2).'" width="100%"></a></li>
                                      </ul>
                                    </li>';
                    endforeach;
            }else{
                $output = '0';
            }
        endif;
        die($output);
    }

    function catMobile($args=array()){
        $output = '';
        $cat = intval($args['cid']);
        $num = intval($args['num']);
        $last_id = intval($args['last_id']);
        $time = time();
        $last = $this->DB->getOne("SELECT {$this->p}news.id FROM {$this->p}news WHERE id > 0 and '.$this->p.'news.cat={$cat} and {$this->p}news.moderate=1 and {$this->p}news.date <= {$time} order by {$this->p}news.date ASC");
        if($last == $last_id):
            $output = "".$last_id."";
        else:
            $registry['posts'] = $this->DB->getAll('SELECT '.$this->p.'news.*,'.$this->p.'category.cat_chpu FROM '.$this->p.'news
                                         LEFT JOIN '.$this->p.'category ON '.$this->p.'category.id = '.$this->p.'news.cat
                                         WHERE '.$this->p.'news.cat='.$cat.' and '.$this->p.'news.moderate=1 and '.$this->p.'news.date <= '.$time.' order by '.$this->p.'news.date DESC LIMIT '.$num.',4');
            if($registry['posts'][0]['id'] > 0){
                foreach($registry['posts'] as $item):
                    $output .= '<li data-last_id="'.$item['id'].'">
                                       <ul>
                                        <li><a href="http://'.$_SERVER['SERVER_NAME'].'/'.$item['cat_chpu'].'/'.$item['chpu'].'/">'.$item['title'].'</a><div class="five-time"><span>'.gedate('l H:i',$item['date']).' </span> <span> '.gedate('d.m.Y',$item['date']).'</span></div></li>
                                        <li><a href="http://'.$_SERVER['SERVER_NAME'].'/'.$item['cat_chpu'].'/'.$item['chpu'].'/"><img src="'.substr($item['thumbs'],2).'" width="100%"></a></li>
                                      </ul>
                                    </li>';
                endforeach;
            }else{
                $output = '0';
            }
        endif;
        die($output);
    }

    function srcMobile($args=array()){
        $output = '';
        $value = $args['txt'];
        $num = intval($args['num']);
        $last_id = intval($args['last_id']);
        $time = time();
        $sql_search = '('.$this->p.'news.title LIKE "%'.$value.'%" or '.$this->p.'news.text LIKE "%'.$value.'%") and ';
        $sql_count = "({$this->p}news.title LIKE '%{$value}%' or {$this->p}news.text LIKE '%{$value}%') and";
        $last = $this->DB->getOne("SELECT {$this->p}news.id FROM {$this->p}news WHERE {$sql_count} {$this->p}news.moderate=1 and {$this->p}news.date <= {$time} order by {$this->p}news.date ASC");
        if($last == $last_id):
            $output = "".$last_id."";
        else:
            $registry['posts'] = $this->DB->getAll('SELECT '.$this->p.'news.*,'.$this->p.'category.cat_chpu FROM '.$this->p.'news
                                                    LEFT JOIN '.$this->p.'category ON '.$this->p.'category.id = '.$this->p.'news.cat
                                                    WHERE '.$sql_search .' '.$this->p.'news.moderate=1 and '.$this->p.'news.date <= '.$time.' order by '.$this->p.'news.date DESC LIMIT '.$num.',4');
            if($registry['posts'][0]['id'] > 0){
                foreach($registry['posts'] as $item):
                    $output .= '<li data-last_id="'.$item['id'].'">
                                       <ul>
                                        <li><a href="http://'.$_SERVER['SERVER_NAME'].'/'.$item['cat_chpu'].'/'.$item['chpu'].'/">'.$item['title'].'</a><div class="five-time"><span>'.gedate('l H:i',$item['date']).' </span> <span> '.gedate('d.m.Y',$item['date']).'</span></div></li>
                                        <li><a href="http://'.$_SERVER['SERVER_NAME'].'/'.$item['cat_chpu'].'/'.$item['chpu'].'/"><img src="'.substr($item['thumbs'],2).'" width="100%"></a></li>
                                      </ul>
                                    </li>';
                endforeach;
            }else{
                $output = '0';
            }
        endif;
        die($output);
    }


    function addWinner($args=array()){
        $name = PHP_slashes(htmlspecialchars(strip_tags($args['name'])));
        $phone = PHP_slashes(htmlspecialchars(strip_tags($args['phone'])));
        $id = intval($args['id']);
        $ip = getIp();

        if(!empty($name) && !empty($phone)){
            if($this->DB->execute("INSERT INTO osr_vic_winners (name,phone,vic_id,date,ip) VALUES ('$name','$phone','$id', NOW(), '$ip')")){
                echo 1;
            }else{
                echo 0;
            }
        }else{
            echo "გთხოვთ ჩაწეროთ სახელი, გვარი და ტელეფონი";
        }
        die();
    }


    function loadMore($args=array()){
        global $theme;
        $time = time();
        $last_id = intval($args['last_id']);
        $num = intval($args['num']);
        $out = '';
        $last = $this->DB->getOne("SELECT {$this->p}news.id FROM {$this->p}news WHERE {$this->p}news.moderate=1 and {$this->p}news.date <= {$time} order by {$this->p}news.date ASC");

        if($last == $last_id){
            echo $last_id;
        }else{
            if($last_id > 0){
                $registry['more_articles'] = $this->DB->getAll('SELECT osr_news.*,osr_users.realname,osr_category.name,osr_category.cat_chpu FROM osr_news
                                         LEFT JOIN osr_users ON osr_users.id = osr_news.user
                                         LEFT JOIN osr_category ON osr_category.id = osr_news.cat
                                         WHERE osr_news.moderate = 1 and osr_category.test = 0 and osr_category.section = "post" and osr_news.date <= '.$time.' ORDER BY osr_news.date DESC LIMIT '.$num.',5');
                if(count($registry['more_articles']) > 0):
                    $out .='<ul>';
                    foreach($registry['more_articles'] as $item):
                        $th['slide'] = get_serialize($item['slide']);
                        $out .= '<li class="web" data-id="'.$item['id'].'"><div class="five-rubric">';
                        $out .= '<a href="http://'.$_SERVER['SERVER_NAME'].'/'.$item['cat_chpu'].'/">'.$item['name'].'</a><br>';
                        $out .= '<div class="five-time">'.gedate('d.m.Y',$item['date']).'</div><br><br>';
                        $out .= '<div class="fb-like" data-href="http://'.$_SERVER['SERVER_NAME'].'/'.$item['cat_chpu'].'/'.$item['chpu'].'/" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true"></div></div>';
                        $out .= '<div class="five-title"><a href="http://'.$_SERVER['SERVER_NAME'].'/'.$item['cat_chpu'].'/'.$item['chpu'].'/">'.$item['title'].'</a><br><br>'.strip_tags($item['text_short']);
                        $out .= '<div class="fix"></div></div>';
                        $out .= '<div class="five-image">';
                        $out .= '<a href="http://'.$_SERVER['SERVER_NAME'].'/'.$item['cat_chpu'].'/"><h3 style="';
                        if(count($th['slide']['img']) > 1): $out .= "background-image:url('/".$theme."images/main_icon.png');background-repeat:no-repeat;background-size:30px 30px;background-position:right 10px center;padding:10px 50px 7px 10px;";
                        elseif($item['style'] == 12): $out .="background-image:url('/".$theme."images/vcam.png');background-repeat:no-repeat;background-size:30px 26px;background-position:right 10px center;padding:10px 50px 7px 10px;";
                        else: $out .= "padding:10px 10px 7px 10px;";endif;
                        $out .= '">'.$item['name'].'</h3></a>';
                        $out .= '<a href="http://'.$_SERVER['SERVER_NAME'].'/'.$item['cat_chpu'].'/'.$item['chpu'].'/"><img src="'.substr($item['thumbs'],2).'" width="400"></a></div></li>';
                    endforeach;
                    $out .= '</ul>';
                    echo $out;
                else:
                    echo 0;
                endif;
            }
        }

        die();
    }



    function load_test($args=array()){
        $output = '';

        $num = intval($args['num']);
        $last_id = intval($args['last_id']);
        $type = intval($args['tp']);
        $time = time();

        $last = $this->DB->getOne("SELECT {$this->p}tests.id FROM {$this->p}tests WHERE {$this->p}tests.date <= {$time} order by {$this->p}tests.date ASC");
        if($last == $last_id):
            $output .= "".$last_id."";
        else:
            $registry['tests'] = $this->DB->getAll("SELECT osr_tests.* FROM osr_tests WHERE status='0' and type='{$type}' and date < {$time} ORDER BY date DESC LIMIT $num,20");
           if($registry['tests'][0]['id'] > 0){
                foreach($registry['tests'] as $item):
                 $output .= '<li data-last_id="'.$item['id'].'"><a href="/com/test/view/'.$item['id'].'"><img src="'.$item['img'].'" align="left" height="130">'.$item['title'].'<br><br><span>'.$item['lid'].'</span></a></li>';

                endforeach;
            }else{
                $output .= '0';
            }
        endif;
        die($output);

    }


    function addStar($args=array()){
        $ip = ip2long(getIP());
        $browser = base64_encode(serialize(get_browser(null,true)));
        if($this->get_country_code() == 'GE'):
            if($ip > 0 && $args['star'] > 0 && $args['user'] > 0 && $args['id'] > 0){
                $expire = time() + (3600 * 24 * 10);
                $check = $this->DB->getOne("SELECT id FROM osr_news_gallery_votes WHERE news_id='".$args['id']."' and uid='".$args['user']."' and (ip='".ip2long(getIP())."' or cookie='".bigintval($_COOKIE["guestv_".$args["id"]."_".$args['user']])."')");
                if(!$check && $check <=0){
                    setcookie("guestv_".$args["id"]."_".$args['user'],'1'.$ip.$args['user'].$args['star'],$expire,'/');
                    if($this->DB->execute("INSERT INTO osr_news_gallery_votes (news_id,uid,browser,star,ip,cookie) VALUES ('".intval($args["id"])."','".intval($args["user"])."','".$browser."','".intval($args["star"])."','".$ip."','1".$ip.$args['user'].$args['star']."')")){
                        echo $args['star'];
                    }else{
                        echo 0;
                    }
                }else{
                    echo 0;
                }
                //echo $ip.",".$args['star'].",".$args['user'].",".$args['id'].",".$args['cid'];
            }
        endif;
        die();
    }

    function get_country_code(){
        include_once('../geoip/geoip.php');
        $ip = getIP();
        if((strpos($ip, ":") === false)) {
            //ipv4
            $gi = geoip_open("../geoip/GeoIP.dat",GEOIP_STANDARD);
            $country = geoip_country_code_by_addr($gi, $ip);
        }
        else {
            //ipv6
            $gi = geoip_open("../geoip/GeoIPv6.dat",GEOIP_STANDARD);
            $country = geoip_country_code_by_addr_v6($gi, $ip);
        }
        return $country;
    }


}
