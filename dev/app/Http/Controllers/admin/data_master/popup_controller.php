<?php

namespace App\Http\Controllers\admin\data_master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use File;

use DB;

use Auth;

use Session;

use URL;

class popup_controller extends Controller
{
    public function index(){
    	return view('admin.master_popup.index');
    }

    public function list(){
        $data = DB::table('pop_up')->select('id', 'judul_popup', 'content_popup', 'halaman', 'berlaku_sampai', 'type_popup', 'link_redirect')->whereNull('deleted_at')->get();
        return json_encode($data);
    }

    public function save(Request $request){
    	// return json_encode($request->all());
        // return json_encode(Authh:user()->employee_id);

        $cek = DB::table('pop_up')->where('halaman', $request->data['halaman'])->where('berlaku_sampai', '>', date('Y-m-d'))->whereNull('deleted_at')->first();

        if($cek){
            return json_encode([
                'status'    => 'exist',
                'content'   => [
                    'halaman'           => $request->data['halaman']
                ]
            ]);
        }

        $id = (DB::table('pop_up')->max('id')) ? (DB::table('pop_up')->max('id') + 1) : 1;

        // return json_encode($id);

    	if($this->saveImage($id, $request->imgPath, 'pop_up_'.$id)){
            $table = DB::table('pop_up')->insert([
                'id'                => $id,
                'type_popup'        => $request->data['type_popup'],
                'halaman'           => $request->data['halaman'],
                'judul_popup'       => $request->data['judul_popup'],
                'content_popup'     => $request->data['content_popup'],
                'berlaku_sampai'    => $request->data['berlaku_sampai'],
                'link_redirect'     => $request->data['link_redirect'],
                'path_image'        => 'pop_up_'.$id,
                'created_by'        => Auth::user()->employee_id
            ]);

    		return json_encode([
                'status'    => 'berhasil',
                'content'   => [
                    'id'                => $id,
                    'judul_popup'       => $request->data['judul_popup'],
                    'content_popup'     => $request->data['content_popup'],
                    'halaman'           => $request->data['halaman'],
                    'berlaku_sampai'    => $request->data['berlaku_sampai'],
                    'type_popup'        => $request->data['type_popup'],
                    'link_redirect'     => $request->data['link_redirect']
                ]
            ]);
        }
    }

    public function update(Request $request){
        // return json_encode($request->data['id']);

        $cek = DB::table('pop_up')->where('halaman', $request->data['halaman'])->where('berlaku_sampai', '>', date('Y-m-d'))->whereNull('deleted_at')->first();

        $id = (int)$request->data['id'];

        // return json_encode($cek->id);

        if(!DB::table('pop_up')->where('id', $id)->first()){
            return json_encode([
                'status'    => 'invalid',
                'content'   => null
            ]);
        }else if($cek && $cek->id != $id){
            return json_encode([
                'status'    => 'exist',
                'content'   => [
                    'halaman'           => $request->data['halaman']
                ]
            ]);
        }

        if($this->saveImage($id, $request->imgPath, 'pop_up_'.$id)){
            $table = DB::table('pop_up')->where('id', $id)->update([
                'type_popup'        => $request->data['type_popup'],
                'halaman'           => $request->data['halaman'],
                'judul_popup'       => $request->data['judul_popup'],
                'content_popup'     => $request->data['content_popup'],
                'berlaku_sampai'    => $request->data['berlaku_sampai'],
                'link_redirect'     => $request->data['link_redirect'],
                'path_image'        => 'pop_up_'.$id,
            ]);

            return json_encode([
                'status'    => 'berhasil',
                'content'   => [
                    'id'                => $id,
                    'judul_popup'       => $request->data['judul_popup'],
                    'content_popup'     => $request->data['content_popup'],
                    'halaman'           => $request->data['halaman'],
                    'berlaku_sampai'    => $request->data['berlaku_sampai'],
                    'type_popup'        => $request->data['type_popup'],
                    'link_redirect'     => $request->data['link_redirect']
                ]
            ]);
        }

    }

    public function delete(Request $request){
        // return json_encode($request->all());

        DB::table('pop_up')->whereIn('id', $request->all())->update([
            'deleted_at'    => date('Y-m-d H:i:s'),
            'deleted_by'    => Auth::user()->employee_id
        ]);

        foreach($request->all() as $data){
            File::delete(public_path().'/images/popup/pop_up_'.$data.'.png');
        }

        return json_encode([
            'status'    => 'berhasil'
        ]);
    }

    public function saveImage($id, $image, $filename){
        $path = public_path().'/images/popup';
        // return json_encode($path);

        if (!File::exists($path)){
            //return json_encode('new');
            if(File::makeDirectory($path,0777,true)){
                if (preg_match('/data:image\/(gif|jpeg|png);base64,(.*)/i', $image, $matches)) {
                    $imageData = base64_decode($matches[2]);
                    $image = imagecreatefromstring($imageData);
                    $dimension = getimagesizefromstring($imageData);
                    $tmp = imagecreatetruecolor($dimension[0], $dimension[1]);

                    imagecolortransparent($tmp, imagecolorallocatealpha($tmp, 0, 0, 0, 127));
                    imagealphablending($tmp, false);
                    imagesavealpha($tmp, true);

                    imagecopyresampled($tmp,$image,0,0,0,0,$dimension[0],$dimension[1],$dimension[0],$dimension[1]);


                    $filename = $filename.'.png';

                    if(imagepng($tmp, $path . '/' . $filename)){
                    	return true;
                    }
                }

            }
            else
                return false;
        }else{
            if (preg_match('/data:image\/(gif|jpeg|png);base64,(.*)/i', $image, $matches)) {
                    $imageData = base64_decode($matches[2]);
                    $image = imagecreatefromstring($imageData);
                    $dimension = getimagesizefromstring($imageData);
                    $tmp = imagecreatetruecolor($dimension[0], $dimension[1]);

                    imagecolortransparent($tmp, imagecolorallocatealpha($tmp, 0, 0, 0, 127));
                    imagealphablending($tmp, false);
                    imagesavealpha($tmp, true);


                    imagecopyresampled($tmp,$image,0,0,0,0,$dimension[0],$dimension[1],$dimension[0],$dimension[1]);

                    $filename = $filename.'.png';

                    if(imagepng($tmp, $path . '/' . $filename)){
                        return true;
                    }
            }
        }

        return false;
    }
}
