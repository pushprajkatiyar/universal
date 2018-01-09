 <!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles -->
          <div class="row tile_count"></div>
          <!-- /top tiles -->

          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="col-md-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                      <h2>Please fill plant details <small> DO NOT LEFT * FIELD BLANK</small> </h2>
                      <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form class="form-horizontal form-label-left" id="plant_form">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Plant Name<span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="text" class="form-control" placeholder="Plant Name" name="plant_name">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Description
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <textarea name="description" class="form-control" rows="3" placeholder=' Add any related info to the plant'></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Contact Person Name<span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="text" class="form-control" placeholder="Contact Person  Name" name="name">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Contact Person Email<span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="text" class="form-control" placeholder="Contact Person Email" name="email">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Password<span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="password" class="form-control" name="password">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Contact Person Phone <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="text" name="phone"  class="form-control col-md-10" placeholder="Plant Contact Person Phone"/>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Plant Address <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="text" name="address"  class="form-control col-md-10" placeholder="Plant Address"/>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Plant City </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="text" name="city"  class="form-control col-md-10" placeholder="Plant City"/>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Plant State </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="text" name="state"  class="form-control col-md-10" placeholder="Plant State"/>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Plant pin code </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="text" name="zip"  class="form-control col-md-10" placeholder="Plant pin code"/>
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Select Attributes<span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <select class="select2_multiple form-control" multiple="multiple" name="atr[]">
                           <?php foreach ($attributes as $atr) { ?> }
                           <option value="<?php echo $atr->id ?>"><?php echo $atr->name ?></option>
                           <?php } ?>
                          </select>
                        </div>
                      </div>
                        <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Device ID <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="text" name="device_id"  class="form-control col-md-10" placeholder="Enter device id e.g. MCOM0010"/>
                        </div>
                      </div>
                        <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Device Name <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="text" name="device_name"  class="form-control col-md-10" placeholder="Device Name"/>
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                            <a class="btn btn-round btn-primary submit" id="login_button" onclick="addPlant()">Log in</a>
                            <span id="login_error" class="red"></span>
                            <span id="login_success" class="green"></span>
                            <img src="build/images/loader.gif" id="login_spinner" style="display: none">
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
              
            </div>
          </div>
          <br />
        </div>
 <script type="text/javascript">
   function addPlant(){
    var base_url = "<?php echo base_url(); ?>";
    var form_data =  $('#plant_form').serialize();
    $.ajax({
             type: "POST",
             url: base_url+"ajax/signup",
             data: form_data,
             dataType: "json",
             success: function(data) {
                 if(data.status){
                    $('#login_error').hide();
                    $('#login_success').html(data.message);
                    $(location).attr('href',base_url+data.redirect_url);
                }else{
                    $('#login_error').html(data.message);
                    $("#login_spinner").hide();
                    $("#login_button").fadeIn();
                }
             }
         });
    }      
 </script>
        <!-- /page content -->