<?php

// if(!isset($_POST['ins_id']) && !empty($_POST['ins_id'])) {
//     header("location:instructor-table.php?error=nofile");
//     exit();
//   }else{
//     $insid = $_POST['ins_id'];
//   }




session_start();



$_SESSION['instructor'] = $_POST["ins_id"];

var_dump($_SESSION);

  if(isset($_SESSION['instructor']) && !empty($_SESSION['instructor'])) {
    $insid = $_SESSION['instructor'];
  }else{
    header("location:instructor-table.php?error=nofile");
  }
  
  


  
?>


<?php

include_once '../templates/header.php';
include_once "../includes/connect.php";
include_once '../includes/connection.php';



$statement=$conn->prepare("SELECT * FROM tbl_instructor WHERE ins_id = :insid");
$statement->bindParam(':insid', $insid);
$statement->execute();
$ins = $statement->fetch(PDO::FETCH_ASSOC);

$count=$conn->prepare("SELECT COUNT(*) AS Count FROM tbl_evaluation WHERE ins_id = :insid");
$count->bindParam(':insid', $insid);
$count->execute();
$counts = $count->fetch(PDO::FETCH_ASSOC);

$ttl=$conn->prepare("SELECT ROUND(AVG(a1+a2+a3+a4+a5+a6+a7+a8+a9+a10+a11+a12+a13+a14+a15+a16+b17+b18+b19+b20+b21+b22+b23+b24+b25+b26+b27+b28+b29+b30)/30.0, 2) AS Average FROM tbl_evaluation WHERE ins_id = :insid");
$ttl->bindParam(':insid', $insid);
$ttl->execute();
$total = $ttl->fetch(PDO::FETCH_ASSOC);

$part1=$conn->prepare("SELECT ROUND(AVG(a1+a2+a3+a4+a5+a6+a7+a8+a9+a10+a11+a12+a13+a14+a15+a16)/16.0, 2) AS Average FROM tbl_evaluation WHERE ins_id = :insid");
$part1->bindParam(':insid', $insid);
$part1->execute();
$p1 = $part1->fetch(PDO::FETCH_ASSOC);

$part2=$conn->prepare("SELECT ROUND(AVG(b17+b18+b19+b20+b21+b22+b23+b24+b25+b26+b27+b28+b29+b30)/14.0, 2) AS Average FROM tbl_evaluation WHERE ins_id = :insid");
$part2->bindParam(':insid', $insid);
$part2->execute();
$p2 = $part2->fetch(PDO::FETCH_ASSOC);

?>
                <!-- Begin Page Content -->
                <div class="container-fluid">

                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Evaluation Report</h1>

                    <form action="eval.solo.print.php" method="post" style="margin: 0;">
                    <input type="hidden" name="ins_id" value="<?php echo $insid ?>">
                    <button type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" name ="submit"><i class="fas fa-print fa-sm text-white-50"></i> Print </button>
                    </form>
                    
                </div>

                    <!-- Page Heading -->
                   
                        <section style="background-color: #eee;">
                        <div class="container py-5">
                            <!-- <div class="row">
                            <div class="col">
                                <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item"><a href="#">User</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">User Profile</li>
                                </ol>
                                </nav>
                            </div>
                            </div> -->

                            <div class="row">
                            <div class="col-lg-4">
                                <div class="card mb-4">
                                <div class="card-body text-center">
                                    <img src="../img/student.jpg" alt="avatar"
                                    class="rounded-circle img-fluid" style="width: 150px;">
                                    <h5 class="my-3"><?php echo $ins["ins_name"] ?></h5>
                                    <p class="text-muted mb-1">Instructor</p>
                                    <p class="text-muted mb-4">College Department</p>
                                    <div class="d-flex justify-content-center mb-2">
                                    <!-- <button type="button" class="btn btn-primary">Follow</button>
                                    <button type="button" class="btn btn-outline-primary ms-1">Message</button> -->
                                    </div>
                                </div>
                                </div>
                                <div class="card mb-4 mb-lg-0">
                                <div class="card-body p-0">
                                    <ul class="list-group list-group-flush rounded-3">
                                    
                                    <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                        <i class="fab fa-youtube fa-lg" style="color: red;"></i>
                                        <p class="mb-0">mdbootstrap</p>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                        <i class="fab fa-twitter fa-lg" style="color: #55acee;"></i>
                                        <p class="mb-0">@mdbootstrap</p>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                        <i class="fab fa-instagram fa-lg" style="color: #ac2bac;"></i>
                                        <p class="mb-0">mdbootstrap</p>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                        <i class="fab fa-facebook-f fa-lg" style="color: #3b5998;"></i>
                                        <p class="mb-0">mdbootstrap</p>
                                    </li>
                                    </ul>
                                </div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <hr>
                                        <div class="row">
                                        <div class="col-sm-5">
                                            <p class="mb-0">Full Name</p>
                                        </div>
                                        <div class="col-sm-7">
                                            <p class="text-muted mb-0"><?php echo $ins["ins_name"] ?></p>
                                        </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <p class="mb-0">Total Result:</p>
                                            </div>
                                            <div class="col-sm-7">
                                                <p class="text-muted mb-0"  style="font-size: 40px;"><?php echo $total["Average"]?><span class="text-primary font-italic me-1" style="font-size: 28px;"> / 5 </span></p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <p class="mb-0">Number of Responses</p>
                                            </div>
                                            <div class="col-sm-7">
                                                <p class="text-muted mb-0"><span class="text-primary font-italic me-1" style="font-size: 28px;"><?php echo $counts["Count"]?></span></p>
                                            </div>
                                        </div>
                                        <!-- <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Mobile</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0">(098) 765-4321</p>
                                            </div>
                                        </div>
                                        <hr> -->
                                        <!-- <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Address</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0">Bay Area, San Francisco, CA</p>
                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="card mb-4 mb-md-0">
                                            <div class="card-body">
                                                <p class="mb-4" style="height: 125px !important;"><span class="text-primary font-italic me-1">Part 1: </span> How well does the teacher/instructor teach the subject?
                                                </p>
                                                <hr/>
                                                <p class="mb-1" style="font-size: 2.77rem;"><?php echo $p1["Average"] ?></p>
                                                <div class="progress rounded" style="height: 10px;">
                                                <div class="progress-bar" role="progressbar" style="width: <?php echo $p1["Average"] * 100 / 5?>%" aria-valuenow="0"
                                                    aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <p class="mt-4 mb-1" style="font-size: 0.90rem;margin-top: 0.25rem!important;"><?php echo $p1["Average"] * 100 / 5?> / 100 (Percentage)</p>
                                           
                                              
                                               
                                                
                                            </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card mb-4 mb-md-0">
                                            <div class="card-body">
                                                <p class="mb-4" style="height: 125px !important;"><span class="text-primary font-italic me-1">Part 2: </span> How well does this teacher/instructor model the core values through how he/she behave with students and with other people?
                                                </p>
                                                <hr/>
                                                <p class="mb-1" style="font-size: 2.77rem;"><?php echo $p2["Average"] ?></p>
                                                <div class="progress rounded" style="height: 10px;">
                                                <div class="progress-bar" role="progressbar" style="width: <?php echo $p1["Average"] * 100 / 5?>%" aria-valuenow="80"
                                                    aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <p class="mt-4 mb-1" style="font-size: 0.90rem;margin-top: 0.25rem!important;"><?php echo $p2["Average"] * 100 / 5?> / 100 (Percentage)</p>
                                                
                                            </div>
                                            </div>
                                        </div>
                                    </div>


                                    <!---->

                                    <div class="card mb-4" style="margin-top: 1.5rem!important;margin-bottom: 0 !important;height: 300px;overflow: scroll;">
                                        <div class="card-body">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                    <th scope="col">Comments</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        //include our connection
                                                        
                                                        $database = new Connection();
                                                        $db = $database->open();
                                                        try{	
                                                            $sql = "SELECT * FROM tbl_evaluation WHERE ins_id = '$insid'";
                                                            foreach ($db->query($sql) as $row) {
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo $row["eval_comments"]?></td>
                                                                </tr>
                                                                <?php 
                                                            }
                                                        }
                                                        catch(PDOException $e){
                                                            echo "There is some problem in connection: " . $e->getMessage();
                                                        }

                                                        //close connection
                                                        $database->close();

                                                    ?>
                                   

                                                </tbody>
                                            </table>
                                        </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        </section>

                        <link rel="stylesheet" href="https://allyoucan.cloud/cdn/icofont/1.0.1/icofont.css" integrity="sha384-jbCTJB16Q17718YM9U22iJkhuGbS0Gd2LjaWb4YJEZToOPmnKDjySVa323U+W7Fv" crossorigin="anonymous">
<div class="container">
<div class="col-md-12">
    <div class="offer-dedicated-body-left">
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade" id="pills-order-online" role="tabpanel" aria-labelledby="pills-order-online-tab">
                <div id="#menu" class="bg-white rounded shadow-sm p-4 mb-4 explore-outlets">
                    <h5 class="mb-4">Recommended</h5>
                    <form class="explore-outlets-search mb-4">
                        <div class="input-group">
                            <input type="text" placeholder="Search for dishes..." class="form-control">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-link">
                                    <i class="icofont-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <h6 class="mb-3">Most Popular  <span class="badge badge-success"><i class="icofont-tags"></i> 15% Off All Items </span></h6>
                    <div class="owl-carousel owl-theme owl-carousel-five offers-interested-carousel mb-3 owl-loaded owl-drag owl-hidden">

                        <div class="owl-stage-outer">
                            <div class="owl-stage" style="transform: translate3d(-682px, 0px, 0px); transition: all 0s ease 0s; width: 2183px;">
                                <div class="owl-item cloned" style="width: 136.4px;">
                                    <div class="item">
                                        <div class="mall-category-item">
                                            <a href="#">
                                                <img class="img-fluid" src="img/list/2.png">
                                                <h6>Sandwiches</h6>
                                                <small>8 ITEMS</small>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="owl-item cloned" style="width: 136.4px;">
                                    <div class="item">
                                        <div class="mall-category-item">
                                            <a href="#">
                                                <img class="img-fluid" src="img/list/3.png">
                                                <h6>Soups</h6>
                                                <small>2 ITEMS</small>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="owl-item cloned" style="width: 136.4px;">
                                    <div class="item">
                                        <div class="mall-category-item">
                                            <a href="#">
                                                <img class="img-fluid" src="img/list/4.png">
                                                <h6>Pizzas</h6>
                                                <small>56 ITEMS</small>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="owl-item cloned" style="width: 136.4px;">
                                    <div class="item">
                                        <div class="mall-category-item">
                                            <a href="#">
                                                <img class="img-fluid" src="img/list/5.png">
                                                <h6>Pastas</h6>
                                                <small>10 ITEMS</small>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="owl-item cloned" style="width: 136.4px;">
                                    <div class="item">
                                        <div class="mall-category-item">
                                            <a href="#">
                                                <img class="img-fluid" src="img/list/6.png">
                                                <h6>Chinese</h6>
                                                <small>25 ITEMS</small>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="owl-item active" style="width: 136.4px;">
                                    <div class="item">
                                        <div class="mall-category-item">
                                            <a href="#">
                                                <img class="img-fluid" src="img/list/1.png">
                                                <h6>Burgers</h6>
                                                <small>5 ITEMS</small>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="owl-item active" style="width: 136.4px;">
                                    <div class="item">
                                        <div class="mall-category-item">
                                            <a href="#">
                                                <img class="img-fluid" src="img/list/2.png">
                                                <h6>Sandwiches</h6>
                                                <small>8 ITEMS</small>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="owl-item active" style="width: 136.4px;">
                                    <div class="item">
                                        <div class="mall-category-item">
                                            <a href="#">
                                                <img class="img-fluid" src="img/list/3.png">
                                                <h6>Soups</h6>
                                                <small>2 ITEMS</small>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="owl-item active" style="width: 136.4px;">
                                    <div class="item">
                                        <div class="mall-category-item">
                                            <a href="#">
                                                <img class="img-fluid" src="img/list/4.png">
                                                <h6>Pizzas</h6>
                                                <small>56 ITEMS</small>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="owl-item active" style="width: 136.4px;">
                                    <div class="item">
                                        <div class="mall-category-item">
                                            <a href="#">
                                                <img class="img-fluid" src="img/list/5.png">
                                                <h6>Pastas</h6>
                                                <small>10 ITEMS</small>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="owl-item" style="width: 136.4px;">
                                    <div class="item">
                                        <div class="mall-category-item">
                                            <a href="#">
                                                <img class="img-fluid" src="img/list/6.png">
                                                <h6>Chinese</h6>
                                                <small>25 ITEMS</small>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="owl-item cloned" style="width: 136.4px;">
                                    <div class="item">
                                        <div class="mall-category-item">
                                            <a href="#">
                                                <img class="img-fluid" src="img/list/1.png">
                                                <h6>Burgers</h6>
                                                <small>5 ITEMS</small>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="owl-item cloned" style="width: 136.4px;">
                                    <div class="item">
                                        <div class="mall-category-item">
                                            <a href="#">
                                                <img class="img-fluid" src="img/list/2.png">
                                                <h6>Sandwiches</h6>
                                                <small>8 ITEMS</small>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="owl-item cloned" style="width: 136.4px;">
                                    <div class="item">
                                        <div class="mall-category-item">
                                            <a href="#">
                                                <img class="img-fluid" src="img/list/3.png">
                                                <h6>Soups</h6>
                                                <small>2 ITEMS</small>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="owl-item cloned" style="width: 136.4px;">
                                    <div class="item">
                                        <div class="mall-category-item">
                                            <a href="#">
                                                <img class="img-fluid" src="img/list/4.png">
                                                <h6>Pizzas</h6>
                                                <small>56 ITEMS</small>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="owl-item cloned" style="width: 136.4px;">
                                    <div class="item">
                                        <div class="mall-category-item">
                                            <a href="#">
                                                <img class="img-fluid" src="img/list/5.png">
                                                <h6>Pastas</h6>
                                                <small>10 ITEMS</small>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="owl-nav">
                            <button type="button" role="presentation" class="owl-prev"><i class="icofont-thin-left"></i></button>
                            <button type="button" role="presentation" class="owl-next"><i class="icofont-thin-right"></i></button>
                        </div>
                        <div class="owl-dots disabled"></div>
                    </div>
                </div>
                <div class="row">
                    <h5 class="mb-4 mt-3 col-md-12">Best Sellers</h5>
                    <div class="col-md-4 col-sm-6 mb-4">
                        <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                            <div class="list-card-image">
                                <div class="star position-absolute"><span class="badge badge-success"><i class="icofont-star"></i> 3.1 (300+)</span></div>
                                <div class="favourite-heart text-danger position-absolute"><a href="#"><i class="icofont-heart"></i></a></div>
                                <div class="member-plan position-absolute"><span class="badge badge-dark">Promoted</span></div>
                                <a href="#">
                                    <img src="img/list/7.png" class="img-fluid item-img">
                                </a>
                            </div>
                            <div class="p-3 position-relative">
                                <div class="list-card-body">
                                    <h6 class="mb-1"><a href="#" class="text-black">Bite Me Sandwiches</a></h6>
                                    <p class="text-gray mb-2">North Indian • Indian</p>
                                    <p class="text-gray time mb-0"><a class="btn btn-link btn-sm pl-0 text-black pr-0" href="#">$550 </a> <span class="badge badge-success">NEW</span> <span class="float-right"> 
                                             <a class="btn btn-outline-secondary btn-sm" href="#">ADD</a>
                                             </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 mb-4">
                        <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                            <div class="list-card-image">
                                <div class="star position-absolute"><span class="badge badge-success"><i class="icofont-star"></i> 3.1 (300+)</span></div>
                                <div class="favourite-heart text-danger position-absolute"><a href="#"><i class="icofont-heart"></i></a></div>
                                <div class="member-plan position-absolute"><span class="badge badge-dark">Promoted</span></div>
                                <a href="#">
                                    <img src="img/list/8.png" class="img-fluid item-img">
                                </a>
                            </div>
                            <div class="p-3 position-relative">
                                <div class="list-card-body">
                                    <h6 class="mb-1"><a href="#" class="text-black">Famous Dave's Bar-B
                                             </a>
                                          </h6>
                                    <p class="text-gray mb-2">Hamburgers • Indian</p>
                                    <p class="text-gray time mb-0"><a class="btn btn-link btn-sm pl-0 text-black pr-0" href="#">$250 </a> <span class="badge badge-primary">NEW</span> <span class="float-right"> 
                                             <span class="count-number">
                                             <button class="btn btn-outline-secondary  btn-sm left dec"> <i class="icofont-minus"></i> </button>
                                             <input class="count-number-input" type="text" value="1" readonly="">
                                             <button class="btn btn-outline-secondary btn-sm right inc"> <i class="icofont-plus"></i> </button>
                                             </span>
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 mb-4">
                        <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                            <div class="list-card-image">
                                <div class="star position-absolute"><span class="badge badge-success"><i class="icofont-star"></i> 3.1 (300+)</span></div>
                                <div class="favourite-heart text-danger position-absolute"><a href="#"><i class="icofont-heart"></i></a></div>
                                <div class="member-plan position-absolute"><span class="badge badge-dark">Promoted</span></div>
                                <a href="#">
                                    <img src="img/list/9.png" class="img-fluid item-img">
                                </a>
                            </div>
                            <div class="p-3 position-relative">
                                <div class="list-card-body">
                                    <h6 class="mb-1"><a href="#" class="text-black">Bite Me Sandwiches</a></h6>
                                    <p class="text-gray mb-2">North Indian • Indian</p>
                                    <p class="text-gray time mb-0"><a class="btn btn-link btn-sm pl-0 text-black pr-0" href="#">$250 </a> <span class="badge badge-info">NEW</span> <span class="float-right"> 
                                             <a class="btn btn-outline-secondary btn-sm" href="#">ADD</a>
                                             </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <h5 class="mb-4 mt-3 col-md-12">Quick Bites <small class="h6 text-black-50">3 ITEMS</small></h5>
                    <div class="col-md-12">
                        <div class="bg-white rounded border shadow-sm mb-4">
                            <div class="gold-members p-3 border-bottom">
                                <a class="btn btn-outline-secondary btn-sm  float-right" href="#">ADD</a>
                                <div class="media">
                                    <div class="mr-3"><i class="icofont-ui-press text-danger food-item"></i></div>
                                    <div class="media-body">
                                        <h6 class="mb-1">Chicken Tikka Sub</h6>
                                        <p class="text-gray mb-0">$314 - 12" (30 cm)</p>
                                    </div>
                                </div>
                            </div>
                            <div class="gold-members p-3 border-bottom">
                                <span class="count-number float-right">
                                       <button class="btn btn-outline-secondary  btn-sm left dec"> <i class="icofont-minus"></i> </button>
                                       <input class="count-number-input" type="text" value="1" readonly="">
                                       <button class="btn btn-outline-secondary btn-sm right inc"> <i class="icofont-plus"></i> </button>
                                       </span>
                                <div class="media">
                                    <div class="mr-3"><i class="icofont-ui-press text-danger food-item"></i></div>
                                    <div class="media-body">
                                        <h6 class="mb-1">Cheese corn Roll <span class="badge badge-danger">BESTSELLER</span></h6>
                                        <p class="text-gray mb-0">$600</p>
                                    </div>
                                </div>
                            </div>
                            <div class="gold-members p-3">
                                <span class="count-number float-right">
                                       <button class="btn btn-outline-secondary  btn-sm left dec"> <i class="icofont-minus"></i> </button>
                                       <input class="count-number-input" type="text" value="1" readonly="">
                                       <button class="btn btn-outline-secondary btn-sm right inc"> <i class="icofont-plus"></i> </button>
                                       </span>
                                <div class="media">
                                    <div class="mr-3"><i class="icofont-ui-press text-success food-item"></i></div>
                                    <div class="media-body">
                                        <h6 class="mb-1">Cheese Spinach corn Roll <span class="badge badge-success">Pure Veg</span></h6>
                                        <p class="text-gray mb-0">$600</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <h5 class="mb-4 mt-3 col-md-12">Starters <small class="h6 text-black-50">3 ITEMS</small></h5>
                    <div class="col-md-12">
                        <div class="bg-white rounded border shadow-sm mb-4">
                            <div class="menu-list p-3 border-bottom">
                                <span class="count-number float-right">
                                       <button class="btn btn-outline-secondary  btn-sm left dec"> <i class="icofont-minus"></i> </button>
                                       <input class="count-number-input" type="text" value="1" readonly="">
                                       <button class="btn btn-outline-secondary btn-sm right inc"> <i class="icofont-plus"></i> </button>
                                       </span>
                                <div class="media">
                                    <img class="mr-3 rounded-pill" src="img/5.jpg" alt="Generic placeholder image">
                                    <div class="media-body">
                                        <h6 class="mb-1">Veg Spring Roll</h6>
                                        <p class="text-gray mb-0">$314 - 12" (30 cm)</p>
                                    </div>
                                </div>
                            </div>
                            <div class="menu-list p-3 border-bottom">
                                <span class="count-number float-right">
                                       <button class="btn btn-outline-secondary  btn-sm left dec"> <i class="icofont-minus"></i> </button>
                                       <input class="count-number-input" type="text" value="1" readonly="">
                                       <button class="btn btn-outline-secondary btn-sm right inc"> <i class="icofont-plus"></i> </button>
                                       </span>
                                <div class="media">
                                    <img class="mr-3 rounded-pill" src="img/2.jpg" alt="Generic placeholder image">
                                    <div class="media-body">
                                        <h6 class="mb-1">Stuffed Mushroom <span class="badge badge-danger">BESTSELLER</span></h6>
                                        <p class="text-gray mb-0">$600</p>
                                    </div>
                                </div>
                            </div>
                            <div class="menu-list p-3">
                                <span class="count-number float-right">
                                       <button class="btn btn-outline-secondary  btn-sm left dec"> <i class="icofont-minus"></i> </button>
                                       <input class="count-number-input" type="text" value="1" readonly="">
                                       <button class="btn btn-outline-secondary btn-sm right inc"> <i class="icofont-plus"></i> </button>
                                       </span>
                                <div class="media">
                                    <img class="mr-3 rounded-pill" src="img/3.jpg" alt="Generic placeholder image">
                                    <div class="media-body">
                                        <h6 class="mb-1">Honey Chilli Potato
                                                <span class="badge badge-success">Pure Veg</span>
                                             </h6>
                                        <p class="text-gray mb-0">$600</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <h5 class="mb-4 mt-3 col-md-12">Soups <small class="h6 text-black-50">8 ITEMS</small></h5>
                    <div class="col-md-12">
                        <div class="bg-white rounded border shadow-sm">
                            <div class="gold-members p-3 border-bottom">
                                <a class="btn btn-outline-secondary btn-sm  float-right" href="#">ADD</a>
                                <div class="media">
                                    <div class="mr-3"><i class="icofont-ui-press text-danger food-item"></i></div>
                                    <div class="media-body">
                                        <h6 class="mb-1">Tomato Dhania Shorba</h6>
                                        <p class="text-gray mb-0">$314 - 12" (30 cm)</p>
                                    </div>
                                </div>
                            </div>
                            <div class="gold-members p-3 border-bottom">
                                <a class="btn btn-outline-secondary btn-sm  float-right" href="#">ADD</a>
                                <div class="media">
                                    <div class="mr-3"><i class="icofont-ui-press text-danger food-item"></i></div>
                                    <div class="media-body">
                                        <h6 class="mb-1">Veg Manchow Soup</h6>
                                        <p class="text-gray mb-0">$600</p>
                                    </div>
                                </div>
                            </div>
                            <div class="gold-members p-3 border-bottom">
                                <span class="count-number float-right">
                                       <button class="btn btn-outline-secondary  btn-sm left dec"> <i class="icofont-minus"></i> </button>
                                       <input class="count-number-input" type="text" value="1" readonly="">
                                       <button class="btn btn-outline-secondary btn-sm right inc"> <i class="icofont-plus"></i> </button>
                                       </span>
                                <div class="media">
                                    <div class="mr-3"><i class="icofont-ui-press text-success food-item"></i></div>
                                    <div class="media-body">
                                        <h6 class="mb-1">Lemon Coriander Soup</h6>
                                        <p class="text-gray mb-0">$600</p>
                                    </div>
                                </div>
                            </div>
                            <div class="gold-members p-3 border-bottom">
                                <a class="btn btn-outline-secondary btn-sm  float-right" href="#">ADD</a>
                                <div class="media">
                                    <div class="mr-3"><i class="icofont-ui-press text-danger food-item"></i></div>
                                    <div class="media-body">
                                        <h6 class="mb-1">Tomato Dhania Shorba</h6>
                                        <p class="text-gray mb-0">$314 - 12" (30 cm)</p>
                                    </div>
                                </div>
                            </div>
                            <div class="gold-members p-3 border-bottom">
                                <a class="btn btn-outline-secondary btn-sm  float-right" href="#">ADD</a>
                                <div class="media">
                                    <div class="mr-3"><i class="icofont-ui-press text-danger food-item"></i></div>
                                    <div class="media-body">
                                        <h6 class="mb-1">Veg Manchow Soup</h6>
                                        <p class="text-gray mb-0">$600</p>
                                    </div>
                                </div>
                            </div>
                            <div class="gold-members p-3">
                                <a class="btn btn-outline-secondary btn-sm  float-right" href="#">ADD</a>
                                <div class="media">
                                    <div class="mr-3"><i class="icofont-ui-press text-success food-item"></i></div>
                                    <div class="media-body">
                                        <h6 class="mb-1">Lemon Coriander Soup</h6>
                                        <p class="text-gray mb-0">$600</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-gallery" role="tabpanel" aria-labelledby="pills-gallery-tab">
                <div id="gallery" class="bg-white rounded shadow-sm p-4 mb-4">
                    <div class="restaurant-slider-main position-relative homepage-great-deals-carousel">
                        <div class="owl-carousel owl-theme homepage-ad owl-loaded owl-drag owl-hidden">

                            <div class="owl-stage-outer">
                                <div class="owl-stage" style="transform: translate3d(-1364px, 0px, 0px); transition: all 0s ease 0s; width: 8184px;">
                                    <div class="owl-item cloned" style="width: 682px;">
                                        <div class="item">
                                            <img class="img-fluid" src="img/gallery/1.png">
                                        </div>
                                    </div>
                                    <div class="owl-item cloned" style="width: 682px;">
                                        <div class="item">
                                            <img class="img-fluid" src="img/gallery/2.png">
                                        </div>
                                    </div>
                                    <div class="owl-item cloned" style="width: 682px;">
                                        <div class="item">
                                            <img class="img-fluid" src="img/gallery/3.png">
                                        </div>
                                    </div>
                                    <div class="owl-item active" style="width: 682px;">
                                        <div class="item">
                                            <img class="img-fluid" src="img/gallery/1.png">
                                        </div>
                                    </div>
                                    <div class="owl-item" style="width: 682px;">
                                        <div class="item">
                                            <img class="img-fluid" src="img/gallery/2.png">
                                        </div>
                                    </div>
                                    <div class="owl-item" style="width: 682px;">
                                        <div class="item">
                                            <img class="img-fluid" src="img/gallery/3.png">
                                        </div>
                                    </div>
                                    <div class="owl-item" style="width: 682px;">
                                        <div class="item">
                                            <img class="img-fluid" src="img/gallery/1.png">
                                        </div>
                                    </div>
                                    <div class="owl-item" style="width: 682px;">
                                        <div class="item">
                                            <img class="img-fluid" src="img/gallery/2.png">
                                        </div>
                                    </div>
                                    <div class="owl-item" style="width: 682px;">
                                        <div class="item">
                                            <img class="img-fluid" src="img/gallery/3.png">
                                        </div>
                                    </div>
                                    <div class="owl-item cloned" style="width: 682px;">
                                        <div class="item">
                                            <img class="img-fluid" src="img/gallery/1.png">
                                        </div>
                                    </div>
                                    <div class="owl-item cloned" style="width: 682px;">
                                        <div class="item">
                                            <img class="img-fluid" src="img/gallery/2.png">
                                        </div>
                                    </div>
                                    <div class="owl-item cloned" style="width: 682px;">
                                        <div class="item">
                                            <img class="img-fluid" src="img/gallery/3.png">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="owl-nav">
                                <button type="button" role="presentation" class="owl-prev"><i class="fa fa-chevron-left"></i></button>
                                <button type="button" role="presentation" class="owl-next"><i class="fa fa-chevron-right"></i></button>
                            </div>
                            <div class="owl-dots disabled"></div>
                        </div>
                        <div class="position-absolute restaurant-slider-pics bg-dark text-white">2 of 14 Photos</div>
                        <div class="position-absolute restaurant-slider-view-all">
                            <button type="button" class="btn btn-light bg-white">See all Photos</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-restaurant-info" role="tabpanel" aria-labelledby="pills-restaurant-info-tab">
                <div id="restaurant-info" class="bg-white rounded shadow-sm p-4 mb-4">
                    <div class="address-map float-right ml-5">
                        <div class="mapouter">
                            <div class="gmap_canvas">
                                <iframe width="300" height="170" id="gmap_canvas" src="https://maps.google.com/maps?q=university%20of%20san%20francisco&amp;t=&amp;z=9&amp;ie=UTF8&amp;iwloc=&amp;output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                            </div>
                        </div>
                    </div>
                    <h5 class="mb-4">Restaurant Info</h5>
                    <p class="mb-3">Jagjit Nagar, Near Railway Crossing,
                        <br> Near Model Town, Ludhiana, PUNJAB
                    </p>
                    <p class="mb-2 text-black"><i class="icofont-phone-circle text-primary mr-2"></i> +91 01234-56789, +91 01234-56789</p>
                    <p class="mb-2 text-black"><i class="icofont-email text-primary mr-2"></i> iamosahan@gmail.com, osahaneat@gmail.com</p>
                    <p class="mb-2 text-black"><i class="icofont-clock-time text-primary mr-2"></i> Today 11am – 5pm, 6pm – 11pm
                        <span class="badge badge-success"> OPEN NOW </span>
                    </p>
                    <hr class="clearfix">
                    <p class="text-black mb-0">You can also check the 3D view by using our menue map clicking here &nbsp;&nbsp;&nbsp; <a class="text-info font-weight-bold" href="#">Venue Map</a></p>
                    <hr class="clearfix">
                    <h5 class="mt-4 mb-4">More Info</h5>
                    <p class="mb-3">Dal Makhani, Panneer Butter Masala, Kadhai Paneer, Raita, Veg Thali, Laccha Paratha, Butter Naan</p>
                    <div class="border-btn-main mb-4">
                        <a class="border-btn text-success mr-2" href="#"><i class="icofont-check-circled"></i> Breakfast</a>
                        <a class="border-btn text-danger mr-2" href="#"><i class="icofont-close-circled"></i> No Alcohol Available</a>
                        <a class="border-btn text-success mr-2" href="#"><i class="icofont-check-circled"></i> Vegetarian Only</a>
                        <a class="border-btn text-success mr-2" href="#"><i class="icofont-check-circled"></i> Indoor Seating</a>
                        <a class="border-btn text-success mr-2" href="#"><i class="icofont-check-circled"></i> Breakfast</a>
                        <a class="border-btn text-danger mr-2" href="#"><i class="icofont-close-circled"></i> No Alcohol Available</a>
                        <a class="border-btn text-success mr-2" href="#"><i class="icofont-check-circled"></i> Vegetarian Only</a>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-book" role="tabpanel" aria-labelledby="pills-book-tab">
                <div id="book-a-table" class="bg-white rounded shadow-sm p-4 mb-5 rating-review-select-page">
                    <h5 class="mb-4">Book A Table</h5>
                    <form>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Full Name</label>
                                    <input class="form-control" type="text" placeholder="Enter Full Name">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input class="form-control" type="text" placeholder="Enter Email address">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Mobile number</label>
                                    <input class="form-control" type="text" placeholder="Enter Mobile number">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Date And Time</label>
                                    <input class="form-control" type="text" placeholder="Enter Date And Time">
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-right">
                            <button class="btn btn-primary" type="button"> Submit </button>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
</div>
</div>

                    

                </div>
                <!-- /.container-fluid -->

<?php
include_once '../templates/footer.php';
?>