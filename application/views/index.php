<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Bootstrap Example</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
	<style>
		#page>div {
			display: none;
		}

		#masterpage .col-sm:last-child {
			border-left: 1px solid #dee2e6;
		}

		#masterpage .col-sm:last-child {
			border-left: 1px solid #dee2e6;
			height: 80vh;
		}
	</style>
</head>

<body>
	<nav class="navbar navbar-expand-sm bg-light">
		<div class="container-fluid">
			Task for Experience Program
			<button id="modalemitter" type="button" class="btn btn-outline-success btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-plus" viewBox="0 0 16 16">
					<path d="M8 6.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V11a.5.5 0 0 1-1 0V9.5H6a.5.5 0 0 1 0-1h1.5V7a.5.5 0 0 1 .5-.5z" />
					<path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h-2z" />
				</svg></button>
		</div>
	</nav>
	<!-- Button trigger modal -->


	<!-- Modal -->
	<div class="modal fade" id="modalforpayment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Odenis paneli</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="modal-body">
						<div class="container-fluid">

							<form class="row g-3">
								<div class="col-md-6" id="modaluserlist">
									<label for="inputEmail4" class="form-label">Istifadeci</label>
									<!-- <input type="email" class="form-control" id="inputEmail4"> -->
								</div>
								<div class="col-md-6" id="modalcurrencylist">
									<label for="inputPassword4" class="form-label">Valyuta novu</label>
								</div>
								<div class="col-md-6" id="modalcategorylist">
									<label for="inputPassword4" class="form-label">Odenis novu</label>
									<div class="input-group mb-3">

										<span id="smamount" class="input-group-text">0.00</span>
										<input id="mamount" type="text" class="form-control">
									</div>

								</div>

								<div class="col-md-6" id="modalpayment_category_list">
									<label for="inputPassword4" class="form-label">Odenis novu</label>
									<select class="form-select" aria-label="Default select example" id="paymentcategorylist">


									</select>
								</div>
							</form>

						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button id="payemitter" type="button" class="btn btn-primary">Odenis et</button>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid">
		<div class="card text-center">
			<div class="card-header">
				Xerclerin Idaresi


			</div>
			<div class="card-body" id="mainpage">
				<div class="row" id="masterpage">
					<div class="col-sm-4">
						STATISTIK GOSTERICILER
						<div class="table-responsive">
							<table class="table">
								<caption>List of users</caption>
								<thead>
									<tr>
										<th scope="col">#</th>
										<th scope="col">User</th>
										<th scope="col">Medaxil</th>
										<th scope="col">Mexaric</th>
										<th scope="col">Qaliq</th>
									</tr>
								</thead>
								<tbody id="tbodystatics">

								</tbody>
							</table>
						</div>

					</div>
					<div class="col-sm" id="payments">
						UMUMI ODENISLER
						<form>
							<div class="row">
								<div class="col">
									<select class="form-select" aria-label="Default select example" id="userlist">

										<option selected value="all">Hamisi</option>
									</select>

								</div>
								<div class="col">
									<select class="form-select" aria-label="Default select example" id="currencylist">
										<option selected value="all">Hamisi</option>
									</select>
								</div>
								<div class="col">
									<div class="input-group mb-2">

										<input id="datefrom" type="date" class="form-control" aria-label="Amount (to the nearest dollar)">

									</div>
								</div>
								<div class="col">
									<div class="input-group mb-3">

										<input id="dateto" type="date" class="form-control" aria-label="Amount (to the nearest dollar)">

									</div>
								</div>
								<div class="col">
									<button id="filteremitter" class="btn btn-primary" type="submit">filtirle</button>
								</div>
							</div>
						</form>


						<div class="table-responsive">
							<table class="table">
								<caption>List of users</caption>
								<thead>
									<tr>
										<th scope="col">#</th>
										<th scope="col">User</th>
										<th scope="col">Medaxil</th>
										<th scope="col">Mexaric</th>
										<th scope="col">Tarix</th>
									</tr>
								</thead>
								<tbody id="tbodygeneral">

								</tbody>
							</table>
						</div>

					</div>

				</div>
			</div>
		</div>











<?php echo base_url();?>



















	</div>


	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
	<script src="<?php echo base_url();?>/public/js/custom.js"></script>









	<script>
	</script>



</body>

</html>