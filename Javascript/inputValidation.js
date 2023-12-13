function validateField(field, regex, errorMessage) {
  const errorClass = 'error-message'; // Class for styling error messages
  let existingError = field.parentNode.querySelector('.' + errorClass);

  if (!regex.test(field.value.trim())) {
      field.style.borderColor = 'red'; // Highlight in red if validation fails
      
      // Create error message
      if (!existingError) {
        let error = document.createElement('span');
        error.textContent = errorMessage;
        error.className = errorClass;
        error.style.color = 'red'; // Inline styling for the error message
        field.parentNode.insertBefore(error, field.nextSibling);
      }
      
      return false;
  } else {
      field.style.borderColor = ''; // Remove highlight if validation passes
      
      // Remove existing error message
      if (existingError) {
        existingError.remove();
      }
      
      return true;
  }
}

document.addEventListener('DOMContentLoaded', function () {
  const form = document.getElementById('form');

  form.addEventListener('submit', function (e) {
      let isValid = true;

      console.log('Function called');

      const usernameRegex = /^[a-zA-Z0-9_]{5,}$/; // Usernames should be alphanumeric and at least 5 characters
      const passwordRegex = /^(?=.*\d)(?=.*[a-zA-Z]).{6,}$/; // Passwords should contain letters and numbers and be at least 6 characters

      // Validate username
      if (!validateField(document.getElementById('username'), usernameRegex, "Username is invalid")) {
          isValid = false;
      }

      // Validate password
      if (!validateField(document.getElementById('password'), passwordRegex, "Password is invalid")) {
          isValid = false;
      }

      // Prevent form submission if any field is invalid
      if (!isValid) {
          e.preventDefault();
      }
  });
});