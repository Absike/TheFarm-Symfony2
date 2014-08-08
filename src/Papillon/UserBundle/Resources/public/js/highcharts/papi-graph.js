/**
 * Created by hassan absike on 5/8/14.
 */
if (!POCKET) { var POCKET = {};}

POCKET.Charts = {};
var height = 280;

/**
 * Basic line graph
 * @param container
 * @returns {Chart}
 */
POCKET.Charts.xy = function (container) {

    var chart = new Highcharts.Chart({
        chart: {
            renderTo: container, height: height
        },
        exporting: {
            enabled: false
        }, title: {
            text: "DEMO TEST"
        }, subtitle: {
            text: null
        }, xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        }, yAxis: {
            title: {
                text: 'Temperature (°C)'
            },
            plotLines: [
                {
                    value: 0,
                    width: 1,
                    color: '#808080'
                }
            ]
        }, legend: {
            align: 'center', verticalAlign: 'bottom', layout: 'horizontal'
        }, tooltip: {
            valueSuffix: '°C'
        }
        , series: [
            {
                name: 'Tokyo',
                data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
            }
        ]
    });

    return chart;
}


/**
 * Basic pie chart
 * @param container
 * @returns {Chart}
 */
POCKET.Charts.pie = function (container) {

    var chart = new Highcharts.Chart({
        chart: {
            renderTo: container, height: height,
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: 'DEMO PIE'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Browser share',
            data: [
                ['Firefox',   45.0],
                ['IE',       26.8],
                {
                    name: 'Chrome',
                    y: 12.8,
                    sliced: true,
                    selected: true
                },
                ['Safari',    8.5],
                ['Opera',     6.2],
                ['Others',   0.7]
            ]
        }]
    });

    return chart;
}


/**
 * Basic bar chart
 * @param container
 * @returns {Chart}
 */
POCKET.Charts.bar = function (container) {


}


