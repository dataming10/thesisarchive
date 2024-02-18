<?php 
require_once('./config.php');
if(isset($_GET['id']) && $_GET['id'] > 0){
    $user = $conn->query("SELECT s.*,d.name as department, c.name as curriculum,CONCAT(lastname,', ',firstname,' ',middlename) as fullname FROM student_list s inner join department_list d on s.department_id = d.id inner join curriculum_list c on s.curriculum_id = c.id where s.id ='{$_GET['id']}'");
    foreach($user->fetch_array() as $k =>$v){
        $$k = $v;
    }
}
?>
<style>
	body{
		overflow-y: hidden;
	}
    .student-img{
		object-fit:scale-down;
		object-position:center center;
        height:200px;
        width:200px;
        border-radius: 10px;
		pointer-events: none;
	}
    .card-line{
        border-top: 3px solid #a30909 !important;
    }
    .btn-secondary{
        background: #a30909 !important;
    }
    .btn-secondary:hover{
        background-color: #000000 !important;
        color: #ffffff !important;
    }

    .card{
    border-radius: 15px !important;
	width: 65%;
	margin-left: auto;
	margin-right: auto;
}
dl{
	margin-left: 55px;
}
.text-nav{
	font-size: 15pt;
}
.pl-4{
	font-size: 13pt;
}
.fa-check-circle{
	color: #a30909 !important;
}
</style>
<div class="content py-4">
    <div class="card card-line card-outline card-primary shadow rounded-0">
        <div class="card-header rounded-0">
            <h5 class="card-title">Connect with <?= ucwords($firstname) ?> <i class="fa fa-check-circle"></i> </h5>
        </div>
        <div class="card-body rounded-0">
            <div class="container-fluid">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-lg-4 col-sm-12">
                            <center>
                                <img src="<?= validate_image($avatar) ?>" alt="Student Image" class="img-fluid student-img bg-gradient-dark border">
                            </center>
                        </div>
                        <div class="col-lg-8 col-sm-12">
                            <dl>
                                <dt class="text-navy text-nav">Student Name:</dt>
                                <dd class="pl-4"><?= ucwords($fullname) ?></dd>
                                <dt class="text-navy text-nav">Department:</dt>
                                <dd class="pl-4"><?= ucwords($department) ?></dd>
                                <dt class="text-navy text-nav">Course:</dt>
                                <dd class="pl-4"><?= ucwords($curriculum) ?></dd>
								<dt class="text-navy text-nav">Date Joined:</dt>
                                <dd class="pl-4"><?= ucwords($date_created) ?></dd>
								<dt class="text-navy text-nav">Connect via:</dt>
					            <a class="dropdown-item links" href="mailto: <?= ($email) ?>"><span class="fa fa-envelope text-primary"></span> Email</a>
								<a class="dropdown-item links" href="#"><i class='fab fa-facebook-messenger'></i> Messenger</a>
				</dl>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>