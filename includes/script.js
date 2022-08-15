(function($) {
	$(document).ready(function() {
		$("input#emailLogin").focus();
		$.function.shPassword("passwordLogin", "shPasswordLogin");
		$.function.shPassword("passwordRegister", "shPasswordRegister");
		$.function.shPassword("passwordConfirmRegister", "shPasswordRegister");
		$.function.inputTextSelect("classRegister", ["CSE", "ECE", "EEE", "META"]);
		$.function.inputTextSelect("sectionRegister", ["A", "B", "common"]);
		$("#registerModal").on('shown.bs.modal', function() {
			$("input#nameRegister").focus();
		});
		$("#registerModal").on('hidden.bs.modal', function() {
			setTimeout(function() { $("input#emailLogin").focus(); }, 0);
		});
		$("button#registerSubmit").click($.function.register);
		$("button#loginSubmit").click($.function.login);
		$("th").addClass("text-center");
		$("td").addClass("text-center");
		$("a#logoutButton").click($.function.logout);
	});
	$.function = {
		shPassword: function(inputId, controlId) {
			var input = $("input#" + inputId);
			var control = $("input#" + controlId);
			control.click(function() {
				if (input.attr("type") == "password") input.attr("type", "text");
				else input.attr("type", "password");
			});
		},
		inputTextSelect: function(inputId, options)
		{
			var input = $("input#" + inputId);
			input.keyup(function() {
				input.val("");
				alert("Please do not type, instead click your choice from the options given below");
			});
			var text = "";
			for (var i = 0; i < options.length; i++)
			{
				text += '<a href = \'javascript:$("input#' + inputId + '").val("' + options[i] + '");\' class = "noHoverUnderline">' + options[i] + '</a> | ';
			}
			text += '<a href = \'javascript:$("input#' + inputId + '").val("")\' class = "noHoverUnderline">&times;</a>';
			text += "<br />";
			$(text).insertAfter(input);
		},
		register: function() {
			var nameR = $("input#nameRegister");
			var classR = $("input#classRegister");
			var sectionR = $("input#sectionRegister");
			var emailR = $("input#emailRegister");
			var passwordR = $("input#passwordRegister");
			var confirmPasswordR = $("input#passwordConfirmRegister");
			if (nameR.val() == "") {
				alert("Please enter your name");
				nameR.focus();
			}
			else if (classR.val() == "") {
				alert("Please select your class");
				classR.focus();
			}
			else if (sectionR.val() == "") {
				alert("Please select your section");
				sectionR.focus();
			}
			else if (emailR.val() == "") {
				alert("Please enter your email");
				emailR.focus();
			}
			else if (passwordR.val() == "") {
				alert("Please enter your password");
				passwordR.focus();
			}
			else if (confirmPasswordR.val() == "") {
				alert("Please confirm your password");
				confirmPasswordR.focus();
			}
			else if (passwordR.val() != confirmPasswordR.val()) {
				alert("Passwords do not match. Please enter them again.");
				confirmPasswordR.val("");
				passwordR.val("").focus();
			}
			else
				$.post("includes/functions.php", {
					perform: "register",
					nameR: nameR.val(),
					classR: classR.val(),
					sectionR: sectionR.val(),
					emailR: emailR.val(),
					passwordR: passwordR.val(),
					confirmPasswordR: confirmPasswordR.val()
				}, function(data, status) {
					alert(data);
				});
		},
		successRegister: function() {
			$("input#nameRegister").val("");
			$("input#classRegister").val("");
			$("input#sectionRegister").val("");
			$("input#emailRegister").val("");
			$("input#passwordRegister").val("");
			$("input#passwordConfirmRegister").val("");
			$("#registerModal").modal("hide");
			setTimeout(function() { $("input#emailLogin").focus(); }, 0)
		},
		login: function() {
			var emailL = $("input#emailLogin");
			var passwordL = $("input#passwordLogin");
			if (emailL.val() == "") {
				alert("Please enter your login email");
				emailL.focus();
			}
			else if (passwordL.val() == "") {
				alert("Please enter your password");
				passwordL.focus();
			}
			else $.post("includes/functions.php", {
				perform: "login",
				emailL: emailL.val(),
				passwordL: passwordL.val()
			}, function(data, status) {
				eval(data);
			});
		},
		logout: function() {
			$.post("includes/functions.php", {
				perform: "logout"
			}, function(data, status) {
				eval(data);
			});
		}
	};
}(jQuery));