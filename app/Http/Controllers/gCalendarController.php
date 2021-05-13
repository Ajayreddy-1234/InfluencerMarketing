<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;
use Google_Service_Calendar_EventDateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\CartItems;
use App\Models\Service;

class gCalendarController extends Controller
{
    protected $client;

    public function __construct()
    {
        $client = new Google_Client();
        $client->setAuthConfig('C:\Users\ravin\Desktop\Code\Influencer_Marketing\middleware\public\credentials .json');
        $client->addScope(Google_Service_Calendar::CALENDAR);

        $guzzleClient = new \GuzzleHttp\Client(array('curl' => array(CURLOPT_SSL_VERIFYPEER => false)));
        $client->setHttpClient($guzzleClient);
        $this->client = $client;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        session_start();
        $user=Auth::user();
            $this->client->refreshToken($user->refreshtoken);
            $service = new Google_Service_Calendar($this->client);
            $calendarId = 'primary';
            $datein=date('c',strtotime("now"));
            $datein=substr($datein,0,-4);
            $datein=$datein."5:30";
            $optParams = array(
                "q" => "InfluencerMarketing",
                "timeMin" => $datein
            );
            $results = $service->events->listEvents($calendarId,$optParams);
            $events = $results->getItems();
            return view('gcalendar.show',compact(['events','user']));

    }

    public function oauth()
    {
        session_start();
        $rurl = action('App\Http\Controllers\gCalendarController@oauth');
        $this->client->setRedirectUri($rurl);
        if (!isset($_GET['code'])) {
            $this->client->setAccessType('offline');
            $this->client->setApprovalPrompt('force');
            $auth_url = $this->client->createAuthUrl();
            $filtered_url = filter_var($auth_url, FILTER_SANITIZE_URL);
            return redirect($filtered_url);
        } else {
            $this->client->authenticate($_GET['code']);
            $_SESSION['access_token'] = $this->client->getAccessToken();
            $user=Auth::user();
            $user->refreshtoken=$this->client->getRefreshToken();
            $user->save();
            return redirect('/home');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function storeevent()
    {
        session_start();
        $SDT = $_SESSION["sdt"];
        $EDT = $_SESSION["edt"];
        $slot=$_SESSION["slot"];
        $user=Auth::user();
        if(!$user->refreshtoken){return redirect('/oauth');}
        if($user->isInfluencer())
        {
            return redirect('/influencer');
        }else{
            $items=$user->cartitems;
            $c=0;$k1="";$k2="";
            foreach($items as $item)
          {
              $inf=User::find($item->inf_id);
              $ser=Service::find($item->service_id);
              $client = new Google_Client();
                $client->setAuthConfig('C:\Users\ravin\Desktop\Code\Influencer_Marketing\middleware\public\credentials .json');
                $client->addScope(Google_Service_Calendar::CALENDAR);
                $guzzleClient = new \GuzzleHttp\Client(array('curl' => array(CURLOPT_SSL_VERIFYPEER => false)));
                $client->setHttpClient($guzzleClient);
              $this->client=$client;
              $this->client->refreshToken($inf->refreshtoken);
              $service = new Google_Service_Calendar($this->client);
              $calendarId = 'primary';
              $title=$ser->name;
              $description="InfluencerMarketing"." ".$inf->name." ".$ser->name." ".$slot;
              $event = new Google_Service_Calendar_Event([
                'summary' => $title,
                'description' => $description,
                'start' => ['dateTime' => $SDT],
                'end' => ['dateTime' => $EDT],
                'reminders' => ['useDefault' => true],
            ]);
            $results = $service->events->insert($calendarId, $event);
            if (!$results) {
                return redirect(route('cart',$user->id))->with('status','Couldnot create Event Try again');
                }
          }

          foreach($items as $item)
          {
              $inf=User::find($item->inf_id);
              $ser=Service::find($item->service_id);
              $client = new Google_Client();
                $client->setAuthConfig('C:\Users\ravin\Desktop\Code\Influencer_Marketing\middleware\public\credentials .json');
                $client->addScope(Google_Service_Calendar::CALENDAR);
                $guzzleClient = new \GuzzleHttp\Client(array('curl' => array(CURLOPT_SSL_VERIFYPEER => false)));
                $client->setHttpClient($guzzleClient);
              $this->client=$client;
              $this->client->refreshToken($user->refreshtoken);
              $service = new Google_Service_Calendar($this->client);
              $calendarId = 'primary';
              $title=$ser->name;
              $description="InfluencerMarketing"." ".$inf->name." ".$ser->name." ".$slot;
              $event = new Google_Service_Calendar_Event([
                'summary' => $title,
                'description' => $description,
                'start' => ['dateTime' => $SDT],
                'end' => ['dateTime' => $EDT],
                'reminders' => ['useDefault' => true],
            ]);
            $results = $service->events->insert($calendarId, $event);
            if (!$results) {
                return redirect(route('cart',$user->id))->with('status','Couldnot create Event Try again');
                }
          }
          return redirect(route('cart',$user->id))->with('status','Successfully Event created');
        }    
    }

    /**
     * Display the specified resource.
     *
     * @param $eventId
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function check(Request $request)
    {   session_start();
        $user=Auth::user();
        if(!$user->refreshtoken){return redirect('/oauth');}
        if($user->isInfluencer())
        {
            return redirect('/influencer');
        }else{
            $items=$user->cartitems;
            $c=0;$k1="";$k2="";
            foreach($items as $item)
          {   
              $inf=User::find($item->inf_id);
              $ser=Service::find($item->service_id);
              $client = new Google_Client();
                $client->setAuthConfig('C:\Users\ravin\Desktop\Code\Influencer_Marketing\middleware\public\credentials .json');
                $client->addScope(Google_Service_Calendar::CALENDAR);
                $guzzleClient = new \GuzzleHttp\Client(array('curl' => array(CURLOPT_SSL_VERIFYPEER => false)));
                $client->setHttpClient($guzzleClient);
              $this->client = $client;
              $this->client->refreshToken($inf->refreshtoken);
              $service = new Google_Service_Calendar($this->client);
                $calendarId = 'primary';
                $datein=date('c',strtotime($request->date));
                $datein=substr($datein,0,-4);
                $datein=$datein."5:30";
                $slot=$request->Timing;
                $SDT=$datein;$EDT=$datein;
                if($slot=="1")
                {
                $SDT[12]='9';$EDT[11]='1';$EDT[12]='2';
                }else if($slot=="2")
                {
                    $SDT[11]='1';$SDT[12]='2';$EDT[11]='1';$EDT[12]='5';
                }else if($slot=="3")
                {
                    $SDT[11]='1';$SDT[12]='5';$EDT[11]='1';$EDT[12]='8';
                }else{
                    $SDT[11]='1';$SDT[12]='8';$EDT[11]='2';$EDT[12]='1';
                }
                $optParams = array(
                    "q" => "InfluencerMarketing"." ".$inf->name." ".$ser->name." ".$slot,
                    "timeMin" => $SDT,
                    "timeMax" =>$EDT
                );
            $results = $service->events->listEvents($calendarId,$optParams);
            $events = $results->getItems();
            if(count($events)>0){$k1="Sorry! ".$ser->name." Provided by ".$inf->name." is already booked for the opted timeslot please Take another slot or remove the service and try again";$c=1;break;}  
          }
          
          if($c){return redirect(route('cart',$user->id))->with('Paymentforwardern',$k1);}
          $k2="You can Continue to pay!! You neednot fill again proceed to payment!!";
          $_SESSION["slot"]=$slot;
          $_SESSION["sdt"]=$SDT;
          $_SESSION["edt"]=$EDT;
          return redirect(route('cart',$user->id))->with('Paymentforwarder',$k2);
        }
    }

}