@extends("layout.default")

@section('content')
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>User</h1>
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
         			<form action="{{url('sudo/user')}}">
         				<input type="text" class="form-control" placeholder="Search . . ."
         					name="search" onkeyenter="this.form.submit()">
         			</form>
	         	</div>
        	 </div>
     	</p>

         <table class="table table-boredered table-hover">
         	<tr>
         		<th>Id</th>
         		<th>Name</th>
         		<th>Photo</th>
         		<th>Email</th>
         		<th>Active</th>
         		<th>Dibuat</th>
         		<th>Opsi</th>
         	</tr>

            @if(count($user) == 0)
            <tr>
                <td colspan="10">
                    <div class="text-center mt-5 mb-5">
                        <img src="{{asset('assets/images/not-found.png')}}"
                            style="width:40%">
                        <h5>User Tidak ditemukan</h5>
                        <p>
                            Data user tidak ditemukan
                        </p>
                    </div>
                </td>
            </tr>
            @endif


         	@foreach($user as $item)
         		<tr>
         			<td>{{$item->id}}</td>
         			<td>{{ucwords($item->name)}}</td>
         			<td>
         				<img src="{{asset('assets/images/users/'.$item->photo)}}" width="100px"
                            class="img-rounded">
         			</td>
         			<td>{{$item->email}}</td>
         			<td>
         				{!! $item->is_active ? "<span class='badge badge-success'>Aktif</span>" : "<span class='badge badge-danger'>Tidak Aktif</span>" !!}
         			</td>
         			<td>{{$item->created_at}}</td>
         			<td>
         				<button class="btn btn-danger mb-2"
         					onclick="onDelete('{{$item->id}}')">
         					<i class='fa fa-trash'></i>
         				</button>
         				<button class="btn btn-success mb-2"
                            onclick='onEdit("{{$item->id}}","{{$item->name}}","{{$item->email}}","{{$item->facebook}}","{{$item->instagram}}","{{$item->youtube}}","{{$item->twitter}}","{{$item->blogger}}","{{$item->about}}","{{$item->is_active ? "1" : "0"}}")'
                            data-toggle="modal" data-target="#modalEdit">
                            <i class='fa fa-edit'></i>
                        </button>
         			</td>
         		</tr>
         	@endforeach
         </table>

         <div class="mt-5">
         	{{$user->links()}}
         </div>
        </div>     
      </div>
    </section>

    <div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal Tambah User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
             <form action="{{url('sudo/user/add')}}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="input-group mb-3 row">
                  <div class="col-md-2 col-lg-2 col-sm-12 pt-2">Nama : </div>
                  <div class="col-md-10 col-lg-10 col-sm-12"><input type="text" class="form-control" placeholder="Nama" name="name" required></div>
                </div>
    
                <div class="input-group mb-3 row">
                  <div class="col-md-2 col-lg-2 col-sm-12 pt-2">Email : </div>
                  <div class="col-md-10 col-lg-10 col-sm-12"><input type="email" class="form-control" placeholder="Email" name="email" required></div>
                </div>
                  
                <div class="input-group mb-3 row">
                    <div class="col-md-2 col-lg-2 col-sm-12 pt-2">Password : </div>
                    <div class="col-md-10 col-lg-10 col-sm-12"><input type="password" class="form-control" placeholder="Password" name="password" required></div>
                </div>

                <div class="input-group mb-3 row">
                    <div class="col-md-2 col-lg-2 col-sm-12 pt-2">Facebook : </div>
                    <div class="col-md-10 col-lg-10 col-sm-12"><input type="text" class="form-control" placeholder="Facebook" name="facebook" required></div>
                </div>

                <div class="input-group mb-3 row">
                    <div class="col-md-2 col-lg-2 col-sm-12 pt-2">Instagram : </div>
                    <div class="col-md-10 col-lg-10 col-sm-12"><input type="text" class="form-control" placeholder="Instagram" name="instagram" required></div>
                </div>

                <div class="input-group mb-3 row">
                    <div class="col-md-2 col-lg-2 col-sm-12 pt-2">Youtube : </div>
                    <div class="col-md-10 col-lg-10 col-sm-12"><input type="text" class="form-control" placeholder="Youtube" name="youtube" required></div>    
                </div>

                <div class="input-group mb-3 row">
                    <div class="col-md-2 col-lg-2 col-sm-12 pt-2">Twitter : </div>
                    <div class="col-md-10 col-lg-10 col-sm-12"><input type="text" class="form-control" placeholder="Twitter" name="twitter" required></div>    
                </div>

                <div class="input-group mb-3 row">
                    <div class="col-md-2 col-lg-2 col-sm-12 pt-2">Blogger : </div>
                    <div class="col-md-10 col-lg-10 col-sm-12"><input type="text" class="form-control" placeholder="Blogger" name="blogger" required></div>
                </div>

                <div class="input-group mb-3 row">
                    <div class="col-md-2 col-lg-2 col-sm-12 pt-2">Photo : </div>
                    <div class="col-md-10 col-lg-10 col-sm-12"><input type="file" class="form-control" name="photo"></div>
                </div>

                <div class="input-group mb-3 row">
                    <div class="col-md-2 col-lg-2 col-sm-12 pt-2">Tentang : </div>
                    <div class="col-md-10 col-lg-10 col-sm-12"><textarea class="form-control" name="about" placeholder="Tentang" required></textarea></div>
                </div>

                <div class="input-group mb-3 row">
                    <div class="col-md-2 col-lg-2 col-sm-12 pt-2">Aktif : </div>
                    <div class="col-md-10 col-lg-10 col-sm-12">
                        <select class="form-control" name="active">
                            <option value="0">Tidak Aktif</option>
                            <option value="1">Aktif</option>
                        </select>
                    </div>
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
            <h5 class="modal-title" id="exampleModalLabel">Modal Edit User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
             <form action="{{url('sudo/user/edit')}}" method="post" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="id" id="edit-id">

                <div class="input-group mb-3 row">
                  <div class="col-md-2 col-lg-2 col-sm-12 pt-2">Nama : </div>
                  <div class="col-md-10 col-lg-10 col-sm-12"><input type="text" class="form-control" placeholder="Nama" name="name" required id="edit-name"></div>
                </div>
    
                <div class="input-group mb-3 row">
                  <div class="col-md-2 col-lg-2 col-sm-12 pt-2">Email : </div>
                  <div class="col-md-10 col-lg-10 col-sm-12"><input type="email" class="form-control" placeholder="Email" name="email" required id="edit-email"></div>
                </div>
                  
                <div class="input-group mb-3 row">
                    <div class="col-md-2 col-lg-2 col-sm-12 pt-2">Password : </div>
                    <div class="col-md-10 col-lg-10 col-sm-12">
                        <input type="password" class="form-control" placeholder="Password" name="password">
                        <small class="text-muted">* Isi jika ingin menganti password</small>
                    </div>
                </div>

                <div class="input-group mb-3 row">
                    <div class="col-md-2 col-lg-2 col-sm-12 pt-2">Facebook : </div>
                    <div class="col-md-10 col-lg-10 col-sm-12"><input type="text" class="form-control" placeholder="Facebook" name="facebook" required id="edit-facebook"></div>
                </div>

                 <div class="input-group mb-3 row">
                    <div class="col-md-2 col-lg-2 col-sm-12 pt-2">Instagram : </div>
                    <div class="col-md-10 col-lg-10 col-sm-12"><input type="text" class="form-control" placeholder="Instagram" name="instagram" required id="edit-instagram"></div>
                </div>

                <div class="input-group mb-3 row">
                    <div class="col-md-2 col-lg-2 col-sm-12 pt-2">Youtube : </div>
                    <div class="col-md-10 col-lg-10 col-sm-12"><input type="text" class="form-control" placeholder="Youtube" name="youtube" required id="edit-youtube"></div>    
                </div>

                <div class="input-group mb-3 row">
                    <div class="col-md-2 col-lg-2 col-sm-12 pt-2">Twitter : </div>
                    <div class="col-md-10 col-lg-10 col-sm-12"><input type="text" class="form-control" placeholder="Twitter" name="twitter" required id="edit-twitter"></div>    
                </div>

                <div class="input-group mb-3 row">
                    <div class="col-md-2 col-lg-2 col-sm-12 pt-2">Blogger : </div>
                    <div class="col-md-10 col-lg-10 col-sm-12"><input type="text" class="form-control" placeholder="Blogger" name="blogger" required id="edit-blogger"></div>
                </div>

                <div class="input-group mb-3 row">
                    <div class="col-md-2 col-lg-2 col-sm-12 pt-2">Photo : </div>
                    <div class="col-md-10 col-lg-10 col-sm-12"><input type="file" class="form-control" name="photo"></div>
                </div>

                <div class="input-group mb-3 row">
                    <div class="col-md-2 col-lg-2 col-sm-12 pt-2">Tentang : </div>
                    <div class="col-md-10 col-lg-10 col-sm-12"><textarea class="form-control" name="about" placeholder="Tentang" required id="edit-about"></textarea></div>
                </div>

                <div class="input-group mb-3 row">
                    <div class="col-md-2 col-lg-2 col-sm-12 pt-2">Aktif : </div>
                    <div class="col-md-10 col-lg-10 col-sm-12">
                        <select class="form-control" name="active" id="edit-active">
                            <option value="0">Tidak Aktif</option>
                            <option value="1">Aktif</option>
                        </select>
                    </div>
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
@endSection

@section('sc_footer')
<script>
function onDelete(id){
    swal.fire({
        title: "Apakah Anda Yakin?",
        text: "Yakin ingin menghapus data ini",
        icon: "warning",
        confirmButtonColor: "#f1261f",
        confirmButtonText: "Hapus Sekarang",
        showCancelButton: true,
        preConfirm: () => {
            window.location = "{{url('sudo/user/delete/')}}/"+id;
        }
    });
}

function onEdit(id,name,email,facebook,instagram,youtube,twitter,blogger,about,active){
    $("#edit-id").val(id);
    $("#edit-name").val(name);
    $("#edit-email").val(email);
    $("#edit-facebook").val(facebook);
    $("#edit-instagram").val(instagram);
    $("#edit-youtube").val(youtube);
    $("#edit-twitter").val(twitter);
    $("#edit-blogger").val(blogger);
    $("#edit-about").val(about);
    $("#edit-active").val(active);
}
</script>
@endSection