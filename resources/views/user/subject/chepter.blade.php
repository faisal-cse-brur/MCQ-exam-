@extends('layouts.StudentLayout')

@section('admincontent')

<div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><marque>Chepter</marque></h1>
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
              <th scope="col">Chepter Name</th>
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
      url: '{{route("showchepter")}}',
      dataType:"json",
      success:function(response){
      $('tbody').html("");
       $.each(response.chepter,function(key,item){
        $('tbody').append('<tr>\
              <th><a href="#" class="sendsubject" data-id="'+item.id+'">'+item.exam_name+'</a></th>\
              <th> <a href="#" class="copy" data-code="'+item.enterance_id+'"><i class="fa fa-copy"></i></a></th>\
              </tr>');
       });
      }
    });
  }

  $(document).on('click','.copy',function(e){

      $(this).parent().prepend('<span class="copid_text">Copid</span>');

      var code=$(this).attr('data-code');
      var url="{{URL::to('/')}}/exam/"+code;

      var $temp=$("<input>");
      $("body").append($temp);
      $temp.val(url).select();
      document.execCommand("copy");
      $temp.remove();

      setTimeout(()=>{
        $('.copid_text').remove();
      },1000);
  });
});

</script>

@endsection