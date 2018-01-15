<!DOCTYPE html>
<html>
<head>
  <title>Results</title>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap-theme.min.css') ?>">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
  <body>
    <div class = "navbar navbar-default">
      <div class = "container">
        <h2><span class = "glyphicon glyphicon-floppy-disk"></span>&nbsp; Tic Tac Toe Results</h2>
      </div>
    </div>
    
    <div class = "row">
      <div class = "container">
        <div class = "col-md-12">
          
          <table class="table">
            <tr>
              <th>Game ID</th>
              <th>Player 1 Name</th>
              <th>Player 2 Name</th>
              <th>Winner</th>
            </tr>

          <?php foreach ($results as $key => $result): ?> 
              <tr>
                <td><?php echo $result->id ?></td>
                <td><?php echo $result->player1name ?></td>
                <td><?php echo $result->player2name ?></td>
                <td><?php echo $result->winner ?></td>
              </tr> 
            <?php endforeach ?>
          </table>

          <p><?php echo $links; ?></p>
        </div>
        <a href = "<?php echo base_url('TTT_Controller/index'); ?>" class= "btn btn-default">Back to home</a>
      </div>
    </div>

  </body>
</html>