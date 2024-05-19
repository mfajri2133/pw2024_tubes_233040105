function validateForm() {
     var password = document.getElementById("password").value;
     var confirmPassword = document.getElementById("confirm_password").value;
     var errorMessage = "";

     if (password.length < 6) {
          errorMessage = "Password must be at least 6 characters long.";
     } else if (password !== confirmPassword) {
          errorMessage = "Passwords do not match.";
     }

     if (errorMessage) {
          document.getElementById("error-message").innerText = errorMessage;
          return false;
     }
     return true;
}
