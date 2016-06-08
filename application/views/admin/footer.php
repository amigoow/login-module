     <!--main content end-->
      <!-- modals -->
      <!-- Modal -->
      <div class="modal fade" id="edit-account-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Modal title</h4>
            </div>
            <div class="modal-body">
              <!-- MODAL BODY -->
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
                          
                          
                          
                      </form>
              <!-- MODAL BODY -->
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" id="update_account">UPDATE</button>
            </div>
          </div>
        </div>
      </div>
      <!--footer start-->

      <footer class="site-footer">
          <div class="text-center">
              <?php echo date('Y'); ?> - All rights reserved.</a>
              <a href="#" class="go-top">
                  <i class="fa fa-angle-up"></i>
              </a>
          </div>
      </footer>
      <!--footer end-->
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
   <!-- jqurey -->
    <script src="<?= base_url('assets/js/jquery.js') ?>"></script>
   <!-- bootstrap -->
   <script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
   

   <!-- noty -->
   <script src="<?= base_url('assets/node_modules/noty/packaged/jquery.noty.packaged.min.js') ?>"></script>
   <!-- bootbox -->
   <script src="<?= base_url('assets/node_modules/bootbox/bootbox.min.js') ?>"></script>

   <!-- star rating -->
   <script src="<?php echo base_url('assets/js/star-rating.min.js'); ?>" type="text/javascript"></script>


    <script class="include" type="text/javascript" src="<?= base_url('assets/js/admin/jquery.dcjqaccordion.2.7.js'); ?>"></script>
    <script src="<?= base_url('assets/js/admin/jquery.scrollTo.min.js'); ?>"></script>
    <script src="<?= base_url('assets/js/admin/jquery.nicescroll.js'); ?>" type="text/javascript"></script>
    <script src="<?= base_url('assets/js/admin/jquery.sparkline.js'); ?>"></script>


    <!--common script for all pages-->
    <script src="<?= base_url('assets/js/admin/common-scripts.js'); ?>"></script>
    


    <!--script for this page-->
    <script src="<?= base_url('assets/js/admin/sparkline-chart.js'); ?>"></script>    
	<script src="<?= base_url('assets/js/admin/zabuto_calendar.js'); ?>"></script>	
	
	
	
	<script type="application/javascript">
        $(document).ready(function () {
            $("#date-popover").popover({html: true, trigger: "manual"});
            $("#date-popover").hide();
            $("#date-popover").click(function (e) {
                $(this).hide();
            });
        
            $("#my-calendar").zabuto_calendar({
                action: function () {
                    return myDateFunction(this.id, false);
                },
                action_nav: function () {
                    return myNavFunction(this.id);
                },
                ajax: {
                    url: "show_data.php?action=1",
                    modal: true
                },
                legend: [
                    {type: "text", label: "Special event", badge: "00"},
                    {type: "block", label: "Regular event", }
                ]
            });
        });
        
        
        function myNavFunction(id) {
            $("#date-popover").hide();
            var nav = $("#" + id).data("navigation");
            var to = $("#" + id).data("to");
            console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
        }
    </script>
    <!-- custom js -->
    <script src="<?= base_url('assets/js/script.js') ?>"></script>
    <script src="<?= base_url('assets/js/admin/ajax-calls.js') ?>"></script>


  </body>
</html>