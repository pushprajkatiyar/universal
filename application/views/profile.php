<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>User Profile</h3>
              </div>
            </div>
            
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>User Report <small>Activity report</small></h2>
                    <div class="clearfix"></div>
                  </div>
                    <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                      <div class="profile_img">
                        <div id="crop-avatar">
                          <!-- Current avatar -->
                          <img class="img-responsive avatar-view" src="build/images/No_Profile.png" alt="Avatar" title="Change the avatar" width="250px" height="250px  ">
                        </div>
                      </div>
                      <h3><?php echo $user['name']; ?></h3>

                      <ul class="list-unstyled user_data">
                        <li><i class="fa fa-map-marker user-profile-icon"></i> <?php echo $user['address1']." ".$user['address2']." ".$user['address2']." ".$user['city']." ".$user['state']; ?>
                        </li>

<!--                        <li>
                          <i class="fa fa-briefcase user-profile-icon"></i> Agent
                        </li>-->

                        <li class="m-top-xs">
                          <i class="fa fa-external-link user-profile-icon"></i>
                          <a href="#" target="_blank"><?php echo $user['phone'];?></a>
                        </li>
                        <li class="m-top-xs">
                          <i class="fa fa-external-link user-profile-icon"></i>
                           <?php echo $user['email'];?>
                        </li>
                      </ul>

                      <!--<a class="btn btn-success"><i class="fa fa-edit m-right-xs"></i>Edit Profile</a>-->
                      <br />

                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-12">

                      <div class="profile_title">
                        <div class="col-md-6">
                          <h2>User Activity Report</h2>
                        </div>
                      </div>
                      <!-- start of user-activity-graph -->
                      <div id="graph_bar" style="width:100%; height:280px;"></div>
                      <!-- end of user-activity-graph -->
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>