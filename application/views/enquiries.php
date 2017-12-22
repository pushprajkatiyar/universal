<div class="right_col" role="main">
        <div class="">
            <div class="col-md-12 col-sm-12 col-xs-12">
                    <p class="text-muted font-13 m-b-30">
                      Download data
                    </p>
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Booking ID</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Phone</th>
                          <th>No Of People</th>
                          <th>Price</th>
                          <?php if($isAgent){ ?> 
                             <th>Profit Share (26%)</th>
                          <?php } ?>
                          <th>Tour</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
<?php foreach ($bookings as $booking) { ?>
                      <tr>
                          <td>TRAV<?php echo $booking->id ?></td>
                          <td><?php echo $booking->name ?></td>
                          <td><?php echo $booking->email ?></td>
                          <td><?php echo $booking->phone ?></td>
                          <td><?php echo $booking->touristCount ?></td>
                          <td><?php echo $booking->price ?></td>
                          <?php if($isAgent){ ?> 
                            <td><?php echo round($booking->profite * 0.26 * $booking->touristCount, 2) ?></td>
                         <?php } ?>   
                          <td><a target="_BLANK" href="<?php echo $booking->toururl ?>"><?php echo $booking->tourname ?></a></td>
                          <td>
                              <a href="enquiry/detail?id=<?php echo $booking->id ?>" class="btn btn-primary btn-xs" ><i class="fa fa-folder"></i> View </a>
                              <button type="button" class="btn btn-info btn-xs" onclick="openEditModal(<?php echo $booking->id ?>)"><i class="fa fa-pencil"></i> Edit </button>
                              <button type="button" class="btn btn-danger btn-xs" onclick="close_enquiry(<?php echo $booking->id ?>)"><i class="fa fa-times-circle"></i> Close </button>
                          </td>
                        </tr>
<?php } ?>
                      </tbody>
                    </table>
              </div>
            </div>
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                            <h4 class="modal-title" id="myModalLabel">Edit Enquiry <span id="enq_no_show"></span></h4>
                        </div>
                        <div class="modal-body">
                           <form class="form-horizontal form-label-left" id="query_form" onsubmit="return query_submit();"  >
                            <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="occupation">Forward To  <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select id="todept" name="todept"  class="form-control col-md-7 col-xs-12">
                                    <?php foreach ($departments as $department) { ?>
                                        <option value="<?php echo $department->id ?>"><?php echo $department->name ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                          </div>
                               <input type="hidden" name="enqid" id="enqid" />
                        <div class="item form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">Comment <span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <textarea id="textarea" required="required" name="comment" class="form-control col-md-7 col-xs-12"></textarea>
                          </div>
                        </div>
                      </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-primary" id="savechanges" onclick="update_enquiry()">Save changes</button>
                        </div>

                      </div>
                    </div>
                  </div>
    <script type="text/javascript" >
            function openEditModal(id){
                $('.bs-example-modal-lg').modal('show');
                $("#enq_no_show").html("TRAV" + id);
                $("#enqid").val(id);
            }
            function update_enquiry(){
                $('#savechanges').html("Updating...");
                var form_data =  $('#query_form').serialize();
                $.ajax({
                        type: "POST",
                        url: "ajax/updateEnq",
                        data: form_data,
                        dataType: "json",
                        success: function(data) {
                            if(data.status){
                                $('#savechanges').html("Done");
                                $(location).attr('href', data.redirect_url);
                            }else{
                                $('#savechanges').html("Save changes");
                            }
                        }
                    });
                return false;
            }
            function close_enquiry(id){
                var retVal = confirm("Are you sure to close this Booking ?");
                if( retVal == true ){
                    $.ajax({
                            type: "POST",
                            url: "ajax/closeEnq",
                            data: { id : id},
                            dataType: "json",
                            success: function(data) {
                                if(data.status){
                                    $('#savechanges').html("Done");
                                    $(location).attr('href', "enquiry");
                                }else{
                                    $('#savechanges').html("Save changes");
                                }
                            }
                        });
                    return false;
            }
        }
        </script>
        </div>