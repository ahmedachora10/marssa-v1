<form class="form" method="post" action="{{url('make_order')}}">
    @csrf
    @method('post')
    <input type="hidden" name="method" value="paypal">
    <input type="hidden" name="abandoned_order" value="">
    <div class="row">
        @if($store->branches->count() != 0)
           <div class="form-group col-lg-6">
                <select name="branch_id" class="form-control" >
                    <option disabled selected> {{ __('master.branch') }} </option>
                    @foreach( $store->branches as $branch )
                    <option value="{{ $branch->id }}">
                        {{ $branch->name }}
                    </option>
                    @endforeach
                </select>
            </div>
        @endif
        <div class="form-group col-lg-6">
            <input type="text" name="name" value="{{old('name')}}"
                   class="form-control name" placeholder="{{ __('store.full_name') }}" >
        </div>
        <div class="form-group col-lg-6">
        <input type="number" min="10000000" name="mobile" value="{{old('mobile')}}"
               class="form-control mobile" placeholder="{{ __('store.mobile') }}" >
        </div>
        <div class="form-group col-lg-6 @error('address') has-error @enderror">
            <input type="text" name="address" value="{{old('address')}}"
                   class="form-control address" placeholder="{{ __('store.address') }}" >
        </div>
        <div class="form-group col-lg-6 @error('email') has-error @enderror">
            <input type="email" name="email" value="{{old('email')}}"
                   class="form-control email" placeholder="{{ __('store.email') }}" >
        </div>
        @if($store->payment_methods['paypal']['Feilds']['more_details'] == "1")
            <div class="form-group col-lg-12 @error('email') has-error @enderror">
                <textarea required name="more_details" id="more_details" class="form-control">{{ __('master.more_details') }}</textarea>
            </div>
        @endif
        
        <script  src="https://www.paypal.com/sdk/js?client-id={{ $store->payment_methods['paypal']['paypal_client_id'] }}&currency=USD&intent=capture&enable-funding=venmo" data-namespace="paypal_sdk"></script>
        <div class="text-center">
             <div id="paypal-button-container"></div>
        </div>
        <script>
        
        
         const paypalButtonsComponent = paypal_sdk.Buttons({
                                      // optional styling for buttons
                                      // https://developer.paypal.com/docs/checkout/standard/customize/buttons-style-guide/
                                      style: {
                                        color: "gold",
                                        shape: "rect",
                                        layout: "vertical"
                                      },
                        
                                      // set up the transaction
                                      createOrder: (data, actions) => {
                                          // pass in any options from the v2 orders create call:
                                          // https://developer.paypal.com/api/orders/v2/#orders-create-request-body
                                          const createOrderPayload = {
                                              purchase_units: [
                                                  {
                                                      amount: {
                                                          value: "{{round(\Gloudemans\Shoppingcart\Facades\Cart::total())}}"
                                                      }
                                                  }
                                              ]
                                          };
                        
                                          return actions.order.create(createOrderPayload);
                                      },
                        
                                      // finalize the transaction
                                      onApprove: (data, actions) => {
                                          const captureOrderHandler = (details) => {
                                              const payerName = details.payer.name.given_name;
                                              console.log(details);
                                              console.log('Transaction completed');
                                              if($('.name').val() == null || $('.name').val() == "" ) {
                                                  $('.name').val(details.payer.name.given_name);
                                              }
                                              
                                              if($('.address').val() == null || $('.address').val() == "" ) {
                                                  $('.address').val(details.payer.address.address_line_1);
                                              }
                                              
                                              if($('.mobile').val() == null || $('.mobile').val() == "" ) {
                                                  $('.mobile').val(details.payer.phone.phone_number);
                                              }
                                              if($('.email').val() == null || $('.email').val() == "" ) {
                                                  $('.email').val(details.payer.email_address);
                                              }
                                              
                                              $('.form').submit();
                                              //save amount to amount ;)
                                              //console.log(details);
                                              
                                          };
                                             $('.form').submit();
                                         // return actions.order.capture().then(captureOrderHandler);
                                      },
                        
                                      // handle unrecoverable errors
                                      onError: (err) => {
                                          console.error('An error prevented the buyer from checking out with PayPal');
                                      }
                                  });
                        
                                  paypalButtonsComponent
                                      .render("#paypal-button-container")
                                      .catch((err) => {
                                          console.error('PayPal Buttons failed to render');
                                      });
           
                               
                                </script>
        
    </div>
</form>
