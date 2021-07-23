<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="<?php echo e(asset('assets/backend/plugins/fontawesome-free/css/all.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('assets/backend/dist/css/adminlte.min.css')); ?>">  
  <link rel="stylesheet" href="<?php echo e(asset('assets/backend/plugins/sweetalert2/sweetalert2.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('assets/backend/plugins/toastr/toastr.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('assets/backend/plugins/summernote/summernote-bs4.min.css')); ?>">
  <style>
     .parsley-errors-list{
      color:red;
      list-style:none;
      padding:8px;
      opacity: 0.8;
     }
  </style>
</head>
<body class="hold-transition sidebar-mini">

<div class="wrapper">
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>     
    </ul>

    <ul class="navbar-nav ml-auto">   
      <li class="nav-item">
        <a href="<?php echo e(url('sudo/logout')); ?>" class="nav-link">
          <i class="fa fa-power-off"></i> Keluar
        </a>
      </li>      
    </ul>
  </nav>

  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="<?php echo e(url('sudo/home')); ?>" class="brand-link">
      <img src="<?php echo e(asset('assets/backend/dist/img/AdminLTELogo.png')); ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo e(asset('assets/images/users/'.Auth::user()->photo)); ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">
            <?php echo e(ucwords(Auth::user()->name)); ?>

          </a>
        </div>
      </div>

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">                  
          <li class="nav-item">
            <a href="<?php echo e(url('sudo/user')); ?>" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Kelola User
              </p>
            </a>
          </li>          
          <li class="nav-item">
            <a href="<?php echo e(url('sudo/articel')); ?>" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Kelola Artikel
              </p>
            </a>
          </li>        
        </ul>
      </nav>
    </div>
  </aside>

  <div class="content-wrapper">   
    <?php echo $__env->yieldContent("content"); ?>
  </div>
</div>

<script src="<?php echo e(asset('assets/backend/plugins/jquery/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/backend/plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/backend/dist/js/adminlte.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/backend/plugins/toastr/toastr.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/backend/plugins/sweetalert2/sweetalert2.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/backend/dist/js/toastr.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/backend/plugins/summernote/summernote-bs4.min.js')); ?>"></script>

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

<?php echo $__env->yieldContent("sc_footer"); ?>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\portfolio dan articel\resources\views/layout/default.blade.php ENDPATH**/ ?>