<?php
$connect = mysqli_connect('localhost', 'root', 'lunatic8911', 'researchers') or die ("connect fail");
$query ="select * from qnaboard order by number desc";
$result = $connect->query($query);
$total = mysqli_num_rows($result);
 ?>

<div class="ui container" align=center style="padding:20px" >
<h3 align=center>연구 QnA 게시판</h3>

<!-- table -->
<table class="ui grey table" style="table-layout:fixed" >  
    <!-- black -->
  <thead align=center>
    <tr>
    <th style="width:50px">No</th>
    <th style="width:80px">분야</th>
    <th>질문</th>
    <th class="right aligned" style="width:100px">질문자</th>
    <th class="right aligned" style="width:100px">날짜</th>
    <th class="right aligned" style="width:80px">답변수</th>
    <th class="right aligned" style="width:80px">조회수</th>
    </tr>
  </thead>
  <tbody id="boardTbody">
    <!-- DB에서 글목록 가져오기. -->
    <?php
    while($rows = mysqli_fetch_assoc($result)){
      ?>
      <tr align=center>
      <td ><?php echo $rows['number'] ?></td>
      <td class="left aligned" ><?php echo $rows['majordetail'] ?></td>
      <?php 
      // 블라인드 조건문
      if($rows['refortnum']>=1){  
      ?>
       <!--블라인드 처리  -->
      <td style="overflow:hidden;white-space:nowrap;text-overflow:ellipsis;"><a style="color:#92B3B7" onClick="blind(<?php echo $rows['number']?>)" >블라인드 처리된 게시글입니다.</td>
      
      <?php 
      }else{
      ?>
        <!--일반 게시판  -->
        <td style="overflow:hidden;white-space:nowrap;text-overflow:ellipsis;"><a href ="index.php?where=view_QnA&number=<?php echo $rows['number']?>"><?php echo $rows['title'] ?></td>
        <?php
      }
      ?>
      <td class="right aligned" style="overflow:hidden;white-space:nowrap;text-overflow:ellipsis;"><?php echo $rows['nickname'] ?></td>
      <td class="right aligned"><?php echo $rows['date'] ?><br><?php echo $rows['time'] ?></td>
      <td class="right aligned"><?php echo $rows['answernum'] ?></td>
      <td class="right aligned"><?php echo $rows['hit'] ?></td>
      </tr>
      <?php
    }
    ?>
  </tbody>
</table>
<!-- end table -->
<!-- 검색 & 질문하기 버튼 -->
<div class="ui four column grid" style="padding-bottom:15px;">
        <div class="twelve wide column" align=left>
        <!-- 검색기간 -->
        <select class="ui dropdown" id="qnaPeriodDrop" > 
            <option value="0">전체기간</option>
            <option value="1">1일전</option>
            <option value="2">1주전</option>
            <option value="3">1개월</option>
            <option value="4">6개월</option>
            <option value="5">1년</option>
        </select>
        <!-- 검색목표 -->
        <select class="ui dropdown" id="qnaTargetDrop">
            <option value="0">제목+내용</option>
            <option value="1">제목</option>
            <option value="2">내용</option>
            <option value="3">글작성자</option>
        </select>
            <div class="ui input"><input type="text" placeholder="Search..." id="inputSearch"></div>
            <!-- 검색버튼 -->
            <button class="ui secondary button" onClick="searchClick();">Search</button>
        </div>
        <!-- 질문하기 버튼 -->
        <div class="column"><div align=right><button class="ui secondary button" onclick="location.href='index.php?where=write_QnA'">질문하기</button></div></div>
</div>

<!-- 아래 페이징 -->
<div class="ui pagination menu" id="pagingMenu">

  <?php
    $pageNum=($total/10);
  ?>
    
  <?php  
    for($i=0; $i<$pageNum; $i++){
  ?>
  <a class="item"><?=$i+1?></a>
  <?php
    }
  ?>

  <?php
  ?>
  <!-- <a class="item"><i class="angle left icon"></i></a>
  <a class="active item">1</a>
  <a class="item">2</a>
  <a class="item">3</a>
  <a class="item">4</a>
  <a class="item">5</a>
  <a class="item">6</a>
  <a class="item">7</a>
  <a class="item">8</a>
  <a class="item">9</a>
  <a class="item">10</a>
  <a class="item"><i class="angle right icon"></i></a> -->

<!-- end pagination menu -->
</div>

<!-- end container -->
</div>

<script>
  var dateSet = "0";
  var targetSet = "0";
  $('.ui .item').on('click', function() {
      $('.ui .item').removeClass('active');
      $(this).addClass('active');
   });
  //  기간설정 
   $('#qnaPeriodDrop').dropdown({
      onChange:function(value,text,$choice){
        dateSet = value;
      }
   });
  //  검색 설정
   $('#qnaTargetDrop').dropdown({
      onChange:function(value,text,$choice){
        targetSet = value;
      }
   });

  function blind($num){
    var result = confirm("신고가 많이된 게시글입니다. 정말 보시겠습니까?");
                if(result){
                    $url='index.php?where=view_QnA&number='+$num;
                        location.href=$url;
                }
  }

  // 검색버튼 클릭
  function searchClick(){
    
    var inputSearch = document.getElementById("inputSearch");
    var word = inputSearch.value;
  
    
    // 검색 기간 설정
    if(dateSet == "0"){
      // 전체기간
      
    }else if(dateSet == "1"){
      //1일전
      var nowDate = new Date();
      var yesterDate = nowDate.getTime() - (1 * 24 * 60 * 60 * 1000);
      nowDate.setTime(yesterDate);
 
      var yesterYear = nowDate.getFullYear();
      var yesterMonth = nowDate.getMonth() + 1;
      var yesterDay = nowDate.getDate();
        
      if(yesterMonth < 10){ yesterMonth = "0" + yesterMonth; }
      if(yesterDay < 10) { yesterDay = "0" + yesterDay; }
        
      dateSet = yesterYear + "-" + yesterMonth + "-" + yesterDay;

    }else if(dateSet == "2"){
      //1주전
      var nowDate = new Date();
      var weekDate = nowDate.getTime() - (7 * 24 * 60 * 60 * 1000);
      nowDate.setTime(weekDate);

      var weekYear = nowDate.getFullYear();
      var weekMonth = nowDate.getMonth() +1;
      var weekDay = nowDate.getDate();

      if(weekMonth <10){ weekMonth ="0"+weekMonth;}
      if(weekDay<10){weekDay = "0"+weekDay;}

      dateSet = weekYear + "-" + weekMonth + "-" +weekDay;

    }else if(dateSet == "3"){
      //한달전
      var nowDate = new Date();
      var monthDate = nowDate.getTime() - (30 * 24 * 60 * 60 * 1000);
      nowDate.setTime(monthDate);
 
      var monthYear = nowDate.getFullYear();
      var monthMonth = nowDate.getMonth() + 1;
      var monthDay = nowDate.getDate();
        
      if(monthMonth < 10){ monthMonth = "0" + monthMonth; }
      if(monthDay < 10) { monthDay = "0" + monthDay; }
        
      dateSet = monthYear + "-" + monthMonth + "-" + monthDay;
    }else if(dateSet == "4"){
      //6개월전
      var nowDate = new Date();
      var monthDate = nowDate.getTime() - (182 * 24 * 60 * 60 * 1000);
      nowDate.setTime(monthDate);
 
      var monthYear = nowDate.getFullYear();
      var monthMonth = nowDate.getMonth() + 1;
      var monthDay = nowDate.getDate();
        
      if(monthMonth < 10){ monthMonth = "0" + monthMonth; }
      if(monthDay < 10) { monthDay = "0" + monthDay; }
        
      dateSet = monthYear + "-" + monthMonth + "-" + monthDay;
    }else if(dateSet == "5"){
      //1년전
      var nowDate = new Date();
      var yearDate = nowDate.getTime() - (365 * 24 * 60 * 60 * 1000);
      nowDate.setTime(yearDate);
 
      var yearYear = nowDate.getFullYear();
      var yearMonth = nowDate.getMonth() + 1;
      var yearDay = nowDate.getDate();
        
      if(yearMonth < 10){ yearMonth = "0" + yearMonth; }
      if(yearDay < 10) { yearDay = "0" + yearDay; }
        
      dateSet = yearYear + "-" + yearMonth + "-" + yearDay;
    }

    // Ajax 설정
    $.ajax({
    url: "../ajax/qna_search.php", // 클라이언트가 HTTP 요청을 보낼 서버의 URL 주소
    data: { date: dateSet, targetNum: targetSet, searchWord : word },                         // HTTP 요청과 함께 서버로 보낼 데이터
    
    success: function($result){
      var $mSplit = $result.split('(@)&)(');
      
      //게시글 부분
      if($mSplit[0].length!=0){
      var mTbody = document.getElementById("boardTbody");
      mTbody.innerHTML="";
      //mTbody.innerHtml="$mSplit[0]";
      mTbody.insertAdjacentHTML('beforeend',$mSplit[0]);
      }
      else{
        alert("검색결과가 없습니다");
      }

      //페이징 부분 pagingMenu
      //alert($mSplit[1]);
      var mPaging = document.getElementById("pagingMenu");
      mPaging.innerHTML="";
      //mPaging.innerHtml="$mSplit[1]";
      mPaging.insertAdjacentHTML('beforeend',$mSplit[1]);
    }
    })
    
    // alert(word +" "+ dateSet + targetSet );
    
  }

</script>