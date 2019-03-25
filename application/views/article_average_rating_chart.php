<div class="row">
	<div class="col-sm-3">
		<a class="btn btn-info" href="<?php echo base_url('user-dashboard') ?>"><i class="fa fa-angle-double-left"></i> Dashboard</a>
	</div>
</div>
<br>
<div id="article_average_rating" style="width: 100%; height: 500px;"></div>
<!-- article count starts here -->
<script type="text/javascript">

    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart(){
      var data = google.visualization.arrayToDataTable([
        ["Article ID", "Average Rating out of 5 is", { role: "style" } ],
        <?php foreach($average_ratings as $row):	?>
        	["Article ID : <?php echo $row->article_id ?>", <?php echo number_format($row->average_rating,1) ?>, "<?php echo '#'.str_shuffle('FFC901')?>"],
        <?php endforeach; ?>
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "Article's Average Ratings",
        width: 1180,
        height: 500,
        bar: { groupWidth: "80%"},
        legend: { position: "none" },
        hAxis: { title: "Article ID's",titleTextStyle: {color: '#FF0000'} 
    	},
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("article_average_rating"));
      chart.draw(view, options);
  }
  </script>
<!-- article count ends here -->