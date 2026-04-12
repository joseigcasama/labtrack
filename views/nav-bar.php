	<?php
  function current_route(string $file): string
  {
    return basename($_SERVER['PHP_SELF']) === "{$file}.php" ? "active" : '';
  }
  ?>

	<style>
	  ul.space-y-0\.3> :not(:last-child) {
	    margin-block-end: 3px;
	  }
	</style>

	<ul class="nav menu space-y-0.3">
	  <li style="height: 1rem;"></li>
	  <?php if ($_SESSION['admin_type'] == 1 || $_SESSION['admin_type'] == 2) { ?>
	    <li class="<?= current_route("dashboard") ?>">
	      <a href="dashboard">
	        <svg class="glyph stroked home">
	          <use xlink:href="#stroked-home"></use>
	        </svg>
	        Dashboard
	      </a>
	    </li>
	  <?php } ?>
	  <?php if ($_SESSION['admin_type'] >= 3) { ?>
	    <li class="parent ">
	      <a href="#">
	        <span data-toggle="collapse" href="#sub-item-1">
	          <svg class="glyph stroked chevron-down">
	            <use xlink:href="#stroked-chevron-down"></use>
	          </svg>
	        </span> Transaction
	      </a>
	      <ul class="children collapse" id="sub-item-1">
	        <li>
	          <a class="" href="new">
	            <svg class="glyph stroked plus sign">
	              <use xlink:href="#stroked-plus-sign" />
	            </svg>
	            New
	          </a>
	        </li>
	        <li>
	          <a class="borrow" href="borrow">
	            <svg class="glyph stroked download">
	              <use xlink:href="#stroked-download" />
	            </svg>
	            Borrowed Items
	          </a>
	        </li>
	      </ul>
	    </li>
	  <?php }
    if ($_SESSION['admin_type'] == 2) {

      // For transaction dropdown to keep it open
      $openDropdown = in_array(
        basename($_SERVER['PHP_SELF']),
        ['pending.php', 'borrow.php', 'return.php']
      );

    ?>

	    <style>
	      /* Para sa transaction dropdown's svg */
	      a[href="#sub-item-1"]:not(.collapsed) svg {
	        transform: scaleY(-1) !important;
	      }

	      .textWhite {
	        color: white !important;
	      }

	      .items {
	        display: flex !important;
	        align-items: center !important;
	        padding: .8rem 0px .8rem 30px !important;
	        height: auto !important;
	      }

	      .items span {
	        line-height: normal !important;
	      }
	    </style>


	    <li class="parent ">
	      <a data-toggle="collapse" href="#sub-item-1" class="<?= $openDropdown ? '' : 'collapsed' ?>">
	        <span>
	          <svg class="glyph stroked chevron-down">
	            <use xlink:href="#stroked-chevron-down"></use>
	          </svg>
	        </span>
	        <span>Transaction</span>
	      </a>



	      <ul class="children collapse <?= $openDropdown ? 'in' : '' ?>" id="sub-item-1">
	        <li>
	          <a class="borrow items <?= current_route("pending") ?>" href="pending" style="<?= current_route("pending") ? 'color: white !important' : '' ?>">
	            <svg class="glyph stroked download">
	              <use xlink:href="#stroked-download" />
	            </svg>

	            <span>
	              Pending Borrowed Items
	            </span>
	          </a>
	        </li>
	        <li>
	          <a class="borrow items <?= current_route("borrow") ?>" href="borrow" style="<?= current_route("borrow")  ? 'color: white !important' : '' ?>">
	            <svg class="glyph stroked download">
	              <use xlink:href="#stroked-download" />
	            </svg>
	            <span>Borrowed Items</span>

	          </a>
	        </li>
	        <li>
	          <a class="items <?= current_route("return") ?>" href="return" style="<?= current_route("return")  ? 'color: white !important' : '' ?>">
	            <svg class="glyph stroked checkmark">
	              <use xlink:href="#stroked-checkmark" />
	            </svg>
	            <span>Returned Items</span>

	          </a>
	        </li>
	      </ul>
	    </li>
	  <?php } ?>
	  <?php if ($_SESSION['admin_type'] == 2) { ?>
	    <li class="<?= current_route("category") ?>">
	      <a href="category">
	        <svg class="glyph stroked gear">
	          <use xlink:href="#stroked-gear"></use>
	        </svg>
	        Add Category
	      </a>
	    </li>
	    <li class="<?= current_route("items"); current_route("items_info")?>">
	      <a href="items">
	        <svg class="glyph stroked desktop">
	          <use xlink:href="#stroked-desktop" />
	        </svg>
	        Equipment
	      </a>
	    </li>
	  <?php }
    if ($_SESSION['admin_type'] == 1 || $_SESSION['admin_type'] == 2) { ?>

	    <li class="<?= current_route("members") ?>">
	      <a href="members">
	        <svg class="glyph stroked male user ">
	          <use xlink:href="#stroked-male-user" />
	        </svg>
	        Borrower
	      </a>
	    </li>
	    <li class="<?= current_route("room") ?>">
	      <a href="room">
	        <svg class="glyph stroked app-window">
	          <use xlink:href="#stroked-app-window"></use>
	        </svg>
	        Laboratory
	      </a>
	    </li>
	    <?php if ($_SESSION['admin_type'] == 2) { ?>
	      <li class="<?= current_route("inventory") ?>">
	        <a href="inventory">
	          <svg class="glyph stroked clipboard with paper">
	            <use xlink:href="#stroked-clipboard-with-paper" />
	          </svg>
	          Inventory
	        </a>
	      </li>
	    <?php }
      if ($_SESSION['admin_type'] == 1) { ?>
	      <li class="<?= current_route("user") ?>">
	        <a href="user">
	          <svg class="glyph stroked female user">
	            <use xlink:href="#stroked-female-user" />
	          </svg>
	          User
	        </a>
	      </li>
	  <?php }
    }
    ($_SESSION['admin_type'] == 1) ? include('include_history.php') : false;
    ?>

	</ul>
	<!-- 		<div class="form-group">
				<center><img src="logo.png" style="width: 200px;height: 200px;"></center>
			</div> -->