<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sprint extends Validation
{
    protected $table = 'sprint';

    protected $rules = array(
        'numero' => 'required|digits_between:1,3',
        // .. more rules here ..
    );
}
