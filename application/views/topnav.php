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
                  <h2>Industry Type: <small id="plant_type"><?php echo $plants_devices[$current_plant]['plant']->type ?></small></h2>
              </div>
              <!----- Customer basic Details Ends -->
              
              <!--  Plant Data loading Start-->
              <div class="nav navbar-nav" style="float: right;margin-right: 30%">
                  <button type="button" class="btn btn-primary right" data-toggle="modal" data-target=".bs-report-modal-lg">Station Report</button>
                  <h2>Plant Data Loading Percentage: <small id="plant_data_loading_per"> </small> %</h2>
                  <h2>Industry code: <small id="plant_code"> <?php echo $plants_devices[$current_plant]['plant']->code ?></small></h2>
              </div>
              <!-- Loading end -->
            </nav>
          </div>
        </div>
        <!-- /top navigation -->
