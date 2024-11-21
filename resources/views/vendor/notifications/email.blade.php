<x-mail::message>
{{-- Custom Shopedia Greeting --}}
@if (! empty($greeting))
# {{ $greeting }}
@else
@if ($level === 'error')
# @lang('Oops! Something went wrong.')
@else
# @lang('Welcome to Shopedia!')
@endif
@endif

{{-- Logo --}}
<div style="text-align: center; margin-bottom: 20px;">
    <img src="{{ asset('images/Shopedia Text Logo/4x/Layer 1@4x.png') }}" alt="Shopedia Logo" style="height: 60px;">
</div>

{{-- Intro Lines --}}
@foreach ($introLines as $line)
<p style="font-size: 16px; color: #555;">
    {{ $line }}
</p>
@endforeach

{{-- Action Button --}}
@isset($actionText)
<?php
    $color = match ($level) {
        'success', 'error' => $level,
        default => '#6C63FF', // Shopedia purple
    };
?>
<div style="text-align: center; margin: 30px 0;">
    <a href="{{ $actionUrl }}" style="
        background-color: {{ $color }};
        color: #fff;
        padding: 12px 24px;
        font-size: 16px;
        font-weight: bold;
        text-decoration: none;
        border-radius: 8px;
        display: inline-block;">
        {{ $actionText }}
    </a>
</div>
@endisset

{{-- Outro Lines --}}
@foreach ($outroLines as $line)
<p style="font-size: 16px; color: #555;">
    {{ $line }}
</p>
@endforeach

{{-- Footer --}}
@if (! empty($salutation))
{{ $salutation }}
@else
<p style="font-size: 16px; color: #555;">
    @lang('Best regards,')<br>
    <strong style="color: #6C63FF;">Shopedia Team</strong>
</p>
@endif

{{-- Subcopy --}}
@isset($actionText)
<x-slot:subcopy>
<p style="font-size: 14px; color: #999; text-align: center;">
    @lang(
        "If you're having trouble clicking the \":actionText\" button, copy and paste the URL below\n".
        'into your web browser:',
        [
            'actionText' => $actionText,
        ]
    ) 
    <br>
    <a href="{{ $actionUrl }}" style="color: #6C63FF;">{{ $displayableActionUrl }}</a>
</p>
</x-slot:subcopy>
@endisset
</x-mail::message>
