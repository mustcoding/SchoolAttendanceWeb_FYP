<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        .warningLetter {
            width: 210mm;
            height: 297mm;
            margin-left: 15px;
            margin-right: 15px;
        }

        img {
            height: 100px; /* Adjusted height for better alignment */
            width: auto;
        }

        header {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
        }

        .header-container {
            display: flex;
            align-items: center; /* Vertically align items in the center */
            justify-content: center; /* Center horizontally */
            text-align: center; /* Center text */
        }

        .logo-container {
            margin-right: 20px; /* Space between logo and text */
        }

        .text-container {
            display: flex;
            flex-direction: column;
            align-items: center; /* Center text within the container */
        }

        .text-container h1, .text-container h2 {
            margin: 0; /* Remove default margins */
            line-height: 1.2; /* Adjust line height for better spacing */
        }

        h1 {
            font-size: 22px;
        }

        h2 {
            font-size: 14px;
        }

        h3 {
            margin-left: 15px;
            margin-right: 15px;
            font-size: 17px;
            text-decoration: underline;
        }

        .tarikh {
            margin-left: 70%;
        }

        p, h4 {
            margin-left: 15px;
            margin-right: 15px;
        }

        .table {
            margin-left: 15px;
            margin-right: 15px;
        }

        .parentName, .street, .taman, .postal, .city {
            text-decoration: underline;
        }

        @media print {
            @page {
                margin: 0;  /* Removes margins from the printed page */
            }
            
            /* Hides browser-generated headers and footers */
            body::before, body::after {
                display: none;
            }
        }
    </style>
</head>
<body>
    <form class="warningLetter">
        <header>
            <div class="header-container">
                <div class="logo-container">
                    <img src="../assets/img/SMAJU.png" alt="School Logo">
                </div>
                <div class="text-container">
                    <h1>SEKOLAH MENENGAH AGAMA JAWAHIR AL-ULUM</h1>
                    <h2>JALAN PARIT KEMANG, KAMPUNG BAHRU, 83200 SENGGARANG, BATU PAHAT, JOHOR</h2>
                </div>
            </div>
        </header>
        <hr>
        <p class="tarikh">Tarikh : </p>
        <p>Kepada,</p>
        <p class="parentName">IDRIS MAHMOR ALIIMRAN BIN MUSTAPA</p>
        <p class="street">LLN 81/3, NO 4, LORONG HAJI MUSA,</p>
        <p class="taman">KAMPUNG PARIT AHMAD KORIS,</p>
        <p class="postal">83200 SENGGARANG, BATU PAHAT,</p>
        <br>
        <p>Tuan / Puan,</p>
        <h3>Pemberitahuan Ketidakhadiran ke Sekolah : AMARAN PERTAMA / KEDUA / KETIGA</h3>
        <p class="main">Saya dengan ini memaklumkan bahawa anak jagaan tuan IDRIS MAHMOR ALIIMRAN BIN MUSTAPA di tingkatan 1 MALIKI 
            telah tidak hadir ke sekolah seperti berikut:
        </p>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">AMARAN</th>
                </tr>
                <br>
            </thead>
            <tbody id="warningTableBody">
                <!-- Rows will be inserted here by JavaScript -->
            </tbody>
        </table>
        <br>
        <p class="bil_hari">a.   Bilangan hari tidak hadir berjumlah   : 39 HARI</p>
        <p>2. Sila maklumkan kepada pihak sekolah dengan berhubung dengan Pengetua atau Penolong Kanan HEM dalam tempoh 7 hari dari tarikh surat ini.</p>
        <p>3. Mengikut Peraturan Sekolah, anak jagaan tuan boleh dikenakan tindakan buang sekolah jika tidak hadir tanpa apa-apa kenyataan yang munasabah daripada ibu bapa atau penjaga.</p>
        <br>
        <p>Sekian dimaklumkan, Terima Kasih.</p>
        <h4>'BERKHIDMAT UNTUK NEGARA'</h4>
        <p>Saya yang menurut perintah,</p>
        <br><br>
        <p>_________________________</p>
        <p>(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</p>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', async function () {
            try {
                // Retrieve the JSON string from sessionStorage
                var storedStudentWarning = JSON.parse(sessionStorage.getItem('studentWarning'));
                console.log("here: ", storedStudentWarning);

                // Extract details from the stored data
                var student_name = storedStudentWarning.student_name;
                var classs = storedStudentWarning.class;
                var totalDay = storedStudentWarning.total_day;
                var student_id = storedStudentWarning.student_id;
                var warnings = storedStudentWarning.warnings;

                console.log("name: ", student_name);

                await fetchParent(student_id);
                const currentDate = getCurrentDateFormatted();
                document.querySelector('.tarikh').textContent = `Tarikh: ${currentDate}`;

                document.querySelector('.main').textContent = `
                    Saya dengan ini memaklumkan bahawa anak jagaan tuan ${student_name} di tingkatan ${classs} 
                    telah tidak hadir ke sekolah seperti berikut:
                `;

                document.querySelector('.bil_hari').textContent = `
                    a. Bilangan hari tidak hadir berjumlah : ${totalDay} HARI.
                `;

                populateWarnings(warnings);

                // Add a small delay to ensure the DOM is fully updated
                setTimeout(() => {
                    printData();
                }, 500);

                // Redirect after printing
                setTimeout(() => {
                    window.location.href = "/list-warning";
                }, 1000);
                
            } catch (error) {
                console.error('Error:', error);
            }
        });

        async function fetchParent(student_id) {
            const data = { id: student_id };

            const response = await fetch('/Student/' + student_id, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(data)
            });

            const parentData = await response.json();
            var parent_name = parentData.parent_name;
            var address = parentData.parent_address;

            console.log("parent_name : ", parent_name);
            console.log("address : ", address);
            document.querySelector('.parentName').textContent = parent_name;
            const splitData = splitAddress(address);
            document.querySelector('.street').textContent = splitData.part1;
            document.querySelector('.taman').textContent = splitData.part2;
            document.querySelector('.postal').textContent = splitData.part3;
        }

        function splitAddress(address) {
            const kampungPattern = /(.*?)(KAMPUNG|TAMAN)/;
            const postcodePattern = /(\d{5})\s*(.*)$/;

            const kampungMatch = address.match(kampungPattern);
            const part1 = kampungMatch ? kampungMatch[1].trim() : address;

            const remainingAddress = address.replace(part1, '').trim();

            const postcodeMatch = remainingAddress.match(postcodePattern);
            const part3 = postcodeMatch ? postcodeMatch[1] : '';
            const part4 = postcodeMatch ? postcodeMatch[2].trim() : '';

            const remainingAddress2 = remainingAddress.replace(part3 + ' ' + part4, '').trim();
            const part2 = remainingAddress2.split(/(?<=\d{5})\s*/)[0].trim();

            return {
                part1: part1,
                part2: part2,
                part3: part3 + ' ' + part4,
            };
        }

        function getCurrentDateFormatted() {
            const months = [
                "JANUARY", "FEBRUARY", "MARCH", "APRIL", "MAY", "JUNE",
                "JULY", "AUGUST", "SEPTEMBER", "OCTOBER", "NOVEMBER", "DECEMBER"
            ];

            const now = new Date();
            const day = now.getDate();
            const month = months[now.getMonth()];
            const year = now.getFullYear();

            return `${day} ${month} ${year}`;
        }

        function populateWarnings(warnings) {
            const tableBody = document.getElementById('warningTableBody');
            warnings.forEach((warning, index) => {
                const row = document.createElement('tr');
                const cell = document.createElement('td');
                cell.textContent = `${warning}`;
                row.appendChild(cell);
                tableBody.appendChild(row);
            });
        }

        function printData() {
             // You can add additional styling or logic here if needed
             window.print();
        }
    </script>
</body>
</html>
