<html>
<head>
    <link href="vendor/components/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/kartik-v/bootstrap-fileinput/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
    <script src="vendor/components/jquery/jquery.min.js"></script>
    <script src="vendor/kartik-v/bootstrap-fileinput/js/fileinput.js"></script>
    <script src="vendor/components/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
</head>
<body>
    <form enctype="multipart/form-data" method="POST">
        <label for="files">Files to convert</label>
        <input id="file_upload" name="files" type="file" multiple>
        <script>
        $(document).on('ready', function(){
            var $input = $("#file_upload");
            $input.fileinput({
                allowedFileExtensions:['pdf'],
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
                window.location = file_url;
//                $.fileDownload(file_url).fail(function () { alert('File download failed!'); });
            });
        });
        </script>
    </form>
</body>
</html>
