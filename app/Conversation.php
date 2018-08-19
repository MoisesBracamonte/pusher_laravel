<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    //Acceso y serializacion para obtener pasar inf. por json
    protected $appends = ['contact_name'];
    public function getContactNameAttribute(){
        return $this->contact()->first()->name;
    }
    public function contact(){
        return $this->belongsTo('App\User');
    }
}
