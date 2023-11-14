@extends('layouts.StudentLayout')

@section('admincontent')


    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><marque>Routine List</marque></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
          	<div class="text-center pdf-btn">
		        <button type="button" class="btn btn-dark download-pdf">Download PDF</button>
		    </div>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
	<section class="content">
      <div class="container-fluid">
      	<p>
		  <a class="btn btn-primary" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Toggle first element</a>
		  <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#multiCollapseExample2" aria-expanded="false" aria-controls="multiCollapseExample2">Toggle second element</button>
		</p>
		<div class="row">
		  <div class="col-md-12">
		    <div class="collapse multi-collapse" id="multiCollapseExample1">
		      <div class="card card-body">
		      	<table class="table table-bordered">
				  <thead>
				  	 <th scope="col" colspan="4" class="text-center text-color-danger">Subject Name</th>
				    <tr>
				      <th scope="col">Sl No.</th>
				      <th scope="col">Exam Name</th>
				      <th scope="col">Date</th>
				      <th scope="col">Time</th>
				    </tr>
				  </thead>
				  <tbody>
				    <tr>
				      <th scope="row">1</th>
				      <td>Mark</td>
				      <td>Otto</td>
				      <td>@mdo</td>
				    </tr>
				    <tr>
				      <th scope="row">2</th>
				      <td>Jacob</td>
				      <td>Thornton</td>
				      <td>@fat</td>
				    </tr>
				  </tbody>
				</table>
		      </div>
		    </div>
		  </div>
		  <div class="col-md-12">
		    <div class="collapse multi-collapse" id="multiCollapseExample2">
		      <div class="card card-body">
		        <table class="table table-bordered">
				   <th scope="col" colspan="4" class="text-center text-color-danger">Subject Name</th>
				    <tr>
				      <th scope="col">Sl No.</th>
				      <th scope="col">Exam Name</th>
				      <th scope="col">Date</th>
				      <th scope="col">Time</th>
				    </tr>
				  <tbody>
				    <tr>
				      <th scope="row">1</th>
				      <td>Mark</td>
				      <td>Otto</td>
				      <td>@mdo</td>
				    </tr>
				    <tr>
				      <th scope="row">2</th>
				      <td>Jacob</td>
				      <td>Thornton</td>
				      <td>@fat</td>
				    </tr>
				  </tbody>
				</table>
		      </div>
		    </div>
		  </div>
		</div>

    </section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
    $(".download-pdf").click(function(){
        var data = '';
        $.ajax({
            type: 'GET',
            url: "{{route('pdfroutine')}}",
            data: data,
            xhrFields: {
                responseType: 'blob'
            },
            success: function(response){
                var blob = new Blob([response]);
                var link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.download = "techsolutionstuff.pdf";
                link.click();
            },
            error: function(blob){
                console.log(blob);
            }
        });
    });

</script>
@endsection