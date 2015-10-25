<?php
//-----------------------------------------------define
require_once('../conf/config.php');
require_once('./class/utility.php');
require_once('./class/db.php');
require_once('./class/sql.php');
require_once('./class/log.php');
require_once('Smarty.class.php');

$utl = new Utility();
$db = new DbPdo();
$smarty = new Smarty();

//-----------------------------------------------session
session_name(SESSION_NAME);
session_start();
//-----------------------------------------------login check
if (!isset($_SESSION['loginInfo']) || (isset($_SESSION['loginInfo']) && empty($_SESSION['loginInfo']))) {
    header('Location: '.SITE_URL.'login.php');
}

//-----------------------------------------------valiables
$error = array(); // エラーメッセージ格納用
//-----------------------------------------------logic

if ($_SERVER['REQUEST_METHOD'] != "POST") {
    $projectId = $_GET['project_id'];
    // 対象プロジェクト取得
    $selectParams = array(
        array(':project_id', $projectId, PDO::PARAM_INT)
    );
    $ret = $db->executeSql($targetProjectSelect, $selectParams);
    if ($ret) {
        $targetProject = $db->fetchAllDatabase();
    } else {
        $targetProject = FALSE;
        ErrorLog::message("DBエラー(対象プロジェクトの取得に失敗しました。)");
    }
    
    if (!preg_match('/^[1-9][0-9]*$/', $projectId) || $targetProject === FALSE) {
        echo "不正なアクセスです。";exit;
    }
    $ret = $db->executeSql($taskSelect, $selectParams);
    if ($ret) {
        $taskList = $db->fetchAllDatabase();
    } else {
        $error[] = 'DBエラー(タスク一覧の取得に失敗しました。)';
        ErrorLog::message("DBエラー(タスク一覧の取得に失敗しました。)");
    }
    
} else {

}

//-----------------------------------------------smarty
$smarty->template_dir = '../smarty/templates/';
$smarty->compile_dir = '../smarty/templates_c/';
$smarty->config_dir = '../smarty/configs/';
$smarty->cache_dir = '../smarty/cache/';
$smarty->escape_html = true;

// キャッシュ機能の有効化
// $smarty->caching = true;

// エラー
if (count($error) > 0) {
    $smarty->assign('error', $error);
} else {
    $smarty->assign('error', null);
}

// title
$smarty->assign('title', "タスク一覧");

// 値
$smarty->assign('loginInfo', $_SESSION['loginInfo']); // ログインセッションの値
$smarty->assign('taskList', isset($taskList) ? $taskList : NULL); // タスク一覧
$smarty->assign('targetProject', isset($taskList) ? $targetProject: NULL); // 対象プロジェクトID

// デバッキングコンソール
// $smarty->debugging = true;

// 読み込みテンプレート
$smarty->display('task.tpl');