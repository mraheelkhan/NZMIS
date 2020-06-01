<?php

namespace App\Http\Controllers\api;

use App\Client;
use App\City;
use App\VCCTsService;
use App\VCCTsServiceDetail;
use App\SocialMobilizerService;
use App\SocialMobilizerServiceDetail;
use App\Http\Resources\ClientResource;
use App\Http\Resources\ClientResourceCollection;
use Illuminate\Http\Request;
use DB;
use DateTime;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    public function getHtcDueSatus($regNo){
        
        $client = Client::where('RegNo', $regNo)->first();
        
        if( empty($client) || is_null($client) ){
            $data = array(
                "htcDueStatus" => "NOT FOUND",
            );
            return response()->json($data);
        }
        $vcct = VCCTsServiceDetail::where('ClientID', $client->ID)->latest('ID')->first();
        if(empty($vcct) || is_null($client)){
            $data = array(
                "htcDueStatus" => "NOT FOUND",
            );
            return response()->json($data);
        }
        $service = VCCTsService::findOrFail($vcct->VCCTsServiceID);
        
        $serviceDate = new DateTime($service->Date);
        $todayDate = new DateTime(date('y-m-d'));
        $interval = $serviceDate->diff($todayDate);
        $days = $interval->format('%a');

        $compareDays = 180;
        $isPositive = false;
        $vccts = VCCTsServiceDetail::where('ClientID', $client->ID)->get();
        foreach($vccts as $vcct):
            if(strtolower($vcct->Status) == 'positive'){
                $isPositive = true;
                break;
            }
        endforeach;

        // dd($isPositive);
        // dd($vccts);
        if( count($vccts) < 2 ){
            // if count is 1 
            $compareDays = 90;
        } else {

        }
        
        if($isPositive == true){

            $data = array(
                "htcDueStatus" => "NOT DUE",
                "totaldays" => $days, 
                "status" => ($isPositive ? "positive" : 'Negative')
            );
            
        }
        else if($days > $compareDays && $isPositive != true){

            $data = array(
                "htcDueStatus" => "DUE",
                "totaldays" => $days, 
                "status" => ($isPositive ? "positive" : 'Negative'),
                "compareDays" => $compareDays, 
            );
            
        } else if( $isPositive != true ) {
            $data = array(
                "htcDueStatus" => "NOT DUE",
                "totaldays" => $days,
                "status" => ($isPositive ? "positive" : 'Negative')
            );
        } else if($days > $compareDays && $isPositive != true){
            $data = array(
                "htcDueStatus" => "DUE",
                "totaldays" => $days,
                "status" => ($isPositive ? "positive" : 'Negative')
            );
        } else if($days < $compareDays && $isPositive != true){
            $data = array(
                "htcDueStatus" => "NOT DUE",
                "totaldays" => $days,
                "status" => ($isPositive ? "positive" : 'Negative')
            );
        } else {
            $data = array(
                "htcDueStatus" => "NOT DUE",
                "totaldays" => $days,
                "status" => ($isPositive ? "positive" : 'Negative')
            );
        }

        return response()->json($data);

        /*$query = DB::select("SELECT Clients.Regno,Status,MAX(Date) AS LatestDate
            FROM VCCTsServiceDetails
            INNER JOIN VCCTsServices ON VCCTsServices.ID = VCCTsServiceDetails.VCCTsServiceID
            INNER JOIN Clients ON Clients.ID = VCCTsServiceDetails.ClientID
            
            WHERE Clients.RegNo = '" . $regNo ."'
            GROUP BY Clients.Regno,Status,Date
            ORDER BY DATE DESC");

            dd($query);
        dd($query->latest('LatestDate')->first()); */

    }


    // public function getPositiveClientsList($id, $pageNo, $records){
    public function getPositiveClientsList(Request $request){

        $id = $request->DistrictId;
        $pageNo = $request->PageNumber;
        $records = $request->PageSize;
        
        $cityExists = City::where('ShortName', $id)->exists();
        $city = City::where('ShortName', $id)->first();
        
        if(!$cityExists){
            $results[] = ['success' => 0, "response" => "none"];
            return response()->json($results);
        }
        $cityId = $city->ID;
        $pageNumber = $pageNo;
        $perPage= $records;
        $newPageNumber = ($pageNumber - 1)* $perPage;
        
        // dd($city);
        // $clients = Client::where('CityId', $cityId)->pluck('ID');
        
        /* $clients = Client::where('DistrictId', $id)->get(); */
        $query = "SELECT VC.ClientID, VC.Status, Clients.RegNo FROM VCCTsServiceDetails as VC 
                JOIN Clients ON Clients.Id = VC.ClientID 
                JOIN Cities as CT on CT.Id = Clients.CityID 
                WHERE CT.Id = '" .$cityId. "' AND
                VC.Status = 'Positive'
                ORDER BY VC.ClientID ASC 
                OFFSET ".$newPageNumber." ROWS 
                FETCH NEXT ".$perPage ." ROWS ONLY
                ";
        // return $query;
        $results = DB::select($query);
        return response()->json($results);
        // dd($results);
        // $clients = Client::where('CityId', $cityId)->with('vcctservicedetail')->get();

        // dd($clients);
        // return $clients;
        // $vcct = VCCTsServiceDetail::whereIn('ClientID', $clients)->where('status', 'Positive')->with('client')->get();
        // $vcct = VCCTsServiceDetail::whereIn('ClientID', $clients)->with('positiveClients')->get();
        
        // return $vcct;
        return new ClientResourceCollection($vcct);
    }


    public function getAdherenceStatus($regNo){
        $client = Client::where('RegNo', $regNo)->first();
        
        if( empty($client) || is_null($client) ){
            $data = array(
                "adherenceStatus" => "NOT FOUND",
            );
            return response()->json($data);
        }
        $smz = SocialMobilizerServiceDetail::where('ClientID', $client->ID)->latest('ID')->first();
        // dd($smz);
        if(empty($smz->Adherent) || is_null($smz->Adherent) || strtolower($smz->Adherent) == "no"){
            $data = array(
                "regNo" => $client->RegNo,
                "adherenceStatus" => "NON ADHERENT",
            );
        } else if(strtolower($smz->Adherent) == "yes"){
             $data = array(
                 "regNo" => $client->RegNo,
                "adherenceStatus" => "ADHERENT",
            );
        }
        return response()->json($data);
       // $service = SocialMobilizerService::findOrFail($smz->SocialMobilizerServiceID);
        //dd($service);
    }

    public function getArvRefillDate($regNo){
        // left here for the refill, do that same as above.
        $client = Client::where('RegNo', $regNo)->first();
        
        if( empty($client) || is_null($client) ){
            $data = array(
                "arvRefill" => "NOT FOUND",
            );
            return response()->json($data);
        }
        $smz = SocialMobilizerServiceDetail::where('ClientID', $client->ID)->where('ARVsRefill', '<>', '')->with('servicesheet')->latest('ID')->first();
        
        // calculating number of doses
        // $serviceDate = new DateTime(date('d-m-Y',strtotime($smz->servicesheet->Date)));
        // $todayDate = new DateTime(date('y-m-d'));
        // $interval = $serviceDate->diff($todayDate);
        // $days = $interval->format('%a');
        
        if(empty($smz->ARVsRefill) || is_null($smz->ARVsRefill) || $smz->ARVsRefill == ""){
            $data = array(
                "arvRefill" => "NOT FOUND",
            );
        } else {
            $data = array(
                "regNo" => $client->RegNo,
                "arvRefill" => $smz->ARVsRefill,
                "arvRefillDate" => date('d-m-Y',strtotime($smz->servicesheet->Date))
            );
        }
        return response()->json($data);
    }

    public function getPositiveClientsCount($code){

        /* $result = VCCTsServiceDetail::where('Status', 'Positive')
                ->where('Cities.ShortName', $code)
                ->join("Clients", "Clients.Id", "VCCTsServiceDetails.ClientID")
                ->join("Cities", "Cities.Id", "Clients.CityID")
                ->count();

        return response()->json(
            [
            'result' => $result
        ]
        ); */
        $query = "SELECT count(distinct(Clients.RegNo)) as positiveClientsCount FROM VCCTsServiceDetails as VC 
        JOIN Clients ON Clients.Id = VC.ClientID 
        JOIN Cities as CT on CT.Id = Clients.CityID 
        WHERE CT.ShortName = '".$code."' AND
        VC.Status = 'Positive'";

        $results = DB::select($query);

        foreach($results as $result){}
        return response()->json($result);
    }

}


