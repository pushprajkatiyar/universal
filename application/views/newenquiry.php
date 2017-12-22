<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Add New Enquiry</h3>
              </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                  <form class="form-horizontal form-label-left" id="query_form" onsubmit="return query_submit();"  >

                      <p>Add New Enquiry/Booking Here for further operations !  </p>
                      <span class="section">Booking Info</span>
                      
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="occupation">Tour Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select id="tourid" name="tourid"  class="form-control col-md-7 col-xs-12" onchange="cal_price()">
                                <?php foreach ($tours as $tour) { ?>
                                <option value="<?php echo $tour->id ?>"><?php echo $tour->name ?></option>
                                <?php } ?>
                            </select>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="name" placeholder="e.g Firstname Lastname" required="required" type="text">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="email" id="email" name="email" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="occupation">Email Itinerary <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select id="sendemail" name="sendemail"  class="form-control col-md-7 col-xs-12">
                                <option value="no">No</option>
                                <option value="yes" selected="">Yes</option>
                            </select>
                        </div>
                      </div>
                       <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Phone Number<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="phone" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="phone" placeholder="Phone Number" required="required" type="text">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">No Of People In Group <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="number" value="1" name="number" required="required" data-validate-minmax="1,100" class="form-control col-md-7 col-xs-12" onkeyup="cal_price()">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="occupation">Price <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="price" type="text" name="price" readonly="" class="form-control col-md-7 col-xs-12">
                        </div>
                          <label id="unitprice"></label>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="occupation">Paid <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select id="status" name="paid"  class="form-control col-md-7 col-xs-12">
                                <option value="no">No</option>
                                <option value="yes">Yes</option>
                            </select>
                        </div>
                      </div>
                      
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Start Date <span class="required">*</span>
                        </label>
                         <div class="col-md-6 col-sm-6 col-xs-12">
                             <input type="text" class="form-control col-md-7 col-xs-12" id="start_date" placeholder="Start Date" name="start_date" aria-describedby="inputSuccess2Status">
                         </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">End Date <span class="required">*</span>
                        </label>
                         <div class="col-md-6 col-sm-6 col-xs-12">
                             <input type="text" class="form-control col-md-7 col-xs-12" id="end_date" placeholder="End Date" name="end_date" aria-describedby="inputSuccess2Status">
                         </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">Comment <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea id="textarea" required="required" name="comment" class="form-control col-md-7 col-xs-12"></textarea>
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <a href="/home" class="btn btn-primary">Cancel</a>
                          <input id="query_button" type="submit" class="btn btn-success" >
                          <span id="query_error" class="red"></span>
                          <span id="query_success" class="green"></span>
                          <img src="<?php echo base_url(); ?>build/images/loader.gif" id="query_spinner" style="display: none">
                        </div>
                      </div>
                    </form>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
        <script type="text/javascript">
            var tours = <?php echo json_encode($tours) ?>;
            function cal_price(){
                var ind = $("select[name='tourid'] option:selected").index();
                var total_price = parseInt(tours[ind]['price']) * parseInt($("#number").val());
                $("#unitprice").html(tours[ind]['price']);
                $("#price").val(total_price);
//                console.log("index >>>",ind);
//                console.log("tour details>>", parseInt(tours[ind]['price']));
            }
        function query_submit(){
            $("#query_button").fadeOut(1000);
            $("#query_spinner").fadeIn(100);
             var base_url = "<?php echo base_url(); ?>";
             var form_data =  $('#query_form').serialize();

             $.ajax({
                     type: "POST",
                     url: base_url+"ajax/addquery",
                     data: form_data,
                     dataType: "json",
                     success: function(data) {
                         if(data.status){
                             $('#query_error').hide();
                             $('#query_success').html(data.message);
                             $(location).attr('href',base_url+data.redirect_url);
                         }else{
                             $('#query_error').html(data.message);
                             $("#query_spinner").hide();
                             $("#query_button").fadeIn();
                         }
                     }
                 });
             return false;
        }
        </script>