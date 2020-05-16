<?php
                session_start();
                $connect = mysqli_connect('localhost', 'root', 'lunatic8911', 'researchers') or die("fail");
              
                //reply 정보 가져온다.
                $content = $_POST['content'];              //Content
                $qnanumber = (int)$_POST['qnanumber'];
                $number = (int)$_POST['number'];
                $date = date('Y-m-d');            //Date
                $time = date('H:i:s');             //time
 
                $URL = '../index.php?where=view_QnA&number='.$qnanumber;                   //return URL
                
                $query = "update qnaanswer set content='$content', date='$date', time='$time' where number=$number"; 

                $result = $connect->query($query);

                if($result){
?>                  <script>
                        alert("<?php echo "답변이 수정되었습니다."?>");
                        location.replace("<?php echo $URL?>");
                    </script>
<?php
                }
                else{
                        echo "FAIL";
                }
 
                mysqli_close($connect);
?>


