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
$id = (int)$_POST['id'];
//-----------------------------------------------logic

// プロジェクトstatus変更
$db->beginTransaction();
$updateParams = array(
    array(':project_id', $id, PDO::PARAM_INT)
);
$ret = $db->executeSql($projectStatusUpdate, $updateParams);
if ($ret) {
    $db->commit();
} else {
    $db->rollback();
    ErrorLog::message("DBエラー(プロジェクトstatus変更に失敗しました。)");
}

