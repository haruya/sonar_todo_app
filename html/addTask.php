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
    $projectMei = $targetProject[0]['project_mei'];
} else {
    $sagyoSha = $_POST['frmSagyoSha'];
    $yusenDo = $_POST['frmYusenDo'];
    $gaiyo = $_POST['frmGaiyo'];
    $naiyo = $_POST['frmNaiyo'];
    $biko = $_POST['frmBiko'];
    $startDate = $_POST['frmStartDate'];
    $completeDate = $_POST['frmCompleteDate'];
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
        // タスクの並び順の最後の値を取得
        $selectParams = array(
            array(':project_id', $projectId, PDO::PARAM_INT)
        );
        $ret = $db->executeSql($taskMaxSeqSelect, $selectParams);
        if ($ret) {
            $taskMaxSeq = $db->fetchAllDatabase();
            if ($taskMaxSeq[0]['maxSeq'] != NULL) {
                $seq = $taskMaxSeq[0]['maxSeq'];
            } else {
                $seq = 0;
            }
            $db->beginTransaction();
            $insertParams = array(
                array(':project_id', $projectId, PDO::PARAM_INT),
                array(':gaiyo', $gaiyo, PDO::PARAM_STR),
                array(':naiyo', $naiyo !== '' ? $naiyo : NULL, PDO::PARAM_STR),
                array(':biko', $biko !== '' ? $biko : NULL, PDO::PARAM_STR),
                array(':seq', $seq, PDO::PARAM_INT),
                array(':yusen_do', $yusenDo, PDO::PARAM_INT),
                array(':sagyo_sha', $sagyoSha !== '' ? $sagyoSha : NULL, PDO::PARAM_STR),
                array(':start_date', $startDate !== '' ? $startDate : NULL, PDO::PARAM_STR),
                array(':complete_date', $completeDate !== '' ? $completeDate : NULL, PDO::PARAM_STR)
            );
            $ret = $db->executeSql($taskInsert, $insertParams);
            if ($ret) {
                $db->commit();
                $message = "タスクを新規追加しました。";
            } else {
                $db->rollback();
                $error[] = 'DBエラー(タスク追加に失敗しました。)';
                ErrorLog::message("DBエラー(タスク追加に失敗しました。)");
            }
        } else {
            $error[] = 'DBエラー(タスクの並び順の最後の値の取得に失敗しました。)';
            ErrorLog::message("DBエラー(タスクの並び順の最後の値の取得に失敗しました。)");
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
$smarty->assign('title', "タスク新規追加");

// 値
$smarty->assign('loginInfo', $_SESSION['loginInfo']); // ログインセッションの値
$smarty->assign('sagyoSha', isset($sagyoSha) ? $sagyoSha : NULL); // 作業者
$smarty->assign('yusenDo', isset($yusenDo) ? $yusenDo : NULL); // 優先度
$smarty->assign('gaiyo', isset($gaiyo) ? $gaiyo : NULL); // 概要
$smarty->assign('naiyo', isset($naiyo) ? $naiyo : NULL); // 内容
$smarty->assign('biko', isset($biko) ? $biko : NULL); // 備考
$smarty->assign('startDate', isset($startDate) ? $startDate : NULL); // 作業開始日
$smarty->assign('completeDate', isset($completeDate) ? $completeDate : NULL); // 作業完了日
$smarty->assign('projectId', $projectId); // プロジェクトID
$smarty->assign('projectMei', $projectMei); // プロジェクト名

// デバッキングコンソール
// $smarty->debugging = true;

// 読み込みテンプレート
$smarty->display('addTask.tpl');