<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\user;


class HomeController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function createUser()
    {
        return view('create-user');
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function storeDetails(Request $request)
    {
    	 $user = new User;

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'description' => 'required',
            'date_of_birth' => 'required|before:today',
            'captcha' => 'required|captcha'
        ]);

        $birthday = date('Y-m-d', strtotime($request->date_of_birth));

         try{
        $user->name = $request->name;
         $user->description = $request->description;
          $user->email = $request->email;
          $user->date_of_birth = $birthday;

        $save_status = $user->save();

         
        if($save_status){
         return redirect()->back()->with('success', 'User register successfully'); 
        }
    }

        catch(\Exception $e){
        return redirect()->back()->with('error', $e->getMessage());
     }
         
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function refreshCaptcha()
    {
        return response()->json(['captcha'=> captcha_img()]);
    }
}
