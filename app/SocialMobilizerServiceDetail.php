<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialMobilizerServiceDetail extends Model
{
    protected $table="SocialMobilizerServiceDetails";

    public function servicesheet(){
        return $this->belongsTo(SocialMobilizerService::class, 'SocialMobilizerServiceID', "ID")->withDefault();
    }
}
