<?php
session_start();

// echo $_SESSION['u_username'];
// echo "<br>";
// echo $_SESSION['u_role'];
?>



<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Text Analysis -- Sentiment Analysis</title>
    <link rel="stylesheet" href="style.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
     <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.22.1/dist/bootstrap-table.min.css">
     <link rel="icon" type="image/x-icon" href="../images/sentiment-analysis.png">
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
  justify-content: center;
  background: #F5F6FA;
  border: 2px solid #EFEEF1;
  border-radius: 6px;
  height: 50px;
  min-width: 190px;
  padding: 0 15px 0 2px;
}

nav .profile-details .admin_name{
  font-size: 20px;
  font-weight: 500;
  text-align:center;
  color: #333;
  margin: 0 10px;
  white-space: nowrap;
}
nav .profile-details i{
  font-size: 35px;
  text-align:center;
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
.sales-boxes .box .title{
  font-size: 24px;
  font-weight: 500;
}
.sales-boxes .sales-details li.topic{
  font-size: 20px;
  font-weight: 500;
}
.sales-boxes .sales-details li{
  list-style: none;
  margin: 8px 0;
}
.sales-boxes .sales-details li a{
  font-size: 18px;
  color: #333;
  font-size: 400;
  text-decoration: none;
}
.sales-boxes .box .button{
  width: 100%;
  display: flex;
  justify-content: flex-end;
}
.sales-boxes .box .button a{
  color: #fff;
  background: #0A2558;
  padding: 4px 12px;
  font-size: 15px;
  font-weight: 400;
  border-radius: 4px;
  text-decoration: none;
  transition: all 0.3s ease;
}
.sales-boxes .box .button a:hover{
  background:  #0d3073;
}

/* Right box */
.home-content .sales-boxes .top-sales{
  width: 35%;
  background: #fff;
  padding: 20px 30px;
  margin: 0 20px 0 0;
  border-radius: 12px;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
}
.sales-boxes .top-sales li{
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin: 10px 0;
}
.sales-boxes .top-sales li a img{
  height: 40px;
  width: 40px;
  object-fit: cover;
  border-radius: 12px;
  margin-right: 10px;
  background: #333;
}
.sales-boxes .top-sales li a{
  display: flex;
  align-items: center;
  text-decoration: none;
}
.sales-boxes .top-sales li .product,
.price{
  font-size: 17px;
  font-weight: 400;
  color: #333;
}
/* Responsive Media Query */
@media (max-width: 1240px) {
  .sidebar{
    width: 60px;
  }
  .sidebar.active{
    width: 220px;
  }
  .home-section{
    width: calc(100% - 60px);
    left: 60px;
  }
  .sidebar.active ~ .home-section{
    /* width: calc(100% - 220px); */
    overflow: hidden;
    left: 220px;
  }
  .home-section nav{
    width: calc(100% - 60px);
    left: 60px;
  }
  .sidebar.active ~ .home-section nav{
    width: calc(100% - 220px);
    left: 220px;
  }
}
@media (max-width: 1150px) {
  .home-content .sales-boxes{
    flex-direction: column;
  }
  .home-content .sales-boxes .box{
    width: 100%;
    overflow-x: scroll;
    margin-bottom: 30px;
  }
  .home-content .sales-boxes .top-sales{
    margin: 0;
  }
}
@media (max-width: 1000px) {
  .overview-boxes .box{
    width: calc(100% / 2 - 15px);
    margin-bottom: 15px;
  }
}
@media (max-width: 700px) {
  nav .sidebar-button .dashboard,
  nav .profile-details .admin_name,
  nav .profile-details i{
    display: none;
  }
  .home-section nav .profile-details{
    height: 50px;
    min-width: 40px;
  }
  .home-content .sales-boxes .sales-details{
    width: 560px;
  }
}
@media (max-width: 550px) {
  .overview-boxes .box{
    width: 100%;
    margin-bottom: 15px;
  }
  .sidebar.active ~ .home-section nav .profile-details{
    display: none;
  }
}
  @media (max-width: 400px) {
  .sidebar{
    width: 0;
  }
  .sidebar.active{
    width: 60px;
  }
  .home-section{
    width: 100%;
    left: 0;
  }
  .sidebar.active ~ .home-section{
    left: 60px;
    width: calc(100% - 60px);
  }
  .home-section nav{
    width: 100%;
    left: 0;
  }
  .sidebar.active ~ .home-section nav{
    left: 60px;
    width: calc(100% - 60px);
  }
}

#loading-bar {
            display: none;
            background-color: #f1f1f1;
            width: 100%;
            height: 30px;
            text-align: center;
            line-height: 30px;
            color: #333;
            position: relative;
        }

        #progress {
            width: 0;
            height: 100%;
            background-color: #4caf50;
            position: absolute;
            top: 0;
            left: 0;
            animation: progressAnimation 3s ease-in-out forwards;
        }

        @keyframes progressAnimation {
            0% {
                width: 0;
            }
            100% {
                width: 100%;
            }
        }
     </style>
   </head>
<body>
  <div class="sidebar">
    <div class="logo-details">
      <i class='bx bxl-c-plus-plus'></i>
      <span class="logo_name">SENTIMENT ANALYSIS</span>
    </div>
      <ul class="nav-links">
        <li>
          <a href="text_analysis.php">
          <i class='bx bx-font'></i>
            <span class="links_name" style="font-weight:bold;">Text Analysis</span>
          </a>
        </li>
        <li>
          <a href="file_analysis.php" class="active">
          <i class='bx bx-file-blank' style="color:#fff; font-weight:bold;"></i>
            <span class="links_name" style="color:#fff; font-weight:bold;">File Analysis</span>
          </a>
        </li>
        <li>
          <a href="admin_settings.php">
            <i class='bx bx-cog' ></i>
            <span class="links_name" style="font-weight:bold;">Settings</span>
          </a>
        </li>
        <li class="log_out">
          <a href="../logout.php">
            <i class='bx bx-log-out'></i>
            <span class="links_name" style="font-weight:bold;">Log out</span>
          </a>
        </li>
      </ul>
  </div>
  <section class="home-section">
    <nav>
      <div class="sidebar-button">
        <i class='bx bx-menu sidebarBtn'></i>
        <span class="dashboard">Dashboard</span>
      </div>
      <div class="search-box">
        <input type="text" placeholder="Search...">
        <i class='bx bx-search' ></i>
      </div>
      <div class="profile-details">
        <span class="admin_name"><?php echo $_SESSION['u_name'];?></span>    
      </div>
    </nav>

    <div class="home-content">

      <div class="sales-boxes">
        <div class="col-md-11 recent-sales box">
        <div class="title font-weight-bold">FILE ANALYSIS</div><br>

        <form method="POST" enctype="multipart/form-data">

        <form action="" method="post" enctype="multipart/form-data">
        <label for="formFile" class="form-label font-weight-bold">UPLOAD THE FILE TO ANALYSIS</label>
        <div class="input-group mb-3">
            <div class="custom-file">
                <input type="file" name="fileToUpload" class="custom-file-input" id="inputGroupFile01" accept=".csv" required onchange="displayFileName()">
                <label class="custom-file-label" for="inputGroupFile01" id="selectedFileName">Choose file</label>
            </div>
        </div>
<div class="mb-3">
    <button class="btn btn-primary" name="submit_file" type="submit">Upload File</button>
  </div>
  </form>

  <script>
        function displayFileName() {
            var inputFile = document.getElementById('inputGroupFile01');
            var fileName = inputFile.files[0].name;
            var selectedFileNameLabel = document.getElementById('selectedFileName');
            selectedFileNameLabel.innerHTML = fileName;
        }
    </script>


<?php
if(isset($_POST['submit_file'])) {
    if ($_FILES['fileToUpload']['error'] === UPLOAD_ERR_OK) {
        $file_tmp = $_FILES['fileToUpload']['tmp_name'];
        $file = fopen($file_tmp, 'r');
        $rows = array();
        while (($row = fgetcsv($file)) !== FALSE) {
            $rows[] = $row[0]; // Assuming the text is in the first column
        }
        fclose($file);

        // Display table headings
        echo "<table class='table table-bordered table-hover'>";
        echo "<tr class='thead-dark'>";
        echo "<th scope='col'>Text</th>";
        echo "<th scope='col'>Sentiment Score</th>";
        // echo "<th scope='col'>Positive Score</th>";
        // echo "<th scope='col'>Negative Score</th>";
        // echo "<th scope='col'>Neutral Score</th>";
        echo "<th scope='col'>Sentiment Label</th>";
        echo "<th scope='col'>Accuracy</th>";
        echo "</tr>";

        // Send each row of text to Flask server for sentiment analysis
        foreach ($rows as $text) {
          $i=1;
            $url = 'http://127.0.0.1:5000/sentiment'; // URL of the Python Flask server
            
            // Prepare data
            $data = array('text' => $text);
            
            // Initiate cURL request
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            
            // Execute the request
            $result = curl_exec($ch);
            curl_close($ch);
            
            // Check if the request was successful
            if ($result === FALSE) {
                die('Error sending data to server');
            }
            $response = json_decode($result, true);
            
            // Check if $response is null or not properly populated
            if ($response !== null && isset($response['sentiment_score']) && isset($response['positive_score']) && isset($response['negative_score']) && isset($response['neutral_score']) && isset($response['sentiment_label']) && isset($response['accuracy'])) {
                // Display results in table rows
                echo "<tr>";
                ?>
                <td>
                  <?php
                  // Arrays of positive, negative, and neutral words
$positive_words = ["good", "happy", "love", "joyful", "Impressed", "excellent", "amazing", "wonderful", "fantastic", "great", "awesome", "delightful", "pleasurable", "content", "satisfied", "upbeat", "glad", "ecstatic", "positive", "terrific", "superb", "sensational", "exhilarating", "beautiful", "exciting", "brilliant", "perfect", "lovely", "splendid", "vibrant", "charming", "celebrate", "accomplish", "success"];
$negative_words = ["bad", "sad", "lose", "though", "unhappy", "terrible", "kill", "hate", "disappointing", "horrible", "awful", "miserable", "angry", "disgusted", "depressed", "dreadful", "grim", "negative", "disastrous", "annoyed", "frustrated", "stressed", "worried", "difficult", "painful", "fail", "ugly", "unfortunate", "tragic", "regret", "failure", "stressful", "hopeless", "devastating"];
$neutral_words = ["okay", "fine", "average", "bought", "neutral", "normal", "standard", "routine", "typical", "moderate", "indifferent", "common", "usual", "ordinary", "tolerable", "fair", "middling", "so-so", "passable", "indifferent", "indistinct", "ambiguous", "bland", "routine", "ordinary", "regular", "commonplace", "typical", "mundane", "plain", "standard", "unremarkable", "generic", "routine", "predictable"];
$sentiment_label = $response['sentiment_label'];

if ($sentiment_label == "Positive") 
{
  $words = explode(" ", $text);
  $highlighted_sentence = array();
  
  foreach ($words as $word) {
      $lowercase_word = strtolower($word);
      if (in_array($lowercase_word, array_map('strtolower', $positive_words))) {
          $highlighted_sentence[] = "<span style='background-color:green;'>$word</span>";
      }else {
          $highlighted_sentence[] = $word;
      }
  }
  
  echo implode(" ", $highlighted_sentence);
} 
elseif ($sentiment_label == "Negative") 
{
  $words = explode(" ", $text);
  $highlighted_sentence = array();
  
  foreach ($words as $word) {
      $lowercase_word = strtolower($word);
      if(in_array($lowercase_word, array_map('strtolower', $negative_words))) {
          $highlighted_sentence[] = "<span style='background-color:red;'>$word</span>";
      }else {
          $highlighted_sentence[] = $word;
      }
  }
  
  echo implode(" ", $highlighted_sentence);
} 
else 
{
  $words = explode(" ", $text);
  $highlighted_sentence = array();
  
  foreach ($words as $word) {
      $lowercase_word = strtolower($word);
      if (in_array($lowercase_word, array_map('strtolower', $neutral_words))) {
          $highlighted_sentence[] = "<span style='background-color:orange;'>$word</span>";
      } else {
          $highlighted_sentence[] = $word;
      }
  }
  
  echo implode(" ", $highlighted_sentence);
}
                  ?>
                </td>
                <?php
                // Display sentiment score, positive score, negative score, neutral score, sentiment label, and accuracy
                echo "<td>".$response['sentiment_score']*100  ."</td>";
                // echo "<td>".$response['positive_score']*100  . "%". "</td>";
                // echo "<td>".$response['negative_score']*100    . "%". "</td>";
                // echo "<td>".$response['neutral_score']*100     . "%". "</td>";
$color = '';
switch ($response['sentiment_label']) {
    case "Positive":
        $color = 'green';
        break;
    case "Negative":
        $color = 'red';
        break;
    case "Neutral":
        $color = 'blue';
        break;
    default:
        $color = 'black'; // Default color if sentiment label is not recognized
}
                echo "<td><div class=\"font-weight-bold\" style=\"color:$color;\">". strtoupper($response['sentiment_label']) . "</div></td>";
                echo "<td>".$response['accuracy']."</td>";
                echo "</tr>";
            } else {
                echo "<tr><td colspan='7'>Error: Unable to retrieve sentiment analysis data for the text '".$text."'</td></tr>";
            }
        }
        // Close table
        echo "</table>";
    } else {
        echo "Error uploading file.";
    }
}
?>



        </div>
        </div>
    </div>
  </section>



  <script>
   let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".sidebarBtn");
sidebarBtn.onclick = function() {
  sidebar.classList.toggle("active");
  if(sidebar.classList.contains("active")){
  sidebarBtn.classList.replace("bx-menu" ,"bx-menu-alt-right");
}else
  sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
}
 </script>

<!-- code for validating the submiting form -->
<!-- <script>
  // Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
})()
</script> -->

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.22.1/dist/bootstrap-table.min.js"></script>
</body>
</html>