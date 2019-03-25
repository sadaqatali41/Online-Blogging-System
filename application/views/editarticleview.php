<?php include 'hheader.php'; ?>
<?php echo anchor('user-dashboard',' Dashboard',array('class'=>'btn btn-info fa fa-angle-double-left')),
		link_tag('styles/css/welcome.css');
 ?>
<div class="addarticles">
	<div class="panel panel-primary">
		<div class="panel-heading text-center"><strong>Update Articles</strong></div>
		<div class="panel-body">
		<?php if(count($article) > 0): ?>
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
			<div class="row">
				<div class="col-sm-8">
					<div class="form-group">
						<?php echo form_label('Upload Picture:','image'),
								form_upload(array('name'=>'image','class'=>'form-control'));
						 ?>
					</div>
				</div>
				<div class="col-sm-4">
					<img src="<?php echo $article->image_path ?>" style="height: 100px;cursor: pointer;" class="img-rounded" alt="<?php echo $article->body; ?>">
				</div>
			</div>
			<div class="form-group">
				<?php  

				echo form_submit(array('name'=>'submit','value'=>'Update','class'=>'btn btn-success'));
				?>
			</div>	
			<?php echo form_close(); ?>
			<?php else: ?>
				<div class="panel-footer">
					<h4>
						<em>Sorry! Record not Found.</em>
					</h4>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>

<div id="image" class="modal fade" role="dialog">
	<div class="modal-dialog">
	    <div class="modal-content">
		    <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <p class="modal-title"></p>
		    </div>
		    <div class="modal-body">
		        <img src="" id="single_image" width="100%" height="100%">
		    </div>
	    </div>

	</div>
</div>

<?php include 'ffooter.php'; ?>
<script type="text/javascript">
	$(window).on('load',function(){
		$('img').on('click',function(){

			var src = $(this).attr('src');
			var desc = $(this).attr('alt');

			$("#single_image").attr('src',src);
			if(desc != undefined)
				$(".modal-title").html("<span style='color:red;'>Description:-</span> "+"<em>"+desc+"</em>");
			else
				return false;
			$("#image").modal('show');
		});
	});
</script>