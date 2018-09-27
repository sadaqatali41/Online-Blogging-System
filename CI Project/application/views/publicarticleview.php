<?php include 'hheader.php'; ?>
<?php echo anchor('logincontroller','BackToLogin',array('class'=>'btn btn-info pull-right')); ?>
<?php echo link_tag('styles/css/particle.css'); ?>
<br><br>
<div class="table-responsive">
	<table class="table table-bordered">
		<thead>
			<tr class="success">
				<th>Serial No.</th>
				<th>User ID</th>
				<th>Article Title</th>
				<th>Article Description</th>
			</tr>
		</thead>
		<tbody>
			<?php 
				if(count($result))
				{
					$count = $this->uri->segment(3,0);
					foreach($result as $result)
					{
						?>
						<tr>
							<th><?php echo ++$count; ?></th>
							<td><?php echo $result->id; ?></td>
							<td><?php echo $result->title; ?></td>
							<td><?php echo $result->body; ?></td>
						</tr>
						<?php
					}
				}
				else
				{
					?>
					<tr>
						<th colspan="4">Sorry! Records not Found.</th>
					</tr>
					<?php
				}
			?>
			<tr>
				<th colspan="4">
					<?php echo $this->pagination->create_links(); ?>
				</th>
			</tr>
		</tbody>
	</table>
</div>
<?php include 'ffooter.php'; ?>