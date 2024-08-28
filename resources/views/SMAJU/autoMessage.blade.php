<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p id="current-date"></p>
    <p id="current-time"></p>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            //var checkTime = "15:10";
            //var checkTime = "22:00";
            //const Datecheck = "07/24/24";

            var count = 0;

            function pad(number) {
                return number < 10 ? '0' + number : number;
            }

            function updateDateTime() {
                var checkTime = "21:30";
                // Retrieve current date and time
                const now = new Date();

                // Format date
                const year = now.getFullYear() % 100;
                const month = pad(now.getMonth() + 1); // Months are zero-based
                const day = pad(now.getDate());
                const formattedDate = `${month}/${day}/${year}`;

                // Format time
                const hours = pad(now.getHours());
                const minutes = pad(now.getMinutes());
                const seconds = pad(now.getSeconds());
                const formattedTime = `${hours}:${minutes}`;

                if (formattedTime === checkTime) {
                    if (count === 0) {
                        console.log("Checking attendance...");
                        count++;

                        fetchAttendance(formattedDate);
                    }
                } else {
                    count = 0;
                }

                // Display the date and time
                document.getElementById('current-date').textContent = `Current Date: ${formattedDate}`;
                document.getElementById('current-time').textContent = `Current Time: ${formattedTime}`;
            }

            async function fetchAttendance(DateCheck) {
                var isAttend = 1;
                while (isAttend <= 3) {
                    const data = {
                        date: DateCheck,
                        is_attend: isAttend
                    };

                    try {
                        const response = await fetch('/sendMessage', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify(data)
                        });

                        const responseData = await response.json();
                        console.log('Response:', responseData);

                        var loop = 0;
                        while (loop<responseData.length){
                            await sendNotification(responseData[loop]);
                            loop++;
                        }

                    } catch (error) {
                        console.error('Error during fetch:', error);
                    }

                    isAttend++;
                }
            }

            async function sendNotification(responseData) {

                const now = new Date();

                // Format date
                const year = now.getFullYear();
                const month = pad(now.getMonth() + 1); // Months are zero-based
                const day = pad(now.getDate());
                const notificationDate = `${day}/${month}/${year}`;

                const { student_name, status, attendance, parent_username } = responseData;
                console.log("parent username : ", parent_username);

                for (const item of attendance) {
                    const data = {
                        app_id: "78f2e497-f306-4a96-9f47-c0ae59591675",
                        include_external_user_ids: [parent_username],
                        headings: {
                            "en": `SMAJU Attendance System (${notificationDate})`
                        },
                        contents: {
                            "en": `${student_name} is ${status} for ${item}`
                        }
                    };

                    try {
                        const response = await fetch('https://onesignal.com/api/v1/notifications', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'accept': 'application/json',
                                'Authorization': 'Basic OGMxODYyZmMtODllYS00MjYzLThkMzctODQzMTIyZDllZTkw'
                            },
                            body: JSON.stringify(data)
                        });

                        const result = await response.json();
                        console.log('Notification sent:', result);

                    } catch (error) {
                        console.error('Error during fetch:', error);
                    }
                }
            }

            // Update the date and time immediately
            updateDateTime();

            // Update the date and time every second
            setInterval(updateDateTime, 1000);
        });
    </script>
</body>
</html>
