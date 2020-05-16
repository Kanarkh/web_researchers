<div style="padding:50px">
<div class="ui placeholder segment" >
  <div class="ui two column very relaxed stackable grid">
    <div class="column">
      
      <form class="ui form" method="post" action="./post/login_action.php">

        <div class="field">
          <label>UserEmail</label>
          <div class="ui left icon input">
            <input type="email" placeholder="UserEmail" name="email">
            <i class="user icon"></i>
          </div>
        </div>
        <div class="field">
          <label>Password</label>
          <div class="ui left icon input">
            <input type="password" name="password">
            <i class="lock icon"></i>
          </div>
        </div>
        <button class="ui blue button" type="submit" style="width:500px">Login</button>
      
      </form>
    </div>
    <div class="middle aligned column">
      <div class="ui big button" onclick="location.href='index.php?where=signup'">
        <i class="signup icon"></i>
        Sign Up
      </div>
    </div>
    
  </div>
  <div class="ui vertical divider">
    Or
  </div>
</div>
</div>