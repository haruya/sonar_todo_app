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
if (isset($_SESSION['loginInfo']) && !empty($_SESSION['loginInfo'])) {
    header('Location: '.SITE_URL);
}

//-----------------------------------------------valiables
$error = array(); // エラーメッセージ格納用

//-----------------------------------------------logic

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    if (isset($_COOKIE['loginId'])) {
        $userId = $_COOKIE['loginId'];
        $userPw = $_COOKIE['loginPw'];
        $kiokuFlag = 1;
    }
} else {
    $userId = $_POST['frmUserId'];
    $userPw = $_POST['frmUserPw'];
    $kiokuFlag = $_POST['frmKiokuFlag'];
    
    if ($userId == '') {
        $error[] = 'IDを入力してください。';
    }
    
    if ($userPw == '') {
        $error[] = 'パスワードを入力してください。';
    }
    
    if ($userId != '' && $userPw != '') {
        $selectParams = array(
            array(':user_id', $userId, PDO::PARAM_STR),
            array(':user_pw', $userPw, PDO::PARAM_STR)
        );
        
        $ret = $db->executeSql($userSelect, $selectParams);
        if ($ret) {
            $userData = $db->fetchAllDatabase();
            if ($userData) {
                $_SESSION['loginInfo'] = array(
                    'isLogin' => true,
                    'loginId' => $userData[0]['user_id'],
                    'loginUser' => $userData[0]['user_mei']
                );
                if (isset($_COOKIE['loginId'])) {
                    setcookie("loginId", '', time() - 1800, '/sonar_todo_app/html/login.php/');
                    setcookie("loginPw", '', time() - 1800 ,'/sonar_todo_app/html/login.php/');
                }
                if ($kiokuFlag == 1) {
                    setcookie("loginId", $userId, time()+60*60*24*14, '/sonar_todo_app/html/login.php/');
                    setcookie("loginPw", $userId, time()+60*60*24*14, '/sonar_todo_app/html/login.php/');
                }
                header('Location: ' .SITE_URL);
                exit;
            } else {
                $error[] = 'IDまたはパスワードが間違っています。';
            }
        } else {
            $error[] = 'DBエラー(ユーザの取得に失敗しました。)';
            ErrorLog::message("DBエラー(ユーザの取得に失敗しました。)");
        }
        
    }
}

//-----------------------------------------------function


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
$smarty->assign('title', "ログイン");

// 値
$smarty->assign('userId', isset($userId) ? $userId : NULL);
$smarty->assign('userPw', isset($userPw) ? $userPw : NULL);
$smarty->assign('kiokuFlag', isset($kiokuFlag) ? $kiokuFlag : NULL);

// デバッキングコンソール
// $smarty->debugging = true;

// 読み込みテンプレート
$smarty->display('login.tpl');