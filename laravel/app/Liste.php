<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Liste extends Validation
{
    protected $table = 'liste';

    protected $rules = array(
        //'nom' => 'required|alphanum|min:2|max:50', // Pas besoin de faire ça, car le regex donne ce qu'on désire
        'nom' => 'regex:/^[0-9a-zA-Z\s\.àÀâÂîÎïÏéÉèÈêÊëËôÔöÖÙùÛûÜüŸÿç  Ç_\']{2,50}$/',
        'description'  => 'regex:/^[^;]{2,200}$/',
        // .. more rules here ..
    );
}
