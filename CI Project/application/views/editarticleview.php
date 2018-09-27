<?php include 'hheader.php'; ?>
<?php echo anchor('welcomecontroller/welcome','Back',array('class'=>'btn btn-info')),
		link_tag('styles/css/welcome.css');
 ?>
<div class="addarticles">
	<div class="panel panel-primary">
		<div class="panel-heading text-center"><strong>Update Articles</strong></div>
		<div class="panel-body">
			<?php echo form_open_multipart('welcomecontroller/updatearticles'); ?>
			<?php echo form_hidden('article_id',$article->article_id); ?>
			<div class="form-group">
				<?php echo form_label('Enter Title:','title'),
						form_input(array('name'=>'title','placeholder'=>'Enter Title Name','class'=>'form-control','value'=>set_value('title',$article->title)));
				 ?>
			</div>
			<div class="row">
				<div class="col-sm-12 text-center">
							<strong><?php echo form_error('title'); ?></strong>
				</div>
			</div>
			<div class="form-group">
				<?php echo form_label('Enter Title Description:','title'),
						form_textarea(array('name'=>'body','placeholder'=>'Enter Title Description','class'=>'form-control','value'=>set_value('body',$article->body)));
				 ?>
			</div>
			<div class="row">
				<div class="col-sm-12 text-center">
							<strong><?php echo form_error('body'); ?></strong>
				</div>
			</div>
			<div class="form-group">
				<?php echo form_label('Upload Picture:','image'),
						form_upload(array('name'=>'image','class'=>'form-control'));
				 ?>
			</div>
			<div class="form-group">
				<?php  

				echo form_submit(array('name'=>'submit','value'=>'Update Articles','class'=>'btn btn-info')),
						form_reset(array('value'=>'Reset All','class'=>'btn btn-danger'));
				?>
			</div>	
			<?php echo form_close(); ?>
		</div>
	</div>
</div>

<?php include 'ffooter.php'; ?>