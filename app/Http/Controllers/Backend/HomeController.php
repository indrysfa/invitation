<?php
/*
|--------------------------------------------------------------------------
| @author: Indry Sefviana | github @indrysfa
|--------------------------------------------------------------------------
*/
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function dashboard($username)
    {
        $user = Auth::user()->username;
        if ($username != $user) {
            return redirect()->route('login');
        } else {
            if (!$user) {
                return redirect()->route('login');
            } else {
                return view('admin.index', compact('user'));
            }
        }
        
    }
}
