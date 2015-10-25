<?php
//-----------------------------------------------define
require_once('../conf/config.php');
require_once('./class/log.php');

//-----------------------------------------------session
session_name(SESSION_NAME);
session_start();
//-----------------------------------------------login check
if (!isset($_SESSION['loginInfo']) || (isset($_SESSION['loginInfo']) && empty($_SESSION['loginInfo']))) {
    header('Location: '.SITE_URL.'login.php');
}

//-----------------------------------------------logic
// ログアウト処理
$_SESSION = array(); // まずはセッションの中身を空の配列にする。
session_destroy(); // サーバー側のセッション情報を削除する。

header('Location: '.SITE_URL.'login.php');
exit;
