
      <?php
                if(isset($_SESSION['nickname'])) {
                  // 세션 데이터가 있을시 php에서 수행할 동작
                        ?>
                        <!-- html에서 수행할 동작 -->
<div class="ui container" align=center >
<div  align=left>
<div class="ui segment">
  <h2 class="ui cnter floated header">연구 QnA 최신글</h2>
  <div class="ui clearing divider"></div>
  <p>1.</p>
</div>           
<div class="ui segment">
  <h2 class="ui cnter floated header">연구 제안 최신글</h2>
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
</div>                        
                        <!-- html에서 수행할 동작 끝-->
        <?php
                }
                else {
        ?>             
          <!-- 세션 데이터가 없을시 html에서 수행할 동작 -->
<div class="ui container" style="padding:20px" align=center>

<h3>'연구자들'에 오신걸 환영합니다. 이곳이 어떤곳인지 궁금하신가요?</h3>
<!-- accordion 시작 -->

<div class="ui styled accordion">
  <div class="title">
    <i class="dropdown icon"></i>
    이곳은 어떤 사이트인가요?
  </div>
  <div class="content">
    <p class="transition hidden">
    연구자들에 오신걸 환영합니다!<br>
    이곳은 여러 분야의 연구원들이 서로에게 질문을 할수도 있고 다른 분야의 연구원들과 연구팀을 만들수 있는 사이트입니다.
    </p>
  </div>
  <div class="title">
    <i class="dropdown icon"></i>
    연구 QnA는 뭘 하는 곳인가요?
  </div>
  <div class="content">
    <p class="transition hidden">There are many breeds of dogs. Each breed varies in size and temperament. Owners often select a breed of dog that they find to be compatible with their own lifestyle and desires from a companion.</p>
  </div>
  <div class="title">
    <i class="dropdown icon"></i>
    연구 제안은 언제 사용하는 곳인가요?
  </div>
  <div class="content">
    <p>Three common ways for a prospective owner to acquire a dog is from pet shops, private owners, or shelters.</p>
    <p>A pet shop may be the most convenient way to buy a dog. Buying a dog from a private owner allows you to assess the pedigree and upbringing of your dog before choosing to take it home. Lastly, finding your dog from a shelter, helps give a good home to a dog who may not find one so readily.</p>
  </div>
  <div class="title">
    <i class="dropdown icon"></i>
    인기 논문은 어떤걸 보여주나요?
  </div>
  <div class="content">
    <p>Three common ways for a prospective owner to acquire a dog is from pet shops, private owners, or shelters.</p>
    <p>A pet shop may be the most convenient way to buy a dog. Buying a dog from a private owner allows you to assess the pedigree and upbringing of your dog before choosing to take it home. Lastly, finding your dog from a shelter, helps give a good home to a dog who may not find one so readily.</p>
  </div>
  <div class="title">
    <i class="dropdown icon"></i>
    토론&토의는 어떻게 사용하나요?
  </div>
  <div class="content">
    <p>Three common ways for a prospective owner to acquire a dog is from pet shops, private owners, or shelters.</p>
    <p>A pet shop may be the most convenient way to buy a dog. Buying a dog from a private owner allows you to assess the pedigree and upbringing of your dog before choosing to take it home. Lastly, finding your dog from a shelter, helps give a good home to a dog who may not find one so readily.</p>
  </div>
</div>
<!-- accordion 종료 -->
</div>  

<script>
    $('.ui.accordion').accordion();
</script>
<!-- 세션 데이터가 없을시 html에서 수행할 동작끝 -->

        <?php   } ?>