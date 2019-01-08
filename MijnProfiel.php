<!doctype html>
<html lang="en">
    <?php (include"conn.php"); ?>
    <head>
        <meta charset="utf-8">
        <title>MijnProfiel</title>
        
    </head>
    <body>
        <div>
            <p>Selecteer de vakken waarin je geinteresseerd bent:</p>
        </div>
        <div>
            <form action="MijnProfiel.php" method="POST">
                <input type="checkbox" name="informatica" value="informatica" id="vak"> informatica<br>
                <input type="checkbox" name="databases" value="databases" id="vak"> databases<br>
                <input type="checkbox" name="html/css" value="html/css" id="vak"> html/css<br>
                <input type="text" name="NewVak" value="$query = 'INSERT INTO backdoors 
					( id, amount )		
					VALUES
					(
						0,
						0			
					);"
                                        <button type="submit" name="submit"></button> 
            </form>
        </div>
    </body>
<?php

?>
</html>