<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    //Acceso y serializacion para obtener pasar inf. por json
    protected $appends = ['contact_name','image_perfil'];
    public function getContactNameAttribute(){
        return $this->contact()->first()->name;
    }
    public function getImagePerfilAttribute(){
        return $this->contact()->first()->image_perfil;
    }
    public function contact(){
        return $this->belongsTo('App\User');
    }
}
