<?php
  ob_start();
  require_once('includes/load.php');
  if($session->isUserLoggedIn(true)) { redirect('home.php', false);}
?>
<?php include_once('layouts/header.php'); ?>

<!-- Add the CSS to center the panel -->
<style>
  .login-page {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 50vh; /* Full viewport height */
  }
  .login-container {
    text-align: center;
    max-width: 400px; /* Set a maximum width for the panel */
    width: 100%;
    margin: auto;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 5px;
    background-color: #f8f9fa; /* Optional background color */
  }
</style>

<div class="login-page">
  <div class="login-container">
    <div class="text-center">
       <h1>Login Panel</h1>
       <h4>Inventory Management System</h4>
       <h4>DRAF Office Furniture</h4>
    </div>
    <?php echo display_msg($msg); ?>
    <form method="post" action="auth.php" class="clearfix">
      <div class="form-group">
        <label for="username" class="control-label">Username</label>
        <input type="name" class="form-control" name="username" placeholder="Username">
      </div>
      <div class="form-group">
        <label for="Password" class="control-label">Password</label>
        <input type="password" name="password" class="form-control" placeholder="Password">
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-danger" style="border-radius:0%">Login</button>
      </div>
    </form>
  </div>
</div>

<?php include_once('layouts/footer.php'); ?>
