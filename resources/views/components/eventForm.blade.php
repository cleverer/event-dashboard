<form method="post" id="add-event-form">
	<div class="row">
		<div class="col-sm-8">
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label for="add-date">Datum*</label>
						<div class="datepicker"></div>
						<input type="hidden" name="add-date" value="<?php //$date = $this->formValue('add-date', $task, $onlyOnError); echo (!empty($date) ? $date : date('Y-m-d')); ?>" id="add-date" required>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<label for="add-title">Titel*</label>
						<input type="text" placeholder="Titel" id="add-title" name="add-title" class="form-control" required value="<? //$this->formValue('add-title', $task, $onlyOnError); ?>">
					</div>
					<div class="form-group">
						<label for="add-time">Zeit</label>
						<input type="time" id="add-time" name="add-time" class="form-control" value="<?php //$time = $this->formValue('add-time', $task, $onlyOnError); if (!empty($time)) { echo (DateTime::createFromFormat('H:i:s', $time))->format('H:i'); } ?>" pattern="^[0-2][\d]:[0-5][\d](:[0-5][\d])?$" placeholder="09:00">
					</div>
					<div class="form-group">
						<label for="add-location">Ort</label>
						<input type="text" id="add-location" name="add-location" class="form-control" value="<? //$this->formValue('add-location', $task, $onlyOnError); ?>">
					</div>
					<div class="form-group">
						<label for="add-costs">Kosten</label>
						<input type="text" id="add-costs" name="add-costs" class="form-control" value="<? //$this->formValue('add-costs', $task, $onlyOnError); ?>">
					</div>
				</div>
			</div>
			<div>
				<div class="form-group">
					<label for="add-description">Beschreibung*</label>
					<textarea class="form-control" id="add-description" name="add-description" required=""><? //$this->formValue('add-description', $task, $onlyOnError); ?></textarea>
				</div>
				<input type="hidden" name="task" value="<? //$task ?>">
				<?php /*if (count($this->errors) > 0) { ?>
					<p class="error"><?= implode('<br>', $this->errors) ?></p>
				<?php } ?>
				<?php if ($task == 'editEntry') { ?>
					<input type="hidden" name="add-id" value="<?= $_GET['id'] ?>">
				<?php } */?>
				<div class="form-row flex-column flex-md-row align-items-stretch mb-3 mb-sm-0">
					<div class="col-md-auto"><button type="submit" class="btn btn-block btn-light" value="add" name="submit"><? //($task == 'editEntry') ? 'Änderungen speichern' : 'Anlass hinzufügen' ?></button></div>
					<?php /*if ($task == 'editEntry') { ?>
						<div class="col-md-auto mt-2 mt-sm-2 mt-md-0"><button type="submit" class="btn btn-block btn-danger" value="delete" name="submit">Anlass löschen</button></div>
					<?php } */?>
				</div>
			</div>
		</div>
		<div class="col-sm-4">
			<h3>Kontaktperson</h3>
			<div class="form-group">
				<label for="add-contact-name">Name</label>
				<input type="text" id="add-contact-name" class="form-control" name="add-contact-name" value="<? //$this->formValue('add-contact-name', $task, $onlyOnError); ?>">
			</div>
			<div class="form-group">
				<label for="add-contact-tel">Telefon</label>
				<input type="tel" id="add-contact-tel" class="form-control" name="add-contact-tel" value="<? //$this->formValue('add-contact-tel', $task, $onlyOnError); ?>">
			</div>
			<div class="form-group">
				<label for="add-contact-email">E-Mail*</label>
				<input type="email" id="add-contact-email" class="form-control" name="add-contact-email" value="<? //$this->formValue('add-contact-email', $task, $onlyOnError); ?>" required>
			</div>
			<h3>Anmeldung</h3>
			<div class="form-check">
				<label class="form-check-label">
					<input class="form-check-input" type="checkbox" value="1" id="add-registration-required" name="add-registration-required"<? //!empty($this->formValue('add-registration-required', $task, $onlyOnError)) ? ' checked' : '' ?>>
					Anmeldung erforderlich
				</label>
			</div>
			<div class="registration-details">
				<div class="form-check">
					<label class="form-check-label mb-1">
						<input class="form-check-input" type="checkbox" value=""<? //!empty($this->formValue('add-registration-email', $task, $onlyOnError)) ? ' checked' : '' ?>>
						per E-mail an:
					</label>
					<input type="email" class="form-control" name="add-registration-email" placeholder="E-mail" value="<? //$this->formValue('add-registration-email', $task, $onlyOnError); ?>">
				</div>
				<div class="form-check">
					<label class="form-check-label mb-1">
						<input class="form-check-input" type="checkbox" value=""<? //!empty($this->formValue('add-registration-tel', $task, $onlyOnError)) ? ' checked' : '' ?>>
						per Telefon an:
						</label>
					<input type="tel" class="form-control" name="add-registration-tel" placeholder="Telefon" value="<? //$this->formValue('add-registration-tel', $task, $onlyOnError); ?>">
				</div>
				<div class="form-check">
					<label class="form-check-label mb-1">
						<input class="form-check-input" type="checkbox" value=""<? //!empty($this->formValue('add-registration-url', $task, $onlyOnError)) ? ' checked' : '' ?>>
						auf der Webseite:
					</label>
					<input type="url" class="form-control" name="add-registration-url" placeholder="Webseite" novalidate value="<? //$this->formValue('add-registration-url', $task, $onlyOnError); ?>" pattern="https?://.+\..+">
				</div>
			</div>
		</div>
	</div>
</form>
