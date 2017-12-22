 <!-- page content -->
<div class="right_col" role="main">
    <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Booking Detail Of <small> TRAV<?php echo $booking->id ?></small></h3>
      </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12">
        <div class="x_panel">
          <div class="x_title">
            <!--<h2></h2>-->
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>

          <div class="x_content">

            <div class="col-md-9 col-sm-9 col-xs-12">

              <ul class="stats-overview">
                <li>
                  <span class="name"> Name </span>
                  <span class="value text-success"> <?php echo $booking->name ?> </span>
                </li>
                <li>
                  <span class="name"> Email </span>
                  <span class="value text-success"> <?php echo $booking->email ?> </span>
                </li>
                <li class="hidden-phone">
                  <span class="name"> Phone Number </span>
                  <span class="value text-success"> <?php echo $booking->phone ?> </span>
                </li>
              </ul>
              <ul class="stats-overview">
                <li>
                  <span class="name"> Price Paid </span>
                  <span class="value text-success"> <?php echo $booking->price ?>  </span>
                </li>
                <li>
                  <span class="name"> Actuall Price </span>
                  <span class="value text-success"> <?php echo $booking->tourprice ?>  </span>
                </li>
                <li class="hidden-phone">
                  <span class="name"> Tourist Count </span>
                  <span class="value text-success"> <?php echo $booking->touristCount ?> </span>
                </li>
              </ul>
              <br />

              <div>

                <h4>Recent Activity</h4>

                <!-- end of user messages -->
                <ul class="messages">
                    <?php foreach ($comments as $comment) { ?>
                  <li>
                    <img src="<?php echo base_url(); ?>build/images/img.jpg" class="avatar" alt="Avatar">
<!--                    <div class="message_date">
                      <h3 class="date text-info">24</h3>
                      <p class="month">May</p>
                    </div>-->
                    <div class="message_wrapper">
                      <h4 class="heading"><?php echo $comment->name; ?></h4>
                      <blockquote class="message"><?php echo $comment->comment; ?></blockquote>
                      <br />
                      <p class="title">Date: <?php echo $comment->date; ?></p>
                    </div>
                  </li>
                    <?php } ?> 
                </ul>
                <!-- end of user messages -->
              </div>
            </div>
            <!-- start project-detail sidebar -->
            <div class="col-md-3 col-sm-3 col-xs-12">

              <section class="panel">

                <div class="x_title">
                  <h2>Tour Description</h2>
                  <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                  <h3 class="green"><i class="fa fa-picture-o"></i> <?php echo $booking->tourname ?></h3>
                  <p><?php echo $booking->description ?></p>
                  <br />
                  <h3 class="green"><i class="fa fa-paper-plane-o"></i>ITINERARY:  <a href="<?php echo $booking->toururl ?>" target="_BLANK" >View Itinerary</a></h3>
                  <div class="project_detail">

<!--                    <p class="title">Raised By:</p>
                    <p>Deveint Inc</p>-->
                    <p class="title">Current Status:</p>
                    <p>Tony Chicken</p>
                   
                  </div>
                </div>
              </section>
            </div>
            <!-- end project-detail sidebar -->

          </div>
        </div>
      </div>
    </div>
  </div>
</div>