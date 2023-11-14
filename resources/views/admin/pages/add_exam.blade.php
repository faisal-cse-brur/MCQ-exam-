@extends('layouts.AdminLayout')

@section('admincontent')
<div>
	<!-- Button trigger modal -->
	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
	  Add Exam
	</button>

	<table class="table table-bordered">
	  <thead>
	    <tr>
	      <th scope="col">ID</th>
	      <th scope="col">Exam Name</th>
	      <th scope="col">Subject Name</th>
	      <th scope="col">Time</th>
	      <th scope="col">Date</th>
	      <th scope="col">Attemp</th>
	      <th scope="col">Add Questions</th>
	      <th scope="col">Show Questions</th>
	      <th scope="col">Edit</th>
	      <th scope="col">Delete</th>
	    </tr>
	  </thead>
	  <tbody class="showdata">
	    
	  </tbody>
</table>

	<!-- Modal -->
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Add Exam</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <form id="Examadd">
		      	@csrf
			      <div class="modal-body">
					  <div class="form-group">
					    <input type="text" placeholder="Enter Exam Name" name="exam_name" class="form-control" required>
					    <br>
					
						<select id="subject_name" class="w-100" name="subject_id" required> </select>
						<br><br>
						<input type="date" name="date" class="w-100" required min="<?php echo date('Y-m-d');  ?>">
						<br><br>
						<input type="time" name="time" class="w-100" required>
						<br><br>
						<input type="number" name="attempt" placeholder="Enter attemp time" min="1" class="w-100" required>
					  </div>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			        <button type="submit" class="btn btn-primary">Add</button>
			      </div>
		  	  </form>
		    </div>
	  </div>
	</div>

	<!-- DELETE MODEL -->
	<div class="modal fade" id="deleteExamModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Delete Q&A</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <form>
		      	@csrf
			      <div class="modal-body">
			      	<input type="hidden" id="delete_Exam_id" name="delete_Exam_id">
					 <p class="text-danger">Are you sure delete Q&A?</p>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			        <button type="submit" class="delete_Exam_btn btn btn-primary">Delete</button>
			      </div>
		  	  </form>
		    </div>
	  </div>
	</div>

	<!-- Add Answers Model -->
	<div class="modal fade" id="add_question_Model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Add Q&A</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <form id="addQna">
		      	@csrf
			      <div class="modal-body">
			      	<input type="hidden" name="exam_id" id="addExamId">
			      	<br><br>
			      	<input type="search" name="search" id="search" onkeyup="searchTable()" class="w-100" placeholder="Search Here">
			      	<table class="table" id="questionsTable">
			      		<thead>
			      			<th>Select</th>
			      			<th>Question</th>
			      			<th>Institude</th>
			      		</thead>
			      		<tbody class="addBody">
			      			
			      		</tbody>
			      	</table>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			        <button type="submit" class="add_Qna_btn btn btn-primary">Add Q&A</button>
			      </div>
		  	  </form>
		    </div>
	  </div>
	</div>

	<!-- See QnA Model -->

		<!-- Add Answers Model -->
	<div class="modal fade" id="see_Qna_Model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Show Q&A</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
			  <div class="modal-body">
			      	<table class="table" >
			      		<thead>
			      			<th>SL NO.</th>
			      			<th>Question</th>
			      			<th>Institude</th>
			      		</thead>
			      		<tbody class="seeQuestionTable">
			      			
			      		</tbody>
			      	</table>
			   </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			      </div>
		    </div>
	  </div>
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
			$('#subject_name').html("");
			 $.each(response.subject,function(key,item){
			 	$('#subject_name').append('<option value=' + item.id + '>' + item.subject + '</option>');
			 });
			}
		});
	}

	fatchExam();
	function fatchExam()
	{
		$.ajax({
			type:"GET",
			url: '{{route("showExam")}}',
			dataType:"json",
			success:function(response){
			$('.showdata').html("");
			 $.each(response.exam,function(key,item){
			 	$('.showdata').append('<tr>\
				      <th scope="row">'+item.id+'</th>\
				      <td>'+item.exam_name+'</td>\
				      <td>'+item.subjects_method[0].subject+'</td>\
				      <td>'+item.date+'</td>\
				      <td>'+item.time+' Hrs</td>\
				      <td>'+item.attempt+' Time</td>\
				      <td><button type="button" value="'+item.id+'" class="addQuestion btn btn-success">Add Qestions</button></td>\
				      <td><button type="button" value="'+item.id+'" class="seeQnA btn btn-success">Show Question</button></td>\
				      <td><button type="button" value="'+item.id+'" class="edit_subject btn btn-primary">Edit</button></td>\
				      <td><button type="button" value="'+item.id+'" class="delete_exam btn btn-danger">Delete</button></td>\</tr>');
			 });
			}
		});
	}

	$("#Examadd").on("submit", function(e) {
	  var formData = $(this).serialize();
	  e.preventDefault();
	   $('#exampleModal').modal('hide');
	  $.ajax({
	    url: '{{route("storeExam")}}',
	    data: formData,
	    type: 'post',
	    dataType:"json",
	    success: function(response) {
	       if(response.success==true){
	       	 fatchExam();
	       }
	       else{
	       	alert(response.msg);
	       }

	    }

	  });
  //Return false to cancel submit
  return false;
});

	$(document).on('click','.edit_Exam',function(e){
		e.preventDefault();
		var Exam_id=$(this).val();
		$("#editModal").modal('show');
		$.ajax({
			type:"GET",
			url:"/editExam/"+Exam_id,
			success:function(response){
				if (response.status==200) {
					$('#editExamname').val(response.Exam.Exam);
					$('#edit_Exam_id').val(response.Exam.id);
				}
			}
		});
	});

//Update

$(document).on('click','.update_Exam_btn',function(e){
		e.preventDefault();
			var exam_id=$("#edit_Exam_id").val();
			var data={
				'Exam':$('#editExamname').val()
			}
			$.ajaxSetup({
			  headers: {
			    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			  }
			});
			$.ajax({
				type:"POST",
				url:"/updateExam/"+exam_id,
				data: data,
				dataType:"json",
				success: function(response){
					if(response.status==200){
						$("#editModal").modal('hide');
						fatchExam();
						console.log(response.Exam);
					}
				}
			});
	});


// Delete
	$(document).on('click','.delete_exam',function(e){
		e.preventDefault();
		var Exam_id=$(this).val();
		$('#delete_Exam_id').val(Exam_id);
		$("#deleteExamModal").modal('show');
	});

	$(document).on('click','.delete_Exam_btn',function(e){
		e.preventDefault();

		var exam_id=$('#delete_Exam_id').val();

		$.ajaxSetup({
		  headers: {
		    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		  }
		});

		$.ajax({
			type:"POST",
			url:"/deleteExam/"+exam_id,
			success:function(response){
				$('#deleteExamModal').modal('hide');
				fatchExam();
			}

		});

	});

	// $(document).on('click','.addQuestion',function(e){
	// 	e.preventDefault();
	// 	var Exam_id=$(this).val();
	// 	$('#exam_id').val(Exam_id);
	// 	$("#add_question_Model").modal('show');
	// });

// Add Question part

	$(document).on('click','.addQuestion',function(e){
		e.preventDefault();
		var id=$(this).val();
		$('#addExamId').val(id);
		$("#add_question_Model").modal('show');

		$.ajax({
			url:"{{route('getQuestions')}}",
			type:"GET",
			data:{exam_id:id},
			success:function(data){
				if (data.success==true) {

					var questions=data.data;
					var html='';
					if (questions.length>0){
						for (var i = 0; i < questions.length; i++) {
							html+=`
						<tr>
							<td>
							<input type="checkbox" value="`+questions[i]['id']+`" name="questions_ids[]">
							</td>
							<td>`+questions[i]['questions']+`</td>
							<td>`+questions[i]['institudes']+`</td>
						</tr>`;
						}

					}else{
						html+=`
						<tr>
							<td colspan="2">Questins not Available!</td>
						</tr>`;
					}
					$('.addBody').html(html);
				}else{
					alert(data.msg);
				}
			}
		})
	});

	$("#addQna").on("submit", function(e) { 
		  e.preventDefault();
		  var formData = $(this).serialize();

		  $.ajax({
		    url: '{{route("addQuestions")}}',
		    data: formData,
		    type: 'POST',
		    dataType:"json",
		    success: function(data) {
		       if(data.success==true){
		       	 location.reload();
		       }
		       else{
		       	alert(data.msg);
		       }

		    }

		  });
	  return false;
	});

	// Swho QnA

	$(document).on('click','.seeQnA',function(e){
		e.preventDefault();
		var id=$(this).val();
		// $('#addExamId').val(id);
		$("#see_Qna_Model").modal('show');

		$.ajax({
			url:"{{route('getExamQuestions')}}",
			type:"GET",
			data:{exam_id:id},
			success:function(data){
				if (data.success==true) {

					var questions=data.data;
					var html='';
					if (questions.length>0){
						for (var i = 0; i < questions.length; i++) {
							html+=`
						<tr>
						<td>`+(i+1)+`</td>
							<td>`+questions[i]['question'][0]['question']+`</td>
							<td>`+questions[i]['question'][0]['institude']+`</td>
							<td>
								<button class="btn btn-danger deleteQuestion" data-id="`+questions[i]['id']+`">Delete</button>
							</td>
							
						</tr>`;
						}

					}
					else{
						html+=`
						<tr>
							<td colspan="1">Questins not Available!</td>
						</tr>`;
					}
					$('.seeQuestionTable').html(html);
				}else{
					alert(data.msg);
				}
			}
		})
	});

	$(document).on('click','.deleteQuestion',function(){
		var id= $(this).attr('data-id');
		var parent_data=$(this);
		$.ajax({
			url:"{{route('deleteExamQuestions')}}",
			type:"GET",
			data:{id:id},
			success:function(data){
				if (data.success==true) {
					parent_data.parent().parent().remove();
				}else{
					alert(data.msg);
				}
			}
		});
	});
	
});

</script>
<script type="text/javascript">

	function searchTable(){
		var input, filter,table,tr,td,i,txtValue;
		input=document.getElementById('search');
		filter= input.value.toUpperCase();
		table= document.getElementById('questionsTable');
		tr=table.getElementsByTagName("tr");
		for(i=0; i<tr.length; i++){
			td = tr[i].getElementsByTagName("td")[1];
			if (td) {
				txtValue= td.textContent || td.innerText;
				if (txtValue.toUpperCase().indexOf(filter)>-1) {
					tr[i].style.display="";
				}else{
					tr[i].style.display="none";
				}
			}
		}

	}
</script>


@endsection
<!--  -->