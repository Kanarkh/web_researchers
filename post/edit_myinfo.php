<?php
                $connect = mysqli_connect('localhost', 'root', 'lunatic8911', 'researchers') or die("fail");
                
                $email = $_POST['email'];                      //Writer
                $pw = $_POST['password'];                        //Password
                $nickname = $_POST['nickname'];                  //
                $major_title = $_POST['major_title'];
                $major_detail = $_POST['major_detail'];

                $query = "update users set password='$pw', majortitle='$major_title', majordetail='$major_detail' where email='$email'"; 
              
                    $result = $connect->query($query);
                
                if($result){
?>                  <script>
                        alert("<?php echo "수정되었습니다."?>");
                        location.replace("../index.php?menu=Home");
                    </script>
<?php
                }
                else{
                        echo "FAIL";
                }
 
                mysqli_close($connect);
?>


