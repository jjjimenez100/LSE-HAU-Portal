@component('mail::message')
    <html>
    <head></head>
    <body>

    {{$heading}}

    {{$content}}

    @component('mail::button', ['url' => 'https://lsehau.esy.es'])
        Check out our site!
    @endcomponent

    If you have any inquiries or suggestions, you can reply to this email,
    @component('mail::panel')
        LSE-HAU-TEAM
    @endcomponent
    </body>
    </html>

@endcomponent
