{{-- <span id="val_counts">0</span> 
--}}
@if($values )
{{--
--}}
@if(!$product)
    @foreach ($values as $ind=> $value )
        @if(!empty($value->values))
        <div class="form-group" style="margin: 4px;"/>
        <div class="d-flex justify-content-between" style="display: inline-flex;width: 100%;justify-content: space-between;">
           <div>
               <label>{{__('master.attribute')}}</label>
               <br/>
               <input type="text" class="disabled form-control bg-white"disabled value="{{ $value['name_'.app()->getLocale()] }}">
            </div>
            <div style="width: 65%;"> 
            <label for="display_type">{{__('master.display_type')}}</label>
            <select class="form-control custom-checkbox" id="display_type" name="display_type[]" >
                <option value="radio"> Radio</option>
                <option value="select">Select</option>
                <option value="color">Color</option>
            </select> 
            </div>
        </div>
              <div style="display:inline-flex;justify-content:space-between">
              <div class="form-check form-check-inline">            
                      <a href="#"   ></a>
                        <input class="form-check-input attribute" type="checkbox" id="values_" value="{{$value->id}}" name="Allvalues[]"onclick="selectAll({{$value->id}},this.checked);">
                        <label for="values_" class="form-check-label" style="margin-bottom: 4px;"><a href="#"></a>{{__('master.All')}}</label>
                        
                    </div>
            @foreach($value->values as $index=>$val)
                    <div class="form-check form-check-inline mx-1" style="margin: 0px 5px;">            
                        <input class="form-check-input valcheckbox attr-{{$value->id}}" type="checkbox" id="values_{{$index}}" value="{{$val->value}}" name="values[]">
                        <label for="values_{{$index}}" class="form-check-label"  style="margin-bottom: 4px;"><a href="#" class="selectVal"></a>{{$val->value}}</label>
                    </div>
            @endforeach                         
        </div></div>
        <hr style="margin: 4px;"/>
        @endif
    @endforeach
    <button class="btn btn-sm btn-primary add" onclick="addVariants(event)"style="margin-bottom:5px;"><i class="fas fa-plus"></i>{{__('master.add')}}</button>
    <div class=" my-2" id="">
        <table id="variants" name="variants" class="table table-bordered add">
       <thead> <tr><th>{{__('master.name')}}</th><th>{{__('master.price')}}</th><th>{{__('master.qty')}}</th><th >{{__('master.delete')}}</th></tr><thead>
        </table>
    </div>
@endif


@if($type=="edit")
   @foreach ($values as $ind=> $value )
   
        @if(!empty($value->values))
        <div class="form-group
        @isset($page_type)
        @if($page_type=='first')
          @isset($product->attributes)         
                        @foreach($product->attributes as $index=>$attri)
                                @if($attri->attribute_id!=$value->id)
                        hidden
                        
    
            @endif
            @endforeach
            @endisset
            @endif
            @endisset" style="margin: 4px;">
        
              
         <div class="d-flex justify-content-between " 
         style="display: inline-flex;width: 100%;justify-content: space-between;">
           <div>
               <label>{{__('master.attribute')}}</label>               
               <br/>
               <input type="text" class="disabled form-control  bg-white"disabled value="{{$value['name_'.app()->getLocale()] ?? $value['name_'.app()->getLocale()]}}">
            </div>
            <div style="width: 65%;"> 
            <label for="display_type">{{__('master.display_type')}}</label>
            
        @isset($page_type)
        @if($page_type=='first')
          @isset($product->attributes)         
                        @foreach($product->attributes as $index=>$attri)
                                @if($attri->attribute_id!=$value->id &&  $product->attributes->count() >1)
    
            @endif
            @endforeach
            @endisset
            @endif
            @endisset
            <select class="form-control custom-checkbox" id="display_type" name="display_type[]" >
                <option value="radio"  @foreach($product->attributes as $attr) @if($attr->attribute_id == $value->id){{$attr->display_type =='radio' ? 'selected'  :''}} @endif @endforeach >Radio</option>
                <option value="select" @foreach($product->attributes as $attr)  @if($attr->attribute_id == $value->id){{$attr->display_type =='select' ?  'selected'  :''}} @endif @endforeach  >Select</option>
                <option value="color" @foreach($product->attributes as $attr)  @if($attr->attribute_id == $value->id){{$attr->display_type =='color' ?  'selected'  :''}} @endif @endforeach  >Color</option>
            </select> 
            
            </div>
        </div>
         <div style="display:inline-flex;justify-content:space-between">
              <div class="form-check form-check-inline">            
                      <a href="#"   ></a>
                        <input class="form-check-input attribute" type="checkbox" id="values_" value="{{$value->id}}" name="Allvalues[]"onclick="selectAll({{$value->id}},this.checked);">
                        <label for="values_" class="form-check-label"  style="margin-bottom: 4px;">{{__('master.All')}}</label>
                        
                    </div>
            @foreach($value->values as $index=>$val)  
            
                <div class="form-check form-check-inline mx-1" style="margin: 0px 5px;">            
                        <input class="form-check-input valcheckbox attr-{{$value->id}}" type="checkbox" id="values_{{$index}}"
                        value="{{$val->value}}" name="values[]"
                           @isset($product->attributes)         
                                    @foreach($product->attributes as $index=>$attri)
                                        @foreach(json_decode($attri->vals,true) as $index=>$val1)
                                            @if($val1==$val->value)
                                            checked
                                            @endif
                                        @endforeach        
                                    @endforeach 
                            @endisset 
                 >
                        <label for="values_{{$index}}" class="form-check-label" style="margin-bottom: 4px;">{{$val->value}}</label>
                    </div>
            @endforeach                         
        </div></div>
        <hr style="margin: 4px;"/>
   
        @endif
    @endforeach
    <button class="btn btn-sm btn-primary edit" onclick="addVariants(event)" style="margin-bottom:5px;"><i class="fas fa-plus"></i> {{__('master.add')}}</button>
    <div class=" my-2" id="">
        <table id="variants" name="variants" class="table table-bordered edit">
             <thead> <tr><th>{{__('master.name')}}</th><th>{{__('master.price')}}</th><th>{{__('master.qty')}}</th><th >{{__('master.delete')}}</th></tr>
             @if($product->variations)
              
                    @foreach($product->variations as $vari)
                    <tr>
                        <td>{{$vari->name}}<input type="hidden" class="form-control" name="names[]" id="names" placeholder="Name" value="{{$vari->name}}"></td>
                        <td><input type="number" class="form-control" name="prices[]" min="1" step="any" id="prices" placeholder="{{__('master.price')}}" value="{{$vari->price}}"></td>
                        <td><input type="number" class="form-control" name="sku[]" min="1" id="sku" placeholder="{{__('master.qty')}}" value="{{$vari->sku}}"></td>
                        <td><a class="btn btn-danger btn-sm delete-row" href="#" onclick="deleteRow(event,this)"><i class="fas fa-trash"></i></a></td></tr>
                    @endforeach
                
           @endif
             <thead>
            
        </table>
    </div>
@endif

@endif