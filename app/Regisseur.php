<?php
/**
 * Created by PhpStorm.
 * User: baert
 * Date: 10/06/2019
 * Time: 13:35
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Regisseur extends Model
{
    protected $table = 'tbl_regisseurs';
    protected $primaryKey = 'regisseur_id';
    public $timestamps = false;

}
