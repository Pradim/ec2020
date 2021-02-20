<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $category = null;
    protected $product = null;
    public function __construct(Category $category, Product $product)
    {
        $this->category = $category;
        $this->product = $product;
    }

    public function getAllCategoryProducts(Request $request){
        $this->category = $this->category->with('products')->where('slug', $request->slug)->firstOrFail();
        $this->product = $this->product->where('status', 'active')->where('cat_id', $this->category->id)->orderBy('id', 'DESC')->paginate(48);
        return view('home.product-list')
        ->with('products', $this->product);
    }

    public function getAllChildProducts(Request $request){
        $this->category = $this->category->with('products')->where('slug', $request->child_slug)->firstOrFail();
        $this->product = $this->product->where('status', 'active')->where('sub_cat_id', $this->category->id)->orderBy('id', 'DESC')->paginate(48);
        return view('home.product-list')
        ->with('products', $this->product);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->category = $this->category->with('parent_info')->paginate();
        return view('admin.category.index')->with('category_data', $this->category);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parent_cats = $this->category->where('is_parent', 1)->pluck('title', 'id');
        return view('admin.category.category-form')->with('parent_cats', $parent_cats);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = $this->category->getRules();
        $request->validate($rules);
        $data = $request->except('image');
        $data['added_by'] = $request->user()->id;
        $data['slug'] = $this->category->getSlug($request->title);
        $data['is_parent'] = $request->input('is_parent', 0);
        if($request->image){
            $img = uploadImage($request->image, 'category', '1280x720');
            if($img){
                $data['image'] = $img;
            }
        }

        $this->category->fill($data);
        $status = $this->category->save();
        if($status){
            $request->session()->flash('success', 'Category Added Successfully');
        }else{
            $request->session()->flash('error', 'Sorry! There was problem while adding category');
        }
        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->category = $this->category->find($id);
        if(!$this->category){
            request()->session()->flash('error', 'Category Not Found');
            return redirect()->route('category.index');
        }
        $parent_cats = $this->category->where('is_parent', 1)->pluck('title', 'id');
        return view('admin.category.category-form')->with('parent_cats', $parent_cats)->with('category_detail', $this->category);
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
        $this->category = $this->category->find($id);
        if(!$this->category){
            request()->session()->flash('error', 'Category Not Found');
            return redirect()->route('category.index');
        }
        $rules = $this->category->getRules();
        $request->validate($rules);
        $data = $request->except('image');
        $data['is_parent'] = $request->input('is_parent', 0);
        if($data['is_parent'] == 1){
            $data['parent_id'] = null;
        }
        if($request->image){
            $img = uploadImage($request->image, 'category', '1280x720');
            if($img){
                $data['image'] = $img;
                deleteImage($this->category->image, 'category', true);
            }
        }
        $child_id = $this->category->where('parent_id', $this->category->id)->pluck('id');
        $this->category->fill($data);
        $status = $this->category->save();
        if($status){
            $this->category->shiftChild($child_id->toArray(), $this->category->parent_id);
            $request->session()->flash('success', 'Category updated Successfully');
        }else{
            $request->session()->flash('error', 'Sorry! There was problem while updating category');
        }
        return redirect()->route('category.index');
    }

    public function getChildCats(Request $request){
        if ($request->cat_id == null){
            return response()->json(['status'=>false, 'data'=>null, 'msg'=>'No child category.']);
        }
        $this->category = $this->category->getChildCat($request->cat_id);
        if($this->category->count()){
            return response()->json(['status'=>true, 'data'=>$this->category, 'msg'=>'Success']);
        }else{
            return response()->json(['status'=>false, 'data'=>null, 'msg'=>'No child category.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->category = $this->category->find($id);
        if(!$this->category){
            request()->session()->flash('error', 'Category Not Found');
            return redirect()->route('category.index');
        }
        $child_id = $this->category->where('parent_id', $this->category->id)->pluck('id');
        $image = $this->category->image;
        $del = $this->category->delete();
        if ($del){
            if ($child_id){
                $data = array(
                    'is_parent'=>1,
                    'parent_id'=>null
                );
                $this->category->whereIn('id', $child_id->toArray())->update($data);
            }
            deleteImage($image, 'category', true);
            request()->session()->flash('success', 'Category deleted Successfully');
        }else{
            request()->session()->flash('error', 'Sorry! There was problem while deleting category');
        }
        return redirect()->route('category.index');
    }
}
