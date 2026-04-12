<?php include 'header.php' ?>

<div id="sidebar-collapse" class="col-sm-3 col-lg-2 col-md-2 sidebar">
  <?php include 'nav-bar.php'; ?>
</div>


<div class="col-sm-10 col-sm-offset-2 col-md-10 col-md-offset-2 col-lg-10 col-lg-offset-2 main">
  <div class="row">
    <ol class="breadcrumb">
      <li>
        <a href="dashboard">
          <svg class="glyph stroked home">
            <use xlink:href="#stroked-home"></use>
          </svg>
        </a>
      </li>
      <li class="active">Category</li>
    </ol>
    <?php if ($_SESSION['admin_type'] == 2) { ?>
      <div class="breadcrumb" style="display: flex; justify-content: flex-end;">
        <button class="btn btn-primary setting">
          <svg class="glyph stroked plus sign">
            <use xlink:href="#stroked-plus-sign" />
          </svg>
          Add Category
        </button>
      </div>
    <?php } ?>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-body">
          <table class="table table_category">
            <thead>
              <tr>
                <th>#</th>
                <th>Description</th>
                <th>Action</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="right-sidebar editcategory-side">
  <div class="sidebar-form">
    <div class="container-fluid">
      <form class="frm_editcategory">
        <h4 class="alert bg-success"><i class="fa fa-edit"></i> Edit Category</h4>
        <div class="form-group">
          <label>Description</label>
          <input type="text" name="edit_rm_name" class="form-control" autofocus required autocomplete="off">
          <input type="hidden" name="edit_rm_id">
        </div>
        <div class="form-group">
          <div class="col-md-6">
            <button class="btn btn-danger btn-block cancel_editcat" type="button">
              <i class="fa fa-remove"></i>
              CANCEL
            </button>
          </div>
          <div class="col-md-6">
            <button class="btn btn-primary btn-block" type="submit">
              UPDATE
              <i class="fa fa-check"></i>
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="right-sidebar divedit-member">
  <div class="container-fluid">
    <br>
    <br>
    <div class="member-form"></div>
  </div>
</div>


<?php include 'footer.php'; ?>