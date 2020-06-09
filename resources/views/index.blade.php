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
	var ctx0 = document.getElementById('chart-0').getContext('2d');
	var myBarChart = new Chart(ctx0, {
        type: 'bar',
        data: {
                datasets: [{
                    data: [10, 20, 30, 5, 2, 50, 47, 25, 31, 42, 26, 35],
                    backgroundColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                    ]
                }],
                labels: [
                    'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
                ]
            },
    });

    var ctx1 = document.getElementById('chart-1').getContext('2d');
    var myPieChart = new Chart(ctx1, {
        type: 'pie',
        data: {
                datasets: [{
                    data: [10, 20, 30],
                    backgroundColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                    ]
                }],
                labels: [
                    'A',
                    'B',
                    'C'
                ]
            },
    });

</script>
@endsection