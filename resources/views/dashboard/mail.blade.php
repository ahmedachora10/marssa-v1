@component('mail::message')
@if(app()->getLocale() == 'ar')
<style>
p,h1 {
direction: rtl !important;
text-align: right !important;
}
</style>
@endif
# @lang('auth.Hello'), {{$content['name']}}

{{$content['response']}}

@lang('auth.Regards'),<br>
{{ config('app.name') }}
@endcomponent
{{--Developed Saed Z. Sinwar--}}