<?php
            

                // DB 초기화
                $connect = mysqli_connect('localhost', 'root', 'lunatic8911', 'researchers') or die ("connect fail");
                $nickname = $_SESSION['nickname'];
                $query = "select * from users where nickname ='$nickname'";
                $result = $connect->query($query);
                $total = mysqli_num_rows($result);
                $rows = mysqli_fetch_assoc($result);

        ?>

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

<h3 align=center>내정보</h3>

<!-- DB 설정 -->
<?php
    $connect = mysqli_connect('localhost', 'root', 'lunatic8911', 'researchers') or die ("connect fail");
    $query ="SELECT title FROM major GROUP BY title;";
    $result = $connect->query($query);
    $query_detail ="SELECT title, details FROM major WHERE details is NOT NULL;";
    $result_detail = $connect->query($query_detail);
    $total = mysqli_num_rows($result_detail);
?>

<!-- Container -->
<div class="ui container" style="padding:20px; width:700px" align=center >
<form class="ui form" method="post" action="./post/edit_myinfo.php">
  
  <!-- input -->
  <div class="field ">
    <label align=left>이메일</label>  
    <div class="ui disabled input">    
    <input  type="email" id="email" name="email" placeholder="이메일을 입력해주세요" value="<?php echo $rows['email']?>">
    </div>
  </div>
  
  <div class="field">
    <label align=left>닉네임(10글자 미만)</label>      
    <div class="ui disabled input">    
        <input type="text" maxlength="10" id="nickname" name="nickname" placeholder="닉네임을 입력해주세요"  value="<?php echo $rows['nickname']?>">
</div>
  </div>

  <!-- <div class="field">
    <label align=left>현재 비밀번호</label>
    <input type="password" id="prepassword" name="prepassword" placeholder="비밀번호를 입력해주세요" onchange="pwCheck();">
  </div> -->

  <div class="field">
    <label align=left>비밀번호 변경(6자 이상)</label>
    <input type="password" id="password" name="password" placeholder="비밀번호를 입력해주세요" onchange="pwChange();">
  </div>

  <div class="field">
    <label align=left>비밀번호 변경 확인</label>
    <input type="password" id="passwordCheck" name="passwordCheck" placeholder="비밀번호를 다시 한번 입력해주세요" onchange="pwChange();">
  </div>

  
<!-- dropdown -->

<div class="two fields" align=left>
    <div class="field">
      <label>학문분류</label>
    <select class="ui fluid dropdown"  name="major_title" id="sidoSelect" onChange="changeSidoSelect();">
      <option value="">학문분류를 선택해주세요</option>
    </select>
    </div>

    <div class="field">
      <label>세부분류</label>
      <select class="ui fluid dropdown"  name="major_detail" id="gugunSelect" >
      <option value="">세부분류를 선택해주세요</option>
    </select>
    </div>

  </div>
  
  <input type="hidden" id="hiddeneps" name="hiddeneps" value="">
  <input type="hidden" id="hiddenpwck" name="hiddenpwck" value="">
  <button class="ui primary button" type="submit" style="width:650px">정보 수정</button>
  <div class="ui error message"></div>
</form>
</div>

<script>

    // function pwCheck(){

    //   var check = document.getElementById("hiddeneps");
    //   var mps = document.getElementById("prepassword");
    //   var nvalue =mps.value;
    //   $.ajax({
    //   url: "../ajax/signupcheck.php", // 클라이언트가 HTTP 요청을 보낼 서버의 URL 주소
    //   data: { type: "pw", value: nvalue},                         // HTTP 요청과 함께 서버로 보낼 데이터
    //   type: "POST",                             // HTTP 요청 방식(GET, POST)

    //   success: function($result){
    //     alert($result);
    //     // 결과체크
    //     if($result.match(/ok/)){
    //       check.value ='ok';
    //     }else if($result.match(/no/)){
    //       check.value ='';
    //     }
    //   }
    //   })
    
    // }

    function pwChange(){
      var chack = document.getElementById("hiddenpwck");
      
      var pw = document.getElementById("password");
      var mpw =pw.value;
      var pwc = document.getElementById("passwordCheck");
      var mpwc =pwc.value;
      if(mpw == mpwc){
        chack.value ='ok';
      }else{
        chack.value ='';
      }
    }
    $('.ui.checkbox').checkbox('set unchecked','toggle');
    $('.ui.dropdown').dropdown({
        direction:'auto',
        duration:50,
    });
</script>

<!-- test  -->

<?php
// $Roomidx = "<script>document.write (Roomidx);</script>";
// echo $Roomidx;
?>



<script>
$('.ui.form')
  .form({
    fields: {
      
      password: {
        identifier: 'password',
        rules: [
          {
            type   : 'empty',
            prompt : '비밀번호를 입력해주세요'
          },
          {
            type   : 'minLength[6]',
            prompt : '비밀번호를 6자리 이상 입력해주세요'
          }
        ]
      },
      password1: {
        identifier: 'passwordCheck',
        rules: [
          {
            type   : 'empty',
            prompt : '비밀번호 확인을 입력해주세요'
          }
        ]
      },
      
      name4: {
        identifier: 'hiddenpwck',
        rules: [
          {
            type   : 'empty',
            prompt : '변경 비밀번호가 비밀번호 변경 확인과 다릅니다'
          }
        ] 
      },
      name5: {
        identifier: 'hiddeneps',
        rules: [
          {
            type   : 'empty',
            prompt : '현재 비밀번호가 틀렸습니다.'
          }
        ] hiddeneps
      },
      minCount: {
        identifier  : 'major_title',
        rules: [
          {
            type   : 'minCount[1]',
            prompt : '학문분류를 선택해주세요'
          }
        ]
      },
      minCount1: {
        identifier  : 'major_detail',
        rules: [
          {
            type   : 'minCount[1]',
            prompt : '세부분류를 선택해주세요'
          }
        ]
      }
    }});
</script>