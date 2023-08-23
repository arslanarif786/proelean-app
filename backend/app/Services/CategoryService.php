<?php

namespace App\Services;

use App\Http\Controllers\Api\WishlistController;
use App\Http\Resources\HomeResource;
use App\Http\Resources\SubCategoryResource;
use App\Http\Resources\Seller\ServiceResource;
use App\Models\Ad;
use App\Models\Category;
use App\Models\Service;
use App\Models\SubCategory;
use App\Jobs\saveServiceImpression;
use App\Services\Seller\SellerService;

/**
 * Class SellerService
 * @package App\Services
 */
class CategoryService
{
    public function homeCollection()
    {

        $data['categories'] = cache()->remember('categories', 180, fn () => Category::select(['id', 'title', 'banner', 'slug'])->get());
        $data['ads'] = cache()->remember('ads', 180, fn () => Ad::latest()->get());

        $data['featGigs'] = cache()->remember('featGigs', 180, function() {
           return Service::with(["ServiceMedia","category:id,title", "subCategory:id,title", "UserService:id,username,image", "UserService.Freelancer:id,user_id,freelancer_title"])
            ->where('featured', 1)->latest()->limit(12)->get();
        });

        return new HomeResource((object)$data);
    }

    public function subCategories($id)
    {
        $query = SubCategory::where('category_id', customDecrypt($id))
            ->select('id', 'category_id', 'title', 'banner','slug');
        if (isset($_GET['q'])) {
            $q = addslashes(urldecode($_GET['q']));
            $query->where(function ($qry) use ($q) {
                $qry->where('title', 'like', "%$q%");
            });
        }
        $sub_categories = $query->groupBy('id')->latest()->simplePaginate(20);
        return SubCategoryResource::collection($sub_categories);
    }

    public function servicesBySubCategory($id)
    {
        $filter = ($_GET['filter'] ?? null) ?: null;
        $filterValue = ($_GET['filter_value'] ?? null) ?: null;
        $services = (new SellerService)->getService()
            ->join('sub_categories', 'sub_categories.id', '=', 'services.sub_category_id')
            ->when($filter && $filterValue, function($q) use($filter, $filterValue){
                switch (strtolower($_GET['filter'])) {
                    case "price<":
                        $q->where('services.price', '<=', (float)$filterValue);
                        break;
    
                    case "price>":
                        $q->where('services.price', '>=', (float)$filterValue);
                        break;
    
                    case "price":
                        $price = explode(',', $filterValue);
                        for ($i = 0; $i < sizeof($price); $i++) {
                            $price[$i] = (float)$price[$i];
                        }
                        $q->whereBetween('services.price', $price);
                        break;
                    }
            })
            ->where(function ($q) use ($id) {
                $q->where('sub_category_id', customDecrypt($id))
                    ->orWhere('sub_categories.slug', $id);
            })
            ->when(auth()->id(), function($q) {
                return $q->where('user_id', '!=', auth()->id());
            })
            ->groupBy('services.id')->orderByDesc('rating')->paginate(10);

        // check if user wishlist services exist
        $services = (new WishlistController)->checkIfInWishlist($services);
        saveServiceImpression::dispatchAfterResponse($services);
        return ServiceResource::collection($services);
    }
}
