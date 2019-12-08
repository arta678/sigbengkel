
<div class="bg-light border-right" id="sidebar-wrapper">
  <div class="sidebar-heading">SIG BENGKEL</div>
  <div class="list-group list-group-flush">
    <a href="index.php" class="list-group-item list-group-item-action bg-light">Peta</a>
<?php if (isset($_SESSION['id'])) {?>
	<a href="dataBengkel.php" class="list-group-item list-group-item-action bg-light">Data Bengkel</a>
	<a href="login/logout.php" class="list-group-item list-group-item-action bg-light">Logout</a>
<?php  }else{?>
	<a href="login/login.php" class="list-group-item list-group-item-action bg-light">Login</a>
<?php } ?>
    
    
    
  </div>
</div>
