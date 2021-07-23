<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Signin</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="<?php echo e(asset('assets/backend/plugins/fontawesome-free/css/all.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('assets/backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('assets/backend/dist/css/adminlte.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('assets/backend/plugins/toastr/toastr.min.css')); ?>">
</head>
<body class="hold-transition login-page">
  
<div class="login-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="#" class="h1"><b>Sign</b>In</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Masuk Ke Akun Anda</p>
      <form action="<?php echo e(url('sudo/signin')); ?>" method="post">
      	<?php echo csrf_field(); ?>
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" name="email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Ingat Saya
              </label>
            </div>
          </div>
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Masuk</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="<?php echo e(asset('assets/backend/plugins/jquery/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/backend/plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/backend/dist/js/adminlte.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/backend/plugins/toastr/toastr.min.js')); ?>"></script>

<!-- JIKA ADA SESSION SUCCESS DARI SERVER -->
<?php if(Session::has("success")): ?> 
    <script>
        toastr.success(
        	"<?php echo e(Session::get('success')['text']); ?>",
        	"<?php echo e(Session::get('success')['title']); ?>"
        );
    </script>
<?php endif; ?>

<!-- JIKA ADA SESSION ERROR DARI SERVER -->
<?php if(Session::has("error")): ?>
	<script>
	    toastr.error(
	    	"<?php echo e(Session::get('error')['text']); ?>",
	    	"<?php echo e(Session::get('error')['title']); ?>"
	    );
	</script>
<?php endif; ?>    

<script>
if ('serviceWorker' in navigator) {
  var newVersion = "V1";

  var version = localStorage.getItem('SW');

  !version ? localStorage.setItem('SW',newVersion) : '';

  console.log('START SW');

  navigator.serviceWorker.register("<?php echo e(asset('service-worker.js')); ?>")
  .then(function(registration) {
    if(version != newVersion){
        registration.unregister()
            .then(function(isUnregister){
            if(isUnregister){
                console.log('UNREGISTER SW');
                localStorage.setItem('SW',newVersion);
            }
        });    
    }

    console.log('SUCCESS SW');
   }).catch(() => {    
    console.log('FAILED SW');
  });
} else {
    console.log('NOT FOUND SW');
}
</script>
</body>
</html><?php /**PATH C:\xampp\htdocs\portfolio dan articel\resources\views/sudo/signin.blade.php ENDPATH**/ ?>