<?php include 'hheader.php'; 
echo link_tag('styles/css/welcome.css');

?>

<div class="welcome">
	<h3 class="text-muted text-center">Welcome To Admin Panel</h3>
	<div class="row">
		<div class="col-sm-12 text-center">
			<strong><?php if($error = $this->session->flashdata('upload_error')){
				echo $error;
			} ?></strong>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-3">
			<?php echo anchor('welcomecontroller/addarticles','Add Articles',array('class'=>'btn btn-primary')); ?>
		</div>
		<div class="col-sm-9 text-right">
			<?php echo anchor('logincontroller/logout','Logout',array('class'=>'btn btn-warning')); ?>
		</div>
	</div>
	<br>
	<div class="table-responsive ">
		<?php
			if($feedback = $this->session->flashdata('feedback'))
			{
				$feedback_class = $this->session->flashdata('feedback_class');
		?>
		<div class="alert <?php echo "$feedback_class"; ?> text-center">
			<strong><?php echo $feedback;  ?></strong>
		</div>
		<?php		
			}
		?>

		<?php
			if($feedback = $this->session->flashdata('update'))
			{
				$feedback_class = $this->session->flashdata('feedback_class');
		?>
		<div class="alert <?php echo "$feedback_class"; ?> text-center">
			<strong><?php echo $feedback;  ?></strong>
		</div>
		<?php		
			}
		?>
		<?php
			if($feedback = $this->session->flashdata('delete'))
			{
				$feedback_class = $this->session->flashdata('feedback_class');
		?>
		<div class="alert <?php echo "$feedback_class"; ?> text-center">
			<strong><?php echo $feedback;  ?></strong>
		</div>
		<?php		
			}
		?>
		<table class="table table-striped table-bordered">
			<thead>
				<tr class="success">
					<th>Serial No.</th>
					<th>Articles Title</th>
					<th>Articles Description</th>
					<th>Images</th>
					<th>Actions</th>
				</tr>
			</thead>
			<?php 
				if(count($articles))
				{
					$count = $this->uri->segment(3,0);
					foreach ($articles as $articles) 
					{
			?>
						<tbody>
							<tr>
								<td><?php echo ++$count; ?></td>
								<td><?php echo $articles->title; ?></td>
								<td><?php echo $articles->body; ?></td>
								<td><?php if(! is_null($articles->image_path)): ?>
									<a href="<?php echo $articles->image_path; ?>" target="_blank"><img src="<?php echo $articles->image_path; ?>" height="70" width="70"></a>
								<?php endif; ?>
								</td>
								<th>
									<?php echo anchor("welcomecontroller/edit_articles/{$articles->article_id}",'Edit',array('class'=>'btn btn-info')),
											anchor("welcomecontroller/delete_articles/{$articles->article_id}",'Delete',array('class'=>'btn btn-danger dlt'));
									 ?>
								</th>
							</tr>
						</tbody>
			<?php
					}
				}
				else
				{
			?>
						<tbody>
							<tr class="danger">
								<th colspan="5" class="text-center">Sorry! Records not Found.. Please Add Articles by Logged IN ID.</th>
							</tr>
						</tbody>
			<?php		
				}
				if($this->pagination->create_links())
				{
			?>
			<tr>
				<th colspan="5">
					<?php echo $this->pagination->create_links(); ?>
				</th>
			</tr>
			<?php
		}
		?>
		</table>
	</div>
</div>

<?php include 'ffooter.php'; ?>
<script type="text/javascript">
	$(document).ready(function(){
		$('.dlt').click(function(){
			var option = confirm('Do You Want To Delete This Article.');
			if(option)
			{
				var option = confirm('Really, You Want To Delete This Article.');
				if(option)
					return true;
				else
					return false;
			}
			else
				return false;
		});
	});
</script>