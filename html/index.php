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

// プロジェクト一覧取得
$ret = $db->executeSql($projectSelect);
if ($ret) {
    $projectList = $db->fetchAllDatabase();
} else {
    $error[] = 'DBエラー(プロジェクト一覧の取得に失敗しました。)';
    ErrorLog::message("DBエラー(プロジェクト一覧の取得に失敗しました。)");
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
$smarty->assign('title', "プロジェクト一覧");

// 値
$smarty->assign('loginInfo', $_SESSION['loginInfo']); // ログインセッションの値
$smarty->assign('projectList', isset($projectList) ? $projectList : NULL); // プロジェクト一覧

// デバッキングコンソール
// $smarty->debugging = true;

// 読み込みテンプレート
$smarty->display('index.tpl');