<x-mail::message>
{{-- Saludo --}}
@if (! empty($greeting))
# {{ $greeting }}
@else
@if ($level === 'error')
# ¡Ups! Algo salió mal
@else
# ¡Hola!
@endif
@endif

{{-- Mensaje principal --}}
@foreach ($introLines as $line)
{{ $line }}

@endforeach

{{-- Botón de acción --}}
@isset($actionText)
<?php
    $color = match ($level) {
        'success' => 'green',
        'error' => 'red',
        default => 'blue', // Cambiado para que coincida con tu branding
    };
?>
<x-mail::button :url="$actionUrl" :color="$color">
{{ $actionText }}
</x-mail::button>
@endisset

{{-- Mensaje de cierre --}}
@foreach ($outroLines as $line)
{{ $line }}

@endforeach

{{-- Despedida --}}
@if (! empty($salutation))
{{ $salutation }}
@else
¡Un saludo!<br>
{{ config('app.name') }}
@endif

{{-- Subcopy (opcional, cuando hay botón) --}}
@isset($actionText)
<x-slot:subcopy>
Si tienes problemas para hacer clic en el botón "{{ $actionText }}", copia y pega esta URL en tu navegador:<br>
<span class="break-all">[{{ $displayableActionUrl }}]({{ $actionUrl }})</span>
</x-slot:subcopy>
@endisset
</x-mail::message>
