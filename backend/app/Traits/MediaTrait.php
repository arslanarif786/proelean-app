<?php
namespace App\Traits;
use Illuminate\Support\Facades\DB;

trait MediaTrait {
    public function uploadFile($request,$path,$key='cinic',$parentID=null,$type=false)
    {
        if($request->hasFile($key))
        {
            if(is_array($request->file($key)) && !empty($request->file($key)) ){
                foreach($request->file($key) as $banner)
                {
                    $type=$banner->extension();
                    $name=rand(999,9999).time().rand(1,9). ".". $type;
                    $file=$banner->move(public_path($path), $name);
                    $this->saveMedia($parentID,$path.'/'.$name,$type);
                }
                return 1;
            } else {
                $type=$request->file($key)->extension();
                $name=rand(999,9999).time().rand(1,9). ".". $type;
                $file=$request->file($key)->move(public_path($path), $name);
                return $path.'/'.$name;
            }
        }
        return null;
    }
    protected function saveMedia($id,$path,$type){
        DB::table('service_media')->insert([
            'service_id'=>$id,
            'media'=>$path,
            'type'=>$type,
            'created_at'=>now()->toDateTimeString(),
            'updated_at'=>now()->toDateTimeString(),
        ]);
        return;
    }

    public function countServiceMedia($id)
    {
        $mediaCount=DB::table('services')
                ->join('service_media','service_media.service_id','=','services.id')
                ->select(DB::raw('COUNT(service_media.id) as total_media'))
                ->where('services.id',$id)->first();
        return $mediaCount;
    }
}
