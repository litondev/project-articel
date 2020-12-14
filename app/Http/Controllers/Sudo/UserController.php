<?php

namespace App\Http\Controllers\Sudo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
	User
};
use Auth,DB;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index(Request $req){
    	$user = new User();

        if(!empty($req->search)){
            $search = $req->search;

            $user = $user->where(function($q) use ($search){
                $q->orWhere('name',$search)
                ->orWhere('email',$search)
                ->orWhere('id',$search);
            });
        }

    	$user = $user->orderBy('id','desc')->paginate(10);

    	return view("sudo/user",compact('user'));
    }

    public function delete(Request $req,$id){
    	if(intval($id) < 0){
    		return redirect()->back();
    	}    	

    	$user = User::where('id',$id)->first();

    	if(!$user){
    		return redirect()->back()->with([
            	"error" => [
	                "title" => "Terjadi Kesalahan",
                	"text" => "Tidak dapat menghapus user"
            	]
        	]);
    	}

    	if($user->id === Auth::user()->id){
    		return redirect()->back()->with([
            	"error" => [
	                "title" => "Terjadi Kesalahan",
                	"text" => "Tidak dapat menghapus user"
            	]
        	]);
    	}

        if(intval($user->is_active)){
            return redirect()->back()->with([
                "error" => [
                    'title' => "Terjadi Kesalahan",
                    "text" => "Tidak dapat mengahpus user"
                ]
            ]);
        }

    	if(User::where('id',$id)->delete()){    
    		if($user->photo != "default.png"){
                if(file_exists(public_path()."/assets/images/users/".$user->photo)){
        			unlink(public_path()."/assets/images/users/".$user->photo);
                }
    		}

			return redirect()->back()->with([
        		"success" => [
	                "title" => "Berhasil",
            		"text" => "Berhasil menghapus user"
        		]
        	]);
    	}

    	return redirect()->back()->with([
        	"error" => [
                "title" => "Terjadi Kesalahan",
            	"text" => "Tidak dapat menghapus user"
        	]
        ]);
    }

    public function add(Request $request){
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'facebook' => 'required|url',
            'instagram' => 'required|url',
            'youtube' => 'required|url',
            'twitter' => 'required|url',
            'blogger' => 'required|url',
            'about' => 'required',
        ];

        $messages = [
            'name.required' => 'Nama harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email'  => 'Format email tidak sesuai',
            'email.unique' => 'Email telah dipakai',
            'password.required'  => 'Password harus diisi',
            'password.min'  => 'Password harus :min karakter',
            'facebook.required' => 'Facebook harus diisi',
            'facebook.url' => 'Facebook tidak valid',
            'instagram.required' => 'Instagram harus diisi',
            'instagram.url' => 'Instagram tidak valid',
            'youtube.required' => 'Youtube harus diisi',
            'youtube.url' => 'Youtube tidak valid',
            'twitter.required' => 'Twitter harus diisi',
            'twitter.url' => 'Twitter tidak valid',
            'blogger.required' => 'Blogger harus diisi',
            'blogger.url' => 'Blogger tidak valid',
            'about.required' => 'Tentang harus diisi',
        ];

        if($request->hasFile('photo')){     
            $rules = array_merge($rules,[
                "photo" => "image|dimensions:max_width=5000,max_height=50000|max:10024"
            ]);

            $messages = array_merge($messages,[
                "photo.image"  => "Gambar tidak valid",
                "photo.dimensions" => "Gambar dimensi tidak valid",
                "photo.max" => "Gambar ukuran file tidak valid"
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

        $payload = $request->only('name','email','facebook','instagram','youtube','twitter','blogger');
        $payload['password'] = \Hash::make($request->password);
        $payload['is_active'] = intval($request->active) === 1 ? true : false;
        $payload['photo'] = "default.png";
        $payload["about"] = str_replace("\"", "", $request->about);

        if($request->hasFile('photo')){
            $payload['photo'] = $this->uploadImage($request->file("photo"));
        }

        try{
            DB::beginTransaction();

            if($payload['is_active'] === true) {
                User::where('is_active',true)->update([
                    "is_active" => false
                ]);
            }

            User::create($payload);

            DB::commit();
            return redirect()->back()->with([
                "success" => [
                    "title" => "Berhasil",
                    "text" => "Berhasil membuat user"
                ]
            ]);
        }catch(\Exception $e){
            \Log::info($e);

            DB::rollback();

            return redirect()->back()->with([
                "error" => [
                    "title" => "Terjadi Kesalahan",
                    "text" => "Gagal membuat user"
                ]
            ]);
        }
    }

    public function edit(Request $request){
        $rules = [
            'id' => 'required',
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$request->id,
            'facebook' => 'required|url',
            'instagram' => 'required|url',
            'youtube' => 'required|url',
            'twitter' => 'required|url',
            'blogger' => 'required|url',
            'about' => 'required',
        ];

        $messages = [
            'id.required' => 'Id harus diisi',
            'name.required' => 'Nama harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email'  => 'Format email tidak sesuai',
            'email.unique' => 'Email telah dipakai',        
            'facebook.required' => 'Facebook harus diisi',
            'facebook.url' => 'Facebook tidak valid',
            'instagram.required' => 'Instagram harus diisi',
            'instagram.url' => 'Instagram tidak valid',
            'youtube.required' => 'Youtube harus diisi',
            'youtube.url' => 'Youtube tidak valid',
            'twitter.required' => 'Twitter harus diisi',
            'twitter.url' => 'Twitter tidak valid',
            'blogger.required' => 'Blogger harus diisi',
            'blogger.url' => 'Blogger tidak valid',
            'about.required' => 'Tentang harus diisi',
        ];

        if(!empty($request->password)){
            $rules = array_merge($rules,[
                'password' => 'required|min:8',
            ]);

            $messages = array_merge($messages,[
                'password.required'  => 'Password harus diisi',
                'password.min'  => 'Password harus :min karakter',
            ]);
        }

        if($request->hasFile('photo')){     
            $rules = array_merge($rules,[
                "photo" => "image|dimensions:max_width=5000,max_height=50000|max:10024"
            ]);

            $messages = array_merge($messages,[
                "photo.image"  => "Gambar tidak valid",
                "photo.dimensions" => "Gambar dimensi tidak valid",
                "photo.max" => "Gambar ukuran file tidak valid"
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

        $user =  User::where('id',$request->id)->first();

        if(!$user){
            return redirect()->back()->with([
                "error" => [
                    "title" => "Terjadi Kesalahan",
                    "text" => "Tidak dapat mengedit user"
                ]
            ]);
        }

        $payload = $request->only('name','email','facebook','instagram','youtube','twitter','blogger');
        $payload['is_active'] = intval($request->active) === 1 ? true : false;
        $payload["about"] = str_replace("\"", "", $request->about);    

        if(!empty($request->password)){
            $payload['password'] = \Hash::make($request->password);
        }

        if($request->hasFile('photo')){
            $payload['photo'] = $this->uploadImage($request->file("photo"));
        }
     
        try{
            DB::beginTransaction();

            if($payload['is_active'] === true) {
                User::where('is_active',true)->update([
                    "is_active" => false
                ]);
            }

            if($request->hasFile('photo')){
                if($user->photo != "default.png"){
                    if(file_exists(public_path()."/assets/images/users/".$user->photo)){
                        unlink(public_path()."/assets/images/users/".$user->photo);
                    }
                }
            }

            User::where('id',$request->id)->update($payload);

            DB::commit();

            return redirect()->back()->with([
                "success" => [
                    "title" => "Berhasil",
                    "text" => "Berhasil edit user"
                ]
            ]);
        }catch(\Exception $e){
            \Log::info($e);

            DB::rollback();

            return redirect()->back()->with([
                "error" => [
                    "title" => "Terjadi Kesalahan",
                    "text" => "Gagal edit user"
                ]
            ]);
        }
    }

    function uploadImage($image){
        $extension = $image->getClientOriginalExtension();
        $fileName = Str::random("20").'.' . $extension;
        $filePath = public_path() . "/assets/images/users/";
        $image->move($filePath,$filePath."".$fileName);        

        return $fileName;
    }
}
