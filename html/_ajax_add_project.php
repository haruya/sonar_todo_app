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
$projectMei = $_POST['projectMei'];
//-----------------------------------------------logic

// プロジェクトの並び順の最後の値を取得
$ret = $db->executeSql($projectMaxSeqSelect);
if ($ret) {
    $projectMaxSeq = $db->fetchAllDatabase();
    if ($projectMaxSeq[0]['maxSeq'] != NULL) {
        $seq = $projectMaxSeq[0]['maxSeq'];
    } else {
        $seq = 0;
    }
    $db->beginTransaction();
    $insertParams = array(
        array(':project_mei', $projectMei, PDO::PARAM_STR),
        array(':seq', $seq, PDO::PARAM_INT)
    );
    $ret = $db->executeSql($projectInsert, $insertParams);
    if ($ret) {
        echo $db->getLastInsertId();
        $db->commit();
    } else {
        $db->rollback();
        ErrorLog::message("DBエラー(プロジェクト追加に失敗しました。)");
    }
} else {
    ErrorLog::message("DBエラー(プロジェクトの並び順の最後の値の取得に失敗しました。)");
}
