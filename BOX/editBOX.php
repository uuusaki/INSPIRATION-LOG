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

  //$user_id = 0000;
  //$imp_id = uniqid() ; //記事ごとに被りがない文字列のIDを作成
  //$impression = '';
  //$work_name = '';
  //$input_day = date();
  //$log_day = date();
  //$genre ='';

  $edit_BOARD = [];

  $getid = '' ;//パラメータ経由で取得したID

  $getid = $_GET["editid"]; 
  //パラメータから送られた記事IDを取得
  $user_id = 1;
 
  $E_impression = '';
  $E_work_name = '';
  $E_input_day = date();
  $E_log_day = date();
  $E_genre ='';
  

  
  
// MySQLからデータを取得
$query = "SELECT * FROM `impression` WHERE imp_id = '$getid' " ;
  if ($success) {
    $result = mysqli_query($link, $query);
    while ($row = mysqli_fetch_array($result)) {
      $edit_BOARD[] = [$row['imp_id'], $row['impression'], $row['work_name'],$row['input_day'], $row['log_day'], $row['genre']];
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
    <style>
      <?php
        if ($E_genre=0)
        {$Cgenre0= "checked";}
        else if ($E_genre=1)
        {$Cgenre1= "checked";}
        else if ($E_genre=2)
        {$Cgenre2= "checked";}
        else if ($E_genre=3)
        {$Cgenre3= "checked";}
        else if ($E_genre=4)
        {$Cgenre4= "checked";}
        else if ($E_genre=5)
        {$Cgenre5= "checked";}
        else if ($E_genre=6)
        {$Cgenre6= "checked";}
        else if ($E_genre=7)
        {$Cgenre7= "checked";}
        else if ($E_genre=8)
        {$Cgenre8= "checked";
        exit;}

      ?>
    </style>
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
   <form method="post" action="successBOX.php">  
    <div class="base">
      <h2>編集</h2>
      <p><?php echo $getid ;
          foreach ((array)$edit_BOARD as $edits){
           if("$getid" == "$edits[0]"){
             $E_impression = $edits[1];
             $E_work_name = $edits[2];
             $E_input_day = $edits[3];
             $E_log_day = $edits[4];
             $E_genre = $edits[5];
            }
          }
          //echo var_dump($edit_BOARD);
          echo $E_impression;
          echo $E_work_name;
          echo $E_input_day;
          echo $E_log_day ;
          echo $E_genre ;
            ?></p>
       
       
   <form method="post" action="successBOX.php">  
    <div class="base">
       <div class="base01">
         <label for="imp">INSPIRATION</label><br>
         <textarea name="impression" id="imp" rows="3" cols="40" required ><?php echo $E_impression?></textarea> 
       </div>
       <div class="base02">
         <label for="wn">作品名</label>
         <input type="text" id="wn" name="work_name" required value="<?php echo $E_work_name?>">
         <br>
         <p><?php echo "$error"?></p>
       </div>  
       <div class="base03">
         <label for="id">鑑賞日</label>
         <input type="date" id ="id" name="input_day"　value="<?php $E_input_day?>" >

         <input type="hidden" name="log_day" 
          value="<?php $E_log_day?>">
       </div>
       <div class="genre">
          <p>ジャンル</p>
          <ul>
             <li><input type="radio" id="g0" name="genre" value="0" class="genre1" <?php echo $Cgenre0; ?>>
             <label for="g0" class="genre2">映画</lavel>
             <li><input type="radio" id="g1" name="genre" value="1" class="genre1" <?php echo $Cgenre1; ?>>
              <label for="g1" class="genre2">ドラマ</lavel>
             <li><input type="radio" id="g2" name="genre" value="2" class="genre1" <?php echo $Cgenre2; ?>>
              <label for="g2" class="genre2">アニメ</lavel>
             <li><input type="radio" id="g3" name="genre" value="3" class="genre1" <?php echo $Cgenre3; ?>>
              <label for="g3" class="genre2">舞台</lavel>
             <li><input type="radio" id="g4" name="genre" value="4" class="genre1" <?php echo $Cgenre4; ?>>
              <label for="g4" class="genre2">バラエティ</lavel><br>
            
              <li><input type="radio" id="g5" name="genre" value="5" class="genre1 "<?php echo $Cgenre5; ?>>
              <label for="g5" class="genre2">小説</lavel>
             <li><input type="radio" id="g6" name="genre" value="6" class="genre1" <?php echo $Cgenre6; ?>>
              <label for="g6" class="genre2">漫画</lavel>
             <li><input type="radio" id="g7" name="genre" value="7" class="genre1" <?php echo $Cgenre7; ?>>
              <label for="g7" class="genre2">アート</lavel>
             <li><input type="radio" id="g8" name="genre" value="8" class="genre1" <?php echo $Cgenre8; ?>>
              <label for="g8" class="genre2">その他</lavel><br>
           
            </ul>
       </div>
     </div>
     <!--<a href="detailBOX.php" class="detiel">詳しく記録する！</a>--!-->
     <div class="more">
       <label for="lavel1" class="accordion1">詳しく記録<lavel>
       <input type="checkbox" id="lavel1" class="accordion"/>
       
       <div class="morecontents">
         <p class="again"> また見たい？</p>
         <ul>
          <li><input type="radio" id="a1" name="again" value="1" class="again1">
           <label for="a1" class="again2">何度でも見たい！</lavel>
          <li><input type="radio" id="a2" name="again" value="2" class="again1">
           <label for="a2" class="again2">忘れたころに見たい</lavel>
          <li><input type="radio" id="a3" name="again" value="3" class="again1">
           <label for="a3" class="again2">もういいかな</lavel>
          <li><input type="radio" id="a4" name="again" value="4" class="again1">
           <label for="a4" class="again2">二度と見ない</lavel>
         </ul>
         <!-- 
         <p>どんな気分になる？</p>
          <input type="checkbox" id="" name="mood" value="10">
          <lavel for="">笑いたい</lavel>
          <input type="checkbox" id="" name="mood" value="11">
          <lavel for="">泣きたい</lavel>
          <input type="checkbox" id="" name="mood" value="12">
          <lavel for="">キュンキュンしたい</lavel>
          <input type="checkbox" id="" name="mood" value="13">
          <lavel for="">ほのぼのしたい</lavel><br>
          <input type="checkbox" id="" name="genre" value="14">
          <lavel for="">知らないことを知りたい</lavel>
          <input type="checkbox" id="" name="genre" value="15">
          <lavel for="">冒険したい</lavel>
          <input type="checkbox" id="" name="genre" value="16">
          <lavel for="">ゾクゾクしたい</lavel>
          <input type="checkbox" id="" name="genre" value="17">
          <lavel for="">目の保養</lavel>
          <input type="checkbox" id="" name="genre" value="18">
          <lavel for="">言葉では表せない感覚</lavel>
          
          <br>-->
         

         <label for="my">My評価</label>
         <p><em><!--&#x1f643;-->☹<input type="range" id="my" min="1" max="5"><!--&#x1f604;-->☺</em></p>
     
         <label for="memo">メモ</label><br>
          <textarea id="memo" value="memo" cols="40"></textarea>　　     
       </div>
     </div>

     <div class="submit">
         <input type="submit" value="編集して記録!" class="button">
     </div>
   </div>  
   
   </form>
   <form method="post" action="mypageBOX.php" class="submit">
     <input type="hidden" name="del" value="<?php echo $getid ?>">
     <input type="submit" onclick="alert('削除しますか？')" value="削除" class="button">
   </form>
 </div> 
 
   
  </body>
</html>
    
    
