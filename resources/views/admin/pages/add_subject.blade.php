@extends('layouts.AdminLayout')

@section('admincontent')

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Add Subject
</button>

<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">Name</th>
      <th scope="col">Edit</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>
     
  </tbody>
</table>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Add Subject</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <form id="subjectadd">
	      	@csrf
		      <div class="modal-body">
				  <div class="form-group">
				    <input type="text" name="subject" class="form-control">
				  </div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        <button type="submit" class="btn btn-primary">Add</button>
		      </div>
	  	  </form>
	    </div>
	</form>
  </div>
</div>

<!--Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Update Subject</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <form id="editsubject">
	      	@csrf
		      <div class="modal-body">
				  <div class="form-group">
				  	<input type="hidden" id="edit_subject_id">
				    <input type="text" id="editsubjectname" name="up_sub" class="form-control">
				  </div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        <button type="submit" class="update_subject_btn btn btn-primary">Update</button>
		      </div>
	  	  </form>
	    </div>
	</form>
  </div>
</div>

<!--DELETE Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Delete Subject</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <form>
	      	@csrf
		      <div class="modal-body">
		      	<input type="hidden" id="delete_subject_id">
				 <p class="text-danger">Are you sure delete this subject?</p>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        <button type="submit" class="delete_subject_btn btn btn-primary">Delete</button>
		      </div>
	  	  </form>
	    </div>
	</form>
  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
$(document).ready(function(){

	fatchsubject();
	function fatchsubject()
	{
		$.ajax({
			type:"GET",
			url: '{{route("showSubject")}}',
			dataType:"json",
			success:function(response){
			$('tbody').html("");
			 $.each(response.subject,function(key,item){
			 	$('tbody').append('<tr>\
				      <th scope="row">'+item.id+'</th>\
				      <td>'+item.subject+'</td>\
				      <td><button type="button" value="'+item.id+'" class="edit_subject btn btn-primary">Edit</button></td>\
				      <td><button type="button" value="'+item.id+'" class="delete_subject btn btn-danger">Delete</button></td>\</tr>');
			 });
			}
		});
	}

	$("#subjectadd").on("submit", function(e) {
	  var formData = $(this).serialize();
	  e.preventDefault();
	   $('#exampleModal').modal('hide');
	  $.ajax({
	    url: '{{route("storeSubject")}}',
	    data: formData,
	    type: 'post',
	    success: function(data) {
	       if(data.success==true){
	       	fatchsubject();
	       }
	       else{
	       	alert(data.msg);
	       }

	    }

	  });
  //Return false to cancel submit
  return false;
});

	$(document).on('click','.edit_subject',function(e){
		e.preventDefault();
		var subject_id=$(this).val();
		$("#editModal").modal('show');
		$.ajax({
			type:"GET",
			url:"/editSubject/"+subject_id,
			success:function(response){
				if (response.status==200) {
					$('#editsubjectname').val(response.subject.subject);
					$('#edit_subject_id').val(response.subject.id);
				}
			}
		});
	});

//Update

$(document).on('click','.update_subject_btn',function(e){
		e.preventDefault();
			var sub_id=$("#edit_subject_id").val();
			var data={
				'subject':$('#editsubjectname').val()
			}
			$.ajaxSetup({
			  headers: {
			    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			  }
			});
			$.ajax({
				type:"POST",
				url:"/updateSubject/"+sub_id,
				data: data,
				dataType:"json",
				success: function(response){
					if(response.status==200){
						$("#editModal").modal('hide');
						fatchsubject();
						console.log(response.subject);
					}
				}
			});
	});


// Delete
	$(document).on('click','.delete_subject',function(e){
		e.preventDefault();
		var subject_id=$(this).val();
		$('#delete_subject_id').val(subject_id);
		$("#deleteModal").modal('show');
	});

	$(document).on('click','.delete_subject_btn',function(e){
		e.preventDefault();

		var sub_id=$('#delete_subject_id').val();

		$.ajaxSetup({
		  headers: {
		    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		  }
		});

		$.ajax({
			type:"DELETE",
			url:"/deleteSubject/"+sub_id,
			success:function(response){
				$('#deleteModal').modal('hide');
				fatchsubject();
			}

		});

	});


});

</script>
@endsection
<!--  -->