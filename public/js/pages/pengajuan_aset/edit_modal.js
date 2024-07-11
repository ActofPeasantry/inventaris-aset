function initEditModal() {
    // Event listener for showing edit modal with prefilled data
    document.querySelectorAll(".edit-button").forEach((button) => {
        button.addEventListener("click", function () {
            var id = button.getAttribute("data-id");
            console.log("Edit ID:", id);
            var transaksiInput = document.querySelector(
                "#modal-edit-pengajuan #transaksi_id"
            );
            transaksiInput.value = id;
            console.log("Transaksi Input:", transaksiInput);

            var xhr = new XMLHttpRequest();
            xhr.open("GET", "/pengajuan_aset/" + id + "/edit", true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        var data = JSON.parse(xhr.responseText);
                        console.log("Fetched data:", data.detail_data);

                        // Update the select options for tujuan_transaksi and supplier_id
                        const updateSelectOption = (selector, value) => {
                            let selectElement =
                                document.querySelector(selector);
                            selectElement
                                .querySelectorAll("option")
                                .forEach((option) => {
                                    option.selected =
                                        option.value === value.toString();
                                });
                        };
                        updateSelectOption(
                            "#modal-edit-pengajuan #tujuan_transaksi",
                            data.transaksi_data[0].tujuan_transaksi
                        );
                        updateSelectOption(
                            "#modal-edit-pengajuan #supplier_id",
                            data.transaksi_data[0].supplier_id
                        );

                        // Clear the container before appending new forms
                        let asetContainer = document.getElementById(
                            "edit-modal-aset-container"
                        );
                        asetContainer.innerHTML = "";

                        let details = data.detail_data;
                        // Collect all fetch promises
                        let fetchPromises = details.map((detail, asetIndex) =>
                            fetch(
                                `${orderAsetFormTemplateUrl}?index=${asetIndex}`
                            )
                                .then((response) => response.text())
                                .then((html) => ({ html, detail, asetIndex }))
                        );

                        // Process all fetch responses once they are complete
                        Promise.all(fetchPromises)
                            .then((responses) => {
                                responses.forEach(
                                    ({ html, detail, asetIndex }) => {
                                        let newAsetForm =
                                            document.createElement("div");
                                        newAsetForm.className =
                                            "order-aset-form-template";
                                        newAsetForm.innerHTML = html;
                                        asetContainer.appendChild(newAsetForm);

                                        // Update the fields in the new form
                                        const updateField = (
                                            fieldSelector,
                                            value
                                        ) => {
                                            let field =
                                                newAsetForm.querySelector(
                                                    fieldSelector
                                                );
                                            if (field) field.value = value;
                                        };

                                        updateField(
                                            `#aset_id-${asetIndex}`,
                                            detail.aset_id
                                        );
                                        updateField(
                                            `#jumlah-${asetIndex}`,
                                            detail.jumlah
                                        );
                                        updateField(
                                            `#harga-${asetIndex}`,
                                            detail.biaya
                                        );
                                    }
                                );
                            })
                            .catch((error) => console.log("Error:", error));

                        // Event listener for adding new aset form
                        document
                            .getElementById("edit-modal-add-aset")
                            .addEventListener("click", function () {
                                fetch(
                                    `${orderAsetFormTemplateUrl}?index=${details.length}`
                                )
                                    .then((response) => response.text())
                                    .then((html) => {
                                        let newAsetForm =
                                            document.createElement("div");
                                        newAsetForm.className =
                                            "order-aset-form-template";
                                        newAsetForm.innerHTML = html;
                                        asetContainer.appendChild(newAsetForm);
                                        details.length++;
                                    })
                                    .catch((error) =>
                                        console.log("Error:", error)
                                    );
                            });

                        // Event listener for removing last aset form
                        document
                            .getElementById("edit-modal-remove-aset")
                            .addEventListener("click", function () {
                                let asetContainer = document.getElementById(
                                    "edit-modal-aset-container"
                                );
                                let lastAsetForm =
                                    asetContainer.querySelectorAll(
                                        "div.order-aset-form-template"
                                    );
                                if (lastAsetForm.length >= 1) {
                                    asetContainer.removeChild(
                                        lastAsetForm[lastAsetForm.length - 1]
                                    );
                                    details.length--;
                                    console.log(details.length);
                                }
                            });

                        // Show the modal
                        $("#modal-edit-pengajuan").modal("show");
                    } else {
                        console.error("Error fetching data:", xhr.statusText);
                    }
                }
            };
            xhr.send();
        });
    });
}

function addButton() {}
