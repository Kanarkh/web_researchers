
<?php
                // qna DB 초기화
                $connect = mysqli_connect('localhost', 'root', 'lunatic8911', 'researchers') or die ("connect fail");
                $number = $_GET['number'];
                $query = "select * from qnaboard where number =$number";
                $result = $connect->query($query);
                $total = mysqli_num_rows($result);
                $rows = mysqli_fetch_assoc($result);
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
                                
                // qna answer DB 초기화
                $answerNum = $_GET['answer'];
                $query_a = "select * from qnaanswer where qnanumber =$number and number=$answerNum";
                $result_a = $connect->query($query_a);
                $total = mysqli_num_rows($result_a);
                $rows_a = mysqli_fetch_assoc($result_a);

                // 예외처리 존재하지 않는 번호로 접근했을시
                if(!$total){
                        $URL = '../index.php?menu=ResearchQnA';                   //return URL
                        ?>
                        <script>
                        alert("<?php echo "수정할 글이 존재하지 않습니다"?>");
                        location.replace("<?php echo $URL?>");
                        </script>
                        <?php
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


<!-- 답변하기 로그인된 회원중 질문자가 아닌 경우에만 답변하기가 활성화된다. -->
<?php 
  if(!isset($_SESSION['useremail'])){
          ?>
  <!-- 로그인 되있지 않다면 -->
    <!-- end -->
    <?php
    } else{
    if($_SESSION['useremail']!=$quseremail){?>

<!-- 답변수정하기 -->
<form class="ui form" method="post" action="../post/edit_QnA_answer_action.php">  

<!-- 답변작성 -->
<div class="field">
<label align=left>- 답변내용 -</label>
<textarea name ="content" cols=85 rows=12><?php echo $rows_a['content']?></textarea> 
</div>
<input type="hidden" name="qnanumber" value="<?php echo $number?>">
<input type="hidden" name="number" value="<?php echo $rows_a['number']?>">
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



<!-- 스크립트 처리 -->
<script>
    $(".dropdown").dropdown();
    
        function delContent(){
                var result = confirm("삭제시 복구되지 않습니다 정말 삭제하시겠습니까?");
                if(result){
                        post_to_url('./post/del_QnA_action.php', {'number':'<?=$number?>'});
                }
        }

        //신고
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