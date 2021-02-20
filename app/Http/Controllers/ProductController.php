<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use App\User;
use App\Models\Category;
use App\Models\ProductReview;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    protected $category = null;
    protected $user = null;
    protected $product = null;
    protected $review = null;
    public function __construct(Category $category, User $user, Product $product, ProductReview $review)
    {
        $this->category = $category;
        $this->user = $user;
        $this->product = $product;
        $this->review = $review;
    }

    public function getAllProducts(){
        $this->product = $this->product->where('status', 'active')->orderBy('id', 'DESC')->limit(48)->paginate();
        return view('home.product-list')->with('products', $this->product);
    }

    public function getAllFeaturedProducts(){
        $this->product = $this->product->where('status', 'active')->where('is_featured', 1)->orderBy('id', 'DESC')->limit(48)->paginate();
        return view('home.product-list')->with('products', $this->product);
    }

    public function searchProduct(Request $request){
        $keyword = $request->search;
        $this->category = $this->category->where('status', 'active')->where('is_parent', 1)->orderBy('title', 'ASC')->limit(8)->get();
        $this->product = $this->product->where('status', 'active');
        if ($keyword != null) {
            $this->product = $this->product->where(function($query){
                return $query->where('title', 'LIKE', '%'.request()->search.'%')->orWhere('summary', 'LIKE','%'.request()->search.'%');
            });
        }

        if (isset($request->price)) {
            list($min, $max) = explode("-", $request->price);
            $this->product = $this->product->where('price', '>=', $min)->where('price','<=',$max);
        }

        if (isset($request->brand)) {
            $this->product = $this->product->where('brand', 'LIKE', '%'.$request->brand.'%');   
        }

        $this->product = $this->product->orderBy('id', 'DESC')->paginate(40);

        return view('home.search-result')
        ->with('category_data', $this->category)
        ->with('products', $this->product);
    }

    public function submitReview(Request $request){
        $request->request->add(['rate'=>$request->rating]);
        $data = $request->except(['rating', '_token']);
        if($data['rate'] == '' && $data['review'] == ''){
            return redirect()->back();
        } 
        $request->validate([
            'rate' => 'sometimes|numeric|min:1|max:5',
            'review' => 'nullable|string'
        ]);
        $this->product = $this->product->where('slug', $request->slug)->first();
        $data['product_id'] = $this->product->id;
        $data['user_id'] = $request->user()->id;
        $data['status'] = 'inactive';
        $this->review->fill($data);
        $status = $this->review->save();
        if ($status) {
            $request->session()->flash('success', 'Thank you for your review');
        }else{
            $request->session()->flash('error', 'Sorry! There was problem while submitting your review');
        }
        return redirect()->back();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->product = $this->product
            ->with(['cat_info','sub_cat_info', 'images', 'vendor_info'])
            ->orderBy('id', 'desc')->paginate();
        return view('admin.product.index')->with('data', $this->product);
    }

    public function listSeller()
    {
        $this->product = $this->product
            ->with(['cat_info','sub_cat_info', 'images', 'vendor_info'])
            ->where('vendor_id', request()->user()->id)
            ->orderBy('id', 'desc')->paginate();
        return view('seller.product.index')->with('data', $this->product);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->category = $this->category->where('is_parent', 1)->where('parent_id', null)->pluck('title', 'id');
        $this->user = $this->user->where('role', 'seller')->pluck('name', 'id');
        if(request()->user()->role == 'admin'){
            return view('admin.product.product-form')
                ->with('parent_cats', $this->category)
                ->with('seller_info', $this->user);
        }else{
            return view('seller.product.product-form')
                ->with('parent_cats', $this->category)
                ->with('seller_info', $this->user);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = $this->product->getRules();
        $request->validate($rules);
        $data = $request->except('image');
        $data['added_by'] = $request->user()->id;
        $data['description'] = htmlentities($request->description);
        $data['slug'] = $this->product->getSlug($request->title);
        $this->product->fill($data);
        $status = $this->product->save();
        if($status){
            if($request->image){
                foreach ($request->image as $prod_image){
                    $image_name = uploadImage($prod_image, 'product', '500x500');
                    if($image_name){
                        $product_image = new ProductImage();
                        $product_image->product_id = $this->product->id;
                        $product_image->image_name = $image_name;
                        $product_image->save();
                    }
                }
            }
            $request->session()->flash('success', 'Product Added Successfully');
        }else{
            $request->session()->flash('error', 'Sorry! There was problem while adding product');
        }
        return redirect()->route('product.index');
    }

    public function storeSeller(Request $request){
        $rules = $this->product->getSellerRules();
        $request->validate($rules);
        $data = $request->except('image');
        $data['vendor_id'] = $request->user()->id;
        $data['status'] = 'inactive';
        $data['added_by'] = $request->user()->id;
        $data['description'] = htmlentities($request->description);
        $data['slug'] = $this->product->getSlug($request->title);
        $this->product->fill($data);
        $status = $this->product->save();
        if($status){
            if($request->image){
                foreach ($request->image as $prod_image){
                    $image_name = uploadImage($prod_image, 'product', '500x500');
                    if($image_name){
                        $product_image = new ProductImage();
                        $product_image->product_id = $this->product->id;
                        $product_image->image_name = $image_name;
                        $product_image->save();
                    }
                }
            }
            $request->session()->flash('success', 'Product Added Successfully');
        }else{
            $request->session()->flash('error', 'Sorry! There was problem while adding product');
        }
        return redirect()->route('seller.product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $this->product = $this->product->with(['images', 'cat_info', 'sub_cat_info', 'vendor_info', 'reviews', 'related_products'])
        ->where('status', 'active')
        ->where('slug', $slug)->firstOrFail();
        $current_cart_quantity = 0;
        if (session('cart')) {
            foreach (session('cart') as $cart_items) {
                if ($cart_items['id'] == $this->product->id) {
                    $current_cart_quantity = $cart_items['quantity'];
                    break;
                }
            }
        }
        $reviewed = false;
        if (request()->user()) {
            $reviewed = ($this->review->where('user_id', request()->user()->id)
            ->where('product_id', $this->product->id)->count()) ? true : false;
        }
        return view('home.product-detail')->with('product_info', $this->product)->with('reviewed', $reviewed)
        ->with('quantity', $current_cart_quantity);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->category = $this->category->where('is_parent', 1)->where('parent_id', null)->pluck('title', 'id');
        $this->user = $this->user->where('role', 'seller')->pluck('name', 'id');
        if(request()->user()->role == 'admin'){
            $this->product = $this->product->with('images')->find($id);
            return view('admin.product.product-form')
                ->with('product_detail', $this->product)
                ->with('parent_cats', $this->category)
                ->with('seller_info', $this->user);
        }else{
            $this->product = $this->product->with('images')->where('vendor_id',request()->user()->id)->find($id);
            return view('seller.product.product-form')
                ->with('product_detail', $this->product)
                ->with('parent_cats', $this->category)
                ->with('seller_info', $this->user);
        }
    }

    public function editSeller($id)
    {
        $this->category = $this->category->where('is_parent', 1)->where('parent_id', null)->pluck('title', 'id');
        $this->user = $this->user->where('role', 'seller')->pluck('name', 'id');
        if(request()->user()->role == 'admin'){
            $this->product = $this->product->with('images')->find($id);
            return view('admin.product.product-form')
                ->with('product_detail', $this->product)
                ->with('parent_cats', $this->category)
                ->with('seller_info', $this->user);
        }else{
            $this->product = $this->product->with('images')->where('vendor_id',request()->user()->id)->find($id);
            return view('seller.product.product-form')
                ->with('product_detail', $this->product)
                ->with('parent_cats', $this->category)
                ->with('seller_info', $this->user);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->product = $this->product->find($id);
        if(!$this->product){
            request()->session()->flash('error', 'Product Not Found');
            return redirect()->route('product.index');
        }
        $rules = $this->product->getRules();
        $request->validate($rules);
        $data = $request->except('image');
        $data['description'] = htmlentities($request->description);
        $this->product->fill($data);
        $status = $this->product->save();
        if($status){
            if($request->image){
                foreach ($request->image as $prod_image){
                    $image_name = uploadImage($prod_image, 'product', '500x500');
                    if($image_name){
                        $product_image = new ProductImage();
                        $product_image->product_id = $this->product->id;
                        $product_image->image_name = $image_name;
                        $product_image->save();
                    }
                }
            }
            if (isset($request->del_image)){
                foreach ($request->del_image as $del_image_name){
                    $image = new ProductImage();
                    $del = $image->where('image_name', $del_image_name)->delete();
                    if ($del){
                        deleteImage($del_image_name, 'product', true);
                    }
                }
            }
            $request->session()->flash('success', 'Product updated Successfully');
        }else{
            $request->session()->flash('error', 'Sorry! There was problem while updating product');
        }
        return redirect()->route('product.index');
    }

    public function updateSeller(Request $request, $id)
    {
        $this->product = $this->product->find($id);
        if(!$this->product){
            request()->session()->flash('error', 'Product Not Found');
            return redirect()->route('product.index');
        }
        $rules = $this->product->getSellerRules();
        $request->validate($rules);
        $data = $request->except('image');
        $data['description'] = htmlentities($request->description);
        $this->product->fill($data);
        $status = $this->product->save();
        if($status){
            if($request->image){
                foreach ($request->image as $prod_image){
                    $image_name = uploadImage($prod_image, 'product', '500x500');
                    if($image_name){
                        $product_image = new ProductImage();
                        $product_image->product_id = $this->product->id;
                        $product_image->image_name = $image_name;
                        $product_image->save();
                    }
                }
            }
            if (isset($request->del_image)){
                foreach ($request->del_image as $del_image_name){
                    $image = new ProductImage();
                    $del = $image->where('image_name', $del_image_name)->delete();
                    if ($del){
                        deleteImage($del_image_name, 'product', true);
                    }
                }
            }
            $request->session()->flash('success', 'Product updated Successfully');
        }else{
            $request->session()->flash('error', 'Sorry! There was problem while updating product');
        }
        return redirect()->route('seller.product.index');
    }

    public function reviewList(){
        $productReviews = ProductReview::with(['product', 'user'])->paginate();
        return view('admin.review.index')->with('data', $productReviews);
    }

    public function reviewStatus(Request $request, $id){
        $productReview = ProductReview::find($id);
        $productReview->status = $request->status;
        $productReview->save();
        $request->session()->flash('success', 'Review status updated Successfully');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->product = $this->product->find($id);
        if(!$this->product){
            request()->session()->flash('error', 'Product Not Found');
            return redirect()->route('product.index');
        }

        $images= $this->product->images;
        $del = $this->product->delete();
        if ($del){
            if ($images->count()){
                foreach ($images as $image_info){
                    deleteImage($image_info->image_name, 'product', true);
                }
            }
            request()->session()->flash('success', 'Product deleted Successfully');
        }else{
            request()->session()->flash('error', 'Sorry! There was problem while deleting product');
        }
        return redirect()->route('product.index');

    }

    public function destroySeller($id)
    {
        $this->product = $this->product->where('vendor_id', request()->user()->id)->find($id);
        if(!$this->product){
            request()->session()->flash('error', 'Product Not Found');
            return redirect()->route('seller.product.index');
        }

        $images= $this->product->images;
        $del = $this->product->delete();
        if ($del){
            if ($images->count()){
                foreach ($images as $image_info){
                    deleteImage($image_info->image_name, 'product', true);
                }
            }
            request()->session()->flash('success', 'Product deleted Successfully');
        }else{
            request()->session()->flash('error', 'Sorry! There was problem while deleting product');
        }
        return redirect()->route('seller.product.index');

    }
}
