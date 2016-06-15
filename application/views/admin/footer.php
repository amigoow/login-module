     <!--main content end-->
      <!-- modals -->
      <!-- Modal -->
      <img src="<?php echo base_url('assets/imgs/loading.gif'); ?>" id="ajax-load" style="display:none" />
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
   

   <!-- star rating -->
   <script src="<?php echo base_url('assets/js/star-rating.min.js'); ?>" type="text/javascript"></script>


    <script class="include" type="text/javascript" src="<?= base_url('assets/js/admin/jquery.dcjqaccordion.2.7.js'); ?>"></script>
    
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/js/admin/ajax-loader/jquery.loading.min.js'); ?>"> 

    <!--common script for all pages-->
    <script src="<?= base_url('assets/js/admin/common-scripts.js'); ?>"></script>
    


    <!--script for this page-->
   
	<!-- Latest compiled and minified JavaScript -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
	
	<script type="application/javascript">
        
        $("#uploaded_file").on('change' , function(){
          
          $('.selectpicker').selectpicker('val','');  
        });

        $('.selectpicker').selectpicker();

        /*!
         * Loading v1.0
         * Copyright Grafikdev
         * Distributed under the MIT license
         */

        (function($) {

            $.fn.Loading = function(options) {


                var methods = {

                    init : function(option) {
                        $(document).on({
                            ajaxStart: function() {
                                helpers.start();
                            },
                            ajaxStop: function() {
                                var wait = setTimeout(function(){
                                    helpers.stop();
                                    clearTimeout(wait);
                                },2000);
                            }
                        });

                        return this;
                    }
                }

                var helpers = {
                  start : function(){
                    if($('#full-loading').length == 0) {
                            var loading = $("<div>").attr("id","full-loading");
                            var wrapper = $("<div>").addClass("wrapper").appendTo(loading);
                            var inner = $("<div>").addClass("inner").appendTo(wrapper);
                            $("<span>").text("L").appendTo(inner);
                            $("<span>").text("o").appendTo(inner);
                            $("<span>").text("a").appendTo(inner);
                            $("<span>").text("d").appendTo(inner);
                            $("<span>").text("i").appendTo(inner);
                            $("<span>").text("n").appendTo(inner);
                            $("<span>").text("g").appendTo(inner);
                            $(loading).appendTo("body");
                        }
                  },
                  stop : function(){
                    if($('#full-loading').length != 0) {
                            $('#full-loading').remove();
                        }
                  }
                }

                return methods.init.apply(this, arguments);
            }

        })(jQuery);

        $(document).ready(function () {
          
          $(document).Loading();
          
        });
    </script>
    <!-- custom js -->
    <script src="<?= base_url('assets/js/script.js') ?>"></script>
       
    
    <script src="<?= base_url('assets/js/admin/ajax-calls.js') ?>"></script>
    

  </body>
</html>