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
      <section id="main-content">
          <section class="wrapper">
          	<h3><i class="fa fa-angle-right"></i> Add Account</h3>
          
          	<!-- BASIC FORM ELELEMNTS -->
          	<div class="row mt">
          		<div class="col-lg-12">
                  <div class="form-panel">
                  	  <h4 class="mb"><i class="fa fa-angle-right"></i> Please fill in the following details: </h4>
                      <form id="add_acc_form" class="form-horizontal style-form" enctype="multipart/form-data">
                          
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Account Name: </label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" name="acc_name" id="acc_name" required> 
                                  <span class="help-block">Name of account which will appear on your public profile</span>
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Account URL: </label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" name="acc_link" id="acc_link" required>
                                  <span class="help-block">URL of account where user will be navigated to for review</span>
                              </div>
                          </div>
                          
                          
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Account Type: </label>
                              <div class="col-sm-10">
                                  <!-- INPUT MESSAGES -->
                                  <div class="radio">
                                    <label>
                                      <input type="radio" name="accType" id="biggy" value="biggy" checked>
                                      BIG Icon
                                    </label>
                                  </div>
                                  <div class="radio">
                                    <label>
                                      <input type="radio" name="accType" id="small2" value="small">
                                      Small Icon
                                    </label>
                                  </div>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Upload Icon image: </label>
                              <div class="col-sm-10">
                                  <input type="file" class="form-control" name="uploaded_file" id="uploaded_file">
                              </div>
                          </div>
                          <div class="form-group">
                            <div class="col-sm-10 col-sm-offset-2">
                              <button class="btn btn-info" id="add_account">Add Account</button>
                            </div>
                          </div>
                          
                          
                      </form>
                  </div>
          		</div><!-- col-lg-12-->      	
          	</div><!-- /row -->
          	
          	
          	
          	
          	
          	
						
					
          	
          	
		</section>
      </section><!-- /MAIN CONTENT -->
