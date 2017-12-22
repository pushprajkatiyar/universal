<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Update Tour Info</h3>
              </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                  <form class="form-horizontal form-label-left" id="query_form" onsubmit="return query_submit();"  >

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="name" class="form-control col-md-7 col-xs-12" value="<?php echo $tour->name;?>"name="name" placeholder="e.g Tour Name" required="required" type="text">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Price <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="name" class="form-control col-md-7 col-xs-12" value="<?php echo $tour->price;?>" name="price" placeholder="e.g Price" required="required" type="text">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Duration <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="name" class="form-control col-md-7 col-xs-12" value="<?php echo $tour->duration;?>" name="duration" placeholder="e.g duration" required="required" type="text">
                        </div>
                      </div>
                    <!-- compose -->
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">ITINERARY <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="compose-body">
                          <div id="alerts"></div>

                          <div class="btn-toolbar editor" data-role="editor-toolbar" data-target="#editor">
                            <div class="btn-group">
                              <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font"><i class="fa fa-font"></i><b class="caret"></b></a>
                              <ul class="dropdown-menu">
                              </ul>
                            </div>

                            <div class="btn-group">
                              <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font Size"><i class="fa fa-text-height"></i>&nbsp;<b class="caret"></b></a>
                              <ul class="dropdown-menu">
                                <li>
                                  <a data-edit="fontSize 5">
                                    <p style="font-size:17px">Huge</p>
                                  </a>
                                </li>
                                <li>
                                  <a data-edit="fontSize 3">
                                    <p style="font-size:14px">Normal</p>
                                  </a>
                                </li>
                                <li>
                                  <a data-edit="fontSize 1">
                                    <p style="font-size:11px">Small</p>
                                  </a>
                                </li>
                              </ul>
                            </div>

                            <div class="btn-group">
                              <a class="btn" data-edit="bold" title="Bold (Ctrl/Cmd+B)"><i class="fa fa-bold"></i></a>
                              <a class="btn" data-edit="italic" title="Italic (Ctrl/Cmd+I)"><i class="fa fa-italic"></i></a>
                              <a class="btn" data-edit="strikethrough" title="Strikethrough"><i class="fa fa-strikethrough"></i></a>
                              <a class="btn" data-edit="underline" title="Underline (Ctrl/Cmd+U)"><i class="fa fa-underline"></i></a>
                            </div>

                            <div class="btn-group">
                              <a class="btn" data-edit="insertunorderedlist" title="Bullet list"><i class="fa fa-list-ul"></i></a>
                              <a class="btn" data-edit="insertorderedlist" title="Number list"><i class="fa fa-list-ol"></i></a>
                              <a class="btn" data-edit="outdent" title="Reduce indent (Shift+Tab)"><i class="fa fa-dedent"></i></a>
                              <a class="btn" data-edit="indent" title="Indent (Tab)"><i class="fa fa-indent"></i></a>
                            </div>

                            <div class="btn-group">
                              <a class="btn" data-edit="justifyleft" title="Align Left (Ctrl/Cmd+L)"><i class="fa fa-align-left"></i></a>
                              <a class="btn" data-edit="justifycenter" title="Center (Ctrl/Cmd+E)"><i class="fa fa-align-center"></i></a>
                              <a class="btn" data-edit="justifyright" title="Align Right (Ctrl/Cmd+R)"><i class="fa fa-align-right"></i></a>
                              <a class="btn" data-edit="justifyfull" title="Justify (Ctrl/Cmd+J)"><i class="fa fa-align-justify"></i></a>
                            </div>

                            <div class="btn-group">
                              <a class="btn dropdown-toggle" data-toggle="dropdown" title="Hyperlink"><i class="fa fa-link"></i></a>
                              <div class="dropdown-menu input-append">
                                <input class="span2" placeholder="URL" type="text" data-edit="createLink" />
                                <button class="btn" type="button">Add</button>
                              </div>
                              <a class="btn" data-edit="unlink" title="Remove Hyperlink"><i class="fa fa-cut"></i></a>
                            </div>

                            <div class="btn-group">
                              <a class="btn" title="Insert picture (or just drag & drop)" id="pictureBtn"><i class="fa fa-picture-o"></i></a>
                              <input type="file" data-role="magic-overlay" data-target="#pictureBtn" data-edit="insertImage" />
                            </div>

                            <div class="btn-group">
                              <a class="btn" data-edit="undo" title="Undo (Ctrl/Cmd+Z)"><i class="fa fa-undo"></i></a>
                              <a class="btn" data-edit="redo" title="Redo (Ctrl/Cmd+Y)"><i class="fa fa-repeat"></i></a>
                            </div>
                          </div>

                          <div id="editor" class="editor-wrapper" ><?php echo $tour->itinerary;?></div>
                        </div>
                        </div>
                    </div>
                    <!-- /compose -->
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
            var tour = <?php echo json_encode($tour) ?>;
        function query_submit(){
            $("#query_button").fadeOut(1000);
            $("#query_spinner").fadeIn(100);
             var base_url = "<?php echo base_url(); ?>";
             var form_data =  $('#query_form').serialize();
             form_data = form_data + "&itinerary=" + $('#editor').html();
             form_data = form_data + "&tourid=" + tour.id;
             
             $.ajax({
                     type: "POST",
                     url: base_url+"ajax/updateTour",
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
        