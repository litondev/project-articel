

<?php $__env->startSection('content'); ?>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Articel</h1>
          </div>          
        </div>
      </div>
    </section>
    
    <section class="content">
      <div class="card">      
        <div class="card-body p-4 table-responsive">
         <p>
         	<div class="clearfix">
         		<div class="float-left mb-4">
         			<button class="btn btn-primary" data-toggle="modal" data-target="#modalAdd"><i class='fa fa-plus'></i> Tambah</button>
	         	</div>

         		<div class="float-right mb-4">
         			<form action="<?php echo e(url('sudo/articel')); ?>">
         				<input type="text" class="form-control" placeholder="Search . . ."
         					name="search" onkeyenter="this.form.submit()">
         			</form>
	         	</div>
        	 </div>
     	</p>

         <table class="table table-boredered table-hover">
         	<tr>
         		<th>Id</th>
         		<th>Title</th>
         		<th>Image</th>         		
         		<th>Dibuat</th>
         		<th>Diupdate</th>
         		<th>Opsi</th>
         	</tr>

         	<?php if(count($articel) == 0): ?>
         	<tr>
         		<td colspan="10">
         			<div class="text-center mt-5 mb-5">
		                <img src="<?php echo e(asset('assets/images/not-found.png')); ?>"
		                    style="width:40%">
		                <h5>Artikel Tidak ditemukan</h5>
		                <p>
		                    Data artikel tidak ditemukan
		                </p>
		            </div>
         		</td>
         	</tr>
         	<?php endif; ?>

         	<?php $__currentLoopData = $articel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
         		<tr>
         			<td><?php echo e($item->id); ?></td>
         			<td><?php echo e(ucwords($item->title)); ?></td>
         			<td>
         				<img src="<?php echo e(asset('assets/images/articels/'.$item->image)); ?>" width="100px"
                            class="img-rounded">
         			</td>         			
         			<td><?php echo e($item->created_at); ?></td>
         			<td><?php echo e($item->updated_at); ?></td>
         			<td>
         				<button class="btn btn-danger mb-2"
         					onclick="onDelete('<?php echo e($item->id); ?>')">
         					<i class='fa fa-trash'></i>
         				</button>
         				<button class="btn btn-success mb-2"
                            onclick="onEdit('<?php echo e($item->id); ?>','<?php echo e($item->title); ?>','<?php echo e($item->content); ?>')"
                            data-toggle="modal" data-target="#modalEdit">
                            <i class='fa fa-edit'></i>
                        </button>
         			</td>
         		</tr>
         	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
         </table>

         <div class="mt-5">
         	<?php echo e($articel->links()); ?>

         </div>
        </div>     
      </div>
    </section>

    <div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal Tambah Articel</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
             <form action="<?php echo e(url('sudo/articel/add')); ?>" method="post" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>

                <div class="input-group mb-3 row">
                  <div class="col-md-2 col-lg-2 col-sm-12 pt-2">Judul : </div>
                  <div class="col-md-10 col-lg-10 col-sm-12"><input type="text" class="form-control" placeholder="Judul" name="title" required></div>
                </div>

                <div class="input-group mb-3 row">
                    <div class="col-md-2 col-lg-2 col-sm-12 pt-2">Gambar : </div>
                    <div class="col-md-10 col-lg-10 col-sm-12"><input type="file" class="form-control" name="image" required></div>
                </div>

                <div class="input-group mb-3 row">
                    <div class="col-md-2 col-lg-2 col-sm-12 pt-2">Kontent : </div>
                    <div class="col-md-10 col-lg-10 col-sm-12"><textarea class="form-control" name="content"  id="add-summernote"></textarea></div>
                </div>

                <div class="row">                
                  <div class="col-12">
                    <button type="submit" class="btn btn-primary"><i class='fa fa-plus'></i> Tambah</button>
                  </div>
                </div>
              </form>
          </div>    
        </div>
      </div>
    </div>

    <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal Edit Articel</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
             <form action="<?php echo e(url('sudo/articel/edit')); ?>" method="post" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <input type="hidden"  name="id" id="edit-id">
                
                <div class="input-group mb-3 row">
                  <div class="col-md-2 col-lg-2 col-sm-12 pt-2">Judul : </div>
                  <div class="col-md-10 col-lg-10 col-sm-12"><input type="text" class="form-control" placeholder="Judul" name="title" required id="edit-title"></div>
                </div>

                <div class="input-group mb-3 row">
                    <div class="col-md-2 col-lg-2 col-sm-12 pt-2">Gambar : </div>
                    <div class="col-md-10 col-lg-10 col-sm-12">
                        <input type="file" class="form-control" name="image">
                        <small class="text-muted">* Isi jika ingin menganti gambar</small>
                    </div>
                </div>

                <div class="input-group mb-3 row">
                    <div class="col-md-2 col-lg-2 col-sm-12 pt-2">Kontent : </div>
                    <div class="col-md-10 col-lg-10 col-sm-12"><textarea class="form-control" name="content"  id="edit-summernote"></textarea></div>
                </div>

                <div class="row">                
                  <div class="col-12">
                    <button type="submit" class="btn btn-primary"><i class='fa fa-edit'></i> Edit</button>
                  </div>
                </div>
              </form>
          </div>    
        </div>
      </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection("sc_footer"); ?>
<script>
$('#add-summernote').summernote({
    height: 200,
});

function onDelete(id){
    swal.fire({
        title: "Apakah Anda Yakin?",
        text: "Yakin ingin menghapus data ini",
        icon: "warning",
        confirmButtonColor: "#f1261f",
        confirmButtonText: "Hapus Sekarang",
        showCancelButton: true,
        preConfirm: () => {
            window.location = "<?php echo e(url('sudo/articel/delete/')); ?>/"+id;
        }
    });
}

function onEdit(id,title,content){
    $("#edit-id").val(id);
    $("#edit-title").val(title);
    $("#edit-summernote").summernote("code",content);
    $("#edit-summernote").summernote({
        height: 200
    });
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("layout.default", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\portfolio dan articel\resources\views/sudo/articel.blade.php ENDPATH**/ ?>