@component('mail::message')
Bonjour <span>{{$name.' '.$firstname}},</span>

<p>{{$text}}</p>
@component('mail::button', ['url' => config('app.url'), 'color' => 'success'])
Connexion
@endcomponent

Cordialement,<br>
l'équipe {{ config('app.name') }}
@endcomponent
