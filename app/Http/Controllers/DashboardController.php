<?php

namespace App\Http\Controllers;

use App\Client;
use App\VCCTsService;
use App\VCCTsServiceDetails;
use DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index(){
        return view("dashboard");
    }
    public function clientCount(){

        $count = Client::where('DrugInjectedLast3Months',true)
                    ->where('EverInjectctedDrugs',true)
                    ->orWhere('DrugInjectedLast3Months', false)
                    ->where('DateOfReg', '>=', '1/1/2012')
                    ->where('CountryID', 168)
                    ->count();

        $query = "SELECT format(count(Clients.ID), '#,##0') AS TotalClients FROM Clients  
        INNER JOIN Cities ON Cities.ID = Clients.CityID
        INNER JOIN	States ON States.ID = Cities.StateID
        WHERE Clients.DateOfReg >= '1/1/2012'
        AND [Clients].[EverInjectctedDrugs] = 'true'
        AND ([Clients].[DrugInjectedLast3Months] ='True' OR [Clients].[DrugInjectedLast3Months] ='False')
        AND Clients.CountryID = 168";

        $result = DB::select($query);
        return response()->json($result[0]);
        return $result[0];
    }

    public function clientTested(){
        $query = "SELECT format(count(Distinct ClientID), '#,##0')  AS TotalTestingClients
        FROM VCCTsServiceDetails 
        INNER JOIN [NZMIS].[dbo].[VCCTsServices] ON [VCCTsServiceDetails].[VCCTsServiceID] = [VCCTsServices].[ID] 
        INNER JOIN Clients ON Clients.ID = VCCTsServiceDetails.ClientID
        INNER JOIN Cities ON Cities.ID = Clients.CityID
        INNER JOIN	States ON States.ID = Cities.StateID 

        WHERE [VCCTsServices].Date >= '1/1/2012'
        AND (VCCTsServiceDetails.RiskGroup = 'IDU' OR  VCCTsServiceDetails.RiskGroup='Former IDU')	
        AND ([VCCTsServiceDetails].[Status] !='Testing' AND [VCCTsServiceDetails].[Status] != 'Pending' AND [VCCTsServiceDetails].[Status] != '' AND [VCCTsServiceDetails].[Status] != 'NULL')
        AND	(LEN([VCCTsServiceDetails].[TestName1]) > 0 OR LEN([VCCTsServiceDetails].[TestName2]) > 0 )	
        AND [VCCTsServiceDetails].[ClientID] IS Not Null";

        $result = DB::select($query);
        return response()->json($result[0]);
    }
    public function byCitiesPWID(){
        // $query = "";
        $sp = DB::select('SET NOCOUNT ON;EXEC [dbo].[RptDashboardCascadingPWID]');
        // $result = DB::select($query);
        return $sp;
    }
    public function clientTested2(){
        $query = "";

        $result = DB::select($query);
        return $result;
    }
    public function clientTested3(){
        $query = "";

        $result = DB::select($query);
        return $result;
    }
}
