 <!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles -->
          <div class="row tile_count">
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-user" style="margin-right: 5px;"></i>New Bookings Today</span>
              <div class="count"><?php echo $today_enq ?></div>
              <!--<span class="count_bottom"><i class="green">4% more</i> From Yesterday's</span>-->
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-clock-o" style="margin-right: 5px;" ></i>Total Bookings</span>
              <div class="count"><?php echo $total_enq ?></div>
<!--              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>3% </i> From Yesterday</span>-->
            </div>
          </div>
          <!-- /top tiles -->

          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="dashboard_graph">

                <div class="row x_title">
                  <div class="col-md-6">
                    <h3>Booking Activities <small>All Booking each Day</small></h3>
                  </div>
                  <div class="col-md-6">
                    <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                      <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                      <span>December 30, 2016 - January 28, 2017</span> <b class="caret"></b>
                    </div>
                  </div>
                </div>

                  <div class="col-md-6 col-sm-6 col-xs-6" >
<!--                  <div id="chart_plot_01" class="demo-placeholder"></div>-->
<canvas id="lineChart" ></canvas>
                </div>
                <div class="clearfix"></div>
              </div>
            </div>

          </div>
          <br />
        </div>
 <script type="text/javascript">
   // Line chart
$( document ).ready(function() { 
        Chart.defaults.global.legend = {
                        enabled: false
                };
          var ctx = document.getElementById("lineChart");
          var lineChart = new Chart(ctx, {
                type: 'line',
                scales: {
                    xAxes: [{
                      ticks: {
                        maxRotation: 120 // angle in degrees
                      }
                    }]
                  },
                data: {
                  labels: <?php echo json_encode($graph['axis']) ?>,
                  datasets: [{
                        label: "Booking: ",
                        backgroundColor: "rgba(3, 88, 106, 0.3)",
                        borderColor: "rgba(3, 88, 106, 0.70)",
                        pointBorderColor: "rgba(3, 88, 106, 0.70)",
                        pointBackgroundColor: "rgba(3, 88, 106, 0.70)",
                        pointHoverBackgroundColor: "#fff",
                        pointHoverBorderColor: "rgba(151,187,205,1)",
                        pointBorderWidth: 2,
                        data: <?php echo json_encode($graph['value']) ?>
                  }]
                },
          });
        });			
 </script>
        <!-- /page content -->