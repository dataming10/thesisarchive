<style>
    .car-cover{
        width:10em;
    }
    .car-item .col-auto{
        max-width: calc(100% - 12em) !important;
    }
    .car-item:hover{
        transform:translate(0, -4px);
        background:#a5a5a521;
    }
    .banner-img-holder{
        height:25vh !important;
        width: calc(100%);
        overflow: hidden;
    }
    .banner-img{
        object-fit:scale-down;
        height: calc(100%);
        width: calc(100%);
        transition:transform .3s ease-in;
    }
    .car-item:hover .banner-img{
        transform:scale(1.3)
    }
    .welcome-content img{
        margin:.5em;
    }

    .card-red{
    border: 1px solid #a30909 !important;
}

      #page-preloader {
  position: fixed;
  left: 0;
  top: 0;
  right: 0;
  bottom: 0;
  background: #ffffff;
  z-index: 100500;
}

#page-preloader .spinner {
  margin-right: auto;
  margin-left: auto;
  display: block;
  margin-top: 20%;
  width: 10%;
  z-index: 10000;
  overflow-y: hidden; 
  animation: 3s infinite alternate shadow;
}

@keyframes floating {
	0% {
		transform: translatey(0px);
	}
	50% {
		transform: translatey(-10px);
	}
	100% {
		transform: translatey(0px);
	}
}
@keyframes shadow {
	0% {
    width:230px;
	}
	50% {
    width:200px;
	}
	100% {
    width:230px;
	}
}

</style>
<div class="col-lg-12 py-5">
    <div class="contain-fluid">
        <div class="card card-outline card-navy card-red shadow rounded-0">
            <div class="card-body rounded-0">
                <div class="container-fluid">
                    <h3 class="text-center">Search for interesting research topic</h3>
                    <hr>
                    <div class="welcome-content">
                        <?php include("search-thesis.php") ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

  <div id="page-preloader">
                    <img src="uploads/logo-archive.png" class="spinner">
                </div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 <script src="app.js"></script> 