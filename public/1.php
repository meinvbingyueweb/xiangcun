<?php
 include(dirname(__FILE__).'/chapt.php');
 print_r($list);exit;

// echo floor(intval(1159)/200);exit;
$content = file_get_contents(dirname(__FILE__).'/15.cache');
$content = trim($content);
$content = str_replace(PHP_EOL, '', $content);
$content = trim($content);

if (!empty($content)) {
    $content = str_replace('%k%', '', $content);
    $content = str_replace(['<br>','<br />','<br/>','<br/ >','< br>','< br/>','< br />'], '<br>', $content);
    $_arr = explode('<br>',$content);
    
    $new_arr = [];
    foreach ($_arr as $k=>$v) {
        $v = str_replace(PHP_EOL, '', $v);
        $v = trim($v);
        if (!empty($v)) {
            $new_arr[] = $v;
        }
    }
    $new_arr = array_filter($new_arr);

    $newContent = implode('</p><p>', $new_arr);
    $newContent = '<p>'.$newContent.'</p>';
    $newContent = addslashes($newContent);
} else {
    $newContent = '';
}

echo $newContent;