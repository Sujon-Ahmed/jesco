<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\User;
use Intervention\Image\ImageManagerStatic as Image;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function profile()
    {
        return view('backend.users.profile');
    }
    // profile update
    public function profileUpdate(Request $request)
    {
        if ($request->photo != '') {

            $user_information = User::find($request->id);
            
            if ($user_information->photo != '') {
                unlink(public_path('/backend_assets/uploads/users/'.$user_information->photo));
            }
            
            $image = $request->photo;
            $extension = $request->photo->getClientOriginalExtension();
            $file_name =  date('mdYHis') . uniqid() . '.'. $extension;
            
            Image::make($image)->fit(225, 225)->save(public_path('/backend_assets/uploads/users/'.$file_name));
            
            User::find($request->id)->update([
                'photo' => $file_name,
            ]);
        }

        User::find($request->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'country' => $request->country,
            'job' => $request->job,
            'company' => $request->company,
            'about' => $request->about,
            'address' => $request->address,
            'created_at' => Carbon::now(),
        ]);
        return back();
    }
    // password change
    public function changePassword(Request $request)
    {
        $request->validate([
            'password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);
   
        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
   
        dd('Password change successfully.');
    }
}
