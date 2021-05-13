<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Sociallinks;

class LinkController extends Controller
{
    public function create()
    {  
        $user=Auth::user();
        if(!$user->permission){return redirect('/influencer');}
        return view('Influencer.Slinks.create',compact(['user']));
    }

    public function store(Request $request)
    {
        $user=Auth::user();
        if(!$user->permission){return redirect('/influencer');}
        if($request->name=="Others")
        {
            $request->name=$request->name1;
        }
        $lin=new Sociallinks(['name'=>$request->name,'link'=>$request->link]);
        $user->sociallink()->save($lin);
        return redirect('/influencer');
    }
    public function destroy($id)
    {  
        $user=Auth::user();
        if(!$user->permission){return redirect('/influencer');}
        $ill=$user->sociallink->find($id);
        if(!$ill){return redirect('/influencer');}
       $lin=Sociallinks::findOrFail($id);
       $lin->delete();
       return redirect('/influencer');
    }
}
