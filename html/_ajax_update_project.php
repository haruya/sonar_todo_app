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
$projectId = (int)$_POST['projectId'];
$projectMei = $_POST['projectMei'];
//-----------------------------------------------logic

// プロジェクトstatus変更
$db->beginTransaction();
$updateParams = array(
    array(':project_id', $projectId, PDO::PARAM_INT),
    array(':project_mei', $projectMei, PDO::PARAM_STR)
);

$ret = $db->executeSql($projectMeiUpdate, $updateParams);
if ($ret) {
    $db->commit();
} else {
    $db->rollback();
    ErrorLog::message("DBエラー(プロジェクト名変更に失敗しました。)");
}

