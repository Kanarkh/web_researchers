<?php
               session_start();
                // DB 초기화
    $connect = mysqli_connect('localhost', 'root', 'lunatic8911', 'researchers') or die ("connect fail");
    $type = $_POST['type'];
    $value = $_POST['value'];
    
    //아이디가 있는지 검사
    
    if($type == "email"){
    $query = "select * from users where email='$value'";
    $result = $connect->query($query);
    if(mysqli_num_rows($result)==0) {
        echo "ok";
    }
    else if(mysqli_num_rows($result)==1) {
      echo "no";
    }else{
      echo "no";
    }

    }else if($type == "nickname"){
      $query = "select * from users where nickname='$value'";
      $result = $connect->query($query);
      if(mysqli_num_rows($result)==0) {
        echo "ok";
      }
      else if(mysqli_num_rows($result)==1) {
        echo "no";
      }else{
        echo "no";
      }
    
    }

    if($type == "pw"){
      $mnickname = $_SESSION['nickname'];                  
      $query = "select * from users where nickname='$mnickname'";
      $result = $connect->query($query);
      $rows = mysqli_fetch_assoc($result);
      if($rows['password']==$value){
        echo "ok";
      }else{
        echo "no";
      }
    }
  

?>


        