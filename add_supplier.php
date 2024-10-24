<?php
  $page_title = 'Add Supplier';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);
  $all_photos = find_all('media'); // Fetch all media for supplier photos
?>

<?php
if (isset($_POST['add_supplier'])) {
    $req_fields = array('supplier-name', 'supplier-address', 'supplier-eaddress', 'supplier-contact');
    validate_fields($req_fields);
    
    if (empty($errors)) {
        $s_name  = remove_junk($db->escape($_POST['supplier-name']));
        $s_add   = remove_junk($db->escape($_POST['supplier-address']));
        $s_eadd  = remove_junk($db->escape($_POST['supplier-eaddress']));
        $s_cont  = remove_junk($db->escape($_POST['supplier-contact']));
        $media_id = empty($_POST['supplier-photo']) ? '0' : remove_junk($db->escape($_POST['supplier-photo']));
        $date    = make_date();

        $query  = "INSERT INTO suppliers (name, address, eaddress, contact, image, date) VALUES (
            '{$s_name}', '{$s_add}', '{$s_eadd}', '{$s_cont}', '{$media_id}', '{$date}'
        )";

        if ($db->query($query)) {
            $session->msg('s', "Supplier added successfully!");
            redirect('supplier.php', false);
        } else {
            $session->msg('d', 'Sorry, failed to add supplier.');
            redirect('add_supplier.php', false);
        }
    } else {
        $session->msg("d", $errors);
        redirect('add_supplier.php', false);
    }
}
?>

<?php include_once('layouts/header.php'); ?>

<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
</div>

<div class="row">
  <div class="col-md-8">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Add New Supplier</span>
        </strong>
      </div>
      <div class="panel-body">
        <form method="post" action="add_supplier.php" class="clearfix">
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon">
                <i class="glyphicon glyphicon-th-large"></i>
              </span>
              <input type="text" class="form-control" name="supplier-name" placeholder="Company Name">
            </div>
          </div>
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon">
                <i class="glyphicon glyphicon-th-large"></i>
              </span>
              <input type="text" class="form-control" name="supplier-address" placeholder="Address">
            </div>
          </div>
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon">
                <i class="glyphicon glyphicon-envelope"></i>
              </span>
              <input type="email" class="form-control" name="supplier-eaddress" placeholder="Email Address">
            </div>
          </div>
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon">
                <i class="glyphicon glyphicon-phone"></i>
              </span>
              <input type="text" class="form-control" name="supplier-contact" placeholder="Contact Number">
            </div>
          </div>
          <div class="form-group">
            <select class="form-control" name="supplier-photo">
              <option value="">Select Supplier Photo</option>
              <?php foreach ($all_photos as $photo): ?>
                <option value="<?php echo (int)$photo['id']; ?>">
                  <?php echo $photo['file_name']; ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
          <button type="submit" name="add_supplier" class="btn btn-primary">Add Supplier</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include_once('layouts/footer.php'); ?>
