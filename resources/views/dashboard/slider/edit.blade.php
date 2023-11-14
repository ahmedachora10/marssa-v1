@extends('dashboard.master')

@section('index')
    current
@endsection

@section('head_tag')
    <style>
        tspan {
            font-family: DINN-Medium;
        }

        .store-item__plan {
            background: #fff url("{{ asset('site/images/bg.png') }}") no-repeat top left;
            background-size: 80% auto;
            box-shadow: 0 3px 12px rgba(0, 0, 0, .05);
            transition: transform .2s;
        }

        .plan1 {
            background: url({{ asset('site/images/sparkles.svg') }}) no-repeat
        }

        .plan2 {
            background: url({{ asset('site/images/plan-plus.png') }}) no-repeat
        }

        .plan3 {
            background: url({{ asset('site/images/falling-star.svg') }}) no-repeat
        }

        .plan2_color {
            color: #764aaf !important;
        }

        .plan3_color {
            color: #55ccfc !important;
        }
    </style>
@endsection

@section('content')

<style>.imagePreview {
    width: 100%;
    height: 180px;
    background-position: center center;
  background:url(http://cliquecities.com/assets/no-image-e3699ae23f866f6cbdf8ba2443ee5c4e.jpg);
  background-color:#fff;
    background-size: cover;
  background-repeat:no-repeat;
    display: inline-block;
  box-shadow:0px -3px 6px 2px rgba(0,0,0,0.2);
}
.btn-primary
{
  display:block;
  border-radius:0px;
  box-shadow:0px 4px 6px 2px rgba(0,0,0,0.2);
  margin-top:-5px;
}
.imgUp
{
  margin-bottom:15px;
}
.del
{
  position:absolute;
  top:0px;
  right:15px;
  width:30px;
  height:30px;
  text-align:center;
  line-height:30px;
  background-color:rgba(255,255,255,0.6);
  cursor:pointer;
}
.imgAdd
{
  width:30px;
  height:30px;
  border-radius:50%;
  background-color:#4bd7ef;
  color:#fff;
  box-shadow:0px 0px 2px 1px rgba(0,0,0,0.2);
  text-align:center;
  line-height:30px;
  margin-top:0px;
  cursor:pointer;
  font-size:15px;
}</style>
   <span><a href="{{ route('dashboard.admin.slider.index')}}" class="btn btn-default ">  
    {{  __('store.all_slider')  }} <i class="fas fa-back"></i></a><span><br>
    
    <div class="row small-spacing" style="margin-top:20px">

 
          
    <div class="container">
        <div class="row">
        <form method="post" enctype="multipart/form-data" action="{{ route('dashboard.admin.slider.update_slider') }}" accept-charset="UTF-8">
        @csrf
        <div class="form-group">
           <lable>Url</labe>
           <input type="hidden" name="id" value="{{ $slider->id}}" class="form-control"> 

          <input type="text" name="link" value="{{ $slider->link}}" class="form-control"> 
        </div>
            <div class="col-sm-6 imgUp">
                <div class="form-group">
                    <div class="imagePreview imgUp" style="display:none"></div>
                    <label class="btn btn-primary btn-lg">
                    {{ __('store.browse_upload_image') }} <input type="file" name="image" class="uploadFile img" value="Upload Photo" style="width: 0px;height: 0px;overflow: hidden;">
                    </label>
                </div>
                

                <div class="form-group">
                 <button type="submit"  class="btn btn-success uplaodbtn" > {{ __('store.upload_imgae') }}</button>
                </div>
            </div>
            <!-- col-2 -->
        </div>
        </form>
        <!-- row -->
    </div>
      



    </div>
@endsection
@section('script')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/autofill/2.3.5/js/dataTables.autoFill.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/autofill/2.3.5/js/autoFill.bootstrap.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.bootstrap.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.colVis.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/3.3.2/js/dataTables.fixedColumns.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.js"></script>
    <script>
  
$(document).on("click", "i.del" , function() {
	$(this).parent().remove();
});
$(function() {
    $(document).on("change",".uploadFile", function()
    {
        $('.imgUp').css("display",'block');
    		var uploadFile = $(this);
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support
 
        if (/^image/.test( files[0].type)){ // only image file
            var reader = new FileReader(); // instance of the FileReader
            reader.readAsDataURL(files[0]); // read the local file
 
            reader.onloadend = function(){ // set image data as background of div
                //alert(uploadFile.closest(".upimage").find('.imagePreview').length);
                 uploadFile.closest(".imgUp").find('.imagePreview').css("background-image", "url("+this.result+")");
            }
        }
      
    });
});</script>
@endsection
