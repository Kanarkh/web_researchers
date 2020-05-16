<?php
  // DB 초기화
  $connect = mysqli_connect('localhost', 'root', 'lunatic8911', 'researchers') or die ("connect fail");
  $number = $_GET['answer'];
  $query = "select * from qnaanswer where number =$number";
  $result = $connect->query($query);
  $total = mysqli_num_rows($result);
  $rows_a = mysqli_fetch_assoc($result);

?>

<!doctype html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../semantic/semantic.css">
        <script
        src="https://code.jquery.com/jquery-3.1.1.min.js"
        integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
        crossorigin="anonymous"></script>
        <script src="../semantic/semantic.js"></script>
        <title>RESEARCHERS</title>
        <style>
            
        </style>
    </head>
    <body>

<!-- 답변 형식 시작 -->
<div class="ui container" style="padding-top:20px;" >
<div class="ui segment">
<!-- 제목 -->
  <h3 class="ui cnter floated header"><i style="color:green" class="lightbulb outline icon"></i></h3>
  <div class="ui clearing divider"></div>
  <!-- 내용 -->

        <p style="white-space:pre;"><?php echo $rows_a['content']?></p>
        <div class="ui clearing divider"></div>

  <!-- 답변자 정보 -->
  <div class="ui two column grid">
        <div class="column">
        <h5>답변자 : <?php echo $rows_a['nickname']?></h5>
        <p>답변자 전공 : <?php echo $rows_a['majortitle']?> / <?php echo $rows_a['majordetail']?></p>
        <p>답변일 : <?php echo $rows_a['date']?> <?php echo $rows_a['time']?></p>
        </div>
  </div>
</div>                      
</div>                    
</body>
</html>