<html>
  <head>
    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="js/jquery.cookie.js"></script> 
    <script src="js/messenger.js"></script> 
    <script type="text/javascript">
    
    // Load the Visualization API and the piechart package.
    google.load('visualization', '1', {'packages':['corechart']});
      
    // Set a callback to run when the Google Visualization API is loaded.
    google.setOnLoadCallback(drawChart);
     var link = getUrlVars()['link'];
      
    function drawChart() {
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
         var col_chart = new google.visualization.ColumnChart(document.getElementById('column_div'));
        
        function refreshData () {
            var jsonData = $.ajax({
                url: "graph.php?sessionId="+link,
                dataType:"json",
                async: false
                }).responseText;
       
          
      // Create our data table out of JSON data loaded from server.
      var data = new google.visualization.DataTable(jsonData);
      var options = {
           title: 'Multiple Choice Answers as Pie Chart 3D',
          is3D: 'true',
          width: 800,
          height: 400,
          pointSize: 5
        };

      // Instantiate and draw our pie chart, passing in some options.
      
      chart.draw(data, options);
      
      //column chart option and draw using same data
          
         var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var coloptions = {
	title: "Multiple Choice Answers As Column Graph",
	width: 800,
	height: 400,
	bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };
      //draw column chart with views and options
      col_chart.draw(view, coloptions);
        }  
        refreshData();
    setInterval(refreshData, 1500);
    }

    </script>
  </head>

  <body>
      
    <!--Div that will hold the pie chart-->
    
  <div id="chart_div" style="width: 80%; float: left; margin-left: -100px"></div>
 <div id="column_div" style="margin-left: 450px; "></div>
     
     <input type="hidden" name="link">
     
  </body>
</html>