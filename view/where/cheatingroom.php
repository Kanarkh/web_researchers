
<?php
                // DB 초기화
                $connect = mysqli_connect('localhost', 'root', 'lunatic8911', 'researchers') or die ("connect fail");
                $number = $_GET['number'];
                $query = "select * from cheatingroom where number =$number";
                $result = $connect->query($query);
                $total = mysqli_num_rows($result);
                $rows = mysqli_fetch_assoc($result);
                
                // 도배 방지를 위한 쿠키 이름
                $chatName = $_SESSION['nickname'].'chat'.$number; 
                $chatBlock = $_SESSION['nickname'].'blockChat'.$number;

                // 예외처리 존재하지 않는 번호로 접근했을시
                if(!$total){
                        $URL = '../index.php?menu=FreeDiscussion';                   //return URL
                        ?>
                        <script>
                        alert("<?php echo "채팅방이 존재하지 않습니다"?>");
                        location.replace("<?php echo $URL?>");
                        </script>
                        <?php
                }

        ?>

<script>

window.onload = function(){
    // 1000초마다 해당 함수를 불러온다.
  lastDateAjax();
  setInterval(lastDateAjax, 500);
}

// 새로고침할 함수
function lastDateAjax(){
  $.ajax({
                                url: "../ajax/read_chat.php", // 클라이언트가 HTTP 요청을 보낼 서버의 URL 주소
                                data: { roomnum :<?=$number?>}, 
                                method: "POST",    
                                success: function($result){
                                        // alert($result);
                                        
                                        var $mSplit = $result.split('(@)&)(');
                                        var mTbody = document.getElementById("chattable");
                                        mTbody.innerHTML="";
                                        mTbody.insertAdjacentHTML('beforeend',$mSplit[0]);

                                        var mTbody = document.getElementById("userlist");
                                        mTbody.innerHTML="";
                                        mTbody.insertAdjacentHTML('beforeend',$mSplit[1]);

                                        var divdiv = document.getElementById("chattable");                                
                                        divdiv.scrollTop = Number(divdiv.scrollHeight);
                                         
                                }
   })
}
</script>

<div class="ui container" style="padding-top:5px" >
<button class="ui red button" onclick="outroom();">
나가기
</button>

<h3 align=center>주제 : <?=$rows['title']?></h3>

<div class="ui segment" id="example1" >
  
  <div class="right ui rail" style="">
    <div class="ui sticky" style="width: 272px !important; height: 262.531px !important; left: 1310px;">
      <h3 class="ui header">참가자 닉네임</h3>
      <!-- 사이드바 -->
      <div class="ui bulleted list" id="userlist">
      <?php
                  $userlist = explode('//',$rows['userlist']);
                  //배열의 크기 확인
                  $cnt = count($userlist); 
                  for($i=0;$i<($cnt-1);$i++){
                      if($userlist[$i]!=""){
                      ?>
                      <div class="item"><?=$userlist[$i]?></div>
                      <?php
                      }
                  }
      ?>
  
<!-- 리스트 종료 -->
</div> 
    </div>
  </div>
<!-- 채팅방 -->
<div class="ui list" id="chattable" style="  width: 100%;
  height: 600px;
  margin: 5px;
  overflow: auto;
  ">
  
</div>

<!-- 채팅방 종료 -->
</div>
<!-- 메시지 보내기 -->
<div class="ui grid">
<div class="fourteen wide column">

<div class="ui fluid input focus">
  <input type="text" id="text" placeholder="상대방을 배려합시다" >
</div>
</div>
<div class="two wide column">
<button class="ui fluid primary button" onclick="writechat()">
  SEND
</button>
</div> 
<!-- end grid -->
</div>

<!-- end container -->
</div>

<script>
// 채팅도배를 금지하기 위한 쿠키명 변수
var chatBlock ='<?=$chatBlock?>';
var chatCookie  ='<?=$chatName?>';

$('.ui.sticky').sticky({context: '#example1'});

function outroom(){
  
  $.ajax({
                                url: "../ajax/out_chatroom.php", // 클라이언트가 HTTP 요청을 보낼 서버의 URL 주소
                                data: { roomnum :<?=$number?>}, 
                                method: "POST",    
                                success: function($result){
                                        if($result=="ok"){
                                          location.href='index.php?menu=FreeDiscussion';
                                        }
                                }
   })

}

function writechat(){
$minput = document.getElementById("text");
$text = $minput.value;

// 채팅금지
if(getCookie(chatBlock)==null){
  
  // 텍스트 확인
if($text!=""){

  
  if(getCookie(chatCookie)!=null){
    // 쿠키 값을 추가해준다
    setCookie(chatCookie,(Number(getCookie(chatCookie))+1),5);    
    // if(Number(getCookie(chatCookie)>=Number(4)){
    if(getCookie(chatCookie)>3){
      setCookie(chatBlock,30,30);
    }
  }else{
    //2초 유지기간의 쿠키를 만든다
    setCookie(chatCookie,Number(1),5);
  }
  $.ajax({

                                url: "../ajax/write_chat.php", // 클라이언트가 HTTP 요청을 보낼 서버의 URL 주소
                                data: { text: $text, roomnum :<?=$number?>}, 
                                method: "POST",    
                                success: function($result){
                                        // alert($result);
                                        $minput.value="";
                                }
   })
  }else{
    alert("내용을 입력해주세요");
  }

  }else{
    // 채팅금지 상태이다
    alert("도배로 인해 30초간 채팅금지 상태입니다.");
  }
}

// 작성중: 시스템에서 채팅방에 글쓸때 사용하기 위함
function message($text){

if($text!=""){
  $.ajax({
                                url: "../ajax/write_chat_m.php", // 클라이언트가 HTTP 요청을 보낼 서버의 URL 주소
                                data: { text: $text, roomnum :<?=$number?>}, 
                                method: "POST",    
                                success: function($result){
                                        // alert($result);
                                        $minput.value="";
                                }
   })
  }
}

</script>

<!-- 쿠키 -->

<script>
 var setCookie = function(name, value, sec) {
        var date = new Date();
        date.setTime(date.getTime() + sec * 1000);
        document.cookie = name + '=' + value + ';expires=' + date.toUTCString() + ';path=/';
    };

  var getCookie = function(name) {
        var value = document.cookie.match('(^|;) ?' + name + '=([^;]*)(;|$)');
        return value? value[2] : null;
    };


</script>