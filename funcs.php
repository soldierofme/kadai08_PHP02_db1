<?php
//共通に使う関数を記述

//XSS対応（ echoする場所で使用！それ以外はNG ）
function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES);
}


//DBConnection
function db_conn(){

}








//DB接続
function db_conn()
{
    try {
    $db_name =  'info-deploy_test-database';            //データベース名
    $db_host =  'mysql57.info-deploy.sakura.ne.jp';  //DBホスト
    $db_id =    'info-deploy';                //アカウント名(登録しているドメイン)
    $db_pw =    'InMiKoOt0718';           //さくらサーバのパスワード

    $server_info ='mysql:dbname='.$db_name.';charset=utf8;host='.$db_host;
        $pdo = new PDO($server_info, $db_id, $db_pw);

        }
    catch (PDOException $e) {
    exit('DB Connection Error:' . $e->getMessage());
    }
}
//SQLエラー
function sql_error($stmt)
{
    //execute（SQL実行時にエラーがある場合）
    $error = $stmt->errorInfo();
    exit('SQLError:' . $error[2]);
}

?>
