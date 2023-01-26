<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['login']) == 0) {
  header('location:index.php');
} else {
  ?>
  <!DOCTYPE HTML>
  <html lang="en">

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <title>Booking and ticket details Online ticket booking system. </title>
    <!--Bootstrap -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
    <!--Custome Style -->
    <link rel="stylesheet" href="assets/css/style.css" type="text/css">
    <!--OWL Carousel slider-->
    <link rel="stylesheet" href="assets/css/owl.carousel.css" type="text/css">
    <link rel="stylesheet" href="assets/css/owl.transitions.css" type="text/css">
    <!--slick-slider -->
    <link href="assets/css/slick.css" rel="stylesheet">
    <!--bootstrap-slider -->
    <link href="assets/css/bootstrap-slider.min.css" rel="stylesheet">
    <!--FontAwesome Font Style -->
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">

    <!-- SWITCHER -->
    <link rel="stylesheet" id="switcher-css" type="text/css" href="assets/switcher/css/switcher.css" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/red.css" title="red" media="all"
      data-default-color="true" />
    <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/orange.css" title="orange" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/blue.css" title="blue" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/pink.css" title="pink" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/green.css" title="green" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/purple.css" title="purple" media="all" />

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144"
      href="assets/images/favicon-icon/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114"
      href="assets/images/favicon-icon/apple-touch-icon-114-precomposed.html">
    <link rel="apple-touch-icon-precomposed" sizes="72x72"
      href="assets/images/favicon-icon/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="assets/images/favicon-icon/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="assets/images/favicon-icon/favicon.png">
    <!-- Google-Font-->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
                    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
                    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
            <![endif]-->
  </head>

  <body>

    <!-- Start Switcher -->
    <?php include('includes/colorswitcher.php'); ?>
    <!-- /Switcher -->

    <!--Header-->
    <?php include('includes/header.php'); ?>
    <!--Page Header-->
    <!-- /Header -->

    <!--Page Header-->
    <section class="page-header profile_page">
      <div class="container">
        <div class="page-header_wrap">
          <div class="page-heading">
            <h1>My Booking</h1>
          </div>
          <ul class="coustom-breadcrumb">
            <li><a href="#">Home</a></li>
            <li>My Booking</li>
          </ul>
        </div>
      </div>
      <!-- Dark Overlay-->
      <div class="dark-overlay"></div>
    </section>
    <!-- /Page Header-->

    <div class="row">
      <div class="col-md-3 col-sm-3">
        <?php include('includes/sidebar.php'); ?>

        <div class="col-md-6 col-sm-8">
          <div class="profile_wrap">
            <h5 class="uppercase underline">My Bookings </h5>
            <div class="my_vehicles_list">
              <ul class="vehicle_listing">
                <?php
                $useremail = $_SESSION['login'];
                $sql = "SELECT tblvehicles.Vimage1 as Vimage1,tblvehicles.VehiclesTitle,tblvehicles.id as vid,tblbrands.BrandName,tblbooking.FromDate,tblbooking.ToDate,tblbooking.message,tblbooking.Status  from tblbooking join tblvehicles on tblbooking.VehicleId=tblvehicles.id join tblbrands on tblbrands.id=tblvehicles.VehiclesBrand where tblbooking.userEmail=:useremail";
                $query = $dbh->prepare($sql);
                $query->bindParam(':useremail', $useremail, PDO::PARAM_STR);
                $query->execute();
                $results = $query->fetchAll(PDO::FETCH_OBJ);
                $cnt = 1;
                if ($query->rowCount() > 0) {
                  foreach ($results as $result) { ?>

                    <li>
                      <div class="vehicle_img"> <a
                          href="vehical-details.php?vhid=<?php echo htmlentities($result->vid); ?>""><img src="
                          admin/img/vehicleimages/<?php echo htmlentities($result->Vimage1); ?>" alt="image"></a> </div>
                      <div class="vehicle_title">
                        <h6><a href="vehical-details.php?vhid=<?php echo htmlentities($result->vid); ?>""> <?php echo htmlentities($result->BrandName); ?> , <?php echo htmlentities($result->VehiclesTitle); ?></a></h6>
                                                      <p><b>From:</b> <?php echo htmlentities($result->FromDate); ?><br /> <b>To Date:</b> <?php echo htmlentities($result->ToDate); ?></p>
                                                    </div>
                                                    <?php if ($result->Status == 1) { ?>
                                                                <div class=" vehicle_status"> <a href="#"
                                class="btn active-btn">Confirmed</a>
                              <div class="clearfix"></div>
                        </div>

                      <?php } else if ($result->Status == 2) { ?>
                          <div class="vehicle_status"> <a href="#" class="btn btn-danger  btn-xs">Cancelled</a>
                            <div class="clearfix"></div>
                          </div>



                      <?php } else { ?>
                          <div class="vehicle_status"> <a href="#" class="btn btn-danger btn-xs">Pending</a>
                            <div class="clearfix"></div>
                          </div>
                      <?php } ?>
                      <div style="float: left">
                        <p><b>Message:</b>
                          <?php echo htmlentities($result->message); ?>
                        </p>
                      </div>
                    </li>
                  <?php }
                } ?>


              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    </section>


    <section class="ticket-print">
      <div class="container">

        <h3>Ticket details for approved ticket</h3>
        <section class="page-header profile_page">
          <div class="container">


        </section>


        <?php
        $useremail = $_SESSION['login'];
        $sql = "SELECT * from tblusers where EmailId=:useremail";
        $query = $dbh->prepare($sql);
        $query->bindParam(':useremail', $useremail, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);
        $cnt = 1;
        if ($query->rowCount() > 0) {
          foreach ($results as $result) { ?>
            <section class="ticket-dets">
              <div class="container">
                <div class="user_profile_info">
                  <div class="company-logo"> <img src="assets/images/logo.png" alt="image" height="80px">
                  </div>
                  <div class="company">
                    <h5>Alpha Express Rwanda</h5>
                    <p class="contact-info-ticket">alphaexpress@alpha.rw</p>
                    <p class="contact-info-ticket">+25078888888</p>
                    <p class="contact-info-ticket">Kigali - Rwanda</p>
                    <p class="contact-info-ticket">Nyabugogo bus station</p>
                  </div>

                  <p>******************************************************</p>
                  <p class="ticket-heading">Customer details</P>
                  <p>******************************************************</p>

                  <div class="user-info">
                    <p>
                      Name:<b>
                        <?php echo htmlentities($result->FullName); ?>
                      </b><br>
                      Email:
                      <?php echo htmlentities($result->EmailId); ?><br>
                      Phone:
                      <?php echo htmlentities($result->ContactNo); ?><br>
                      Address:
                      <?php echo htmlentities($result->Address); ?><br>
                      City:
                      <?php echo htmlentities($result->City); ?><br>
                      Country:
                      <?php echo htmlentities($result->Country);
          }
        } ?>
                </p>
                <?php
                $useremail = $_SESSION['login'];
                $sql = "SELECT tblvehicles.Vimage1 as Vimage1,tblvehicles.VehiclesTitle,tblvehicles.PricePerDay, tblvehicles.id as vid,tblbrands.BrandName,tblbooking.id,tblbooking.FromDate,tblbooking.ToDate,tblbooking.message,tblbooking.Status,tblbooking.PostingDate  from tblbooking join tblvehicles on tblbooking.VehicleId=tblvehicles.id join tblbrands on tblbrands.id=tblvehicles.VehiclesBrand where tblbooking.userEmail=:useremail";
                $query = $dbh->prepare($sql);
                $query->bindParam(':useremail', $useremail, PDO::PARAM_STR);
                $query->execute();
                $results = $query->fetchAll(PDO::FETCH_OBJ);
                $cnt = 1;
                if ($query->rowCount() > 0) {
                  foreach ($results as $result) { ?>



                    <?php if ($result->Status == 1) { ?>
                      <p>******************************************************</p>
                      <p class="ticket-heading">Tickect details</P>
                      <p>******************************************************</p>
                      <div class="vehicle_title">
                        <p>
                          Order Id: 000<?php echo htmlentities($result->id); ?><br>
                          Booked Car:
                          <?php echo htmlentities($result->VehiclesTitle); ?><br>
                          Journey: <b>
                            <?php echo htmlentities($result->BrandName); ?>
                          </b><br>
                          Price: <b><?php echo htmlentities($result->PricePerDay); ?>RWF</b><br>
                          Booking date:
                          <?php echo htmlentities($result->PostingDate); ?><br>
                          In use at:</i>
                          <?php echo htmlentities($result->FromDate); ?> <br />
                          To Date:
                          <?php echo htmlentities($result->ToDate); ?><br>
                          Ticket Status: <u>Confirmed</u>
                        </p>
                        <a href="print.php" target="_blank"><button id="print" class="btn">Print</button></a>
                      </div>

                      </div>
            </div>

          </div>
        </section>

                    <?php } elseif ($result->Status == 0) {
                      ?>
                      <p class="text-danger ticket-heading">******************************************************</p>
                      <p class="text-danger ticket-heading">Another ticket not approved yet</P>
                      <p class="text-danger ticket-heading">******************************************************</p>
                    <?php } else {
                      ?>

                    

                    <?php } ?>

                  <?php }
                } ?>
              
    </section>
    <!--/my-vehicles-->
    <?php include('includes/footer.php'); ?>

    <!-- Scripts -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/interface.js"></script>
    <!--Switcher-->
    <script src="assets/switcher/js/switcher.js"></script>
    <!--bootstrap-slider-JS-->
    <script src="assets/js/bootstrap-slider.min.js"></script>
    <!--Slider-JS-->
    <script src="assets/js/slick.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
  </body>

  </html>
<?php } ?>