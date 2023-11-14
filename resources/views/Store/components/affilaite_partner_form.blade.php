<div class="min-h-screen bg-gray-100 text-gray-900 flex justify-center">
    <div class="max-w-screen-xl m-0 sm:m-20 bg-white shadow sm:rounded-lg flex justify-center flex-1" style="box-shadow: none !important;">
      <div class="lg:w-1/2 xl:w-5/12 p-6 sm:p-12">
          
        @if (session('message'))
            <div class="small-spacing">
                <div class="col-xs-12">
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <strong>{{ __('master.'.session('message')) }}</strong>
                    </div>
                </div>
            </div>
        @endif
        
      
        <div class="mt-12 flex flex-col items-center">
          <h1 class="text-2xl xl:text-3xl font-extrabold">
           قم بالانضمام الينا فى خدمة التسويق بالعمولة و كن شريكا لنا 
          </h1>
          
          <div class="w-full flex-1 mt-8">
            <div class="my-12 border-b text-center">
              <div
                class="leading-none px-2 inline-block text-sm text-gray-600 tracking-wide font-medium bg-white transform translate-y-1/2"
                style="font-family: Roboto,'Droid Arabic Kufi' !important;"
              >
                قم بالانضمام الى المتجر الان كشريكا معنا 
              </div>
            </div>

            <div class="mx-auto max-w-xs">
                  
                    <ul>
                        @foreach($errors->all() as $error)
                            <li class="alert alert-danger">
                                 <strong> {{ $error }} </strong>
                            </li>
                        @endforeach
                        
                    </ul>
                    
                    {{ Session::get('error') }}
                  
                   @if(isset($error))
                    <div class="alert alert-danger">
                        
                        {{ $error }}
                        
                    </div>
                  @endif
                  
                  
        
                <form method="post" action="{{ url('/marketplace/join_as_partner_affiliate') }}">
                    {{ csrf_field() }}
                    
                      <label style="font-family: Roboto,'Droid Arabic Kufi' !important;">الاسم المستخدم</label>
                      <input
                        class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white"
                        type="name"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="الاسم بالكامل"
                      />
                      
                      <br/><br/>
                      
                      <label style="font-family: Roboto,'Droid Arabic Kufi' !important;">البريد الالكترونى الخاص بك</label>
                      <input
                        class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="البريد الالكترونى الخاص بك"
                      />
                      
                      <br/><br/>
                      
                      <label style="font-family: Roboto,'Droid Arabic Kufi' !important;">رقم الواتساب</label>
                      <input
                        class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white"
                        type="phone"
                        name="mobile"
                        value="{{ old('mobile') }}"
                        placeholder="(20 مفتاح الدولة) 3**** "
                      />
                      
                      <br/><br/>
                      
                      <label style="font-family: Roboto,'Droid Arabic Kufi' !important;">كلمة المرور</label>
                      <input
                        class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white"
                        type="password"
                        name="password"
                        value=""
                        placeholder="****"
                      />
                  
                      <button
                        class="mt-5 tracking-wide font-semibold bg-indigo-500 text-gray-100 w-full py-4 rounded-lg hover:bg-indigo-700 transition-all duration-300 ease-in-out flex items-center justify-center focus:shadow-outline focus:outline-none"
                        style="background-color:#4c51bf !important"
                      >
                        
                        <span class="ml-3" style="font-family: Roboto,'Droid Arabic Kufi' !important;">
                          الاشتراك الان 
                        </span>
                      </button>
                </form>
            </div>
          </div>
        </div>
      </div>
      <div class="flex-1 bg-indigo-100 text-center hidden lg:flex">
        <div
          class="m-12 xl:m-16 w-full bg-contain bg-center bg-no-repeat"
          style="background-image: url('https://diviflash.com/wp-content/uploads/2022/06/DiviFlash-Affiliate-Program.svg');"
        ></div>
      </div>
    </div>
    
</div>