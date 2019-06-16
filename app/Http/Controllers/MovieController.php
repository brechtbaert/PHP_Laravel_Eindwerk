<?php

namespace App\Http\Controllers;

use App\films;
use App\Regisseur;
use http\Exception\BadQueryStringException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use mysql_xdevapi\Result;


class MovieController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');

    }

    public function showMovies()
    {
        $movies = DB::select('select * from tbl_films');
        return view('MovieHome', ['movies'=>$movies]);

    }

    //show newMovie view

    public function newMovie()
    {

        return view('newMovie');
    }

    //show addDirector to new movie view



    //edit movie

    public function editMovie($movieId)
    {

        $moviesWithDirector = DB::table('tbl_films')
            ->select('regisseur_id','titel','jaar','name','fname')
            ->join('tbl_films_regisseur','tbl_films.film_id',
                '=',
                'tbl_films_regisseur.film_id')
            ->join('tbl_regisseurs','reg_id','=','regisseur_id')
            ->where('tbl_films.film_id','=',$movieId)
            ->get();

        $directors = DB::table('tbl_regisseurs')->get();

        $vars = ['movieId'=> $movieId,'movieData'=> $moviesWithDirector,'directors'=>$directors];
        return view('editMovie',$vars);

    }

    //add new movie

    public function addNewMovie(Request $request)
    {
        $ar_rules = array('titel' => 'required','jaar'=>'required|integer|between:1888,2020');
        $request->validate($ar_rules);

        $title  = $request->input('titel');
        $year   = $request->input('jaar');

        $ar_param = array('titel'=>$title,'jaar'=>$year);

        $result = DB::insert('insert into tbl_films(titel,jaar) VALUES (:titel,:jaar)',$ar_param);

        try
        {
            $result;
        }
        catch (QueryException $exception)
        {
            //message for error
            $message = "Er is en fout opgetreden tijdens het toevoegen van de film";
            $request->session()->flash('message',$message);

            //redirect to moviepage
            return redirect()->route('showMovies');
        }

        $movieData = DB::table('tbl_films')
            ->select('film_id','titel','jaar')
            ->where('titel','=',$title)
            ->where('jaar','=',$year)
            ->get();

        $directors = DB::table('tbl_regisseurs')->get();

        $vars = ['title'=>$title,'year'=>$year,'movieData'=>$movieData,'directors'=>$directors];

        $message = "De film werd succesvol toegevoegd";
        $request->session()->flash('message',$message);

        return view('addDirectorToNewMovie',$vars);

        //return redirect()->route('addDirector',$vars);

    }

    //add director to new movie

    public function addDirectorToNewMovie(Request $request)
    {
        $ar_rules = array('regisseur'=>'required');
        $request->validate($ar_rules);

        $director = $request->input('regisseur');
        $movieId = $request->input('film_id');

        $ar_param = array('film_id'=>$movieId,'reg_id'=>$director);

        $result = DB::insert('insert into tbl_films_regisseur(film_id,reg_id) VALUES (:film_id,:reg_id)',$ar_param);

        try
        {
            $result;
        }
        catch (QueryException $exception)
        {
            //message for error
            $message = "Er is en fout opgetreden tijdens het toevoegen van de regisseur";
            $request->session()->flash('message',$message);

            //redirect to moviepage
            return redirect()->route('showMovies');
        }

        $message = "De regisseur werd succesvol toegevoegd";
        $request->session()->flash('message',$message);

        return redirect()->route('showMovies');



    }

    //update movie

    public function updateMovie(Request $request)
    {
        $ar_rules = array('titel'=>'required','jaar'=>'required|integer|between:1888,2020');
        $request->validate($ar_rules);
        $movieId=$request->input('film_id');
        $title  = $request->input('titel');
        $year   = $request->input('jaar');
        $director_id = $request->input('movieRegisseur_id');

        $ar_param = array('titel'=>$title,'jaar'=>$year);

        //try catch
        try
        {
            //update tbl_films
            DB::table('tbl_films')
                ->where('film_id', '=', $movieId)
                ->update($ar_param);

            //update tbl_films_regisseur
            DB::table('tbl_films_regisseur')
                ->where('film_id','=',$movieId)
                ->update(array('reg_id'=>$director_id));


        }
        catch (QueryException $exception)
        {
            //message for error
            $message = "Er is een fout opgetreden tijdens het updaten";
            $request->session()->flash('message',$message);

            //redirect to moviepage
            return redirect()->route('showMovies');

        }

        //updates completed
        $message = "Updates werden succesvol uitgevoerd";
        $request->session()->flash('message',$message);
        return redirect()->route('showMovies');

    }

    //delete movie
    public function deleteMovie($movieId)
    {
        $ar_params = array('film_id'=>$movieId);
        $result=DB::delete('DELETE FROM tbl_films WHERE film_id=:film_id',$ar_params);

        if ($result)
        {
            $message = "Film werd verwijderd";

        }
        else
        {
            $message = "Er is een fout opgetreden, probeer opnieuw!";

        }
        return redirect(route('showMovies'));

    }
}
