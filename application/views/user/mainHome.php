

<!-- catg header banner section -->
<section id="aa-catg-head-banner">
    <img src="<?php echo base_url('assets/dailyShop/img/fashion/fashion-header-bg-8.jpg')?>" alt="fashion img">
    <div class="aa-catg-head-banner-area">
     <div class="container">
      <div class="aa-catg-head-banner-content">
        <h2>User page</h2>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url('') ?>">Home</a></li>                   
          <li class="active">User</li>
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
            <h1>Welcome <?php echo $this->session->userdata('uFirstName'); ?> </h1>
            </div>
                
         </div>
       </div>
     </div>
   </div>
 </section>