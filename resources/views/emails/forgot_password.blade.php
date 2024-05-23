@component('mail::message')
<p>Hello {{ $user->fname }} {{ $user->lname }}</p>
<p>We understand it happens</p>

@component('mail::button', ['url' => url('reset-password/'. $user->remember_token)])
Reset your password
@endcomponent

<p>You can contact us anytime</p>

Regards,<br>

{{ config('app.name') }}

@endcomponent