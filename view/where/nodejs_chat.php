<div class="ui container" align=center style="padding:20px" >

    <iframe src="<?=$_SERVER['HTTP_HOST']?>:3000" width="100%" height="500px">
        <p>현재 사용 중인 브라우저는 iframe 요소를 지원하지 않습니다!</p>
    </iframe>

    </div>


<script>

function setCookie(cookie_name, value, days) {
var exdate = new Date();
exdate.setDate(exdate.getDate() + days);
// 설정 일수만큼 현재시간에 만료값으로 지정

var cookie_value = escape(value) + ((days == null) ? '' : ';    expires=' + exdate.toUTCString());
document.cookie = cookie_name + '=' + cookie_value;

}
</script>


<?php
 
 if(isset($_COOKIE['num'])){
    setcookie("num",$_COOKIE['num']+1,time()+15);
 }else{
    setcookie("num",1,time()+15);
 }


    if(isset($_COOKIE['num'])){
        echo "<h1>".$_COOKIE['num']."</h1>";
    }else{
        echo "<h2>no</h2>";
    }
?>


<?php
$http_host = $_SERVER['HTTP_HOST'];
$request_uri = $_SERVER['REQUEST_URI'];
$url = 'http://' . $http_host . $request_uri;
?>
<div>HTTP_HOST: <?= $http_host ?></div>
<div>REQUEST_URI: <?= $request_uri ?></div>
<div>URL: <?= $url ?></div>