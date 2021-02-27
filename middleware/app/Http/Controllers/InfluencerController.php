<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Service;

class InfluencerController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('IsInfluencer');
    // }
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $user=Auth::user();
        if(!$user->permission){return view('Influencer.nopermission',compact(['user']));}
        $services=$user->service;
        $links=$user->sociallink;
        return view('influencer',compact(['services','user','links']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {  
        $user=Auth::user();
        if(!$user->permission){return redirect('/influencer');}
        return view('Influencer.create',compact(['user']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user=Auth::user();
        if(!$user->permission){return redirect('/influencer');}
        $ser=new Service(['name'=>$request->service,'cost'=>$request->cost]);
        $user->service()->save($ser);
        return redirect('/influencer');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect('/influencer');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user=Auth::user();
        if(!$user->permission){return redirect('/influencer');}
       $ill=$user->service->find($id);
       if(!$ill){return redirect('/influencer');}
        $service=Service::findOrFail($id);
        $user=Auth::user();
        return view('Influencer.edit',compact(['service','user']));
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
        $user=Auth::user();
        if(!$user->permission){return redirect('/influencer');}
       $ill=$user->service->find($id);
       if(!$ill){return redirect('/influencer');}
        $service=Service::findOrFail($id);
        $service->name=$request->service;
        $service->cost=$request->cost;
        $service->save();
        return redirect('/influencer');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {  
        $user=Auth::user();
        if(!$user->permission){return redirect('/influencer');}
        $ill=$user->service->find($id);
        if(!$ill){return redirect('/influencer');}
       $ser=Service::findOrFail($id);
       $ser->delete();
       return redirect('/influencer');
    }
}
