<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <link type="text/css" rel="stylesheet" href="/pkgs/mystyle.css">
    </head>
    <body onLoad="document.notes.subject.focus()">
        <form action="/pkgs/utilities/AddNotesGet.php" method="post" name="notes">
        Subject
        <input type="text" name="subject" size="40"/>
        <p>
        Notes
        <p>
            <TEXTAREA name="note" rows="25" cols="100"> </TEXTAREA>

         <p>   <input type="submit" value="submit"/>
            <input type="reset"  value="reset"/>
        </form>
        
        
    </body>
</html>
