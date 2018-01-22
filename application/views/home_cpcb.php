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
                        <table class="table table-bordered jambo_table bulk_action" id="fact_table">
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

                        <tbody id="table_body">

                         
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
                         <th id="plant_name_table"></th>
                       </tr>
                     </thead>
                     <tbody>
                       <tr>
                         <th scope="row">Address</th>
                         <td id="plant_add_table"></td>
                       </tr>
                       <tr>
                         <th scope="row">Phone</th>
                         <td id="plant_phone_table"></td>
                       </tr>
                       <tr>
                         <th scope="row">Email</th>
                         <td id="plant_email_table"></td>
                       </tr>
                     </tbody>
                   </table>
                   </div>
                 </div>
                 <!-- plant details End -->
             </div>  
              
              <!-- Large modal -->
                  <div class="modal fade bs-report-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Get Station Report</h4>
                        </div>
                        <div class="modal-body">
                          <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Form Design <small>different form elements</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">From Date <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">To Date <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="last-name" name="last-name" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Select</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control">
                            <option>Choose option</option>
                            <option>Option one</option>
                            <option>Option two</option>
                            <option>Option three</option>
                            <option>Option four</option>
                          </select>
                        </div>
                      </div>                      
                      <div class="ln_solid"></div>
                      </form>
                  </div>
                </div>
              </div>
            </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-primary">Generate Report</button>
                        </div>

                      </div>
                    </div>
                  </div>
          </div>
          <br />
        </div>
    <script>

      function initMap(lat, lng) {
        var myLatLng = {lat: parseFloat(lat), lng: parseFloat(lng)};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 14,
          center: myLatLng,
          mapTypeId: google.maps.MapTypeId.SATELLITE
        });

        var marker = new google.maps.Marker({
          position: myLatLng,
          map: map,
          title: ''
        });
      }
    </script>
 <script type="text/javascript">
   // Line chart
 function getDeviceData(device_id, plant_id){
    var base_url = "<?php echo base_url(); ?>";

    $.ajax({
             type: "POST",
             url: base_url+"ajax/getGraphData",
             data: {device_id: device_id, plant_id: plant_id},
             dataType: "json",
             success: function(data) {
                 if(data.status){
                    drawChart(data.graph_data);
                    //drawtable(data.table_data);
                    initMap(data.plant.lat, data.plant.lng);
                    $('#plant_data_loading_per').html(data.plant_data_uploading_per);
                    $('#plant_name').html(data.plant.name);
                    $('#plant_add').html(data.plant.address);
                    $('#plant_name_table').html(data.plant.name);
                    $('#plant_add_table').html(data.plant.address);
                    $('#plant_phone_table').html(data.plant.phone);
                    $('#plant_email_table').html(data.plant.email);
                    //draw table                    
                    $('#fact_table').DataTable({
                        data: data.table_data,
                        destroy: true,
                        columns: [
                            { data: 'name' },
                            { data: 'instant_value' }, //or { data: 'MONTH', title: 'Month' }`
                            { data: 'para_unit' },
                            { data: 'avg_value' },
                            { data: 'para_limit' },
                            { data: 'data_uploading_per' }
                        ],
                        dom: 'Bfrtip',
                        buttons: [
                                    {
                                      extend: "copy",
                                      className: "btn-sm"
                                    },
                                    {
                                      extend: "csv",
                                      className: "btn-sm"
                                    },
                                    {
                                      extend: "excel",
                                      className: "btn-sm"
                                    },
                                    {
                                      extend: "pdfHtml5",
                                      className: "btn-sm"
                                    },
                                    {
                                      extend: "print",
                                      className: "btn-sm"
                                    },
                              ]
                    });
                    
                 }else{
                     console.log(">>>>>>>error");
                 }
             }
         });
    }      
 function drawChart(ChartData){
     // 
//                   var ChartData = data.graph_data;
//                   debugger;
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
                        labels: ChartData.label,
                        datasets: [{
                              label: "Flow Meter 1: ",
                              backgroundColor: "#FF0000",
                              borderColor: "#FF0012",
                              data: ChartData.flowrate_1,
                              fill: false
                        },
                        {
                              label: "Flow Meter 2: ",
                              backgroundColor: "#880000",
                              borderColor: "#800000",
                              data: ChartData.flowrate_2,
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
            }			
 </script>
        <!-- /page content -->