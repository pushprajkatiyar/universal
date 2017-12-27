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
                <div class="x_content">
                    <canvas id="lineChart" ></canvas>
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
                          <tr class="odd pointer">
                            <td class=" ">Bore Well 1 Total</td>
                            <td class=" "></td>
                            <td class=" ">M3</td>
                            <td class=" "></td>
                            <td class=" "></td>
                            <td class="a-right a-right ">%</td>
                          </tr>
                          <tr class="even pointer">
                            <td class=" ">Bore Well 2 Flow</td>
                            <td class=" "></td>
                            <td class=" ">M3/HR </td>
                            <td class=" "></td>
                            <td class=" "></td>
                            <td class="a-right a-right ">%</td>
                          </tr>
                          <tr class="odd pointer">
                            <td class=" ">Bore Well 2 Total</td>
                            <td class=" "></td>
                            <td class=" ">M3</td>
                            <td class=" "></td>
                            <td class=" "></td>
                            <td class="a-right a-right ">%</td>
                          </tr>
                          <tr class="even pointer">
                            <td class=" ">pH</td>
                            <td class=" "></td>
                            <td class=" ">pH</td>
                            <td class=" "></td>
                            <td class=" "></td>
                            <td class="a-right a-right ">%</td>
                          </tr>
                          <tr class="odd pointer">
                            <td class=" ">TSS</td>
                            <td class=" "></td>
                            <td class=" ">MG/L </td>
                            <td class=" "></td>
                            <td class=" "></td>
                            <td class="a-right a-right ">%</td>
                          </tr>
                          <tr class="even pointer">
                            <td class=" ">COD</td>
                            <td class=" "></td>
                            <td class=" ">MG/L</td>
                            <td class=" "></td>
                            <td class=" "></td>
                            <td class="a-right a-right ">%</td>
                          </tr>
                          <tr class="odd pointer">
                            <td class=" ">BOD</td>
                            <td class=" "></td>
                            <td class=" ">MG/L </td>
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
                         <div id="map" style="height: 350px; width: 100%"></div>
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
                         <th>KISHAN SAHKARI CHINI MILLS LIMITED</th>
                       </tr>
                     </thead>
                     <tbody>
                       <tr>
                         <th scope="row">Address</th>
                         <td>SEMIKHERA,P.O.DEORANIA,BAREILY-243203</td>
                       </tr>
                       <tr>
                         <th scope="row">Phone</th>
                         <td>7055003483</td>
                       </tr>
                       <tr>
                         <th scope="row">Email</th>
                         <td>kscmsemikhera@gmail.com</td>
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
        var myLatLng = {lat: 28.9476504, lng: 77.2372391};

        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 14,
          center: myLatLng,
          mapTypeId: google.maps.MapTypeId.SATELLITE
        });

        var marker = new google.maps.Marker({
          position: myLatLng,
          map: map,
          title: 'KISHAN SAHKARI CHINI MILLS LIMITED!'
        });
      }
    </script>
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
                  labels: ["1 AM","2 AM","3 AM","4 AM","5 AM","6 AM","7 AM"],
                  datasets: [{
                        label: "Booking: ",
                        backgroundColor: "rgba(3, 88, 106, 0.3)",
                        borderColor: "rgba(3, 88, 106, 0.70)",
                        pointBorderColor: "rgba(3, 88, 106, 0.70)",
                        pointBackgroundColor: "rgba(3, 88, 106, 0.70)",
                        pointHoverBackgroundColor: "#fff",
                        pointHoverBorderColor: "rgba(151,187,205,1)",
                        pointBorderWidth: 2,
                        data: ["1","2","3","4","4","5","4"]
                  }]
                },
          });
        });			
 </script>
        <!-- /page content -->