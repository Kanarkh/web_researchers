        <?php
                session_start();
                if(isset($_SESSION['nickname'])) {
                  // 세션 데이터가 있을시 php에서 수행할 동작
                  ?><div align=right  style="padding-right:30px"> <?php
                        echo $_SESSION['nickname'];?>님 안녕하세요
                        <!-- html에서 수행할 동작 -->
                        <br/></div>
        <?php
                }
                else {
        ?>             
          <!-- 세션 데이터가 없을시 html에서 수행할 동작 -->
           <!-- <button onclick="location.href='./login.php'">로그인</button> -->
                        <!-- <br /> -->
        <?php   } ?>
 

<div class="ui inverted segment">
  <div class="ui inverted secondary pointing menu">
  <div class="ui container">

    <!-- Home -->
    <?php
      //현재 클릭한 메뉴 확인
      if(isset($_GET['menu'])){
      $pagewhere = basename($_GET['menu']);
      //클릭한 이름이 조건과 같다면 
      if($pagewhere == 'Home'){
      ?>
      <!-- item active -->
      <a class="item active">
      Home
      </a>
      <?php
      }else{
        ?>
      <!-- 조건의 이름과 같지 않다면 -->
      <a class="item" onclick="location.href='index.php?menu=Home'">
      Home
      </a>    
        <?php
      }
      }else{
      //where이 get으로 나타나지 않았다면
      ?>
      <a class="item " onclick="location.href='index.php?menu=Home'">
      Home
      </a>
      <?php
      }
    ?>

    <!-- 연구 QnA -->
    <?php
      //현재 클릭한 메뉴 확인
      if(isset($_GET['menu'])){
      $pagewhere = basename($_GET['menu']);
      //클릭한 이름이 조건과 같다면 
      if($pagewhere == 'ResearchQnA'){
      ?>
      <!-- item active -->
      <a class="item active">
      연구 QnA
      </a>
      <?php
      }else{
        ?>
      <!-- 조건의 이름과 같지 않다면 -->
      <a class="item" onclick="location.href='index.php?menu=ResearchQnA'">
      연구 QnA
      </a>    
        <?php
      }
      }else{
      //where이 get으로 나타나지 않았다면
      ?>
      <a class="item" onclick="location.href='index.php?menu=ResearchQnA'">
      연구 QnA
      </a>
      <?php
      }
    ?>
    
   
    <!-- 인기 논문 -->
    <?php
      //현재 클릭한 메뉴 확인
      if(isset($_GET['menu'])){
      $pagewhere = basename($_GET['menu']);
      //클릭한 이름이 조건과 같다면 
      if($pagewhere == 'Treatise'){
      ?>
      <!-- item active -->
      <a class="item active">
      인기 논문
      </a>
      <?php
      }else{
        ?>
      <!-- 조건의 이름과 같지 않다면 -->
      <a class="item" onclick="location.href='index.php?menu=Treatise'">
      인기 논문
      </a>    
        <?php
      }
      }else{
      //where이 get으로 나타나지 않았다면
      ?>
      <a class="item" onclick="location.href='index.php?menu=Treatise'">
      인기 논문
      </a>
      <?php
      }
    ?>

    <!-- 토론 & 토의 -->
    <?php
      //현재 클릭한 메뉴 확인
      if(isset($_GET['menu'])){
      $pagewhere = basename($_GET['menu']);
      //클릭한 이름이 조건과 같다면 
      if($pagewhere == 'FreeDiscussion'){
      ?>
      <!-- item active -->
      <a class="item active">
      토론&토의 채팅방
      </a>
      <?php
      }else{
        ?>
      <!-- 조건의 이름과 같지 않다면 -->
      <a class="item" onclick="location.href='index.php?menu=FreeDiscussion'">
      토론&토의 채팅방
      </a>    
        <?php
      }
      }else{
      //where이 get으로 나타나지 않았다면
      ?>
      <a class="item" onclick="location.href='index.php?menu=FreeDiscussion'">
      토론&토의 채팅방
      </a>
      <?php
      }
    ?>


    <!-- 내정보 (메뉴바의 오른쪽 부분))) -->
    <!-- 로그인/회원가입 -->
    <?php
      //현재 클릭한 메뉴 확인
      if(isset($_GET['menu'])){
      $pagewhere = basename($_GET['menu']);
      //클릭한 이름이 조건과 같다면 
      if($pagewhere == 'login'){
      ?>
      
      <!-- 로그인 유무 검사 -->
      <?php
                if(isset($_SESSION['nickname'])) {
                  // 세션 데이터가 있을시 php에서 수행할 동작
                    ?>
                        <!-- html에서 수행할 동작 -->
                  <!-- 중복사용이 많아 유지보수를 위해 합쳤다 -->
                  <?php require("./view/MyNavbar.php"); ?>
        <?php
                }
                else {
        ?>             
          <!-- 세션 데이터가 없을시 html에서 수행할 동작 -->
          <a class="right item active">로그인/회원가입</a>
        <?php   } ?>    

      <?php
      }else{
        ?>
      <!-- 조건의 이름과 같지 않다면 -->
      <!-- 로그인 유무 검사 -->
      <?php
                if(isset($_SESSION['nickname'])) {
                  // 세션 데이터가 있을시 php에서 수행할 동작
                    ?>
                        <!-- html에서 수행할 동작 -->
                  <!-- 중복사용이 많아 유지보수를 위해 합쳤다 -->
                  <?php require("./view/MyNavbar.php"); ?>
        <?php
                }
                else {
        ?>             
          <!-- 세션 데이터가 없을시 html에서 수행할 동작 -->
          <a class="right item" onclick="location.href='index.php?menu=login'">로그인/회원가입</a>
        <?php   } ?>    
        <?php
      }
      }else{
      //where이 get으로 나타나지 않았다면
      ?>
      <!-- 로그인 유무 검사 -->
      <?php
                if(isset($_SESSION['nickname'])) {
                  // 세션 데이터가 있을시 php에서 수행할 동작
                    ?>
                        <!-- html에서 수행할 동작 -->
                        <!-- 중복사용이 많아 유지보수를 위해 합쳤다 -->
                        <?php require("./view/MyNavbar.php"); ?>
        <?php
                }
                else {
        ?>             
          <!-- 세션 데이터가 없을시 html에서 수행할 동작 -->
          <a class="right item" onclick="location.href='index.php?menu=login'">로그인/회원가입</a>
        <?php   } ?>   
      <?php
      }
    ?>

    </div>
  </div>
</div>

<script>
$('#myNavDropDown').dropdown();
</script>