<?php
        $result = session_destroy();
        if($result) {
?>
        <script>
                alert("로그아웃 되었습니다.");
                history.back();
                location.replace("../index.php?menu=Home");
        </script>
<?php   }
?>
 
