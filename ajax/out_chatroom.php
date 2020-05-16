<?php
                session_start();

                // DB 초기화
                $connect = mysqli_connect('localhost', 'root', 'lunatic8911', 'researchers') or die ("connect fail");
                $roomnum = $_POST['roomnum'];
                $query = "select * from cheatingroom where number =$roomnum";
                $result = $connect->query($query);
                $rows = mysqli_fetch_assoc($result);

              
                  $userlist = explode('//',$rows['userlist']);
                  //배열의 크기 확인
                  $cnt = count($userlist); 
                  $ulist = "";
                  for($i=0;$i<($cnt-1);$i++){
                      if($userlist[$i]!=$_SESSION['nickname']){
                        $ulist= $ulist.$userlist[$i].'//';
                      }
                  }

                  $currentnum = $rows['currentnum']-1;
                  if($currentnum!=0){
                      $query = "update cheatingroom set userlist='$ulist',currentnum=$currentnum";
                      $result = $connect->query($query);
                  }else{
                    $query1 = "delete from chat where roomnum =$roomnum";
                    $result1 = $connect->query($query1);
                    $query = "delete from cheatingroom where number =$roomnum";
                    $result = $connect->query($query);
                  }
                  
                  if($result){
                    echo "ok";
                  }else{
                    echo "no";
                  }
                  
?>