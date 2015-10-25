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
    $taskId = $_GET['task_id'];
    $projectId = $_GET['project_id'];
    // 変更対象タスク取得
    $selectParams = array(
        array(':task_id', $taskId, PDO::PARAM_INT),
        array(':project_id', $projectId, PDO::PARAM_INT)
    );
    
    $ret = $db->executeSql($editTaskSelect, $selectParams);
    if ($ret) {
        $editTask = $db->fetchAllDatabase();
    } else {
        $editTask = FALSE;
        ErrorLog::message("DBエラー(変更対象タスクの取得に失敗しました。)");
    }
    
    if (!preg_match('/^[1-9][0-9]*$/', $taskId) || !preg_match('/^[1-9][0-9]*$/', $projectId) || $editTask === FALSE) {
        echo "不正なアクセスです。";exit;
    }
    $projectMei = $editTask[0]['project_mei'];
    $gaiyo = $editTask[0]['gaiyo'];
    $naiyo = $editTask[0]['naiyo'];
    $biko = $editTask[0]['biko'];
    $yusenDo = $editTask[0]['yusen_do'];
    $sagyoSha = $editTask[0]['sagyo_sha'];
    $startDate = $editTask[0]['start_date'];
    $completeDate = $editTask[0]['complete_date'];
} else {
    $sagyoSha = $_POST['frmSagyoSha'];
    $yusenDo = $_POST['frmYusenDo'];
    $gaiyo = $_POST['frmGaiyo'];
    $naiyo = $_POST['frmNaiyo'];
    $biko = $_POST['frmBiko'];
    $startDate = $_POST['frmStartDate'];
    $completeDate = $_POST['frmCompleteDate'];
    $taskId = $_POST['frmTaskId'];
    $projectId = $_POST['frmProjectId'];
    $projectMei = $_POST['frmProjectMei'];
    
    // エラーチェック
    if ($sagyoSha != '' && mb_strlen($sagyoSha, "UTF-8") > 32) {
        $error[] = '「作業者」は32文字以内で入力してください。';
    }
    
    if ($gaiyo == '') {
        $error[] = '「概要」は入力必須です。';
    } elseif ($gaiyo != '' && mb_strlen($gaiyo, "UTF-8") > 32) {
        $error[] = '「概要」は32文字以内で入力してください。';
    }
    
    // ↓「数値4桁」-「数値2桁」-「数値2桁」(2012-01-01)の書式の判別
    if ($startDate != '' && !preg_match('/^([1-9][0-9]{3})\-(0[1-9]{1}|1[0-2]{1})\-(0[1-9]{1}|[1-2]{1}[0-9]{1}|3[0-1]{1})$/', $startDate)) {
        $error[] = '「作業開始日」を正しい形式で入力してください。';
    } elseif ($startDate != '') {
        // 正しい日付かチェック
        $year = mb_substr($startDate, 0, 4);
        $month = mb_substr($startDate, 5, 2);
        $day = mb_substr($startDate, -2, 2);
        $checkStartDate = checkdate((int)$month, (int)$day, (int)$year);
        if ($checkStartDate === FALSE) {
            $error[] = '「作業開始日を正しい日付で入力してください。';
        }
    }
    
    if ($completeDate != '' && !preg_match('/^([1-9][0-9]{3})\-(0[1-9]{1}|1[0-2]{1})\-(0[1-9]{1}|[1-2]{1}[0-9]{1}|3[0-1]{1})$/', $completeDate)) {
        $error[] = '「作業完了日」を正しい形式で入力してください。';
    } elseif ($completeDate != '') {
        // 正しい日付かチェック
        $year = mb_substr($completeDate, 0, 4);
        $month = mb_substr($completeDate, 5, 2);
        $day = mb_substr($completeDate, -2, 2);
        $checkCompleteDate = checkdate((int)$month, (int)$day, (int)$year);
        if ($checkCompleteDate === FALSE) {
            $error[] = '「作業完了日」を正しい日付で入力してください。';
        }
    }
    
    if (empty($error)) {
        $db->beginTransaction();
        $updateParams = array(
            array(':gaiyo', $gaiyo, PDO::PARAM_STR),
            array(':naiyo', $naiyo !== '' ? $naiyo : NULL, PDO::PARAM_STR),
            array(':biko', $biko !== '' ? $biko : NULL, PDO::PARAM_STR),
            array(':yusen_do', $yusenDo, PDO::PARAM_INT),
            array(':sagyo_sha', $sagyoSha !== '' ? $sagyoSha : NULL, PDO::PARAM_STR),
            array(':start_date', $startDate !== '' ? $startDate : NULL, PDO::PARAM_STR),
            array(':complete_date', $completeDate !== '' ? $completeDate : NULL, PDO::PARAM_STR),
            array(':project_id', $projectId, PDO::PARAM_INT),
            array(':task_id', $taskId, PDO::PARAM_INT)
        );
        $ret = $db->executeSql($taskUpdate, $updateParams);
        if ($ret) {
            $db->commit();
            $message = "タスクを変更しました。";
        } else {
            $db->rollback();
            $error[] = 'DBエラー(タスク変更に失敗しました。)';
            ErrorLog::message("DBエラー(タスク変更に失敗しました。)");
        }
    }
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

// メッセージ
$smarty->assign('message', isset($message) ? $message : NULL);

// title
$smarty->assign('title', "タスク変更");

// 値
$smarty->assign('loginInfo', $_SESSION['loginInfo']); // ログインセッションの値
$smarty->assign('taskId', $taskId); // タスクID
$smarty->assign('projectId', $projectId); // プロジェクトID
$smarty->assign('projectMei', $projectMei); // プロジェクト名
$smarty->assign('gaiyo', $gaiyo); // 概要
$smarty->assign('naiyo', $naiyo); // 内容
$smarty->assign('biko', $biko); // 備考
$smarty->assign('yusenDo', $yusenDo); // 優先度
$smarty->assign('sagyoSha', $sagyoSha); // 作業者
$smarty->assign('startDate', $startDate); // 作業開始日
$smarty->assign('completeDate', $completeDate); // 作業完了日

// デバッキングコンソール
// $smarty->debugging = true;

// 読み込みテンプレート
$smarty->display('editTask.tpl');