<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        {{-- <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet"> --}}
        <link href="http://localhost/NZTPortal/public/assetsable/css/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
        <script src="{{ asset('/public/bower_components/jquery/dist/jquery.min.js') }}"></script>
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .dashboard_graph {
            background: #fff;
            padding: 7px 10px;
            overflow: hidden;
            box-shadow: 2px 1px 5px #444;
            -webkit-box-shadow: 2px 1px 5px #444;
            }.tile_count {
                margin-bottom: 20px;
                margin-top: 20px;
            }.countBox {
                -webkit-justify-content: space-around;
                overflow: hidden;
                width: 120px;
                height: 80px;
                position: relative;
                padding: 10px;
                margin-left: 6.5px;
                margin-right: 6px;
                color: white;
                text-align: center;
                line-height: 25px;
                -webkit-box-shadow: 1px 1px 2px #3B3A3A, 1px 1px 2px rgba(158,111,86,0.3) inset;
                -moz-box-shadow: 1px 1px 2px #3B3A3A, 1px 1px 2px rgba(158,111,86,0.3) inset;
                box-shadow: 1px 1px 2px #3B3A3A, 1px 1px 2px rgba(158,111,86,0.3) inset;
                -moz-border-radius: 4px;
                -webkit-border-radius: 4px;
                border-radius: 4px 4px 4px 4px;
                background: rgba(38,151,149,1);
                background: -moz-radial-gradient(center, ellipse cover, rgba(38,151,149,1) 0%, rgba(38,151,149,0.99) 0%, rgba(0,82,80,0.99) 100%);
                background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%, rgba(38,151,149,1)), color-stop(0%, rgba(38,151,149,0.99)), color-stop(100%, rgba(0,82,80,0.99)));
                background: -webkit-radial-gradient(center, ellipse cover, rgba(38,151,149,1) 0%, rgba(38,151,149,0.99) 0%, rgba(0,82,80,0.99) 100%);
                background: -o-radial-gradient(center, ellipse cover, rgba(38,151,149,1) 0%, rgba(38,151,149,0.99) 0%, rgba(0,82,80,0.99) 100%);
                background: -ms-radial-gradient(center, ellipse cover, rgba(38,151,149,1) 0%, rgba(38,151,149,0.99) 0%, rgba(0,82,80,0.99) 100%);
                background: radial-gradient(ellipse at center, rgba(38,151,149,1) 0%, rgba(38,151,149,0.99) 0%, rgba(0,82,80,0.99) 100%);
                filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#269795', endColorstr='#005250', GradientType=1 );
            }
        </style>


        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script>
        <script src="https://code.highcharts.com/modules/export-data.js"></script>
        <script src="https://code.highcharts.com/modules/accessibility.js"></script>

    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>
                
                <div class="row">
                    <div class="col-md-11">
                        <h2>PWID</h2>
                        <div id="container"></div>
                    </div>
                    <div class="col-md-11">
                        <h2>Spouse</h2>
                        <div id="containerSpouse"></div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <div class="dashboard_graph">
                            <div class="row x_title">
                                <div class="col-md-12">
                                    <center> <h3 style="font-size:20px; color: #333333;">People Who Inject Drugs (PWID)</h3></center>
                                </div>
                            </div>
                            <div class="row tile_count">
                               <div class="col-md-3">
                                    <div class="countBox">
                                        <label><i class="fa fa-user"></i> Registered</label><br>
                                        <span id="ctl00_cphRightContent_lblClients">Loading</span>
            
                                    </div>
                                </div>
                                  <div class="col-md-3">
                                    <div class="countBox">
                                        <label class="count_top"><i class="fa fa-history"></i> Tested</label><br>
                                        <span id="ctl00_cphRightContent_lblTestingClients">Loading</span>
            
                                    </div>
                                </div>
                                  <div class="col-md-3">
                                    <div class="countBox">
                                        <label class="count_top"><i class="fa fa-user"></i> Reactive</label><br>
                                        <span id="ctl00_cphRightContent_lblReactive">Loading</span>
            
                                    </div>
                                </div>
                               <div class="col-md-3">
                                    <div class="countBox">
                                        <label class="count_top"><i class="fa fa-medkit"></i> CD4 &lt; 500</label><br>
                                        <span id="ctl00_cphRightContent_lblClientCD4">Loading</span>
            
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                
            </div>
        </div>

        <script>
            window.onload = function(e){ 
                $.ajax({
                    url: "http://localhost/NZMIS/api/clientCount",
                    type: 'GET',
                    success: function(res) {
                        console.log(res.TotalClients)
                        $('#ctl00_cphRightContent_lblClients').html(res.TotalClients)
                    }
                });

                $.ajax({
                    url: "http://localhost/NZMIS/api/clientTested",
                    type: 'GET',
                    success: function(res) {
                        console.log(res.TotalTestingClients)
                        $('#ctl00_cphRightContent_lblTestingClients ').html(res.TotalTestingClients)
                    }
                });

                /* var dataSeries =[];
                var column = {
                    data:[]
                } 
                $.ajax({
                    url: "http://mail.nzmis.com/api/byCitiesPWID",
                    type: 'GET',
                    success: function(res) {
                        
                        res.forEach(data => {
                            // console.log("response " + JSON.stringify(data))
                            column.name = data.CityShortName;
                            if(column.name == "All"){
                                column.visible = true;
                                column.color = "#287161";
                            } else {
                                column.visible = false;
                            }
                            column.data.push(parseInt(data.PWIDsReg))
                            column.data.push(parseInt(data.DistinctVCCT))
                            column.data.push(parseInt(data.Reactive))
                            column.data.push(parseInt(data.TotalCD4500))
                            column.data.push(parseInt(data.TotalCD4))
                            column.data.push(parseInt(data.ARTInitiations))
                            column.data.push(parseInt(data.RegART))
                            column.data.push(parseInt(data.RefertoAAU))
                            column.data.push(parseInt(data.CompletedAAU))
                            
                            // console.log("response " + JSON.stringify(column))
                            dataSeries.push(column)
                            console.log(dataSeries)
                            column = {
                                data:[]
                            }
                        });
                        

                        Highcharts.chart('container', {
                            chart: {
                                type: 'column'
                            },
                            title: {
                                text: 'Cascade of services accessed by PWID (2012 - to date)'
                            },
                            xAxis: {
                                categories: [
                                    'PWID Registration',
                                    'PWID Tested',
                                    'Reactive',
                                    'Cd4 tested',
                                    'cd4 below 500',
                                    'ART Registered',
                                    'ARV Issued',
                                    'AUU Referral',
                                    'Completed AAU',
                                ],
                                crosshair: true
                            },
                            yAxis: {
                                stackLabels: {
                                    enabled: true
                                },
                                min: 0,
                                title: {
                                    text: 'text'
                                }
                            },
                            tooltip: {
                                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                                    '<td style="padding:0"><b>{point.y}</b></td></tr>',
                                footerFormat: '</table>',
                                shared: true,
                                useHTML: true
                            },
                            plotOptions: {
                                column: {
                                    pointPadding: 0.2,
                                    borderWidth: 0,
                                },
                                series: {
                                    dataLabels: {
                                        enabled: true,
                                        // formatter: function() {
                                        //     return this.y + '<br>' + this.x
                                        // }
                                    }
                                }
                            },
                            series: dataSeries
                        });
                    }
                }); */



                var dataSeriesSpouse =[];
                var columnSpouse = {
                    data:[]
                } 
                $.ajax({
                    url: "http://localhost/NZMIS/api/byCitiesSpouse",
                    type: 'GET',
                    success: function(res) {
                        
                        res.forEach(data => {
                            // console.log("response " + JSON.stringify(data))
                            columnSpouse.name = data.CityShortName;
                            if(columnSpouse.name == "All"){
                                columnSpouse.visible = true;
                                columnSpouse.color = "#287161";
                            } else {
                                columnSpouse.visible = false;
                            }
                            columnSpouse.data.push(parseInt(data.MarriedReactivePWIDsReg))
                            columnSpouse.data.push(parseInt(data.SpousesReg))
                            columnSpouse.data.push(parseInt(data.SpousesDistinctVCCT))
                            columnSpouse.data.push(parseInt(data.SpousesReactive))
                            columnSpouse.data.push(parseInt(data.SpousesRegART))
                            columnSpouse.data.push(parseInt(data.SpousesIniART))
                            
                            console.log("response " + JSON.stringify(columnSpouse))
                            dataSeriesSpouse.push(columnSpouse)
                            console.log(dataSeriesSpouse)
                            columnSpouse = {
                                data:[]
                            }
                        });
                        

                        Highcharts.chart('containerSpouse', {
                            chart: {
                                type: 'column'
                            },
                            title: {
                                text: 'Cascade of services accessed by Spouse (2012 - to date)'
                            },
                            xAxis: {
                                categories: [
                                    'Married PWID',
                                    'Spouses Registered',
                                    'Spouses Tested',
                                    'Cd4 Spouses Reactive',
                                    'ART registered',
                                    'ARV Issued',
                                ],
                                crosshair: true
                            },
                            yAxis: {
                                stackLabels: {
                                    enabled: true
                                },
                                min: 0,
                                title: {
                                    text: 'text'
                                }
                            },
                            tooltip: {
                                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                                    '<td style="padding:0"><b>{point.y}</b></td></tr>',
                                footerFormat: '</table>',
                                shared: true,
                                useHTML: true
                            },
                            plotOptions: {
                                column: {
                                    pointPadding: 0.2,
                                    borderWidth: 0,
                                },
                                series: {
                                    dataLabels: {
                                        enabled: true,
                                        /* formatter: function() {
                                            return this.y + '<br>' + this.x
                                        } */
                                    }
                                }
                            },
                            series: dataSeriesSpouse
                        });
                    }
                });
                
            }
           

            

            


        </script>
    </body>
</html>
