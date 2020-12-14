<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>{{ucwords($articel->title)}}</title>
        <link rel='stylesheet' href="{{asset('assets/frontend/css/bootstrap.min.css')}}"/>    
        <script src="{{asset('assets/frontend/js/jquery-3.2.1.min.js')}}"></script>
        <script src="{{asset('assets/frontend/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('assets/frontend/js/fontawesome-all.min.js')}}"></script>
	</head>
</body>		
	<div onclick="scrollToTop()"
		id="scrollToTop">
		<i class="fa fa-caret-up fa-2x"></i>
	</div>

	<div id="content">
		<div id="box-content">
			<div style="margin:auto;max-width:250px;text-align:center">
				<h1>{{ucwords($articel->title)}}</h1>
				<p><a href="<?= url('/');?>">Kembali</a> | {{$articel->updated_at}}</p>
			</div>

			<div style="margin:auto;max-width:500px;text-align:center">
				<img 
					src="{{asset('assets/images/articels/'.$articel->image)}}"
					style="height:200px;border-radius:20px"
					class="img-fluid">
			</div>

			<div style="padding:10px;word-wrap: break-word;">			
				{!! $articel->content !!}
			</div>
		</div>
	</div>

	<style>
	#scrollToTop{
		padding-top:10px;
		color: white;
		text-align: center;
		height:50px;
		width:50px;
		background:green;
		position:fixed;
		right:30px;
		bottom:30px;
		border-radius:50%;
		display:none;
		cursor: pointer;
	}

	#content{		
		padding-top:30px;
		padding-bottom:20px;
	}

	#box-content{
		box-shadow:0px 5px 10px #eee;
		padding:20px;
		border-radius:20px;
	}


	@media (min-width: 1025px) {
		#content{
			padding-left:150px;
			padding-right:150px;
		}
	}

	@media (max-width: 1024px) {   
		#content{
			padding-left:10px;
			padding-right:10px;
		}
	}	
	</style>

	<script>
		function scrollToTop(){
			window.scrollTo({top: 0, behavior: 'smooth'});
		}

		document.addEventListener('scroll', function() {
			document.getElementById('scrollToTop').style.display = window.scrollY > 500 ? "block" : 'none';			
		});
	</script>
</body>
</html>