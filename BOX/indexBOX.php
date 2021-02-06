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

  $user_id = 1;
  $imp_id = uniqid() ; //記事ごとに被りがない文字列のIDを作成
  $impression = '';
  $work_name = '';
  $input_day = date();
  $log_day = date();
  $genre ='';
  
  $error = "";
  

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
     $again= '';
     $mood= '';
     $memo= '';
     $evaluation= '';

    
     $insert_query = "INSERT INTO `impression`(`user_id`, `imp_id`, `impression`, `work_name`, `input_day`, `log_day`, `genre`)  VALUES ('$user_id', '$imp_id', '$impression', '$work_name', '$input_day', '$log_day', '$genre' )";
     mysqli_query($link, $insert_query);
     header('Location: ' . $_SERVER['SCRIPT_NAME']);
     exit;

    }elseif(empty($_POST['impression']) && empty($_POST['work_name'])){
     //post"title"が空の時 かつ　post"article"が空の時

     $error = 'ひとことと作品名を入力してください';
     //'error'に代入

    }elseif(!empty($_POST['impression']) && empty($_POST['work_name'])){
     //post"title"が空でない、"article"が空
  
     $error = '作品名を入力してください';
     //'error'に代入

    }elseif(empty($_POST['impresion']) && !empty($_POST['work_name'])){
     //post"title"が空、"article"が空でないのとき

     $error = 'ひとことを入力してください';
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
   <form method="post" action="successBOX.php" autcomplete="off">  
    <div class="base">
       <div class="base01">
         <label for="imp">INSPIRATION</label><br>
         <textarea name="impression" id="imp" rows="3" cols="40" required ></textarea> 
       </div>
       <div class="base02">
         <label for="wn">作品名</label>
         <input type="text" id="wn" name="work_name" required>
         <br>
         <p><?php echo "$error"?></p>
       </div>  
       <div class="base03">
         <label for="id">鑑賞日</label>
         <input type="date" id ="id" name="input_day"　value="<?php date_default_timezone_set('Asia/Tokyo');
                echo date("Y/m/d ")?>" >

         <input type="hidden" name="log_day" 
          value="<?php date_default_timezone_set('Asia/Tokyo');
                echo date("Y/m/d ")?>">
       </div>
       <div class="genre">
          <p>ジャンル</p>
          <ul>
             <li><input type="radio" id="g0" name="genre" value="0" class="genre1">
             <label for="g0" class="genre2">映画</lavel>
             <li><input type="radio" id="g1" name="genre" value="1" class="genre1">
              <label for="g1" class="genre2">ドラマ</lavel>
             <li><input type="radio" id="g2" name="genre" value="2" class="genre1">
              <label for="g2" class="genre2">アニメ</lavel>
             <li><input type="radio" id="g3" name="genre" value="3" class="genre1">
              <label for="g3" class="genre2">舞台</lavel>
             <li><input type="radio" id="g4" name="genre" value="4" class="genre1">
              <label for="g4" class="genre2">バラエティ</lavel><br>
            
              <li><input type="radio" id="g5" name="genre" value="5" class="genre1">
              <label for="g5" class="genre2">小説</lavel>
             <li><input type="radio" id="g6" name="genre" value="6" class="genre1">
              <label for="g6" class="genre2">漫画</lavel>
             <li><input type="radio" id="g7" name="genre" value="7" class="genre1">
              <label for="g7" class="genre2">アート</lavel>
             <li><input type="radio" id="g8" name="genre" value="8" class="genre1">
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
         <input type="submit" value="記録!" class="button">
     </div>
   </div>  

   </form>
 </div> 
 
   
 
  
  </body>
</html>
    
    
