@extends('layouts.AdminLayout')

@section('admincontent')

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Add Subject
</button>

	<table class="table table-bordered">
	  <thead>
	    <tr>
	      <th scope="col">ID</th>
	      <th scope="col">Exam Name</th>
	      <th scope="col">Marks per Question</th>
	      <th scope="col">Total Marks</th>
	       <th scope="col">Negative Marks Per Question</th>
	      <th scope="col">Edit</th>
	      <th scope="col">Delete</th>
	    </tr>
	  </thead>
	  <tbody class="showdata">
	    
	  </tbody>
</table>

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
				  	<input type="hidden" id="edit_marks_id">
				    <input type="text" onkeypress="return  event.charCode>=48 && event.charCode<=57 || event.charCode==46" id="editmarks" name="up_sub" class="form-control">
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



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
$(document).ready(function(){

	fatchExam();
	function fatchExam()
	{
		$.ajax({
			type:"GET",
			url: '{{route("loadmarks")}}',
			dataType:"json",
			success:function(response){
			$('.showdata').html("");
			 $.each(response.exam,function(key,item){
			 	$('.showdata').append('<tr>\
				      <th scope="row">'+item.id+'</th>\
				      <th scope="row">'+item.exam_name+'</th>\
				      <th scope="row">'+item.marks+'</th>\
				      <th scope="row">'+item.marks*item.marks+'</th>\
				      <th scope="row">'+item.negativeMarks+'</th>\
				      <td><button type="button" value="'+item.id+'" class="edit_marks btn btn-primary">Edit</button></td>\
				  </tr>');
			 });
			}
		});
	}

	$(document).on('click','.edit_marks',function(e){
		e.preventDefault();
		var exam_id=$(this).val();
		$("#editModal").modal('show');
		$.ajax({
			type:"GET",
			url:"/editMarks/"+exam_id,
			success:function(response){
				if (response.status==200) {
					$('#editmarks').val(response.marks.marks);
					$('#edit_marks_id').val(response.marks.id);
				}
			}
		});
	});

//Update

// $(document).on('click','.update_subject_btn',function(e){
// 		e.preventDefault();
// 			var sub_id=$("#edit_marks_id").val();
// 			var data={
// 				'subject':$('#editmarks').val()
// 			}
// 			$.ajaxSetup({
// 			  headers: {
// 			    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
// 			  }
// 			});
// 			$.ajax({
// 				type:"POST",
// 				url:"/updateMarks/"+sub_id,
// 				data: data,
// 				dataType:"json",
// 				success: function(response){
// 					if(response.status==200){
// 						$("#editModal").modal('hide');
// 						fatchsubject();
// 						console.log(response.subject);
// 					}
// 				}
// 			});
// 	});



});

</script>
@endsection
<!--  -->