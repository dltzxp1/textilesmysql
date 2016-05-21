<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8"/>
        <title>Krajee JQuery Plugins - &copy; Kartik</title>

        <link href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet">
        <link href="bootstrap-fileinput/css/css/fileinput.css" media="all" rel="stylesheet" type="text/css" />

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="bootstrap-fileinput/js/fileinput.min.js" type="text/javascript"></script>


    </head>

    <body>
        <div class="container">

            <form action="upload_manager.php" method="post" enctype="multipart/form-data">
                <h2>Upload File</h2>
                <label for="fileSelect">Filename:</label>
                <input type="file" name="photo" id="fileSelect"><br>
                <input type="submit" name="submit" value="Upload">
            </form>
            
        </div>
    </body>

    <script>
        $("#file-3").fileinput({
            showCaption: false,
            browseClass: "btn btn-primary btn-lg",
            fileType: "any"
        });
    </script>

    &nbsp;

</html>