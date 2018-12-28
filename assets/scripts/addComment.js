// Comments
$(document).ready(function() {
	$("#commentSubmit").on("click", function(event) {
		var comment = $.trim($("#commentArea").val());
		var postId = $("#postId").val();
		if (comment == "") {
			alert("Cannot submit a blank comment!");
		} else {
			event.preventDefault();
			var toSend = "comment=" + comment + "&postId=" + postId;
			// var serializedData = toSend.serialize();
			$("#commentArea").prop("disabled", true);
			var request = $.ajax({
				url: "ajaxSubmits/addComment.php",
				type: "post",
				data: toSend
			});
			request.done(function(response, textStatus, jqXHR){
				$(response).prependTo(".showComments").slideDown();
			});
			request.fail(function(jqXHR, textStatus, err){
				alert("Couldn't share your comment, we'll look into it.");
				console.error("Error in comment ajax: " + textStatus + " " + err);
			});
			request.always(function() {
				$("#commentArea").prop("disabled", false);
			});
		}
		console.log(toSend);
	});
});