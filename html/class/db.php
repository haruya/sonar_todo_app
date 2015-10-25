<?php

/**
* DBクラス
*/
class DbPdo
{
    //---------------------------------------------- field
    private $dbCon; // DBハンドラー
    private $stmt;
    
    //---------------------------------------------- function
    /**
     * コンストラクタ(クラスをnewした時に実行される)
     */
    public function __construct()
    {
        try {
            if (mb_strlen(DB_OPTION) == 0) {
                $this->dbCon = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASS);
                // $this->dbCon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // PDOエラー時に例外をスローさせ、それをtry-catch文で処理する
            } else {
                // PHP5.3.6より前のバージョンの PDO MySQL で charset を指定する場合 http://qiita.com/ngyuki/items/d88a4df860abb51eb714
                $options = array(PDO::MYSQL_ATTR_READ_DEFAULT_FILE => DB_OPTION);
                // $options = array(PDO::MYSQL_ATTR_READ_DEFAULT_FILE => '/etc/my.cnf',);
                $this->dbCon = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=,", DB_USER, DB_PASS);
                // $this->dbCon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // PDOエラー時に例外をスローさせ、それをtry-catch文で処理する
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    
    /**
     * プリペア&エクスキュート(プリペアする値がない場合は$paramsを引数に入れない)
     */
    public function executeSql($sql, $params = null)
    {
        $this->stmt = $this->dbCon->prepare($sql);
        if (!is_null($params)) {
            foreach ($params as $p) {
                $this->stmt->bindValue($p[0], $p[1], $p[2]);
            }
        }
        return $this->stmt->execute();
    }
    
    /**
     * 一行ずつ取得(単なる連想配列)
     */
    public function fetchDatabase()
    {
        $ar = array();
        $ar = $this->stmt->fetch(PDO::FETCH_ASSOC);
        return (!empty($ar) ? $ar : false);
    }
    
    /**
     * PDOStatement->fetch()を2回使用する場合は、都度「$this->stmt->closeCursor();」を行いカーソルを閉じておいた方がいい。
     * クエリを発行した後に毎回、closeCursor()メソッドを呼ぶ。
     * これを行わず、PDOStatement->fetch()を2回使用すると、エラーになる
     * 
     */
    public function closeCursor()
    {
        return $this->stmt->closeCursor();
    }
    
    /**
     * すべての結果行を含む配列を返す(配列したに連想配列となる)
     */
    public function fetchAllDatabase()
    {
        $ar = array();
        $ar = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
        return (!empty($ar) ? $ar : false);
    }
    
    /**
     * UPDATE,INSERT,DELETEで更新された行数を取得するメソッド。
     * UPDATEの場合は更新内容が更新前と同じだとrowCountは0を返してくるので要注意
     */
    public function getAffectedRowCount()
    {
        return $this->stmt->rowCount();
    }
    
    /**
     * 直近にINSERTされたデータのIDを取得する
     */
    public function getLastInsertId()
    {
        return $this->dbCon->lastInsertId();
    }
    
    /**
     * アップデートインサート
     * まずアップデートしrowCountで0の場合、更新するものがないのでない場合はインサートする
     * return される値が true 以外の場合はその戻り値をエラー用変数に代入する
     */
    public function updateInsert($updateSql, $insertSql, $params)
    {
        $ret = $this->executeSql($updateSql, $params);
        
        if ($ret) {
            if ($this->getAffectedRowCount() == 0) {
                $ret = $this->executeSql($insertSql, $params);
                if (!$ret) {
                    return "DBエラー(updateInsert関数の実行の際にinsert文でエラーが起こりました。)";
                }
            }
        } else {
            return "DBエラー(updateInsert関数の実行の際にupdate文でエラーが起こりました。)";
        }
    }
    
    /**
     * トランザクション開始
     */
    public function beginTransaction()
    {
        $this->dbCon->beginTransaction();
    }
    
    /**
     * トランザクションコミット
     */
    public function commit()
    {
        $this->dbCon->commit();
    }
    
    /**
     * トランザクションロールバック
     */
    public function rollBack()
    {
        $this->dbCon->rollBack();
    }
    
    /**
     * エラー出力
     */
    public function errorInfo()
    {
        return $this->stmt->errorInfo();
    }
    
}