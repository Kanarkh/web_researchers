<?php 
// qnaboard 와 qnaanswer를 join하여 현재 접속한 유저가 단 질문에 답장이 달린거 가져오기
$email = $_SESSION['useremail'];

$connect = mysqli_connect('localhost', 'root', 'lunatic8911', 'researchers') or die ("connect fail");
$query ="SELECT qnaboard.number as Qnumber, qnaboard.title as Qtitle, qnaanswer.content as Acontent, qnaanswer.date as Adate, qnaanswer.time as Atime FROM qnaanswer join qnaboard on qnaanswer.qnanumber = qnaboard.number where qnaboard.email ='$email' and qnaanswer.readingstatus = 0 ORDER BY qnaanswer.number DESC";

$result = $connect->query($query);
$total = mysqli_num_rows($result);

?>
<!-- start container -->
<div class="ui container" style="padding:20px">
<h3 align=center>내 알림함</h3>
<?php

if($total==0){
?>
새로운 알림이 없습니다.
<?php
}else{
  ?>
<!-- start ui relaxed divided list -->
<div class="ui relaxed divided list" style="padding:20px">
<?php
//substr($rows['Qtitle'],0,23)
while($rows = mysqli_fetch_assoc($result)){
?>

  <div class="item">
    <i class="large question circle outline icon"></i>
    <div class="content">
      <a class="header" href ="index.php?where=view_QnA&number=<?php echo $rows['Qnumber']?>">내 질문 [Q.<?php echo $rows['Qtitle'] ?>] 에 답글이 달렸습니다 </a>
      <div class="description"><?php echo $rows['Adate'].' '.$rows['Atime']?></div>
    </div>
  </div>

<?php
} //end while
?>
<!-- end ui relaxed divided list -->
</div>
<?php
} //end else
?>

<!-- end container -->
</div>