<?php

namespace App\Http\Controllers;

use http\Exception\BadQueryStringException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Result;

class DirectorController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showDirectors()
    {
        $directors = DB::select('select * from tbl_regisseurs');
        return view('DirectorsHome', ['directors'=>$directors]);

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

    //update Director
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
            return redirect()->route('showDirectors');
        }

        //updates completed
        $message = "Updates werden succesvol uitgevoerd";
        $request->session()->flash('message',$message);
        return redirect()->route('showDirectors');

    }

    //delete director
    public function deleteDirector($directorId)
    {
        $ar_params = array('regisseur_id'=>$directorId);
        $result=DB::delete('DELETE FROM tbl_regisseurs WHERE regisseur_id=:regisseur_id',$ar_params);

        if ($result)
        {
            $message = "Regisseur werd verwijderd";
        }
        else
        {
            $message = "Er is een fout opgetreden tijdens het verwijderen";
        }
        return redirect(route('showDirectors'));
    }

    //show newDirector view
    public function newDirector()
    {
        return view('newDirector');

    }

    //add new director
    public function addNewDirector(Request $request)
    {
        $ar_rules = array('fname'=>'required','name'=>'required');
        $request->validate($ar_rules);

        $fname  = $request->input('fname');
        $name   = $request->input('name');

        $ar_param = array('fname'=>$fname,'name'=>$name);

        $result = DB::insert('insert into tbl_regisseurs(fname,name)VALUES(:fname,:name)',$ar_param);

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
            return redirect()->route('showDirectors');
        }

        $message = "De regisseur werd succesvol toegevoegd";
        $request->session()->flash('message',$message);
        return redirect()->route('showDirectors');
    }
}
