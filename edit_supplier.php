<?php
  $page_title = 'Edit Supplier';
  require_once('includes/load.php');
  // Check user permission level
  page_require_level(2);

  // Fetch the supplier data based on the provided ID
  $supplier = find_by_id('suppliers', (int)$_GET['id']);
  $all_photos = find_all('media');

  if (!$supplier) {
    $session->msg("d", "Missing supplier id.");
    redirect('supplier.php');
  }
?>

<?php
if (isset($_POST['update_supplier'])) {
    $req_fields = array('supplier-name', 'supplier-address', 'supplier-eaddress', 'supplier-contact');
    validate_fields($req_fields);

    if (empty($errors)) {
        $s_name  = remove_junk($db->escape($_POST['supplier-name']));
        $s_add   = remove_junk($db->escape($_POST['supplier-address']));
        $s_eadd  = remove_junk($db->escape($_POST['supplier-eaddress']));
        $s_cont  = remove_junk($db->escape($_POST['supplier-contact']));
        $media_id = empty($_POST['supplier-photo']) ? '0' : remove_junk($db->escape($_POST['supplier-photo']));
        $date    = make_date();

        $query   = "UPDATE suppliers SET";
        $query  .=" name='{$s_name}', address='{$s_add}', eaddress='{$s_eadd}',";
        $query  .=" contact='{$s_cont}', image='{$media_id}', date='{$date}'";
        $query  .=" WHERE id='{$supplier['id']}'";

        $result = $db->query($query);
        if ($result && $db->affected_rows() === 1) {
            $session->msg('s', "Supplier updated successfully!");
            redirect('supplier.php', false);
        } else {
            $session->msg('d', 'Sorry, failed to update supplier.');
            redirect('edit_supplier.php?id=' . $supplier['id'], false);
        }
    } else {
        $session->msg("d", $errors);
        redirect('edit_supplier.php?id=' . $supplier['id'], false);
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
  <div class="panel panel-default">
    <div class="panel-heading">
      <strong>
        <span class="glyphicon glyphicon-th"></span>
        <span>Edit Supplier</span>
      </strong>
    </div>
    <div class="panel-body">
      <div class="col-md-7">
        <form method="post" action="edit_supplier.php?id=<?php echo (int)$supplier['id']; ?>">
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon">
                <i class="glyphicon glyphicon-user"></i>
              </span>
              <input type="text" class="form-control" name="supplier-name" value="<?php echo remove_junk($supplier['name']); ?>" placeholder="Company Name">
            </div>
          </div>
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon">
                <i class="glyphicon glyphicon-home"></i>
              </span>
              <input type="text" class="form-control" name="supplier-address" value="<?php echo remove_junk($supplier['address']); ?>" placeholder="Address">
            </div>
          </div>
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon">
                <i class="glyphicon glyphicon-envelope"></i>
              </span>
              <input type="email" class="form-control" name="supplier-eaddress" value="<?php echo remove_junk($supplier['eaddress']); ?>" placeholder="Email Address">
            </div>
          </div>
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon">
                <i class="glyphicon glyphicon-phone"></i>
              </span>
              <input type="text" class="form-control" name="supplier-contact" value="<?php echo remove_junk($supplier['contact']); ?>" placeholder="Contact Number">
            </div>
          </div>
          <div class="form-group">
            <select class="form-control" name="supplier-photo">
              <option value="">No image</option>
              <?php foreach ($all_photos as $photo): ?>
                <option value="<?php echo (int)$photo['id']; ?>" <?php if ($supplier['image'] === $photo['id']): echo "selected"; endif; ?>>
                  <?php echo $photo['file_name']; ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
          <button type="submit" name="update_supplier" class="btn btn-primary">Update Supplier</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include_once('layouts/footer.php'); ?>
