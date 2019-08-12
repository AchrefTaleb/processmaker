<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Performance</title>
  </head>
  <body>
    
    <table class="table table-sm">
        <thead>
          <tr>
            <th scope="col">Route</th>
            <th scope="col">Average time [ms]</th>
            <th scope="col">Requests per second</th>
            <th scope="col">Weighted speed</th>
          </tr>
        </thead>
        <tbody>
<?php foreach(static::$measurements as $measure): ?>
          <tr>
            <th class="<?=$measure['color']?>" scope="row"><?=$measure['route']?> (<?=json_encode($measure['params'])?>)</th>
            <td class="<?=$measure['color']?>"><?=$measure['time']?></td>
            <td class="<?=$measure['color']?>"><?=$measure['requestsPerSecond']?></td>
            <td class="<?=$measure['color']?>"><?=$measure['speed']?></td>
          </tr>
<?php endforeach; ?>
        </tbody>
      </table>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
