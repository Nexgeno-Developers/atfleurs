@php
    $name = $array['content']['name'];
    $email = $array['content']['email'];
    $phone = $array['content']['phone'];
    $subject = $array['content']['subject'];
    $message = $array['content']['message'];
@endphp

<p>
    Name: {{ $name }}<br>
    Email: {{ $email }}<br>
    Phone: {{ $phone }}<br>
    Subject: {{ $subject }}<br>
    Message: {{ $message }}
</p>
