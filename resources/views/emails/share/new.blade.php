@component('mail::message')
# Hey, {{ $user }} heeft een babylijst met jou gedeeld

Om toegang te krijgen tot deze baylijst moet je eerst het onderstaande wachtwoord ingeven
{{$babylist->password}}

@component('mail::button', ['url' => 'http://127.0.0.1:8000/{{$url}}'])
Bebijk babylijst
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
