<?php
include 'header.php';
global $conn;
$stmt = $conn->prepare("SELECT MAX(id) AS max_id FROM item");
$stmt->execute();
$invNum = $stmt->fetch(PDO::FETCH_ASSOC);
$max_id = $invNum['max_id'];
?>
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
      <li class="active">Item</li>
    </ol>
    <div class="breadcrumb">
      <a href="print-item" target="_blank" class="btn btn-primary col-sm">
        <i class="fa fa-print"></i>
        Print Item
      </a>
      <?php if ($_SESSION['admin_type'] == 2) { ?>
        <button class="btn btn-primary col-sm pull-right add_equipment">
          <svg class="glyph stroked plus sign">
            <use xlink:href="#stroked-plus-sign" />
          </svg> &nbsp;
          Add Item
        </button>
      <?php } ?>
    </div>
  </div>
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
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-body">
          <table class="table" id="tbl-inventory">
            <thead>
              <tr>
                <th>Model</th>
                <th>Category</th>
                <th>Brand</th>
                <th>Description</th>
                <th>Quantity</th>
                <th>Quantity<br>Available</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="right-sidebar equipment-side">
  <div class="sidebar-form">
    <div class="container-fluid">
      <h4 class="alert bg-success">
        <svg class="glyph stroked plus sign">
          <use xlink:href="#stroked-plus-sign" />
        </svg>
        Add Item
      </h4>
      <form class="frm_addequipment" enctype="multipart/form-data" autocomplete="off">
        <input type="hidden" name="key" value="add_equipment" />
        <input type="hidden" id="maxID" value="<?php echo ++$max_id; ?>">
        <div class="form-group">
          <label for="input_devID">Device ID</label>
          <input type="text" id="input_devID" name="e_number" class="form-control" required readonly>
        </div>
        <div class="form-group">
          <label for="input_e_date">Date Purchase</label>
          <input type="date" id="input_e_date" name="e_date" class="form-control" value="<?= date('Y-m-d') ?>">
        </div>
        <div class="form-group">
          <label for="input_e_serial">Serial #</label>
          <input type="text" id="input_e_serial" name="e_serial" required class="form-control">
        </div>
        <div class="form-group">
          <label for="input_e_model">Model</label>
          <input type="text" id="input_e_model" name="e_model" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="category">Category</label>
          <select name="e_category" id="category" class="form-control" required onchange="return select(this);">
            <option selected disabled>Please select category</option>
            <?php
            global $conn;

            $sql = $conn->prepare("SELECT * FROM category ORDER BY description ASC");
            $sql->execute();
            $count = $sql->rowCount();
            $fetch = $sql->fetchAll();
            if ($count > 0) {
              foreach ($fetch as $key => $value) {
                echo "<option value='" . $value['id'] . "'>" . $value['description'] . "</option>";
              }
            } ?>
          </select>
        </div>
        <div class="form-group">
          <label for="input_e_brand">Brand</label>
          <input type="text" id="input_e_brand" name="e_brand" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="input_e_description">Description</label>
          <textarea name="e_description" id="input_e_description" class="form-control" required></textarea>
        </div>
        <div class="form-group" style="display: none;">
          <label for="input_e_stock">Quantity</label>
          <input type="number" id="input_e_stock" name="e_stock" value="1" class="form-control" min="1" required>
        </div>
        <div class="form-group">
          <label for="input_e_assigned">Assign Room</label>
          <select name="e_assigned" id="input_e_assigned" class="form-control" required>
          </select>
        </div>
        <div class="form-group">
          <label for="input_e_type">Type</label>
          <select type="text" id="input_e_type" name="e_type" class="form-control" required>
            <!-- 						<option disabled selected>Please select type</option>
						<option>Consumable</option> -->
            <option>Non-consumable</option>
          </select>
        </div>
        <div class="form-group">
          <label for="input_e_status">Status</label>
          <select name="e_status" id="input_e_status" class="form-control" required>
            <!-- <option disabled selected>Please select status</option> -->
            <option value="1">Functional</option>
            <option value="2">Damaged</option>
            <option value="3">Lost</option>
          </select>
        </div>

        <div class="form-group">

          <input type="hidden" id="e_mr" name="e_mr" class="form-control">
        </div>

        <div class="form-group">
          <label for="input_e_price">Price</label>
          <input type="number" min="1" id="input_e_price" name="e_price" class="form-control" required>
        </div>

        <div class="form-group">
          <label for="input_e_photo">Photo</label>
          <input type="file" id="input_e_photo" name="e_photo" for="inputPassword3" class="form-control" required />
        </div>


        <div style=" position: sticky; bottom: 0px; background: #e3e1e1; padding-top: 1rem; padding-bottom: 1rem;">
          <div class="row">
            <div class="col-md-6 col-sm-12 col-xs-12">
              <button class="btn btn-danger btn-block cancel-equipment" type="button">
                <i class="fa fa-remove"></i>
                CANCEL
              </button>
            </div>
            <div class="col-md-6 col-sm-12 col-xs-12">
              <button class="btn btn-primary btn-block" type="submit">
                ADD
                <i class="fa fa-check"></i>
              </button>
            </div>
          </div>
        </div>
        <br>
        <br>
        <br>
      </form>
    </div>
  </div>
</div>


<div class="right-sidebar equipment-view">
  <div class="sidebar-form equipment-form">

  </div>
</div>



<?php include 'footer.php'; ?>

<script type="text/javascript">
  function select(e) {
    // I don't know what is this for, hahaha -marr
    var text = e.options[e.selectedIndex].text;
    const div = document.getElementById("devID")
    if (!div) return
    div.value = text + document.getElementById("maxID").value + Math.floor((Math.random() * 1000) + 1);
  }


  $("#tbl-inventory").DataTable({
    ajax: {
      url: "../class/display/display",
      type: "POST",
      data: {
        key: "display_items",
      },
      // dataSrc: function(json) {
      //   console.log(json.data);

      //   return json.data; // IMPORTANT
      // },
    },
    columns: [{
        data: 'i_model',
        className: "text-center"
      },
      {
        data: 'category',
        className: "text-center"
      },
      {
        data: 'i_brand',
        className: "text-center"
      },
      {
        // Description
        data: null,
        className: "text-center",
        render: function(data) {
          const wrapper = `
          <div>${data.category}<br/>${data.i_model} ${data.i_brand}</div>`;
          return wrapper;
        },
      },
      {
        data: 'item_rawstock',
        className: "text-center"
      },
      {
        data: 'items_stock',
        className: "text-center"
      },

      {
        data: null, // Null if need to access the other props of data
        className: "text-center",
        render: function(data) {
          const wrapper = `
          <div class="status">
          <span>${data.damage_count} Damage</span>
          <span>${data.lost_count} Lost</span>
          <span>${data.unreturn_count} Un-Return</span>
          </div>`;
          return wrapper;
        },
      },

      {
        data: null,
        className: "text-center",
        render: function(data) {
          const wrapper = `
            <a href="items_info?item=${data.item_id}" class="btn btn-primary btn-sm">
              More Info
            </a>
          `;
          return wrapper;
        },
      }
    ],
  })
</script>