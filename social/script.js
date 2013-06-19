$(document).ready(function() {
	$("#exists").text("hi");

	/* var form = $("#foo");

	form.submit(function(event) {
		event.preventDefault();

		if (request) {
			request.abort;
		}

		var $form = $(this);
		var $inputs = $form.find("input");
		var sdata = $form.serialize();

		$inputs.prop("disabled", true);

		var request = $.ajax({
			url: "handle.php",
			type: "post",
			data: sdata
		});

		request.success(function (response, textStatus, jqHXR) {
			$("#results").text(response);
		});

		request.fail(function (jqHXR, textStatus, errorThrown) {
			$("#results").text(textStatus + errorThrown);
		});

		request.complete(function () {
        $inputs.prop("disabled", false);
    	});
	}); */

	var field = $("#remail");

	field.blur(function() {
		if (request) {
			request.abort;
		}

		var sdata = field.text();

		var request = $.ajax({
			url: "checkexists.php",
			type: "post",
			data: sdata
		});

		request.success(function (response, textStatus, jqHXR) {
			$("#exists").text(response);
		})

		request.fail(function (jqHXR, textStatus, errorThrown) {
			$("#exists").text(textStatus + errorThrown);
		});
	})
});