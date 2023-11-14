<table class="table table-bordered">
    <!--<tr style="background-color: #ffc107;">
        -->
        <tr style="background-color: #e8e2d0 !important;color: #000!important;">
        <td style="color: #000!important;">{{__('master.phone')}}</td>

        <td style="color: #000!important;"><b>{{$store->payment_methods['Bankily']['Feilds']['Bankily_to_phone'] ?? $store->users->first()->mobile }}</b></td>
    </tr>
</table>
<hr>
<form class="create-order-form" method="post" action="{{url('make_order')}}" enctype="multipart/form-data">
    @csrf
    @method('post')
    <input type="hidden" name="method" value="Bankily">
    <input type="hidden" name="abandoned_order" value="">
    <div class="row">
        @if($store->branches->count() != 0)
           <div class="form-group col-lg-6">
               <label>{{ __('store.full_name') }}</label>
                <select name="branch_id" class="form-control" required>
                    <option disabled selected> {{ __('master.branch') }} </option>
                    @foreach( $store->branches as $branch )
                    <option value="{{ $branch->id }}">
                        {{ $branch->name }}
                    </option>
                    @endforeach
                </select>
            </div>
        @endif
        @if($store->payment_methods['Bankily']['Feilds']['fullname'] == "1")
            <div class="form-group col-lg-6">
                <label>{{ __('store.full_name') }}</label>
                <input type="text" name="name" value="{{old('name')}}"
                       class="form-control name"   >
            </div>
        @endif
        <div class="form-group col-lg-6">
            <label>{{ __('store.mobile') }}</label>
            <input type="number" min="10000000" name="mobile" value="{{old('mobile')}}"
                   class="form-control mobile"  >
        </div>
        @if($store->payment_methods['Bankily']['Feilds']['address'] == "1")
            <div class="form-group col-lg-6 @error('address') has-error @enderror">
                <label>{{ __('store.address') }}</label>
                <input type="text" name="address" value="{{old('address')}}"
                       class="form-control address"  >
            </div>
        @endif
        @if($store->payment_methods['Bankily']['Feilds']['email'] == "1")
            <div class="form-group col-lg-6 @error('email') has-error @enderror">
                <label>{{ __('store.email') }}</label>
                <input type="email" name="email" value="{{old('email')}}"
                       class="form-control email" >
            </div>
        @endif
        @if($store->payment_methods['Bankily']['Feilds']['more_details'] == "1")
            <div class="form-group col-lg-12 @error('email') has-error @enderror">
                <label>{{ __('master.more_details') }}</label>
                <textarea name="more_details" id="more_details" class="form-control" required>{{ __('master.more_details') }}</textarea>
            </div>
        @endif

        <div class="form-group col-lg-12">
            @if(app()->getLocale() == 'ar')
               <span class="small text-danger">  * أضف صورة من التحويل   </span>
            @else
                <span class="small text-danger"> * Please upload a copy of the transfer </span>
            @endif
        </div>

        <!--<div class="form-group col-lg-6">-->
        <!--    <input type="number" min="10000000" name="transaction_number" value="{{old('transaction_number')}}"-->
        <!--           class="form-control" placeholder="{{ __('master.transaction_number') }}" required>-->
        <!--</div>-->

        <div class="form-group col-lg-12 @error('img') has-error @enderror" >
            <div class="custom-file">
                <input type="file" name="img" class="form-control-file custom-file-input" required>
                <label for="img"class="custom-file-label" >{{ __('master.transfer_proof') }}</label>
                </div>
            </div>
        <div class="col-lg-12">
            <button type="submit" class="background_buy_now_button btn btn-success btn-block btn-lg order-process">{{__('master.pay')}}</button>
        </div>
    </div>
</form>
