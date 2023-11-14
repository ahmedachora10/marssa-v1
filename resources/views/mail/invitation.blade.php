@component('mail::message') 
# دعوة لتجربة منصة المرصة 

لقد تم دعوتك من قبل 
## {{ auth()->user()->email ?? auth()->user()->name  }} 
لكى تبدأ فى عرض منتجاتك للبيع و أو زيادة طلبات البيع لديك باستخدام أفضل منصة للتجارة اللالكترونية فى الشرق الاوسط

@component('mail::button', ['url' => url('register?reference_id='.auth()->user()->affiliates->code_affiliate)])
قم بالتسجيل الان و ابدأ فى تجارتك
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
