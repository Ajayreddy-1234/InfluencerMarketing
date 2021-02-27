<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Service;
use App\Models\User;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/',function(Request $request){
    $users=User::all()->where('name',$request->findit);
    if(count($users)>0)
    { foreach($users as $user)
    {
    if($user->isInfluencer()&&$user->permission==1)
    {   $ser=$user->service;
        $links=$user->sociallink;
        return view('checkingInf.basic',compact(['ser','user','links']));
    }
    }
    return view('checkingInf.Notfound');
    }
    return view('checkingInf.Notfound');

});
Route::get('/Influencers',function()
{ $user=Auth::user();
    if($user){return redirect('/home');}
  $influencers=User::all()->where('role_id',3)->where('permission',1);
  return view('checkingInf.Influencerslist',compact(['influencers']));
});
Route::get('/basic/{id}',function($id)
{  $user=User::find($id);
    if($user)
    {
        if($user->isInfluencer()&&$user->permission==1)
        { 
            $ser=$user->service;
            $links=$user->sociallink;
        return view('checkingInf.basic',compact(['ser','user','links']));
        }
        return redirect('/');
    }
    return redirect('/');
});

// Route::get('/admin/user/roles',['middleware'=>['role','auth'],function(){

//     return "middleware role";
// }]);
Route::get('/home/{id}','App\Http\Controllers\HomeController@influencerdetail')->name('detail');
Route::get('/home/{id}/add/{serid}','App\Http\Controllers\HomeController@addtocart');
Route::get('/home/{id}/remove/{serid}','App\Http\Controllers\HomeController@removefromcart');
Route::get('/home/{id}/cart','App\Http\Controllers\HomeController@viewcart')->name('cart');
Route::middleware(['auth','IsAdmin'])->group(function(){
    Route::get('/admin','App\Http\Controllers\AdminController@index');
    Route::get('/admin/{id}/permission','App\Http\Controllers\AdminController@permission');

});
Route::middleware(['auth','IsInfluencer'])->group(function(){
    Route::resource('influencer','App\Http\Controllers\InfluencerController');
    Route::get('influencer/{id}/del','App\Http\Controllers\InfluencerController@destroy');
    Route::get('/influencer/links/create','App\Http\Controllers\LinkController@create');
    Route::post('/influencer/links/store','App\Http\Controllers\LinkController@store');
    Route::get('/influencer/links/{id}/del','App\Http\Controllers\LinkController@destroy');
    
});
Route::middleware(['auth'])->group(function(){
    Route::get('cal','App\Http\Controllers\gCalendarController@index');
    Route::get('oauth','App\Http\Controllers\gCalendarController@oauth');
    Route::post('/gcalendar/check','App\Http\Controllers\gCalendarController@check');
    Route::get('/gcalendar/addeventx','App\Http\Controllers\gCalendarController@storeevent');
});
