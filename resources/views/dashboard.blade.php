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
        <script src="https://code.highcharts.com/highcharts-more.js"></script>
        <script src="https://code.highcharts.com/highcharts-3d.js"></script>
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
                    <div class="col-md-11">
                        <h2>Annual Client</h2>
                        <div id="containerAnnualClient"></div>
                    </div>
                    <div class="col-md-11">
                        <h2>Annual Spouse</h2>
                        <div id="containerAnnualSpouse"></div>
                    </div>
                    <div class="col-md-6">
                        <h2>Hiv Prev Client</h2>
                        <div id="containerClientPrev"></div>
                    </div>
                    <div class="col-md-11">
                        <h2>Hiv Prev Spouse</h2>
                        <div id="containerSpousePrev"></div>
                    </div>
                    <div class="col-md-11">
                        <h2>Individual Clients Contacted Past 30 Days</h2>
                        <div id="containerIndividualClient30"></div>
                    </div>
                    <div class="col-md-11">
                        <h2>Number of PWID Contacted NSEP</h2>
                        <div id="containerPWIDNsepContacted"></div>
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

                Highcharts.getOptions().colors = Highcharts.map(Highcharts.getOptions().colors, function (color) {
                    return {
                        radialGradient: {
                            cx: 0.5,
                            cy: 0.3,
                            r: 0.7
                        },
                        stops: [
                            [0, color],
                            [1, Highcharts.Color(color).brighten(-0.3).get('rgb')] // darken
                        ]
                    };
                });

                $.ajax({
                    url: "http://localhost/NZMIS/api/clientCount",
                    type: 'GET',
                    success: function(res) {
                        $('#ctl00_cphRightContent_lblClients').html(res.TotalClients)
                    }
                });

                $.ajax({
                    url: "http://localhost/NZMIS/api/clientTested",
                    type: 'GET',
                    success: function(res) {
                        $('#ctl00_cphRightContent_lblTestingClients ').html(res.TotalTestingClients)
                    }
                });

                var dataSeries =[];
                var column = {
                    data:[]
                } 
                $.ajax({
                    url: "http://mail.nzmis.com/api/byCitiesPWID",
                    type: 'GET',
                    success: function(res) {
                        
                        res.forEach(data => {
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
                                    text: 'Number of PWID'
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
                }); 

                // Spouse Chart for Admin
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
                                columnSpouse.color = "#0f2a24";
                            } else {
                                columnSpouse.visible = false;
                            }
                            columnSpouse.data.push(parseInt(data.MarriedReactivePWIDsReg))
                            columnSpouse.data.push(parseInt(data.SpousesReg))
                            columnSpouse.data.push(parseInt(data.SpousesDistinctVCCT))
                            columnSpouse.data.push(parseInt(data.SpousesReactive))
                            columnSpouse.data.push(parseInt(data.SpousesRegART))
                            columnSpouse.data.push(parseInt(data.SpousesIniART))

                            dataSeriesSpouse.push(columnSpouse)
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
                                    text: 'Number of PWIDs spouses'
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


                // Client Annual chart for Admin
                var dataSeriesAnnualClient =[];
                var columnAnnualClient = {} 
                $.ajax({
                    url: "http://localhost/NZMIS/api/annualClients",
                    type: 'GET',
                    success: function(res) {
                        
                        res.forEach(data => {
                            columnAnnualClient.name = data.YearClient;
                            columnAnnualClient.y =  parseInt(data.TotalClients);

                            dataSeriesAnnualClient.push(columnAnnualClient)
                            columnAnnualClient = {
                            }
                        });
                        
                        Highcharts.chart('containerAnnualClient', {
                            chart: {
                                type: 'waterfall'
                            },

                            title: {
                                text: 'Highcharts Waterfall'
                            },

                            xAxis: {
                                type: 'category'
                            },

                            yAxis: {
                                title: {
                                    text: 'USD'
                                }
                            },

                            legend: {
                                enabled: false
                            },

                            tooltip: {
                                pointFormat: '<b>${point.y:,.2f}</b> USD'
                            },

                            series: [{
                                // upColor: Highcharts.getOptions().colors[2],
                                // color: Highcharts.getOptions().colors[3],
                                data: dataSeriesAnnualClient,
                                dataLabels: {
                                    enabled: true,
                                    // formatter: function () {
                                    //     return Highcharts.numberFormat(this.y / 1000, 0, ',') + 'k';
                                    // },
                                    style: {
                                        fontWeight: 'bold'
                                    }
                                },
                                pointPadding: 0
                            }]
                        });
                    }
                });

                // Client Spouse chart for Admin
                var dataSeriesAnnualSpouse =[];
                var columnAnnualSpouse = {} 
                $.ajax({
                    url: "http://localhost/NZMIS/api/annualSpouse",
                    type: 'GET',
                    success: function(res) {
                        
                        res.forEach(data => {
                            columnAnnualSpouse.name = data.YearSpouse;
                            columnAnnualSpouse.y =  parseInt(data.TotalSpouses);

                            dataSeriesAnnualSpouse.push(columnAnnualSpouse)
                            columnAnnualSpouse = {
                            }
                        });
                        
                        Highcharts.chart('containerAnnualSpouse', {
                            chart: {
                                type: 'waterfall'
                            },

                            title: {
                                text: 'Highcharts Waterfall'
                            },

                            xAxis: {
                                type: 'category'
                            },

                            yAxis: {
                                title: {
                                    text: 'USD'
                                }
                            },

                            legend: {
                                enabled: false
                            },

                            tooltip: {
                                pointFormat: '<b>${point.y:,.2f}</b> USD'
                            },

                            series: [{
                                upColor: Highcharts.getOptions().colors[2],
                                color: Highcharts.getOptions().colors[3],
                                data: dataSeriesAnnualSpouse,
                                dataLabels: {
                                    enabled: true,
                                    // formatter: function () {
                                    //     return Highcharts.numberFormat(this.y / 1000, 0, ',') + 'k';
                                    // },
                                    style: {
                                        fontWeight: 'bold'
                                    }
                                },
                                pointPadding: 0
                            }]
                        });
                    }
                });
                
                // HIV Spouse prevalance 3D Pie Chart
                var dataSeriesSpousePrev =[];
                var columnSpousePrev = {} 
                $.ajax({
                    url: "http://localhost/NZMIS/api/htcClientSpouseAllCities",
                    type: 'GET',
                    success: function(res) {
                        
                        nonreactiveClients = parseInt(res.HTCClients);
                        reactiveClients = parseInt(res.HTCClietsPositive);

                        nonreactiveSpouse = parseInt(res.HTCSpouse);
                        reactiveSpouse = parseInt(res.HTCSpousePositive);
                        
                        Highcharts.chart('containerClientPrev', {
                            chart: {
                                type: 'pie',
                                options3d: {
                                    enabled: true,
                                    alpha: 45,
                                    beta: 0
                                }
                            },
                            title: {
                                text: 'HIV Prevalance based on HTC'
                            },
                            colors: ['#E9806E', '#45E289'],
                            accessibility: {
                                point: {
                                    valueSuffix: '%'
                                }
                            },
                            tooltip: {
                                pointFormat: '<b>{point.percentage:.1f}%</b> ( {point.name})'
                            },
                            plotOptions: {
                                pie: {
                                    allowPointSelect: true,
                                    cursor: 'pointer',
                                    depth: 35,
                                    dataLabels: {
                                        distance: -40,
                                        enabled: true,
                                        format: '{point.percentage:.1f}%'
                                    },
                                    showInLegend: true
                                }
                            },
                            series: [{
                                type: 'pie',
                                // name: 'Browser share',
                                data: [
                                    ['Reactive Clients', reactiveClients],
                                    ['Non Reactive Clients', nonreactiveClients],
                                ]
                            }],
                            legends : true
                        });

                        Highcharts.chart('containerSpousePrev', {
                            chart: {
                                type: 'pie',
                                options3d: {
                                    enabled: true,
                                    alpha: 45,
                                    beta: 0
                                }
                            },
                            title: {
                                text: 'HIV Prevalance based on HTC'
                            },
                            colors: ['#E9806E', '#45E289'],
                            accessibility: {
                                point: {
                                    valueSuffix: '%'
                                }
                            },
                            tooltip: {
                                pointFormat: '<b>{point.percentage:.1f}%</b> ( {point.name})'
                            },
                            plotOptions: {
                                pie: {
                                    allowPointSelect: true,
                                    cursor: 'pointer',
                                    depth: 35,
                                    dataLabels: {
                                        distance: -40,
                                        enabled: true,
                                        format: '{point.percentage:.1f}%'
                                    },
                                    showInLegend: true
                                }
                            },
                            series: [{
                                type: 'pie',
                                // name: 'Browser share',
                                data: [
                                    ['Reactive Spouse', reactiveSpouse],
                                    ['Non Reactive Spouse', nonreactiveSpouse],
                                ]
                            }],
                            legends : true
                        });
                    }
                });

                
                // Individual Service Client Contact Past 30 Day - Donut Chart
                var dataSeriesSpousePrev =[];
                var columnSpousePrev = {} 
                $.ajax({
                    url: "http://localhost/NZMIS/api/individualServiceContact",
                    type: 'GET',
                    success: function(res) {
                        
                        nonreactiveClients = parseInt(res.HTCClients);
                        reactiveClients = parseInt(res.HTCClietsPositive);

                        nonreactiveSpouse = parseInt(res.HTCSpouse);
                        reactiveSpouse = parseInt(res.HTCSpousePositive);
                        
                        chart = new Highcharts.Chart({
                            chart: {
                                renderTo: 'containerIndividualClient30',
                                type: 'pie'
                            },
                            title: {
                                text: 'Number of Individuals Client Contacted (past 30 days)'
                            },
                            yAxis: {
                                title: {
                                    text: 'Number of Individuals Client Contacted'
                                }
                            },
                            plotOptions: {
                                pie: {
                                    shadow: false,
                                    dataLabels: {
                                    distance: -40,
                                    enabled: true,
                                    format: '{point.percentage:.1f}%'
                                    },
                                }
                            },
                            tooltip: {
                                formatter: function() {
                                    return this.point.name + '<br> <ul><li>Services: '+ this.y +'</li></ul>';
                                }
                            },
                            series: [{
                                name: 'Browsers',
                                data: [["Firefox",60],["MSIE",40],["Chrome",7],["Chrome",7],["Chrome",7],["Chrome",7]],
                                size: '100%',
                                innerSize: '50%',
                                showInLegend:true,
                                dataLabels: {
                                    enabled: true
                                }
                            }]
                        });
                    }
                });

                
                // Distinct PWID contacted NSEP - Speedometer
                var dataSeriesSpousePrev =[];
                var columnSpousePrev = {} 
                $.ajax({
                    url: "http://localhost/NZMIS/api/individualServiceContact",
                    type: 'GET',
                    success: function(res) {
                        
                        nonreactiveClients = parseInt(res.HTCClients);
                        reactiveClients = parseInt(res.HTCClietsPositive);

                        nonreactiveSpouse = parseInt(res.HTCSpouse);
                        reactiveSpouse = parseInt(res.HTCSpousePositive);
                        
                        Highcharts.chart('containerPWIDNsepContacted', {

                            chart: {
                                type: 'gauge',
                                plotBackgroundColor: null,
                                plotBackgroundImage: null,
                                plotBorderWidth: 0,
                                plotShadow: false
                            },

                            title: {
                                text: 'Number of distinct PWID contacted NSEP <br> (P3: Jan-June 2020)'
                            },

                            pane: {
                                startAngle: -150,
                                endAngle: 150,
                                background: [{
                                    backgroundColor: {
                                        linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                                        stops: [
                                            [0, '#FFF'],
                                            [1, '#333']
                                        ]
                                    },
                                    borderWidth: 0,
                                    outerRadius: '109%'
                                }, {
                                    backgroundColor: {
                                        linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                                        stops: [
                                            [0, '#333'],
                                            [1, '#FFF']
                                        ]
                                    },
                                    borderWidth: 1,
                                    outerRadius: '107%'
                                }, {
                                    // default background
                                }, {
                                    backgroundColor: '#DDD',
                                    borderWidth: 0,
                                    outerRadius: '105%',
                                    innerRadius: '103%'
                                }]
                            },

                            // the value axis
                            yAxis: {
                                min: 0,
                                max: 26000,

                            /*  minorTickInterval: 'auto',
                                minorTickWidth: 1,
                                minorTickLength: 40,
                                minorTickPosition: 'inside',
                                minorTickColor: '#666', */

                                tickPixelInterval: 30,
                                tickWidth: 2,
                                tickPosition: 'inside',
                                tickLength: 10,
                                tickColor: '#666',
                                labels: {
                                    step: 2,
                                    rotation: 'auto'
                                },
                                title: {
                                    text: 'km/h'
                                },
                                plotBands: [{
                                    from: 0,
                                    to: 7000,
                                    color: '#DF5353' // green
                                }, {
                                    from: 7001,
                                    to: 17000,
                                    color: '#DDDF0D' // yellow
                                }, {
                                    from: 17001,
                                    to: 26000,
                                    color: '#55BF3B' // red
                                }]
                            },

                            series: [{
                                name: 'Speed',
                                data: [8000],
                                tooltip: {
                                    valueSuffix: ' km/h'
                                }
                            }]
                        })
                    }
                });

                
                
            }
           
           
            

            


        </script>
    </body>
</html>
