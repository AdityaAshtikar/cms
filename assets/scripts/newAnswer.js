$(document).ready(function() {
	$("#answerSubmit").on("click", function(event) {
		var atext = $.trim($("#answer").val());
		var qId = $("#qId").val();
		var uId = $("#uId").val();
		if (atext == ""){
			alert("Cannot submit empty answer!");
			$("#answer").focus();
		}
		else {
			event.preventDefault();
			var toSend = "atext=" + atext + "&qId=" + qId + "&uId=" + uId;
			$("#answer").prop("disabled", true);
			$("#qId").prop("disabled", true);
			$("#uId").prop("disabled", true);
			var request = $.ajax({
				url: "ajaxSubmits/addAnswer.php",
				type: "post",
				data: toSend
			});
			request.done(function(response, textStatus, jqXHR){
				$(response).prependTo(".newAnswer").slideDown();
			});
			request.fail(function(jqXHR, textStatus, err){
				alert("Couldn't share your comment, we'll look into it.");
				console.error("Error in answer ajax: " + textStatus + " " + err);
			});
			request.always(function() {
				$("#answer").prop("disabled", false);
				$("#qId").prop("disabled", false);
				$("#uId").prop("disabled", false);
			});
		}
		console.log(atext);
	});
});