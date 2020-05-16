<?php
                session_start();
                $connect = mysqli_connect('localhost', 'root', 'lunatic8911', 'researchers') or die("fail");
              
                //reply 정보 가져온다.
                $content = $_POST['content'];              //Content
                $qnanumber = (int)$_POST['qnanumber'];
                $email = $_SESSION['useremail'];
                $nickname = $_SESSION['nickname'];
                $majortitle=$_SESSION['majortitle'];
                $majordetail=$_SESSION['majordetail'];
                $date = date('Y-m-d');            //Date
                $time = date('H:i:s');             //time
 
                $URL = '../index.php?where=view_QnA&number='.$qnanumber;                   //return URL
                
 
                $query = "insert into qnaanswer (number,qnanumber ,majortitle, majordetail, content, email, nickname, date, time) 
                        values(null, $qnanumber, '$majortitle', '$majordetail', '$content', '$email', '$nickname', '$date', '$time')";
 
 
                $result = $connect->query($query);

                if($result){
                // 댓글수 정보 가져온다. 
                $query_a = "select * from qnaboard where number =$qnanumber";
                $result_a = $connect->query($query_a);
                $rows_a = mysqli_fetch_assoc($result_a);
                if($rows_a){
                        $answernum = $rows_a['answernum'];
                        $answernum +=1;
                        //조회수 업데이트
                        $query_s = "update qnaboard set answernum=$answernum where number=$qnanumber";
                        $result_s = $connect->query($query_s);
                }

?>                  <script>
                        alert("<?php echo "답변이 등록되었습니다."?>");
                        location.replace("<?php echo $URL?>");
                    </script>
<?php
                }
                else{
                        echo "FAIL";
                }
 
                mysqli_close($connect);
?>


