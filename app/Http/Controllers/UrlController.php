<?php

namespace App\Http\Controllers;
use App\Models\Url;
use Illuminate\Support\Str;
use App\Notifications\EmailNotification;
use Illuminate\Http\Request;

class UrlController extends Controller
{
    public function index()
    {
        $urlLinks = Url::latest()->get();
        return view('url.index', compact('urlLinks'));
    }  


    public function store(Request $request)
    {
        $request->validate([
           'url_link' => 'required|url'
        ]);
   
        $input['full_url'] = $request->url_link;
        $input['short_url'] = Str::random(10);
        Url::create($input);
        return redirect('list')->with('success', 'Shorten Link Generated Successfully!');
    }


    public function deleteShortenLink($url_id)
    {
        $find = Url::where('id', $url_id)->delete();
   
        $urlLinks = Url::latest()->get();
        return view('url.index', compact('urlLinks'));
    }


    public function editShortenLink($url_id)
    {
        $urlLink = Url::where('id',$url_id)->first();
        return view('url.edit', compact('urlLink'));
    }


    public function editLink($url_id)
    {
        $full_url = request('full_url');
        $short_url = Str::random(10);
        Url::where('id',$url_id)->update(['full_url' => $full_url, 'short_url' => $short_url]);
        $urlLinks = Url::latest()->get();
        return view('url.index', compact('urlLinks'))->with('success', 'Shorten Link Generated Successfully!');
    }

    public function disableShortenLink()
    {
        $full_url = request('full_url');
        $short_url = Str::random(10);
    }


    public function shortenUrlLink($short_url_id)
    {
        $find_url = Url::where('id', $short_url_id)->first();
        if (Carbon::now()->greaterThan($find_url->created_at->addDay())) {
            $this->sendNotification(\Auth::id());
           return redirect()->back()->with('error', 'Link expired!');
        }

        return redirect($find_url->full_url);
    }


    public function sendNotification($user_id) 
    {
    	$user = User::where('id',$user_id)->first();
  
        $message = [
            'greeting' => 'Hi '.$user->name.',',
            'body' => 'Link you clicked has expired.',
        ];
  
        Notification::send($user, new EmailNotification($message));
   
        dd('Notification sent!');
    }

}
