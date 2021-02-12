@php
	$prefix = Request::segments()[0];


	$group = (isset(Request::segments()[1])) ? Request::segments()[1] : '';


	$controller = (isset(Request::segments()[2])) ? Request::segments()[2] : '';
    $event = (isset(Request::segments()[3])) ? Request::segments()[3] : '';
    $action = (isset(Request::segments()[4])) ? Request::segments()[4] : '';
    $url = $controller == 'archive_galleries' ? 'admin/'. $group .'/'. $controller.'/'.$event : 'admin/'. $group .'/'. $controller;
@endphp

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        @if ($group == 'email-template')
            @if($controller)
                <li class="breadcrumb-item"><a href="/admin/email-template">{{ ucwords(str_replace('-', ' ', $group)) }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ ucfirst($controller) }}</li>
            @else
                <li class="breadcrumb-item">{{ ucwords(str_replace('-', ' ', $group)) }}</li>
            @endif
        @else
            <li class="breadcrumb-item">{{ ucwords(str_replace('-', ' ', $group)) }}</li>
        @endif

		@if ($controller && $group != 'email-template')
			@if ($event)
				<li class="breadcrumb-item"><a href="{{ url($url) }}">{{ ucwords(str_replace('-', ' ', $controller)) }}</a></li>
				<li class="breadcrumb-item active" aria-current="page">{{ ucfirst($event) }}</li>
			@else
				<li class="breadcrumb-item active" aria-current="page">{{ ucwords(str_replace('-', ' ', $controller)) }}</li>
			@endif
		@endif
    </ol>
</nav>
