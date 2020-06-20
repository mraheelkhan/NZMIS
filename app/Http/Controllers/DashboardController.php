<?php

namespace App\Http\Controllers;

use App\Client;
use App\VCCTsService;
use App\VCCTsServiceDetails;
use App\UserCity;
use App\City;
use App\UserProfile;
use App\Organization;
use DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index(){
        return view("dashboard");
    }
    public function copc(){
        return view("dashboardCopc");
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
    

    public function byCitiesSpouse(){
        $sp = DB::select('SET NOCOUNT ON;EXEC [dbo].[RptDashboardCascadingSpouses]');
        return $sp;
    }
    public function annualClients(){
        $query = "SELECT Clients.* FROM (SELECT DATENAME(YEAR,(Clients.DateofReg)) AS YearClient, Count (ID) AS TotalClients From Clients WHERE Clients.CountryID = 168 GROUP BY  DATENAME(YEAR,(Clients.DateofReg)) )Clients order by YearClient
        ";

        $results = DB::select($query);
        return $results;
    }
    public function annualSpouse(){
        $query = "SELECT   Spouses.* FROM (SELECT  DATENAME(YEAR,(Spouses.DateofReg)) AS YearSpouse, COUNT(DISTINCT [Spouses].ID) AS TotalSpouses From Spouses INNER JOIN [NZMIS].[dbo].[Clients] ON [Clients].[ID] = [Spouses].[ClientID]	INNER JOIN Cities ON Cities.ID = Clients.CityID	INNER JOIN	States ON States.ID = Cities.StateID	INNER JOIN	[NZMIS].[dbo].[VCCTsServiceDetails] ON [VCCTsServiceDetails].[ClientID] =[Clients].[ID]  WHERE	[Clients].[MaritalStatus]= 'Married' AND [VCCTsServiceDetails].[Status] = 'positive' AND Clients.CountryID=168	
        GROUP BY  DATENAME(YEAR,(Spouses.DateofReg)))Spouses ORDER By YearSpouse
        ";

        $results = DB::select($query);
        return $results;
    }
    public function HtcClientSpousePrevalence(){
        // $query = "";
        $sp = DB::select('SET NOCOUNT ON;EXEC [dbo].[RptDashboardHTCClientSpouse]');
        // $result = DB::select($query);
        $responseArray = array();
        foreach($sp as $record){
            if($record->City == 'AllCities'){
                $responseArray = $record;
            }
        }
        return response()->json($responseArray);
    }
    public function IndividualServiceContact(){
        // $query = "";
        $sp = DB::select('SET NOCOUNT ON;EXEC [dbo].[RptDashboardServicesContacts]');
        // $result = DB::select($query);
        return response()->json($sp[0]);
    }

    public function targetNSEPQuarterP3_2020(){
        
        $sp = DB::select('select * from TargetNSEPQuaterP3_2020');
        // $result = DB::select($query);
        return response()->json($sp[0]);
    }
    public function targetHTCQuarterP3_2020(){
        
        $sp = DB::select('select * from TargetHTCQuaterP3_2020');
        // $result = DB::select($query);
        return response()->json($sp[0]);
    }
    public function targetContactPerSyringesP3_2020(){
        
        $sp = DB::select('select * from TargetContactPerSyringesP3_2020');
        // $result = DB::select($query);
        return response()->json($sp[0]);
    }




    /*
    ************************************
    ******** COPC Site Queries *********
    ************************************
    */


    public function RptDashboardCascadingPWIDCOPC($userid){
        
        $userCity = UserCity::where('UserID', $userid)->first();
        $cityId = (int)$userCity->CityID;
        $city = City::findOrFail($cityId);
        $cityName = $city->CityName;

        $userOrg = UserProfile::where("aspnet_User_UserId", $userid)->first();
        $orgId = $userOrg->OrganizationID;
        $organization = Organization::where("ID", $orgId)->first();
        $orgName = $organization->Name;
        $sp = DB::select('SET NOCOUNT ON; EXEC RptDashboardCascadingPWIDCOPC ?, ?, ?', array($orgName,$cityName, null));
        return response()->json($sp[0]);
    }

    public function RptDashboardCascadingSpousesCOPC($userid){
        
        $userCity = UserCity::where('UserID', $userid)->first();
        $cityId = (int)$userCity->CityID;
        $city = City::findOrFail($cityId);
        $cityName = $city->CityName;

        $userOrg = UserProfile::where("aspnet_User_UserId", $userid)->first();
        $orgId = $userOrg->OrganizationID;
        $organization = Organization::where("ID", $orgId)->first();
        $orgName = $organization->Name;
        $sp = DB::select('SET NOCOUNT ON; EXEC RptDashboardCascadingSpousesCOPC ?, ?, ?', array($orgName,$cityName, null));
        return response()->json($sp[0]);
    }
    public function RptDashboardHTCClientSpouseCity($userid){
        
        $userCity = UserCity::where('UserID', $userid)->first();
        $cityId = (int)$userCity->CityID;
        $city = City::findOrFail($cityId);
        $cityName = $city->CityName;

        $userOrg = UserProfile::where("aspnet_User_UserId", $userid)->first();
        $orgId = $userOrg->OrganizationID;
        $organization = Organization::where("ID", $orgId)->first();
        $orgName = $organization->Name;
        $sp = DB::select('SET NOCOUNT ON; EXEC RptDashboardHTCClientSpouseCity ?', array($cityName));
        return response()->json($sp[0]);
    }

}
