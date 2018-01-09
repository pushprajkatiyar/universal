 <!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles -->
          <div class="row tile_count"></div>
          <!-- /top tiles -->

          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <!-- Historic Trends/Details Table Start -->
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Plants Data<small></small></h2>
                        <a href="admin/add" type="button" class="btn btn-primary right">Add Plant</a>
                        <div class="clearfix"></div>
                    </div>
                <div class="x_content">
                    <div class="table-responsive">
                      <table class="table table-bordered jambo_table bulk_action">
                        <thead>
                          <tr class="headings">
                            <th class="column-title">Name </th>
                            <th class="column-title">Address </th>
                            <th class="column-title">Phone</th>
                            <th class="column-title">Email</th>
                            <th class="column-title">Devices</th>
                          </tr>
                        </thead>

                        <tbody>
                        <?php foreach ($plants as $plant_id => $plant) { ?>
                        <td><?php echo $plant['plant']['name'] ?></td>
                        <td><?php echo $plant['plant']['address'] ?></td>
                        <td><?php echo $plant['plant']['phone'] ?></td>
                        <td><?php echo $plant['plant']['email'] ?></td>
                        <td>
                            <?php 
                            foreach ($plant['device'] as $device) {
                               echo $device->name;  
                            }
                            ?>
                        </td>
                        <?php } ?>
                        </tbody>
                      </table>
                    </div>
                </div>
              <!-- Historic Trends/Details Table End -->
              </div>
              <div class="clearfix"></div>
              <!-- Historic Trends/Details End -->
              
            </div>
          </div>
          <br />
        </div>
        <!-- /page content -->