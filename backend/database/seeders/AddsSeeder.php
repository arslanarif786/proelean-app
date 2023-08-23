<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ad;

class AddsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adds=
        [
           ['description'=>'this is dummy data', 'action'=>'https://youtu.be/KzHrZVXRvAs','banner' => 'https://i.pinimg.com/originals/b4/6b/12/b46b129b440921d08fbfa7f36e462b83.jpg'],
           ['description'=>'this is dummy data', 'action'=>'https://youtu.be/KzHrZVXRvAs','banner' => 'https://neilpatel.com/wp-content/uploads/2021/07/digital-marketing_featured-image.png'],
           ['description'=>'this is dummy data', 'action'=>'https://youtu.be/KzHrZVXRvAs','banner' => 'https://www.computerhope.com/jargon/e/entry.jpg'],
            ['description'=>'this is dummy data', 'action'=>'https://youtu.be/KzHrZVXRvAs','banner' => 'https://res.cloudinary.com/killer-infographics-inc/image/upload/v1582154400/Blog%20Workbench%20Headers/Motion%20Graphics%20Design%20Agency%20Illustration.jpg'],
        ];

        foreach($adds as $add){
            Ad::create([
                'banner'=>$add['banner'],
                'description'=>$add['description'],
                'action'=>$add['action']
            ]);
        }
    }
}
