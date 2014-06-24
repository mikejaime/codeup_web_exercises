<?php

//result limit per page
$limit = 4;

function getOffset($limit) {
   $page = isset($_GET['page']) ? $_GET['page'] : 1;

   return ($page - 1) * $limit;
}

$dbc = new PDO('mysql:host=127.0.0.1;dbname=codeup_pdo_test_db', 'mike', 'letmein');
$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$query = "SELECT * FROM national_parks LIMIT $limit OFFSET " . getOffset($limit);
$parks = $dbc->query($query)->fetchAll(PDO::FETCH_ASSOC);

$count = $dbc->query('SELECT count(*) FROM national_parks')->fetchColumn();

$numPages = ceil($count / $limit);

$page = isset($_GET['page']) ? $_GET['page'] : 1; //
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

   <script src="js/jquery-2.1.1.js" type="text/javascript" charset="utf-8"></script>
   <script src="/js/bootstrap.min.js" type="text/javascript" charset="utf-8"></script>
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
               <th>Description</th>
           </tr>

           <?php foreach ($parks as $park): ?>
               <tr>
                   <td><?= $park['name']; ?></td>
                   <td><?= $park['location']; ?></td>
                   <td><?= $park['date_established']; ?></td>
                   <td><?= $park['area_in_acres']; ?></td>
                   <td><?= $park['description']; ?></td>
               </tr>
           <?php endforeach ?>
       </table>
       <ul class="pager">
           <? if ($page > 1): ?>
              <li class="previous"><a href="?page=<?= $prevPage;?>">&larr; Previous</a></li>
           <? endif ?>   
           
           <? if ($page < $numPages): ?>
              <li class="next"><a href="?page=<?= $nextPage;?>">Next &rarr;</a></li>
           <? endif ?>  
       </ul>
   </div>
</body>
</html>