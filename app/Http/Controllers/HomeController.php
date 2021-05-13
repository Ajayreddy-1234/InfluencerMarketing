<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\CartItems;
use App\Models\Service;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {  
        $user=Auth::user();
        if(!$user->refreshtoken){return redirect('/oauth');}
        $influencers=User::all()->where('role_id',3)->where('permission',1);
        if($user->isAdmin())
        {
            return redirect('/admin');
        }else if($user->isInfluencer())
        {
            return redirect('/influencer');
        }else{
            return view('home',compact(['user','influencers']));
        }
    }
    public function influencerdetail($id)
    {
        $user=Auth::user(); 
        if($user->isAdmin())
        {
            return redirect('/admin');
        }else if($user->isInfluencer())
        {
            return redirect('/influencer');
        }else{
            $inf=User::findOrFail($id);
            if(!$inf->isInfluencer()){return redirect('/home');}
            if($inf->permission==0){return redirect('/home');}
            $services=$inf->service;
            $links=$inf->sociallink;
            $items=$user->cartitems->where('inf_id',$id);
            return view('Nuser.detail',compact(['user','services','inf','items','links']));
        }
    }
    public function addtocart($id,$serid)
    {
        $user=Auth::user(); 
        if($user->isAdmin())
        {
            return redirect('/admin');
        }else if($user->isInfluencer())
        {
            return redirect('/influencer');
        }else{
         $item=$user->cartitems->where('inf_id',$id)->where('service_id',$serid);
         
         if(count($item)==0)
         {  
             CartItems::create(['user_id'=>$user->id,'service_id'=>$serid,'inf_id'=>$id,'count_x'=>1]);
         }else{
             foreach($item as $it)
             {$it->count_x=$it->count_x+1;
             $it->save();}
             }
         return redirect()->back();
        
        }
    }
    public function removefromcart($id,$serid)
    {
        $user=Auth::user(); 
        if($user->isAdmin())
        {
            return redirect('/admin');
        }else if($user->isInfluencer())
        {
            return redirect('/influencer');
        }else{
            $item=$user->cartitems->where('inf_id',$id)->where('service_id',$serid);
            if(count($item)>0)
            { 
                foreach($item as $item)
               {if($item->count_x==1)
               {
                  $item->delete();
               }else{
                   $item->count_x=$item->count_x-1;
                   $item->save();
               }}
            }
            return redirect()->back();

        }
    }
    public function viewcart($id)
    {  
        $user=Auth::user(); 
        if($user->id!=$id)return redirect('/home');
        if($user->isAdmin())
        {
            return redirect('/admin');
        }else if($user->isInfluencer())
        {
            return redirect('/influencer');
        }else{
          $items=$user->cartitems;$c=0;
          foreach($items as $item)
          {
              $inf=User::findOrFail($item->inf_id);
              $ser=Service::find($item->service_id);
              if(empty($ser))
              {
               $item->delete();
              $c=$c+1;
              }
          }
          if($c>0)
          {
              return redirect(route('cart',$user->id));
          }
          
          foreach($items as $item)
          {
              $inf=User::findOrFail($item->inf_id);
              $ser=Service::find($item->service_id);
              $item['influencer']=$inf->name;
              $item['service']=$ser->name;
              $item['cost']=$ser->cost;
          }
           return view('Nuser.viewcart',compact(['items','user']));
        }

    }
}
