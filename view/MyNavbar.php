<?php
// 알람 개수를 파악하기 위함
$email = $_SESSION['useremail'];

$connect = mysqli_connect('localhost', 'root', 'lunatic8911', 'researchers') or die ("connect fail");
$query ="SELECT qnaboard.number as Qnumber, qnaboard.title as Qtitle, qnaanswer.content as Acontent, qnaanswer.date as Adate, qnaanswer.time as Atime FROM qnaanswer join qnaboard on qnaanswer.qnanumber = qnaboard.number where qnaboard.email ='$email' and qnaanswer.readingstatus = 0 ORDER BY qnaanswer.number DESC";
$result = $connect->query($query);
$total = mysqli_num_rows($result);
?>

<!-- 스크립트는 ./Navbar.php에 있다 -->
<div class="ui right inverted menu">

    <!-- <div class="item active">My 연구팀</div> -->
    <div class="ui floating dropdown item" id="myNavDropDown">
      MyMenu <i class="dropdown icon"></i>
      <div class="menu">
    <div class="item" onclick="location.href='index.php?mypage=MyInformation'">내정보</div>
    <!-- <div class="item" onclick="location.href='index.php?mypage=NotificationBox'">알림함</div> -->
     <!-- 로그인 유무 검사 -->
        <?php
                if(isset($_SESSION['ismanager'])) {
                  // 세션 데이터가 있을시 php에서 수행할 동작
                    ?>
                        <!-- html에서 수행할 동작 -->
                        <!-- 이부분은 Post로 보내야하지 않을까? URL로 관리자 페이지를 들어가는건 뭔가 이상하다 -->
                <div class="item" onclick="location.href='index.php?mypage=Manager'">유저 관리</div>
        <?php
                }
                else {
        ?>             
          <!-- 세션 데이터가 없을시 html에서 수행할 동작 -->
          
        <?php   } ?>    
    <div class="item" onclick="location.href='index.php?where=logout'">로그아웃</div>
      </div>
    </div>

    <!-- 확인해야 할 알람이 있다면 -->
    <?php 
    if($total!=0){
    ?>
    <!-- 확인해야할 알람이 있다 -->
    <a class="item" onclick="location.href='index.php?mypage=NotificationBox'"><i style="color:red" class="large bell outline icon"></i>(<?=$total?>)</a>
    <?php 
    }else{
    ?>
    <!-- 확인해야할 알람이 없다 -->
    <a class="item" onclick="location.href='index.php?mypage=NotificationBox'"><i class="large bell outline icon"></i></a>
    <?php 
    }
    ?>
  </div>