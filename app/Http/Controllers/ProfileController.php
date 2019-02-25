<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManagerStatic as Image;
use App\User;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profile = User::where('id', '=', Auth::id())->first();
        return view ('profile', compact('profile'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect('profile');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return redirect('profile');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect('profile');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return redirect('profile');
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
        $user = User::find($id);
        if($request->hasfile('picture')!='') {
            $this->validate($request, [
                'picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:max_width=5000,max_height=5000'
            ]);
            $name = strtolower(Auth::user()->name);
            $name = str_replace(' ', '', $name); 
            $name = str_replace('.', '', $name);
            $name = "pp_".$name."_".Auth::id().".jpg";
            $image = Image::make($request->file('picture')->getRealPath());
            $image->fit(800);
            $image->save(public_path().'/img/'.$name);
            $user->profile_picture = asset('img/'.$name);
            $user->save();
            return redirect('profile')->with('success', 'Profile picture uploaded');
        } else {
            $user->name = trim($request->get('name'));
            $validator = ['name' => ['required', 'string', 'max:255']];
            if($request->get('email')!==$user->email) {
                $validator['email'] = ['required', 'string', 'email', 'max:255', 'unique:users'];
                $user->email = trim(strtolower($request->get('email')));
            }
            if($request->get('password')!='') {
                $validator['password'] = ['string', 'min:6', 'confirmed'];
                $user->password = Hash::make($request->password);
            }
            $request->validate($validator);
            $user->save();
            return redirect('profile')->with('success', 'Update profile success');
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
        return redirect('profile');
    }
}
