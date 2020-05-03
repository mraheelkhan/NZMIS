<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VCCTsServiceDetail extends Model
{
    protected $table = "VCCTsServiceDetails";
    public function client(){
        return $this->belongsTo(Client::class, 'ClientID', 'ID')->withDefault();
    }

    
}
