<?php


                $connect = mysqli_connect('localhost', 'root', 'lunatic8911', 'researchers') or die("fail");

                session_start();                


                $roomnum = $_POST['roomnum']; 
                $content = $_POST['text'];              //Content
                $email = $_SESSION['useremail'];
                $nickname = $_SESSION['nickname'];
                $datetime = date('Y-m-d H:i:s');            //Date
 
                
 
                $query = "insert into chat (number, content  , nickname , datetime , roomnum)
                        values(null, '$content', '$nickname', '$datetime', $roomnum)";
 
 
                $result = $connect->query($query);
                if($result){
                  echo "OK";
                }
                else{
                        echo "FAIL";
                }
 
                mysqli_close($connect);
?>


