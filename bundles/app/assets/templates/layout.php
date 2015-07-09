<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>PHPixie ToDo</title>
        
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    </head>
    <body>
        <div class="container">
            <div class="header clearfix">
                <h3 class="text-muted">PHPixie Todo</h3>
            </div>
            <hr/>
            <?php echo $this->childContent();?>
        </div>
    </body>
</html>