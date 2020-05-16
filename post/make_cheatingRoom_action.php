<?php
                session_start();
                $connect = mysqli_connect('localhost', 'root', 'lunatic8911', 'researchers') or die("fail");
                
                $title = $_POST['title'];
                $cheatingType = $_POST['cheatingType'];
                $maxnum = $_POST['maxnum'];              //Content
                $email = $_SESSION['useremail'];
                $nickname = $_SESSION['nickname'];
                $date = date('Y-m-d');            //Date
                $time = date('H:i:s');             //time
 
 
                $userlist = $nickname.'//';
                $query = "insert into cheatingroom (number, type , title, email, nickname, date, time, maxnum, userlist ) 
                        values(null,'$cheatingType', '$title', '$email', '$nickname', '$date', '$time', $maxnum, '$userlist')";
 
                $result = $connect->query($query);
                if($result){
                        // 바로 채팅방에 접속하게 하기위함
                        $query1 = "select * from cheatingroom where date ='$date' and time='$time'";
                        $result1 = $connect->query($query1);
                        $rows = mysqli_fetch_assoc($result1);
                        $roomnum =$rows['number'];
                        // 접속확인을 위한 값
                      $query1 = $query = "insert into cheatingroom (nickname,roomnum) 
                      values('$nickname', '$roomnum' )";
                      $result1 = $connect->query($query1);

                        $URL = '../index.php?where=cheatingroom&number='.$rows['number'];
?>                  <script>
                        alert("<?php echo "채팅방이 개설되었습니다."?>");
                        location.replace("<?php echo $URL?>");
                    </script>
<?php
                }
                else{
                        echo "FAIL";
                }
 
                mysqli_close($connect);
?>


