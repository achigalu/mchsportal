@component('mail::message')
<p>Hello {{ $user->lname }}</p>
@component('mail::button', ['url' => url('verify/'.$user->remember_token)])

verify

@endcomponent

<p>Thank you for choosing us</p>
</br>
{{ config('app.name') }}

@endcomponent