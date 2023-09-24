
var url = document.getElementById("url_path").href;
	
	console.log(url);
	
	
	


//var cvs='http://localhost/gestionale_sic/databar.php?req=quote';
var cvs=url+'databar.php?req=mensili';
//var cvs2='http://localhost/gestionale_sic/databar.php?req=quote2';
//var cvs2=url+'databar.php?req=quote2';
Highcharts.chart('container', {
    data: {
       //table: 'datatable'
	   csvURL:cvs
    },
    chart: {
        type: 'column'
    },
    title: {
        text: 'Numero di esami mensili'
    },
	 subtitle: {
        text: 'Ultimi  mesi',
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
            text: 'Numero esami'
        }
    }
   /* tooltip: {
        formatter: function () {
            return '<b>' + this.series.name + '</b><br/>';
        }
    }*/
});
/*
Highcharts.chart('container2', {
    data: {
        //table: 'datatable2'
		   csvURL:cvs2
    },
    chart: {
        type: 'column'
    },
    title: {
        text: 'Numero quote annuali pagate/insolute'
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
            text: 'Numero quote'
        }
    },
    tooltip: {
        formatter: function () {
            return '<b>' + this.series.name + '</b><br/>' +
              this.point.x + ' ' +  this.point.y;
        }
    }
});

   *
*/   

