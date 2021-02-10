@php
    $name = Request::segments()[0];
    $prefix = Request::segments()[1];
    $action = (isset(Request::segments()[2])) ? Request::segments()[2] : '';
@endphp

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
        <li class="breadcrumb-item"><a style="cursor: not-allowed;">{{ ucfirst($name) }}</a></li>

        @if ($action)
            <li class="breadcrumb-item"><a href="{{ url($name .'/'. $prefix) }}">{{ ucwords(str_replace('_', ' ', $prefix)) }}</a></li>

            @if ($action == 'view')
                <li class="breadcrumb-item active" aria-current="page"><b>ID: {{ $id }} - <mark class="text-uppercase text-info">{{ ${$prefix}->internal_status_description }}</mark></b></li>
            @else
                <li class="breadcrumb-item active" aria-current="page">{{ ucfirst($action) }}</li>
            @endif
        @else
            <li class="breadcrumb-item active" aria-current="page">{{ str_replace('Of', 'of', ucwords(str_replace('_', ' ', $prefix))) }}</li>
        @endif
    </ol>
</nav>
