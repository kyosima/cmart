
            var chart2;
            var chartData2 = [
                {
                    "date": "2012-03-01",
                    "price": 20
                },
                {
                    "date": "2012-03-02",
                    "price": 75
                },
                {
                    "date": "2012-03-03",
                    "price": 15
                },
                {
                    "date": "2012-03-04",
                    "price": 75
                },
                {
                    "date": "2012-03-05",
                    "price": 158
                },
                {
                    "date": "2012-03-06",
                    "price": 57
                },
                {
                    "date": "2012-03-07",
                    "price": 107
                },
                {
                    "date": "2012-03-08",
                    "price": 89
                },
                {
                    "date": "2012-03-09",
                    "price": 75
                },
                {
                    "date": "2012-03-10",
                    "price": 132
                },
                {
                    "date": "2012-03-11",
                    "price": 158
                },
                {
                    "date": "2012-03-12",
                    "price": 56
                },
                {
                    "date": "2012-03-13",
                    "price": 169
                },
                {
                    "date": "2012-03-14",
                    "price": 24
                },
                {
                    "date": "2012-03-15",
                    "price": 147
                }
            ];

            var average2 = 90.4;

            AmCharts.ready(function () {

                // SERIAL CHART
                chart2 = new AmCharts.AmSerialChart();

                chart2.dataProvider = chartData2;
                chart2.categoryField = "date";
                chart2.dataDateFormat = "YYYY-MM-DD";

                // AXES
                // category
                var categoryAxis = chart2.categoryAxis;
                categoryAxis.parseDates = true; // as our data is date-based, we set parseDates to true
                categoryAxis.minPeriod = "DD"; // our data is daily, so we set minPeriod to DD
                categoryAxis.dashLength = 1;
                categoryAxis.gridAlpha = 0.15;
                categoryAxis.axisColor = "#DADADA";

                // value
                var valueAxis = new AmCharts.ValueAxis();
                valueAxis.axisColor = "#DADADA";
                valueAxis.dashLength = 1;
                valueAxis.logarithmic = true; // this line makes axis logarithmic
                chart2.addValueAxis(valueAxis);

                // GUIDE for average2
                var guide = new AmCharts.Guide();
                guide.value = average2;
                guide.lineColor = "#CC0000";
                guide.dashLength = 4;
                guide.label = "average2";
                guide.inside = true;
                guide.lineAlpha = 1;
                valueAxis.addGuide(guide);


                // GRAPH
                var graph = new AmCharts.AmGraph();
                graph.type = "smoothedLine";
                graph.bullet = "round";
                graph.bulletColor = "#FFFFFF";
                graph.useLineColorForBulletBorder = true;
                graph.bulletBorderAlpha = 1;
                graph.bulletBorderThickness = 2;
                graph.bulletSize = 7;
                graph.title = "Price";
                graph.valueField = "price";
                graph.lineThickness = 2;
                graph.lineColor = "#00BBCC";
                chart2.addGraph(graph);

                // CURSOR
                var chartCursor = new AmCharts.ChartCursor();
                chartCursor.cursorPosition = "mouse";
                chart2.addChartCursor(chartCursor);

                // SCROLLBAR
                var chartScrollbar = new AmCharts.ChartScrollbar();
                chartScrollbar.graph = graph;
                chartScrollbar.scrollbarHeight = 30;
                chart2.addChartScrollbar(chartScrollbar);

                chart2.creditsPosition = "bottom-right";

                // WRITE
                chart2.write("chartdiv2");
            });