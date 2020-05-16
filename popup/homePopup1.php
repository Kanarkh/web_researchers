<div style="position:absolute; right:0px; bottom:0px;">
<div class="ui checkbox">
  <input type="checkbox" name="example" onclick="today();">
  <label>24시간 동안 이 창을 열지 않습니다.</label>

  <input type="checkbox" name="example" onclick="aMonth();">
  <label>일주일 동안 이 창을 열지 않습니다.</label>
</div>

</div>


<script>
function today(){
  setCookie("noPopup1","true",1);
  window.close();
}
function aMonth(){
  setCookie("noPopup1","true",7);
  window.close();
}

</script>


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