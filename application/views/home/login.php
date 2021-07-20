





<!-- catg header banner section -->
<section id="aa-catg-head-banner">
    <img src="<?php echo base_url('assets/dailyShop/img/fashion/fashion-header-bg-8.jpg')?>" alt="fashion img">
    <div class="aa-catg-head-banner-area">
     <div class="container">
      <div class="aa-catg-head-banner-content">
        <h2>Account Page</h2>
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url('home') ?>">Home</a></li>                   
          <li class="active">Login</li>
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
            <?php echo checkFlash(); ?>
              <div class="col-md-12">
                <div class="aa-myaccount-login">
                <h4>Login</h4>
                 <form action="<?php echo site_url('login/checkUser')?>" method="post" class="aa-login-form">
                  <label for="">Username or Email address<span>*</span></label>
                   <input type="text" name="email" placeholder="Username or email">
                   <label for="">Password<span>*</span></label>
                    <input type="password" name="password" placeholder="Password">
                    <button type="submit" class="aa-browse-btn">
                      <a href="">Login</a>
                    </button>
                    <label class="rememberme" for="rememberme"><input type="checkbox" id="rememberme"> Remember me </label>
                    <p class="aa-lost-password"><a href="#">Lost your password?</a></p>
                  </form>
                </div>
              </div>
                
         </div>
       </div>
     </div>
   </div>
 </section>