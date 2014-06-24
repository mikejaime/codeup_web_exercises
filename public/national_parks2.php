<?php

function getOffset() {
   $page = isset($_GET['page']) ? $_GET['page'] : 1;

   return ($page - 1) * 4;
}

$dbc = new PDO('mysql:host=127.0.0.1;dbname=national_parks_db', 'Andrew', 'letmein');
$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$query = 'SELECT * FROM National_Parks LIMIT 4 OFFSET ' . getOffset ();
$parks = $dbc->query($query)->fetchAll(PDO::FETCH_ASSOC);

$count = $dbc->query('SELECT count(*) FROM National_Parks')->fetchColumn();

$numPages = ceil($count / 4);

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$nextPage = $page + 1;
$prevPage = $page - 1;

?>

<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8" />
   <title>National Parks</title>

   <link rel="stylesheet" href="/css/bootstrap.min.css" />
   <link rel="stylesheet" href="/css/bootstrap-theme.min.css" />

   <script src="js/jquery.min.js" type="text/javascript" charset="utf-8"></script>
   <script src="bootstrap/js/bootstrap.min.js" type="text/javascript" charset="utf-8"></script>
</head>
<body>
   <div class="container">
       <h1>National Parks <small>Parks National</small></h1>

       <table class="table table-striped table-hover">
           <tr>
               <th>Name</th>
               <th>State</th>
               <th>Date Established</th>
               <th>Area in Acres</th>
           </tr>

           <?php foreach ($parks as $park): ?>
               <tr>
                   <td><?= $park['name']; ?></td>
                   <td><?= $park['location']; ?></td>
                   <td><?= $park['date_established']; ?></td>
                   <td><?= $park['area_in_acres']; ?></td>
               </tr>
           <?php endforeach ?>
       </table>
       <ul class="pager">
           <?php if ($page == 1): ?>
           <li class="previous disabled"><a href="">&larr; Previous</a></li> 
           <?php else: ?>
               <a href="?page=<?= $prevPage;?>">&larr; Previous</a>
           <? endif ?>   
           <li class="next">
               <a href="?page=<?= $nextPage;?>">Next &rarr;</a>
           </li>
       </ul>
   </div>
</body>
</html>