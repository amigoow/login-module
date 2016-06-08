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
          	<h3><i class="fa fa-angle-right"></i> Basic Info</h3>
          
          	<!-- BASIC FORM ELELEMNTS -->
          	<div class="row mt">
          		<div class="col-lg-12">
                  <div class="form-panel">
                  	  <h4 class="mb"><i class="fa fa-angle-right"></i> Titles: </h4>
                      <form id="add_basics_form" class="form-horizontal style-form" >
                          
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label"> Feedback Title: </label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" name="feedback_title" id="feedback_title" required> 
                                  <span class="help-block">Title will appear on your public profile</span>
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Feedback Subtitle: </label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" name="feedback_subtitle" id="feedback_subtitle" required>
                                  <span class="help-block">Subtitle will appear on your public profile</span>
                              </div>
                          </div>
                          <!--  RESPONSES -->
                         <h4 class="mb"><i class="fa fa-angle-right"></i> Feedback Responses: </h4> 

                         

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Feedback text on 1/5: </label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" name="feedback_1_5" id="feedback_1_5" required>
                                  <span class="help-block">Text to appear when user selects 1/5 stars</span>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Feedback text on 2/5: </label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" name="feedback_2_5" id="feedback_2_5" required>
                                  <span class="help-block">Text to appear when user selects 2/5 stars</span>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Feedback text on 3/5: </label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" name="feedback_3_5" id="feedback_3_5" required>
                                  <span class="help-block">Text to appear when user selects 3/5 stars</span>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Feedback text on 4/5: </label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" name="feedback_4_5" id="feedback_4_5" required>
                                  <span class="help-block">Text to appear when user selects 4/5 stars</span>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Feedback text on 5/5: </label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" name="feedback_5_5" id="feedback_5_5" required>
                                  <span class="help-block">Text to appear when user selects 5/5 stars</span>
                              </div>
                          </div>
                          
                          <div class="form-group">
                            <div class="col-sm-10 col-sm-offset-2">
                              <button class="btn btn-info" id="add_basics">Add/Update</button>
                            </div>
                          </div>
                          
                          
                      </form>
                  </div>
          		</div><!-- col-lg-12-->      	
          	</div><!-- /row -->
          	
          	
          	
          	
          	
          	
						
					
          	
          	
		</section>
      </section><!-- /MAIN CONTENT -->
