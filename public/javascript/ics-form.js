document.addEventListener("DOMContentLoaded", function () {
    var pasteField = document.getElementById("paste_input");
    var inmateNumberField = document.getElementById("inmate_number");
    var lastNameField = document.getElementById("last_name");
    var firstNameField = document.getElementById("first_name");
    var middleNameField = document.getElementById("middle_name");

    pasteField.addEventListener("paste", function (event) {
        // Get pasted data
        var pasteContent = (event.clipboardData || window.clipboardData).getData("text").trim();

        // Define regex pattern for parsing data
        // Example format: "12345 Doe, John M"
        var regexPattern = /^\s*(\d+)\s+(\w+),\s+(\w+)(?:\s+(\w+))?\s*$/;
        var matches = pasteContent.match(regexPattern);

        if (matches) {
            // Fill out the fields based on regex match groups
            inmateNumberField.value = matches[1].trim() || ""; // Group 1: Inmate Number
            lastNameField.value = matches[2].trim() || "";      // Group 2: Last Name
            firstNameField.value = matches[3].trim() || "";     // Group 3: First Name
            middleNameField.value = matches[4] ? matches[4].trim() : ""; // Group 4: Middle Name (optional)
        } else {
            alert("Invalid format. Please paste data in the format: 'InmateNumber LastName, FirstName MiddleName (Middle Name is optional)")
        }

        // Prevent the pasted content from appearing in the pasteField
        event.preventDefault();
    });
});
