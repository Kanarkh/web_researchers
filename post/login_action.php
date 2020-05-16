<?php
                
            session_start();
                $connect = mysqli_connect('localhost', 'root', 'lunatic8911', 'researchers') or die("fail");
                
                $email = $_POST['email'];                      //Writer
                $pw = $_POST['password'];                        //Password
     
                //아이디가 있는지 검사
                $query = "select * from users where email='$email'";
                $result = $connect->query($query);

                if(mysqli_num_rows($result)==1) {
 
                    $row=mysqli_fetch_assoc($result);
     
                    //비밀번호가 맞다면 세션 생성
                    if($row['password']==$pw){
                            $_SESSION['useremail']=$email;
                            $_SESSION['nickname']=$row['nickname'];
                            $_SESSION['majortitle']=$row['majortitle'];
                            $_SESSION['majordetail']=$row['majordetail'];
                            if($row['ismanager']==1){
                                $_SESSION['ismanager']=$row['ismanager'];        
                            }
                            if(isset($_SESSION['useremail'])){
                            ?>      <script>
                                            alert("로그인 되었습니다.");
                                            location.replace("../index.php?menu=Home");
                                    </script>
    <?php
                            }
                            else{
                                    echo "session fail";
                            }
                    }
     
                    else {
            ?>              <script>
                                    alert("아이디 혹은 비밀번호가 잘못되었습니다. 2");
                                    history.back();
                            </script>
            <?php
                    }
     
            }
     
                    else{
    ?>              <script>
                            alert("아이디 혹은 비밀번호가 잘못되었습니다. 1");
                            history.back();
                    </script>
    <?php
            }
     
     
    ?>