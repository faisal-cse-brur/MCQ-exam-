@extends('layouts.AdminLayout')

@section('admincontent')

<!-- Button trigger modal -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Add Q&A
</button>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ImportModal">
  Import Q&A
</button>

<table class="table table-bordered">
	  <thead>
	    <tr>
	      <th scope="col">ID</th>
	      <th scope="col">Question</th>
	      <th scope="col">Answer</th>
	      <th scope="col">Edit</th>
	      <th scope="col">Delete</th>
	    </tr>
	  </thead>
	  <tbody class="showQuestions">
	    
	  </tbody>
</table>

<!--Show add Q&A Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Add Exam</h5>
	        <button id="addanswer" class="ml-5 btn btn-info">Add Answer</button>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <form id="Questionadd">
	      	@csrf
		      <div class="modal-body addModelAnswer">
				    <div class="row">
				    	<div class="col">
				    		<input type="text" class="w-100" placeholder="Enter question" name="question" required>
				    	</div>
				    </div>
				    <div class="row">
				    		<div class="col-md-2 mt-3">
					    		<select class="form-select" name="institude">
								  <option selected>Select University</option>
								  <option value="DU">DU</option>
								  <option value="GST">GST</option>
								  <option value="CU">CU</option>
								  <option value="JU">JU</option>
								  <option value="RU">RU</option>
								  <option value="Madical">Medical</option>
								</select>
				    		</div>
				    </div>
		      </div>
		      <div class="modal-footer">
		      	<span class="error" style="color:red;"></span>
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        <button type="submit" class="btn btn-primary">Add</button>
		      </div>
	  	  </form>
	    </div>
  </div>
</div>

<!-- Edit Q&A Model -->

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Update Exam</h5>
	        <button id="addEditAnswer" class="ml-5 btn btn-info">Add Answer</button>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <form id="editQuestionAns">
	      	@csrf
		      <div class="modal-body editModelAnswers">
				    <div class="row">
				    	<div class="col">
				    		<input type="hidden" name="question_id" id="question_id">
				    		<input type="text" class="w-100" id="question" placeholder="Enter question" name="question" required>
				    	</div>
				    </div>
		      </div>
		      <div class="modal-footer">
		      	<span class="editError" style="color:red;"></span>
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        <button type="submit" class="btn btn-primary">Update</button>
		      </div>
	  	  </form>
	    </div>
  </div>
</div>


<!-- Retrive Answer Model -->

<div class="modal fade" id="showAnsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Show Answer</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
		      <div class="modal-body">
		      	<table class="table">
		      		<thead>
		      			<th>#</th>
		      			<th>Answer</th>
		      			<th>Is Correct</th>
		      		</thead>
		      		<tbody class="showAnswers">
		      			
		      		</tbody>
		      	</table>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		      </div>
	    </div>
  </div>
</div>

<!-- DELETE MODEL -->

<div class="modal fade" id="deleteQnAModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Delete Q&A</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <form id="deleteQna">
	      	@csrf
		      <div class="modal-body">
		      	<input type="hidden" id="delete_qna_id" name="id">
				 <p class="text-danger">Are you sure delete Q&A?</p>
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

<!-- IMPORT Q&A -->

<div class="modal fade" id="ImportModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Import Q&A</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <form id="importQna" method="POST" action="{{route('importQna')}}" enctype="multipart/form-data">
	      	@csrf
		      <div class="modal-body">
		      	<input type="file" name="file" id="fileupload" required  accept=".csv,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms.excel">
		      	
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        <button type="submit" class="btn btn-primary">Import Q&A</button>
		      </div>
	  	  </form>
	    </div>
	</form>
  </div>
</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
$(document).ready(function(){

	$("#Questionadd").on("submit", function(e) {
		 e.preventDefault();
		 if($(".answers").length<2){
		 	$(".error").text("Please add minimum two answer")
		 	setTimeout(function(){
		 		$(".error").text("");
		 	},2000);
		 } else{
		 		var checkIscorrect= false;
		 		for(let i=0; i<$(".is_correct").length; i++){
		 			if($(".is_correct:eq("+i+")").prop('checked')==true){
		 				checkIscorrect=true;
		 				$(".is_correct:eq("+i+")").val($(".is_correct:eq("+i+")").next().find('input').val());
		 			}
		 		}
		 		if(checkIscorrect){
		 			var formData = $(this).serialize();
		 			$.ajax({
		 				url:"/storeQuestion",
		 				type:"POST",
		 				data:formData,
		 				dataType:"json",
		 				success:function(response){
		 					if(response.success==true){
		 					fatchQuestion();
		 					$('#exampleModal').modal('hide');
		 					}
		 					else{
		 						$(".error").text(response.msg);
		 					}
		 				}
		 			});

		 		}
		 		else{
		 			$(".error").text("Please select any one correct answer")
		 			setTimeout(function(){
				 		$(".error").text("");
				 	},2000);
		 		}
		 }
	});
// Add answer

	$("#addanswer").click(function(){
		if($(".answers").length>=5){
		 	$(".error").text("You can miximum five answer")
		 	setTimeout(function(){
		 		$(".error").text("");
		 	},2000);
		 } 
		else{
			var html=`
			 <div class="row mt-2 answers">
			 	<input type="radio" name="is_correct" class=is_correct>
				<div class="col">
				   <input type="text" class="w-100" placeholder="Enter answer"   name="answers[]" required>
				</div>
				    	<button class="btn btn-danger AnsRemoveBtn">Remove</button>
				    </div>
		`;
		$(".addModelAnswer").append(html);

		}
	});

	$(document).on("click",".AnsRemoveBtn",function(e){
		$(this).parent().remove();
	});

// Show answer


// Show Question

	fatchQuestion();
	function fatchQuestion()
	{
		$.ajax({
			type:"GET",
			url: '{{route("showQuestion")}}',
			dataType:"json",
			success:function(response){
			$('.showQuestions').html("");
			 $.each(response.questions,function(key,item){
			 	$('.showQuestions').append('<tr>\
				      <th scope="row">'+item.id+'</th>\
				      <th scope="row">'+item.question+'</th>\
				      <td><button type="button" value="'+item.id+'" class="Ansbtn btn btn-primary" data-toggle="modal" data-target="#showAnsModal">Show Ans</button></td>\
				      <td><button type="button" value="'+item.id+'" class="editbtn btn btn-primary" data-toggle="modal" data-target="#editModal">Edit</button></td>\
				      <td><button type="button" value="'+item.id+'" class="deleteQnabtn btn btn-danger">Delete</button></td>\</tr>');
			 });
			}
		});
	}

	$(document).on('click','.Ansbtn',function(e){
		e.preventDefault();
	    var question_id=$(this).val();
	 	var html='';
	 	$.ajax({
	 		type:"GET",
			url:"/showQuestion",
			success:function(response){
				var questions=response.questions;
				for (let i = 0; i < questions.length; i++) {

					if(questions[i]['id']==question_id){

						var anserLength=questions[i]['answers_method'].length;
						for (let j = 0; j < anserLength; j++) {

							let is_correct='No';

							if(questions[i]['answers_method'][j]['is_correct']==1){
								is_correct='YES';
							}

							html +=`
								<tr>
									<td>`+(j+1)+`</td>
									<td>`+questions[i]['answers_method'][j]['answer']+`</td>
									<td>`+is_correct+`</td>
								</tr>
							


							`;
						}
						break;
					}
				}

				// append data
				$('.showAnswers').html(html);
			}
	 	});
	});


	// Edit Q&A

	$("#addEditAnswer").click(function(){
		if($(".editAnswers").length>=5){
		 	$(".editError").text("You can miximum five answer")
		 	setTimeout(function(){
		 		$(".editError").text("");
		 	},2000);
		 } 
		else{
			var html=`
			 <div class="row mt-2 editAnswers">
			 	<input type="radio" name="is_correct" class="edit_is_correct">
				<div class="col">
				   <input type="text" class="w-100" placeholder="Enter answer"   name="new_answers[]" required>
				</div>
				    	<button class="btn btn-danger AnsRemoveBtn">Remove</button>
				    </div>
		`;
		$(".editModelAnswers").append(html);

		}
	});

	$(document).on("click",".editbtn",function(e){
		e.preventDefault();
	    var qid=$(this).val();
	     $.ajax({
	    	url:"{{route('getQuestionDetails')}}",
	    	type:"GET",
	    	data:{qid:qid},
	    	success:function(data){
	    		
	    		var qna=data.data[0];
	    		
	    		$("#question_id").val(qna['id']);
	    		$("#question").val(qna['question']);
	    		$(".editAnswers").remove();
	    		var html='';
	    		for (let i = 0; i < qna['answers_method'].length; i++) {
	    			    
	    			var checked='';
	    			if(qna['answers_method'][i]['is_correct']==1){
	    				checked='checked';
	    			}

	    			 html +=`
					 <div class="row mt-2 editAnswers">
					 	<input type="radio" name="edit_is_checked" class="edit_is_checked" `+checked+`>
						<div class="col">
						   <input type="text" class="w-100" placeholder="Enter answer"   name="answers[`+qna['answers_method'][i]['id']+`]" value="`+qna['answers_method'][i]['answer']+`" required>
						</div>
						    	<button class="btn btn-danger AnsRemoveBtn" data-id="`+qna['answers_method'][i]['id']+`">Remove</button>
						    </div>
				`;

	    			}	 
	    	$(".editModelAnswers").append(html);   		
	    	}
	    });

	});

	// Update Q&A
$("#editQuestionAns").on("submit", function(e) {
		 e.preventDefault();
		 if($(".editAnswers").length<2){
		 	$(".editError").text("Please add minimum two answer")
		 	setTimeout(function(){
		 		$(".editError").text("");
		 	},2000);
		 } else{
		 		var checkIscorrect= false;
		 		for(let i=0; i<$(".edit_is_checked").length; i++){
		 			if($(".edit_is_checked:eq("+i+")").prop('checked')==true){
		 				checkIscorrect=true;
		 				$(".edit_is_checked:eq("+i+")").val($(".edit_is_checked:eq("+i+")").next().find('input').val());
		 			}
		 		}
		 		if(checkIscorrect){
		 			 var formData=$(this).serialize();
				 	$.ajax({
					 	url:"{{route('updateQnA')}}",
					 	type:"POST",
					 	data:formData,
					 	success:function(data){
				 		console.log(data);
				 		if(data.success==true){
				 			// fatchQuestion();
				 			alert("success");
				 		}
				 		else{
				 			alert(data.msg);
				 		}
					 }
				 });
		 		}
		 		else{
		 			$(".error").text("Please select any one correct answer")
		 			setTimeout(function(){
				 		$(".error").text("");
				 	},2000);
		 		}
		 }
	});
	$(document).on("click",".AnsRemoveBtn",function(){
		 var ansId=$(this).attr('data-id');
		 $.ajax({
		 	url:"{{route('deleteAnswer')}}",
		 	type:"GET",
		 	data:{id:ansId},
		 	success:function(data){
		 		if(data.success==true){
		 			fatchQuestion();	
		 		}
		 	}
		 });
	});

	$(document).on("click",".deleteQnabtn",function(e){
		e.preventDefault();
		var id=$(this).val();
		$("#deleteQnAModal").modal('show');
		$("#delete_qna_id").val(id);
	});

	$(document).on("click","#deleteQna",function(e){
		e.preventDefault();

		var qna_id=$('#delete_qna_id').val();

		$.ajaxSetup({
		  headers: {
		    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		  }
		});

		$.ajax({
			type:"POST",
			url:"/deleteQna/"+qna_id,
			success:function(response){
				console.log(response);
				
			}

		});
	});

// IMPORT Q&A

// $("#importQna").on("submit", function(e) {

// 	let formData=new FormData();
// 	formData.append("file",fileupload.files[0]);

// 	$.ajaxSetup({
// 		  headers: {
// 		    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
// 		  }
// 		});

// 		$.ajax({
// 			url:"/importQna",
// 		 	type:"POST",
// 		 	data:formData,
// 		 	dataType:"json",
// 			processData:false,
// 			contentType:false,
// 			success:function(response){
// 				if(response.success==true){
// 					alert("INSERT");
// 				}
// 				else{
// 					alert("Fail");
// 				}
				
// 			}

// 		});
// 	});

	
});
</script>
@endsection
<!--  -->