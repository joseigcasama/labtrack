<?php
include 'header.php';
?>
<div id="sidebar-collapse" class="col-sm-3 col-lg-2 col-md-2 sidebar">
  <?php include 'nav-bar.php'; ?>
</div>



<div class="col-sm-9 col-lg-10 col-md-10 col-lg-offset-2 col-md-offset-2 col-sm-offset-3 main">

  <div class="row">
    <ol class="breadcrumb">
      <li><a href="dashboard"><svg class="glyph stroked home">
            <use xlink:href="#stroked-home"></use>
          </svg></a></li>
      <li class="active">Inventory</li>
    </ol>
    <div class="breadcrumb">
      <div class="row">
        <div class="col-md-12">
          <ul class="nav nav-pills">
            <li class="active"><a href="#new" data-toggle="tab"><i class="fa fa-list"></i>&nbsp;&nbsp;New</a></li>
            <li><a href="#old" data-toggle="tab"><i class="fa fa-question"></i>&nbsp;&nbsp;Old</a></li>
            <li><a href="#lost" data-toggle="tab"><i class="fa fa-question"></i>&nbsp;&nbsp;Lost</a></li>
            <li><a href="#damaged" data-toggle="tab"><i class="fa fa-file-code-o"></i>&nbsp;&nbsp;Damaged</a></li>
            <li><a href="#pulledout" data-toggle="tab"><i class="fa fa-chevron-circle-right"></i>&nbsp;&nbsp;Total Items</a></li>
            <li><a href="#transferred" data-toggle="tab"><i class="fa fa-chevron-circle-right"></i>&nbsp;&nbsp;Transferred</a></li>
            <li><a href="#report2" data-toggle="tab"><i class="fa fa-chevron-circle-right"></i>&nbsp;&nbsp;Borrowed</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="tab-content">
            <div class="tab-pane fade in active" id="new">
              <table class="table table_inventory_new">
                <thead>
                  <tr>
                    <th>Model</th>
                    <th>Category</th>
                    <th>Brand</th>
                    <th>No. of items</th>
                    <th>No. of items left</th>
                  </tr>
                </thead>
              </table>
            </div>
            <div class="tab-pane fade" id="old">
              <table class="table table_inventory_old">
                <thead>
                  <tr>
                    <th>Model</th>
                    <th>Category</th>
                    <th>Brand</th>
                    <th>No. of items</th>
                    <th>Remarks</th>
                  </tr>
                </thead>
              </table>
            </div>
            <div class="tab-pane fade" id="lost">
              <table class="table table_inventory_lost">
                <thead>
                  <tr>
                    <th>Model</th>
                    <th>Category</th>
                    <th>Brand</th>
                    <th>No. of items</th>
                    <th>Remarks</th>
                  </tr>
                </thead>
              </table>
            </div>
            <div class="tab-pane fade" id="damaged">
              <table class="table table_inventory_damaged">
                <thead>
                  <tr>
                    <th>Model</th>
                    <th>Category</th>
                    <th>Brand</th>
                    <th>No. of items</th>
                    <th>Remarks</th>
                  </tr>
                </thead>
              </table>
            </div>
            <div class="tab-pane fade" id="pulledout">
              <table class="table table_inventory_all">
                <thead>
                  <tr>
                    <th>Category</th>
                    <th>Available</th>
                    <th>Unusable (Damage/Lost/Borrowed)</th>
                    <th>Total</th>
                  </tr>
                </thead>
              </table>
            </div>
            <div class="tab-pane fade" id="transferred">
              <table class="table table_inventory_transfer">
                <thead>
                  <tr>
                    <th>Model</th>
                    <th>Category</th>
                    <th>Brand</th>
                    <th>No. of items</th>
                    <th>Room</th>
                  </tr>
                </thead>
              </table>
            </div>
            <div class="tab-pane fade" id="report2">
              <table class="table table_inventory_transfer">
                <thead>


                  <tr>
                    <div id="" style=" margin-right:20px">
                      <label>Select Month:&nbsp &nbsp </label>
                      <?php

                      $pic = mysql_query("Select * from borrow where progid<>0 order by borrow asc");
                      echo "<select name = 'month' onchange='location = this.value;'class ='span2' style=\"margin-top:-10px; width:280px; border: 2px solid #0099CC;\">";
                      echo "</option>";
                      while ($pics = mysql_fetch_array($pic)) {
                        $fname = $pics['date_return'];
                        $mname = $pics['date_return'];

                        echo "<option   value = 'viewreport.php?program={$fname}'";
                        if ($selected_venue_id == $fname)
                          echo "selected = 'selected'";
                        echo strtoupper(">{$mname}</a></option>");
                      }
                      echo "</select>";
                      ?>

                    </div>
                    <hr />

                    <th>Borrower</th>
                    <th>Items</th>
                    <th>Borrowed Date</th>
                    <th>Returned Date</th>

                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div><!-- panel -->
    </div><!-- panel -->
  </div><!-- row -->


</div>



<?php include 'footer.php'; ?>