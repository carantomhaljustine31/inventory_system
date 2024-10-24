<?php
$page_title = 'All Product';
require_once('includes/load.php');
// Checkin What level user has permission to view this page
page_require_level(2);
$products = join_product_table();
?>
<?php include_once('layouts/header.php'); ?>

<div class="row">
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
                        <option value="price_asc" <?php echo isset($_GET['sort']) && $_GET['sort'] === 'price_asc' ? 'selected' : ''; ?>>Price (Low to High)</option>
                        <option value="price_desc" <?php echo isset($_GET['sort']) && $_GET['sort'] === 'price_desc' ? 'selected' : ''; ?>>Price (High to Low)</option>
                        <option value="quantity" <?php echo isset($_GET['sort']) && $_GET['sort'] === 'quantity' ? 'selected' : ''; ?>>Quantity</option>
                        <option value="category" <?php echo isset($_GET['sort']) && $_GET['sort'] === 'category' ? 'selected' : ''; ?>>Category</option>
                    </select>
                    <button type="submit" class="btn btn-primary" style="margin-left: 80px; margin-top: 10px;">SORT</button>
                </div>
            </form>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading clearfix">
                <div class="pull-right">
                    <a href="add_product.php" class="btn btn-primary" style="margin-top: 40px;">Add New</a>
                </div>
            </div>
            <div class="panel-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 50px;">#</th>
                            <th>Photo</th>
                            <th>Product Title</th>
                            <th class="text-center" style="width: 10%;">Categories</th>
                            <th class="text-center" style="width: 10%;">In-Stock</th>
                            <th class="text-center" style="width: 10%;">Buying Price</th>
                            <th class="text-center" style="width: 10%;">Selling Price</th>
                            <th class="text-center" style="width: 10%;">Product Added</th>
                            <th class="text-center" style="width: 10%;">Low Stock Threshold</th> <!-- New Column Header -->
                            <th class="text-center" style="width: 100px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $product): ?>
                        <tr>
                            <td class="text-center"><?php echo count_id();?></td>
                            <td>
                                <?php if ($product['media_id'] === '0'): ?>
                                    <img class="img-avatar img-circle" src="uploads/products/no_image.png" alt="">
                                <?php else: ?>
                                    <img class="img-avatar img-circle" src="uploads/products/<?php echo $product['image']; ?>" alt="">
                                <?php endif; ?>
                            </td>
                            <td><?php echo remove_junk($product['name']); ?></td>
                            <td class="text-center"><?php echo remove_junk($product['categorie']); ?></td>
                            <td class="text-center"><?php echo remove_junk($product['quantity']); ?></td>
                            <td class="text-center"><?php echo remove_junk($product['buy_price']); ?></td>
                            <td class="text-center"><?php echo remove_junk($product['sale_price']); ?></td>
                            <td class="text-center"><?php echo read_date($product['date']); ?></td>
                            <td class="text-center"><?php echo remove_junk($product['low_stock_threshold']); ?></td> <!-- New Column Value -->
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="edit_product.php?id=<?php echo (int)$product['id'];?>" class="btn btn-info btn-xs" title="Edit" data-toggle="tooltip">
                                        <span class="glyphicon glyphicon-edit"></span>
                                    </a>
                                    <a href="delete_product.php?id=<?php echo (int)$product['id'];?>" 
                                       class="btn btn-danger btn-xs" 
                                       title="Delete" 
                                       data-toggle="tooltip" 
                                       onclick="return confirmDelete();">
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

<script type="text/javascript">
function confirmDelete() {
    return confirm('Are you sure you want to delete this product? This action cannot be undone.');
}
</script>

<?php include_once('layouts/footer.php'); ?>
