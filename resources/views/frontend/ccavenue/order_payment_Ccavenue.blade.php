<html>
    <head>
        <title> Redirecting to payment gateway...</title>
    </head>
    <body>
        Redirecting to payment gateway...
        <center>
        <form method="post" name="redirect" action="{{$formUrl}}"> 
            <?php
            echo "<input type=hidden name=encRequest value=$encrypted_data>";
            echo "<input type=hidden name=access_code value=$access_code>";
            ?>
        </form>
        </center>
        <script language='javascript'>
            window.onload = function() {
                document.redirect.submit();
            }
        </script>
    </body>
</html>

