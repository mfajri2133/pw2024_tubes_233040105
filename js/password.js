// Password Lama
const passwordToggle = document.querySelector(".js-password-toggle");
const passwordInput = document.querySelector(".js-password");
const passwordLabel = document.querySelector(".js-password-label");

passwordToggle.addEventListener("change", function () {
     if (passwordInput.type === "password") {
          passwordInput.type = "text";
          passwordLabel.innerHTML = '<i class="fas fa-eye-slash"></i>';
     } else {
          passwordInput.type = "password";
          passwordLabel.innerHTML = '<i class="fas fa-eye"></i>';
     }
     passwordInput.focus();
});

// Password Baru
const newPasswordToggle = document.querySelector(".js-new-password-toggle");
const newPasswordInput = document.querySelector(".js-new-password");
const newPasswordLabel = document.querySelector(".js-new-password-label");

newPasswordToggle.addEventListener("change", function () {
     if (newPasswordInput.type === "password") {
          newPasswordInput.type = "text";
          newPasswordLabel.innerHTML = '<i class="fas fa-eye-slash"></i>';
     } else {
          newPasswordInput.type = "password";
          newPasswordLabel.innerHTML = '<i class="fas fa-eye"></i>';
     }
     newPasswordInput.focus();
});

// Konfirmasi Password Baru
const confirmPasswordToggle = document.querySelector(
     ".js-confirm-password-toggle"
);
const confirmPasswordInput = document.querySelector(".js-confirm-password");
const confirmPasswordLabel = document.querySelector(
     ".js-confirm-password-label"
);

confirmPasswordToggle.addEventListener("change", function () {
     if (confirmPasswordInput.type === "password") {
          confirmPasswordInput.type = "text";
          confirmPasswordLabel.innerHTML = '<i class="fas fa-eye-slash"></i>';
     } else {
          confirmPasswordInput.type = "password";
          confirmPasswordLabel.innerHTML = '<i class="fas fa-eye"></i>';
     }
     confirmPasswordInput.focus();
});
