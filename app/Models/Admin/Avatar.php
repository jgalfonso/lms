<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Avatar extends Model
{
    protected $table = 'avatar';
    protected $primaryKey = 'avatar_id';

    public static function add($request)
    {   
        $original = 'images/profiles/'.$request->profileID.'/avatar/original/';
        $thumb = 'images/profiles/'.$request->profileID.'/avatar/thumb/';

        if(!file_exists(public_path($original)) && !file_exists(public_path($thumb)) ) {
            \File::makeDirectory(public_path($original),  0777, true);
            \File::makeDirectory(public_path($thumb), 0777, true);
        }

        $image = $request->file('file');
        $name = time().$image->getClientOriginalName();
        $height = \Image::make($image)->height();
        $width = \Image::make($image)->width();
        $ratio = $width / $height;

        $thumbWidth = 180;
        $thumbHeight = $thumbWidth / $ratio;
        
        \Image::make($image)->orientate()->save(public_path($original).$name);
        \Image::make($image)->orientate()->save(public_path($thumb).$name);
        \Image::make($thumb.$name)->resize($thumbWidth, $thumbHeight)->save($thumb.$name);

        $images = [
            "original" => [['path' => $original, 'height' => $height, 'width' => $width]],
            "thumb" => [['path' => $thumb, 'height'=>$thumbHeight, 'width'=>$thumbWidth]]
        ];

        $data = [
            'profile_id'    => $request->profileID,
            'filename'      => $name,
            'meta'          => json_encode($images),
            'created_by'    => $request->createdBy,
            'dt_created'    => date('Y-m-d H:i:s'),
            'status'        => 'Active'
        ];

        self::insert($data); 
    }

}



