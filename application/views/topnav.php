  <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>
              <!-- Customer basic Details Start -->
              <div class="nav navbar-nav navbar-left">
                  <h2>Customer Name: <small id="plant_name"><?php echo $plants_devices[$current_plant]['plant']->name ?></small></h2>
                  <h2>Customer Address: <small id="plant_add"><?php echo $plants_devices[$current_plant]['plant']->address ?></small></h2>
              </div>
              <!----- Customer basic Details Ends -->
              
              <!--  Plant Data loading Start-->
              <div class="nav navbar-nav" style="float: right;margin-right: 30%">
                  <h2>Plant Data Loading Percentage: <small id="plant_data_loading_per"> </small> %</h2>
              </div>
              <!-- Loading end -->
            </nav>
          </div>
        </div>
        <!-- /top navigation -->
