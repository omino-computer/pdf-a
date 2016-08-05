<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PDF to PDF/A-1B converter</title>
    <link href="vendor/components/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/kartik-v/bootstrap-fileinput/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
    <link href="style.css" media="all" rel="stylesheet" type="text/css" />
    <script src="vendor/components/jquery/jquery.min.js"></script>
    <script src="vendor/kartik-v/bootstrap-fileinput/js/fileinput.js"></script>
    <script src="vendor/components/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
</head>
<body>
    <div class="container">
        <div class="main-content">
            <h2>PDF to PDF/A-1B converter</h2>
            <form enctype="multipart/form-data" method="POST">
                <label for="files">Files to convert</label>
                <input id="file_upload" name="files" type="file" multiple>
                <script>
                $(document).on('ready', function(){
                    var $input = $("#file_upload");
                    var if_num=0; // iframe counter
                    function downloadFile(url) {
                        var iframe;
                        if_num++;
                        iframe = document.getElementById("download-container"+if_num);
                        if (iframe === null)
                        {
                            iframe = document.createElement('iframe');
                            iframe.id = "download-container";
                            iframe.style.visibility = 'hidden';
                            document.body.appendChild(iframe);
                        }
                        iframe.src = url;
                    }

                    $input.fileinput({
                        allowedFileExtensions:['pdf'],
                        browseOnZoneClick: true,
                        uploadAsync: true,
                        showUpload: false, // hide upload button
                        showRemove: false, // hide remove button
                        minFileCount: 1,
                        maxFileCount: 50,
                        uploadUrl: 'convert.php'
                    }).on("filebatchselected", function(event, files) {
                        // trigger upload method immediately after files are selected
                        $input.fileinput("upload");
                    }).on("fileuploaded", function(event, data, previewId, index) {
                        var file_url = data.response.file_path;
                        downloadFile(file_url);
                    });
                });
                </script>
            </form>
        </div>
    </div>
</body>
</html>
