<x-mail::message>
# Welcome to {{ config('app.name') }} {{ $userData['name'] }}

Your login credentials are:

User ID: {{ $userData['id'] }}

Password: {{ $userData['pass'] }}

<x-mail::button :url="config('app.url')">
    Login Now
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>