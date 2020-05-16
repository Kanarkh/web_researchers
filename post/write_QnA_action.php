<?php
                session_start();
                $connect = mysqli_connect('localhost', 'root', 'lunatic8911', 'researchers') or die("fail");
                
                $majortitle = $_POST['major_title'];
                $majordetail = $_POST['major_detail'];
                $title = $_POST['title'];                  //Title
                $content = $_POST['content'];              //Content
                $email = $_SESSION['useremail'];
                $nickname = $_SESSION['nickname'];
                $date = date('Y-m-d');            //Date
                $time = date('H:i:s');             //time
 
                $URL = '../index.php?menu=ResearchQnA';                   //return URL
 
 
                $query = "insert into qnaboard (number, majortitle, majordetail, title, content, email, nickname, date, time, hit, answernum) 
                        values(null,'$majortitle', '$majordetail', '$title', '$content', '$email', '$nickname', '$date', '$time', 0, 0)";
 
 
                $result = $connect->query($query);
                if($result){
?>                  <script>
                        alert("<?php echo "질문이 등록되었습니다."?>");
                        location.replace("<?php echo $URL?>");
                    </script>
<?php
                }
                else{
                        echo "FAIL";
                }
 
                mysqli_close($connect);
?>


