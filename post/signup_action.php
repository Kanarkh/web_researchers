<?php
                $connect = mysqli_connect('localhost', 'root', 'lunatic8911', 'researchers') or die("fail");
                
                $email = $_POST['email'];                      //Writer
                $pw = $_POST['password'];                        //Password
                $nickname = $_POST['nickname'];                  //
                $major_title = $_POST['major_title'];
                // $major_title = substr($_POST['major_title'],0,-6);
                $major_detail = $_POST['major_detail'];
                // $date = date('Y-m-d H:i:s');            //Date
 

                $URL = '../index.php?menu=login';                   //return URL
 


                $query = "insert into users (email, nickname , password , majortitle , majordetail) 
                        values('$email','$nickname', '$pw', '$major_title','$major_detail')";
 

                    $result = $connect->query($query);
                if($email!=''){ 
                    // 저장이 2번 되는 현상이 있다. 1번째는 내가 넣은 데이터가 저장이되고 두번째는 ''로 빈 공간으로 저장이된다. (임시조치)
                    // $result = $connect->query($query);
                }else{
                    //$result =0;
                }
                if($result){
?>                  <script>
                        alert("<?php echo "가입되셨습니다."?>");
                        location.replace("<?php echo $URL?>");
                    </script>
<?php
                }
                else{
                        echo "FAIL";
                }
 
                mysqli_close($connect);
?>


