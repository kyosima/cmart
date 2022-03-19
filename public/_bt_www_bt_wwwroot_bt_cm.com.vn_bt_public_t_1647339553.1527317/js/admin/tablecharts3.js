           var chart3;

            var chartData3 = [
                {
                    "country": "USA",
                    "visits": 3025,
                    "color": "#FF0F00"
                },
                {
                    "country": "China",
                    "visits": 1882,
                    "color": "#FF6600"
                },
                {
                    "country": "Japan",
                    "visits": 1809,
                    "color": "#FF9E01"
                },
                {
                    "country": "Germany",
                    "visits": 1322,
                    "color": "#FCD202"
                },
                {
                    "country": "UK",
                    "visits": 1122,
                    "color": "#F8FF01"
                },
                {
                    "country": "France",
                    "visits": 1114,
                    "color": "#B0DE09"
                },
                {
                    "country": "India",
                    "visits": 984,
                    "color": "#04D215"
                },
                {
                    "country": "Spain",
                    "visits": 711,
                    "color": "#0D8ECF"
                },
                {
                    "country": "Netherlands",
                    "visits": 665,
                    "color": "#0D52D1"
                },
                {
                    "country": "Russia",
                    "visits": 580,
                    "color": "#2A0CD0"
                },
                {
                    "country": "South Korea",
                    "visits": 443,
                    "color": "#8A0CCF"
                },
                {
                    "country": "Canada",
                    "visits": 441,
                    "color": "#CD0D74"
                }
            ];


            AmCharts.ready(function () {
                // SERIAL CHART
                chart3 = new AmCharts.AmSerialChart();
                chart3.dataProvider = chartData3;
                chart3.categoryField = "country";
                chart3.startDuration = 1;

                // AXES
                // category
                var categoryAxis = chart3.categoryAxis;
                categoryAxis.labelRotation = 45; // this line makes category values to be rotated
                categoryAxis.gridAlpha = 0;
                categoryAxis.fillAlpha = 1;
                categoryAxis.fillColor = "#FAFAFA";
                categoryAxis.gridPosition = "start";

                // value
                var valueAxis = new AmCharts.ValueAxis();
                valueAxis.dashLength = 5;
                valueAxis.title = "DOANH SỐ NĂM NGOÁI/NĂM NAY";
                valueAxis.axisAlpha = 0;
                chart3.addValueAxis(valueAxis);

                // GRAPH
                var graph = new AmCharts.AmGraph();
                graph.valueField = "visits";
                graph.colorField = "color";
                graph.balloonText = "<b>[[category]]: [[value]]</b>";
                graph.type = "column";
                graph.lineAlpha = 0;
                graph.fillAlphas = 1;
                chart3.addGraph(graph);

                // CURSOR
                var chartCursor = new AmCharts.ChartCursor();
                chartCursor.cursorAlpha = 0;
                chartCursor.zoomable = false;
                chartCursor.categoryBalloonEnabled = false;
                chart3.addChartCursor(chartCursor);

                chart3.creditsPosition = "top-right";

                // WRITE
                chart3.write("chartdiv3");
            });



           var chart4;

            var chartData4 = [
                {
                    "country": "USA",
                    "visits": 3025,
                    "color": "#FF0F00"
                },
                {
                    "country": "China",
                    "visits": 1882,
                    "color": "#FF6600"
                },
                {
                    "country": "Japan",
                    "visits": 1809,
                    "color": "#FF9E01"
                },
                {
                    "country": "Germany",
                    "visits": 1322,
                    "color": "#FCD202"
                },
                {
                    "country": "UK",
                    "visits": 1122,
                    "color": "#F8FF01"
                },
                {
                    "country": "France",
                    "visits": 1114,
                    "color": "#B0DE09"
                },
                {
                    "country": "India",
                    "visits": 984,
                    "color": "#04D215"
                },
                {
                    "country": "Spain",
                    "visits": 711,
                    "color": "#0D8ECF"
                },
                {
                    "country": "Netherlands",
                    "visits": 665,
                    "color": "#0D52D1"
                },
                {
                    "country": "Russia",
                    "visits": 580,
                    "color": "#2A0CD0"
                },
                {
                    "country": "South Korea",
                    "visits": 443,
                    "color": "#8A0CCF"
                },
                {
                    "country": "Canada",
                    "visits": 441,
                    "color": "#CD0D74"
                }
            ];


            AmCharts.ready(function () {
                // SERIAL CHART
                chart4 = new AmCharts.AmSerialChart();
                chart4.dataProvider = chartData4;
                chart4.categoryField = "country";
                chart4.startDuration = 1;

                // AXES
                // category
                var categoryAxis = chart4.categoryAxis;
                categoryAxis.labelRotation = 45; // this line makes category values to be rotated
                categoryAxis.gridAlpha = 0;
                categoryAxis.fillAlpha = 1;
                categoryAxis.fillColor = "#FAFAFA";
                categoryAxis.gridPosition = "start";

                // value
                var valueAxis = new AmCharts.ValueAxis();
                valueAxis.dashLength = 5;
                valueAxis.title = "SỐ LƯỢNG NĂM NGOÁI/NĂM NAY";
                valueAxis.axisAlpha = 0;
                chart4.addValueAxis(valueAxis);

                // GRAPH
                var graph = new AmCharts.AmGraph();
                graph.valueField = "visits";
                graph.colorField = "color";
                graph.balloonText = "<b>[[category]]: [[value]]</b>";
                graph.type = "column";
                graph.lineAlpha = 0;
                graph.fillAlphas = 1;
                chart4.addGraph(graph);

                // CURSOR
                var chartCursor = new AmCharts.ChartCursor();
                chartCursor.cursorAlpha = 0;
                chartCursor.zoomable = false;
                chartCursor.categoryBalloonEnabled = false;
                chart4.addChartCursor(chartCursor);

                chart4.creditsPosition = "top-right";

                // WRITE
                chart4.write("chartdiv4");
            });