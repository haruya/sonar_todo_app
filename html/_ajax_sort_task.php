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
$error = FALSE;
parse_str($_POST['task']);
$projectId = $_POST['projectId'];
//-----------------------------------------------logic

$db->beginTransaction();
foreach ($task as $key => $val) {
    $updateParams = array(
        array(':seq', $key, PDO::PARAM_INT),
        array(':task_id', $val, PDO::PARAM_INT),
        array(':project_id', $projectId, PDO::PARAM_INT)
    );
    $ret = $db->executeSql($taskSeqUpdate, $updateParams);
    if (!ret) {
        $db->rollback();
        $error = TRUE;
        ErrorLog::message("DBエラー(タスク並び順変更に失敗しました。)");
        break;
    }
}

if ($error === FALSE) {
    $db->commit();
}
