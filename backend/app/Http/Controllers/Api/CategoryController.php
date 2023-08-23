<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Requests\SearchRequest;
use App\Models\Category;
use App\Services\CategoryService;
use App\Services\Seller\SellerService;

class CategoryController extends Controller
{
    public function index()
    {
        return CategoryResource::collection(Category::latest()->get());
    }

    public function home(CategoryService $service)
    {
        return $service->homeCollection();
    }

    public function subcategories($id, CategoryService $service)
    {
        return $service->subCategories($id);
    }

    public function getServicesBySubCategory($id, CategoryService $service)
    {

        return $service->servicesBySubCategory($id);
    }

    public function search(SearchRequest $request, SellerService $service)
    {
        $q=isset($_GET['q']) ? addslashes(urldecode($_GET['q']))  : '';
        return $service->searchServices($q);
    }
}
