<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMA JAWAHIR AL-ULUM ATTENDANCE SYSTEM</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <link href="assets/img/SMAJU.png" rel="icon">
  <link href="assets/img/SMAJU.png" rel="apple-touch-icon">
    <link rel="stylesheet" href="assets/css/webDisplay.css">
</head>
<body>
    <div class="container">
        <header>
            <div class="header-content">
                <div class="circle-container">
                    <img src="assets/img/SMAJU.png" alt="" class="circle">
                </div>
                <h1>SEKOLAH MENENGAH AGAMA JAWAHIR AL-ULUM ATTENDANCE SYSTEM</h1>
            </div>
            <br>
            <br>
            <div class="details">
                <span id="date-time" class="date-time">SATURDAY 09/06/2024 13:30:00</span>
                <span id="attendanceType" class="date-time"></span>
            </div>
        </header>
        <main>
            <div class="rectangle-container">
                <div class="rectangle">
                    <img src="assets/img/SMAJU.png" alt="" id="student-image" class="student-image">
                </div>
            </div>
            <br>
            <h2 id="studentName">IDRIS MAHMOR ALIIMRAN BIN MUSTAPA</h2>
            <br>
            <br>
            <p id="status">ATTENDANCE SUCCESSFULLY RECORDED</p>
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Start the interval function
            gothrough();

            // Update every 3 seconds
            setInterval(gothrough, 2000);
        });

        async function gothrough() {
            fetchDate();
            await fetchAttendanceType();
            await fetchData();
        }

        function fetchDate() {
            const daysOfWeek = ["SUNDAY", "MONDAY", "TUESDAY", "WEDNESDAY", "THURSDAY", "FRIDAY", "SATURDAY"];
            const date = new Date();

            const dayName = daysOfWeek[date.getDay()];
            const day = String(date.getDate()).padStart(2, '0');
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const year = date.getFullYear();

            const hours = String(date.getHours()).padStart(2, '0');
            const minutes = String(date.getMinutes()).padStart(2, '0');
            const seconds = String(date.getSeconds()).padStart(2, '0');

            const formattedDate = `${dayName} ${day}/${month}/${year} ${hours}:${minutes}:${seconds}`;

           // Truncate table at specific time
            const timeTruncate = `${hours}:${minutes}:${seconds}`;
            if (timeTruncate >= '00:48:00' && timeTruncate <= '00:48:30') {
                try {
                    const response = fetch('/truncateTable', { method: 'POST' });
                    if (response.ok) {
                        console.log("Table truncated successfully.");
                    } else {
                        console.error("Failed to truncate table:", response.status, response.statusText);
                    }
                } catch (error) {
                    console.error("Error connecting to the truncation endpoint:", error);
                }
            }
            
            document.getElementById('date-time').textContent = formattedDate;
        }

        // async function fetchAttendanceType(){
        //     try {
        //         const response = await fetch('/attendanceType');
        //         const data = await response.json();
        //         const name = data[0].name;
        //         const start_time = data[0].start_time;
        //         const end_time = data[0].end_time;

        //         const timeFormatted = `${name} (${start_time} - ${end_time})`;

        //         document.getElementById('attendanceType').textContent = timeFormatted;
        //     } catch (error) {
        //         console.error('Error fetching data:', error);
        //     }
        // }

        async function fetchAttendanceType() {
            try {
                const response = await fetch('/attendanceType');
                const data = await response.json();
                console.log('Attendance type data:', data);

                // Iterate over the keys in the response object
                for (const key in data) {
                    if (data.hasOwnProperty(key)) {
                        const attendanceType = data[key];
                        const name = attendanceType.name;
                        const start_time = attendanceType.start_time;
                        const end_time = attendanceType.end_time;

                        const timeFormatted = `${name} (${start_time} - ${end_time})`;
                        document.getElementById('attendanceType').textContent = timeFormatted;
                        break; // Assuming you only want to display the first entry found
                    }
                }

            } catch (error) {
                console.error('Error fetching data:', error);
            }
        }


        async function fetchData() {
            try {
                const response = await fetch('/toDisplayStudent');
                const data = await response.json();
                console.log('student_id:', data.student_id);
                console.log('attendance_id:', data.attendance_id);
                if (data.attendance_id != 0) {
                    await updateName(data.student_id);

                } else {
                    await updateFailed(data.student_id);
                   
                }
            } catch (error) {
                console.error('Error fetching data:', error);
            }
        }

        async function updateName(student_id) {
            const data = { student_id: student_id };

            try {
                const response = await fetch('/getDisplayStudent', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                });
                const result = await response.json();
                console.log('Response:', result);
                if (result.student) {
                    document.getElementById('studentName').textContent = result.student.name;
                    document.getElementById('status').textContent = "ATTENDANCE SUCCESSFULLY BEING RECORDED";
                    console.log("hye");
                    console.log("image : ", result.official_image.image);
                    document.getElementById('student-image').src = `${result.official_image.image}`;
                    // await sendNotification(result.parent_username);
                }
            } catch (error) {
                console.error('Error during fetch:', error);
            }
        }

        async function updateFailed(student_id) {
            const data = { student_id: student_id };

            try {
                const response = await fetch('/getDisplayStudent', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                });
                const result = await response.json();
                console.log('Response:', result);
                if (result.student) {
                    document.getElementById('studentName').textContent = result.student.name;
                    document.getElementById('status').textContent = "ATTENDANCE ALREADY BEING RECORDED";
                    console.log("hye");
                    console.log("image : ", result.official_image.image);
                    document.getElementById('student-image').src = `${result.official_image.image}`;
                
                }
            } catch (error) {
                console.error('Error during fetch:', error);
            }
        }

        // async function sendNotification(username) {
        //     const data = {
        //         app_id: "78f2e497-f306-4a96-9f47-c0ae59591675",
        //         include_external_user_ids: [username],
        //         headings: {
        //             "en": "SMAJU Attendance System"
        //         },
        //         contents: {
        //             "en": "THANK YOU WAFIR"
        //         }
        //     };

        //     try {
        //         const response = await fetch('https://onesignal.com/api/v1/notifications', {
        //             method: 'POST',
        //             headers: {
        //                 'Content-Type': 'application/json',
        //                 'accept':'application/json',
        //                 'Authorization':'Basic OGMxODYyZmMtODllYS00MjYzLThkMzctODQzMTIyZDllZTkw'
        //             },
        //             body: JSON.stringify(data)
        //         });
                
        //     } catch (error) {
        //         console.error('Error during fetch:', error);
        //     }
        // }


    </script>
</body>
</html>
