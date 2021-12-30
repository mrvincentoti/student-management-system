@component('mail::message')

# @lang('Welcome to') {{ config('app.name') }},<br>

{{ $title }},<br>

@lang('Hi') {{ $name }},

@lang('We are sorry to imform you that your application has been declined'),<br>
@lang('for the above reason'),<br>

{{ $message }},<br>



@component('mail::button', ['url' => url('student-verification')])
@lang('Visit portal')
@endcomponent

@lang('Thanks'),<br>
{{ config('app.name') }}
@endcomponent