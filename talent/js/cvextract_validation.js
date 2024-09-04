$(document).ready(function() {
    const submitButton = $('#submit_form');
    const formElement = $('#myForm');
    const excludedFields = ["country", "state"]; // 'file-input' is not excluded

    // Function to validate the form and update the submit button's state
    function updateSubmitButtonState() {
        const isValid = validateForm(false);
        submitButton.prop('disabled', !isValid);
    }

    // Initially disable the submit button
    updateSubmitButtonState();

    // Add event listeners to form inputs and select boxes to check validity on input, change, and blur
    $('.mendatory_input').on('input change blur', function() {
        if (!excludedFields.includes(this.id)) { // Exclude specific fields from validation
            $(this).data('touched', true); // Mark the field as touched
            checkInput(this); // Add or remove visual cues
            validateField(this); // Validate the specific field
            updateSubmitButtonState();
        }
    });

    // Listen for the submit event on the form
    formElement.on('submit', function(event) {
        if (!validateForm(true)) {
            event.preventDefault(); // Prevent the form from submitting if invalid
            alert("Please fill out all required fields correctly.");
        }
    });

    // Function to validate individual fields
    function validateField(inputElement) {
        if (excludedFields.includes(inputElement.id)) {
            return true; // Skip validation for excluded fields
        }

        let isValid;

        if ($(inputElement).is('select')) {
            isValid = $(inputElement).val() !== ""; // Validate if a selection is made
        } else if ($(inputElement).is('input[type="file"]')) {
            isValid = inputElement.files.length > 0; // Validate if a file is selected
        } else {
            isValid = inputElement.value.trim() !== ""; // Validate non-empty text inputs
        }

        if ($(inputElement).data('touched')) {
            $(inputElement).toggleClass('invalid', !isValid);
        }

        return isValid;
    }

    // Function to validate the entire form
    function validateForm(showErrors = false) {
        let valid = true;

        $('.mendatory_input').each(function() {
            if (!excludedFields.includes(this.id)) { // Exclude specific fields from validation
                if (showErrors) {
                    $(this).data('touched', true); // Mark all fields as touched on form submission
                }
                if (!validateField(this)) {
                    valid = false;
                }
            }
        });

        return valid;
    }

    // Function to add or remove visual cues for empty and non-empty inputs
    function checkInput(inputElement) {
        if (inputElement.value.trim() !== '' || inputElement.files.length > 0) {
            $(inputElement).removeClass('empty').addClass('non-empty');
        } else {
            $(inputElement).removeClass('non-empty').addClass('empty');
        }
    }
});
