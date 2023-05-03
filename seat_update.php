<!DOCTYPE html>
<html>
<head>
	<title>GRC Cinema</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<h2>Seat selection</h2>
		<form>
			<div class="form-group">
				<label for="date">Date selection:</label>
				<input type="date" class="form-control" id="date">
			</div>
			<div class="form-group">
				<label for="theater">Hall selection:</label>
				<select class="form-control" id="theater">
					<option value="">Please select Hall</option>
					<option value="1">Hall 1</option>
					<option value="2">Hall 2</option>
					<option value="3">Hall 3</option>
				</select>
			</div>
			<div class="form-group">
				<label for="seats">Seat selection:</label><br>
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#seatModal">Select seat</button>
				<input type="hidden" class="form-control" id="seat" name="seat">
			</div>
			<button type="submit" class="btn btn-success">Submit</button>
		</form>
	</div>

	<!-- Seat Modal -->
	<div class="modal fade" id="seatModal">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<!-- Modal Header -->
				<div class="modal-header">
					<h4 class="modal-title">座位选择</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<!-- Modal body -->
				<div class="modal-body">
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-12">
								<div class="seat-map">
									
									<div class="screen">Screen</div>
									<div class="seat">
										<input type="checkbox" value="A1">
										<label for="A1">A1</label>
									</div>
									<div class="seat">
										<input type="checkbox" value="A2">
										<label for="A2">A2</label>
                                                                        </div>
                                                                        								<!-- 省略部分座位代码 -->
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Modal footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
				<button type="button" class="btn btn-primary" id="confirmSeat">确认选择</button>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		// 处理座位选择
		$("#confirmSeat").click(function() {
			var selectedSeats = [];
			$(".seat-map input:checked").each(function() {
				selectedSeats.push($(this).val());
			});
			$("#seat").val(selectedSeats.join(", "));
			$("#seatModal").modal("hide");
		});
	});
</script>

