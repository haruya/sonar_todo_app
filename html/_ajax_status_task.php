<?php
//-----------------------------------------------define
require_once('../conf/config.php');
require_once('./class/utility.php');
require_once('./class/db.php');
require_once('./class/sql.php');
require_once('./class/log.php');

$utl = new Utility();
$db = new DbPdo();

//-----------------------------------------------session
session_name(SESSION_NAME);
session_start();
//-----------------------------------------------login check
if (!isset($_SESSION['loginInfo']) || (isset($_SESSION['loginInfo']) && empty($_SESSION['loginInfo']))) {
    header('Location: '.SITE_URL.'login.php');
}

//-----------------------------------------------valiables
$status = $_POST['status'];
$taskId = $_POST['taskId'];
$projectId = $_POST['projectId'];
//-----------------------------------------------logic

$db->beginTransaction();
$updateParams = array(
    array(':status', $status, PDO::PARAM_STR),
    array(':task_id', $taskId, PDO::PARAM_INT),
    array(':project_id', $projectId, PDO::PARAM_INT)
);
$ret = $db->executeSql($taskStatusUpdate, $updateParams);
if ($ret) {
    $db->commit();
} else {
    $db->rollback();
    ErrorLog::message("DBエラー(タスク並び順変更に失敗しました。)");
}

