document.addEventListener("DOMContentLoaded", function () {
    // Call initialization functions for each module
    if (typeof initCreateModal === "function") {
        initCreateModal();
    }
    if (typeof initEditModal === "function") {
        initEditModal();
    }
    if (typeof initShowModal === "function") {
        initShowModal();
    }
});
