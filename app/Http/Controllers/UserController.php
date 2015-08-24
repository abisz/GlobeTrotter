<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{

    /**
     * Returns view for editing User Information
     *
     * @param $id
     * @return \Illuminate\View\View|string
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        if(Auth::user()->id == $id){
            return view('users.edit', compact('user'));
        }else{
            return 'You are not authorized to edit this user profile';
        }

    }

    /**
     * Update User to the database
     *
     * @param UserRequest|Requests\UserRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Requests\UserRequest $request, $id)
    {
        $user = User::findOrFail($id);

        if ($request['image']) {
            //deleting old image
            $path = public_path('img').'/'.$user->id.'/profile-pic.jpg';
            File::delete($path);

            //modifying and saving new image
            $destinationPath = 'img/' . $user->id;
            $image = Input::file('image');
            $extension = $image->getClientOriginalExtension();
            $filename = 'profile-pic.' . $extension;

            $image->move($destinationPath, $filename);
            $picture['filename'] = $filename;
        }

        $user->update($request->all());

        Session::flash('flash_message', 'Your Profile was successfully updated!');

        return redirect(url('user') . '/' . $id );


    }

    /**
     * destroy User and all pictures from him_her
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|string
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        //checking if authenticated user is the user to be destroyed
        if(Auth::user()->id == $id){

            //delete all pics from user
            $folderPath = public_path('img').'/'.$id;
            File::deleteDirectory($folderPath);

            //delete user
            $user->delete();

            //redirect to homepage
            return redirect(url('/'));
        }else{
            //return warning for hackers
            return 'You can only delete your own profile';
        }

    }

}
