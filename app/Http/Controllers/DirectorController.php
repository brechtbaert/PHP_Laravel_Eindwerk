<?php

namespace App\Http\Controllers;

use http\Exception\BadQueryStringException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DirectorController extends Controller
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

    //edit Director
    public function editDirector($directorId)
    {
        $directorsData = DB::Table('tbl_regisseurs')
            ->select('regisseur_id','name','fname')
            ->where('regisseur_id','=',$directorId)
            ->get();

        $vars = ['directorId'=>$directorId,'directorsData'=> $directorsData];
        return view('editDirector',$vars);

    }

    //edit Director
    public function updateDirector(Request $request)
    {
        $ar_rules = array('fname'=>'required','name'=>'required');
        $request->validate($ar_rules);
        $directorId = $request->input('directorId');
        $fname      = $request->input('fname');
        $name       = $request->input('name');

        $ar_param = array('name'=>$name,'fname'=>$fname);

        //try catch
        try
        {
            //update tbl_regisseurs
            DB::table('tbl_regisseurs')
                ->where('regisseur_id','=',$directorId)
                ->update($ar_param);

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
}
