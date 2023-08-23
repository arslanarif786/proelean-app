<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use App\Http\Resources\HomeResource;
use App\Models\AvailableLanguage;
use App\Models\Category;
use App\Models\Country;
use App\Models\DeliveryTime;
use App\Models\Revision;

class CountryController extends Controller
{
    public function index()
    {
        $data['countries'] = Country::get(['id','name','phonecode','iso2']);
        $data['categories'] = Category::select('id','title')->get();
        $data['languages'] = AvailableLanguage::get();
        $data['delivery_days'] = DeliveryTime::get();
        $data['revisions'] = Revision::get();
        return new HomeResource((object)$data);
    }
}
