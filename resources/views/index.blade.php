@extends('layout_master.layout')
@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/custom.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>

<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<div class="row">
		<div class="col-md-6">
			<canvas id="chart-0"></canvas>
		</div>
		<div class="col-md-6">
			<canvas id="chart-1"></canvas>
		</div>
	</div>
</div>
<script type="text/javascript">
    var yellow = 'rgba(255, 206, 86, 1)';
    var blue = 'rgba(54, 162, 235, 1)';
    var red = 'rgba(255, 99, 132, 1)';

	var ctx0 = document.getElementById('chart-0').getContext('2d');
    var ph = '{{$photographers}}';
    var sub = '{{$subscribers}}';
    var booking = '{{$booking}}';
    var bookArr = booking.split(",");

    var bookColor = [];
    for(let i = 0; i < bookArr.length; i++){
        if(bookArr[i] < 51){
            bookColor[i] = red;
        }else if (bookArr[i] < 151) {
            bookColor[i] = yellow;
        }else{
            bookColor[i] = blue;
        }
    }

    var d = new Date();
    var yr = d.getFullYear();

	var myBarChart = new Chart(ctx0, {
        type: 'bar',
        data: {
            datasets: [{
                label: 'Booking '+yr,
                data: bookArr,
                backgroundColor: bookColor
            }],
            labels: [
                'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
            ]
        },
        options: { 
            legend: {
                labels: {
                    fontColor: "#98999A",
                    fontSize: 18
                }
            },
            scales: {
                yAxes: [{
                    ticks: {
                        fontColor: "#98999A",
                        fontSize: 13,
                        stepSize: 1,
                        beginAtZero: true
                    }
                }],
                xAxes: [{
                    ticks: {
                        fontColor: "#98999A",
                        fontSize: 14,
                        stepSize: 1,
                        beginAtZero: true
                    }
                }]
            }
        }
    });

    var ctx1 = document.getElementById('chart-1').getContext('2d');
    var myPieChart = new Chart(ctx1, {
        type: 'pie',
        data: {
                datasets: [{
                    data: [ph, sub],
                    backgroundColor: [
                        yellow,
                        blue,
                    ]
                }],
                labels: [
                    'Photographers',
                    'Subscribers',
                ]
            },
    });

</script>
@endsection