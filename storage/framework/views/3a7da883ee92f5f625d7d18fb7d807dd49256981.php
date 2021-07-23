

<?php $__env->startSection('content'); ?>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Home</h1>
          </div>          
        </div>
      </div>
    </section>
    
    <section class="content">
      <div class="card">      
        <div class="card-body text-center p-4">
          <img src="<?php echo e(asset('assets/images/home.png')); ?>"
            style="width:70%">
          <h5 class="mt-4">Selamat Datang <?php echo e(ucwords(Auth::user()->name)); ?></h5>
          <p>
            Selamat Datang Di Dashboard <?php echo e(ucwords(Auth::user()->name)); ?>

          </p>
        </div>     
      </div>
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("layout.default", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\portfolio dan articel\resources\views/sudo/home.blade.php ENDPATH**/ ?>