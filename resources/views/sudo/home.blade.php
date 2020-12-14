@extends("layout.default")

@section('content')
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
          <img src="{{asset('assets/images/home.png')}}"
            style="width:70%">
          <h5 class="mt-4">Selamat Datang {{ucwords(Auth::user()->name)}}</h5>
          <p>
            Selamat Datang Di Dashboard {{ucwords(Auth::user()->name)}}
          </p>
        </div>     
      </div>
    </section>
@endSection