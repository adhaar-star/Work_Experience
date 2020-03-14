<?php

/* 
 * This file will change the status of meals in leftover_meal_listing table in databse which expires
 */

require_once 'config/config.php';

$timestamp = time();
$expired = $db->query("SELECT * FROM `leftover_meal_listing` WHERE `expire_after` < {$timestamp} && `status` = 1");
$counter = 0;
$ids = '';
$cron_history['timestamp'] = $timestamp;
if($expired->num_rows > 0) {
    $ids .= '(';
    while($record = $expired->fetch_array(MYSQLI_ASSOC)) {
        $ids .= $record['id'].', ';
        $cron_history['id_list'][] = $record['id'];
        $counter++;
    }
    $ids = rtrim($ids, ', ').')';
    $cron_history['count'] = $counter;
    $cron_history['result'] = $db->query("UPDATE `leftover_meal_listing` SET `status` = 4 WHERE `id` IN {$ids}");
} else {
    $cron_history['count'] = $counter;
    $cron_history['result'] = 0;
}

$cron_log_query = '';
if($counter > 0) {
    $cron_history['id_list'] = json_encode($cron_history['id_list']);
    $cron_log_query = "INSERT INTO `cron_log`(`timestamp`, `affected_records`, `result`, `affected_meal_id_list`) VALUES 
            ({$cron_history['timestamp']}, {$cron_history['count']}, {$cron_history['result']}, '{$cron_history['id_list']}')";
} else {
    $cron_history['id_list'] = '[]';
    $cron_log_query = "INSERT INTO `cron_log`(`timestamp`, `affected_records`, `result`, `affected_meal_id_list`) VALUES 
            ({$cron_history['timestamp']}, {$cron_history['count']}, {$cron_history['result']}, '{$cron_history['id_list']}')";
}

if($counter > 0) {
    $db->query($cron_log_query);
} elseif(!is_loggedin()) {
    $db->query($cron_log_query);
}
