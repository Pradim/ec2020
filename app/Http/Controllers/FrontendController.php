<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Offer;
use App\Models\Category;
use App\Models\Product;
use App\User;
use Illuminate\Http\Request;

class FrontendController extends Controller
{

	protected $banner = null;
	protected $category = null;
	protected $offer = null;
    protected $product = null;
	protected $user = null;

	public function __construct(Banner $banner, Category $category, Offer $offer, Product $product, User $user){
		$this->banner = $banner;
		$this->category = $category;
		$this->offer = $offer;
        $this->product = $product;
		$this->user = $user;
	}

    public function homePage(){
    	$this->banner = $this->banner->where('status', 'active')->orderBy('id', 'DESC')->limit(5)->get();
    	$this->category = $this->category->where('status', 'active')->where('is_parent', 1)->orderBy('title', 'ASC')->limit(8)->get();
    	$today = date('Y-m-d H:i:s');
    	$this->offer = $this->offer->where('start_time','<=', $today)->where('end_time','>=', $today)->where('status', 'active')->orderBy('id', 'DESC')->get();
    	$this->product = $this->product
    	->with('images')
    	->where('status', 'active')->where('is_featured', 1)->orderBy('id', 'DESC')->paginate(20);
    	return view('home.index')
    	->with('category_data', $this->category)
    	->with('offer_info', $this->offer)
    	->with('products', $this->product)
    	->with('banner_data', $this->banner);
    }

    public function showContactUs(){
        return view('home.contact-us');
    }

    public function userProfile($id){
        $this->user = $this->user->with('user_info')->findOrFail($id);
        return view('user.profile.index')->with('user_data', $this->user);
    }


}
