<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use Auth;

class NotificationsController extends WebController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $notifications = Auth::user()->notifications()->paginate(20);
        Auth::user()->markAsRead();

        return view('web.notifications.index', compact(
            'notifications'
        ));
    }
}
