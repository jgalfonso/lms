@php
	$prefix = Request::segments()[0];
	$group = (isset(Request::segments()[1])) ? Request::segments()[1] : '';
	$controller = (isset(Request::segments()[2])) ? Request::segments()[2] : '';
    $event = (isset(Request::segments()[3])) ? Request::segments()[3] : '';
    $action = (isset(Request::segments()[4])) ? Request::segments()[4] : '';
    $parameter = (isset(Request::segments()[5])) ? Request::segments()[5] : '';

    $url = 'admin/'. $group .'/'. $controller;
@endphp

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item">{{ ucwords(str_replace('-', ' ', $group)) }}</li>


        @switch($group) 
        	@case("manage-users") 
        		
        		@if ($event)
        			<li class="breadcrumb-item"><a href="{{ url($url) }}">{{ ucwords(str_replace('-', ' ', $controller)) }}</a></li>

        			@if ($action)
        				<li class="breadcrumb-item">{{ ucwords(str_replace('-', ' ', $event)) }}</li>
        				<li class="breadcrumb-item active">{{ ucwords(str_replace('-', ' ', $action)) }}</li>
        			@else
        				<li class="breadcrumb-item active">{{ ucwords(str_replace('-', ' ', $event)) }}</li>
        			@endif
        		@else
        			<li class="breadcrumb-item active">{{ ucwords(str_replace('-', ' ', $controller)) }}</li>
        		@endif

        		@break
        	@case("setup")

        		@if ($event)
        			<li class="breadcrumb-item"><a href="{{ url($url) }}">{{ ucwords(str_replace('-', ' ', $controller)) }}</a></li>

        			@if ($action)
        				<li class="breadcrumb-item">{{ ucwords(str_replace('-', ' ', $event)) }}</li>
        				<li class="breadcrumb-item active">{{ ucwords(str_replace('-', ' ', $action)) }}</li>
        			@else
        				<li class="breadcrumb-item active">{{ ucwords(str_replace('-', ' ', $event)) }}</li>
        			@endif
        		@else
        			<li class="breadcrumb-item active">{{ ucwords(str_replace('-', ' ', $controller)) }}</li>
        		@endif

        		@break
        	@default

        		<li class="breadcrumb-item">{{ ucwords(str_replace('-', ' ', $controller)) }}</li>

        		@if ($event)
        			@if ($action)
	        			<li class="breadcrumb-item"><a href="{{ url($url.'/'.$event) }}">{{ ucwords(str_replace('-', ' ', $event)) }}</a></li>
	        				
	        			@if ($parameter)
	        				<li class="breadcrumb-item">{{ ucwords(str_replace('-', ' ', $action)) }}</li>
	        				<li class="breadcrumb-item active">{{ ucwords(str_replace('-', ' ', $parameter)) }}</li>
	        			@else
	        				<li class="breadcrumb-item active">{{ ucwords(str_replace('-', ' ', $action)) }}</li>
	        			@endif
        			@else

        				<li class="breadcrumb-item active">{{ ucwords(str_replace('-', ' ', $event)) }}</li>
        			@endif
        		@else
        			<li class="breadcrumb-item active">{{ ucwords(str_replace('-', ' ', $controller)) }}</li>
        		@endif

        		@break
    	@endswitch
    </ol>
</nav>
