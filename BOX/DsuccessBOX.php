<?php
  $user = 'root';
  $password = 'root';
  $db = 'laravelnews'; //データベース名
  $host = 'localhost';
  $port = 3306;
  $link = mysqli_init();
  $success = mysqli_real_connect(
    $link, 
    $host, 
    $user, 
    $password, 
    $db,
    $port
  );

  $title = '';
  $article = '';
  $id = uniqid() ; //記事ごとに被りがない文字列のIDを作成
  $DATA = []; //一回分の情報を入れる配列
  $BOARD = []; //すべての投稿の情報を入れる配列
  $error = "";
  
// MySQLからデータを取得
$query = "SELECT * FROM `date`";
if ($success) {
  $result = mysqli_query($link, $query);
  while ($row = mysqli_fetch_array($result)) {
    $BOARD[] = [$row['id'], $row['title'], $row['article']];
  }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (!empty($_POST['title']) && !empty($_POST['article']) ) {
    //タイトルがからでない　かつ　アーティクルが空でない時

    //名前の追加用のQueryを書く。
    $title = $_POST['title'];
    $article = $_POST['article'];

    $DATA = [$id, $title, $text];

    $insert_query = "INSERT INTO `date`(`id`, `title`, `article`) VALUES ('$id','$title','$article')";
    mysqli_query($link, $insert_query);
    header('Location: ' . $_SERVER['SCRIPT_NAME']);
    exit;

  }else if (isset($_POST['del'])) {
    //削除ボタンを押したときの処理を書く。
    $delete_query = "DELETE FROM `date` WHERE `id` = '{$_POST['del']}'";
    mysqli_query($link, $delete_query);
    header('Location: ' . $_SERVER['SCRIPT_NAME']);
    exit;
  }elseif(empty($_POST['title']) && empty($_POST['article'])){
    //post"title"が空の時 かつ　post"article"が空の時

    $error = 'タイトルと記事を入力してください';
    //'error'に代入

  }elseif(!empty($_POST['title']) && empty($_POST['article'])){
    //post"title"が空でない、"article"が空
  
    $error = '記事を入力してください';
    //'error'に代入

  }elseif(empty($_POST['title']) && !empty($_POST['article'])){
    //post"title"が空、"article"が空でないのとき

    $error = 'タイトルを入力してください';
  } 
}
?>

<!DOCTYPE html>
<html lang="ja">
 <head>
    <meta charset="utf-8" />
    <title>ひとこと感想まとめ</title>
    <link rel="stylesheet" href="stylesmysql.css">
 </head>
 
 <body>

 <a href="mypageBOX.php">ひとこと感想BOX</a>

   <h3>詳しく記録しました！</h3>

   <div><p>※記録内容の表示</p></div>

   <a href="mypage.php">マイページへ</a>
   <a href="indexBOX.php">もっと記録する</a>
   

   
 
  
  </body>
</html>
    
    
