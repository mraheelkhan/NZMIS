<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    
    public function vcctservicedetail(){
        return $this->hasMany(VCCTsServiceDetail::class, 'ID', 'ClientID')->withDefault();
    }

    public function positiveResults(){
        return $this->vcctservicedetail()->where('Status', 'Positive');
    }
}
