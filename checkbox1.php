<?php

$authors = array('snot' => 'J.R.R. Tolkien',
                 'crap' =>'Dr. Seuss',
                 'jizz'=>'Dan Brown',
                 'whisky'=>'Robert Ludlum',
                 'clam juice'=>'Gaston Leroux');

$authors["turd"] = 'Julia Child';
//while ($mkey = current($authors))
    //if ($mkey == 'Julia Child')
  //   {
  //      echo key($authors).'<br />';
  //  }
    //next($authors);
    
echo "<form action=\"{$_SERVER['PHP_SELF']}\" method=\"post\">\n";

foreach($authors as $key=>$author)
{
    echo " <input type=\"checkbox\" value=\"{$key}\" name=\"authors[]\">{$author}</input><br />\n";
}

echo " <input type=\"submit\" value=\"Submit\" name=\"submit\"/>\n";
echo "</form>\n";

echo "\n";






// check submitted values
if (isset($_POST['authors']))
{
         echo key($authors).'<br />';
   echo "You submitted: " . join(', ', $_POST['authors']) . ".\n";
}

?>