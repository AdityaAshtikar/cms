// handling form data to submit post with ajax
$(document).ready(function() {
	var request;
	$("#postForm").submit(function(event){
		event.preventDefault();
		var $form = $(this);
		// getting values of each element in $form
		var $inputs = $form.find("#userId, #post, #category, #priority, #access_to");
		// keyValue pairs for name and data submitted in form
		var serializedData = $form.serialize();
		// disabling input fields after form data is serialized
		$inputs.prop("disabled", true);
		// request sent to ajaxSubmits/addPost.php
		request = $.ajax({
	        url: "ajaxSubmits/addPost.php",
	        type: "post",
	        data: serializedData
	    });
		// callback function called on success
		request.done(function(response, textStatus, jqXHR){
			// var $text = response['text'];
			// var $postUser = response['postUser'];
			// var $category = response['category'];
			// var $priority = response['priority'];
			//var $access = response['access'];	/*will be used to see who can see the post */
			// var $created = response['created'];
			// put the response values to their corresponding divs
			$(response).prependTo("#postContent").slideDown();
		});
		// on failure
		request.fail(function(jqXHR, textStatus, err){
			alert("Couldn't share post, we'll look into it.");
			console.error("Error in ajax: " + textStatus + " " + err);
		});
		// always called even if failed or succeeded
		// enabling input fields again
		request.always(function() {
			$inputs.prop("disabled", false);
			$("#post").val("");
			$("#category").val("");
			$("#priority").val("");
			$("#access_to").val("");
		});
	});
});