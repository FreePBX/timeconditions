//var hour = <?php $l = localtime(); echo $l[2]?>;
//var min  = <?php $l = localtime(); echo $l[1]?>;
//var sec  = <?php $l = localtime(); echo $l[0]?>;
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