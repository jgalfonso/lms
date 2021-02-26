@php
	$prefix = Request::segments()[0];
	$group = (isset(Request::segments()[1])) ? Request::segments()[1] : '';

	$controller = (isset(Request::segments()[2])) ? Request::segments()[2] : '';

    $event = (isset(Request::segments()[3])) ? Request::segments()[3] : '';
    $action = (isset(Request::segments()[4])) ? Request::segments()[4] : '';
    $url = 'admin/'. $group .'/'. $controller;
@endphp

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item">{{ ucwords(str_replace('-', ' ', $group)) }}</li>
        
		@if ($event)
			<li class="breadcrumb-item"><a href="{{ url($url) }}">{{ ucwords(str_replace('-', ' ', $controller)) }}</a></li>
			<li class="breadcrumb-item active" aria-current="page">{{ ucwords(str_replace('-', ' ', $event)) }}</li>
		@else
			<li class="breadcrumb-item active" aria-current="page">{{ ucwords(str_replace('-', ' ', $controller)) }}</li>
		@endif
    </ol>
</nav>
