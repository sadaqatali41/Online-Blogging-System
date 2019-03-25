<div class="row">
	<div class="col-sm-12">
		<a href="<?php echo base_url('user-dashboard') ?>" class="btn btn-info" id="back"><i class="fa fa-angle-double-left"></i> Dashboard
		</a>
		<a href="javascript:void(0)" id="print" class="btn btn-default pull-right" onclick="print_article()">Print</a>
		<br><br>
		<table class="table table-bordered table-striped">
			<thead>
				<tr class="success">
					<th>Title</th>
					<th>Description</th>
					<th>Download Count</th>
					<th>Image</th>
				</tr>
			</thead>
			<tbody>
				<?php if(count($result) > 0) : ?>
					<tr>
						<td><?php echo $result->title; ?></td>
						<td><?php echo $result->body; ?></td>
						<td><?php echo $result->img_count; ?></td>
						<td>
							<div class="col-sm-6">
								<img src="<?php echo $result->image_path; ?>" height="320" width="550">
							</div>
						</td>
					</tr>
				<?php else: ?>
					<div class="alert alert-danger">Sorry! Data not Found.</div>
				<?php endif; ?>
			</tbody>
		</table>
	</div>
</div>
<script type="text/javascript">
	function print_article()
	{
		document.getElementById('print').style.display = "none";
		document.getElementById('back').style.display = "none";
		window.print();
		window.close();
	}
</script>