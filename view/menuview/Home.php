
      <?php
                if(isset($_SESSION['nickname'])) {
                  // 세션 데이터가 있을시 php에서 수행할 동작
                        ?>
                        <!-- html에서 수행할 동작 -->
<!-- <div class="ui container" align=center >
<div  align=left>
<div class="ui segment">
  <h2 class="ui cnter floated header">연구 QnA 최신글</h2>
  <div class="ui clearing divider"></div>
  <p>1.</p>
</div>           

<div class="ui segment">
  <h2 class="ui cnter floated header">인기 논문 최신글</h2>
  <div class="ui clearing divider"></div>
  <p>1.</p>
</div>           
<div class="ui segment">
  <h2 class="ui cnter floated header">자유 토의 최신글</h2>
  <div class="ui clearing divider"></div>
  <p>1.</p>
</div>
</div>                        
</div>                         -->
<?php
  require("./view/menuview/Home_guest.php");
?>
                        <!-- html에서 수행할 동작 끝-->
        <?php
                }
                else {
        ?>             
          <!-- 세션 데이터가 없을시 html에서 수행할 동작 -->
<?php
  require("./view/menuview/Home_guest.php");
?>
<!-- 세션 데이터가 없을시 html에서 수행할 동작끝 -->

        <?php   } ?>

<!-- 쿠키 -->

<script>
 var setCookie = function(name, value, day) {
        var date = new Date();
        date.setTime(date.getTime() + day * 1000 * 60 * 60 *24);
        document.cookie = name + '=' + value + ';expires=' + date.toUTCString() + ';path=/';
    };

  var getCookie = function(name) {
        var value = document.cookie.match('(^|;) ?' + name + '=([^;]*)(;|$)');
        return value? value[2] : null;
    };


</script>

<script>

// 광고팝업을 연다
if(!getCookie("noPopup1")){
// 팝업창
var windowW = 600;  // 창의 가로 길이
var windowH = 700;  // 창의 세로 길이
var left = 0;
var top = Math.ceil((window.screen.height - windowH));
window.open("/popup/homePopup1.php","pop_01","l top="+top+", left="+left+", height="+windowH+",location=no,menubar=no, width="+windowW);
}

</script>



        