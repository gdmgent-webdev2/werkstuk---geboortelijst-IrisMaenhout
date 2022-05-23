@component('mail::message')

# Hey, {{ $user }} heeft een babylijst met jou gedeeld!

Om toegang te krijgen tot deze baylijst moet je eerst het onderstaande wachtwoord ingeven.<br>
Wachtwoord: {{$babylist->password}}

Bekijk de gedeelde babylijst van [{{$babylist->first_name_child}} {{$babylist->last_name_child}}]({{ config('app.url') }}/{{$url}}).


Thanks,<br>
{{ config('app.name') }}
@endcomponent
