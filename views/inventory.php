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
            <!-- <li class="active"><a href="#new" data-toggle="tab"><i class=""></i>&nbsp;&nbsp;New</a></li> -->
            <!-- 							<li><a href="#old" data-toggle="tab"><i class=""></i>&nbsp;&nbsp;Old</a></li>
							<li><a href="#lost" data-toggle="tab"><i class=""></i>&nbsp;&nbsp;Lost</a></li>
							<li><a href="#damaged" data-toggle="tab"><i class=""></i>&nbsp;&nbsp;Damaged</a></li>
							<li><a href="#pulledout" data-toggle="tab"><i class=""></i>&nbsp;&nbsp;Total Items</a></li>
							<li><a href="#transferred" data-toggle="tab"><i class=""></i>&nbsp;&nbsp;Transferred</a></li>
							<li><a href="#report2" data-toggle="tab"><i class=""></i>&nbsp;&nbsp;Borrowed</a></li> -->
          </ul>
        </div>
        <!-- <div class="col-md-2">
						<button class="btn btn-primary add_equipment ">
							<svg class="glyph stroked plus sign">
								<use xlink:href="#stroked-plus-sign"/>
							</svg> &nbsp;
							Add Equipment
						</button>
					</div> -->
      </div>
    </div>
  </div><!--/.row-->


  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="tab-content">
            <div class="tab-pane fade in active" id="new">
              <form method="post" action="print-report" target="_blank">
                <div class="row">
                  <div class="col-sm-1 pull-right">
                    <div class="form-group text-right">
                      <input type="submit" class="btn btn-primary" value="Print Report">
                    </div>
                  </div>
                  <div class="col-sm-3 pull-right">
                    <div class="form-group">
                      <select name="selectYear" class="form-control">
                        <?php
                        $currentYear = date('Y');
                        for ($i = $currentYear; $i >= ($currentYear - 15); $i--):
                        ?>
                          <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php endfor; ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-3 pull-right">
                    <div class="form-group">
                      <select name="selectMonth" class="form-control">
                        <option value="0">Select Option...</option>
                        <?php
                        $monthArr = array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", " Dec");
                        for ($i = 0; $i < 12; $i++):
                          $month = ($i + 1);
                        ?>
                          <option value="<?php echo $month; ?>"><?php echo $monthArr[$i]; ?></option>
                        <?php endfor; ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-3 pull-right">
                    <div class="form-group">
                      <select name="selectStatus" class="form-control">
                        <option value="0">ALL</option>
                        <option value="1">NEW</option>
                        <option value="2">OLD</option>
                        <option value="3">LOST</option>
                        <option value="4">DAMAGE</option>
                      </select>
                    </div>
                  </div>
                </div>
              </form>

              <style>
                div.status {
                  width: max-content;
                  place-self: center;
                  display: flex;
                  flex-direction: column;
                  align-items: flex-start
                }
              </style>
              <div class="row">
                <table class="table table_inventory_new" style="width: 100%;">
                  <thead>
                    <tr>
                      <th>Date <br>M/d/Y</th>
                      <th>Item Description</th>
                      <th>Quantity</th>
                      <th>Quantity<br>Available</th>
                      <th>Status </th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<?php include 'footer.php'; ?>