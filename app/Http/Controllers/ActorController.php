<?php

namespace App\Http\Controllers;

use http\Exception;
use http\Exception\BadQueryStringException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Result;

class ActorController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');

    }

    public function showActors()
    {
        $actors = DB::select('select * from tbl_acteurs');
        return view('ActorsHome',['actors'=>$actors]);

    }

    //edit actor
    public function editActor($actorId)
    {
        $actorsData = DB::table('tbl_acteurs')
            ->select('acteur_id','name','fname')
            ->where('acteur_id','=',$actorId)
            ->get();

        $vars = ['actorId'=>$actorId,'actorsData'=>$actorsData];
        return view('editActor',$vars);

    }

    //update actor

    public  function  updateActor(request $request)
    {
        $ar_rules = array('fname'=>'required','name'=>'required');
        $request->validate($ar_rules);
        $actorId = $request->input('actorId');
        $fname      = $request->input('fname');
        $name       = $request->input('name');

        $ar_param = array('name'=>$name,'fname'=>$fname);

        //try catch
        try
        {
            //update tbl_acteurs
            DB::table('tbl_acteurs')
                ->where('acteur_id','=',$actorId)
                ->update($ar_param);

        }
        catch (QueryException $exception)
        {
            //message for error
            $message = "Er is een fout opgetreden tijdens het updaten";
            $request->session()->flash('message',$message);

            //redirect to moviepage
            return redirect()->route('showActors');
        }

        //updates completed
        $message = "Updates werden succesvol uitgevoerd";
        $request->session()->flash('message',$message);
        return redirect()->route('showActors');
    }

    //delete actor
    public function deleteActor($actorId)
    {
        $ar_params = array('acteur_id'=>$actorId);
        $result=DB::delete('DELETE FROM tbl_acteurs WHERE acteur_id=:acteur_id',$ar_params);

        if ($result)
        {
            $message = "Regisseur werd verwijderd";
        }
        else
        {
            $message = "Er is een fout opgetreden tijdens het verwijderen";
        }
        return redirect(route('showActors'));
    }

    //show newActor view
    public function newActor()
    {
        return view('newActor');

    }

    //add new actor
    public function addNewActor(Request $request)
    {
        $ar_rules = array('fname'=>'required','name'=>'required');
        $request->validate($ar_rules);

        $fname  = $request->input('fname');
        $name   = $request->input('name');

        $ar_param = array('fname'=>$fname,'name'=>$name);

        $result = DB::insert('insert into tbl_acteurs(fname,name)VALUES(:fname,:name)',$ar_param);

        try
        {
            $result;
        }
        catch (QueryException $exception)
        {
            //message for error
            $message = "Er is en fout opgetreden tijdens het toevoegen van de acteur";
            $request->session()->flash('message',$message);

            //redirect to moviepage
            return redirect()->route('showActors');
        }

        $message = "De acteur werd succesvol toegevoegd";
        $request->session()->flash('message',$message);
        return redirect()->route('showActors');
    }
}
