 <!-- page content -->
        <div class="right_col" role="main">
          
          <div class="row">
            <div class="col-md-7 col-sm-7 col-xs-7">
              <!-- Historic Trends/Details Start -->
              <div class="x_panel">
                <div class="x_title">
                    <h2>Historic Trends     <small class="right"> Device Last Reported At: <span id="last_reported" style="font-weight: bold;color: black" ></span> </small></h2>
                  <div class="clearfix"></div>
                </div>
                  <!-- Historic Trends/Details Graph Start -->
                  <div class="x_content" >
                    <canvas id="lineChart" style="height: 300px; width: 100%"></canvas>
                </div>
              </div>  
                <!-- Historic Trends/Details Graph End -->
                
                <!-- Historic Trends/Details Table Start -->
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Parameter's Data<small>[ Table ]</small></h2>
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
                         <div id="map" style="height: 305px; width: 100%"></div>
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
                            <div class="x_content">
                              <br />
                              <form id="report_form"  class="form-horizontal form-label-left">

                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">From Date <span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                      <input type="text" id="from_date" name="from_date" required="required" class="form-control col-md-7 col-xs-12 report_dates">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">To Date <span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="to_date" name="to_date" required="required" class="form-control col-md-7 col-xs-12 report_dates">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Interval</label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                      <select class="form-control" name="interval">
                                      <option>30 Sec</option>
                                      <option>1 Min</option>
                                      <option>2 Min</option>
                                      <option>5 Min</option>
                                      <option>15 Min</option>
                                      <option>30 Min</option>
                                      <option>1 Hour</option>
                                      <option>1 Day</option>
                                    </select>
                                  </div>
                                </div>                      
                                <div class="ln_solid"></div>
                                <button type="button" class="btn btn-primary" onclick="getStationReport()">Generate Report</button>
                                <div class="ln_solid"></div>
                                <table id="report_table" class="table table-bordered" >
                                <thead>
                                    <tr>
                                        <th>Flow Meter 1</th>
                                        <!--<th>Totalizer 1</th>-->
                                        <th>Flow Meter 2</th>
                                        <!--<th>Totalizer 2</th>-->
                                        <th>Reported Time</th>
                                    </tr>
                                </thead>
                            </table>
                                </form>
                            </div>
                          </div>
                        </div>
                        </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          
                        </div>

                      </div>
                    </div>
                  </div>
              <!-- Large modal -->
                  <div class="modal fade bs-calibration-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Online Data Calibration Stats</h4>
                        </div>
                        <div class="modal-body">
                          <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                          <div class="x_panel">
                            <div class="x_content">
                              <br />
                              <p>Data calibration started at : 2018-01-23 : 01:17:23</p>
                              <p>Data received by device at : 2018-01-23 : 01:17:24</p>
                              <p>Data received by server at : 2018-01-23 : 01:17:25</p>
                              <p>Data calibration ended at : 2018-01-23 : 01:17:25</p>
                            </div>
                          </div>
                        </div>
                        </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          
                        </div>

                      </div>
                    </div>
                  </div>
          </div>
          <br />
        </div>
    <script>
        $(function() {
            $('.report_dates').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true
  //              timePicker: true
            }) 
        })
      function initMap(lat, lng) {
        var myLatLng = {lat: parseFloat(lat), lng: parseFloat(lng)};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 14,
          center: myLatLng,
          mapTypeId: google.maps.MapTypeId.ROADMAP
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
                    $('#last_reported').html(data.graph_data.label[9]);
                    //draw table                    
                    $('#fact_table').DataTable({
                        data: data.table_data,
                        destroy: true,
                        searching: false,
                        paging:   false,
                        ordering: false,
                        info:     false,
                        columns: [
                            { data: 'name' },
                            { data: 'instant_value' }, //or { data: 'MONTH', title: 'Month' }`
                            { data: 'para_unit' },
                            { data: 'avg_value' },
                            { data: 'para_limit' },
                            { data: 'data_uploading_per' }
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
            //report table
    function getStationReport() {
        var base_url = "<?php echo base_url(); ?>";
           $.ajax({
             type: "POST",
             url: base_url+"ajax/getStationReport",
             data: $('#report_form').serialize(),
             dataType: "json",
             success: function(data) {
                 $('#report_table').DataTable({
                        data: data.data.table,
                        destroy: true,
                        searching: true,
                        columns: [
                            { data: 'flowrate_1' },
//                            { data: 'total_1' }, 
                            { data: 'flowrate_2' },
//                            { data: 'total_2' },
                            { data: 'reporting_datetime' }
                        ],
                        dom: 'Bfrtip',
                        buttons: [
                                    {
                                      extend: "csv",
                                      className: "btn-sm",
                                      title: data.data.plant.name
                                    },
                                    {
                                      extend: "excel",
                                      className: "btn-sm",
                                      title: data.data.plant.name
                                    },
                                    {
                                      extend: "pdfHtml5",
                                      className: "btn-sm",
                                      title: data.data.plant.name
                                    },
                                    {
                                      extend: "print",
                                      className: "btn-sm"
                                    }
                              ]
                       
                    });
             }
         });
    }
    $('.bs-report-modal-lg').on('shown.bs.modal', function (e) {
        console.log("opened");
//        $('#report_table').DataTable({
//                destroy: true
//        })
            $('#report_table').dataTable().fnClearTable();
    })
 </script>
        <!-- /page content -->