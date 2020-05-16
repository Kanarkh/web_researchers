<?php
$connect = mysqli_connect('localhost', 'root', 'lunatic8911', 'researchers') or die ("connect fail");
$query ="select * from cheatingroom order by number desc";
$result = $connect->query($query);
$total = mysqli_num_rows($result);
 ?>

<div class="ui container" align=center style="padding:20px" >
<h3 align=center>토론&토의 채팅방</h3>

<?php
if($total!=0){
?>
<!-- table -->
<table class="ui grey table" style="table-layout:fixed" >  
    <!-- black -->
  <thead align=center>
    <tr>
    <th style="width:50px">No</th>
    <th style="width:80px">type</th>
    <th>주제</th>
    <!-- <th class="right aligned" style="width:80px">방장</th> -->
    <th class="right aligned" style="width:80px">현재인원</th>
    <th class="right aligned" style="width:80px">최대인원</th>
    </tr>
  </thead>
  <tbody id="boardTbody">
    <!-- DB에서 글목록 가져오기. -->
    <?php
    while($rows = mysqli_fetch_assoc($result)){
      ?>
      <tr align=center>
      <td ><?php echo $rows['number'] ?></td>
      <td class="left aligned" ><?php echo $rows['type'] ?></td>
      <!-- <td style="overflow:hidden;white-space:nowrap;text-overflow:ellipsis;"><a href ="index.php?where=cheatingroom&number=<?php echo $rows['number']?>"><?php echo $rows['title'] ?></td> -->
      <td style="overflow:hidden;white-space:nowrap;text-overflow:ellipsis;"><a onclick="goroom(<?php echo $rows['number']?>);"><?php echo $rows['title'] ?></td>
      <!-- <td class="right aligned" style="overflow:hidden;white-space:nowrap;text-overflow:ellipsis;"><?php echo $rows['nickname'] ?></td> -->
      <td class="right aligned"><?php echo $rows['currentnum'] ?></td>
      <td class="right aligned"><?php echo $rows['maxnum'] ?></td>
      </tr>
      <?php
    }
    ?>
  </tbody>
</table>
<!-- end table -->

<?php
}else{
?>

<h4 align=center style="padding:20px">개설된 토론&토의 채팅방이 없네요!. 하단의 채팅방을 눌러 새로운 주제로 대화를 나눠보세요</h4>

<?php
}
?>

    <!-- <iframe src="http://192.168.92.185:3000" width="100%" height="500px">
        <p>현재 사용 중인 브라우저는 iframe 요소를 지원하지 않습니다!</p>
    </iframe> -->

<!-- 질문하기 버튼 -->
<div class="column"><div align=right><button class="ui secondary button" onclick="location.href='index.php?where=make_cheatingRoom'">채팅방 만들기</button></div></div>
<!-- end container -->
</div>

<script>
function goroom($num){
  $.ajax({
                                url: "../ajax/go_room.php", // 클라이언트가 HTTP 요청을 보낼 서버의 URL 주소
                                data: { roomnum: $num}, 
                                method: "POST",    
                                success: function($result){
                                        //alert($result);
                                    if($result=='가능'){
                                      location.href='index.php?where=cheatingroom&number='+$num;
                                    }else if($result=='오류'){
                                      alert("서버에 오류가 있습니다 잠시후 다시 시도해주세요");
                                    }else if($result=='참석'){
                                      location.href='index.php?where=cheatingroom&number='+$num;
                                      //alert("이미 다른페이지에서 참석했습니다.");
                                    }else if($result=='인원'){
                                      alert("채팅방 인원이 꽉찼습니다");
                                    }
                                }
   })
  
}
</script>


