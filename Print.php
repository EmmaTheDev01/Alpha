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

    </head>

    <body>



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
                <section class="printable">
                    <div class="all-detailss">
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
                        $sql = "SELECT tblvehicles.Vimage1 as Vimage1,tblvehicles.VehiclesTitle,tblvehicles.PricePerDay,tblvehicles.id as vid,tblbrands.BrandName,tblbooking.id,tblbooking.FromDate,tblbooking.ToDate,tblbooking.message,tblbooking.Status,tblbooking.PostingDate  from tblbooking join tblvehicles on tblbooking.VehicleId=tblvehicles.id join tblbrands on tblbrands.id=tblvehicles.VehiclesBrand where tblbooking.userEmail=:useremail";
                        $query = $dbh->prepare($sql);
                        $query->bindParam(':useremail', $useremail, PDO::PARAM_STR);
                        $query->execute();
                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                        $cnt = 1;
                        if ($query->rowCount() > 0) {
                            foreach ($results as $result) { ?>



                                <?php if ($result->Status == 1) { ?>
                                    <p>******************************************************</p>
                                    <p class="ticket-heading">Order details</P>
                                    <p>******************************************************</p>
                                    <div class="vehicle_title">
                                        <p>
                                            Order Id: 000<?php echo htmlentities($result->id); ?>
                                            Booked Car:
                                            <b>
                                                <?php echo htmlentities($result->VehiclesTitle); ?>
                                            </b><br>
                                            Booking date:
                                            <b>
                                                <?php echo htmlentities($result->PostingDate); ?>
                                            </b><br>
                                            Journey: <b>
                                                <?php echo htmlentities($result->BrandName); ?>
                                            </b><br>
                                            Price: <b>
                                                <?php echo htmlentities($result->PricePerDay); ?>RWF
                                            </b><br>
                                            From:</i>
                                            <?php echo htmlentities($result->FromDate); ?> <br />
                                            To Date:
                                            <?php echo htmlentities($result->ToDate); ?><br>
                                            Ticket Status: <u class="text-success">Confirmed</u>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                <?php } else {
                                    ?>
                    <p class="text-danger ticket-heading ">******************************************************</p>
                    <p class="text-danger ticket-heading">Another order not approved</P>
                    <p class="text-danger ticket-heading">******************************************************</p>

                <?php } ?>

            <?php }
                        } ?>

        </section>
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