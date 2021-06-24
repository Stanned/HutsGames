<img src="https://localhost:8090/post_ch/admin/record.php?read=1" alt="Tracker">

<?php

header('Content-Type: image/gif');
$counter0 = 0;
$counter1 = 0;

//?>

<a href="https://www.google.nl?game-paginas/pagina1.html">Link</a>
<a href="https://www.google.nl?game-paginas/pagina2.html">Link2</a>
<a href="https://www.google.nl?game-paginas/pagina3.html">Link2</a>
<a href="https://www.google.nl?game-paginas/pagina4.html">Link2</a>
<a href="https://www.google.nl?game-paginas/pagina5.html">Link2</a>
<a href="https://www.google.nl?game-paginas/pagina6.html">Link2</a>
<a href="https://www.google.nl?game-paginas/pagina7.html">Link2</a>
<a href="https://www.google.nl?game-paginas/pagina8.html">Link2</a>
<a href="https://www.google.nl?game-paginas/pagina9.html">Link2</a>

<?php
if(isset($_GET['click']))
{
    if($_GET['click'] = 1) $counter0++;
    elseif ($_GET['click'] = 2) $counter1++;
//    $pdo = new PDO('SECURE (should work)');
//    $statement = $pdo->prepare("INSERT INTO member_clickedlink (clickedlink) VALUES (1)");
}

echo $counter0;
echo $counter1;
?>

