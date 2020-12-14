<?php

namespace App\Http\Controllers\Sudo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
	Articel
};
use Intervention\Image\ImageManager as Image;
use Illuminate\Support\Str;

class ArticelController extends Controller
{
    public function index(Request $req){
    	$articel = new Articel();

        if(!empty($req->search)){
            $search = $req->search;

            $articel = $articel->where(function($q) use ($search){
                $q->orWhere('title',$search)
                  ->orWhere('id',$search);
            });
        }

    	$articel = $articel->orderBy('id','desc')->paginate(10);

    	return view("sudo/articel",compact('articel'));
    }

    public function add(Request $request){        
 		$rules = [
            'title' => 'required',
            'image' => 'required|image|dimensions:max_width=5000,max_height=50000|max:10024',
            'content' => 'required'
        ];

        $messages = [
            'title.required' => 'Judul harus diisi',
            'image.required' => 'Gambar harus diisi',
            "image.image"  => "Gambar tidak valid",
            "image.dimensions" => "Gambar dimensi tidak valid",
            "image.max" => "Gambar ukuran file tidak valid",
            'content.required' => 'Content harus diisi'
        ];

        $validator = \Validator::make($request->all(),$rules,$messages);

        if ($validator->fails()) {
            return redirect()
            ->back()
            ->withInput()
            ->with([
                "error" => [
                    "title" => "Terjadi Kesalahan",
                    "text" => $validator->errors()->first()
                ]
            ]);
        }    

        $payload = $request->only('title');
        $payload['image'] = $this->uploadImage($request->file('image'));
        $payload['content'] = str_replace("'", "", $request->content);

        if(Articel::create($payload)){
        	return redirect()->back()->with([
        		"success" => [
        			"title" => "Berhasil",
        			"text" => "Berhasil membuat aritkel"
        		]
        	]);
        }

        return redirect()->back()->with([
        	"error" => [
        		"title" => "Terjadi Kesalahan",
        		"text" => "Gagal membuat artikel"
        	]
        ]);
    }

    public function delete($id){
        if(intval($id) < 0){
            return redirect()->back();
        }       

        $articel = Articel::where('id',$id)->first();

        if(!$articel){
            return redirect()->back()->with([
                "error" => [
                    "title" => "Terjadi Kesalahan",
                    "text" => "Tidak dapat menghapus articel"
                ]
            ]);
        }

        if(Articel::where('id',$id)->delete()){                
            if($articel->image != "default.png"){
                if(file_exists(public_path()."/assets/images/articels/".$articel->image)){
                    unlink(public_path()."/assets/images/articels/".$articel->image);
                }
            }

            return redirect()->back()->with([
                "success" => [
                    "title" => "Berhasil",
                    "text" => "Berhasil menghapus articel"
                ]
            ]);
        }

        return redirect()->back()->with([
            "error" => [
                "title" => "Terjadi Kesalahan",
                "text" => "Tidak dapat menghapus articel"
            ]
        ]);
    }

    public function edit(Request $request){
        $rules = [
            'id' => 'required',
            'title' => 'required',
            'content' => 'required'
        ];

        $messages = [
            'id.required' => 'Id harus diisi',
            'title.required' => 'Judul harus diisi',
            'content.required' => 'Kontent harus diisi'
        ];

        if($request->hasFile('image')){     
            $rules = array_merge($rules,[
                "image" => "image|dimensions:max_width=5000,max_height=50000|max:10024"
            ]);

            $messages = array_merge($messages,[
                "image.image"  => "Gambar tidak valid",
                "image.dimensions" => "Gambar dimensi tidak valid",
                "image.max" => "Gambar ukuran file tidak valid"
            ]);
        }

        $validator = \Validator::make($request->all(),$rules,$messages);

        if ($validator->fails()) {
            return redirect()
            ->back()
            ->withInput()
            ->with([
                "error" => [
                    "title" => "Terjadi Kesalahan",
                    "text" => $validator->errors()->first()
                ]
            ]);
        }    

        $articel =  Articel::where('id',$request->id)->first();

        if(!$articel){
            return redirect()->back()->with([
                "error" => [
                    "title" => "Terjadi Kesalahan",
                    "text" => "Tidak dapat mengedit articel"
                ]
            ]);
        }

        $payload = $request->only('title');    
        $payload['content'] = str_replace("'", "", $request->content);

        if($request->hasFile('image')){
            $payload['image'] = $this->uploadImage($request->file("image"));
        }

        if(Articel::where('id',$request->id)->update($payload)){
            if($request->hasFile('image')){
                if($articel->image != "default.png"){
                    if(file_exists(public_path()."/assets/images/articels/".$articel->image)){
                        unlink(public_path()."/assets/images/articels/".$articel->image);
                    }
                }
            }

            return redirect()->back()->with([
                "success" => [
                    "title" => "Berhasil",
                    "text" => "Berhasil edit articel"
                ]
            ]);                
        }

        return redirect()->back()->with([
            "error" => [
                "title" => "Terjadi Kesalahan",
                "text" => "Gagal edit articel"
            ]
        ]);        
    }

    public function uploadImage($image){         
        $extension = $image->getClientOriginalExtension();                      
        $fileName = Str::random("20").'.' . $extension;
        $filePath = public_path() . "/assets/images/articels/";       
        $theImage = new Image();
        $imageChange = $theImage->make($image)->resize(null, 650, function($constraint){
            $constraint->aspectRatio();
        });
        $imageChange->save($filePath."".$fileName);        
        return $fileName;
    }
}
