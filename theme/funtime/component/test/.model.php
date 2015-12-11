<? defined('_JEXEC') or die('Restricted access');
$time = time();

if($_GET['section'] == 'view'):
    if(intval($_GET['value']) > 0){
        $value = intval($_GET['value']);
        $registry['test'] = $DB->getAll("SELECT #__tests.* FROM #__tests WHERE #__tests.id='{$value}'");
        if(count($registry['test']) > 0):
        $registry['question'] = get_serialize($registry['test'][0]['question']);
        $registry['answer'] = get_serialize($registry['test'][0]['answer']);
        $registry['point'] = get_serialize($registry['test'][0]['point']);
        $registry['result'] = get_serialize($registry['test'][0]['result']);
        $registry['myres'] = 0;
            if($registry['answer']){
                $registry['answer_keys'] = array_keys($registry['answer']);
            }
            if($registry['point']){
                $point_keys = array_keys($registry['point']);
            }
        if($_POST['submit']){
            for($i=0;$i<count($_POST['ans']);$i++){
                $registry['myres'] = $registry['myres'] + intval($registry['point'][$i][$_POST['ans'][$i]]);
            }
            //print_r($registry['result']);
            //print_r($registry['myres']);
            foreach($registry['result'] as $item):
                if($item['min'] <= $registry['myres'] and $item['max'] >= $registry['myres']){
                   $registry['resultinfo'] = $item['text'];
                }
            endforeach;
            $DB->execute("UPDATE #__tests SET done=done+1 WHERE id='{$value}'");
            setcookie("TestCookie", $value, time()+3600);
        }
        $registry['title'] = $registry['test'][0]['title'];
        $registry['desc'] = $registry['test'][0]['lid'];
        $registry['random'] = rand(0,9999).time();
        $registry['url'] = 'http://funtime.ge/com/test/view/'.$value;
        $registry['ogim'] = $registry['test'][0]['img'];
            endif;
    }

endif;

if($_GET['section'] == 'share'):
    if(intval($_GET['value']) > 0){

        $value = intval($_GET['value']);

            $registry['myres']= intval($_GET['value2']);
            $registry['test'] = $DB->getAll("SELECT #__tests.* FROM #__tests WHERE #__tests.id='{$value}' and status='0' and date < {$time}");
            $registry['result'] = get_serialize($registry['test'][0]['result']);
            foreach($registry['result'] as $item):
                if($item['min'] <= $registry['myres'] and $item['max'] >= $registry['myres']){
                    $registry['resultinfo'] = $item['text'];
                }
            endforeach;
        $registry['title'] = $registry['myres']." ქულა - ".$registry['test'][0]['title'];
        $registry['desc'] = 'შედეგი: '.$registry['resultinfo'];
        $registry['url'] = 'http://funtime.ge/com/test/share/'.$value.'/'.$registry['myres'].'/'.$_GET['value3'];
        $registry['ogim'] = $registry['test'][0]['img'];
        header('Refresh: 5; url=/com/test/view/'.$value);
    }
endif;

if(!$_GET['section']){

        $type = intval($_GET['type']);
        $registry['tests'] = $DB->getAll("SELECT #__tests.* FROM #__tests WHERE status='0' and type='{$type}' and date < {$time} ORDER BY date DESC LIMIT 20");


}