@extends('Store.master_5')

@php 
$now    = new Carbon\Carbon();
$start  = new Carbon\Carbon($competiton->start_date);
$end    = new Carbon\Carbon($competiton->end_date);
$select_countdown    = new Carbon\Carbon( $now->lt($start) ? $start : $competiton->end_date);

@endphp
@section('content')
    <section class="blog-details">
        <br/>
        <div class="container">
            <div class="row" style="display: block;">
                <div class="details-competition d-flex">
                    <div class="competition-thumbnail">
                        <img src="{{ asset($competiton->thumbnails ? $competiton->thumbnails[0] : ($competiton->images ? $competiton->images[0]:null )) }}" />
                        <div class="top-details-competition d-flex">
                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModalCenter">
                              فيديو تعريفي للمسابقة
                            </button>
                            @if($competiton->condition_type == 'buy_products')
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#CheckModalCenter">
                                    التأكد من وجودك فى المسابقة
                                </button>
                            @endif
                        </div>
                        <div class="description">
                            <h5>تفاصيل المسابقة</h5>
                            <div class="inner-description">
                                {!! $competiton->description !!}
                            </div>
                        </div>
                    </div>
                    <div class="competition-detials">
                        
                        @if($now->lt($end) && (!$competiton->winner || $competiton->winner->isEmpty()) && (!$competiton->winner_visits_links || $competiton->winner_visits_links->isEmpty()) )
                            <div class="countdown-competition">
                                <div class="container">
                                    @if($now->lt($start))
                                        <h5>موعد بدء المسابقة</h5>
                                    @else
                                        <h5>موعد انتهاء المسابقة</h5>
                                    @endif
                                    <br/>
                                    <div id="countdown">
                                        <ul>
                                          <li><span id="days"></span>يوم</li>
                                          <li><span id="hours"></span>ساعة</li>
                                          <li><span id="minutes"></span>دقيقة</li>
                                          <li><span id="seconds"></span>ثانية</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @else
                           <div class="countdown-competition" style="background-color: #009688;">
                                <div class="container">
                                    <h5>
                                       مسابقة منتهية    
                                    </h5>
                                    
                                </div>
                            </div>
                        @endif
                        @if(($competiton->winner && $competiton->winner->isNotEmpty()) || ($competiton->winner_visits_links && $competiton->winner_visits_links->isNotEmpty()))
                            <div class="competition-prize">
                                <div class="img-prize">
                                    <img src="https://png.pngtree.com/png-vector/20191029/ourmid/pngtree-first-prize-gold-trophy-icon-prize-gold-trophy-winner-first-prize-png-image_1908592.jpg"/>
                                </div>
                                @if($competiton->condition_type == 'buy_products')
                                    @foreach($competiton->winner as $winner)
                                        <table class="table">
                                            <tr class="table-light">
                                                <td colspan="2">الفائز بالجائزة</td>
                                            </tr>
                                            <tr class="table-light">
                                                <td>رقم الجوال</td>
                                                <td>{{ $winner->mobile }}</td>
                                            </tr>
                                            <tr class="table-light">
                                                <td>اسم الفائز</td>
                                                <td>{{ $winner->client->name }}</td>
                                            </tr>
                                        </table>
                                    @endforeach
                                @endif
                                @if($competiton->condition_type == 'visit_link')
                                    <h5>الفائزين بالجائزة</h5>
                                    <br/>
                                    @foreach($competiton->winner_visits_links as $winner_linker)
                                        <table class="table">
                                            <tr class="table-light">
                                                <td>رقم الجوال</td>
                                                <td>{{ $winner_linker->mobile }}</td>
                                            </tr>
                                        </table>
                                    @endforeach
                                @endif
                            </div>
                        @endif
                        <div class="competition-prize">
                            <div class="img-prize">
                                <img src="https://png.pngtree.com/png-vector/20191029/ourmid/pngtree-first-prize-gold-trophy-icon-prize-gold-trophy-winner-first-prize-png-image_1908592.jpg"/>
                            </div>
                            <table class="table">
                                <tr class="table-light">
                                    <td>تفاصيل الجائزة</td>
                                </tr>
                                <tr class="table-light">
                                    <td>{{ $competiton->prize }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="competition-detials-primary">
                            <h2>{{ $competiton->name }}</h2>
                            
                            <table class="table">
                                <tr class="table-light">
                                    <td>تاريخ بدأ المسابقة</td>
                                    <td>{{ $competiton->start_date }}</td>
                                </tr>
                                <tr class="table-light">
                                    <td>تاريخ نهاية المسابقة</td>
                                    <td>{{ $competiton->end_date }}</td>
                                </tr>
                                <tr class="table-light">
                                    <td>نوع المسابقة</td>
                                    <td>
                                        <span class="badge bg-danger">
                                            @if($competiton->condition_type == 'buy_products')
                                                {{ __('master.buy_products') }}
                                            @else
                                                {{ __('master.visits_links') }}
                                            @endif
                                        </span>
                                    </td>
                                </tr>
                                <tr class="table-light">
                                    <td>عدد المشتركين فى المسابقة</td>
                                     @if($competiton->condition_type == 'buy_products')
                                        <td>{{ $competiton->competitors_count }} مشترك</td>
                                     @else
                                        <td>{{ $competiton->competition_joiners_count }} مشترك</td>
                                     @endif
                                </tr>
                            </table>
                        </div>
                        <div class="competition-detials-primary">
                            <h2>شروط الانضمام للمسابقة</h2>
                            <table class="table conditions">
                                <tr class="table-light">
                                    <td colspan="4">
                                        @if($competiton->condition_type == 'buy_products')
                                            {{ __('master.buy_products') }}
                                        @else
                                            {{ __('master.visits_links') }}
                                        @endif
                                    </td>
                                </tr>
                                @if($competiton->condition_type == 'buy_products')
                                    @foreach($competiton->competition_products as $competiton_product)
                                        @if($competiton_product->product)
                                            <tr class="table-light">
                                                <td>
                                                    <img src="{{ asset($competiton_product->product->featured_image ?: ($competiton_product->product->image ? $competiton_product->product->image[0] : null)) }}" />
                                                </td>
                                                <td>
                                                   {{ $competiton_product->product ? $competiton_product->product->name_ar : '-' }}
                                                </td>
                                                <td>
                                                    <a href="{{ url('product/detailss/'.$competiton_product->product->id) }}">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </td>
                                                <td></td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @elseif($competiton->condition_type == 'visit_link')
                                    @if($now->lt($end))
                                        <tr style="background-color: white;" class="">
                                            <td colspan="4">
                                                <form method="post" class="form_competition_links" action="{{ url('join-competition/'.$competiton->id) }}">
                                                    @csrf
                                                    <lable>رقم جوالك</lable>
                                                    <input type="text" class="form-control mobile_number" required/>
                                                    <button type="submit" class="btn btn-success competition_links">
                                                        روابط المسابقة
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endif
                                @endif
                            </table>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- video Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header" style="direction: ltr;">
                    <h5 class="modal-title" id="exampleModalLongTitle">
                        مشاهدة فيديو تعريفي
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <iframe style="width:100%;height:400px"
                    src="{{ $competiton->video_url }}">
                    </iframe>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    
    
    <div class="modal fade bd-example-modal-lg" id="CheckModalCenter" tabindex="-1" role="dialog" aria-labelledby="CheckModalCenter" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header" style="direction: ltr;">
                    <h5 class="modal-title" id="exampleModalLongTitle">
                        التأكد من وجودك ضمن المتسابقين
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert" style="color:black">
                        <form id="search_on_number" method="post" action="#">
                            <div class="form-group">
                                <label>يمكنك التأكد من وجودك داخل المسابقة ضمن المتسابقين </label>
                                <input type="text" name="client_mobile" placeholder="رقم التليفون" class="form-control client_mobile" style="background-color: #eee;border-radius: 78px;" required/>
                            </div>
                            <button type="submit" class="btn btn-danger">
                                البحث عن الرقم
                            </button>
                        </form>
                    </div>
                    <div class="container-subscriber">
                        <div class="alert alert-success" style="background-color: #E8F5E9;">
                            رقم الجوال ضمن المشتركين بالمسابقة
                        </div>
                        <div class="alert alert-danger" style="background-color: #FCE4EC;">
                            رقم الجوال غير متوفر ضمن المشتركين بالمسابقة
                        </div>
                        <table class="table subscriber-show">
                            <thead>
                                <tr class="table-warning">
                                    <th>اسم المشترك</th>
                                    <th>رقم جوال المشترك</th>
                                    <th>تاريخ الاشتراك</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                        <div class="whatsapp_admin">
                            <div class="alert alert-danger" style="background-color: #FCE4EC;">
                                فى حالة لديك اى شكوي بخصوص عدم وجودك داخل المنصة يمكنك التواصل مع المسؤلين و سنوفر لك دعم الكامل
                            </div>
                            <a href="#" class="btn btn-success">
                                تواصل مع المسؤلين
                            </a>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                </div>
            </div>
        </div>
    </div>
    
    
@endsection
{{--Developed Saed Z. Sinwar--}}

@section('head')
<style>
    .subscriber-show ,
    .container-subscriber .alert-success,
    .container-subscriber .alert-danger,
    .container-subscriber .whatsapp_admin{
        display:none;
        font-family: 'Tajawal', sans-serif !important;
    }
    .competition-thumbnail{
        margin: 0px 13px;
        /*background-color: #f6f6f6;*/
        border: 1px solid #eeee;
        border-radius: 21px;
        /*font-family: dinnextltw23,'sans-serif'!important;*/
        font-family: 'Tajawal', sans-serif !important;
    }
    .competition-detials-primary{
        padding: 16px 20px;
        /*background-color: #ededed;*/
        /*font-family: dinnextltw23,'sans-serif'!important;*/
        background-color: wheat;
        font-family: 'Tajawal', sans-serif !important;
        margin-bottom: 5%;
    }
    .competition-detials-primary h2{
        font-family: 'Tajawal', sans-serif !important;
        font-weight:500;
        text-align: center;
        padding: 10%;
        background-color: white;
    }
    .competition-detials-primary h2,
    .competition-prize h2{
        line-height: 1.8em;
        font-family: 'Tajawal', sans-serif !important;
    }
    .competition-prize{
        padding: 16px 20px;
        /*background-color: #ededed;*/
        /*font-family: dinnextltw23,'sans-serif'!important;*/
        font-family: 'Tajawal', sans-serif !important;
        background-color: wheat;
        margin-bottom: 5%;
        background-color: white;
        margin-bottom: 5%;
        border: 17px solid wheat;
    }
    .details-competition {
        display: flex!important;
        flex-wrap: wrap;
    }

    .competition-detials .btn-success
    {
        color: #fff;
        background-color: #28a745;
        border-color: #28a745;
        /*font-family: dinnextltw23,'sans-serif'!important;*/
        font-family: 'Tajawal', sans-serif !important;
    }
    .competition-detials .btn-warning{
        color: #212529;
        background-color: #ffc107;
        border-color: #ffc107;
        /*font-family: dinnextltw23,'sans-serif'!important;*/
        font-family: 'Tajawal', sans-serif !important;
    }
    .competition-detials .btn{
        border: 1px solid transparent;
        padding: 0.375rem 0.75rem;
        font-family: 'Tajawal', sans-serif !important;
        /*font-family: dinnextltw23,'sans-serif'!important;*/
    }
    .competition-detials .badge
    {
        background-color: #dc3545!important;
        color: white;
        padding: 9px 20px;
        border-radius: 30px;
        font-family: 'Tajawal', sans-serif !important;
        /*font-family: dinnextltw23,'sans-serif'!important;*/
    }
    .table{
        font-family: 'Tajawal', sans-serif !important;
        /*font-family: dinnextltw23,'sans-serif'!important;*/
        font-size: 16px;
    }
    .table tr td,
    .table tr th{
        font-family: 'Tajawal', sans-serif !important;
    }
    .description{
        padding: 30px 17px;
        font-family: 'Tajawal', sans-serif !important;
    }
    .description h5{
        margin-bottom: 15px;
    }
    .inner-description *{
        font-family: 'Tajawal', sans-serif !important;
    }
    .img-prize{
        width: 120px;
        margin: auto;
    }
    .top-details-competition{
        padding: 15px 10px;
        display: flex !important;
        justify-content: space-between;
        flex-wrap: wrap;
    }
    .btn{
        border: 1px solid transparent !important;
        padding: 0.375rem 0.75rem !important;
        font-family: 'Tajawal', sans-serif !important;
        border-radius: 36px !important;
    }
    .top-details-competition .btn-warning{
        color: #212529;
        background-color: #ffc107;
        border-color: #ffc107;
        font-family: 'Tajawal', sans-serif !important;
        font-weight:400;
    }
    .whatsapp_admin .btn-success {
        color: #fff !important;
        background-color: #28a745 !important;
        border-color: #28a745 !important;
    }
    .top-details-competition .btn-info{
        color: #fff !important;
        background-color: #17a2b8 !important;
        border-color: #17a2b8 !important;
    }
    .alert .btn-danger{
        color: #fff !important;
        background-color: #dc3545!important;
        border-color: #dc3545 !important;
    }
    .alert .btn-secondary {
        color: #fff;
        background-color: #6c757d;
        border-color: #6c757d;
    }
    .table.conditions tr td img{
        width: 51px;
    }
    .countdown-competition{
        background-color: #880E4F;
        color: white;
        padding: 18px;
        margin-bottom: 10px;
        border-radius: 10px;
        font-family: 'Tajawal', sans-serif !important;
    }
    #countdown ul{
        display: flex;
        justify-content: space-between;
        list-style: none;    
        padding: 0px;
        font-family: 'Tajawal', sans-serif !important;
    }
    #countdown ul li {
        text-align: center;
        font-family: 'Tajawal', sans-serif !important;
    }
    #countdown ul li span {
        display:block;
        font-weight: bolder;
        font-size: 32px;
        font-family: 'Tajawal', sans-serif !important;
    }
    .alert .form-group label,
    .alert .form-group input{
        font-family: 'Tajawal', sans-serif !important;
    }
    tr td input.mobile_number{
        margin: 0px 0px 20px 10px !important;
        border-radius: 50px !important;
        background-color: #eee !important;
    }
    .fa-clone.active{
        color: #dc539c;
    }
    @media(min-width:1200px){
        .competition-thumbnail{
            width: 65%;
        }
        .competition-detials{
            width: 32%;
        }
        
    }
    
    @media(max-width:1200px){
        .btn{
            font-size:13px;
        }
        .competition-detials{
            padding: 15px;
        }
    }
</style>

@endsection

@push('script')
<script>

    jQuery('document').ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        jQuery('.modal').on('submit','form#search_on_number',function(e){
            e.preventDefault();
            let client_mobile  = jQuery(this).find('.client_mobile').val(); 
            let competition_slug = "{{ $competiton->slug }}"; 
           
            $.ajax({
                url:"{{ url('search-on-competitiors') }}",
                type:"post",
                data:{
                    "_token": "{{ csrf_token() }}",
                    mobile:client_mobile,
                    competition_slug:competition_slug
                },
                success:function(data){
                    if(data.success == true){
                        jQuery('.container-subscriber .alert-danger').slideUp(100);
                        jQuery('.container-subscriber .whatsapp_admin').slideUp(100);
                        jQuery('.container-subscriber .alert-success').slideDown(100);      
                        jQuery('table.subscriber-show').slideDown(100);
                        jQuery('table.subscriber-show tbody').html(`<tr>
                              <td>${data.competitor.client.name}</td>
                              <td>${data.competitor.mobile}</td>
                              <td>${data.competitor.created_at}</td>
                        </tr>`);
                    } else if(data.success == false){
                        jQuery('.container-subscriber .alert-success').slideUp(100);
                        jQuery('.container-subscriber .alert-danger').slideDown(100);
                        jQuery('table.subscriber-show').slideUp(100);
                        jQuery('.container-subscriber .whatsapp_admin').slideDown(100);
                    }

                    console.log(data.success);
                }
            });
        }); 
        
        jQuery('.form_competition_links').on('submit',function(e){
            e.preventDefault();
            let client_mobile  = jQuery('.mobile_number').val(); 
            let competition_slug = "{{ $competiton->slug }}"; 
            let self = this;
            jQuery(this).find('button[type="submit"]').attr('disabled',true);
            jQuery('.new-arrows').remove();
            $.ajax({
                url:"{{ url('join-competition') }}",
                type:"post",
                data:{
                    "_token": "{{ csrf_token() }}",
                    mobile:client_mobile,
                    competition_slug:competition_slug
                },
                success:function(data){
                    if(data.success == true){
                        let links = data.competition_link_visits;
                        console.log(links);
                        jQuery('.conditions tbody').append(`
                            <tr class="table-light new-arrows">
                                <td>
                                    مشاهدة الرابط
                                </td>
                                <td>
                                    عدد الزيارات المطلوبه
                                </td>
                                <td>
                                    عدد زيارات الحالية
                                </td>
                                <td>
                                    نسح الرابط
                                </td>
                            </tr>
                        `);  
                        links.forEach(function(element){
                            let url = new URL(element.competition_link.link);
                            url.searchParams.set('reference',data.reference);
                            jQuery('.conditions tbody').append(`
                                <tr class="table-light new-arrows">
                                    <td>
                                        <a href="${element.competition_link.link}">
                                            <i class="fas fa-link"></i>    
                                        </a>
                                    </td>
                                    <td>
                                        ${element.competition_link.count_required}
                                    </td>
                                    <td>
                                        ${element.link_visits_count}
                                    </td>
                                    <td>
                                        <i class="fas fa-clone" style="cursor:pointer"  data-src="${url}"></i>
                                    </td>
                                </tr>
                            `);     
                        });
                       
                    } else if(data.success == false){
                        jQuery('.new-arrows').remove();
                    }
                    jQuery(self).find('button[type="submit"]').attr('disabled',false);
                }
            });
        });
    });
    (function () {
          const second = 1000,
                minute = second * 60,
                hour = minute * 60,
                day = hour * 24;
        
          //I'm adding this section so I don't have to keep updating this pen every year :-)
          //remove this if you don't need it
      let today = new Date(),
          dd = String(today.getDate()).padStart(2, "0"),
          mm = String(today.getMonth() + 1).padStart(2, "0"),
          yyyy = today.getFullYear(),
          nextYear = yyyy + 1,
          dayMonth = "09/30/",
          birthday = "{{ $select_countdown }}";
      
    //   today = mm + "/" + dd + "/" + yyyy;
    //   if (today > birthday) {
    //     birthday = dayMonth + nextYear;
    //   }
      //end
      
      const countDown = new Date(birthday).getTime(),
          x = setInterval(function() {    
    
            const now = new Date().getTime(),
                  distance = countDown - now;
    
            document.getElementById("days").innerText = Math.floor(distance / (day)),
              document.getElementById("hours").innerText = Math.floor((distance % (day)) / (hour)),
              document.getElementById("minutes").innerText = Math.floor((distance % (hour)) / (minute)),
              document.getElementById("seconds").innerText = Math.floor((distance % (minute)) / second);
    
            //do something later when date is reached
            if (distance < 0) {
              clearInterval(x);
            }
            //seconds
          }, 0)
      }());
      
      
      jQuery('table').on('click','.new-arrows i.fa-clone',function(){
          jQuery(this).addClass('active');
          let url = jQuery(this).attr('data-src');
          // Copy the text inside the text field
          navigator.clipboard.writeText(url);
          let self = this;
          setTimeout(function(){
             jQuery(self).removeClass('active');
          },2000);
      });
     
</script>
@endpush