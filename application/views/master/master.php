<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>



<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="page-header">
                
                    <h1 id="title"></h1>
                    <p id="subtitle"></p>
                
            </div>
           
                
            <input id="my_rating" value="0" type="number" class="rating rating-loading" min=0 max=5 step=0.5 data-size="xl">
            <hr>
            <!-- Corresponding Caption will be shown here! -->
            <div id="myCaption">
                
            </div>
            <!-- form to be shown after user clicks on star -->
            <form role="form" id="feedbackForm">
              <div class="col-md-6 col-sm-6 col-lg-6">
               <div class="form-group">
                <!-- <label for="name">Name:</label> -->
                <input type="text" placeholder="Name" class="form-control" id="f_name" name="f_name">
               </div>
              </div>
              <div class="col-md-6 col-sm-6 col-lg-6">
               <div class="form-group">
                
                <input type="email" placeholder="Email" class="form-control" id="email">
              </div>
             </div>

              
              
              
             <div class="col-md-12 col-sm-12 col-lg-12 "> 
              <div class="form-group">
                <label for="email">How can our cupcakes be better?</label>
                <textarea class="form-control" rows="3" id="improve"></textarea>
              </div>
             </div>
              
             <div class="col-md-12 col-sm-12 col-lg-12">             
              <div id="sendEmail" class="btn btn-primary">Submit</div>
             </div>
            </form>

            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title" style="text-align:center;" id="myModalLabel">Please Leave Us A Positive Review To Help Our Cupcake Business Continue To Grow. Thank You!<!--<img  src="http://media.indiatimes.in/media/content/2014/Aug/cc3_1409379418.gif"/>--><div class="animation bounce"><span id="bouncing_arrow" class="glyphicon glyphicon-menu-down"></span></div></h3>
                  </div>
                  <div class="modal-body review-iframe">
                    Error loading content. Please contact administrator.
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Finish</button>
                  </div>
                </div>
              </div>
            </div>

            <!-- modal for options -->
            <div class="modal fade" id="optModal" tabindex="-2" role="dialog" aria-labelledby="optModalLabel">
              <div class="modal-dialog option-modal" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h2 class="modal-title" style="text-align:center;" id="optModalLabel">Please leave us a positive review on any of the following review sites</h2>
                  </div>
                  <div class="modal-body option-modal">
  
                    <div id="review-sel" class="row">
                        
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Finish</button>
                  </div>
                </div>
              </div>
            </div>
            
        </div>
    </div>
</div> 
