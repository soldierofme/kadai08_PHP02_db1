<?php
//1. POSTデータ取得
//[name,email,age,naiyou]
$name = $_POST["name"];
$email = $_POST["email"];
$age = $_POST["age"];
$naiyou = $_POST["naiyou"];

//2. DB接続します
try {
  $db_name =  'info-deploy_gs_db';            //データベース名
  $db_host =  'mysql57.info-deploy.sakura.ne.jp';  //DBホスト
  $db_id =    'info-deploy';                //アカウント名(登録しているドメイン)
  $db_pw =    'InMiKoOt0718';           //さくらサーバのパスワード
  //$db_name =  'gs_db';            //データベース名
  //$db_host =  'my-ada-kadai-db';  //DBホスト(コンテナ名またはサービス名、docker-compose.yml参照のこと)
  //$db_id =    'root';                //dbで設定したユーザ
  //$db_pw =    'rootpassword';           //dbで設定したパスワード

  $server_info = 'mysql:dbname=' . $db_name . ';charset=utf8mb4;host=' . $db_host;
  //Password:MAMP='root',XAMPP=''
  $pdo = new PDO($server_info, $db_id, $db_pw);
} catch (PDOException $e) {
  exit('DB_CONECT:' . $e->getMessage());
}


//３．データ登録SQL作成

$sql = "INSERT INTO gs_an_table(name, email, age, naiyou, indate) VALUES (:name,:email,:age,:naiyou,sysdate());
";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':email', $email, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':age', $age, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':naiyou', $naiyou, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//４．データ登録処理後
if ($status == false) {
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("SQL_ERROR:" . $error[2]);
} else {
  //５．index.phpへリダイレクト
  header("Location: index.php");
  exit();
}
