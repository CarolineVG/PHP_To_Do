<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    </head>
    <body>
<!-- write reaction -->
<form id="mycomment" method="post">
    <textarea maxlength="140" name="message" id="message" placeholder="Add your comment!"></textarea>
    <input type="submit" name="submit" value="Add Comment" id="submitajax" onclick="start()">
</form>

<div id="result"></div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/ajax.js"></script>
</body>
</html>