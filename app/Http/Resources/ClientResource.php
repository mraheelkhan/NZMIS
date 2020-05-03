<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\VCCTsServiceDetail;
class ClientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        //$vcct = VCCTsServiceDetail::whereIn('ClientID', $this->Id)->where('Status', 'Positive')->get();
        return [
            // 'cityId' => $this->vcctservicedetail->client->CityID,
            'status' => $this->Status,
            'regNo' => $this->client->RegNo
        ];
    }
}
