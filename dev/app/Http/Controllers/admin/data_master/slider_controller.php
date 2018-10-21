<?php

namespace App\Http\Controllers\admin\data_master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\home_picture as picture;

use DB;
use Image;
use File;
use URL;

class slider_controller extends Controller
{
    public function index(){
    	return view('admin.master_slider.index');
    }

    public function get(Request $request){
    	$data = picture::where('picture_type', $request->state)->get();

    	return json_encode($data);
    }

    public function store(Request $request){

    	$main_link = URL::to('/');

    	$id = (DB::table('home_picture')->max('picture_id')) ? (DB::table('home_picture')->max('picture_id') + 1) : 1;
    	$path = ''; $width = 0;

    	switch ($request->state) {
    		case '1':
    			$path = '/images/front_end/slider';
                $width = 895;
    			break;

    		case '2':
    			$path = '/images/front_end/kanan_1';
                $width = 195;
    			break;

    		case '3':
    			$path = '/images/front_end/kanan_2';
                $width = 195;
    			break;

    		case '4':
    			$path = '/images/front_end/bawah_1';
                $width = 170;
    			break;

    		case '5':
    			$path = '/images/front_end/bawah_2';
                $width = 170;
    			break;

    		case '6':
    			$path = '/images/front_end/bawah_3';
                $width = 170;
    			break;

    		case '7':
    			$path = '/images/front_end/bawah_4';
                $width = 170;
    			break;

            case '8':
                $path = '/images/front_end/pojok_bawah';
                $width = 512;
                break;
    	}

        if($request->state != 1 && $request->data['status']){
            DB::table('home_picture')->where('picture_type', $request->state)->update([
                "picture_status"    => '0',
            ]);
        }

    	$array_data = [
    		'picture_id'		=> $id,
    		'picture_type' 		=> $request->state,
    		'picture_title'		=> $request->data['judul_gambar'],
    		'picture_source'	=> $main_link,
    		'picture_url'		=> $request->data['url_link'],
    		'picture_status'	=> ($request->data['status']) ? '1' : '0',
    		'picture_path'		=> $path.'/'.$id.'.jpg'
    	];
    	
    	DB::table('home_picture')->insert($array_data);

    	$this->upload($request->img, $id, $path, $width);

    	return json_encode([
    		'status'	=> "sukses",
    		'content'	=> picture::where('picture_type', $request->state)->get(),
    	]);
    }

    public function update(Request $request){
        $picture = DB::table('home_picture')->where('picture_id', $request->data['picture_id']);

        if(!$picture->first()){
            return json_encode([
                'status'    => 'gagal',
                'content'   => 'Ups .. Gambar yang Akan Dihapus Tidak Bisa Kami Temukan .. ',
            ]);
        }

        $path = ''; $width = 0;

        switch ($request->state) {
            case '1':
                $path = '/images/front_end/slider';
                $width = 895;
                break;

            case '2':
                $path = '/images/front_end/kanan_1';
                $width = 195;
                break;

            case '3':
                $path = '/images/front_end/kanan_2';
                $width = 195;
                break;

            case '4':
                $path = '/images/front_end/bawah_1';
                $width = 170;
                break;

            case '5':
                $path = '/images/front_end/bawah_2';
                $width = 170;
                break;

            case '6':
                $path = '/images/front_end/bawah_3';
                $width = 170;
                break;

            case '7':
                $path = '/images/front_end/bawah_4';
                $width = 170;
                break;

            case '8':
                $path = '/images/front_end/pojok_bawah';
                $width = 512;
                break;
        }

        if($request->state != 1 && $request->data['status']){
            DB::table('home_picture')->where('picture_type', $request->state)->update([
                "picture_status"    => '0',
            ]);
        }

        $array_data = [
            'picture_type'      => $request->state,
            'picture_title'     => $request->data['judul_gambar'],
            'picture_url'       => $request->data['url_link'],
            'picture_status'    => ($request->data['status']) ? '1' : '0'
        ];
        
        $picture->update($array_data);
        $id = $picture->first()->picture_id;

        $this->upload($request->img, $id, $path, $width);

        return json_encode([
            'status'    => "sukses",
            'content'   => picture::where('picture_type', $request->state)->get(),
        ]);
    }

    public function delete(Request $request){
        $picture = DB::table('home_picture')->where('picture_id', $request->data);

        if(!$picture->first()){
            return json_encode([
                'status'    => 'gagal',
                'content'   => 'Ups .. Gambar yang Akan Dihapus Tidak Bisa Kami Temukan .. ',
            ]);
        }

        $filename = public_path().$picture->first()->picture_path;

        $picture->delete();
        File::delete($filename);

        return json_encode([
            'status'    => "sukses",
            'content'   => picture::where('picture_type', $request->state)->get(),
        ]);
    }

    public function upload($image, $filename, $path, $width){
    	// return json_encode($request->all());
    	$image = $image;

    	$filename = $filename;
    	$path = public_path().$path;

        if (!File::exists($path)){
            //return json_encode('new');
            if(File::makeDirectory($path,0777,true)){
                if (preg_match('/data:image\/(gif|jpeg|png);base64,(.*)/i', $image, $matches)) {
                    $imageData = base64_decode($matches[2]);
                    $image = imagecreatefromstring($imageData);
                    $dimension = getimagesizefromstring($imageData);
                    $tmp = imagecreatetruecolor($dimension[0], $dimension[1]);

                    imagecolortransparent($tmp, imagecolorallocatealpha($tmp, 255, 255, 255, 127));
                    imagealphablending($tmp, false);
                    imagesavealpha($tmp, true);

                    imagecopyresampled($tmp,$image,0,0,0,0,$dimension[0],$dimension[1],$dimension[0],$dimension[1]);


                    $filename = $filename.'.jpg';
                    // imagejpeg($tmp, $path . '/' . $filename);
                }
            }
        }else{
        	if (preg_match('/data:image\/(gif|jpeg|png);base64,(.*)/i', $image, $matches)) {
                $imageData = base64_decode($matches[2]);
                $image = imagecreatefromstring($imageData);
                $dimension = getimagesizefromstring($imageData);
                $tmp = imagecreatetruecolor($dimension[0], $dimension[1]);

                imagecolortransparent($tmp, imagecolorallocatealpha($tmp, 255, 255, 255, 127));
                imagealphablending($tmp, false);
                imagesavealpha($tmp, true);

                imagecopyresampled($tmp,$image,0,0,0,0,$dimension[0],$dimension[1],$dimension[0],$dimension[1]);

                $filename = $filename.'.jpg';
                // imagejpeg($tmp, $path . '/' . $filename);
            }
        }

        $img = Image::make($tmp);
        $size = $img->width() / 2;
        // $img->resize($size, null, function ($constraint) {
        //     $constraint->aspectRatio();
        // });
        $img = $img->encode('jpg', 0);
        $img->save($path.'/'.$filename);
    }
}
