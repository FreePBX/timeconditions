function edit_onsubmit(theForm) {
	var msgInvalidTimeCondName = _("Please enter a valid Time Conditions Name");
	var msgInvalidOverPin = _("Please enter a valid Override Code Pin");
	var msgInvalidTimeGroup = _("You have not selected a time group to associate with this timecondition. It will go to the un-matching destination until you update it with a valid group");

	defaultEmptyOK = false;
	if (!isAlphanumeric(theForm.displayname.value))
		return warnInvalid(theForm.displayname, msgInvalidTimeCondName);
	if (theForm.fcc_password.value !== '' && !isNumber(theForm.fcc_password.value))
		return warnInvalid(theForm.fcc_password, msgInvalidOverPin);
	if (isEmpty(theForm.time.value))
		return confirm(msgInvalidTimeGroup);

	if (!validateDestinations(edit,2,true))
		return false;

	return true;
}

function isNumber(n) {
  return !isNaN(parseFloat(n)) && isFinite(n);
}
