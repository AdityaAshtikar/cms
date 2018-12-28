$(document).ready(function() {
		// topic field should not have spaces
		$("#topicOneWord").change(function() {
			var word = $('#topicOneWord').val();
			if (word.indexOf(' ') >= 0) {
				alert("Topic cannot have spaces");
				$("#topicOneWord").focus();
				$('#addBookButton').attr("disabled", true);
			} else {
				$('#addBookButton').attr("disabled", false);
			}
		});
			// animating cards when page load up
			$(".card").animate({
				margin: '20px',
				width: '30%'
			}, 1000);
		});