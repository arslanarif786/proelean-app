<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ServiceSlugSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = Service::get();

        for ($i = 0; $i < sizeof($services); $i++) {

            if (is_null($services[$i]->slug) || !$services[$i]->slug)
                $services[$i]->slug = Str::slug($services[$i]->s_description, '-');

            $this->checkIfSlugAlreadyExistOrNot($services[$i]);
        }
    }

    private function checkIfSlugAlreadyExistOrNot($service)
    {

        $slugAlreadyExist = Service::where('slug',$service->slug)->first();

        if($slugAlreadyExist) {
            // re-assign slug value & check it again if new slug exist.

            $service->slug = Str::of($service->slug)->append('-'. Str::singular(Str::random(5)) );

            $this->checkIfSlugAlreadyExistOrNot($service);

        } else {
            // save it
            Service::where('id',$service->id)->update(['slug' => $service->slug]);
        }
    }
}
