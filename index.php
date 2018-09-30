<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Progress Bar</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
	<div class="container" style="margin-top:10px;">
		<div class="row">
            <div class="col-xs-12">
                <form method="POST">
                    <div class="form-group">
                        <label for="InputFile">File input</label>
                        <input type="file" id="InputFile" name="file">
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Upload">
                    </div>                 
                </form>
            </div>
		</div>
        <div class="row">
            <div class="col-xs-6">
                <div class="progress">
                    <div id="progressBar" class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%">
                        <span class="sr-only">0% Complete</span>
                    </div>
                </div>                
            </div>
        </div>
	</div>    

    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>    

    <script>
        $(document).ready(function() {
            $('form').on('submit', function(event){
                event.preventDefault();
                var formData = new FormData($('form')[0]);
               
                $.ajax({
                    xhr : function() {
                        var xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener('progress', function(e){
                            var percent = Math.round((e.loaded / e.total) * 100);
                            $('#progressBar').attr('aria-valuenow', percent).css('width', percent + '%').text(percent + '%');
                        });
                        return xhr;
                    },
                    
                    type : 'POST',
                    url : 'upload.php',
                    data : formData,
                    processData : false,
                    contentType : false,
                    success : function(response){
                        $('form')[0].reset();
                    },
                    error : function(response){
                        console.log(response);
                    }
                });
            });
        });
    </script>        
</body>
</html>