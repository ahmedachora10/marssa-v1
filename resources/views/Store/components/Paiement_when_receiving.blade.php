<form class="create-order-form" method="post" action="{{url('make_order')}}">
    @csrf
    @method('post')
    <input type="hidden" name="method" value="Paiement_when_receiving">
    <input type="hidden" name="abandoned_order" value="">
    <div class="row">
        @if($store->branches->count() != 0)
           <div class="form-group col-lg-12">
               <label>{{ __('master.branch') }}</label>
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
        @if((int) $store->payment_methods['Paiement_when_receiving']['Feilds']['fullname']  == "1")
            <div class="form-group col-lg-12">
                <label>{{ __('store.full_name') }}</label>
                <input type="text" name="name" value="{{old('name')}}"
                       class="form-control"  required>
            </div>
        @endif
        <div class="form-group col-lg-12">
            <label>{{ __('store.mobile') }}</label>
            <input type="number" min="10000000" name="mobile" value="{{old('mobile')}}"
                   class="form-control"  required>
        </div>
        @if($store->payment_methods['Paiement_when_receiving']['Feilds']['address']  == "1")
            <div class="form-group col-lg-12 @error('address') has-error @enderror">
                <label>{{ __('store.address') }}</label>
                <input type="text" name="address" value="{{old('address')}}"
                       class="form-control"  required>
            </div>
        @endif
        @if($store->payment_methods['Paiement_when_receiving']['Feilds']['email'] == "1")
            <div class="form-group col-lg-12 @error('email') has-error @enderror">
                <label>{{ __('store.email') }}</label>
                <input type="email" name="email" value="{{old('email')}}"
                       class="form-control"  required>
            </div>
        @endif
        @if($store->payment_methods['Paiement_when_receiving']['Feilds']['more_details'] == "1")
            <div class="form-group col-lg-12 @error('email') has-error @enderror">
                <label>{{ __('master.more_details') }}</label>
                <textarea required name="more_details" id="more_details" class="form-control">{{ __('master.more_details') }}</textarea>
            </div>
        @endif
        <div class="col-lg-12">
            <button type="submit" class="background_buy_now_button btn btn-success btn-block btn-lg order-process">{{__('master.pay')}}</button>
        </div>
    </div>
</form>
