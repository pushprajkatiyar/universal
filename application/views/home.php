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
          </div>
          <br />
        </div>
    <script  type="text/javascript">
        $(function() {
            $('.report_dates').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true
//                timePicker: true
            }) 
        })
      function initMap() {
        var myLatLng = {lat: <?php echo $plants_devices[$current_plant]['plant']->lat ?>, lng: <?php echo $plants_devices[$current_plant]['plant']->lng ?>};

        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 14,
          center: myLatLng,
          mapTypeId: google.maps.MapTypeId.ROADMAP
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
   var base_url =  "<?php echo base_url(); ?>";
   
   $.ajax({
            type: "POST",
            url: base_url+"ajax/getGraphData",
            data: {device_id: <?php echo $current_device ?>, plant_id: <?php echo $plants_devices[$current_plant]['plant']->id ?>},
            dataType: "json",
            success: function(data) {
                if(data.status){
                   drawChart(data.graph_data);
                   //drawtable(data.table_data);
                   $('#plant_data_loading_per').html(data.plant_data_uploading_per);
                   //draw table
                    $('#fact_table').DataTable({
                        data: data.table_data,
                        searching: false,
                        paging: false,
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
 function drawtable(tableData){
        var content = "";
        for(i=0; i<tableData.length; i++){
            content += '<tr class=" pointer">'
                        +'    <td class=" ">'+ tableData[i].name +'</td>'
                        +'    <td class=" ">'+ tableData[i].instant_value +'</td>'
                        +'    <td class=" ">'+ tableData[i].para_unit +'</td>'
                        +'    <td class=" ">'+ tableData[i].avg_value +'</td>'
                        +'    <td class=" ">'+ tableData[i].para_limit +'</td>'
                        +'    <td class="a-right a-right ">'+ tableData[i].data_uploading_per +'%</td>'
                        +'  </tr>';
        }
        
        $('#table_body').html(content);
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
        });
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
 </script>
        <!-- /page content -->