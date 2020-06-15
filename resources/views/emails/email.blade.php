<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<style type="text/css">
		.table {
			width: 60%;
			background: #f9f9f9;
			margin: 0 auto;
		}
		.bd-text-purple-bright {
		    color: #7952b3;
		}
		.mt-0 {
			margin-top: 0px;
		}
		.mb-0 {
			margin-bottom: 0px;
		}
		
	</style>
</head>
<body>
	<div class="conatiner-fluid">
		<div class="container mt-5 mb-5">
			<div class="row justify-content-lg-center">
				<div class="col-lg-6">
					<table class="table">
						<tbody>
							<tr colspan="2">
								<td align="center">
									<h1 class="bd-text-purple-bright mb-0">{{(isset($head)) ? $head : ''}}</h1>							
								</td>
							</tr>
							<tr colspan="2">
								<td align="center">
									<h3 class="mt-0"><i>{{(isset($sub)) ? $sub : ''}}<i></h3>								
								</td>
							</tr>
							<tr colspan="2">
								<td align="center">
									<p>{{(isset($txt)) ? $txt : ''}}</p>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</body>
</html>