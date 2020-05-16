<?php
                $connect = mysqli_connect('localhost', 'root', 'lunatic8911', 'researchers') or die("fail");
                $nickname = $_POST['nickname'];
            
    $query = "delete from users where nickname='$nickname'";
    $result = $connect->query($query);


    if($result) {
      echo "회원을 삭제했습니다.";

    }else {
        echo "회원 삭제에 실패했습니다 잠시후 다시 시도해주세요".$query;
    }
?>
