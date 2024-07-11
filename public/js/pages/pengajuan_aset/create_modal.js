function initCreateModal() {
    let asetIndex = 0;

    document
        .getElementById("create-modal-add-aset")
        .addEventListener("click", function () {
            fetch(`/order-aset-form-template?index=${asetIndex}`)
                .then((response) => response.text())
                .then((html) => {
                    let asetContainer = document.getElementById(
                        "create-modal-aset-container"
                    );
                    let newAsetForm = document.createElement("div");
                    newAsetForm.className = "order-aset-form-template";
                    newAsetForm.innerHTML = html;
                    asetContainer.appendChild(newAsetForm);
                    asetIndex++;
                })
                .catch((error) => console.log("Error:", error));
        });

    document
        .getElementById("create-modal-remove-aset")
        .addEventListener("click", function () {
            let asetContainer = document.getElementById(
                "create-modal-aset-container"
            );
            let lastAsetForm = asetContainer.querySelectorAll(
                "div.order-aset-form-template"
            );
            if (lastAsetForm.length > 0) {
                asetContainer.removeChild(
                    lastAsetForm[lastAsetForm.length - 1]
                );
                asetIndex--;
            }
        });
}
