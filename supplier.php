<?php
  $page_title = 'All Suppliers';
  require_once('includes/load.php');
  // Check what level user has permission to view this page
  page_require_level(2);
  
  // Initialize $msg
  $msg = '';

  // Fetch supplier data
  $suppliers = join_supplier_table(); // Function to fetch supplier data
  
  // Check if suppliers are empty
  if (!$suppliers) {
    $msg = 'No suppliers found.';
    $suppliers = []; // Ensure $suppliers is an array
  }
?>

<?php include_once('layouts/header.php'); ?>

<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
  <div class="col-md-12">
    <div class="panel-heading clearfix">
      <div class="pull-left">
        <form method="GET" action="">
          <div class="form-group">
            <select name="sort" id="sort" class="form-control" style="margin-left: 20px; margin-top: 10px;">
              <option value="name_asc" <?php echo isset($_GET['sort']) && $_GET['sort'] === 'name_asc' ? 'selected' : ''; ?>>Name (A-Z)</option>
              <option value="name_desc" <?php echo isset($_GET['sort']) && $_GET['sort'] === 'name_desc' ? 'selected' : ''; ?>>Name (Z-A)</option>
              <option value="company_asc" <?php echo isset($_GET['sort']) && $_GET['sort'] === 'company_asc' ? 'selected' : ''; ?>>Company Name (A-Z)</option>
              <option value="company_desc" <?php echo isset($_GET['sort']) && $_GET['sort'] === 'company_desc' ? 'selected' : ''; ?>>Company Name (Z-A)</option>
            </select>
            <button type="submit" class="btn btn-primary" style="margin-left: 80px; margin-top: 10px;">SORT</button>
          </div>
        </form>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
          <div class="pull-right">
            <a href="add_supplier.php" class="btn btn-primary" style="margin-top: 40px;">Add New</a>
          </div>
        </div>
        <div class="panel-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="text-center" style="width: 50px;">#</th>
                <th> Photo </th>
                <th> Supplier Name </th>
                <th> Address </th>
                <th> Email Address </th>
                <th> Contact Number </th>
                <th class="text-center" style="width: 100px;"> Actions </th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($suppliers as $supplier): ?>
              <tr>
                <td class="text-center"><?php echo count_id();?></td>
                <td>
                  <?php if ($supplier['image'] === ''): ?>
                    <img class="img-avatar img-circle" src="uploads/suppliers/no_image.png" alt="">
                  <?php else: ?>
                    <img class="img-avatar img-circle" src="uploads/suppliers/<?php echo $supplier['image']; ?>" alt="">
                  <?php endif; ?>
                </td>
                <td> <?php echo remove_junk($supplier['name']); ?></td>
                <td> <?php echo remove_junk($supplier['address']); ?></td>
                <td> <?php echo remove_junk($supplier['eaddress']); ?></td>
                <td> <?php echo remove_junk($supplier['contact']); ?></td>
                <td class="text-center">
                  <div class="btn-group">
                    <a href="edit_supplier.php?id=<?php echo (int)$supplier['id'];?>" class="btn btn-info btn-xs" title="Edit" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-edit"></span>
                    </a>
                    <a href="delete_supplier.php?id=<?php echo (int)$supplier['id'];?>" class="btn btn-danger btn-xs" title="Delete" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-trash"></span>
                    </a>
                  </div>
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include_once('layouts/footer.php'); ?>
