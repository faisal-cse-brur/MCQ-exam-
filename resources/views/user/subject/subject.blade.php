@extends('layouts.StudentLayout')

@section('admincontent')

<div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><marque>Subject</marque></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
  <section class="content">
      <div class="container-fluid">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th scope="col">Subject Name</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
     
      </div>
    </section>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
$(document).ready(function(){

  fatchsubject();
  function fatchsubject()
  {
    $.ajax({
      type:"GET",
      url: '{{route("AllSubject")}}',
      dataType:"json",
      success:function(response){
      $('tbody').html("");
       $.each(response.subject,function(key,item){
        $('tbody').append('<tr>\
              <th><a href="#" class="sendsubject" data-id="'+item.id+'">'+item.subject+'</a></th>\
              <th><a href="#" class="routine" data-id="'+item.id+'">Routine</a></th>\
              </tr>');
       });
      }
    });
  }

$(document).on('click','.sendsubject',function(){
    var id= $(this).attr('data-id');
    
    $.ajax({
      url:"{{route('showchepter')}}",
      type:"GET",
      data:{id:id},
      success:function(data){
        if (data.success==true) {
            window.location.href = "{{url('/chepter')}}";
        }else{
          alert(data.msg);
        }
      }
    });
  });
  $(document).on('click','.routine',function(){
        var id= $(this).attr('data-id');
        $.ajax({
            type: 'GET',
            url: "{{route('pdfroutine')}}",
            data: {'id' : id},
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

});

</script>

@endsection