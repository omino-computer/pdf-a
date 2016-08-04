<html>
<head>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
<link href="vendor/kartik-v/bootstrap-fileinput/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<!-- canvas-to-blob.min.js is only needed if you wish to resize images before upload.
     This must be loaded before fileinput.min.js -->
<script src="vendor/kartik-v/bootstrap-fileinput/js/plugins/canvas-to-blob.min.js" type="text/javascript"></script>

<!-- the main fileinput plugin file -->
<script src="vendor/kartik-v/bootstrap-fileinput/js/fileinput.min.js"></script>
<!-- bootstrap.js below is needed if you wish to zoom and view file content
     in a larger detailed modal dialog -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" type="text/javascript"></script>


</head>
<body>
    <form target="convert.php" enctype="multipart/form-data" method="POST">
        <label for="files">Files to convert</label>
        <input id="file-0b" class="file" type="file" multiple data-min-file-count="1">
        <script>
        $(document).on('ready', function(){$("#file-0b").fileinput();});
        </script>
        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="reset" class="btn btn-default">Reset</button>
    </form>
</body>
</html>
