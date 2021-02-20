<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{

    public $banner = null;
    public function __construct(Banner $banner)
    {
        $this->banner = $banner;
    }

    /**
     * Display a listing of the resource.
     *

     */
    public function index()
    {
        $this->banner = $this->banner->with('created_by')->paginate();
        return view('admin.banner.index')->with('banner_data', $this->banner);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.banner.banner-form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = $this->banner->getRules();
        $request->validate($rules);
        $data = $request->except('image');
        $data['added_by'] = $request->user()->id;
        if($request->image){
            $image = uploadImage($request->image, 'banner', '1200x360');
            if($image){
                $data['image'] = $image;
            }
        }
        $this->banner->fill($data);
        $status = $this->banner->save();
        if($status){
            $request->session()->flash('success', 'Banner added Successfully');
        }else{
            $request->session()->flash('error', 'Sorry! There was problem while adding banner');
        }
        return redirect()->route('banner.index');
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
        $this->banner = $this->banner->find($id);
        if(!$this->banner){
            request()->session()->flash('error', 'Banner Not Found');
            return redirect()->route('banner.index');
        }
        return view('admin.banner.banner-form')->with('banner_detail', $this->banner);
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
        $rules = $this->banner->getRules('update');
        $request->validate($rules);
        $this->banner = $this->banner->find($id);
        if(!$this->banner){
            request()->session()->flash('error', 'Banner Not Found');
            return redirect()->route('banner.index');
        }

        $data = $request->except('image');
        if($request->image){
            $image = uploadImage($request->image, 'banner', '1200x360');
            if($image){
                $data['image'] = $image;
                deleteImage($this->banner->image, 'banner', true);
            }
        }
        $this->banner->fill($data);
        $status = $this->banner->save();
        if($status){
            $request->session()->flash('success', 'Banner added Successfully');
        }else{
            $request->session()->flash('error', 'Sorry! There was problem while adding banner');
        }
        return redirect()->route('banner.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->banner = $this->banner->find($id);
        if(!$this->banner){
            request()->session()->flash('error', 'Banner Not Found');
            return redirect()->route('banner.index');
        }
        $image = $this->banner->image;
        $del = $this->banner->delete();
        if($del){
            deleteImage($this->banner->image, 'banner', true);

            request()->session()->flash('success', 'Banner Deleted Successfully');
        }else{
            request()->session()->flash('error', 'Sorry! There was problem while deleting banner');
        }
        return redirect()->route('banner.index');
    }
}
