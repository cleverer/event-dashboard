<form method="post" id="add-event-form">
	<div class="row">
		<div class="col-sm-8">
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label for="add-date">Datum*</label>
						<div class="datepicker"></div>
						<input type="hidden" name="add-date" value="{{ $event->date ?? \Carbon\Carbon::now()->toIso8601String() }}" id="add-date" required>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<label for="add-title">Titel*</label>
						<input type="text" placeholder="Titel" id="add-title" name="add-title" class="form-control" required value="{{ $event->title ?? "" }}">
					</div>
					<div class="form-group">
						<label for="add-time">Zeit</label>
						<input type="time" id="add-time" name="add-time" class="form-control" value="{{ isset($event) ? $event->getFormattedTime() : "" }}" pattern="^[0-2][\d]:[0-5][\d](:[0-5][\d])?$" placeholder="09:00">
					</div>
					<div class="form-group">
						<label for="add-location">Ort</label>
						<input type="text" id="add-location" name="add-location" class="form-control" value="{{ $event->location ?? "" }}">
					</div>
					<div class="form-group">
						<label for="add-costs">Kosten</label>
						<input type="text" id="add-costs" name="add-costs" class="form-control" value="{{ $event->costs ?? "" }}">
					</div>
				</div>
			</div>
			<div>
				<div class="form-group">
					<label for="add-description">Beschreibung*</label>
					<textarea class="form-control" id="add-description" name="add-description" required="">{{ $event-> description ?? "" }}</textarea>
				</div>
				@if (count($errors) > 0)
					<p class="error">{!! implode('<br>', $errors) !!}</p>
				@endif
				<div class="form-row flex-column flex-md-row align-items-stretch mb-3 mb-sm-0">
					<div class="col-md-auto"><button type="submit" class="btn btn-block btn-light" value="add" name="submit">{{ isset($event) ? 'Änderungen speichern' : 'Anlass hinzufügen' }}</button></div>
					@if (isset($event))
						<div class="col-md-auto mt-2 mt-sm-2 mt-md-0"><button type="submit" class="btn btn-block btn-danger" value="delete" name="submit">Anlass löschen</button></div>
					@endif
				</div>
			</div>
		</div>
		<div class="col-sm-4">
			<h3>Kontaktperson</h3>
			<div class="form-group">
				<label for="add-contact-name">Name</label>
				<input type="text" id="add-contact-name" class="form-control" name="add-contact-name" value="{{ $event->contact_name ?? "" }}">
			</div>
			<div class="form-group">
				<label for="add-contact-tel">Telefon</label>
				<input type="tel" id="add-contact-tel" class="form-control" name="add-contact-tel" value="{{ $event->contact_tel ?? "" }}">
			</div>
			<div class="form-group">
				<label for="add-contact-email">E-Mail*</label>
				<input type="email" id="add-contact-email" class="form-control" name="add-contact-email" value="{{ $event->contact_email ?? "" }}" required>
			</div>
			<h3>Anmeldung</h3>
			<div class="form-check form-group">
				<label class="form-check-label">
					<input class="form-check-input" type="checkbox" value="1" id="add-registration-required" name="add-registration-required"{{ (isset($event) && $event->registration_required) ? " checked" : "" }}>
					Anmeldung erforderlich
				</label>
			</div>
			<div class="registration-details">
				<div class="form-group">
					<label for="add-registration-email">per E-mail an:</label>
					<input type="email" class="form-control" id="add-registration-email" name="add-registration-email" placeholder="E-mail" value="{{ $event->registration_email ?? "" }}">
				</div>
				<div class="form-group">
					<label for="add-registration-tel">per Telefon an:</label>
					<input type="tel" class="form-control" id="add-registration-tel" name="add-registration-tel" placeholder="Telefon" value="{{ $event->registration_tel ?? "" }}">
				</div>
				<div class="form-group">
					<label for="add-registration-url">auf der Webseite:</label>
					<input type="url" class="form-control" id="add-registration-url" name="add-registration-url" placeholder="Webseite" novalidate value="{{ $event->registration_url ?? "" }}" pattern="https?://.+\..+">
				</div>
			</div>
		</div>
	</div>
</form>
