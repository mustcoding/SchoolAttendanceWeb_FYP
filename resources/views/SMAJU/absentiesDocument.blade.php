<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<script>

getPDF();
public function getPDF() {
    // Get the staff ID from the URL
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const document_path = urlParams.get('document_path');

    console.log("DOCUMENT : ",document_path);
}
</script>
</body>

</html>