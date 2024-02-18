<?php
$qry = $conn->query("SELECT *,concat(lastname,', ',firstname,' ', middlename) as name from `student_list`  order by concat(lastname,', ',firstname,' ', middlename) asc ");
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
	
	body{
		background: #dbdbdb !important;
	}

    .img-avatar{
        width:55px;
        height:55px;
        object-fit:cover;
        object-position:center center;
        border-radius:100%;
    }

	.text-secondary{
		color: #a30909 !important;
	}
	.badge-secondary{
		background: #a30909 !important;
	}
	.card-line{
        border-top: 3px solid #a30909 !important;
    }
	.page-item.active .page-link{
		background: #a30909 !important;
		border-color: #a30909 !important;
	}

	th{
		text-align:center;
	}
	.card{
		border-radius: 15px !important;
		margin-bottom: 10px !important;
	}
</style>
<div class="card card-line card-outline card-primary">
	<div class="card-header">
		<h3 class="card-title">Connect with students</h3>
	</div>
	<div class="card-body">
		<div class="container-fluid">
        <div class="container-fluid">
			<table class="table table-hover table-striped">
				<colgroup>
					<col width="10%">
					<col width="20%">
					<col width="5%">
				</colgroup> 
				<thead>
					<tr>
						<th>Avatar</th>
						<th>Student Name</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						
						while($row = $qry->fetch_assoc()):
					?>
						<tr>
							<td class="text-center"><img src="<?php echo validate_image($row['avatar']) ?>" class="img-avatar img-thumbnail p-0 border-2" alt="user_avatar"></td>
							<td class="text-center"><?php echo ucwords($row['name']) ?></td>
							<td align="center">
							<button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
				                  		Action
				                    <span class="sr-only">Toggle Dropdown</span>
				                  </button>
							<div class="dropdown-menu" role="menu">
				                    <a class="dropdown-item view_details" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-eye text-dark"></span> view</a>
									<a class="dropdown-item" href="#"><i class="fa fa-ban"></i> Report</a>
						</div>
							</td>
						</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
		</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$('.view_details').click(function(){
			uni_modal('Student Details',"view_details.php?id="+$(this).attr('data-id'),'mid-large')
		})
		$('.table').dataTable();
	})

</script>