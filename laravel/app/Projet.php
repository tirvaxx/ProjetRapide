<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Projet extends Validation
{
    protected $table = 'projet';
  //  public $timestamps = false;
    protected $rules = array(
        //'nom' => 'required|alphanum|min:2|max:50', // Pas besoin de faire ça, car le regex donne ce qu'on désire
        'nom' => 'regex:/^[0-9a-zA-Z\s\.àÀâÂîÎïÏéÉèÈêÊëËôÔöÖÙùÛûÜüŸÿç  Ç_\']{2,50}$/',
        'description'  => 'regex:/^[^;]{2,500}$/',
        'date_du' => 'date_format:YYYY-mm-dd|after:yesterday',
        'date_complete' => 'null|date_format:YYYY-mm-dd|after:date_du',
        // .. more rules here ..
    );
}
