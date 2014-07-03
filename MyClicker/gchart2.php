<html>
  <head>
    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="js/jquery.cookie.js"></script> 
    <script type="text/javascript">
    
    // Load the Visualization API and the piechart package.
    google.load('visualization', '1', {'packages':['corechart']});
      
    // Set a callback to run when the Google Visualization API is loaded.
    google.setOnLoadCallback(drawChart);
      
    function drawChart() {
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
         var col_chart = new google.visualization.ColumnChart(document.getElementById('column_div'));
        function refreshData () {
            var jsonData = $.ajax({
                url: "graph.php?sessionId="+$.cookie("sessionId"),
                dataType:"json",
                async: false
                }).responseText;
       
          
      // Create our data table out of JSON data loaded from server.
      var data = new google.visualization.DataTable(jsonData);
      var options = {
           title: 'Multiple Choice Answers as Pie Chart 3D',
          is3D: 'true',
          width: 800,
          height: 400
        };

      // Instantiate and draw our chart, passing in some options.
      
      chart.draw(data, options);
      
      //column chart option and draw using same data
       var coloptions = {
          title: 'Multiple Choice Answers As Column Graph',
                 
          hAxis: {title: 'Multiple Choice Answers', titleTextStyle: {color: 'red'}}
                            
        };

       
        col_chart.draw(data, coloptions);
        }  
        refreshData();
    setInterval(refreshData, 1500);
    }

    </script>
  </head>

  <body>
      
    <!--Div that will hold the pie chart-->
    <div id="chart_div"></div>
     <div id="column_div"></div>
     
  </body>
</html>