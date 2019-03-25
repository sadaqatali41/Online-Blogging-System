<div class="row">
	<div class="col-sm-3">
		<a class="btn btn-info" href="<?php echo base_url('user-dashboard') ?>"><i class="fa fa-angle-double-left"></i> Dashboard</a>
	</div>
</div>
<br>
<div id="registrations_count" style="width: 100%; height: 500px;"></div>
<div id="daily_registration_count" style="width: 100%; height: 500px;"></div>
<!-- Monthlywise registration count starts -->
<script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ["Months", "Registration", { role: "style" } ],
        ["January", <?php echo $January->month ?>, "#b87333"],
        ["February", <?php echo $February->month ?>, "gold"],
        ["March", <?php echo $March->month ?>, "silver"],
        ["April", <?php echo $April->month ?>, "#e5e4e2"],
        ["May", <?php echo $May->month ?>, "green"],
        ["June", <?php echo $June->month ?>, "grey"],
        ["July", <?php echo $July->month ?>, "#BDC679"],
        ["August", <?php echo $August->month ?>, "#BC5679"],
        ["September", <?php echo $September->month ?>, "#703593"],
        ["October", <?php echo $October->month ?>, "#76A7FA"],
        ["November", <?php echo $November->month ?>, "#C5A5CF"],
        ["December", <?php echo $December->month ?>, "#871B47"],
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "Monthlywise Registration Count in 2019",
        width: 1180,
        height: 500,
        bar: {groupWidth: "90%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("registrations_count"));
      chart.draw(view, options);
  }
  </script>
  <!-- Monthlywise registration count ends here -->

  <!-- Dailywise current month registration count starts here -->
  <script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ["Days", "Registration", { role: "style" } ],
        ["Date 01", <?php echo $result['1']->day_wise ?>, "#b87333"],
        ["Date 02", <?php echo $result['2']->day_wise ?>, "gold"],
        ["Date 03", <?php echo $result['3']->day_wise ?>, "silver"],
        ["Date 04", <?php echo $result['4']->day_wise ?>, "#e5e4e2"],
        ["Date 05", <?php echo $result['5']->day_wise ?>, "green"],
        ["Date 06", <?php echo $result['6']->day_wise ?>, "grey"],
        ["Date 07", <?php echo $result['7']->day_wise ?>, "#BDC679"],
        ["Date 08", <?php echo $result['8']->day_wise ?>, "#BC5679"],
        ["Date 09", <?php echo $result['9']->day_wise ?>, "#703593"],
        ["Date 10", <?php echo $result['10']->day_wise ?>, "#76A7FA"],
        ["Date 11", <?php echo $result['11']->day_wise ?>, "#C5A5CF"],
        ["Date 12", <?php echo $result['12']->day_wise ?>, "#871B47"],
        ["Date 13", <?php echo $result['13']->day_wise ?>, "#1F85DE"],
        ["Date 14", <?php echo $result['14']->day_wise ?>, "#DE781F"],
        ["Date 15", <?php echo $result['15']->day_wise ?>, "#7D1FDE"],
        ["Date 16", <?php echo $result['16']->day_wise ?>, "#1FDEBD"],
        ["Date 17", <?php echo $result['17']->day_wise ?>, "#DE1F40"],
        ["Date 18", <?php echo $result['18']->day_wise ?>, "#DE1F40"],
        ["Date 19", <?php echo $result['19']->day_wise ?>, "#98A959"],
        ["Date 20", <?php echo $result['20']->day_wise ?>, "#011C04"],
        ["Date 21", <?php echo $result['21']->day_wise ?>, "#1C0119"],
        ["Date 22", <?php echo $result['22']->day_wise ?>, "#04500D"],
        ["Date 23", <?php echo $result['23']->day_wise ?>, "#260222"],
        ["Date 24", <?php echo $result['24']->day_wise ?>, "#260204"],
        ["Date 25", <?php echo $result['25']->day_wise ?>, "#54763A"],
        ["Date 26", <?php echo $result['26']->day_wise ?>, "#3A6176"],
        ["Date 27", <?php echo $result['27']->day_wise ?>, "#3A4476"],
        ["Date 28", <?php echo $result['28']->day_wise ?>, "#766C3A"],
        ["Date 29", <?php echo $result['29']->day_wise ?>, "#D72929"],
        ["Date 30", <?php echo $result['30']->day_wise ?>, "#180EEB"],
        ["Date 31", <?php echo $result['31']->day_wise ?>, "#1C0EEB"],

      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "Dailywise Registration Count for <?php echo date('F'); ?> Month in 2019",
        width: 1180,
        height: 500,
        bar: {groupWidth: "80%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("daily_registration_count"));
      chart.draw(view, options);
  }
  </script>
  <!-- Dailywise current month registration count ends here -->