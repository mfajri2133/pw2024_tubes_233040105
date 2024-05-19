function handleFormSubmit(event) {
     // Disable tombol submit
     const submitButton = document.getElementById("submit-button");
     submitButton.disabled = true;

     // Submit form
     return true;
}

function resetForm() {
     const form = document.querySelector("#addModal form");
     form.reset();
     const submitButton = document.getElementById("submit-button");
     submitButton.disabled = false;
}

document.addEventListener("DOMContentLoaded", function () {
     const modal = document.getElementById("addModal");
     const closeButton = modal.querySelector("[data-modal-toggle]");

     closeButton.addEventListener("click", function () {
          modal.classList.add("hidden");
          resetForm();
     });

     window.addEventListener("click", function (event) {
          if (event.target == modal) {
               modal.classList.add("hidden");
               resetForm();
          }
     });
});
