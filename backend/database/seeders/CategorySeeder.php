<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories=[
            ['title'=>'Graphic & Design', 'fi_title' => 'finch_title', 'banner' => 'https://i.pinimg.com/originals/b4/6b/12/b46b129b440921d08fbfa7f36e462b83.jpg'],
            ['title'=>'Digital Marketing', 'fi_title' => 'finch_title', 'banner' => 'https://neilpatel.com/wp-content/uploads/2021/07/digital-marketing_featured-image.png'],
            ['title'=>'Writing & Translation', 'fi_title' => 'finch_title', 'banner' => 'https://www.star-uk.co.uk/wp-content/uploads/2020/01/aaron-burden-y02jEX_B0O0-unsplash.jpg'],
            ['title'=>'Video & Animation', 'fi_title' => 'finch_title', 'banner' => 'https://res.cloudinary.com/killer-infographics-inc/image/upload/v1582154400/Blog%20Workbench%20Headers/Motion%20Graphics%20Design%20Agency%20Illustration.jpg'],
            ['title'=>'Music & Audio', 'fi_title' => 'finch_title', 'banner' => 'https://www.adobe.com/content/dam/cc/us/en/creativecloud/video/discover/how-to-mix-music/desktop/mix-music_P1_900x420.jpg.img.jpg'],
            ['title'=>'Programming & Tech', 'fi_title' => 'finch_title', 'banner' => 'https://www.pentasia.com/rails/active_storage/representations/eyJfcmFpbHMiOnsibWVzc2FnZSI6IkJBaHBBaXhwIiwiZXhwIjpudWxsLCJwdXIiOiJibG9iX2lkIn19--9b531a296e23edbb0ae0d85e4160a44a71b44f8e/eyJfcmFpbHMiOnsibWVzc2FnZSI6IkJBaDdCam9VWTI5dFltbHVaVjl2Y0hScGIyNXpld2c2QzNKbGMybDZaVWtpRGpFd01EQjROVEF3WGdZNkJrVlVPZ3huY21GMmFYUjVTU0lMUTJWdWRHVnlCanNIVkRvSlkzSnZjRWtpRVRFd01EQjROVEF3S3pBck1BWTdCMVE9IiwiZXhwIjpudWxsLCJwdXIiOiJ2YXJpYXRpb24ifX0=--46c71b34483be69bdb6c526f3ee4da2b74b4cce2/1662_original.jpg'],
            ['title'=>'Data', 'fi_title' => 'finch_title', 'banner' => 'https://www.computerhope.com/jargon/e/entry.jpg'],
            ['title'=>'Business', 'fi_title' => 'finch_title', 'banner' => 'https://www.investopedia.com/thmb/5_l_gNEBaEfz10PhdqexDMklsAo=/1333x1000/smart/filters:no_upscale()/GettyImages-658647254-5468427ab5c94e9b82f9132e60aad7a0.jpg'],
            ['title'=>'Lifestyle', 'fi_title' => 'finch_title', 'banner' => 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fdurefoods.com%2Fhow-lifestyle-products-affect-our-daily-lives%2F&psig=AOvVaw3mxA55Ej4OPy3xiFAARBRb&ust=1642501060728000&source=images&cd=vfe&ved=0CAsQjRxqFwoTCPj_zLnHuPUCFQAAAAAdAAAAABAD']
        ];
        foreach($categories as $category){
            Category::create([
                'title'=>$category['title'],
                'fi_title' => $category['fi_title'],
                'banner'=>$category['banner'],
                'slug' => Str::slug($category['title'])
            ]);
        }

    }
}
