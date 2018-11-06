<form method="POST" id="event-form" action="{{ $actionUrl }}">
    @csrf
	<div class="row">
		<div class="col-sm-8">
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label for="date">Datum*</label>
						<div class="datepicker"></div>
						<input type="hidden" name="date" value="{{ old('date') ?? $event->date ?? \Carbon\Carbon::now()->toIso8601String() }}" id="date" required>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<label for="title">Titel*</label>
						<input type="text" placeholder="Titel" id="title" name="title" class="form-control" required value="{{ old('title') ?? $event->title ?? "" }}">
					</div>
					<div class="form-group">
						<label for="time">Zeit</label>
						<input type="time" id="time" name="time" class="form-control" value="{{ old('time') ?? (isset($event) ? $event->getFormattedTime() : "") }}" pattern="^[0-2][\d]:[0-5][\d]$" placeholder="09:00">
					</div>
					<div class="form-group">
						<label for="location">Ort</label>
						<input type="text" id="location" name="location" class="form-control" value="{{ old('location') ?? $event->location ?? "" }}">
					</div>
					<div class="form-group">
						<label for="costs">Kosten</label>
						<input type="text" id="costs" name="costs" class="form-control" value="{{ old('costs') ?? $event->costs ?? "" }}">
					</div>
				</div>
			</div>
			<div>
				<div class="form-group">
					<label for="description">Beschreibung*</label>
					<textarea class="form-control" id="description" name="description" required="">{{ old('description') ?? $event->description ?? "" }}</textarea>
				</div>
			</div>
		</div>
		<div class="col-sm-4">
			<h3>Kontaktperson</h3>
			<div class="form-group">
				<label for="contact_name">Name</label>
				<input type="text" id="contact_name" class="form-control" name="contact_name" value="{{ old('contact_name') ?? $event->contact_name ?? "" }}">
			</div>
			<div class="form-group">
				<label for="contact_tel">Telefon</label>
				<input type="tel" id="contact_tel" class="form-control" name="contact_tel" value="{{ old('contact_tel') ?? $event->contact_tel ?? "" }}">
			</div>
			<div class="form-group">
				<label for="contact_email">E-Mail*</label>
				<input type="email" id="contact_email" class="form-control" name="contact_email" value="{{ old('contact_email') ?? $event->contact_email ?? "" }}" required>
			</div>
			<h3>Anmeldung</h3>
			<div class="registration_details">
				<div class="form-group">
					<label for="registration_email">per E-mail an:</label>
					<input type="email" class="form-control" id="registration_email" name="registration_email" placeholder="E-mail" value="{{ old('registration_email') ?? $event->registration_email ?? "" }}">
				</div>
				<div class="form-group">
					<label for="registration_tel">per Telefon an:</label>
					<input type="tel" class="form-control" id="registration_tel" name="registration_tel" placeholder="Telefon" value="{{ old('registration_tel') ?? $event->registration_tel ?? "" }}">
				</div>
				<div class="form-group">
					<label for="registration_url">auf der Webseite:</label>
					<input type="url" class="form-control" id="registration_url" name="registration_url" placeholder="Webseite" novalidate value="{{ old('registration_url') ?? $event->registration_url ?? "" }}" pattern="https?://.+\..+">
				</div>
			</div>
		</div>
	</div>
	<div class="row">
	    <div class="col">
			@if ($errors->any())
				<div class="alert alert-danger" role="alert">
				    {!! implode('<br>', $errors->all()) !!}
                </div>
			@endif
			<div class="form-row flex-column flex-md-row align-items-stretch mb-3 mb-sm-0">
				<div class="col-md-auto"><button type="submit" class="btn btn-block btn-light" value="add" name="submit">{{ isset($event) ? 'Änderungen speichern' : 'Anlass hinzufügen' }}</button></div>
				@if (isset($event))
					<div class="col-md-auto mt-2 mt-sm-2 mt-md-0"><button type="submit" class="btn btn-block btn-danger" value="delete" name="submit">Anlass löschen</button></div>
				@endif
			</div>
	    </div>
	</div>
</form>
