<div class="container">
	<h3>Tags Lists</h3>
	<div class="alert alert-success" style="display: none;">
		
	</div>
	<button id="btnAdd" class="btn btn-success">Add New</button>
	<table class="table table-bordered table-responsive" style="margin-top: 20px;">
		<thead>
			<tr>
				<td>ID</td>
				<td>Tag Name</td>
				<td>Tag Color</td>
				<td>Category</td>
				<td>Created at</td>
				<td>Action</td>
			</tr>
		</thead>
		<tbody id="showdata">
			
		</tbody>
	</table>
</div>

<div id="myModal_view" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Modal title</h4>
      </div>
      <div class="modal-body">
        		<input type="hidden" name="txtId" value="0">
        		<div class="row">
        			<div class="col-md-4"><div class="well">Tag Name</div></div>
        			<div class="col-md-8"><h5 id="tagName"></h5></div>

        			
        		</div>
        		<div class="row">
        			

        			<div class="col-md-4"><div class="well">Tag Color</div></div>
        			<div class="col-md-8"><div id="tagColor"></div></div>

        			
        		</div>

        		<div class="row">
        			

        			<div class="col-md-4"><div class="well">Tag Indicator</div></div>
        			<div class="col-md-8"><h6 id="Category"></h6></div>
        		</div>
        		
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Back</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="myModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Modal title</h4>
      </div>
      <div class="modal-body">
        	<form id="myForm" action="" method="post" class="form-horizontal">
        		<input type="hidden" name="txtId" value="0">
        		<div class="form-group">
        			<label for="name" class="label-control col-md-4">Tag Name</label>
        			<div class="col-md-8">
        				<input type="text" name="tagName" class="form-control">
        			</div>
        		</div>
        		<div class="form-group">
        			<label for="address" class="label-control col-md-4">Tag Color</label>
        			<div class="col-md-8">
        				<input type="color" name="tagColor" id="tagColor" class="form-control" value="#a75454">
        			</div>
        		</div>
        		<div class="form-group">
        			<label for="name" class="label-control col-md-4">Type Indicator</label>
        			<div class="col-md-8">
        				<!-- <input type="text" name="Category" class="form-control"> -->
        				<select name="Category" id="tagCategory" class="form-control">
						    <option value="">Select Category</option>
						    <option value="category1">category1</option>
						    <option value="category2">category2</option>
						    <option value="category3">category3</option>
						    <option value="category4">category4</option>
						 </select>
        			</div>
        		</div>
        	</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="btnSave" class="btn btn-primary">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="deleteModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Confirm Delete</h4>
      </div>
      <div class="modal-body">
        	Do you want to delete this record?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="btnDelete" class="btn btn-danger">Delete</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
	$(function(){
		showAllTags();

		//Add New
		$('#btnAdd').click(function(){
			$('#myModal').modal('show');
			$('#myModal').find('.modal-title').text('Add New Employee');
			$('#myForm').attr('action', '<?php echo base_url() ?>tag/addTags');
		});


		$('#btnSave').click(function(){
			var url = $('#myForm').attr('action');
			var data = $('#myForm').serialize();
			//validate form
			var tagName = $('input[name=tagName]');
			var tagCategory = $('#tagCategory');
			var result = '';
			if(tagName.val()==''){
				tagName.parent().parent().addClass('has-error');
			}else{
				tagName.parent().parent().removeClass('has-error');
				result +='1';
			}

			if(tagCategory.val()==''){
				tagCategory.parent().parent().addClass('has-error');
			}else{
				tagCategory.parent().parent().removeClass('has-error');
				result +='2';
			}
			if(result=='12'){
				$.ajax({
					type: 'ajax',
					method: 'post',
					url: url,
					data: data,
					async: false,
					dataType: 'json',
					success: function(response){
						if(response.success){
							$('#myModal').modal('hide');
							$('#myForm')[0].reset();
							if(response.type=='add'){
								var type = 'added'
							}else if(response.type=='update'){
								var type ="updated"
							}
							$('.alert-success').html('Tag '+type+' successfully').fadeIn().delay(4000).fadeOut('slow');
							showAllTags();
						}else{
							alert('Error');
						}
					},
					error: function(){
						alert('Could not add data');
					}
				});
			}
		});

		//edit
		$('#showdata').on('click', '.item-view', function(){
			var id = $(this).attr('data');
			$('#myModal_view').modal('show');
			$('#myModal_view').find('.modal-title').text('View Tag');
			// $('#myForm').attr('action', '<?php echo base_url() ?>tag/updateTags');
			$.ajax({
				type: 'ajax',
				method: 'get',
				url: '<?php echo base_url() ?>tag/editTags',
				data: {id: id},
				async: false,
				dataType: 'json',
				success: function(data){
					$('#tagName').html(data.tag_name);
					$('#tagColor').html('<div style="width: 70px;height: 20px; background-color: '+data.tag_color+'"></div>');
					$('#Category').html(data.tag_category);
				},
				error: function(){
					alert('Could not Edit Data');
				}
			});
		});

		//edit
		$('#showdata').on('click', '.item-edit', function(){
			var id = $(this).attr('data');
			$('#myModal').modal('show');
			$('#myModal').find('.modal-title').text('Edit Tag');
			$('#myForm').attr('action', '<?php echo base_url() ?>tag/updateTags');
			$.ajax({
				type: 'ajax',
				method: 'get',
				url: '<?php echo base_url() ?>tag/editTags',
				data: {id: id},
				async: false,
				dataType: 'json',
				success: function(data){
					$('input[name=tagName]').val(data.tag_name);
					$('#tagColor').val(data.tag_color);
					$('#tagCategory').val(data.tag_category);
					$('input[name=txtId]').val(data.id);
				},
				error: function(){
					alert('Could not Edit Data');
				}
			});
		});

		//delete- 
		$('#showdata').on('click', '.item-delete', function(){
			var id = $(this).attr('data');
			$('#deleteModal').modal('show');
			//prevent previous handler - unbind()
			$('#btnDelete').unbind().click(function(){
				$.ajax({
					type: 'ajax',
					method: 'get',
					async: false,
					url: '<?php echo base_url() ?>tag/deleteTags',
					data:{id:id},
					dataType: 'json',
					success: function(response){
						if(response.success){
							$('#deleteModal').modal('hide');
							$('.alert-success').html('Tag has been Deleted successfully').fadeIn().delay(4000).fadeOut('slow');
							showAllTags();
						}else{
							alert('Error');
						}
					},
					error: function(){
						alert('Error deleting');
					}
				});
			});
		});



		//function
		function showAllTags(){
			$.ajax({
				type: 'ajax',
				url: '<?php echo base_url() ?>tag/showAllTags',
				async: false,
				dataType: 'json',
				success: function(data){

					var html = '';
					var i;
					// console.log(data);
					if (data == false) {
						html +='<tr><td colspan="6" style="text-align: center;">No Data Avilable</td></tr>';
						$('#showdata').html(html);
					} else {

						for(i=0; i<data.length; i++){
						
							html +='<tr>'+
										'<td>'+data[i].id+'</td>'+
										'<td>'+data[i].tag_name+'</td>'+
										'<td> <div style="width: 70px;height: 20px; background-color: '+data[i].tag_color+'"> </div></td>'+
										'<td>'+data[i].tag_category+'</td>'+
										'<td>'+data[i].created_at+'</td>'+
										'<td>'+
											'<a href="javascript:;" class="btn btn-info item-view" data="'+data[i].id+'"><i class="fa fa-eye"></i></a>&nbsp'+
											'<a href="javascript:;" class="btn btn-info item-edit" data="'+data[i].id+'"><i class="fa fa-edit"></i></a>&nbsp'+
											'<a href="javascript:;" class="btn btn-danger item-delete" data="'+data[i].id+'"><i class="fa fa-trash"></i></a>'+
										'</td>'+
								    '</tr>';
						}
						$('#showdata').html(html);
					}
				},
				error: function(){
					html +='<tr><td colspan="5">No Data Avilable</td></tr>';
					$('#showdata').html(html);
				}
			});
		}
	});
</script>