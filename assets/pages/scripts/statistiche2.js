

          


jQuery(document).ready(function() {
	
	var url = document.getElementById("url_path").href;
	

	var options = {
        chart: {
			 renderTo: 'container3',
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Soci uomini/donne'
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
        series: [{}]
    };
    

   var url =  "datapie.php?req=gen";
    $.getJSON(url,  function(data) {
	
        options.series = data;
        var chart = new Highcharts.Chart(options);
    });
	
	
	
	
	var options2 = {
        chart: {
			 renderTo: 'container4',
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'In regola/Morosi'
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
        series: [{}]
    };
	//	 var url2 =  "http://localhost/gestionale_sic/datapie.php?req=reg";
		var url2= "datapie.php?req=reg";
		 
		     $.getJSON(url2,  function(data) {
	
        options2.series = data;
        var chart2 = new Highcharts.Chart(options2);
    });
	
	

	
	
});	