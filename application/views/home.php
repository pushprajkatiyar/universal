 <!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles -->
          <div class="row tile_count"></div>
          <!-- /top tiles -->

          <div class="row">
            <div class="col-md-7 col-sm-7 col-xs-7">
              <!-- Historic Trends/Details Start -->
              <div class="x_panel">
                <div class="x_title">
                  <h2>Historic Trends<small>[ GRAPH ]</small></h2>
                  <div class="clearfix"></div>
                </div>
                  <!-- Historic Trends/Details Graph Start -->
                  <div class="x_content" >
                    <canvas id="lineChart" style="height: 550px; width: 100%"></canvas>
                </div>
              </div>  
                <!-- Historic Trends/Details Graph End -->
                
                <!-- Historic Trends/Details Table Start -->
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Historic Trends<small>[ Table ]</small></h2>
                        <div class="clearfix"></div>
                    </div>
                <div class="x_content">
                    <div class="table-responsive">
                      <table class="table table-striped jambo_table bulk_action">
                        <thead>
                          <tr class="headings">
                            <th class="column-title">Parameter </th>
                            <th class="column-title">Instantaneous Value </th>
                            <th class="column-title">Parameter Unit </th>
                            <th class="column-title">Average value </th>
                            <th class="column-title">Parrameter Limit</th>
                            <th class="column-title">Percentage Of Data Uploading</th>
                          </tr>
                        </thead>

                        <tbody>
                          <tr class="even pointer">
                            <td class=" ">Bore Well 1 Flow</td>
                            <td class=" ">- </td>
                            <td class=" ">M3/HR</td>
                            <td class=" "></td>
                            <td class=" "></td>
                            <td class="a-right a-right ">%</td>
                          </tr>
                         
                        </tbody>
                      </table>
                    </div>
                </div>
              <!-- Historic Trends/Details Table End -->
              </div>
              <div class="clearfix"></div>
              <!-- Historic Trends/Details End -->
              
            </div>
              
            <div class="col-md-5 col-sm-5 col-xs-5">
                 <!-- Map of Plant Start-->
                 <div class="x_panel">
                   <div class="x_title">
                       <h2>Plant Location:<small>On Google Map</small> </h2>
                     <div class="clearfix"></div>
                   </div>
                     <div class="x_content">
                         <div id="map" style="height: 380px; width: 100%"></div>
                     </div>  
                 </div>
                 <div class="clearfix"></div>
                 <!-- Map of plant End -->

                 <!-- Plant Details Start -->
                 <div class="x_panel">
                   <div class="x_title">
                     <h2>Plant & Contact Details: </h2>
                     <div class="clearfix"></div>
                   </div> 
                   <div class="x_content">
                       <table class="table table-bordered">
                     <thead>
                       <tr>
                         <th>Name</th>
                         <th><?php echo $plants_devices[$current_plant]['plant']->name ?></th>
                       </tr>
                     </thead>
                     <tbody>
                       <tr>
                         <th scope="row">Address</th>
                         <td><?php echo $plants_devices[$current_plant]['plant']->address ?></td>
                       </tr>
                       <tr>
                         <th scope="row">Phone</th>
                         <td><?php echo $plants_devices[$current_plant]['plant']->phone ?></td>
                       </tr>
                       <tr>
                         <th scope="row">Email</th>
                         <td><?php echo $plants_devices[$current_plant]['plant']->email ?></td>
                       </tr>
                     </tbody>
                   </table>
                   </div>
                 </div>
                 <!-- plant details End -->
             </div>  
          </div>
          <br />
        </div>
    <script>

      function initMap() {
        var myLatLng = {lat: <?php echo $plants_devices[$current_plant]['plant']->lat ?>, lng: <?php echo $plants_devices[$current_plant]['plant']->lng ?>};

        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 14,
          center: myLatLng,
          mapTypeId: google.maps.MapTypeId.SATELLITE
        });

        var marker = new google.maps.Marker({
          position: myLatLng,
          map: map,
          title: '<?php echo $plants_devices[$current_plant]['plant']->name ?>!'
        });
      }
    </script>
 <script type="text/javascript">
   // Line chart
$( document ).ready(function() { 
        Chart.defaults.global.legend = {
                        enabled: true
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
                  labels: ["1 AM","2 AM","3 AM","4 AM","5 AM","6 AM","7 AM"],
                  datasets: [{
                        label: "Flow Meter 1: ",
                        backgroundColor: "#FF0000",
                        borderColor: "#FF0012",
                        data: ["1","2","3","4","4","5","4"],
                        fill: false
                  },
                  {
                        label: "Flow Meter 2: ",
                        backgroundColor: "#880000",
                        borderColor: "#800000",
                        data: ["4","2","1","5","4","4.5","2"],
                        fill: false
                  }]
                },
            options: {
                responsive: true,
                hover: {
                    mode: 'nearest',
                    intersect: true
                },
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Time'
                        }
                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'M3/HR'
                        }
                    }]
                }
            }
          });
        });			
 </script>
        <!-- /page content -->