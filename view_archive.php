<?php 
require_once("./config.php");
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT a.* FROM `archive_list` a where a.id = '{$_GET['id']}'");
    if($qry->num_rows){
        foreach($qry->fetch_array() as $k => $v){
            if(!is_numeric($k))
            $$k = $v;
        }
    }
    
    $submitted = "Deactivated";
    if(isset($student_id)){
        $student = $conn->query("SELECT * FROM student_list where id = '{$student_id}'");
        if($student->num_rows > 0){
            $res = $student->fetch_assoc();
            $submitted = $res['email'];
        }
    }
}

?>

<style>
    #document_field{
        min-height:80vh
    }
    .card-line{
        border-top: 3px solid #a30909 !important;
    }
    .text-info{
    color: #a30909 !important;
}
.card-spann{
    color: darkgreen;
    font-weight: 800;
}

.dated{
    float: right;
}

.card{
    border-radius: 15px !important;
}
.best{
    color: #996515 !important;
}
.bolder{
    font-weight: bolder;
}
</style>

<div class="content py-4">
    <div class="col-12">
        <div class="card card-line card-outline card-primary shadow rounded-0">
        <!--<div id="google_translate_element"></div>-->
            <div class="card-header"> 
                <h3 class="card-title">
                    <span class="card-spann">Archived Code</span> - <?= isset($archive_code) ? $archive_code : "" ?>
                </h3>
                <?php if($award_status == 1):?>
                <small class="text-muted dated"><b class="text-info best"><i class="fa fa-star"></i> Best Thesis</b></small>
                    <?php endif; ?>
            </div>
            
            <div class="card-body rounded-0">
                <div class="container-fluid">
                    <h2><b><?= isset($title) ? $title : "" ?></b></h2>
                    <small class="text-muted">Uploaded by <a class="text-info bolder" href="./?page=view_details_uploader&id=<?= isset($student_id) ? $student_id : "" ?>"><?= $submitted ?></a> on <?= date("F d, Y h:i A",strtotime($date_created)) ?></small><br/>
                    <small class="text-muted">Research Published Year: <?= isset($year) ? $year : "----" ?></small><br/>
                    <?php if(isset($student_id) && $_settings->userdata('login_type') == "2" && $student_id == $_settings->userdata('id')): ?>
                        <div class="form-group">
                            <a href="./?page=submit-archive&id=<?= isset($id) ? $id : "" ?>" class="btn btn-flat btn-default bg-navy btn-sm"><i class="fa fa-edit"></i> Edit</a>
                            <button type="button" data-id = "<?= isset($id) ? $id : "" ?>" class="btn btn-flat btn-danger btn-sm delete-data"><i class="fa fa-trash"></i> Delete</button>
                        </div>
                    <?php endif; ?>
                    
                    <hr>
                    <!-- <center>
                        <img src=" //validate_image(isset($banner_path) ? $banner_path : "") " alt="Banner Image" id="banner-img" class="img-fluid border bg-gradient-dark">
                    </center>-->
                    <fieldset>
                        <legend class="text-navy"><i class="fa fa-file"></i> Abstract:</legend>
                        <div class="pl-4"><large><?= isset($abstract) ? html_entity_decode($abstract) : "" ?></large></div>
                    </fieldset>
                    <fieldset>
                        <legend class="text-navy"><i class="fas fa-user-friends"></i> Authors:</legend>
                        <div class="pl-4"><large><?= isset($members) ? html_entity_decode($members) : "" ?></large></div>
                    </fieldset>
                    <?php
                    if($_settings->userdata('id') > 0): ?>
                      <fieldset>
                        <legend class="text-navy">Document:</legend>
                        <div class="pl-4">
                            <iframe src="<?= isset($document_path) ? base_url.$document_path : "" ?>" frameborder="0" id="document_field" class="text-center w-100">Loading Document ...</iframe>
                        </div>
                    </fieldset>
                    <?php else: ?>
                        <legend class="text-navy"><i class="fa fa-file-pdf-o"></i> Document:</legend>
                    <a href="mailto:'<?= $submitted ?>'?subject=Requesting for a Softcopy #<?= $archive_code ?>&body='REASEARCH TITLE: <?= $title ?>'" class="btn btn-secondary btn-default bg-red btn-flat"><i class="fa fa-envelope"></i> Request File</a> <span>or
                    <a href="login.php" class="btn btn-secondary btn-default bg-red btn-flat"><i class='fas fa-user-alt'></i> Student Login</a></span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<script>
    
    $(function(){
        $('.delete-data').click(function(){
            _conf("Are you sure to delete <b>Archive-<?= isset($archive_code) ? $archive_code : "" ?></b>","delete_archive")
        })
    })
    function delete_archive(){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_archive",
			method:"POST",
			data:{id: "<?= isset($id) ? $id : "" ?>"},
			dataType:"json",
			error:err=>{
				console.log(err)
				alert_toast("An error occured.",'error');
				end_loader();
			},
			success:function(resp){
				if(typeof resp== 'object' && resp.status == 'success'){
					location.replace("./");
				}else{
					alert_toast("An error occured.",'error');
					end_loader();
				}
			}
		})
	}

</script>