<div class="card">
	<h3 class="card-header h4">
		{{ $event->getFormattedDate() }}
	</h3>
	<div class="card-body">
		<h4 class="card-title">{{ $event->title }}</h4>
		<p class="card-text">{!! nl2br(htmlspecialchars($event->description)) !!}</p>
	</div>
	<ul class="list-group list-group-flush">
		@if(!is_null($event->time))
			<li class="list-group-item">
				Zeit: {{ $event->getFormattedTime() }}
			</li>
		@endif
		@if(!is_null($event->location))
			<li class="list-group-item">
				Ort: {{ $event->location }}
			</li>
		@endif
		@if(!is_null($event->costs))
			<li class="list-group-item">
				Kosten: {{ $event->costs }}
			</li>
		@endif
		@if($event->hasContactInfo())
			<li class="list-group-item">
				<h5>Kontaktperson</h5>
				{!! implode("<br>", $event->getContactInfo()) !!}
			</li>
		@endif
		@if($event->hasRegistrationInfo())
			<li class="list-group-item">
				<h5>Anmeldung</h5>
				{!! implode("<br>", $event->getRegistrationInfo()) !!}
			</li>
		@endif
	</ul>
</div>
