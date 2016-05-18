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
function tcactionFormatter(value,row){
	var html = '';
	html += '<a href="?display=timeconditions&view=form&itemid='+value+'"><i class="fa fa-edit"></i></a>&nbsp;';
	html += '<a href="?display=timegroups&view=form&extdisplay='+row.time+'"><i class="fa fa-clock-o"></i></a>&nbsp;';
	html += '<a href="?display=timeconditions&action=delete&itemid='+value+'" class="delAction"><i class="fa fa-trash"></i></a>';
	return html;
}
function tcstateFormatter(value,row){
	var str = '';
	switch(value) {
		case "true_sticky":
			str = _("Permanently matched");
		break;
		case "false_sticky":
			str = _("Permanently unmatched");
		break;
		case "false":
			str = _("Temporary unmatched");
		break;
		case "true":
			str = _("Temporary matched");
		break;
		default:
			str = _("No Override");
		break;
	}
	return str;
}
$("#tcrnav").on('click-row.bs.table',function(e,row,elem){
  window.location = '?display=timeconditions&view=form&itemid='+row.timeconditions_id;
});

var previous;
$("#time").on('focus', function () {
	// Store the current value on focus and on change
	if(this.value != "popover") {
		previous = this.value;
	}
}).change(function() {
	var $this = this;
	if($(this).val() == "popover") {
		var urlStr = "config.php?display=timegroups&view=form&fw_popover=1", id = 1;
		popover_select_id = this.id;
		popover_box_class = "timegroups";
		popover_box_mod = "timegroups";
		popover_box = $("<div id=\"popover-box-id\" data-id=\"" + id + "\"></div>")
			.html("<iframe data-popover-class=\"" + popover_box_class + "\" id=\"popover-frame\" frameBorder=\"0\" src=\"" + urlStr + "\" width=\"100%\" height=\"95%\"></iframe>")
			.dialog({
				title: "Add",
				resizable: false,
				modal: true,
				width: window.innerWidth - (window.innerWidth * '.10'),
				height: window.innerHeight - (window.innerHeight * '.10'),
				create: function() {
					$("body").scrollTop(0).css({ overflow: "hidden" });
				},
				close: function(e) {
					$($this).val(previous);
					$("#popover-frame").contents().find("body").remove();
					$("#popover-box-id").html("");
					$("body").css({ overflow: "inherit" });
					updateGroups();
					$(e.target).dialog("destroy").remove();
				},
				buttons: [
						{
						text: fpbx.msg.framework.save,
						click: function() {
							pform = $("#popover-frame").contents().find("form").first();
							pform.submit();
						}
					}, {
						text: fpbx.msg.framework.cancel,
						click: function() {
							$(this).dialog("close");
						}
					}
				]
			});
	}
});

function updateGroups(selectLast) {
	$.post( "ajax.php", { module: "timeconditions", command: "getGroups" })
  .success(function( data ) {
		var options = '<option value="">--'+_('Select a Group')+'--</option>';
		$.each(data.groups, function(i,v) {
			options = options + '<option value="'+v.value+'">'+v.text+'</option>';
		});
		options = options + '<option value="popover">'+_('Add New Time Group...')+'</option>';
		$("#time").html(options);
		if(typeof selectLast === "undefined" || !selectLast) {
			$("#time").val(data.last);
		}
  });
}
