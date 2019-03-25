<?php echo link_tag('styles/css/welcome.css'); ?>

<div class="welcome">
	<div class="row">
		<div class="col-sm-3">
			<a class="btn btn-info" href="<?php echo base_url('view-user-articles/'.$details->id) ?>"><i class="fa fa-angle-double-left"></i> User Articles</a>
		</div>
	</div>
	<br>
	<form method="post" action="<?php echo base_url('edit-article-submit/'.$details->article_id) ?>" enctype="multipart/form-data">
		<div class="row">
			<div class="col-sm-4">
				<div class="col-sm-4"><b>Article Title :</b></div>
				<div class="col-sm-8">
					<input type="hidden" name="user_id" value="<?php echo $details->id ?>">
					<input type="text" name="title" class="form-control" required value="<?php echo $details->title ?>" placeholder="Enter Article Title">
				</div>
			</div>
			<div class="col-sm-6">
				<div class="col-sm-4"><b>Article Description :</b></div>
				<div class="col-sm-8">
					<textarea  rows="6" class="form-control" name="body" required placeholder="Enter Article Description"><?php echo $details->body ?></textarea>
				</div>
			</div>
			<div class="col-sm-2">
				<input type="submit" value="Submit" class="btn btn-info">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-3">
				<div class="row">
					<div class="col-sm-5"><b>Old Picture :</b></div>
				</div>
				<div class="row">
					<div class="col-sm-7">
						<img src="<?php echo $details->image_path ?>" height="170" alt="<?php echo $details->title ?>" style="cursor: pointer;" class="img-rounded">
					</div>
				</div>	
			</div>
			<div class="col-sm-3" id="image_preview">
				<div class="row">
					<div class="col-sm-5"><b>New Picture :</b></div>
				</div>
				<div class="row">
					<div class="col-sm-7">
						<img src="" id="load_image" height="170" alt="<?php echo $details->title ?>" style="cursor: pointer;" class="img-rounded">
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="row">
					<div class="col-sm-4"><b>Upload Picture :</b></div>
				</div>
				<div class="row">
					<div class="col-sm-8">
						<input type="file" name="file" id="file" class="form-control">
					</div>
				</div>
			</div>
			
		</div>
	</form>
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
<script type="text/javascript">
	$('#image_preview').hide();

	$(document).ready(function(){

		$('img').on('click',function(){
			var src = $(this).attr('src');
			var title = $(this).attr('alt');

			$('#image_modal').attr('src',src);
			if(title != undefined)
			{
				$('.modal-title').html('<em>Title : </em><em style="color:blue;">'+title+'</em>');
			}
			else
				return false;
			$('#model').modal('show');
		});

		$('#file').change(function(event){
			try{
				var url = URL.createObjectURL(event.target.files[0]);
			}
			catch(err){
				$('#image_preview').hide();
				return false;
			}
			$('#image_preview').show();
			$('#load_image').attr('src',url);
			URL.revokeObjectURL(this.src);
		});
	});
</script>

