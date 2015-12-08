$contest_out = "<div class='contest_rate contest_id_".$i."'>
    <div class='contest_stars'>";
        if(abs($days / (3600 * 24)) > 7):
        $contest_out .= "<div style='padding:5px;'>მიმდინარე კვირის კონკურსი დასრულებულია</div>";
        else:
        $contest_out .= "მომეცი სამი ვარსკვლავი
        <div>
            <a ".$addStar." class='star' data-star='1' data-user='".$i."' data-id='".$registry['post'][0]['id']."'>
            <img src='/img/icons/'.$vote_star.'' width='24' />
            </a>
            <a ".$addStar." class='star' data-star='2' data-user='".$i."' data-id='".$registry['post'][0]['id']."'>
            <img src='/img/icons/'.$vote_star.'' width='24' />
            </a>
            <a ".$addStar." class='star' data-star='3' data-user='".$i."' data-id='".$registry['post'][0]['id']."'>
            <img src='/img/icons/".$vote_star."' width='24' />
            </a>
        </div>";
        endif;
        $contest_out .="</div>
    <div class='contest_stars_num user_".$i."'>";

        $sum = $DB->getOne('SELECT SUM(star) FROM #__news_gallery_votes WHERE uid=''.$i.'' and news_id=''.$registry['post'][0]['id'].''');
        $contest_out .= ($sum) ? $sum : 0;

        $contest_out .="</div></div>";
else:
$contest_out .="<div class='no_star'>ვარსკვლავის მიცემა შესაძლებელია მხოლოდ საქართველოდან.</div>";
endif;
echo $contest_out;