<?php
/*
|--------------------------------------------------------------------------
| @author: Indry Sefviana | github @indrysfa
|--------------------------------------------------------------------------
*/
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index($username = '')
    {
        $user = User::where('username', $username)->first();
        $attendance = User::join('attendances', 'users.username', '=', 'attendances.username_id')
            ->where('username_id', '=', $user->username)
            ->get();
        $wish = User::join('wishes', 'users.username', '=', 'wishes.username_id')
            ->where('username_id', '=', $user->username)
            ->get();
        $event = User::join('events', 'users.username', '=', 'events.username_id')
            ->where('status', '=', 1)
            ->where('username_id', '=', $user->username)
            ->get();
        $contact_info = User::join('contact_infos', 'users.username', '=', 'contact_infos.username_id')
            ->where('username_id', '=', $user->username)
            ->get();
        $gallery_head = User::join('gallery_captions', 'users.username', '=', 'gallery_captions.username_id')->get();
            
        if ($event->isEmpty()) {
            return view('emptypage');
        } else {
            return view('wedding.index', compact('attendance', 'wish', 'event', 'contact_info', 'user', 'gallery_head'));
        }
    }

    public function dashboard()
    {
        return view('wedding.dashboard');
    }

    public function create(Request $request, $username)
    {
        $data = Attendance::create([
            'name'          => ucwords($request->name),
            'username_id'   => $request->username_id,
            'email'         => $request->email,
            'phone'         => $request->phone
        ]);

        if ($data) {
            return redirect()->route('front.data.wish', $data['username_id'])->with('success', 'Thank you, the form you have filled has been accepted');
        }
    }
}
