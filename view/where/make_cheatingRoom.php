        <!-- 로그인 확인 -->
        <?php
                $URL = '../index.php?menu=login';                   //return URL
                if(!isset($_SESSION['useremail'])) {
        ?>
                <script>
                        alert("로그인이 필요합니다");
                        location.replace("<?php echo $URL?>");
                </script>
        <?php
                }
        ?>
 

<!-- 질문게시판  -->


<h3 align=center>토론&토의 채팅방 만들기</h3>


<!-- Container -->
<div class="ui container" style="padding:20px; width:700px" align=center >

<form class="ui form" method="post" action="./post/make_cheatingRoom_action.php">  

<!-- 질문 제목 -->
<div class="field">
    <label align=left>- 토론&토의 주제 (100자 이하) -</label>
    <input type="text" maxlength="100" name="title" placeholder="나누고싶은 의견을 쉽게 알수있도록 만들어주세요">
</div>

<!-- dropdown -->

<div class="two fields" align=left>
    <div class="field">      
  <label>- 채팅방 종류 -</label>
  <select class="ui fluid dropdown" name="cheatingType" id="cheatingType">
  <option value="">채팅방 종류를 선택해주세요</option>
  <option value="토론">토론</option>
  <option value="토의">토의</option>
  </select>
  </div>
  <div class="field">              
  <label>- 채팅방 최대 인원 (최소:2명 이상 최대:50명 이하) -</label>
      <div class="ui right labeled input">
     <input type="number" name="maxnum" placeholder="인원수를 입력해주세요" min=2 max=50>
      <div class="ui basic label">
       명
     </div>
    </div>
  </div>
</div>



<!-- 글 작성 -->
<div class="ui error message"></div>
  <button class="ui primary button" type="submit" style="width:650px">채팅방 만들기</button>
</form>
</div>

<script>
    $('.ui.dropdown').dropdown();
</script>


<script>
$('.ui.form')
  .form({
    fields: {
      name: {
        identifier: 'title',
        rules: [
          {
            type   : 'empty',
            prompt : '채팅방 제목을 입력해주세요'
          }
        ]
      },
      name3: {
        identifier: 'maxnum',
        rules: [
          {
            type   : 'empty',
            prompt : '채팅방의 최대 인원을 입력해주세요'
          }
        ] 
      },
      minCount: {
        identifier  : 'cheatingType',
        rules: [
          {
            type   : 'minCount[1]',
            prompt : '채팅방 종류를 선택해주세요'
          }
        ]
      }
    }});
</script>


