
var cvs='http://localhost/gestionale_sic/databar.php?req=quote';
//var cvs='http://www.srlsolutions.it/demo_sic/databar.php?req=quote';

Highcharts.chart('container', {
    data: {
       //table: 'datatable'
	   csvURL:cvs
    },
    chart: {
        type: 'column'
    },
    title: {
        text: 'Importi versati e importi dovuti annuali'
    },
	 subtitle: {
        text: 'Ultimi 20 anni',
        floating: true,
        align: 'center'
    },
	legend:{
	align: 'left',
        verticalAlign: 'top',
        x:110,
        y: 80,
        floating: true,
		squareSymbol: false,
		alignColumns: true
		
	},
    yAxis: {
        allowDecimals: false,
        title: {
            text: 'Importi (euro)'
        }
    },
    tooltip: {
        formatter: function () {
            return '<b>' + this.series.name + '</b><br/>' +
              this.point.x + ' ' +  this.point.y  + ' euro ';
        }
    }
});
