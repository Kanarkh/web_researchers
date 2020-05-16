<?php
// DBSET
$connect = mysqli_connect('localhost', 'root', 'lunatic8911', 'researchers') or die ("connect fail");
$query ="select * from qnaboard order by number desc";  //전체검색 desc : 내림차순

//get data
$dateSet = $_GET['date'] ; //검색기간
$nowDate = date('Y-m-d');  //오늘
$targetSet = $_GET['targetNum']; //검색조건 (내용,제목,글작성자)
$word = $_GET['searchWord'];

if($dateSet!=0){
  //검색기간

  if($word!=""){ //검색어 존재
  $query = " select * from qnaboard where date between date('$dateSet') and date('$nowDate')";
  switch($targetSet){
    case "0":
    // 제목 + 내용
    $query =$query."and title LIKE '%$word%' or content LIKE '%$word%'";
    break;
    case "1":
    //제목
    $query =$query."and title LIKE '%$word%'";
    break;
    case "2":
    //내용
    $query =$query."and content LIKE '%$word%'";
    break;
    case "3":
    //글작성자
    $query =$query."and nickname LIKE '%$word%'";
    break;
  }
  $query=$query."order by number desc";
  $result = $connect->query($query);
  $total = mysqli_num_rows($result);

  }else{ 
    //검색어가 존재하지 않음 전체검색한다.
    $query = " select * from qnaboard where date between date('$dateSet') and date('$nowDate')";
    $query=$query."order by number desc";
    $result = $connect->query($query);
  }

}else{
  //전체기간
  if($word!=""){ //검색어 존재
  $query = " select * from qnaboard ";
  switch($targetSet){
    case "0":
    // 제목 + 내용
    $query =$query."where title LIKE '%$word%' or content LIKE '%$word%'";
    break;
    case "1":
    //제목
    $query =$query."where title LIKE '%$word%'";
    break;
    case "2":
    //내용
    $query =$query."where content LIKE '%$word%'";
    break;
    case "3":
    //글작성자
    $query =$query."where nickname LIKE '%$word%'";
    break;
  }
  $query=$query."order by number desc";
  $result = $connect->query($query);
  }else{
    //검색어가 존재하지 않음
    $query = " select * from qnaboard ";
  $query=$query."order by number desc";
  $result = $connect->query($query);
  }
}
?>

<?php
    $total = mysqli_num_rows($result);
    
    if($total==0){
      // echo "NoSearchResults";
      //데이터가 없는경우의 안내를 여기서 처리하고싶으면 여기에 코드를 작성하면 된다.
    }
    while($rows = mysqli_fetch_assoc($result)){
      ?>
      <tr align=center>
      <td ><?php echo $rows['number'] ?></td>
      <td class="left aligned" ><?php echo $rows['majordetail'] ?></td>
      <td style="overflow:hidden;white-space:nowrap;text-overflow:ellipsis;"><a href ="index.php?where=view_QnA&number=<?php echo $rows['number']?>"><?php echo $rows['title'] ?></td>
      <td class="right aligned" style="overflow:hidden;white-space:nowrap;text-overflow:ellipsis;"><?php echo $rows['nickname'] ?></td>
      <td class="right aligned"><?php echo $rows['date'] ?><br><?php echo $rows['time'] ?></td>
      <td class="right aligned"><?php echo $rows['answernum'] ?></td>
      <td class="right aligned"><?php echo $rows['hit'] ?></td>
      </tr>
      <?php
    }
?>
<!-- split을 위한 구분자 -->
(@)&)( 

<!-- 여기부터는 페이징에 관련된 코드를 만들어준다. -->

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