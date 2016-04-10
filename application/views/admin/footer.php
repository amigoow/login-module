     <!--main content end-->
      <!--footer start-->
      <footer class="site-footer">
          <div class="text-center">
              <?php echo date('Y'); ?> - <a href="mailto:faisalashfaq81z@gmail.com">Developed by Faisal</a>
              <a href="#" class="go-top">
                  <i class="fa fa-angle-up"></i>
              </a>
          </div>
      </footer>
      <!--footer end-->
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="<?= base_url('assets/js/jquery.js') ?>"></script>
   <!-- bootstrap -->
   <script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
   <!-- jqury -->

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