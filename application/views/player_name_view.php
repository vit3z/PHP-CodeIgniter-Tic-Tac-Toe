<!DOCTYPE html>
<html>
<head>
	<title>Welcome to Tic-Tac-Toe</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap-theme.min.css') ?>">
	<style type="text/css">
		.lastFiveResults
		{
			float: right;
			clear: right;
			margin-right:50px;
		}
		.container
		{
			float:left;
			margin-left:50px;
		}
	</style>
</head>
	<body>
		<div class = "navbar navbar-default">
			<div class = "container">
				<h2><span class = "glyphicon glyphicon-home"></span>&nbsp; Tic-Tac-Toe</h2>
			</div>
		</div>
	
		<div class = "container">

			<?php
				if($this->session->flashdata('success_msg'))
				{
			?>
					<div class = "alert alert-success">
						<?php echo $this->session->flashdata('success_msg'); ?>
					</div>
			<?php	
				}
			?>

			<?php
				if($this->session->flashdata('error_msg'))
				{
			?>
					<div class = "alert alert-danger">
						<?php echo $this->session->flashdata('error_msg'); ?>
					</div>
			<?php	
				}
			?>

			<h2 align = "center">Welcome to Tic-Tac-Toe</h2>
			<h3 align = "center">Two player mode</h3>
			<h4 align = "center">Players, please enter your names</h4>
			<br></br>
			<form action = "<?php echo base_url('TTT_Controller/submit'); ?>" method = "post", class = "form-horizontal">

				<div class = "form-group">
					<label for = "player1name" class = "col-md-2 text-right">Player 1 Name: </label>
					<div class = "col-md-10">
						<input type="text" name="player1name" class = "form-control" required>
					</div>
				</div>

				<div class = "form-group">
					<label for = "player2name" class = "col-md-2 text-right">Player 2 Name: </label>
					<div class = "col-md-10">
						<input type="text" name="player2name" class = "form-control" required>
					</div>
				</div>

				<div class = "form-group">
					<label class = "col-md-2 text-right"></label>
					<div class = "col-md-10">
						<input type="submit" name="btnSave" class = "btn btn-primary" value = "Two Player Game">
					</div>
				</div>
			</form>
			<h3 align = "center">One player mode</h3>
			<h4 align = "center">Player, please enter your name</h4>
			<form action = "<?php echo base_url('TTT_Controller/submitVsCpu'); ?>" method = "post", class = "form-horizontal">

					<div class = "form-group">
						<label for = "player1name" class = "col-md-2 text-right">Player Name: </label>
						<div class = "col-md-10">
							<input type="text" name="player1name" class = "form-control" required>
						</div>
					</div>

					<div class = "form-group">
						<label class = "col-md-2 text-right"></label>
						<div class = "col-md-10">
							<input type="submit" name="btnSave" class = "btn btn-primary" value = "One Player Game">
						</div>
					</div>
			</form>
		</div>

		<div class = "lastFiveResults">
			<table class = "table table-bordered table-responsive">
				<thead>
					<tr>
						<th>Match No.</th>
						<th>Player 1 Name</th>
						<th>Player 2 Name</th>
						<th>Winner</th>
					</tr>
					</thead>
					<tbody>
					<?php 
						if($games)
						{
							foreach($games as $name)
							{

					?>
					<tr>
						<td><?php echo $name->id; ?></td>
						<td><?php echo $name->player1name; ?></td>
						<td><?php echo $name->player2name; ?></td>
						<td><?php echo $name->winner; ?></td>
					</tr>
					<?php
							}
						}
					?>
				</tbody>
			</table>
		</div>
	
	</body>
</html>