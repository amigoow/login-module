<aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
              
                  <!-- <p class="centered"><a href="profile.html"><img src="assets/img/ui-sam.jpg" class="img-circle" width="60"></a></p> -->
                  <h5 class="centered uppercase"><?php echo $_SESSION["username"]; ?></h5>
                    
                  <li class="mt">
                      <a class="<?php if($this->uri->segment(1)=='dashboard') echo 'active';?>" href="<?php echo base_url('dashboard'); ?>">
                          <i class="fa fa-dashboard"></i>
                          <span>Dashboard</span>
                      </a>
                  </li>

                 
                  <li class="sub-menu">
                      <a class="<?php if($this->uri->segment(1)=='add_account') echo 'active';?>" href="<?php echo base_url('add_account'); ?>" >
                          <i class="fa fa-tasks"></i>
                          <span>Add Account</span>
                      </a>
                  </li>
                  <!-- <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-th"></i>
                          <span>Data Tables</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="basic_table.html">Basic Table</a></li>
                          <li><a  href="responsive_table.html">Responsive Table</a></li>
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class=" fa fa-bar-chart-o"></i>
                          <span>Statistics</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="morris.html">Morris</a></li>
                          <li><a  href="chartjs.html">Chartjs</a></li>
                      </ul>
                  </li> -->

              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>