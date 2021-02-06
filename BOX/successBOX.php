<?php
  $user = 'root';
  $password = 'root';
  $db = 'box';
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

  $user_id = 0000;
  $imp_id = uniqid() ; //記事ごとに被りがない文字列のIDを作成
  $impression = '';
  $work_name = '';
  $input_day = date();
  $log_day = date();
  $genre ='';
  

  $BOARD = []; 

  
// MySQLからデータを取得
$query = "SELECT * FROM `impression`";
if ($success) {
  $result = mysqli_query($link, $query);
  while ($row = mysqli_fetch_array($result)) {
    $BOARD[] = [$row['imp_id'], $row['impression'], $row['work_name'],  $row['input_day'],  $row['log_day'],  $row['genre']];
  }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (!empty($_POST['impression']) && !empty($_POST['work_name']) ) {
    //ひとことが空でない　かつ　作品名が空でない時
    
    
    //追加用のQueryを書く。
    $user_id = 1;

    $impression = $_POST['impression'];
    $work_name = $_POST['work_name'];
    $input_day = $_POST['input_day'];
    $log_day = $_POST['log_day'] ;
    $genre = $_POST['genre'];
    
    

   
    $insert_query = "INSERT INTO `impression`(`user_id`, `imp_id`, `impression`, `work_name`, `input_day`, `log_day`, `genre`)  
                                      VALUES ('$user_id', '$imp_id', '$impression', '$work_name', '$input_day', '$log_day', '$genre' )";
    //echo $insert_query;
    //exit;

    mysqli_query($link, $insert_query);
    header('Location: ' . $_SERVER['SCRIPT_NAME']);

    $BOARD1[] = [$row['imp_id'], $row['impression'], $row['work_name'],  $row['input_day'],  $row['log_day'],  $row['genre']];
    exit;
  }
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
 <title>INSPIRATION BOX</title>
    <link rel="stylesheet" href="stylesbox.css">
    <link href="https://fonts.googleapis.com/css?family=Sawarabi+Mincho" rel="stylesheet">
    <link rel="icon" type="image/png" href="images/face2.png">
 </head>
 
 <body>

 <header class="tytle"> 
   <p><a href="welcomeBOX.php"><img class="logo" src="images/logo2.png" alt="INSPIRATIONBOX"></a></p>
   <nav>
     <ul class="navi">
       <li><a href="mypageBOX.php">マイページ</a></li>
       <li><a href="indexBOX.php">記録する</a></li>
     </ul> 
   </nav>
 </header>
 <div class="contentsIndex">
   <div class="success">
     <h3 class="logged">記録しました！</h3>
     <img src="images/mado2.png" class="mado" >
   </div>
   <!--<div><p>※記録内容の表示
    <?php 
      
      //$BOARD = array_reverse($BOARD);
      
      
    ?></p></div>!-->

   <div class="under">
     <a href="mypageBOX.php">マイページへ</a>
     <a href="indexBOX.php">もっと記録する</a>
   </div>
 </div>
  
  </body>
</html>
    
    
