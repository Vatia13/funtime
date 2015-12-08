<?php
/**
 *
 * CMS It-Solutions 0.1
 * Author: Vati Child
 * E-mail: vatia0@gmail.com
 * URL: www.it-solutions.ge
 *
 */

defined('_JEXEC') or die('Restricted access');
$time = time();
if($registry['post'][0]['test'] > 0) {
        $value = $registry['post'][0]['test'];
        $ip = getIP();
        $registry['test'] = $DB->getAll("SELECT #__tests.* FROM #__tests WHERE #__tests.id='{$registry['post'][0]['test']}' and #__tests.status='0' and #__tests.date < {$time}");
        $registry['question'] = unserialize($registry['test'][0]['question']);
        $registry['qnum'] = count($registry['question']) / 1.25;
        $registry['answer'] = unserialize($registry['test'][0]['answer']);
        $registry['point'] = unserialize($registry['test'][0]['point']);
        $registry['result'] = unserialize($registry['test'][0]['result']);
        $registry['myres'] = 0;
        $registry['answer_keys'] = array_keys($registry['answer']);
        $point_keys = array_keys($registry['point']);
        $registry['check_vic'] = $DB->getOne("SELECT status FROM #__vic_results WHERE vic_id='{$value}' and ip='{$ip}'");
        $registry['check_winner'] = $DB->getOne("SELECT count(id) FROM #__vic_winners WHERE vic_id='{$value}' and ip='{$ip}'");
        $registry['winners'] = $DB->getOne("SELECT count(id) FROM #__vic_results WHERE vic_id='{$value}' and  status='1'");
        if ($_POST['result']) {
            for ($i = 0; $i < count($_POST['ans']); $i++) {
                $registry['myres'] = $registry['myres'] + intval($registry['point'][$i][$_POST['ans'][$i]]);
            }
            //print_r($registry['result']);
            //print_r($registry['myres']);
            foreach ($registry['result'] as $item):
                if ($item['min'] <= $registry['myres'] and $item['max'] >= $registry['myres']) {
                    $registry['resultinfo'] = $item['text'];
                }
            endforeach;
            $DB->execute("UPDATE #__tests SET done=done+1 WHERE id='{$value}'");
            $stat = ($registry['myres'] >= $registry['qnum']) ? '1' : '2';
            if($registry['check_vic'] <= 0 && $registry['winners'] <= 10):
            $DB->execute("INSERT INTO #__vic_results (vic_id,ip,status) VALUES ('$value','$ip','$stat')");
            endif;
            setcookie("TestCookie", $value, time() + 3600);
        }



}