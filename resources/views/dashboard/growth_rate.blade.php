@extends('dashboard.master')

@section('products_add')
    current active
@endsection
@section('head_tag')
    <!-- FlexDatalist -->
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/plugin/flexdatalist/jquery.flexdatalist.min.css') }}">
    <!-- Popover -->
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/plugin/popover/jquery.popSelect.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/plugin/select2/css/select2.min.css') }}">
    <!-- Timepicker -->
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/plugin/timepicker/bootstrap-timepicker.min.css') }}">
    <!-- Touch Spin -->
    <link rel="stylesheet"
          href="{{ asset('dashboard/light/assets/plugin/touchspin/jquery.bootstrap-touchspin.min.css') }}">
    <!-- Colorpicker -->
    <link rel="stylesheet"
          href="{{ asset('dashboard/light/assets/plugin/colorpicker/css/bootstrap-colorpicker.min.css') }}">
    <!-- Datepicker -->
    <link rel="stylesheet"
          href="{{ asset('dashboard/light/assets/plugin/datepicker/css/bootstrap-datepicker.min.css') }}">
    <!-- DateRangepicker -->
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/plugin/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/editor/summernote-lite.css') }}">
    <style>
        .dropify-wrapper {
            height: 150px;
        }
        .tag-editor {
            line-height: 24px;
            padding: 7px 14px;
            min-height: 45px;
            border-color: #ccd1d9;
            box-shadow: none;
            -webkit-box-shadow: none;
            -moz-box-shadow: none;
            border-radius: 2px;
            -webkit-border-radius: 2px;
            -moz-border-radius: 2px;
        }
        .disable{
            display: none;
        }
    </style>
    @if(app()->isLocale('ar'))
        <style>
            .tag-editor li {
                float: right;
                display: flex;
            }
            .tag-editor-hidden-src {
                right: -99999px;
                left: auto;
            }
            
          
            
            #contact {
                background: #F9F9F9;
                padding: 25px;
                margin: 15px auto;
                width: 32%;
                border: 2px solid #e9eef1;
                background-color: white;
            }
            
            #contact h3 {
              display: block;
              font-size: 30px;
              font-weight: 300;
              margin-bottom: 10px;
            }
            
            #contact h4 {
              margin: 5px 0 15px;
              display: block;
              font-size: 13px;
              font-weight: 400;
            }
            
            fieldset {
              border: medium none !important;
              margin: 0 0 10px;
              min-width: 100%;
              padding: 0;
              width: 100%;
            }
            
            #contact input[type="text"],
            #contact input[type="email"],
            #contact input[type="tel"],
            #contact input[type="url"],
            #contact select,
            #contact textarea {
              width: 100%;
              border: 1px solid #ccc;
              background: #FFF;
              margin: 0 0 5px;
              padding: 10px;
              height: 3em;
              border: 1px solid #2196f3;
            }
            
            #contact input[type="text"]:hover,
            #contact input[type="email"]:hover,
            #contact input[type="tel"]:hover,
            #contact input[type="url"]:hover,
            #contact select:hover,
            #contact textarea:hover {
              -webkit-transition: border-color 0.3s ease-in-out;
              -moz-transition: border-color 0.3s ease-in-out;
              transition: border-color 0.3s ease-in-out;
              border: 1px solid #aaa;
              height: 3em;
              border: 1px solid #2196f3;
            }
            
            #contact textarea {
              height: 100px;
              max-width: 100%;
              resize: none;
            }
            
            #contact button[type="submit"] {
              cursor: pointer;
              
              border: none;
              background: #4CAF50;
              color: #FFF;
              margin:auto;
              padding: 10px;
              font-size: 15px;
            }
            
            #contact button[type="submit"]:hover {
              background: #43A047;
              -webkit-transition: background 0.3s ease-in-out;
              -moz-transition: background 0.3s ease-in-out;
              transition: background-color 0.3s ease-in-out;
            }
            
            #contact button[type="submit"]:active {
              box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.5);
            }
            
            .copyright {
              text-align: center;
            }
            
            #contact input:focus,
            #contact textarea:focus {
              outline: 0;
              border: 1px solid #aaa;
            }
            
            ::-webkit-input-placeholder {
              color: #888;
            }
            
            :-moz-placeholder {
              color: #888;
            }
            
            ::-moz-placeholder {
              color: #888;
            }
            
            :-ms-input-placeholder {
              color: #888;
            }
            .head-form
            {
                text-align: center;
                line-height: 2em;
                font-size: 28px !important;
            }
            .disabled{
                border:0px solid white !important;
                background-color:#efefef !important;
            }
            .disabled input{
                border: 1px solid #d6d9db !important;
            }
            .sales-results{
                text-align: center;
            }
            .box-results
            {
                background-color: #ff9800;
                padding: 15px;
                display: inline-block;
                margin: 20px;
                color: white;
                font-size: 15px;
                font-size: 15px;
                direction: ltr;
                padding: 11px 29px;
                box-shadow: 0px 0px 8px 9px #f3f3f3;
                border: 1px solid #dddddd;
            }
            .sales-results
            {
               display:none;        
            }
             @media(max-width:1000px){
                #contact {
                    width:100%;
                }
            }
        </style>
    @else
    
    <style>
            .tag-editor li {
               
                display: flex;
            }
            .tag-editor-hidden-src {
                right: -99999px;
                left: auto;
            }
            
          
            
            #contact {
                background: #F9F9F9;
                padding: 25px;
                margin: 15px auto;
                width: 32%;
                border: 2px solid #e9eef1;
                background-color: white;
            }
            
            #contact h3 {
              display: block;
              font-size: 30px;
              font-weight: 300;
              margin-bottom: 10px;
            }
            
            #contact h4 {
              margin: 5px 0 15px;
              display: block;
              font-size: 13px;
              font-weight: 400;
            }
            
            fieldset {
              border: medium none !important;
              margin: 0 0 10px;
              min-width: 100%;
              padding: 0;
              width: 100%;
            }
            
            #contact input[type="text"],
            #contact input[type="email"],
            #contact input[type="tel"],
            #contact input[type="url"],
            #contact select,
            #contact textarea {
              width: 100%;
              border: 1px solid #ccc;
              background: #FFF;
              margin: 0 0 5px;
              padding: 10px;
              height: 3em;
              border: 1px solid #2196f3;
            }
            
            #contact input[type="text"]:hover,
            #contact input[type="email"]:hover,
            #contact input[type="tel"]:hover,
            #contact input[type="url"]:hover,
            #contact select:hover,
            #contact textarea:hover {
              -webkit-transition: border-color 0.3s ease-in-out;
              -moz-transition: border-color 0.3s ease-in-out;
              transition: border-color 0.3s ease-in-out;
              border: 1px solid #aaa;
              height: 3em;
              border: 1px solid #2196f3;
            }
            
            #contact textarea {
              height: 100px;
              max-width: 100%;
              resize: none;
            }
            
            #contact button[type="submit"] {
              cursor: pointer;
              
              border: none;
              background: #4CAF50;
              color: #FFF;
              margin:auto;
              padding: 10px;
              font-size: 15px;
            }
            
            #contact button[type="submit"]:hover {
              background: #43A047;
              -webkit-transition: background 0.3s ease-in-out;
              -moz-transition: background 0.3s ease-in-out;
              transition: background-color 0.3s ease-in-out;
            }
            
            #contact button[type="submit"]:active {
              box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.5);
            }
            
            .copyright {
              text-align: center;
            }
            
            #contact input:focus,
            #contact textarea:focus {
              outline: 0;
              border: 1px solid #aaa;
            }
            
            ::-webkit-input-placeholder {
              color: #888;
            }
            
            :-moz-placeholder {
              color: #888;
            }
            
            ::-moz-placeholder {
              color: #888;
            }
            
            :-ms-input-placeholder {
              color: #888;
            }
            .head-form
            {
                text-align: center;
                line-height: 2em;
                font-size: 28px !important;
            }
            .disabled{
                border:0px solid white !important;
                background-color:#efefef !important;
            }
            .disabled input{
                border: 1px solid #d6d9db !important;
            }
            .sales-results{
                text-align: center;
            }
            .box-results
            {
                background-color: #ff9800;
                padding: 15px;
                display: inline-block;
                margin: 20px;
                color: white;
                font-size: 15px;
                font-size: 15px;
                direction: ltr;
                padding: 11px 29px;
                box-shadow: 0px 0px 8px 9px #f3f3f3;
                border: 1px solid #dddddd;
            }
            .sales-results
            {
               display:none;        
            }
             @media(max-width:1000px){
                #contact {
                    width:100%;
                }
            }
        </style>
    
    @endif
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <form method="post" class="form_cal_growth"  autocomplete="off" enctype="multipart/form-data">
                <div class="row">
                    <div class="container">
                        <div id="contact" action="" method="post">
                            <h4 class="head-form">{{ __("master.$title_page") }}</h4>
                            <fieldset>
                              <label> {{ __('master.capital')  }} </label>
                              <input name="growth_capital" class="growth_capital" type="text" tabindex="1" required autofocus>
                            </fieldset>
                            <fieldset>
                              <label> {{ __('master.growth_type_of_calculate')  }} </label>
                              <select name="growth_type_of_calculate" class="product_price" type="text" tabindex="1" required autofocus>
                                  <option value="0">{{ __('master.months') }}</option>
                                  <option value="1">{{ __('master.years') }}</option>
                              </select>
                            </fieldset>
                            <fieldset>
                              <label> {{ __('master.profit_per_period')  }} % </label>
                              <input name="growth_profit_per_period" class="conversion_rate" type="text" tabindex="1" required autofocus>
                            </fieldset>
                            <fieldset>
                              <label> {{ __('master.count_of_months_years')  }} </label>
                              <input name="growth_count_of_months_years" class="growth_count_of_months" type="text" tabindex="1" required autofocus>
                            </fieldset>
                           
                        </div>
                        
                        <div id="contact" style="width:96%">
                            <fieldset style="text-align: center;">
                              <button  name="submit" type="submit" id="contact-submit" data-submit="...Sending" style="margin:auto">{{ __('master.calculate_cost') }}</button>
                            </fieldset>
                            <div class="sales-results" id="results-data">
                                <h3 class="heading-sales-results"> {{ __('master.your_results') }}</h3>
                               
                                
                                
                                <div class="box-results total-net-profit" style="width:80%;background-color:green">
                                    <p>{{ __('master.total_net_profit') }}</p>
                                    <label> 120344 $</label>
                                </div>
                                
                            </div>
                        </div>
                        
                        
                        
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
<script>
    jQuery('#ssl').change(function(){
        let open_up_sell =  jQuery(this).val();
        if( jQuery(this).is(':checked') ){
            jQuery(this).parents('#contact').find('fieldset input').attr('required',true); 
            jQuery(this).parents('#contact').find('fieldset input').attr('readonly',false); 
            jQuery(this).parents('#contact').removeClass('disabled'); 
        }else{
            jQuery(this).parents('#contact').find('fieldset input').attr('required',false);
            jQuery(this).parents('#contact').find('fieldset input').attr('readonly',true); 
            jQuery(this).parents('#contact').addClass('disabled');
            
        }
        
    });
    jQuery('form.form_cal_growth').submit(function(e){
        e.preventDefault();
        let data_cal_growth            = $(this).serializeArray();
        let label_profit_data          = $('.total-net-profit label');
        $.ajax({
            url: "{{ route('dashboard.admin.result-growth-rate') }}",
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                "data_cal_growth": data_cal_growth,
            },
            dataType: 'JSON',
            success: function (data) {
               jQuery('.sales-results').fadeIn();
               label_profit_data.html(data.status);
               console.log(data.status);
               window.location.href="#results-data";
            }
        });
    });    
</script>

@endsection
{{--Developed Saed Z. Sinwar--}}
