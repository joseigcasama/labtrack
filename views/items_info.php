<?php include 'header.php' ?>
<div id="sidebar-collapse" class="col-sm-3 col-lg-2 col-md-2 sidebar">
  <?php include 'nav-bar.php'; ?>
</div>



<div class="col-sm-9 col-lg-10 col-md-10 col-lg-offset-2 col-md-offset-2 col-sm-offset-3 main">
  <div class="row">
    <ol class="breadcrumb">
      <li>
        <a href="dashboard">
          <svg class="glyph stroked home">
            <use xlink:href="#stroked-home"></use>
          </svg>
        </a>
      </li>
      <li class=""><a href="items">Items</a></li>
      <li class="active">Items Information</li>
    </ol>
    <div class="breadcrumb">
      <button class="btn btn-primary item-add" type="button">
        <i class="fa fa-plus"></i>
        Add Quantity
      </button>
      <button class="btn btn-primary item-edit" type="button">
        <i class="fa fa-edit"></i>
        Edit Item
      </button>
      <button class="btn btn-primary item-change" type="button">
        <i class="fa fa-arrows-alt"></i>
        Change Status
      </button>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="col-lg-5">
            <div class="form-group">
              <p class="e_photo"></p>
            </div>
            <div class="form-group">
              <p class="e_qr"></p>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="form-group">
              <label>Serial ID</label>
              <p class="e_id"></p>
            </div>
            <div class="form-group">
              <label>Model</label>
              <p class="e_model"></p>
            </div>
            <div class="form-group">
              <label>Category</label>
              <p class="e_category"></p>
            </div>
            <div class="form-group">
              <label>Brand</label>
              <p class="e_brand"></p>
            </div>
            <div class="form-group">
              <label>Description</label>
              <p class="e_description"></p>
            </div>
            <div class="form-group">
              <label>Quantity</label>
              <p class="e_stock"></p>
            </div>
            <div class="form-group">
              <label>Quantity Left</label>
              <p class="e_stockleft"></p>
            </div>
            <div class="form-group">
              <label>Type</label>
              <p class="e_type"></p>
            </div>
            <div class="form-group">
              <label>Status</label>
              <p class="e_status"></p>
            </div>
            <div class="form-group">
              <label>Price per Item</label>
              <p class="e_price"></p>
            </div>
          </div>
          <div class="col-lg-2"></div>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="right-sidebar equipment-info">
  <div class="sidebar-form">
    <div class="container-fluid equipment-forminfo"></div>
  </div>
</div>

<style type="text/css">
  label {
    font-weight: bolder;
  }
</style>

<?php include 'footer.php'; ?>

<script type="text/javascript">
  var id = '<?php echo $_GET["item"]; ?>';

  equipment_info(id);

  function getequipmentid() {
    return id;
  }
</script>