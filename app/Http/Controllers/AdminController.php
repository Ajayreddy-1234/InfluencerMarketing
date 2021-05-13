<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('IsAdmin');
    // }
    public function index()
    {
        $influencers=User::all()->where('role_id',3);
        return view('admin',compact(['influencers']));
    }
    public function permission($id)
    {
        $user=User::find($id);
        if($user->permission==0)
        {
            $user->permission=1;
        }else{
            $user->permission=0;
        }
        $user->save();
        return redirect('/admin');
    }
}

