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

                // DB 초기화
                $connect = mysqli_connect('localhost', 'root', 'lunatic8911', 'researchers') or die ("connect fail");
                $number = $_GET['number'];
                $query = "select * from qnaboard where number =$number";
                $result = $connect->query($query);
                $total = mysqli_num_rows($result);
                $rows = mysqli_fetch_assoc($result);

                // 예외처리 존재하지 않는 번호로 접근했을시
                if(!$total){
                        $URL = '../index.php?menu=ResearchQnA';                   //return URL
                        ?>
                        <script>
                        alert("<?php echo "수정할 게시글이 존재하지 않습니다"?>");
                        location.replace("<?php echo $URL?>");
                        </script>
                        <?php
                }                
        ?>

 

<!-- 질문게시판  -->

<!-- 학문분류 리스트 만들기 -->
<script type="text/javascript">
//대분류
var firstList = new Array("간호학","경영학","공학","교육","농학","법학","보건학","사회과학","생명과학","생활과학","수의학","약학","예술","의학","인문학","자연과학");

//중분류 대분류와 순서를 맞출것.
// 간호학↓
var secondList1 = new Array("간호학");
// 경영학↓
var secondList2 = new Array("경영학","기술경영경제정책");
// 공학↓
var secondList3 = new Array("건설환경공학","건축학","교통공학","기계항공공학","기술경영경제정책","뇌과학","바이오소재공학","바이오시스템공학","산업공학","산업디자인학","생명공학","에너지공학","원자력공학","융합기술공학","재료/신소재공학","전기/전자공학","조선공학","지역시스템공학","컴퓨터공학","화학공학");
// 교육↓
var secondList4 = new Array("교육학","국어교육","독어교육","물리교육","불어교육","사회교육","생물교육","수학교육","역사교육","영어교육","윤리교육","지구과학교육","지리교육","체육교욱","화학교육");
// 농학↓
var secondList5 = new Array("농경제학","동물생명공학","바이오소재공학","산립환경학","산업인력개발학","생물학","생태조경학","생화학","식품공학","원예학","작물생명과학","지역사회개발학","지역시스템공학","환경재료과학");
// 법학↓
var secondList6 = new Array("법학");
// 보건학↓
var secondList7 = new Array("보건학");
// 사회과학↓
var secondList8 = new Array("경제학","기술경영경제정책","농경제학","문헌정보학","사회복지학","사회학","심리학","언론정보학","인류학","정치외교학","지리학","지역사회개발학","행정학");
// 생명과학↓
var secondList9 = new Array("농경제학","동뭉생명공학","바이오소재공학","바이오시스템공학","산림환경학","산업인력개발학","생명공학","생명과학","생물학","생태조정학","생화학","식품공학","원예학","의과학","작물생명과학","지역사회개발학","지역시스템공학","환경재료과학");
// 생활과학↓
var secondList10 = new Array("소비자학","식품영약학","아동가족학","의류학");
// 수의학↓
var secondList11 = new Array("수의학");
// 약학↓
var secondList12 = new Array("약학");
// 예술↓
var secondList13 = new Array("국악","가악","동양화","디자인","산업디자인학","서양화","성악","작곡","조소");
// 의학↓
var secondList14 = new Array("의학","치의학","한의학");
// 인문학↓
var secondList15 = new Array("국사학","국어국문학","노어노문학","독어독문학","동양사학","미술사학","미학","불어불문학","서양사학","서어서문학","아시아언어문명학","언어학","영어영문학","종교학","중어중문학","철학");
// 자연과학↓
var secondList16 = new Array("뇌과학","물리학","생명과학","생물학","생화학","수학","의과학","지구과학","통계학","화학");

// 페이지 로딩시 자동 실행
window.onload = function(){
    var v_sidoSelect = document.getElementById("sidoSelect"); // SELECT TAG
      
    for (i =0 ; i<firstList.length; i++){// 0 ~ 3 
        // 새로운 <option value=''>값</option> 태그 생성
        var optionEl = document.createElement("option");
  
        // option태그에 value 속성 값으로 저장
        optionEl.value = firstList[i];
      
        // text 문자열을 새로 생성한 <option> 태그의 값으로 추가
        optionEl.appendChild (document.createTextNode(firstList[i]));
        
        //이전 전공title 값 가져오기
        if(firstList[i] == "<?php echo $rows['majortitle']?>"){
        optionEl.selected = true;
        }
        // 만들어진 option 태그를 <select>태그에 추가
        v_sidoSelect.appendChild(optionEl);
    }
    var v_gugunSelect = document.getElementById("gugunSelect"); // SELECT TAG
    
    //중분류 생성하기
    var v_sidoSelect = document.getElementById("sidoSelect"); // SELECT TAG
    var idx = v_sidoSelect.options.selectedIndex;     // 선택값 0 ~ 17
    
    if (idx < 1 && idx > 17){
        return;
    }
 
    gugunSelectFill(idx);   // 중분류 생성
}
// 대분류 선택시
function changeSidoSelect(){
    var v_sidoSelect = document.getElementById("sidoSelect"); // SELECT TAG
    var idx = v_sidoSelect.options.selectedIndex;     // 선택값 0 ~ 17
    
    if (idx < 1 && idx > 17){
        return;
    }
 
    gugunSelectFill(idx);   // 중분류 생성
}

//중분류 생성
function gugunSelectFill(idx){
    var v_gugunSelect = document.getElementById("gugunSelect"); // SELECT TAG
    var data = null;

    if (idx == 1){data = secondList1}
    if (idx == 2){data = secondList2}
    if (idx == 3){data = secondList3}
    if (idx == 4){data = secondList4}
    if (idx == 5){data = secondList5}
    if (idx == 6){data = secondList6}
    if (idx == 7){data = secondList7}
    if (idx == 8){data = secondList8}
    if (idx == 9){data = secondList9}
    if (idx == 10){data = secondList10}
    if (idx == 11){data = secondList11}
    if (idx == 12){data = secondList12}
    if (idx == 13){data = secondList13}
    if (idx == 14){data = secondList14}
    if (idx == 15){data = secondList15}
    if (idx == 16){data = secondList16}
    if (idx == 17){data = secondList17}

    v_gugunSelect.innerHTML = "";  // 태그 출력
      
    for (i =0 ; i<data.length; i++){ 
        // 새로운 <option value=''>값</option> 태그 생성
        var optionEl = document.createElement("option");
  
        // value 속성 태그에 저장
        optionEl.value = data[i];
      
        // text 문자열을 새로 생성한 <option> 태그에 추가
        optionEl.appendChild (document.createTextNode(data[i]));
        
        //이전 전공title 값 가져오기
        if(data[i] == "<?php echo $rows['majordetail']?>"){
        optionEl.selected = true;
        }

        // 만들어진 option 태그를 <select>태그에 추가
        v_gugunSelect.appendChild(optionEl);
    }
  
v_gugunSelect.style.display = ""; // 중분류 태그 출력
  
}

</script>

<h3 align=center>질문 수정하기</h3>


<!-- Container -->
<div class="ui container" style="padding:20px; width:700px" align=center >
<form class="ui form" method="post" action="./post/edit_QnA_action.php">
  
<!-- dropdown -->

<div class="two fields" align=left>
    <div class="field">
    <label>- 질문분류 -</label>
    <select class="ui fluid dropdown"  name="major_title" id="sidoSelect" onChange="changeSidoSelect();">
      <option value="" >학문분류를 선택해주세요</option>
    </select>
    </div>

    <div class="field">
    <label>　</label>
      <select class="ui fluid dropdown"  name="major_detail" id="gugunSelect" >
      <option value="">세부분류를 선택해주세요</option>
    </select>
    </div>

</div>
<!-- 질문 제목 -->
<div class="field">
    <label align=left>- 질문제목 -</label>
    <input type="text" maxlength="75" name="title" placeholder="내용을 쉽게 알수있도록 질문을 입력해주세요" value="<?php echo $rows['title']?>">
</div>

<!-- 글 작성하기 -->
<div class="field">
<label align=left>- 질문내용 -</label>
<textarea name ="content" cols=85 rows=15><?php echo $rows['content']?></textarea>
</div>

<!-- 글 작성 -->
  <input type="hidden" name="number" value="<?=$number?>">
  <button class="ui primary button" type="submit" style="width:650px">질문 작성</button>
</form>
</div>

<script>
    $('.ui.checkbox').checkbox('set unchecked','toggle');
    $('.ui.dropdown').dropdown({
        direction:'auto',
        duration:50,
    });
</script>

<!-- test  -->

<?php
$Roomidx = "<script>document.write (Roomidx);</script>";
echo $Roomidx;
?>