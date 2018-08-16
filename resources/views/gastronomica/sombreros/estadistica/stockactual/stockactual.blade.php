@extends('layouts.master')
@section('title','Sombreros')
@section('content')
    <div class="breadcrumb-holder fadeIn animated">
        <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item active">Stock Actual de los articulos</li>
        </ul>
        </div>
    </div>
    <section class="forms"><br/>
        <div class="container-fluid">
          <!--<header>
            <h1 class="h5 fadeIn animated text-center ion-clipboard"> Lista Sombreros</h1>
          </header>-->
          <div class="col-md-12 embed-responsive embed-responsive-16by9">
                <div id="columnchart_values" style="border: 2px dashed #bbb;" class="text-center embed-responsive-item"></div>
            </div>
        </div>
    </section>
    <script type="text/javascript">
        google.charts.load("current", {packages:['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
          var data = google.visualization.arrayToDataTable([
            ["Element", "Cantidad", { role: "style" } ],
            @foreach ($imagenes as $imagen)
              ['{{$imagen->codigo}}', {{$imagen->stock_actual}}, "silver"],
            @endforeach
            
            /*["Silver", 10.49, "silver"],
            ["Gold", 19.30, "gold"],
            ["Platinum", 21.45, "color: #e5e4e2"]*/
          ]);
    
          var view = new google.visualization.DataView(data);
          view.setColumns([0, 1,
                           { calc: "stringify",
                             sourceColumn: 1,
                             type: "string",
                             role: "annotation" },
                           2]);
    
          var options = {
            title: "Stock de articulos, en und.",
            width: '100%',
            // height: 500,
            bar: {groupWidth: "95%"},
            legend: { position: "none" },
          };
          var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
          chart.draw(view, options);
      }
      </script>
@endsection