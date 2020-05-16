<?php
                session_start();
                $connect = mysqli_connect('localhost', 'root', 'lunatic8911', 'researchers') or die("fail");
                $number = $_POST['number'];
                
 
                $URL = '../index.php?menu=ResearchQnA';                   //return URL
 
  
    
    $query = "delete from qnaboard where number=$number";
    $result = $connect->query($query);


    if($result) {
    // 질문과 연결된 답글 삭제
    $query_a ="delete from qnaanswer where qnanumber=$number";
    $result_a = $connect->query($query_a);
?>
        <script>
            alert("질문이 삭제되었습니다.");
            location.replace("../index.php?menu=ResearchQnA");
        </script>
<?php    }
    else {
        echo "fail";
    }
?>

