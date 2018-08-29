
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

$(document).ready(function() {

	var date = new Date($('#date').val());
	$(".datepicker").datepicker({
		"altField": '#date',
		"defaultDate": date,
		"dateFormat": $.datepicker.ISO_8601,
		"minDate": 0,
	});

	$("#registration_required").on("change", function(event) {
		if($(this).is(":checked")) {
			$(".registration_details").slideDown();
		} else {
			$(".registration_details").slideUp();
		}
	}).trigger('change');

	$("#auth-form").on("submit", authFormSubmit);

	checkLogin();
});

function authFormSubmit(event) {

	event.preventDefault();

	var prev_text = $("#auth-form-submit").text()
	$("#auth-form-submit").attr("disabled", true).html("Prüfen...");

	$.ajax({
		type: "POST",
		url:'/api/login',
		data: {
			'password': $("#auth-password").val()
		}
	})
		.always(function() {

			$("#auth-form-submit").attr("disabled", false).html(prev_text);
			$("#auth-form").removeClass("was-validated");
			$("#auth-password")[0].setCustomValidity('');
			$("#auth-error").hide();

		})
		.fail(function(jqXHR, textStatus, errorThrown) {

			$("#auth-form").addClass("was-validated");
			$("#auth-password")[0].setCustomValidity('Invalid!');
			$("#auth-error").fadeIn();

		})
		.done(function(data, textStatus, jqXHR){

			$("#auth-form").addClass("was-validated");
			showNewEntryForm();

		});

}

function checkLogin() {

	$.post({
		url:'/api/login/status',
	}).always(function(data, textStatus, jqXHR) {

		if (data.status == 200) {
			showNewEntryForm(0);
		}

	});

}

function showNewEntryForm(slideAnimation) {

	$("#add-event-card, #newsletter-card").parent(".col-sm-6").removeClass("col-sm-6").addClass("col-sm-12");
	$("#auth-form, #pwd-hint").hide();
	$("#event-form").slideDown(slideAnimation);

}
