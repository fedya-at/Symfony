document.addEventListener("DOMContentLoaded", function () {
  const toasts = document.getElementById("toast-container");
  const flashMessages = document.querySelectorAll(".alert");

  flashMessages.forEach((flash) => {
    const message = flash.innerText;
    const toast = `
            <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <strong class="me-auto">Notification</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    ${message}
                </div>
            </div>
        `;

    toasts.innerHTML += toast;
  });

  // Initialize Bootstrap toasts
  new bootstrap.Toast(toasts).show();
});
