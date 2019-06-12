<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class Acteurs extends Model
{
    protected $table = 'tbl_acteurs';
    protected $primaryKey = 'acteur_id';
    public $timestamps = false;
}
