function checkCharsLeft(formName, fieldName, maxChars, notifier)
{
	var field = document.forms[formName][fieldName];
	var charsUsed = field.value.length;
	var charsAvailable = maxChars - charsUsed;

	var show = document.getElementById(notifier);
	show.InnerHTML.value = charsAvailable;
}