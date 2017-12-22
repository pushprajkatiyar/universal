<div class="right_col" role="main">
    <div class="">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <p class="text-muted font-13 m-b-30">
              Download data
            </p>
            <table id="datatable-buttons" class="table table-striped table-bordered">
              <thead>
                <tr>                    
                  <th>Tour ID</th>
                  <th>Name</th>
                  <th>Description</th>
                  <th>Price</th>
                  <th>Duration</th>
                  <th>URL</th>
                </tr>
              </thead>
              <tbody>
                  <?php foreach ($tours as $tour) { ?>
                  <tr>
                  <td><?php echo $tour->id ?></td>
                  <td><?php echo $tour->name ?></td>
                  <td><?php echo $tour->desc ?></td>
                  <td><?php echo $tour->price ?></td>
                  <td><?php echo $tour->duration ?></td>
                  <td><a href="<?php echo $tour->url ?>" target="_BLANK"><?php echo $tour->url ?></a></td>
                  </tr>
                   <?php } ?>
              </tbody>
            </table>
        </div>
    </div>
</div>