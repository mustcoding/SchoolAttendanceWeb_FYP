<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.9.359/pdf.min.js"></script>

    <style>
        #pdf-container {
            width: 100%;
            height: 100%;
            overflow: auto;
        }
        #pdf-render {
            width: 100%;
        }
    </style>
</head>
<body>
    <div id="pdf-container">
        <canvas id="pdf-render"></canvas>
    </div>

    <script>
        // Function to convert a base64 string to Uint8Array
        function base64ToUint8Array(base64) {
            var binaryString = window.atob(base64);
            var len = binaryString.length;
            var bytes = new Uint8Array(len);
            for (var i = 0; i < len; i++) {
                bytes[i] = binaryString.charCodeAt(i);
            }
            return bytes;
        }

        document.addEventListener("DOMContentLoaded", function() {
            // Retrieve the stored document from sessionStorage
            var storedDoc = JSON.parse(sessionStorage.getItem('document'));
            console.log("PATH :", storedDoc);

           
                // Assuming the document is stored as a base64-encoded string
                var base64String = storedDoc;
                console.log("Base64 String:", base64String);

                try {
                    // Convert the base64 string to Uint8Array
                    var documents = base64ToUint8Array(base64String);
                    console.log("Uint8Array:", documents);

                    function getPDF(documents) {
                        // Load the PDF using the Uint8Array
                        const loadingTask = pdfjsLib.getDocument({ data: documents });
                        loadingTask.promise.then(function(pdf) {
                            console.log('PDF loaded');

                            // Fetch the first page
                            const pageNumber = 1;
                            pdf.getPage(pageNumber).then(function(page) {
                                console.log('Page loaded');

                                const scale = 1.5;
                                const viewport = page.getViewport({ scale: scale });

                                // Prepare canvas using PDF page dimensions
                                const canvas = document.getElementById('pdf-render');
                                const context = canvas.getContext('2d');
                                canvas.height = viewport.height;
                                canvas.width = viewport.width;

                                // Render PDF page into canvas context
                                const renderContext = {
                                    canvasContext: context,
                                    viewport: viewport
                                };
                                const renderTask = page.render(renderContext);
                                renderTask.promise.then(function() {
                                    console.log('Page rendered');
                                });
                            });
                        }).catch(function (reason) {
                            console.error('Error loading PDF:', reason);
                        });
                    }

                    if (typeof pdfjsLib !== 'undefined') {
                        getPDF(documents);
                    } else {
                        console.error("PDF.js library did not load correctly.");
                    }
                } catch (error) {
                    console.error("Error converting base64 string:", error);
                }
           
        });
    </script>
</body>
</html>
