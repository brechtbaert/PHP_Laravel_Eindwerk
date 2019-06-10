<?php
/**
 * Created by PhpStorm.
 * User: baert
 * Date: 10/06/2019
 * Time: 13:35
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Films extends Model
{
    protected $table = 'tbl_films';
    protected $primaryKey = 'film_id';
    public $timestamps = false;
}
