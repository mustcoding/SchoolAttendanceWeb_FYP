<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://mozilla.github.io/pdf.js/build/pdf.js"></script>
    <style>
        #pdf-container {
            width: 100%;
            height: 600px;
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
        function getPDF(documents) {
            // Get the document path from the URL
            

            if (document_path) {
                // Load the PDF
                const loadingTask = pdfjsLib.getDocument(documents);
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
                }, function (reason) {
                    console.error(reason);
                });
            } else {
                console.error('No document path provided');
            }
        }

        var storedDoc = JSON.parse(sessionStorage.getItem('document'));
        var documents = storedDoc.document;
        console.log("hghjkhj");
        // Call the function to get and display the PDF
        getPDF(documents);
    </script>
</body>
</html>
