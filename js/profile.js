function validateFormPassword() {
     var password = document.getElementById("new_password").value;
     var confirmPassword = document.getElementById("confirm_password").value;
     var errorMessage = "";

     if (password.length < 6) {
          errorMessage = "New password must be at least 6 characters long.";
     } else if (password !== confirmPassword) {
          errorMessage = "New password and confirm password do not match.";
     }

     if (errorMessage) {
          document.getElementById("error-message").innerText = errorMessage;
          return false;
     }
     return true;
}
