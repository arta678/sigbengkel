

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SIBASAH | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
      <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
      <link href="css/simple-sidebar.css" rel="stylesheet">
      <link rel="stylesheet" href="style.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="">SIG BENGKEL</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sistem Informasi Bank Sampah</p>
      <!-- <p class="login-box-msg"></p> -->
      <?php if( isset($error) ) : ?>
         <div class="alert alert-error alert-dismissible ">
                    Username dan password salah
                </div>
      <?php endif; ?>
      <form action="" method="post">
        <div class="row">
           <div class="input-group mb-3 col-md-6">
          <input type="text" class="form-control" placeholder="username" id="username" name="username" required>
          
        </div>
        <div class="input-group mb-3 col-md-6">
          <input type="password" class="form-control" name="password" id="password"  required 
          placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
         <div class="col-4">
            <button type="submit" name="login" class="btn btn-primary btn-block btn-flat">Login</button>
          </div>
        </div>
         
          <!-- /.col -->
        </div>
         
      </form>
    </div>
  </div>
</div>
<script src="../../plugins/jquery/jquery.min.js"></script>
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
