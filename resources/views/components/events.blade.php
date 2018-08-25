<h1 class="mb-3">{{ config('app.name') }}</h1>
<div class="card-columns">
    @foreach($events as $event)
        @include('components.event')
    @endforeach
</div>
