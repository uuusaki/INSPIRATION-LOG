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
  
  

  $try= ['test','tteessts','ttteee'];

  
  
// MySQLからデータを取得
$query = "SELECT * FROM `impression`";
if ($success) {
  $result = mysqli_query($link, $query);
  while ($row = mysqli_fetch_array($result)) {
    $BOARD[] = [$row['imp_id'], $row['impression'], $row['work_name']];
  }
}

//削除
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if  (isset($_POST['del'])) {
  //削除ボタンを押したときの処理を書く。
  $delete_query = "DELETE FROM `impression` WHERE `imp_id` = '{$_POST['del']}'";
  mysqli_query($link, $delete_query);
  header('Location: ' . $_SERVER['REQUEST_URI']);
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
     <h2>MY PAGE</h2>
     <div class="past">
       <?php
        //echo var_dump($BOARD);
       $BOARD = array_reverse($BOARD); 
       foreach ((array)$BOARD as $imps): ?>
       
         <div class="past1">
           <div class="past2">
             <h4> <?php echo $imps[1];?><br></h4>
             <p> <?php echo $imps[2];?></p>
           </div>
           <div class="input">
             <form action="editBOX.php" method="get" class="edit">
               <input type="hidden" name="edit" value="<?php $imps[0] ?>">
               <textarea name="editid" hidden><?php echo $imps[0] ?></textarea>
               <input type="submit" value="編集"　class="button2">
             </form>
           </div>
         </div>
         
          <?php endforeach; ?>
        </div>
      
  
  </div>
   <a>もっと見る</a>

  

   
 
  
  </body>
</html>
    
    
