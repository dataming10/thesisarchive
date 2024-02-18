<style>
    .card-line{
        border-top: 3px solid #a30909 !important;
    }
    .pages{
        background:  #a30909 !important;
    }
    .list-groups:empty:before {
    color: #505050;
    content: "No Research Has Found";
    text-align: center; 
    width: calc(100%);
}
.text-info{
    color: #a30909 !important;
}

.card{
    border-radius: 15px !important;
}
</style>

<div class="content py-2">
    <div class="col-12">
        <div class="card card-line card-outline card-primary shadow rounded-0">
            <div class="card-body rounded-0">
                <h2>Archive List</h2>
                <i class="fa fa-eye"></i> <span id="result"></span>
                <hr class="bg-navy">
                <?php 
                $limit = 10;
                $page = isset($_GET['p'])? $_GET['p'] : 1; 
                $offset = 10 * ($page - 1);
                $paginate = " limit {$limit} offset {$offset}";
                $isSearch = isset($_GET['q']) ? "&q={$_GET['q']}" : "";
                $search = "";
                if(isset($_GET['q'])){
                    $keyword = $conn->real_escape_string($_GET['q']);
                    $search = " and (title LIKE '%{$keyword}%' or abstract  LIKE '%{$keyword}%' or members LIKE '%{$keyword}%' or award_status LIKE '%{$keyword}%' or curriculum_id in (SELECT id from curriculum_list where name  LIKE '%{$keyword}%' or description  LIKE '%{$keyword}%') or curriculum_id in (SELECT id from curriculum_list where department_id in (SELECT id FROM department_list where name  LIKE '%{$keyword}%' or description  LIKE '%{$keyword}%'))) ";
                }
                $students = $conn->query("SELECT * FROM `student_list` where id in (SELECT student_id FROM archive_list where `status` = 1 {$search})");
                $student_arr = array_column($students->fetch_all(MYSQLI_ASSOC),'email','id');
                $count_all = $conn->query("SELECT * FROM archive_list where `status` = 1 {$search}")->num_rows;    
                $pages = ceil($count_all/$limit);
                $archives = $conn->query("SELECT * FROM archive_list where `status` = 1 {$search} order by unix_timestamp(date_created) desc {$paginate}");  
                  // Function to get similar words
                  function getSimilarWords($search, $maxDistance = 5)
                  {
                      global $conn;
                  
                      $result = array();
                      $query = $conn->prepare("SELECT title FROM archive_list WHERE status=1");
                      if (!$query) {
                          die('Error in preparing the statement: ' . $conn->error);
                      }
                      $query->execute();
                      if ($query->errno) {
                          die('Error in executing the statement: ' . $query->error);
                      }
                      $query->bind_result($word);
                  
                      while ($query->fetch()) {
                          similar_text($search, $word, $percent);
                  
                          if ($percent >= 50) {
                              $result[] = $word;
                          }
                      }
                      $query->close();
                  
                      return $result;
                  }
    // Get similar words
    if (!empty($_GET['q'])) {
        $keyword = $conn->real_escape_string($_GET['q']);
        $search = " and (title LIKE '%{$keyword}%' or abstract  LIKE '%{$keyword}%' or members LIKE '%{$keyword}%' or award_status LIKE '%{$keyword}%' or curriculum_id in (SELECT id from curriculum_list where name  LIKE '%{$keyword}%' or description  LIKE '%{$keyword}%') or curriculum_id in (SELECT id from curriculum_list where department_id in (SELECT id FROM department_list where name  LIKE '%{$keyword}%' or description  LIKE '%{$keyword}%'))) ";
        
        // Get similar words
        $suggestions = getSimilarWords($keyword);
    }

            // Display suggestions in HTML
            if (!empty($suggestions)) {
                echo "<div class='suggestions'>";
                echo "<h5>Did you mean:</h5>";
                echo "<ul>";
                foreach ($suggestions as $suggestion) {
                    echo "<li><a href='suggestion-results.php?searchinput=" . urlencode($suggestion) . "'>$suggestion</a></li>";
                }
                echo "</ul>";
                echo "</div>";
            }
                ?>
                <?php if(!empty($isSearch)): ?>
                <h3 class="text-center"><b>Search Result for "<?= $keyword ?>" keyword</b></h3>
                <?php endif ?>
                <div class="list-groups list-group">
                <?php
?>
                    <?php 
                    while($row = $archives->fetch_assoc()):
                        $row['abstract'] = strip_tags(html_entity_decode($row['abstract']));
                    ?>
                    <a href="./?page=view_archive&id=<?= $row['id'] ?>" class="text-decoration-none text-dark list-group-item list-group-item-action">
                        <div class="row">
                            <div class="col-lg-4 col-md-5 col-sm-12 text-center">
                                <img src="<?= validate_image($row['banner_path']) ?>" class="banner-img img-fluid bg-gradient-dark" alt="Banner Image">
                            </div>
                            <div class="col-lg-8 col-md-7 col-sm-12">
                                <h3 class="text-navy"><b><?php echo $row['title'] ?></b></h3>
                                <small class="text-muted">Uploaded By : <b class="text-info"><?= isset($student_arr[$row['student_id']]) ? $student_arr[$row['student_id']] : "N/A" ?></b></small>
                                
                                <?php if($row['award_status'] == 1):?>
                                <small class="text-muted dated"><b class="text-info best"><i class="fa fa-star"></i> Best Thesis</b></small>
                                <?php endif; ?>

                                <p class="truncate-5"><i class="fa fa-newspaper-o"></i> <?= $row['abstract'] ?></p>
                            </div>
                        </div>
                    </a>
                    <?php endwhile;?>
                </div>
                <?php
                ?>
            </div>
            <div class="card-footer clearfix rounded-0">
                <div class="col-12">
                    <div class="row">
                        <div class="col-md-6"><span class="text-muted">Display Items: <?= $archives->num_rows ?></span></div>
                        <div class="col-md-6">
                            <ul class="pagination pagination-sm m-0 float-right">
                                <li class="page-item"><a class="page-link" href="./?page=projects<?= $isSearch ?>&p=<?= $page - 1 ?>" <?= $page == 1 ? 'disabled' : '' ?>>«</a></li>
                                <?php for($i = 1; $i<= $pages; $i++): ?>
                                <li class="page-item"><a class="pages page-link <?= $page == $i ? 'active' : '' ?>" href="./?page=projects<?= $isSearch ?>&p=<?= $i ?>"><?= $i ?></a></li>
                                <?php endfor; ?>
                                <li class="page-item"><a class="page-link" href="./?page=projects<?= $isSearch ?>&p=<?= $page + 1 ?>" <?= $page == $pages ? 'disabled' : '' ?>>»</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>