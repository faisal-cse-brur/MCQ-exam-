@extends('layouts.AdminLayout')

@section('admincontent')

<h2>Review Exam</h2>

	<table class="table table-bordered">
	  <thead>
	    <tr>
	      <th scope="col">ID</th>
	      <th scope="col">Student Name</th>
	      <th scope="col">Exam Name</th>
	      <th scope="col">Status</th>
	      <th scope="col">Review</th>
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
	        <h5 class="modal-title" id="exampleModalLabel">Review & Aprrove</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <form id="reviewForm">
	      	@csrf
	      	<input type="text" id="attempt_id" name="attempt_id">
		      <div class="modal-body reviewExam">
				  <div class="form-group">
				   
				  </div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        <button type="submit" class="update_subject_btn btn btn-primary">Approve</button>
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
			url: '{{route("examReview")}}',
			dataType:"json",
			success:function(response){
			$('.showdata').html("");
			 $.each(response.attempt,function(key,item){
			 	$('.showdata').append('<tr>\
				      <th scope="row">'+item.id+'</th>\
				      <th scope="row">'+item.user.name+'</th>\
				      <th scope="row">'+item.exam.exam_name+'</th>\
				      <th scope="row">'+item.status+'</th>\
				      <td><button type="button" value="'+item.id+'" class="edit_marks btn btn-primary">Review & Aprove</button></td>\
				  </tr>');
			 });
			}
		});
	}

	$(document).on('click','.edit_marks',function(e){
		e.preventDefault();
		var id=$(this).val();
		$("#attempt_id").val(id);

		$("#editModal").modal('show');
		$.ajax({
			type:"GET",
			url:"/reviewqna/"+id,
			success:function(response){
				var html='';

				if (response.status==true) {
					var data=response.attemptData;
					
					if (data.length>0) {
						for (let i = 0; i < data.length; i++) {

							let isCorrect='';

							if (data[i]['answers']['is_correct']==1) {
								isCorrect=`<i class="fa fa-check" aria-hidden="true"></i>`;
							}else{
							    isCorrect=`<i style="color:red;" class="fa fa-times" aria-hidden="true"></i>`;
							}



							html+=`

							<div class="row">
								<div class="col-sm-12">
									<h6>Q(`+(i+1)+`). `+data[i]['question']['question']+`</h6>
									<p>Ans:- `+data[i]['answers']['answer']+` `+isCorrect+`</p>
							    </div>
							</div>
							`;
						}
					}
					else{
						html+=`<h6>Student not attempt any Question</h6> <p> If you this Exam Student will fail`;
					}
				}
				else{
					html+=`<p>Somthing Went Wrong</p>`;
				}
				$('.reviewExam').html(html);
			}
		});
	});

	//Aprove

	$("#reviewForm").submit(function(event){
		event.preventDefault();
		var formDate=$(this).serialize();

		$.ajax({
			url:"{{route('approveQna')}}",
			type:"POST",
			data:formDate,
			success:function(data){
				if (data.success==true) {
					location.reload();
				}
				else{
					alert(data);
				}
			}
		});
	});

});

</script>
@endsection
<!--  -->