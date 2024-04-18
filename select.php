<?php
//1.  DB接続します
try {
  //Password:MAMP="root",XAMPP=""
  $pdo = new PDO("mysql:dbname=info-deploy_gs_db;charset=utf8mb4;host=mysql57.info-deploy.sakura.ne.jp", "info-deploy", "InMiKoOt0718");
  //$pdo = new PDO("mysql:dbname=gs_db;charset=utf8mb4;host=db", "root", "rootpassword");
} catch (PDOException $e) {
  exit("DB_CONECT:" . $e->getMessage());
}

//２．データ登録SQL作成
$sql = "SELECT * FROM gs_an_table";
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

//３．データ表示
$values = "";
if ($status == false) {
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("SQLError:" . $error[2]);
}

//全データ取得
$values =  $stmt->fetchAll(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC[カラム名のみで取得できるモード]
//JSONい値を渡す場合に使う
// $json = json_encode($values,JSON_UNESCAPED_UNICODE);

?>


<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>フリーアンケート表示</title>
  <link rel="stylesheet" href="css/range.css">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>
    div {
      padding: 10px;
      font-size: 16px;
    }

    td {
      border: 1px solid red;
    }
  </style>
</head>

<body id="main">
  <!-- Head[Start] -->
  <header>
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="index.php">データ登録</a>
        </div>
      </div>
    </nav>
  </header>
  <!-- Head[End] -->


  <!-- Main[Start] -->
  <div>
    <div class="container jumbotron">
      <table>
        <?php foreach ($values as $v) { ?>
          <tr>
            <td>ID:<?= $v["id"] ?></td>
            <td>名前:<?= $v["name"] ?></td>
            <td>Eメール:<?= $v["email"] ?></td>
            <td>年齢:<?= $v["age"] ?></td>
            <td>詳細:<?= $v["naiyou"] ?></td>
            <td>詳細:<?= $v["naiyou"] ?></td>
            <td>時間:<?= $v["indate"] ?></td>
          </tr>
        <?php } ?>
      </table>
    </div>
  </div>
  <!-- Main[End] -->


  <script>
    //JSON受け取り


    // $a='<?= $json ?>';
    // const a = "<?php echo $json; ?>";
    // console.log(JSON.parse(a));
  </script>
</body>

</html>
