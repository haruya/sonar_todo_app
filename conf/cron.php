<?php
//-----------------------------------------------define
require_once('config.php');

// ■指定した日より前のDBバックアップファイルは削除
$dirPath = DB_BACKUP_PATH;
$expire = strtotime("-2 weeks");
deleteFiles($dirPath, $expire);
echo 'DBパックアップ削除完了<br />';

// ■DBバックアップ
$dirPath = DB_BACKUP_PATH;
$fileName = date('Ymd') . '_' . date('His') . DB_NAME . '.sql';
dbBackup(DB_HOST, DB_USER, DB_PASS, DB_NAME, $dirPath, $fileName);
echo 'DBバックアップ完了<br />';

//-----------------------------------------------function

/**
 * ■ファイル削除関数
 * $dirPath : ディレクトリパス
 * $expire : 削除期限
 */
function deleteFiles($dirPath, $expire)
{
    $list = scandir($dirPath); // フォルダ内のファイル一覧取得
    foreach ($list as $value) {
        $file = $dirPath . $value; // ファイル名にパスを付ける
        if (!is_file($file)) continue; // ファイルの存在確認をしなかったらcontinue(. .. ← をcontinue)
        $mod = filemtime($file); // 指定したファイルの更新時刻をUNIXタイムスタンプ値で返す
        if ($mod < $expire) { // ファイルの更新時刻が指定した日より前の日のファイルは削除
            unlink($file);
        }
    }
}

/**
 * ■DBバックアップ関数
 * $dbHost : ホスト名
 * $dbUser : ユーザ名
 * $dbPass : パスワード
 * $dirPath : DBのバックアップ先のディレクトリパス
 * $fileName : バックアップファイル名
 */
function dbBackup($dbHost, $dbUser, $dbPass, $dbName, $dirPath, $fileName)
{
    // mysqlダンプ（指定の場所にバックアップ）
    $command = "mysqldump " . $dbName . " --host=" . $dbHost . " --user=" . $dbUser . " --password=" . $dbPass. " > " .$dirPath . $fileName;
    // 外部コマンドを実行する関数「system」
    system($command);
}
