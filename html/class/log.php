<?php
// エラーログ取得用静的クラス($message,$level)
// $message … メッセージ
// $level … 警告レベル。1:注意、2:警告、3:エラー。(3のエラーは省略可。)
// ログファイルのパスはconfig.phpのLOG_FOLDER_PATHを参照
/******************************************************
静的メソッドになっているので、この機能を使用する際は、
ErrorLog::message("記述したエラーメッセージ", エラーレベル1or2or3[3は省略可]);
としてやればよい。
※static キーワードを指定することで静的なプロパティ/メソッドが定義できます。
　静的なプロパティ/メソッドはオブジェクトを生成せずに呼び出します
　静的なプロパティ/メソッドにはそれぞれ「クラス名::プロパティ名」「クラス名::メソッド名」の形式でアクセスします。
******************************************************/
class ErrorLog
{
    public static function message($message, $level=3)
    {
        // ファイル内容作成。(日時  エラーレベル  メッセージ)
        
        // 日付
        $data = date('Y/m/d H:i:s'). "\t";
        
        // レベル
        if ($level == 1) {
            $data .= "[注意]\t";
        } else if ($level == 2) {
            $data .= "[警告]\t";
        } else {
            $data .= "[エラー]\t";
        }
        
        // メッセージ
        $data .= $message;
        
        // ログファイル名指定。日付.log
        $logFile = date('Ymd').".log";
        // ファイルを追記型書き込み。ファイルがない場合は新規作成。
        // 「LOCK_EX」を指定するだけでロック→書き込み→ロック開放を一気にやってくれる。
        // PHP5.2.5以前はfile_put_contents()の排他ロックにバグがあるようですのでご注意ください。
        file_put_contents(LOG_FOLDER_PATH . $logFile, $data ."\n", FILE_APPEND | LOCK_EX);
    }
}

/******************************************************PHP5.2.5以前のい場合のファイルの処理
// ファイルを追記型書き込み(a)。ファイルがない場合は新規作成。
$file = fopen(LOG_FOLDER_PATH . $logFile, 'a');
// ファイルロック
flock($file, LOCK_EX);
// ファイルに書き込み + 改行
fwrite($file, $data ."\n");
// ファイルのロックを解除する。
fflush($file);
flock($file, LOCK_UN);
// ファイルクローズ
fclose($file);
kuribayashisumire
******************************************************/
