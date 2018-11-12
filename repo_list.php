<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Repo List</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		
		<style>
			.hiderepo{
				display :none;
			}
			.hideshowrepoSP{
				display :block;
			}
		</style>
	</head>
	<body>
		<div class="container">
			<div class="row" align="center"><h1>REPOSITORIES DATA</h1></div>
			<div class="row" style="height:30px;"></div>
			<div class="row" id="repoinfo"></div>
			<div class="row">
				<form id="repoForm" name="repoForm" method="post"><input type="hidden" id="repoData_hddn" name="repoData_hddn" /></form>
			</div>
			
		</div>
	</body>
	<script type="text/javascript">
		
		function getDistFromBottom () {
			var scrollPosition = window.pageYOffset;
			var windowSize     = window.innerHeight;
			var bodyHeight     = document.body.offsetHeight;
			return Math.max(bodyHeight - (scrollPosition + windowSize), 0);
		}
		
		var request = new XMLHttpRequest();
		request.open('GET', 'https://api.github.com/repositories?since=862', true);
		request.onload = function () {
			var data = JSON.parse(this.response);
			if (request.status >= 200 && request.status < 400) {
				var tbody = "";
				for(var i=0;i<data.length;i++){
					tbody += "<table class='table table-bordered table-striped' id='manuTBL' style='width:100%;'><tbody id='modalTbody'>"+
								"<tr><td style='width:20%;'>Name of the repo :</td><td style='width:80%;'><span class='hideshowrepoSP' id='repo_name_sp"+i+"'>"+data[i].name+"</span><input type='text' class='hiderepo' id='repo_name"+i+"' name='repo_name"+i+"' value="+data[i].name+" /></td></tr>"+
								"<tr><td style='width:20%;'>Description of the repo :</td><td style='width:80%;'><span class='hideshowrepoSP' id='repo_desc_sp"+i+"'>"+data[i].description+"</span><textarea class='hiderepo' id='repo_desc"+i+"' name='repo_desc"+i+"' >"+data[i].description+"</textarea></td></tr>"+
								"<tr><td style='width:20%;'>Owner name :</td><td style='width:80%;'><span class='hideshowrepoSP' id='login_sp"+i+"'>"+data[i].owner.login+"</span><input type='text' class='hiderepo' id='login"+i+"' name='login"+i+"' value="+data[i].owner.login+" /></td></tr>"+
								"<tr><td style='width:20%;'>Owner Type :</td><td style='width:80%;'><span class='hideshowrepoSP' id='owner_type_sp"+i+"'>"+data[i].owner.type+"</span><input type='text' class='hiderepo' id='owner_type"+i+"' name='owner_type"+i+"' value="+data[i].owner.type+" /></td></tr>"+
								"<tr><td style='width:20%;'><input type='button' class='btn-info' id='editbtn"+i+"' value='Edit' onclick='javascript:showRepo(\""+i+"\");'/></td>"+
								"<td style='width:80%;'><input type='button' class='btn-info hiderepo' id='saveBtn"+i+"' value='Save' onclick='javascript:postRepo(\""+i+"\");'/>"+
								"<input type='button' class='btn-info hiderepo' id='cancelBtn"+i+"' value='Cancel' onclick='javascript:cancelEdit(\""+i+"\");'/></td></tr>"+
								"</tbody></table>";	
				}
				document.getElementById('repoinfo').innerHTML = tbody;
			}else {
				console.log('error');
			}
		}
		request.send();
		
		document.addEventListener('scroll', function() {
        distToBottom = getDistFromBottom();
			if (distToBottom > 0 && distToBottom <= 8888) {
				//pollingForData = true;
				//loadingContainer.classList.add('no-content');
				//page++;
				request.open('GET', 'https://api.github.com/repositories?since=862', true);
				request.send();
			}
		});
		function showRepo(count){
			document.getElementById('repo_name_sp'+count).style.display = 'none';
			document.getElementById('repo_desc_sp'+count).style.display = 'none';
			document.getElementById('login_sp'+count).style.display = 'none';
			document.getElementById('owner_type_sp'+count).style.display = 'none';
			document.getElementById('editbtn'+count).style.display = 'none';
			
			document.getElementById('repo_name'+count).style.display = 'block';
			document.getElementById('repo_desc'+count).style.display = 'block';
			document.getElementById('login'+count).style.display = 'block';
			document.getElementById('owner_type'+count).style.display = 'block';
			document.getElementById('saveBtn'+count).style.display = 'block';
			document.getElementById('cancelBtn'+count).style.display = 'block';
		}
		
		function cancelEdit(count){
			document.getElementById('repo_name_sp'+count).style.display = 'block';
			document.getElementById('repo_desc_sp'+count).style.display = 'block';
			document.getElementById('login_sp'+count).style.display = 'block';
			document.getElementById('owner_type_sp'+count).style.display = 'block';
			document.getElementById('editbtn'+count).style.display = 'block';
			
			document.getElementById('repo_name'+count).style.display = 'none';
			document.getElementById('repo_desc'+count).style.display = 'none';
			document.getElementById('login'+count).style.display = 'none';
			document.getElementById('owner_type'+count).style.display = 'none';
			document.getElementById('saveBtn'+count).style.display = 'none';
			document.getElementById('cancelBtn'+count).style.display = 'none';
		}
		
		function postRepo(count){
			var repoData = {'repo_name':document.getElementById('repo_name'+count).value,'repo_desc':document.getElementById('repo_desc'+count).value,'login':document.getElementById('login'+count).value,'owner_type':document.getElementById('owner_type'+count).value};
			document.getElementById('repoData_hddn').value = JSON.stringify(repoData);
			document.repoForm.action = "showRepo.php";
			document.repoForm.submit();
		}
	</script>
</html>