<?php
                // DB 초기화
    $connect = mysqli_connect('localhost', 'root', 'lunatic8911', 'researchers') or die ("connect fail");
    $number = $_POST['num'];
    $whoRefort = $_POST['whoRefort'];
    $query = "select * from qnaanswer where number =$number";
    $result = $connect->query($query);
    $total = mysqli_num_rows($result);
    $rows = mysqli_fetch_assoc($result);
        
    if($total==1){
        if($rows['refortnum']==0){
            //신고된적 없음. "//" 구분자
            //데이터 추가 
            $emailRefort = $whoRefort."//"; 

            $query = "update qnaanswer set whorefort = '$emailRefort', refortnum=1 where number=$number";
            $result = $connect->query($query);

            if($result) {
                echo "신고되었습니다.";
            }
            else {
                echo "신고도중 문제가 생겼습니다, 잠시후 다시 시도해주세요";
            }

        }else{
            //신고된적 있는 게시글. 신고자 중복확인후 처리해야함. 
            //split처리
            $reforterList = explode('//',$rows['whorefort']);
            //배열의 크기 확인
            $cnt = count($reforterList); 
            $refortState = 0;
            for($i=0;$i<$cnt;$i++){
                if($reforterList[$i]==$whoRefort){
                    echo "이미 신고한 글입니다";
                    $refortState = 1;
                }
            }
            if($refortState==0){
                // 이 사용자가 신고한적 없다.
                $emailRefort = $rows['whorefort'].$whoRefort."//"; 
                $num = $rows['refortnum']+1;
                $query = "update qnaanswer set whorefort = '$emailRefort', refortnum=$num where number=$number";
                $result = $connect->query($query);
                    
                if($result) {
                    echo "신고되었습니다.";
                }
                else {
                    echo "신고도중 문제가 생겼습니다, 잠시후 다시 시도해주세요";
                }
            }
        }

    }else{
        echo $number;
        echo "_신고에 오류가 있습니다";
    }
?>