<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\UserInfo;
use Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
  
    public $user = null;
    
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function adminList(){
        $user_list = $this->user->getUserByType('admin');
        return view('admin.user.user-list')->with('user_data', $user_list)->with('type', 'admin');
    }

    public function sellerList(){
        $user_list = $this->user->getUserByType('seller');
        return view('admin.user.user-list')->with('user_data', $user_list)->with('type', 'seller');
    }

    public function userList(){
        $user_list = $this->user->getUserByType('user');
        return view('admin.user.user-list')->with('user_data', $user_list)->with('type', 'user');
    }

    public function signup(Request $request){
        $rules = $this->user->getRegRules();
        $request->validate($rules);
        $data['name'] = $request->reg_name;
        $data['email'] = $request->reg_email;
        $data['password'] = Hash::make($request->reg_password);
        $data['role'] = 'user';
        $data['status'] = 'active';
        $this->user->fill($data);
        $status = $this->user->save();
        if ($status) {
            $request->session()->flash('success', 'User Created Successfully.');
        }else{
            $request->session()->flash('error', 'Sorry! There was problem while adding user');
        }
            return redirect()->route('homePage');   
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.user-form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = $this->user->getRules();
        $request->validate($rules);
        $data = $request->except('image');
        $data['password'] = Hash::make($request->password);
        $this->user->fill($data);
        $status = $this->user->save();
        if ($status) {
            if ($request->image) {
                $image_name = uploadImage($request->image, 'user', '200x200');
                if ($image_name) {
                    $data['image'] = $image_name;
                }
            }
            $data['user_id'] = $this->user->id;
            $data['data'] = json_encode($data['data']);
            $user_info = new UserInfo();
            $user_info->fill($data);
            $user_info->save();
            $request->session()->flash('success', 'User Created Successfully.');
        }else{
            $request->session()->flash('error', 'Sorry! There was problem while adding user');
        }
        if ($request->role == 'admin') {
            return redirect()->route('admin-list');   
        } else if($request->role == 'seller') {
            return redirect()->route('seller-list');   
        }else{
            return redirect()->route('user-list');   
        }
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
        $this->user = $this->user->with('user_info')->find($id);
        if (!$this->user) {
            request()->session()->flash('error', 'Sorry! User does not exists.');
            return redirect()->back();   
        }
        return view('admin.user.user-form')->with('user_detail', $this->user);

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
        $this->user = $this->user->with('user_info')->find($id);
        if (!$this->user) {
            request()->session()->flash('error', 'Sorry! User does not exists.');
            return redirect()->back();   
        }
        $rules = $this->user->getRules('updates');
        $request->validate($rules);
        $data = $request->except('image');
        if (isset($request->change_password)) {
            $data['password'] = Hash::make($request->password);
        } else{
            $data['password'] = $this->user->password;
        }
        
        $this->user->fill($data);
        $status = $this->user->save();
        if ($status) {
            if ($request->image) {
                $image_name = uploadImage($request->image, 'user', '200x200');
                if ($image_name) {
                    $data['image'] = $image_name;
                    deleteImage($this->user->user_info['image'], 'user');
                }
            }
            $data['user_id'] = $this->user->id;
            $data['data'] = json_encode($data['data']);
            $user_info = new UserInfo();
            $user_info = $user_info->where('user_id', $this->user->id)->first();
            if ($user_info == null) {
                $user_info = new UserInfo();
            }
            $user_info->fill($data);
            $user_info->save();
            $request->session()->flash('success', 'User Updated Successfully.');
        }else{
            $request->session()->flash('error', 'Sorry! There was problem while updating user');
        }
        if ($request->role == 'admin') {
            return redirect()->route('admin-list');   
        } else if($request->role == 'seller') {
            return redirect()->route('seller-list');   
        }else{
            return redirect()->route('user-list');   
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
        $this->user = $this->user->with('user_info')->find($id);
        if (!$this->user) {
            request()->session()->flash('error', 'Sorry! User does not exists.');
            return redirect()->back();   
        }
        $image = $this->user->user_info['image'];
        $del = $this->user->delete();
        if ($del) {
            deleteImage($image, 'user', true);
            request()->session()->flash('success', 'User Deleted Successfully.');
        } else {
            request()->session()->flash('error', 'Sorry! There was problem whie deleting user.');
        }
        return redirect()->back();   
    }

    public function updateProfile(Request $request, $id)
    {
        $this->user = $this->user->with('user_info')->find($id);
        if (!$this->user) {
            request()->session()->flash('error', 'Sorry! User does not exists.');
            return redirect()->back();   
        }
        $request->request->add(['role' => 'user', 'status' => 'active']);
        $rules = $this->user->getRules('updates');
        $request->validate($rules);
        $data = $request->except('image');
        
        $this->user->fill($data);
        $status = $this->user->save();
        if ($status) {
            if ($request->image) {
                $image_name = uploadImage($request->image, 'user', '200x200');
                if ($image_name) {
                    $data['image'] = $image_name;
                    deleteImage($this->user->user_info['image'], 'user');
                }
            }
            $data['user_id'] = $this->user->id;
            $data['data'] = json_encode($data['data']);
            $user_info = new UserInfo();
            $user_info = $user_info->where('user_id', $this->user->id)->first();
            if ($user_info == null) {
                $user_info = new UserInfo();
            }
            $user_info->fill($data);
            $user_info->save();
            $request->session()->flash('success', 'User Updated Successfully.');
        }else{
            $request->session()->flash('error', 'Sorry! There was problem while updating user');
        }
            return redirect()->back();   
        
    }
}
