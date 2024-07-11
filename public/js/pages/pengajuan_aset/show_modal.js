function initShowModal() {
    document.querySelectorAll(".show-button").forEach(function (button) {
        button.addEventListener("click", function () {
            var id = button.getAttribute("data-id");
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "/pengajuan_aset/" + id, true);

            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        var data = JSON.parse(xhr.responseText);
                        // console.log(data);
                        updateTable(data); //Call function to update table
                    } else {
                        console.error("Error fetching data:", xhr.statusText);
                    }
                }
            };
            xhr.send();
        });
    });
}

function updateTable(data) {
    var tableBody = document.querySelector(".show-modal-table tbody");
    tableBody.innerHTML = ""; //Clear table body

    data.forEach((item) => {
        var row = document.createElement("tr");

        // Create and append cells for 'nama_aset'
        var cellNamaAset = document.createElement("td");
        cellNamaAset.textContent = item.nama_aset;
        row.appendChild(cellNamaAset);

        // Create and append cells for 'jumlah'
        var cellJumlah = document.createElement("td");
        cellJumlah.textContent = item.jumlah;
        row.appendChild(cellJumlah);

        // Create and append cells for 'biaya'
        var cellBiaya = document.createElement("td");
        cellBiaya.textContent = item.biaya;
        row.appendChild(cellBiaya);

        // Append row to table body
        tableBody.appendChild(row);
    });
}
