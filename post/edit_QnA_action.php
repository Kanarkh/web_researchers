<?php
                session_start();
                $connect = mysqli_connect('localhost', 'root', 'lunatic8911', 'researchers') or die("fail");
                $number = $_POST['number'];
                $majortitle = $_POST['major_title'];
                $majordetail = $_POST['major_detail'];
                $title = $_POST['title'];                  //Title
                $content = $_POST['content'];              //Content
                $email = $_SESSION['useremail'];
                $nickname = $_SESSION['nickname'];
                $date = date('Y-m-d');            //Date
                $time = date('H:i:s');             //time
 
                $URL = '../index.php?menu=ResearchQnA';                   //return URL
 
  
    $query = "update qnaboard set title='$title', content='$content', date='$date', time='$time', 
    majortitle='$majortitle',majordetail='$majordetail' where number=$number";
    $result = $connect->query($query);
    if($result) {
?>
        <script>
            alert("수정되었습니다.");
            location.replace("../index.php?where=view_QnA&number=<?=$number?>");
        </script>
<?php    }
    else {
        echo "fail";
    }
?>
