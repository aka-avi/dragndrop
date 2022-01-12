<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>dragNdrop</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
	<style type="text/css">
		.dragging{
			opacity: 0.5;
		}

		.draggable{
			cursor: move;
		}
		.d-table{
			display: flex;
		}
	</style>
</head>
<body>
	<h2>Drag Drop</h2>
	<div class="container">
		<div class="row">
			<div class="col-3">
				<table class="table table-stripped">
					<thead>
						<tr>
							<th>Approved</th>
						</tr>
					</thead>
					<tbody class="droppable" id="0">
						<?php if(isset($approve_orders)) { 
							foreach ($approve_orders as $orders) { ?>
								<tr class="draggable" id="saleorder_<?php echo $orders['id']; ?>" draggable="true">
									<td><?php echo $orders['material']; ?><span><i class="fas fa-eye"></i></span></td>
								</tr>
						<?php  } } ?>						
					</tbody>
				</table>
			</div>
			<div class="col-9">
				<table class="table">
					<thead>
						<tr>
							<th>NUmber</th>
							<th>Export</th>
							<th>Dispatch</th>
							<th>Delete</th>
							<th>Orders</th>
						</tr>
					</thead>
					<tbody>
						<?php if(isset($trucks)) { 
							foreach ($trucks as $truck) { ?>
							<tr>
								<td><?php echo $truck['driver_name']; echo '<br>'; echo $truck['truck_num']; ?></td>
								<td><i class="fas fa-download"></i></td>
								<td><i class="fas fa-truck"></i></td>
								<td><i class="fas fa-trash"></i></td>
								<td class="droppable" id="truck_<?php echo $truck['id'];?>">
									<table>
										<?php if(!empty($truck['info'])) {
											$truck['info'] = json_decode($truck['info']);
											foreach ($truck['info'] as $value) { ?>
											<tr class="draggable" id="saleorder_<?php echo $value->id; ?>" draggable="true">
												<td><?php echo $value->id; ?><span><i class="fas fa-eye"></i></span></td>			
											</tr>		
										<?php } } ?>
									</table>
								</td>
							</tr>
						<?php } } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script type="text/javascript">
	const draggables = document.querySelectorAll('.draggable');
	const droppables = document.querySelectorAll('.droppable'); 

	draggables.forEach(draggable => {
		
		draggable.addEventListener('dragstart', () => {
			draggable.classList.add('dragging');
		});

		draggable.addEventListener('dragend', () => {
			draggable.classList.remove('dragging');
		});

	});

	droppables.forEach(droppable => {

		droppable.addEventListener('dragover', (e) => {
			e.preventDefault();
		});

		droppable.addEventListener('drop', (e) => {
			const draggable = document.querySelector('.dragging');
			droppable.appendChild(draggable);
			const thisid = e.target.id;
			// const thatid = e.target.id;
			const draggableid = draggable.id;
			console.log(thisid);
			console.log(draggableid);

			$.ajax({
				type:"POST",
				url: "http://localhost/dragndrop/index.php/drag/save_change",
				data: {sale_order_id: draggableid, container_id: thisid},
				success : function (result) {
					console.log(result);
				}
			});
		});


	});

</script>
</html>