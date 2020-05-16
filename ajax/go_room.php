<?php
                session_start();

                // DB 초기화
                $connect = mysqli_connect('localhost', 'root', 'lunatic8911', 'researchers') or die ("connect fail");
                $roomnum = $_POST['roomnum'];
                $query = "select * from cheatingroom where number =$roomnum";
                $result = $connect->query($query);
                $total = mysqli_num_rows($result);
                $rows = mysqli_fetch_assoc($result);
                
              
                
                  $userlist = explode('//',$rows['userlist']);
                  //배열의 크기 확인
                  $state =0;
                  $cnt = count($userlist); 
                  for($i=0;$i<($cnt-1);$i++){
                    if($userlist[$i]==$_SESSION['nickname']){
                      // 이미 참여중인 유저
                      $state=1;
                    }
                  }
                  if($state==0){
                    // 참여 가능
                    if($rows['maxnum']>$rows['currentnum']){
                      // 참여가능
                      $userlist = $rows['userlist'].$_SESSION['nickname'].'//';
                      $currentnum = $rows['currentnum']+1;
                      $query = "update cheatingroom set userlist='$userlist',currentnum=$currentnum";
                      $result = $connect->query($query);

                      // // 접속확인을 위한 값
                      // $query1 = $query = "insert into cheatingroom (nickname,roomnum) 
                      // values('$_SESSION['nickname']', '$roomnum')";
                      // $result1 = $connect->query($query1);
                      
                      if($result){
                        echo '가능';
                      }else{
                        echo '오류';
                      }
                    }else{
                      // 인원초과 
                      echo '인원';
                    }
                  }else{
                    // 이미 참여중인 유저
                    echo '참석';
                  }
                

?>