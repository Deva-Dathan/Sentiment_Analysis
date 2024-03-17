<?php
session_start();

// Check if the session variable is set, if not, initialize it
if (!isset($_SESSION['analysis_count'])) {
    $_SESSION['analysis_count'] = 0;
}

$max_attempts = 3;

// Calculate the remaining attempts
$remaining_attempts = $max_attempts - $_SESSION['analysis_count'];

// Check if the user has reached the analysis limit
if ($_SESSION['analysis_count'] >= $max_attempts) {
    // Display a modal with pricing information
    echo "<script>
            $(document).ready(function(){
                $('#pricingModal').modal('show');
            });
          </script>";
    // Stop script execution after showing the modal
    exit;
}

// Increment the analysis count for each analysis conducted
$_SESSION['analysis_count']++;

?>

<!-- HTML code for the pricing modal -->
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <!-- Your existing head section -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <!-- Your existing HTML content -->
</div>

<!-- Pricing modal -->
<div class="modal fade" id="pricingModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Choose a Plan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Pricing section HTML -->
                <!-- ======= Pricing Section ======= -->
                <section id="pricing" class="pricing">
                    <div class="container" data-aos="fade-up">
                        <!-- Pricing content goes here -->
                        <!-- This is the provided pricing section HTML -->
                    </div>
                </section><!-- End Pricing Section -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- jQuery -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>



<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>Text Analysis -- Sentiment Analysis</title>
    <link rel="stylesheet" href="style.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="icon" type="image/x-icon" href="../images/sentiment-analysis.png">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.22.1/dist/bootstrap-table.min.css">
    <style>
                /* Googlefont Poppins CDN Link */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
}
.sidebar{
  position: fixed;
  height: 100%;
  width: 240px;
  background: #f5f5f5;
  transition: all 0.5s ease;
}
.sidebar.active{
  width: 60px;
}
.sidebar .logo-details{
  height: 80px;
  display: flex;
  align-items: center;
}
.sidebar .logo-details i{
  font-size: 28px;
  font-weight: 500;
  color: #000;
  min-width: 60px;
  text-align: center
}
.sidebar .logo-details .logo_name{
  color: #000;
  font-size: 16px;
  font-weight: 500;
  font-weight: bold;
}
.sidebar .nav-links{
  margin-top: 10px;
}
.sidebar .nav-links li{
  position: relative;
  list-style: none;
  height: 50px;
}
.sidebar .nav-links li a{
  height: 100%;
  width: 100%;
  display: flex;
  align-items: center;
  text-decoration: none;
  transition: all 0.4s ease;
}
.sidebar .nav-links li a.active{
  background: #081D45;
  border-radius: 0px 25px 25px 0px;
}
.sidebar .nav-links li a:hover{
  background: #081D45;
  border-radius: 0px 25px 25px 0px;
  color:white;
}
.sidebar .nav-links li i{
  min-width: 60px;
  text-align: center;
  font-size: 18px;
  color: #000;
  font-weight: bold;
}
.sidebar .nav-links li a .links_name{
  color: #000;
  font-weight: bold;
  font-size: 15px;
  font-weight: 400;
  white-space: nowrap;
}
.sidebar .nav-links .log_out{
  position: absolute;
  bottom: 0;
  width: 100%;
}
.home-section{
  position: relative;
  background: #f5f5f5;
  min-height: 100vh;
  width: calc(100% - 240px);
  left: 240px;
  transition: all 0.5s ease;
}
.sidebar.active ~ .home-section{
  width: calc(100% - 60px);
  left: 60px;
}
.home-section nav{
  display: flex;
  justify-content: space-between;
  height: 80px;
  background: #f5f5f5;
  display: flex;
  align-items: center;
  position: fixed;
  width: calc(100% - 240px);
  left: 240px;
  z-index: 100;
  padding: 0 20px;
  transition: all 0.5s ease;
}
.sidebar.active ~ .home-section nav{
  left: 60px;
  width: calc(100% - 60px);
}
.home-section nav .sidebar-button{
  display: flex;
  align-items: center;
  font-size: 24px;
  font-weight: 500;
}
nav .sidebar-button i{
  font-size: 35px;
  margin-right: 10px;
}
.home-section nav .search-box{
  position: relative;
  height: 50px;
  max-width: 550px;
  width: 100%;
  margin: 0 20px;
}
nav .search-box input{
  height: 100%;
  width: 100%;
  outline: none;
  background: #F5F6FA;
  border: 2px solid #EFEEF1;
  border-radius: 6px;
  font-size: 18px;
  padding: 0 15px;
}
nav .search-box .bx-search{
  position: absolute;
  height: 40px;
  width: 40px;
  background: #2697FF;
  right: 5px;
  top: 50%;
  transform: translateY(-50%);
  border-radius: 4px;
  line-height: 40px;
  text-align: center;
  color: #fff;
  font-size: 22px;
  transition: all 0.4 ease;
}
.home-section nav .profile-details{
  display: flex;
  align-items: center;
  background: #F5F6FA;
  border: 2px solid #EFEEF1;
  border-radius: 6px;
  height: 50px;
  min-width: 190px;
  padding: 0 15px 0 2px;
}
nav .profile-details img{
  height: 40px;
  width: 40px;
  border-radius: 6px;
  object-fit: cover;
}
nav .profile-details .admin_name{
  font-size: 15px;
  font-weight: 500;
  color: #333;
  margin: 0 10px;
  white-space: nowrap;
}
nav .profile-details i{
  font-size: 25px;
  color: #333;
}
.home-section .home-content{
  position: relative;
  padding-top: 104px;
}
.home-content .overview-boxes{
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-wrap: wrap;
  padding: 0 20px;
  margin-bottom: 26px;
}
.overview-boxes .box{
  display: flex;
  align-items: center;
  justify-content: center;
  width: calc(100% / 4 - 15px);
  background: #fff;
  padding: 15px 14px;
  border-radius: 12px;
  box-shadow: 0 5px 10px rgba(0,0,0,0.1);
}
.overview-boxes .box-topic{
  font-size: 20px;
  font-weight: 500;
}
.home-content .box .number{
  display: inline-block;
  font-size: 35px;
  margin-top: -6px;
  font-weight: 500;
}
.home-content .box .indicator{
  display: flex;
  align-items: center;
}
.home-content .box .indicator i{
  height: 20px;
  width: 20px;
  background: #8FDACB;
  line-height: 20px;
  text-align: center;
  border-radius: 50%;
  color: #fff;
  font-size: 20px;
  margin-right: 5px;
}
.box .indicator i.down{
  background: #e87d88;
}
.home-content .box .indicator .text{
  font-size: 12px;
}
.home-content .box .cart{
  display: inline-block;
  font-size: 32px;
  height: 50px;
  width: 50px;
  background: #cce5ff;
  line-height: 50px;
  text-align: center;
  color: #66b0ff;
  border-radius: 12px;
  margin: -15px 0 0 6px;
}
.home-content .box .cart.two{
   color: #2BD47D;
   background: #C0F2D8;
 }
.home-content .box .cart.three{
   color: #ffc233;
   background: #ffe8b3;
 }
.home-content .box .cart.four{
   color: #e05260;
   background: #f7d4d7;
 }
.home-content .total-order{
  font-size: 20px;
  font-weight: 500;
}
.home-content .sales-boxes{
  display: flex;
  justify-content: space-between;
  /* padding: 0 20px; */
}

/* left box */
.home-content .sales-boxes .recent-sales{
  width: 100%;
  max-width: 1000px;
  /* margin: 0 auto; */
  background: #fff;
  padding: 20px 30px;
  margin: 0 20px;
  border-radius: 12px;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
}
textarea {
  width: 100%;
  box-sizing: border-box;
}
@media screen and (max-width: 600px) {
  .recent-sales {
    max-width: 100%;
  }
}
.home-content .sales-boxes .sales-details{
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.title{
  font-size: 44px;
  font-weight: bolder;
  text-align: center;
}

th, td{
  height:10vh;
  width:15vw;
  vertical-align: middle;
  text-align:center;
  padding: 15px;;
}
    </style>
</head>
<body>
<div class="container">
    <div class="title font-weight-bold">TEXT ANALYSIS</div><br>
    <form id="sentiment-form" method="POST" enctype="multipart/form-data">
        <div>
            <!-- Display remaining attempts in textarea's placeholder -->
            <textarea class="form-control" name="search_fld" id="search_fld" cols="110" rows="13" placeholder="ENTER THE TEXT HERE FOR ANALYSIS (Remaining attempts: <?php echo $remaining_attempts; ?>)"></textarea>
        </div><br>

        <div class="row">
            <div class="col-md-3 m-1"><input type="submit" name="analyse_btn" class="btn btn-success w-100" value="Analyse Text"></div>
            <div class="col-md-3 m-1"><input type="submit" name="bar_btn" class="btn btn-secondary w-100" value="View Bar Graph" style="width:17vw;"></div>
            <div class="col-md-3 m-1"><input type="submit" name="pie_btn" class="btn btn-primary w-100" value="View Pie Chart" style="width:17vw;"></div>
        </div>
    </form>
    <?php
    include('vendor/autoload.php');
    use Sentiment\Analyzer;
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
     $text_analysis = $_POST['search_fld'];
     $obj=new Analyzer();
     $result=$obj->getSentiment($text_analysis);
     ?>
    <hr>
    <div class="card">
      <div class="card-header text-center">SENTIMENT ANALYSIS SCORE</div>
      <div class="card-body">
        <br>
        <h5 class="card-title text-center"><b><?php echo $text_analysis;?></b></h5>
        <p class="card-text">
    
    
     <div class="container">
     <div style="font-size:28px;">
     <table class="table d-flex justify-content-center">
     <div class="row">
     <tr>
     <th scope="col"><label class="font-weight-bold text-center">POSITIVE</label></th>
     <td><div class="progress ml-3 mt-1" style="width:20vw; height:4vh;">
     <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $result['pos']*100;?>%;" aria-valuenow="<?php echo $result['pos']*100;?>" aria-valuemin="0" aria-valuemax="1.00"><?php echo $result['pos'];?>%</div>
     </div>
     </div></td>
     </tr>
    
     <div class="row">
     <tr>
     <th scope="col"><label class="font-weight-bold text-center">NEGATIVE</label></th>
     <td><div class="progress ml-3 mt-1" style="width:20vw; height:4vh;">
     <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo $result['neg']*100;?>%;" aria-valuenow="<?php echo $result['neg']*100;?>" aria-valuemin="0" aria-valuemax="1.00"><?php echo $result['neg'];?>%</div>
     </div>
     </div></td>
     </tr>
    
     <div class="row">
     <tr>
     <th scope="col"><label class="font-weight-bold text-center">NEUTRAL</label></th>
     <td><div class="progress ml-3 mt-1" style="width:20vw; height:4vh;">
     <div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo $result['neu']*100;?>%;" aria-valuenow="<?php echo $result['neu']*100;?>" aria-valuemin="0" aria-valuemax="1.00"><?php echo $result['neu'];?>%</div>
     </div>
     </div></td>
     </tr>
    
    
     <?php
     if($result['pos'] > $result['neg'] && $result['pos'] > $result['neu'])
     {
    ?>
    <tr>
    <div class="row" style="margin-left:475px;">
    <th colspan="2"><h1 class='text-center' style='font-size:28px; font-weight:bold;'>FINAL RESULT <p style='color:green;'>POSITIVE</p></h1></th>
    </div>
    </tr>
    <?php
     }
     elseif ($result['neg'] > $result['pos'] && $result['neg'] > $result['neu'])
     {
     ?>
     <tr>
     <div class="row" style="margin-left:475px;">
     <th colspan="2"><h1 class='text-center' style='font-size:28px;'>FINAL RESULT </h1>
     <h1 class='text-center' style='font-size:28px;color:red; font-weight:bold;'>NEGATIVE</h1></th>
    </div>
    </tr>
     <?php
     }
     else
     {
     ?>
     <tr>
     <div class="row" style="margin-left:475px;">
     <th colspan="2"><h1 class='text-center' style='font-size:28px;'>FINAL RESULT </h1>
     <h1 class='text-center' style='font-size:28px;color:blue; font-weight:bold;'>NEUTRAL</h1></th>
    </div>
    </tr>
    
     </table>
     </div>
     </div>
     
     </div>
     </div>
    
    
    <?php
     }
    }
    ?>
</div>

<!-- JavaScript libraries -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.22.1/dist/bootstrap-table.min.js"></script>
</body>
</html>
