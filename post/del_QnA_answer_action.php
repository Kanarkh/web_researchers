<?php
                session_start();
                $connect = mysqli_connect('localhost', 'root', 'lunatic8911', 'researchers') or die("fail");
                $qnanumber = $_POST['qnanumber'];
                $number = $_POST['number'];
                
                $URL = '../index.php?where=view_QnA&number='.$qnanumber;                   //return URL
 
  
    
    $query = "delete from qnaanswer where number=$number";
    
    $result = $connect->query($query);
    if($result) {
      // 댓글수 정보 가져온다. 
      $query_a = "select * from qnaboard where number =$qnanumber";
      $result_a = $connect->query($query_a);
      $rows_a = mysqli_fetch_assoc($result_a);
      if($rows_a){
              $answernum = $rows_a['answernum'];
              if($answernum>0)
                $answernum -=1;
              //조회수 업데이트
              $query_s = "update qnaboard set answernum=$answernum where number=$qnanumber";
              $result_s = $connect->query($query_s);
      }
?>
        <script>
            alert("답변이 삭제되었습니다.");
            location.replace("<?=$URL?>");
        </script>
<?php    }
    else {
        echo "fail";
    }
?>
