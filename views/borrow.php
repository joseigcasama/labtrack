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
      <li class="active">Borrowed Items</li>
    </ol>
  </div><!--/.row-->

  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-body">
          <table class="table table-bordered tbl_borrow" style="width:100%;">
            <thead>
              <tr>
                <th>Borrow Code</th>
                <th>Borrow Date</th>
                <th>Borrower Name</th>
                <th>Items Borrowed</th>
                <th>Room</th>
                <th>Due Date</th>
                <th>Action</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </div>

</div>
<div class="right-sidebar return-side">
  <div class="sidebar-form">
    <div class="container-fluid">
      <form class="frm_return">
        <h4 class="alert bg-success"><i class="fa fa-edit"></i> Return Item</h4>
        <div class="form-group">
          <label>Item Status</label>
          <select name="e_status" class="form-control" autofocus required>
            <option value="1">Good</option>
            <option value="3">Lost</option>
            <option value="4">Damage</option>
          </select>
          <input type="hidden" name="edit_item_id">
          <input type="hidden" name="stock_id">
        </div>
        <div class="form-group">
          <label>Return Date (mm/dd/yyyy)</label>
          <input type="date" name="date" class="form-control" value="<?= date("Y-m-d") ?>">
        </div>
        <div class="form-group">
          <label>Remarks</label>
          <textarea name="remarks" class="form-control" autofocus required rows="auto"></textarea>
        </div>
        <div class="form-group">
          <div class="col-md-6">
            <button class="btn btn-danger btn-block cancel_return_item" type="button">
              <i class="fa fa-remove"></i>
              CANCEL
            </button>
          </div>
          <div class="col-md-6">
            <button class="btn btn-primary btn-block" type="submit">
              RETURN
              <i class="fa fa-check"></i>
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<!--  -->
<?php include 'footer.php'; ?>