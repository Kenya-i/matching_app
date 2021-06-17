<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Swipe;

class UserController extends Controller
{
    public function index()
    {
      // すでにSwipeしたuserを省いて、Swipeしていないuserを1つ取得する
      // すでにswipeしたuser idsを取得
      $swipedUserIds = Swipe::where('from_user_id', \Auth::user()->id)->get()->pluck('to_user_id');

      // swipeしていないuserを1つ取得
      $user = User::where('id', '<>', \Auth::user()->id)->whereNotIn('id', $swipedUserIds)->first();
      return view('pages.user.index', [
        'user' => $user
      ]);
    }
}
