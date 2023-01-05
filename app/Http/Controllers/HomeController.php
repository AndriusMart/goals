<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;

class HomeController extends Controller
{



    public function homeList(Request $request)
    {

        $time_now = Carbon::now();

        return view('home.index', [
            'goals' => Goal::orderBy('title', 'asc')->get(),
            'time_now' => $time_now,

        ]);
    }
    public function rate(Request $request, Goal $book)
    {
        $votes = json_decode($book->votes ?? json_encode([]));
        if (in_array(Auth::user()->id, $votes)) {
            return redirect()->back()->with('not', 'You already rated this book');
        }
        $votes[] = Auth::user()->id;
        $book->votes = json_encode($votes);
        $book->rating_sum = $book->rating_sum + $request->rate;
        $book->rating_count++;
        $book->rating = $book->rating_sum / $book->rating_count;
        $book->save();
        return redirect()->back()->with('ok', 'Thanks for rating this book');
    }
}
