<!DOCTYPE html>
<html>
  <center>
    <header>
        <style>
.grid{
  height:23px;
  position:relative;
  bottom:4px;
}
.logo{
  margin-top:15px;
  margin-bottom:20px;
  pointer-events: none;
}
.bar{
  margin:0 auto;
  width:575px;
  border-radius:30px;
  border:1px solid #dcdcdc;
}
.bar:hover{
  box-shadow: 1px 1px 8px 1px #dcdcdc;
}
.bar:focus-within{
  box-shadow: 1px 1px 8px 1px #dcdcdc;
  outline:none;
}
.searchbar{
  height:45px;
  border:none;
  width:500px;
  font-size:16px;
  outline: none;
  
}
.buttons{
  margin-top:30px;
}
.button{
  background-color: #f5f5f5;
  border:none;
  color:#707070;
  font-size:15px;
  padding: 10px 20px;
  margin:5px;
  border-radius:4px;
  outline:none;
}
.button:hover{
  background: #a30909 !important;
  color:#ffffff;
}
.button:focus{
  border:1px solid #4885ed;
  padding: 9px 19px;
}
        </style>
    
    </header>
    <div class="logo">
      <img alt="DTA" src="https://i.postimg.cc/GhK1YD2W/DTA-Search.png">
    </div>
    <div class="bar">
    <i class="fa fa-search"></i> <input type="search" id="search-input" class="searchbar" required placeholder="find a research..." value="<?= isset($_GET['q']) ? $_GET['q'] : '' ?>">
    </div>
    <div class="buttons">
      <a href="http://localhost:8012/archive-tcu/?page=projects_per_department&id=3" class="button" type="button">College Of Arts And Sciences</a>
      <a href="http://localhost:8012/archive-tcu/?page=projects_per_department&id=5" class="button" type="button">College Of Information And Communications Technology</a>
      <a href="http://localhost:8012/archive-tcu/?page=projects_per_department&id=4" class="button" type="button">College Of Business Management And Accountancy</a>
      <a href="http://localhost:8012/archive-tcu/?page=projects_per_department&id=2" class="button" type="button">College Of Education</a>
      <a href="http://localhost:8012/archive-tcu/?page=projects_per_department&id=6" class="button" type="button">College Of Engineering</a>
      <a href="http://localhost:8012/archive-tcu/?page=projects_per_department&id=1" class="button" type="button">College Of Industrial Technology</a>
     </div>
  </body>