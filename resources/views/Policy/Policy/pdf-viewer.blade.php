<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Viewer</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>
    <style>
        #pdfViewer {
            width: 100%;
            height: 90vh;
            border: 1px solid #ccc;
        }
    </style>
</head>
<body>
    <canvas id="pdfViewer"></canvas>
    <script>
        const urlParams = new URLSearchParams(window.location.search);
        const pdfUrl = urlParams.get('pdf'); // PDF URL
        const searchTerm = urlParams.get('search'); // Search term

        const pdfjsLib = window['pdfjs-dist/build/pdf'];
        pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.worker.min.js';

        // Load PDF
        const canvas = document.getElementById('pdfViewer');
        const ctx = canvas.getContext('2d');

        pdfjsLib.getDocument(pdfUrl).promise.then(pdf => {
            pdf.getPage(1).then(page => {
                const viewport = page.getViewport({ scale: 1.5 });
                canvas.width = viewport.width;
                canvas.height = viewport.height;

                const renderContext = {
                    canvasContext: ctx,
                    viewport: viewport
                };
                page.render(renderContext).promise.then(() => {
                    if (searchTerm) {
                        highlightSearch(ctx, searchTerm, viewport);
                    }
                });
            });
        });

        function highlightSearch(ctx, term, viewport) {
            // Custom logic to search and highlight text in the PDF
            // Highlighting requires parsing text content of the page
            console.log(`Search for: ${term}`);
        }
    </script>
</body>
</html>
