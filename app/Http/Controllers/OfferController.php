<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offer;
use App\Models\OfferProduct;
use App\Models\Product;

class OfferController extends Controller
{

    protected $offer = null;
    protected $product = null;
    protected $offer_product = null;

    public function __construct(Offer $offer, Product $product, OfferProduct $offer_product){
        $this->offer = $offer;
        $this->product = $product;
        $this->offer_product = $offer_product;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->offer = $this->offer->with('offeredProducts')->paginate();
        return view('admin.offer.index')->with('data', $this->offer);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->product = $this->product->pluck('title', 'id'); 
        return view('admin.offer.offer-form')->with('products', $this->product);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = $this->offer->getRules();
        $request->validate($rules);
        $data = $request->except(['image', 'product_id', 'discount']);
        $data['added_by'] = $request->user()->id;
        $data['slug'] = $this->offer->getSlug($request->title);
        if ($request->image) {
            $image = uploadImage($request->image, 'offer', '1200x200');
            if ($image) {
                $data['image'] = $image;
            }
        }
        $this->offer->fill($data);
        $status = $this->offer->save();
        if ($status) {
            $product_id = $request->product_id;
            $discount = $request->discount;
            $size = count($product_id);
            if ($size) {
                for ($i=0; $i < $size ; $i++) { 
                    $temp_data = array(
                        'offer_id' => $this->offer->id,
                        'product_id' => $product_id[$i],
                        'discount' => $discount[$i]
                    );
                    $offer_product = new OfferProduct();
                    $offer_product = $offer_product->where('offer_id', $this->offer->id)->where('product_id', $product_id[$i])->first();  
                    if ($offer_product != null && $offer_product->discount < $discount[$i]) {
                        $offer_product->fill($temp_data);
                    }else{
                        $offer_product = new OfferProduct();
                        $offer_product->fill($temp_data);
                    }   
                    $offer_product->save();                                
                }
            }
            $request->session()->flash('success', 'Offer Created Successfully.');
        }else{
            $request->session()->flash('error', 'Sorry! There was problem while creating an offer');
        }
        return redirect()->route('offer.index');
  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $this->offer = $this->offer->with('offeredProducts')->where('slug', $slug)
        ->firstOrFail();
        $this->offer_product = $this->offer_product->with('product_info')
        ->where('offer_id', $this->offer->id)
        ->get();
        return view('home.offered-products')->with('products', $this->offer_product);
    }

    public function deleteOfferedProduct(Request $request){
            $id = $request->off_prod_id;
            $offer_product = new OfferProduct();
            $offer_product = $offer_product->find($id);
            $offer_product->delete();
            return response()->json(['success'=>true]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->offer = $this->offer->find($id);
        if (!$this->offer) {
            request()->session()->flash('error', 'Offer could not be found');
            return redirect()->route('offer.index');
        }
        $all_products  = $this->product->pluck('title', 'id');
        return view('admin.offer.offer-form')
            ->with('offer_detail', $this->offer)
            ->with('products', $all_products);
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
        $this->offer = $this->offer->find($id);
        if (!$this->offer) {
            request()->session()->flash('error', 'Offer could not be found');
            return redirect()->route('offer.index');
        }
        $rules = $this->offer->getRules('update');
        $request->validate($rules);
        $data = $request->except(['image', 'product_id', 'discount']);
        if ($request->image) {
            $image = uploadImage($request->image, 'offer', '1200x200');
            if ($image) {
                $data['image'] = $image;
                deleteImage($this->offer->image, 'offer', true);
            }
        }
        $this->offer->fill($data);
        $status = $this->offer->save();
        if ($status) {
            $product_id = $request->product_id;
            $discount = $request->discount;
            $size = count($product_id);
            if ($size) {
                $off_prod = new OfferProduct();
                $off_prod->where('offer_id', $this->offer->id)->delete();
                
                for ($i=0; $i < $size ; $i++) { 
                    $temp_data = array(
                        'offer_id' => $this->offer->id,
                        'product_id' => $product_id[$i],
                        'discount' => $discount[$i]
                    );

                    $offer_product = new OfferProduct();
                    $offer_product->fill($temp_data); 
                    $offer_product->save();                                
                }
            }
            $request->session()->flash('success', 'Offer Updated Successfully.');
        }else{
            $request->session()->flash('error', 'Sorry! There was problem while updating an offer');
        }
        return redirect()->route('offer.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->offer = $this->offer->with('offeredProducts')->find($id);
        if (!$this->offer) {
            request()->session()->flash('error', 'Offer could not be found');
            return redirect()->route('offer.index');
        }
        $image = $this->offer->image;
        $del = $this->offer->delete();
        if ($del) {
            deleteImage($image, 'offer');
            request()->session()->flash('success', 'Offer deleted succesfully.');
        }else{
            request()->session()->flash('error', 'Sorry! There was problem while deleting an offer');
        }
        return redirect()->route('offer.index');
    }
}
