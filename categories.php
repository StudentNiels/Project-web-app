<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Categories</title>
        
    </head>
    <body>
        <div>
            <p>Selecteer de categori&euml;n waarin je geinteresseerd bent:</p>
        </div>
        <div>
            <form>
                <input type="checkbox" name="informatica" value="informatica" id="categorie"> informatica<br>
                <input type="checkbox" name="databases" value="databases" id="categorie"> databases<br>
                <input type="checkbox" name="html/css" value="html/css" id="categorie"> html/css<br>
                <input type="submit">
            </form>
        </div>
        
    </body>
<?php
/* 
 * 
 * 
 * 
 */
$categorie = (isset($_POST["categorie"]));

function categorieFunc()
{
     if (isset($_POST["categorie"]))
     {
         echo $categorie;
     }
        
}
 echo categorieFunc;
?>