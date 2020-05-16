
<?php
                // DB 초기화
                $connect = mysqli_connect('localhost', 'root', 'lunatic8911', 'researchers') or die ("connect fail");
                $number = $_GET['number'];
                $query = "select * from qnaboard where number =$number";
                $result = $connect->query($query);
                $total = mysqli_num_rows($result);
                $rows = mysqli_fetch_assoc($result);
                $hit = $rows['hit'];
                
                // 글의 email
                $quseremail = $rows['email'];
                // 예외처리 존재하지 않는 번호로 접근했을시
                if(!$total){
                        $URL = '../index.php?menu=ResearchQnA';                   //return URL
                        ?>
                        <script>
                        alert("<?php echo "게시글이 존재하지 않습니다"?>");
                        location.replace("<?php echo $URL?>");
                        </script>
                        <?php
                }
                //조회수 
                if(isset($_SESSION['useremail'])) {
                        if($_SESSION['useremail']!=$rows['email']){

                                //같지 않다면 조회수를 올린다
                                $hit++;
                        }
                }else{
                        //회원이 아닌 사람이 봤을때도 조회수를 올리고싶다면 여기에 코드를 넣는다.
                        //$hit++;
                }
                
                // 2분동안 조회수 중복으로 오르지 않도록
                $cookieName = $_SESSION['nickname'].'QnA'.$number;
                if(isset($_COOKIE[$cookieName])){
                        // 쿠키가 있다 
                        setcookie($cookieName,1,time()+120);
                }else{
                        // 쿠키가 없다
                        //조회수 업데이트
                        $query_hit = "update qnaboard set hit='$hit' where number=$number";
                        $result_hit = $connect->query($query_hit);
                        setcookie("$cookieName",1,time()+120);
                }

?>



        
<!-- 글작성 -->
<div class="ui container" style="padding-top:50px;" >
<!-- 질문 정보 -->
        <div class="ui celled horizontal list">
        <div class="item"><h4>질문 분류</h4></div>
                <div class="item"><?php echo $rows['majortitle']?></div>
                <div class="item"><?php echo $rows['majordetail']?></div>
        </div>
        
<div class="ui segment">
<!-- 제목 -->
  <h3 class="ui cnter floated header"><i style="color:red" class="question circle outline icon"></i><?php echo $rows['title']?></h3>
  <div class="ui clearing divider"></div>
  <!-- 내용 -->
  <p style="white-space:pre;"><?php echo $rows['content']?></p>
  <div class="ui clearing divider"></div>
  <!-- 질문자 정보 -->
  <div class="ui two column grid">
        <div class="column">
        <h5>질문자 : <?php echo $rows['nickname']?></h5>
        <p>질문자 전공 : <?php echo $rows['majortitle']?> / <?php echo $rows['majordetail']?></p>
        <p>질문일 : <?php echo $rows['date']?> <?php echo $rows['time']?></p>

        </div>
        <!-- 드롭다운 메뉴 -->
        <div class="column" align=right>
        <div class="ui basic icon top left pointing dropdown button">
  <i class="ellipsis vertical icon"></i>
  <div class="menu">

  <?php 
  if(!isset($_SESSION['useremail'])){
          ?>
  <!-- 로그인 되있지 않다면 -->
  <div class="item">신고를 원하시면 로그인을해주세요</div>
    <!-- end -->
    <?php
    } else{
    if($_SESSION['useremail']==$rows['email']) {?>
    <!-- 로그인한 이메일과 글 작성자가 같다면 -->
    <div class="item" onclick="location.href ='index.php?where=edit_QnA&number=<?php echo $number?>'">질문 수정</div>
    <div class="item" onclick="delContent();">질문 삭제</div>
    <!-- end  -->
    <?php
    }else{
        ?>
  <!-- 로그인한 이메일과 글 작성자가 다르다면 -->
  <div class="item" onclick="refort();">신고 하기</div>
    <?php
}
}
?>

  </div>
 </div>
        <!-- end  드롭다운 메뉴 -->
        </div>
  </div>
</div>     
<!-- 질문하기 끝 -->
<!-- 답변 DB 세팅 -->
<?php
$query_a ="select * from qnaanswer where qnanumber=".$number;
$result_a = $connect->query($query_a);
?>
<!-- 답변 게시판 -->
<?php 
while($rows_a = mysqli_fetch_assoc($result_a)){
?>
<!-- 답변 형식 시작 -->
<div class="ui segment">
<!-- 제목 -->
  <h3 class="ui cnter floated header"><i style="color:green" class="lightbulb outline icon"></i></h3>
  <div class="ui clearing divider"></div>
  <!-- 내용 -->
  <!-- 블라인드 조건문 -->
  <?php 
      if($rows_a['refortnum']>=1){  
      ?>
        <!-- 블라인드 -->
        <p style="white-space:pre; color:#92B3B7;" ><a style="color:#92B3B7" onClick="blind(<?php echo $rows_a['number']?>)" >블라인드 처리된 답변입니다. 확인이 필요하시면 클릭해주세요.</a></p>
        <div class="ui clearing divider"></div>
  <?php 
      }else{
  ?>
        <!-- 일반 답변 -->
        <p style="white-space:pre;"><?php echo $rows_a['content']?></p>
        <div class="ui clearing divider"></div>
  <?php
      }
  ?>

  <!-- 질문자 정보 -->
  <div class="ui two column grid">
        <div class="column">
        <h5>답변자 : <?php echo $rows_a['nickname']?></h5>
        <p>답변자 전공 : <?php echo $rows_a['majortitle']?> / <?php echo $rows_a['majordetail']?></p>
        <p>답변일 : <?php echo $rows_a['date']?> <?php echo $rows_a['time']?></p>

        </div>
        <!-- 드롭다운 메뉴 -->
        <div class="column" align=right>
        <div class="ui basic icon top left pointing dropdown button">
  <i class="ellipsis vertical icon"></i>
  <div class="menu">

  <?php 
  if(!isset($_SESSION['useremail'])){
          ?>
  <!-- 로그인 되있지 않다면 -->
  <div class="item">신고를 원하시면 로그인을해주세요</div>
    <!-- end -->
    <?php
    } else{
    if($_SESSION['useremail']==$rows_a['email']) {?>
    <!-- 로그인한 이메일과 글 작성자가 같다면 -->
    <div class="item" onclick="location.href ='index.php?where=edit_QnA_answer&number=<?php echo $number?>&answer=<?php echo $rows_a['number']?>'">답변 수정</div>
    <div class="item" onclick="delAnswerContent(<?php echo $rows_a['number']?>);">답변 삭제</div>
    <!-- end  -->
    <?php
    }else{
        ?>
  <!-- 로그인한 이메일과 글 작성자가 다르다면 -->
  <div class="item" onclick="refortAnswer(<?php echo $rows_a['number']?>);">신고 하기</div>
    <?php
}
}
?>
  </div> 
 </div>
        <!-- end  드롭다운 메뉴 -->
        </div>
  </div>
</div>                          
<!-- 답변 형식 종료 -->
<?php
}
?>
<!-- 답변 게시판 종료 -->

<!-- 답변작성하기 로그인된 회원중 질문자가 아닌 경우에만 답변하기가 활성화된다. -->
<?php 
  if(!isset($_SESSION['useremail'])){
          ?>
  <!-- 로그인 되있지 않다면 -->
    <!-- end -->
    <?php
    } else{
    if($_SESSION['useremail']!=$quseremail){?>

<!-- 답변하기 -->
<form class="ui form" method="post" action="../post/write_QnA_answer_action.php">  

<!-- 답변작성 -->
<div class="field">
<label align=left>- 답변하기 -</label>
<textarea name ="content" cols=85 rows=12></textarea>
</div>
<input type="hidden" name="qnanumber" value="<?php echo $number?>">

<!-- 글 작성 -->
<div align=right>
  <button class="ui primary button" type="submit">답변 작성</button>
  </div>
</form>

<?php
    }}
?>

<!-- end container -->
</div>     


<!-- 답변 리딩 확인 update -->
<?php
        
        //답변읽은거 처리하기
                // 로그인 상태이고
                if(isset($_SESSION['useremail'])){
                        // 로그인한 유저와 글작성자가 같다면
                        if($_SESSION['useremail']==$quseremail) {
                                $query_u ="update qnaanswer set readingstatus=1 where readingstatus=0 and qnanumber=$number";
                                $result_u = $connect->query($query_u);
                                
                        }
                }
?>


<!-- 스크립트 처리 -->
<script>
    $(".dropdown").dropdown();

        function blind($num){
        var result = confirm("블라인드된 답변을 확인하시겠습니까?");
                if(result){
                //     $url='index.php?where=view_QnA&number='+$num;
                //         location.href=$url;
                        // 팝업창
                        var windowW = 600;  // 창의 가로 길이
                        var windowH = 700;  // 창의 세로 길이
                        var left = Math.ceil((window.screen.width - windowW)/2);
                        var top = Math.ceil((window.screen.height - windowH));
                        window.open("/popup/blind_QnA_answer.php?answer="+$num,"pop_01","l top="+top+", left="+left+", height="+windowH+",location=no,menubar=no, width="+windowW);
       
                }
        }

        function delContent(){
                // 질문 삭제
                var result = confirm("삭제시 복구되지 않습니다 정말 삭제하시겠습니까?");
                if(result){
                        post_to_url('./post/del_QnA_action.php', {'number':'<?=$number?>'});
                }
        }

        function delAnswerContent($num_a){
                // 답변 삭제
                var result = confirm("삭제시 복구되지 않습니다 정말 삭제하시겠습니까?");
                if(result){
                        post_to_url('./post/del_QnA_answer_action.php', {'qnanumber':'<?=$number?>','number':$num_a});
                }
        }

        //질문 신고
        function refort(){
                var result = confirm("정말 신고하시겠습니까? 신고를 하시면 철회가 불가능합니다. 신고수가 많은 게시글은 블라인드처리됩니다.");
                if(result){
                        var email = "<?php echo $_SESSION['useremail']?>";
                        var number = "<?php echo $number?>"
                        $.ajax({
                                url: "../ajax/refort_action.php", // 클라이언트가 HTTP 요청을 보낼 서버의 URL 주소
                                data: { whoRefort: email , num : number}, 
                                method: "POST",    
                                success: function($result){
                                        alert($result);
                                }
                        })
                }
        }

        //답변 신고
        function refortAnswer($num_a){
                var result = confirm("정말 신고하시겠습니까? 신고를 하시면 철회가 불가능합니다. 신고수가 많은 게시글은 블라인드처리됩니다.");
                if(result){
                        var email = "<?php echo $_SESSION['useremail']?>";
                        var number = $num_a;
                        $.ajax({
                                url: "../ajax/refort_answer_action.php", // 클라이언트가 HTTP 요청을 보낼 서버의 URL 주소
                                data: { whoRefort: email , num : number}, 
                                method: "POST",    
                                success: function($result){
                                        alert($result);
                                }
                        })
                }
        }
/*
 * path : 전송 URL
 * params : 전송 데이터 {'q':'a','s':'b','c':'d'...}으로 묶어서 배열 입력
 * method : 전송 방식(생략가능)
 */
function post_to_url(path, params, method) {
    method = method || "post"; // Set method to post by default, if not specified.
    // The rest of this code assumes you are not using a library.
    // It can be made less wordy if you use one.
    var form = document.createElement("form");
    form.setAttribute("method", method);
    form.setAttribute("action", path);
    for(var key in params) {
        var hiddenField = document.createElement("input");
        hiddenField.setAttribute("type", "hidden");
        hiddenField.setAttribute("name", key);
        hiddenField.setAttribute("value", params[key]);
        form.appendChild(hiddenField);
    }
    document.body.appendChild(form);
    form.submit();
}

        
</script>