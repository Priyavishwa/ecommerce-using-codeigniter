


<!-- catg header banner section -->
<section id="aa-catg-head-banner">
    <img src="<?php echo base_url('assets/dailyShop/img/fashion/fashion-header-bg-8.jpg')?>" alt="fashion img">
    <div class="aa-catg-head-banner-area">
     <div class="container">
      <div class="aa-catg-head-banner-content">
        <h2>Account Page</h2>
        <ol class="breadcrumb">
          <li><a href="index.html">Home</a></li>                   
          <li class="active">Account</li>
        </ol>
      </div>
     </div>
   </div>
  </section>
  <!-- / catg header banner section -->

<!-- Cart view section -->
<section id="aa-myaccount">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
        <div class="aa-myaccount-area">         
            <div class="row">
              <div class="col-md-12">
                <?php echo validation_errors(); ?>
                <?php echo checkFlash(); ?>
                <!--
                <div class="aa-myaccount-login">
                <h4>Login</h4>
                 <form action="<?php //echo site_url('signup/newUser') ?>" method="post" class="aa-login-form">
                  <label for="">Username or Email address<span>*</span></label>
                   <input type="text" placeholder="Username or email">
                   <label for="">Password<span>*</span></label>
                    <input type="password" placeholder="Password">
                    <button type="submit" class="aa-browse-btn">
                      <a href="<?php //echo site_url('login')?>">Login</a>
                    </button>
                    <label class="rememberme" for="rememberme"><input type="checkbox" id="rememberme"> Remember me </label>
                    <p class="aa-lost-password"><a href="#">Lost your password?</a></p>
                  </form>
                </div>
              </div> -->
              <div class="col-md-12">
                <div class="aa-myaccount-register">                 
                 <h4>Register</h4>
                 <form action="<?php echo site_url('signup/newUser') ?>" method="post" class="aa-login-form">
                    <label for="">First Name<span>*</span></label>
                    <input type="text" name="firstName" id="LoginFormName1" class="form-control" placeholder="First Name">
                    <label for="">Last Name<span>*</span></label>
                    <input type="text" name="lastName" id="LoginFormName1" class="form-control" placeholder="Last Name">
                    <label for="">Username or Email address<span>*</span></label>
                    <input type="text" name="email" placeholder="Username or email">
                    <label for="">Password<span>*</span></label>
                    <input type="password" name="password" placeholder="Password">
                    <button type="submit" class="aa-browse-btn">Register</button>                    
                  </form>
                </div>
              </div>
            </div>          
         </div>
       </div>
     </div>
   </div>
 </section>
 <!-- / Cart view section -->

<!--
<div class="container offset-14">
  <h1 class="block-title large" align="center">CREATE AN ACCOUNT</h1>
  <div class="row">
    <div class="col-sm-8 col-sm-push-2 col-lg-6 col-lg-push-3">
      <div class="login-form-box">
        <h2 class="text-uppercase">PERSONAL INFORMATION</h2>
        <form method="post" action="<?php //echo site_url('signup/newUser') ?>" id="create_customer" accept-charset="UTF-8" onsubmit="window.Shopify.recaptchaV3.addToken(this, &quot;create_customer&quot;); return false;"><input type="hidden" name="form_type" value="create_customer"><input type="hidden" name="utf8" value="✓">
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon">
                <span class="fa fa-user icon"></span>
              </span>
              <input type="text" name="firstName" id="LoginFormName1" class="form-control" placeholder="First Name">
            </div>
          </div>

          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon">
                <span class="fa fa-user icon"></span>
              </span>
              <input type="text" name="lastName" id="LoginFormName1" class="form-control" placeholder="Last Name">
            </div>
          </div>
         
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon">
                <span class="fa fa-envelope icon"></span>
              </span>
              <input type="email" name="email" id="LoginEmail" class="form-control" placeholder="Email">
            </div>
          </div>
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon">
                <span class="fa fa-key icon"></span>
              </span>
              <input type="password" name="password" id="LoginFormPass1" class="form-control" placeholder="Password">
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="button-block">
                <button type="submit" class="btn btn-primary">CREATE</button>
              </div>
            </div>
            
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
-->