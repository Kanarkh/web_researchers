<?php
                session_start();
                $connect = mysqli_connect('localhost', 'root', 'lunatic8911', 'researchers') or die("fail");
                $roomnum = $_POST['roomnum']; 
                $nickname = $_SESSION['nickname'];

                $query = " select * from chat where roomnum=$roomnum";
                $result = $connect->query($query);

while($rows = mysqli_fetch_assoc($result)){
if($nickname == $rows['nickname']){
?>
  <div style="color:green" class="item"><?=$rows['nickname']?> : <?=$rows['content']?></div>
<?php
}else{
?>
  <div class="item"><?=$rows['nickname']?> : <?=$rows['content']?></div>
<?php
}}
?>

(@)&)( 

<!-- 여기부터는 참가자 닉네임 관련해서 처리 -->
<?php
$query1 = "select * from cheatingroom where number =$roomnum";
$result1 = $connect->query($query1);
$row = mysqli_fetch_assoc($result1);

                  $userlist = explode('//',$row['userlist']);
                  //배열의 크기 확인
                  $cnt = count($userlist); 
                  for($i=0;$i<($cnt-1);$i++){
                      if($userlist[$i]!=""){
                      ?>
                      <div class="item"><?=$userlist[$i]?></div>
                      <?php
                      // $queryn = "update qnaanswer set nolink=0 where nickname='$userlist[$i]' and roomnum=$roomnum";
                      // $resultn = $connect->query($queryn);
                      }
                  }
      ?>

<!-- 여기부터 접속확인 -->
<?php
  // $query2 = " select * from checkroom where roomnum=$roomnum";
  // $result2 = $connect->query($query2);
  
  // while($rows2 = mysqli_fetch_assoc($result2)){
    
  // }
?>