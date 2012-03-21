

$(document).ready(function() 
{
	$(".panelform #submitmail").click(function()
	{
		$("#error").empty();
		var success = new Boolean(true);
		var name = $("#name").val();
		var phone =	$("#phone").val();
		var email = $("#email").val();
		if(name == "")
		{
			$("#error").append("Name field is empty!<br/>");
			success = false;
		}
		
		if(phone == "")
		{
			$("#error").append(" Phone field is empty!<br/>");
			success = false;
		}
		
		if(email == "")
		{
			$("#error").append(" E-mail field is empty!");
			success = false;
		}
		
		if(success)
		{
			$.post("/notppt/web/app_dev.php/ajax/contact/save",
			{
				name 	: name,
				phone	: phone,
				email	: email
			}, function(data)
			{
				$("#error").append("Data submitted");
				$(".panel").delay(1000).toggle("fast");
			});
			$("#name").val('');			
			$("#phone").val('');
			$("#email").val('');			
		}
	});
});