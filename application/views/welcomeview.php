<?php include 'hheader.php'; 
echo link_tag('styles/css/welcome.css');

?>
<div class="welcome">
	<h3 class="text-muted text-center">Welcome To Dashboard</h3>
	<div class="row">
		<div class="col-sm-3 pull-right">
			<h4 class="alert alert-success text-center">Hello... <span class="text text-primary"><?php echo ucwords($this->session->userdata('name')); ?>
			</span></h4>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12 text-center">
			<strong><?php if($error = $this->session->flashdata('upload_error')){
				echo $error;
			} ?></strong>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-3">
			<div class="dropdown">
				<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">MENUS
				<span class="caret"></span></button>
				<ul class="dropdown-menu">
					<li><a href="<?php echo base_url('add-articles') ?>" style="color: red;"><i class="fa fa-plus-square"></i> Add Articles</a></li>
					 <li><a href="<?php echo base_url('article-list-for-ratings') ?>" style="color: green;"><i class="fa fa-star"></i> Rate Articles</a></li>
				</ul>
			</div>
		</div>
		<?php $array = array(1,3); ?>

		<div class="col-sm-9 text-right">
			<div class="dropdown">
				<?php $user_id = $this->session->userdata('user_id');
					$user_pic = 'user-profile/'.$user_id.'.jpg';	
				 ?>
				<button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" style="border: none;">
					<?php if(file_exists($user_pic)): ?>
						<img src="<?php echo base_url("$user_pic") ?>" class="img-circle" heigth="50" width="50">
					<?php else: ?>
						<img src="<?php echo base_url("user-profile/default.jpg") ?>" class="img-circle" height="50" width="50">
					<?php endif; ?>
				  <span class="caret"></span>
				</button>
				  <ul class="dropdown-menu dropdown-menu-right">
				    <li><a href="<?php echo base_url('your-story') ?>" style="color: red;"><i class="fa fa-history"></i> Your Story</a></li>
				    <li><a href="<?php echo base_url('change-password') ?>" style="color: green;"><i class="fa fa-edit"></i> Change Password</a></li>
				    <li><a href="<?php echo base_url('profile'); ?>" style="color: blue;"><i class="fa fa-eye"></i> Profile Details</a></li>
				    <li><a href="<?php echo base_url('change-profile-picture'); ?>" style="color: magenta;"><i class="fa fa-file"></i> Change Profile Picture</a></li>
				    <li><a href="<?php echo base_url('view-article-gallery/'.$user_id); ?>" style="color: #978FF2;"><i class="fa fa-file-image-o"></i> View Article Gallery</a></li>
				<!-- FOR ADMIN ONLY -->
				    <?php if(in_array($user_id, $array)) : ?>
				    <li><a href="<?php echo base_url('user-registration-details'); ?>" style="color: #1F85DE;"><i class="fa fa-list"></i> User Registration List</a></li>
				    <li><a href="<?php echo base_url('user-registration-chart'); ?>" style="color: #25DE1F;"><i class="fa fa-bar-chart"></i> User Registration Charts</a></li>
				    <li><a href="<?php echo base_url('user-article-list'); ?>" style="color: #BC9000;"><i class="fa fa-list"></i> User Article List</a></li>
				    <li><a href="<?php echo base_url('user-article-chart'); ?>" style="color: #cc6600;"><i class="fa fa-bar-chart"></i> User Article Charts</a></li>
				    <li><a href="<?php echo base_url('article-average-rating-chart'); ?>" style="color: #760D53;"><i class="fa fa-bar-chart"></i>  Article Average Rating Charts</a></li>
				    <li><a href="<?php echo base_url('user-overview'); ?>" style="color: #999D53;"><i class="fa fa-info-circle"></i>  More Information</a></li>
				    <li><a href="<?php echo base_url('all-user-story'); ?>" style="color: #DE371F;"><i class="fa fa-history"></i>  All User Story</a></li>
				    <?php endif; ?>
				<!-- ADMIN ENDS HERE -->
				    <li><a href="<?php echo base_url('logout'); ?>"><i class="fa fa-sign-out"></i> Logout</a></li>
				  </ul>
			</div>	  
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
		<table class="table table-striped table-bordered" id="dataview">
			<thead>
				<tr class="success">
					<th>Serial No.</th>
					<th>Articles Title</th>
					<th>Articles Description</th>
					<th>Images</th>
					<th>Image Downloads</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
			<?php 
				if(count($articles))
				{
					$count = $this->uri->segment(2,0);
					foreach ($articles as $articles) 
					{
			?>
							<tr>
								<td><?php echo ++$count; ?></td>
								<td><?php echo $articles->title; ?></td>
								<td style="width: 40%;text-align: justify;"><?php echo $articles->body; ?></td>
								<td><?php if(! is_null($articles->image_path)): ?>
									<a href="javascript:void(0)">
										<img src="<?php echo $articles->image_path; ?>" height="90" width="90" class="img-rounded" alt="<?php echo $articles->title; ?>">
									</a>
								<?php endif; ?>
								</td>
								<td><span class="label label-info"><?php echo $articles->img_count; ?></span></td>
								<th>
									<div class="btn-group">
									<?php echo anchor("edit-article/{$articles->article_id}",' ',array('class'=>'btn btn-info fa fa-edit','title'=>'Edit','data-toggle'=>'tooltip','data-placement'=>'bottom')),
											anchor("delete-article/{$articles->article_id}",' ',array('class'=>'btn btn-danger fa fa-trash dlt','title'=>'Delete','data-toggle'=>'tooltip','data-placement'=>'bottom')),
											anchor("print-pdf/{$articles->article_id}",' ',array('class'=>'btn btn-warning fa fa-eye','target'=>'_blank','title'=>'View','data-toggle'=>'tooltip','data-placement'=>'bottom')),
											anchor('download-photo/'.$articles->article_id,' ',array('class'=>'btn btn-primary fa fa-download','title'=>'Download','data-toggle'=>'tooltip','data-placement'=>'bottom'));
									 ?>
									 </div>
								</th>
							</tr>
			<?php
					}
				}
				else
				{
			?>
				<tr class="danger">
					<th colspan="6" class="text-center">Sorry! Records not Found.. Please Add Articles by Logged IN ID.</th>
				</tr>
			</tbody>
			<?php		
				}
				if($this->pagination->create_links())
				{
			?>
			<tr>
				<th colspan="6">
					<?php echo $this->pagination->create_links(); ?>
				</th>
			</tr>
			<?php
		}
		?>
		</table>
	</div>
</div>
<div id="model" class="modal fade" role="dialog">
	<div class="modal-dialog">
	    <div class="modal-content">
		    <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title"></h4>
		    </div>
		    <div class="modal-body">
		        <img src="" id="image_modal" width="100%" height="100%">
		    </div>
	    </div>

	</div>
</div>
<?php include 'ffooter.php'; ?>
<script type="text/javascript">
	$(window).on('load',function(){

		$('img').on('click',function(){

			var src = $(this).attr('src');
			var title = $(this).attr('alt');
			$("#image_modal").attr('src',src);
			if(title != undefined)
				$(".modal-title").html("<em>"+title+"</em>");
			else
				return false;

			$("#model").modal('show');
		});
	});
</script>
<script type="text/javascript">
	$(document).ready(function(){
		$('[data-toggle="tooltip"]').tooltip();

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

