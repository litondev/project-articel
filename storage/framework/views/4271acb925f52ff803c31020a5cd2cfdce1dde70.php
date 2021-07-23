<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title><?php echo e(ucwords($user->name)); ?></title>
        <link rel='stylesheet' href="<?php echo e(asset('assets/frontend/css/bootstrap.min.css')); ?>"/>    
        <script src="<?php echo e(asset('assets/frontend/js/jquery-3.2.1.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/frontend/js/bootstrap.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/frontend/js/fontawesome-all.min.js')); ?>"></script>
    </head>
</body>  
    <div id="profil-background">    
        <div class="text-center">            
            <img src="<?php echo e(asset('assets/images/users/'.$user->photo)); ?>"
                class="img-fluid"
                id="profil-photo"> 
        </div>

        <div id="profil-name">
            Hello Saya <?php echo e(ucwords($user->name)); ?>

        </div>

        <div id="profil-about">
            <?php echo e($user->about); ?>

        </div>

        <div id="profil-bottom">          
            <div class="profil-sosial-media"
                onclick="window.location='<?php echo e($user->facebook); ?>'"
                title="Facebook">
                <i class="fab fa-facebook fa-1x"></i>
            </div>

            <div class="profil-sosial-media"
                onclick="window.location='<?php echo e($user->instagram); ?>'"
                title="Instagram">              
                <i class="fab fa-instagram fa-1x"></i>
            </div>

            <div class="profil-sosial-media"
                onclick="window.location='<?php echo e($user->youtube); ?>'"
                title="Youtube">
                <i class="fab fa-youtube fa-1x"></i>
            </div>

            <div class="profil-sosial-media"
                onclick="window.location='<?php echo e($user->twitter); ?>'"
                title="Twitter">
                <i class="fab fa-twitter fa-1x"></i>
            </div>

            <div class="profil-sosial-media"
                onclick="window.location='<?php echo e($user->blogger); ?>'"
                title="Blogger">
                <i class="fab fa-blogger fa-1x"></i>
            </div>
        </div>
    </div>
    
    <div id="articel-title">
        <h4>Artikel Saya</h4>
    </div>

    <div id="articel-list-wrap" class="mt-5 mb-5">
        <?php if(count($articel) == 0): ?>        
            <div class="text-center mt-5 mb-5">
                <img src="<?php echo e(asset('assets/images/not-found.png')); ?>"
                    style="width:60%">
                <h5>Artikel Tidak ditemukan</h5>
                <p>
                    Data artikel tidak ditemukan
                </p>
            </div>
        <?php endif; ?>

        <?php $__currentLoopData = $articel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="articel-list"
                onclick="window.location='<?php echo e(url('/detail/'.$item->id)); ?>'">
                <div class="text-center">
                    <img class="articel-list-image" 
                        src="<?php echo e(asset('assets/images/articels/'.$item->image)); ?>"               
                        onclick="window.location='<?php echo e(url('/detail/'.$item->id)); ?>'">
                </div>

                <h4 
                    class="mt-3"
                    style="cursor:pointer"                
                    onclick="window.location='<?php echo e(url('/detail/'.$item->id)); ?>'">
                    <?php echo e(ucwords($item->title)); ?>

                </h4>
                <p style="font-size:16px;cursor:pointer" 
                    onclick="window.location='<?php echo e(url('/detail/'.$item->id)); ?>'">
                    <?php echo e(str_replace('&nbsp;',' ',\Illuminate\Support\Str::limit(strip_tags($item->content), 140,' . . .'))); ?>                 
                </p>
                <p>
                    <a href="<?php echo e(url('/detail/'.$item->id)); ?>">
                        Baca Selengkapnya
                    </a>
                </p>
            </div>    
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <div id="articel-pagination">
        <?php echo e($articel->links()); ?>

    </div>

    <style>
    #profil-background{
        height:657px;
        padding:10px;
        background-color: black; 
        background-position: center;
        background-repeat: no-repeat;
        /* background-image: url('https://source.unsplash.com/collection/190727/1600x900') */
    }

    #profil-photo{
        margin:auto;
        width:150px;
        height:150px;
        border-radius:50%;
        background:white;
        /* border:2px solid white; */
    }

    #profil-name{
        margin:auto;
        font-size:2.3529411764706em;
        max-width:400px;
        padding-top:30px;
        background:none;
        text-align:center;
        color:white;
    }

    #profil-about{
        margin:auto;
        max-width:500px;
        text-align:center;
        padding-top:40px;
        color:white;
    }

    #profil-bottom{
        margin:auto;
        font-size:20px;
        max-width:250px;
        padding-top:150px;
        text-align:center;
        color:white;
        display:flex;
        flew-flow:row;
        justify-content:space-between;
    }

    .profil-sosial-media{
        height:50px;
        width:50px;
        border-radius:50%;
        /* background:green; */
        cursor:pointer;
    }

    #articel-title{
        margin:auto;
        max-width:200px;
        margin-top:10px;
        text-align:center;
    }

    #articel-list-wrap{
        background:white;
        display:flex;
        flex-flow:row wrap;
        padding-left:40px;
        padding-right:40px;
        justify-content:space-around;
    }

    .articel-list{
        background:white;
        height:370px;
        width:350px;
        border-radius:10px;
        margin-bottom:30px;
        margin-top:20px;
        /* margin-left: 5px;  */
        box-shadow:0px 5px 5px #eee;
        padding:10px;
        cursor:pointer;
    }    

    .articel-list-image{
        width:300px;
        height:200px;
        border-radius:20px;
        cursor:pointer;
    }

    #articel-pagination{
        padding:10px;
        margin:auto;
        width:100px;
    }

    body {
        padding:0px;
        margin:0px;
    }
    </style>

    <script>
        $("#profil-background").ready(function(){
          // https://unsplash.com/collections            
          $("#profil-background").css("background-image","url('https://source.unsplash.com/collection/762960/1600x900')");
        });          
    </script>
</body>
</html><?php /**PATH C:\xampp\htdocs\portfolio dan articel\resources\views/welcome.blade.php ENDPATH**/ ?>