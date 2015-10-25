<?php

/**
* サイト全体の設定
*/
//-------------------------------------------------
$siteNo = 2;
// phpmyadmin → admin.tool.ichi.com/phpmyadmin
if ($siteNo == 0) { //------------------------------------------------------------ myServer(centos6)
    ini_set('include_path', '/var/website/Smarty-3.1.21/libs/');
    define('SESSION_NAME', 'sonar_todo_app0');
    define('BASE_HREF', 'http://dev.sonar_todo_app.com/');
    define('SITE_URL', 'http://dev.sonar_todo_app.com/html/');
    define('SITE_PATH', '/var/website/ichikawa_study/sonar_todo_app/');
    define('DB_HOST', '192.168.1.12');
    define('DB_PORT', 3306);
    define('DB_USER', 'ichikawa');
    define('DB_PASS', 'ichikawa');
    define('DB_NAME', 'sonar_todo_app');
    define('DB_OPTION', '');
    define('DB_BACKUP_PATH', '/var/website/ichikawa_study/sonar_todo_app/backup/db/');
    define('LOG_FOLDER_PATH', '/var/website/ichikawa_study/sonar_todo_app/log/');
    define('DEVELOP_MODE', 1); // 0: セッション非表示　1: セッション表示
    ini_set('display_errors', 1);
} else if ($siteNo == 1) { //------------------------------------------------------------ myServer(xampp)
    define('SESSION_NAME', 'sonar_todo_app1');
    define('BASE_HREF', 'http://localhost/sonar_todo_app/');
    define('SITE_URL', 'http://localhost/sonar_todo_app/html/');
    define('SITE_PATH', 'C:/pleiades/xampp/htdocs/sonar_todo_app/');
    define('DB_HOST', 'localhost');
    define('DB_PORT', 3306);
    define('DB_USER', 'root');
    define('DB_PASS', '');
    define('DB_NAME', 'sonar_todo_app');
    define('DB_OPTION', '');
    define('DB_BACKUP_PATH', 'C:/pleiades/xampp/htdocs/sonar_todo_app/backup/db/');
    define('LOG_FOLDER_PATH', 'C:/pleiades/xampp/htdocs/sonar_todo_app/log/');
    define('DEVELOP_MODE', 1); // 0: セッション非表示　1: セッション表示
    ini_set('display_errors', 1);
} else if ($siteNo == 2) {
    ini_set('include_path', 'C:/pleiades/xampp/htdocs/Smarty-3.1.21/libs/');
    define('SESSION_NAME', 'sonar_todo_app2');
    define('BASE_HREF', 'http://localhost/sonar_todo_app/');
    define('SITE_URL', 'http://localhost/sonar_todo_app/html/');
    define('SITE_PATH', 'C:/pleiades/xampp/htdocs/sonar_todo_app/');
    define('DB_HOST', 'localhost');
    define('DB_PORT', 3306);
    define('DB_USER', 'root');
    define('DB_PASS', 'ichikawa');
    define('DB_NAME', 'sonar_todo_app');
    define('DB_OPTION', '');
    define('DB_BACKUP_PATH', 'C:/pleiades/xampp/htdocs/sonar_todo_app/backup/db/');
    define('LOG_FOLDER_PATH', 'C:/pleiades/xampp/htdocs/sonar_todo_app/log/');
    define('DEVELOP_MODE', 1); // 0: セッション非表示　1: セッション表示
    ini_set('display_errors', 1);
}
