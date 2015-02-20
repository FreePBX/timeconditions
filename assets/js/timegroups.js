var sec = '';
var min = '';
var hour = '';
$.ajax({
    url: "/admin/config.php?display=timegroups&action=getJSON&jdata=servertime&quietmode=1",
    dataType: 'json',
    success: function(data) {
		hour = data[2];
		min = data[1];
		sec = data[0];
    }
});

//time groups stole this from timeconditions
//who stole it from http://www.aspfaq.com/show.asp?id=2300
function PadDigits(n, totalDigits)
{
	n = n.toString();
	var pd = '';
	if (totalDigits > n.length)
	{
		for (i=0; i < (totalDigits-n.length); i++)
		{
			pd += '0';
		}
	}
	return pd + n.toString();
}

function updateTime()
{
	sec++;
	if (sec==60)
	{
		min++;
		sec = 0;
	}
		
	if (min==60)
	{
		hour++;
		min = 0;
	}

	if (hour==24)
	{
		hour = 0;
	}
	
	document.getElementById("idTime").innerHTML = PadDigits(hour,2)+":"+PadDigits(min,2)+":"+PadDigits(sec,2);
	setTimeout('updateTime()',1000);
}

updateTime();
$(document).ready(function(){
	$(".remove_section").click(function(){
    if (confirm( _("This section will be removed from this time group and all current settings including changes will be updated. OK to proceed?"))) {
      $(this).parent().parent().prev().remove();
      $(this).closest('form').submit();
    }
  });
});
//table
$("#timegrid").bootstrapTable({
	method: 'get',
	url: '?display=timegroups&action=getJSON&jdata=grid&quietmode=1',
	cache: false,
	striped: true,
	showColumns: false,
	columns: [
		{
			field: 'text',
			title: _("Description"),
		},
		{
			field: 'value',
			title: _("Actions"),
			clickToSelect: false,
			formatter: actionFormatter,
		}
		]
});
$("#bnavgrid").bootstrapTable({
	method: 'get',
	url: '?display=timegroups&action=getJSON&jdata=grid&quietmode=1',
	cache: false,
	striped: false,
	showColumns: false,
	columns: [
		{
			title: _("Time Groups"),
			field: 'link',
			formatter: linkFormatter,
		}
		]
});
function actionFormatter(value){
	var html = '';
	html += '<a href="?display=timegroups&view=form&extdisplay='+value+'"><i class="fa fa-edit"></i></a>&nbsp;';
	html += '<a href="?display=timegroups&action=del&extdisplay='+value+'"><i class="fa fa-trash"></i></a>';
	return html;
}
function linkFormatter(value){
	html = '<a href="?display=timegroups&view=form&extdisplay='+value[1]+'"><i class="fa fa-pencil"></i>&nbsp'+_("Edit: ")+value[0]+'</a>';
	return html;
}
$("#addTime").live('click',function(e){
	e.preventDefault();
	var curid = $(this).prev().attr('id').match(/\d+/)[0];

	curid = parseInt(curid,10);
	var nextid = curid + 1;
	var span = $(this).parent().find('span');
	var newspan  = span.clone();
	$(this).html('<br/>');
	var items = newspan.children();
	items.find('select').each(function(){
		$(this).children().removeAttr("selected");
		$(this).attr('name',$(this).attr('name').replace(/\d+/,nextid) );
		$(this).attr('id',$(this).attr('id').replace(/\d+/,nextid) );
		});
	newspan.appendTo('#timerows');
	$("#timerows").append('<a href="#" id="addTime"><i class="fa fa-plus"></i></a>');
});