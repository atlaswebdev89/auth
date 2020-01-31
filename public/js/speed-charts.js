jQuery(document).ready(function ($) {
     jQuery("#load").bind('click', function(e){
         var button=$(this);
         button.attr('disabled', 'disabled');
         e.preventDefault();  // отключить стандартное поведение ссылки    
         
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);
      
      var target = $("#target").val(); 
      var date_first = $("input[name='date_first']").val();
      var date_last = $("input[name='date_last']").val();
      
      function drawChart() {
           var options = {
          title: 'Графики', 
          curveType: 'function',
          backgroundColor: { 'strokeWidth': 1 },
          animation:{
                      duration: 1}
         
      };
            
      $.ajax({
          url: "/grafspeed",
          type: "POST",
          data: ({target: target, date_first: date_first, date_last: date_last}),
          dataType: "json",
          timeout: 8000,
          beforeSend: function() {
                        $("#wrapper").empty();
                        $("#information").html("Ожидание данных ...");
                },
          success: function(jsonData) {
                $("#information").empty();
                button.prop('disabled', false);
                var data =  new google.visualization.DataTable(jsonData);
                var chart = new google.visualization.LineChart(document.getElementById('wrapper'));
                chart.draw(data, options);            
          },
          error: function () { 
                        button.prop('disabled', false);
                        $("#information").html("Нет данных");
		         },
          complete: function(data) { // сoбытиe пoслe любoгo исхoдa
 			button.prop('disabled', false); // в любoм случae включим кнoпку oбрaтнo

		         }
          }) 
      }       
     })

      })