@props([
    'accent' => '#C6242A',
    'maxWidth' => '320px',
])

<svg
    viewBox="0 0 400 300"
    fill="none"
    xmlns="http://www.w3.org/2000/svg"
    {{ $attributes->merge(['style' => "width: 100%; height: auto; max-width: {$maxWidth}; display: block;"]) }}
>
    <circle cx="335" cy="55" r="26" fill="white" fill-opacity="0.12" />

    <rect x="0" y="262" width="400" height="3" fill="white" fill-opacity="0.2" />

    <circle cx="55" cy="248" r="14" fill="white" fill-opacity="0.18" />
    <rect x="52" y="256" width="6" height="10" fill="white" fill-opacity="0.18" />

    <rect x="20" y="120" width="80" height="142" rx="4" fill="white" fill-opacity="0.14" />
    <rect x="33" y="138" width="14" height="14" rx="2" fill="white" fill-opacity="0.3" />
    <rect x="63" y="138" width="14" height="14" rx="2" fill="white" fill-opacity="0.3" />
    <rect x="33" y="164" width="14" height="14" rx="2" fill="white" fill-opacity="0.3" />
    <rect x="63" y="164" width="14" height="14" rx="2" fill="white" fill-opacity="0.3" />
    <rect x="33" y="190" width="14" height="14" rx="2" fill="white" fill-opacity="0.3" />
    <rect x="63" y="190" width="14" height="14" rx="2" fill="white" fill-opacity="0.3" />

    <rect x="290" y="150" width="76" height="112" rx="4" fill="white" fill-opacity="0.22" />
    <rect x="303" y="167" width="13" height="13" rx="2" fill="white" fill-opacity="0.4" />
    <rect x="329" y="167" width="13" height="13" rx="2" fill="white" fill-opacity="0.4" />
    <rect x="303" y="192" width="13" height="13" rx="2" fill="white" fill-opacity="0.4" />
    <rect x="329" y="192" width="13" height="13" rx="2" fill="white" fill-opacity="0.4" />
    <rect x="303" y="217" width="13" height="13" rx="2" fill="white" fill-opacity="0.4" />
    <rect x="329" y="217" width="13" height="13" rx="2" fill="white" fill-opacity="0.4" />

    <rect x="130" y="55" width="140" height="207" rx="6" fill="white" />
    <rect x="130" y="55" width="140" height="8" rx="4" fill="white" />

    <rect x="150" y="78" width="16" height="16" rx="2" fill="{{ $accent }}" />
    <rect x="178" y="78" width="16" height="16" rx="2" fill="{{ $accent }}" />
    <rect x="206" y="78" width="16" height="16" rx="2" fill="{{ $accent }}" />
    <rect x="234" y="78" width="16" height="16" rx="2" fill="{{ $accent }}" />

    <rect x="150" y="106" width="16" height="16" rx="2" fill="{{ $accent }}" />
    <rect x="178" y="106" width="16" height="16" rx="2" fill="{{ $accent }}" />
    <rect x="206" y="106" width="16" height="16" rx="2" fill="{{ $accent }}" />
    <rect x="234" y="106" width="16" height="16" rx="2" fill="{{ $accent }}" />

    <rect x="150" y="134" width="16" height="16" rx="2" fill="{{ $accent }}" />
    <rect x="178" y="134" width="16" height="16" rx="2" fill="{{ $accent }}" />
    <rect x="206" y="134" width="16" height="16" rx="2" fill="{{ $accent }}" />
    <rect x="234" y="134" width="16" height="16" rx="2" fill="{{ $accent }}" />

    <rect x="150" y="162" width="16" height="16" rx="2" fill="{{ $accent }}" />
    <rect x="178" y="162" width="16" height="16" rx="2" fill="{{ $accent }}" />
    <rect x="206" y="162" width="16" height="16" rx="2" fill="{{ $accent }}" />
    <rect x="234" y="162" width="16" height="16" rx="2" fill="{{ $accent }}" />

    <rect x="150" y="190" width="16" height="16" rx="2" fill="{{ $accent }}" />
    <rect x="234" y="190" width="16" height="16" rx="2" fill="{{ $accent }}" />

    <rect x="183" y="222" width="34" height="40" rx="3" fill="{{ $accent }}" />
    <circle cx="210" cy="242" r="1.6" fill="white" />
</svg>
