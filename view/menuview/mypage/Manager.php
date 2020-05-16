<?php
$connect = mysqli_connect('localhost', 'root', 'lunatic8911', 'researchers') or die ("connect fail");
$query ="select * from users order by number desc";
$result = $connect->query($query);
$total = mysqli_num_rows($result);
 ?>



<div class="ui container" align=center style="padding:20px" >
<h3 align=center>유저 정보</h3>

<table class="ui celled table">
  <thead>
    <tr><th>Email</th>
    <th>NickName</th>
    <th>학문분류</th>
    <th>세부분류</th>
    <th>관리</th>
  </tr></thead>
  <tbody>
  
  <?php
    while($rows = mysqli_fetch_assoc($result)){
      ?>
      <tr>
      <td><?php echo $rows['email'] ?></td>
      <td><?php echo $rows['nickname'] ?></td>
      <td><?php echo $rows['majortitle'] ?></td>
      <td><?php echo $rows['majordetail'] ?></td>
      <td><button class="ui button" type="button" onclick="deluser('<?php echo $rows['nickname'] ?>');">탈퇴</button></td>
      </tr>
      <?php
    }
    ?>  

  </tbody>
</table>

<!-- end container -->
</div>


<script>
  function deluser($nick){
    var result = confirm("회원 "+$nick+"을 강제로 탈퇴시키겠습니까? 탈퇴가 진행되면 복구할수 없습니다.");
                if(result){
                        $.ajax({
                                url: "../ajax/del_user.php", // 클라이언트가 HTTP 요청을 보낼 서버의 URL 주소
                                data: { nickname: $nick}, 
                                method: "POST",    
                                success: function($result){
                                        alert($result);
                                        window.location.reload();
                                }
                        })
                }
}

</script>