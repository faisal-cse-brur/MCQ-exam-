@extends('layouts.StudentLayout')

@section('admincontent')
	@php
		$time= explode(':', $exam[0]['time']);
	@endphp
<div class="container">
	<p style="color:black;" class="text-center">Lets start Exam, {{ Auth::user()->name }}</p>
	<h1 class="text-center">{{ $exam[0]['exam_name']}}</h1>
	<h4 class="text-right time">{{ $exam[0]['time']}}</h4>

	@if($success==true)
		@if(count($qna)>0)
		<form class="mb-5" method="post" action="{{route('examSubmit')}}" id="exam_form">
			@csrf
			<input type="hidden" name="exam_id" value="{{ $exam[0]['id']}}">
			@php $questioncount=1; @endphp

			@foreach($qna as $data)
				<div>
				<h5>Q{{$questioncount++}}.  {{$data['question'][0]['question']}}</h5>
				<input type="hidden" name="q[]" value=" {{$data['question'][0]['id']}}">

				<input type="hidden" name="ans_{{$questioncount-1}}" id="ans_{{$questioncount-1}}">

				@php $anscount=1; @endphp

				@foreach($data['answers'] as $answerlist)
					<p><b>{{$anscount++}}.</b><input type="radio" name="radio_{{$questioncount-1}}" class="select_ans" data-id="{{$questioncount-1}}" value="{{$answerlist['id']}}"> {{$answerlist['answer']}}</p>
				@endforeach
				</div>
			@endforeach
			<div class="text-center">
				<input type="submit" name="" class="btn btn-info">
			</div>
		</form>
		@else
			<h3 style="color:red" class="text-center">Questions and Answer Not Available</h3>
		@endif
	@else
		<h3 style="color:red" class="text-center">{{$msg}}</h3>
	@endif
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
$(document).ready(function(){


	$("#examsubmit").on("submit", function(e) {
		  var formData = $(this).serialize();
		  e.preventDefault();
		   
		  $.ajax({
		    url: '{{route("examSubmit")}}',
		    data: formData,
		    type: 'post',
		    success: function(data) {
		       if(data.success==true){
		       
		       }
		       else{
		       	alert(data.msg);
		       }

		    }

		  });
	});

	$(document).on('click','.select_ans',function(){
		var no=$(this).attr('data-id');
		$('#ans_'+no).val($(this).val());
	});

	var time= @json($time);
	$('.time').text(time[0]+':'+time[1]+':00 Left time');

	var seconds=4;
	var hours=parseInt(time[0]);
	var minutes=parseInt(time[1]);

	var timer=setInterval(()=>{

		if (hours==0 && minutes==0 && seconds==0) {
			clearInterval(timer);
			$('#exam_form').submit();
		}


		if (seconds<=0) {
			minutes--;
			seconds=59;
		}
		if (minutes<=0 && hours!=0) {
			hours--;
			minutes=59;
			seconds=59;
		}
		var tempHours=hours.toString().length>1?hours:'0'+hours;
		var tempMinutes=minutes.toString().length>1?minutes:'0'+minutes;
		var tempSeconds=seconds.toString().length>1?seconds:'0'+seconds;

		$('.time').text(tempHours+':'+tempMinutes+':'+tempSeconds+' Left time');
		seconds--;
	},1000);

});
</script>

@endsection