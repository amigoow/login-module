


  <section id="container" >
      <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
      <!--header start-->
        <?php $this->view('admin/sub-header.php'); ?>
      <!--header end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
      <!--sidebar start-->
      <?php $this->view('admin/left-sidebar.php') ?>
      <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content" >
          <section class="wrapper">

              <div class="row">
                  <div class="col-lg-12 main-chart">
                  
                  	<div class="row mtbox">
                  		<div class="col-md-2 col-sm-2 col-md-offset-1 box0">
                  			<div class="box1">
					  			<span class="li_heart"></span>
					  			<h3>933</h3>
                  			</div>
					  			<p>933 People liked your page the last 24hs. Whoohoo!</p>
                  		</div>
                  
                  <a href="<?php echo base_url() . 'profile/'.$_SESSION['username'] ?>">
                    <div class="col-md-2 col-sm-2 box0">
                			<div class="box1">
      					  			<span class="li_stack"></span>
      					  			<h3><?php echo '/' . $_SESSION["username"]; ?></h3>
                      </div>
      					  		<p>Click to view your public account</p>
                    </div>
                  </a>
                  		<div class="col-md-2 col-sm-2 box0">
                  			<div class="box1">
					  			<span class="li_news"></span>
					  			<h3>+10</h3>
                  			</div>
					  			<p>More than 10 news were added in your reader.</p>
                  		</div>
                  		<div class="col-md-2 col-sm-2 box0">
                  			<div class="box1">
					  			<span class="li_data"></span>
					  			<h3>OK!</h3>
                  			</div>
					  			<p>Your server is working perfectly. Relax & enjoy.</p>
                  		</div>
                  	
                  	</div><!-- /row mt -->	
                  
                      

                  <!-- SERVER STATUS PANELS -->
                  <div class="my_accounts">
                    <h3 class="text-center">My Accounts </h3>
                      
                     <!-- TO BE POPULATED BY ASSETS/JS/ADMIN/AJAX_CALLS.JS -->

                    </div>
                  	
  	
                  </div><!-- /row -->
                    
                    				
				
					
					
					
                  </div><!-- /col-lg-9 END SECTION MIDDLE -->
                  
                  
      <!-- **********************************************************************************************************************************************************
      RIGHT SIDEBAR CONTENT
      *********************************************************************************************************************************************************** -->                  
                  
                <?php //$this->view('admin/right-sidebar.php'); ?>
              </div>
          </section>
      </section>


