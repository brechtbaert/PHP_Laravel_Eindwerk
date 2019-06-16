<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');

    }

    public function addReview($movieId)
    {
        $movieData = DB::table('tbl_films')
            ->select('film_id','titel')
            ->where('film_id','=',$movieId)
            ->get();

        $vars = ['movieId'=>$movieId,'movieData'=>$movieData];

        return view('addReview',$vars);
    }

    public function addNewReview(Request $request)
    {
        $ar_rules = array('rating'=>'required|integer|between:1,10','review'=>'required');
        $request->validate($ar_rules);

        $rating = $request->input('rating');
        $review = $request->input('review');
        $movieId = $request->input('film_id');
        $userId = Auth::id();

        $ar_param = array('user_id'=>$userId,'film_id'=>$movieId,'rating'=>$rating,'review'=>$review);

        $result = DB::insert('insert into tbl_review(user_id,film_id,rating,review) VALUES(:user_id,:film_id,:rating,:review)',$ar_param);

        try
        {
            $result;
        }
        catch (QueryException $exception)
        {
            //message for error
            $message = "Er is en fout opgetreden tijdens het toevoegen van de review";
            $request->session()->flash('message',$message);

            //redirect to moviepage
            return redirect()->route('showMovies');
        }

        $message = "De review werd succesvol toegevoegd";
        $request->session()->flash('message',$message);

        return redirect()->route('showMovies');

    }
}
