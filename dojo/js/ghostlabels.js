/* Fade out the focused field's label
------------------------------------------------------------ */

function labelFadeIn() {
    // Get the ID of the focused element
    var fieldId = $(this).attr('id');

    // fade the field's corresponding <label>
    if ($(this).val().length == 0) {
        $('label[for="' + fieldId + '"]').fadeTo(100, 0.5);
    }
}

/* Fade in the now blurred field's label
------------------------------------------------------------ */

function labelFadeOut() {
    // Get the ID of the focused element
    var fieldId = $(this).attr('id');

    // fade the field's corresponding <label>
    if ($(this).val().length == 0) {
        $('label[for="' + fieldId + '"]').fadeTo(100, 1);
    }
}

/* Determine if the label should be visible
------------------------------------------------------------ */

function labelHide() {
    // Get the ID of the focused element
    var fieldId = $(this).attr('id');

    // If there's text in the field, hide the label, show label if not
    if ($(this).val().length > 0) {
        $('label[for="' + fieldId + '"]').hide();
    } else {
        $('label[for="' + fieldId + '"]').show().fadeTo(0, 0.5);
    }
}

/* Check for inputs with no values and show label if empty
------------------------------------------------------------ */

function checkInputValues() {
    // Get all the inputs on the page
    var pageInputs = $('textarea, input[type="text"], input[type="password"], input[type="email"], input[type="tel"]');
    var currentFieldId;

    // Loop over all the inputs
    for (i = 0; i < pageInputs.length; i++) {
        // We want fields that don't have values
        if ($(pageInputs[i]).val().length == 0) {
            // Get the ID of that field
            currentFieldId = $(pageInputs[i]).attr('id');

            // Show the associating label for that field
            $('label[for="' + currentFieldId + '"]').show();
        }
        else {
            // Get the ID of that field
            currentFieldId = $(pageInputs[i]).attr('id');
            
            // Show the associating label for that field
            $('label[for="' + currentFieldId + '"]').hide();
        }
    }
}

/* Event Listeners
------------------------------------------------------------ */

$(document).ready(function() { checkInputValues(); }); // Run when the page loads
$('textarea, input[type="text"], input[type="password"], input[type="email"], input[type="tel"]').focus(labelFadeIn);
$('textarea, input[type="text"], input[type="password"], input[type="email"], input[type="tel"]').blur(labelFadeOut);
$('textarea, input[type="text"], input[type="password"], input[type="email"], input[type="tel"]').bind('input', labelHide); // Modern browsers
$('textarea, input[type="text"], input[type="password"], input[type="email"], input[type="tel"]').keyup(labelHide); // For IE