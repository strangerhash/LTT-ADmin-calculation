@component('mail::message')
# Introduction

The body of your message.

<div>
    Price: {!! print_r($content) !!}
</div>



@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
