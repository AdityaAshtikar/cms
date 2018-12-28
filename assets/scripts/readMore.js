$(document).ready(function() {
	$("#seeQuestion").on("click", function(){
		var ques = $(".readMoreQuestion").html();
		if (!$('.readMoreQuestion').is(':visible')) {
			$(".readMoreQuestion").css({"display": "block", "background-color": "black", "color": "white", "font-weight": "400", "transform": "scale(1, 1)", "transition": "all 0.5s ease"});
		} else {
			$(".readMoreQuestion").css({"display": "none"});
		}
		console.log(ques);
	});
});