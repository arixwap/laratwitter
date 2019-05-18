<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManagerStatic;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profile = User::find(Auth::id());

        return view ('profile', compact('profile'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // show other user profile by id / username.
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
            $image = ImageManagerStatic::make($request->file('picture')->getRealPath());
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
        // softdelete close account
    }
}
