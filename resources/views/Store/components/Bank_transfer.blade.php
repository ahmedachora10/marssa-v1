
<table class="table table-bordered">
    <tr style="background-color: #e8e2d0 !important;color: {{$color ?? '#fff'}}!important;">
        <td style="color: {{$color ?? '#fff'}}!important;">{{__('master.bank_name')}}</td>
        <td style="color: {{$color ?? '#fff'}}!important;"><b>{{$store->payment_methods['Bank_transfer']['Feilds']['bank_name']}}</b></td>
    </tr>
    <tr style="background-color: #e8e2d0 !important;color: {{$color ?? '#fff'}}!important;">
        <td style="color: {{$color ?? '#fff'}}!important;">{{__('master.bank_account_number')}}</td>
        <td style="color: {{$color ?? '#fff'}}!important;"><b>{{$store->payment_methods['Bank_transfer']['Feilds']['bank_account_number']}}</b></td>
    </tr>
    <tr style="background-color: #e8e2d0 !important;color: {{$color ?? '#fff'}}!important;">
        <td style="color: {{$color ?? '#fff'}}!important;">{{__('master.bank_account_name')}}</td>
        <td style="color: {{$color ?? '#fff'}}!important;"><b>{{$store->payment_methods['Bank_transfer']['Feilds']['bank_account_name']}}</b></td>
    </tr>
    <tr style="background-color: #e8e2d0 !important;color: {{$color ?? '#fff'}}!important;">
        <td style="color: {{$color ?? '#fff'}}!important;">{{__('master.bank_iban')}}</td>
        <td style="color: {{$color ?? '#fff'}}!important;"><b>{{$store->payment_methods['Bank_transfer']['Feilds']['bank_iban']}}</b></td>
    </tr>
</table>
<hr>
<b class="text-danger">{{__('master.Please include your details and attach a picture of the transfer process.')}}</b>
<hr>
<form class="create-order-form" method="post" action="{{url('make_order')}}" enctype="multipart/form-data">
    @csrf
    @method('post')
    <input type="hidden" name="method" value="Bank_transfer">
    <input type="hidden" name="abandoned_order" value="">
    <div class="row">
        @if($store->branches->count() != 0)
           <div class="form-group col-lg-6">
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
        @if($store->payment_methods['Bank_transfer']['Feilds']['fullname'] == "1")
            <div class="form-group col-lg-6">
                <input type="text" name="name" value="{{old('name')}}"
                       class="form-control name" >
            </div>
        @endif
        <div class="form-group col-lg-6">
            <input type="number" min="10000000" name="mobile" value="{{old('mobile')}}"
                   class="form-control mobile"  >
        </div>
        @if($store->payment_methods['Bank_transfer']['Feilds']['address'] == "1")
            <div class="form-group col-lg-6 @error('address') has-error @enderror">
                <input type="text" name="address" value="{{old('address')}}"
                       class="form-control address" >
            </div>
        @endif
        @if($store->payment_methods['Bank_transfer']['Feilds']['email'] == "1")
            <div class="form-group col-lg-6 @error('email') has-error @enderror">
                <input type="email" name="email" value="{{old('email')}}"
                       class="form-contro email" >
            </div>
        @endif
        @if($store->payment_methods['Bank_transfer']['Feilds']['more_details'] == "1")
                <div class="form-group col-lg-12 @error('email') has-error @enderror">
                    <textarea name="more_details" id="more_details" class="form-control" required>{{ __('master.more_details') }}</textarea>
                </div>
        @endif
            <div class="form-group col-lg-12 @error('img') has-error @enderror">
                
            <div class="custom-file">
                <label for="img" class="custom-file-label">{{ __('master.transfer_proof') }}</label>
                <input type="file" name="img" class="form-control-file custom-file-input" required>
                </div>
            </div>
        <div class="col-lg-12">
            <button type="submit" class="background_buy_now_button btn btn-success btn-block btn-lg order-process">{{__('master.pay')}}</button>
        </div>
    </div>
</form>
