<?php
$data = json_decode($_POST['repoData_hddn'],true);
?>
<html lang="en">
	<head>
		<title>Repo List</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</head>
	<body>
		<div class="container">
			<div class="row" align="center"><h1>REPOSITORIES DATA</h1></div>
			<div class="row" style="height:30px;"></div>
			<div class="row">
				<table class='table table-bordered table-striped' style='width:100%;'>
					<tbody>
						<tr><td style="width:20%;">Name of the repo :</td><td style="width:80%;"><?php echo $data['repo_name'];?></td></tr>
						<tr><td style="width:20%;">Description of the repo :</td><td style="width:80%;"><?php echo $data['repo_desc'];?></td></tr>
						<tr><td style="width:20%;">Owner name :	</td><td style="width:80%;"><?php echo $data['login'];?></td></tr>
						<tr><td style="width:20%;">Owner Type :	</td><td style="width:80%;"><?php echo $data['owner_type'];?></td></tr>
						<tr><td style="width:100%;" colspan=2><a href="repo_list.php"><input type="button" class="btn-info" value="Back"/></a></td></tr>
					</tbody>
				</table>	
			</div>
		</div>
	</body>
</html>	