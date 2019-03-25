<div class="row">
	<div class="col-sm-3">
		<a class="btn btn-info" href="<?php echo base_url('user-dashboard') ?>"><i class="fa fa-angle-double-left"></i> Dashboard</a>
	</div>
</div>
<br>
<div id="article_count" style="width: 100%; height: 500px;"></div>
<!-- article count starts here -->
<script type="text/javascript">

    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart(){
      var data = google.visualization.arrayToDataTable([
        ["User Name", "Article Counts", { role: "style" } ],
        <?php foreach($result as $row):	?>
        	["<?php echo ucwords($row->name) ?>", <?php echo $row->NOA ?>, "<?php echo '#'.str_shuffle('FFC901')?>"],
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
        title: "Number of Articles Per User",
        width: 1180,
        height: 500,
        bar: { groupWidth: "90%"},
        legend: { position: "none" },
        hAxis: { title: "User's Name",titleTextStyle: {color: '#FF0000'} 
    	},
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("article_count"));
      chart.draw(view, options);
  }
  </script>
<!-- article count ends here -->