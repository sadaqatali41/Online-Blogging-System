<?php echo anchor('user-dashboard',' Dashboard',array('class'=>'btn btn-info fa fa-angle-double-left')),
		link_tag('styles/css/welcome.css');
 ?>
 <style type="text/css">
 	input[type=submit],input[type=reset]{margin: 5px;}
 </style>
<div class="addarticles">
	<div class="panel panel-primary">
		<div class="panel-heading text-center"><strong>Add Articles</strong></div>
		<div class="panel-body">
			<?php echo form_open_multipart('add-article-submit'); ?>
			<?php echo form_hidden('user_id',$this->session->userdata('user_id')); ?>
			<div class="form-group">
				<?php echo form_label('Enter Title:','title'),
						form_input(array('name'=>'title','placeholder'=>'Enter Title Name','class'=>'form-control','required'=>'required','value'=>set_value('title')));
				 ?>
			</div>
			<div class="row">
				<div class="col-sm-12 text-center">
							<strong><?php echo form_error('title'); ?></strong>
				</div>
			</div>
			<br>
			<div class="form-group">
				<?php echo form_label('Enter Title Description:','title'),
						form_textarea(array('name'=>'body','placeholder'=>'Enter Title Description','class'=>'form-control','required'=>'required','value'=>set_value('body')));
				 ?>
			</div>
			<div class="row">
				<div class="col-sm-12 text-center">
							<strong><?php echo form_error('body'); ?></strong>
				</div>
			</div>
			<div class="form-group">
				<?php echo form_label('Select Image:','image'),
						form_upload(array('name'=>'image','id'=>'image','class'=>'form-control','required'=>'required'));
				 ?>
			</div>
			<div class="form-group" style="display: none;" id="image_div">
				<label><strong>Image Preview:</strong></label>
				<br>
				<img src="" id="image_preview" height="250px" width="250px" class="img-rounded">
			</div>
			<div class="row">
				<div class="col-sm-12 text-center">
							<strong><?php if(isset($upload_error)){echo $upload_error;} ?></strong>
				</div>
			</div>
			<br>
			<div class="form-group">
				<?php  

				echo form_submit(array('name'=>'submit','value'=>'Add Articles','class'=>'btn btn-info'));
				echo form_reset(array('value'=>'Reset All','class'=>'btn btn-danger'));
				?>
			</div>	
			<?php echo form_close(); ?>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(window).on('load',function(){
		$('#image').change(function(event){
			try{
				var url = URL.createObjectURL(event.target.files[0]);
			}
			catch(error){
				$('#image_div').hide();
				return false;
			}
			$('#image_div').show();
			$('#image_preview').attr('src',url);
			URL.revokeObjectURL(this.src);
		});
	});
</script>