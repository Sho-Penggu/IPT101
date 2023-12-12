<?php   
 include('server.php'); 
 if (empty($_SESSION['username'])){
  header('location: login.php');
  }

  $user = $_SESSION['user'];

 //load_data_select.php  
 include('config.php');
 // if user is not logged in, they cannot access this page

  function fill_record($dbcon) {  
     ?>
    <tr><td colspan="3">
    <div class="alert alert-info animated bounceInDown" role="alert">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      Select Title first. 
    </div>
    </td></tr>
     <?php
 } 
 
 ?> 

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="img/logo.png"/>
	<title>Overall - Judging & Tabulation System 2017</title>

	<link rel="stylesheet" href="css/bootstrap.css">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="assets/animate.css" />
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
</head>
<body class="flare-bg">
	<div class="container-fluid">    
  <div class="row animated fadeInLeft">
    <div class="col-lg-5 header">
       <div class="row">
          <div class="col-lg-12">
            <center><img src="img/hcdc_logo.png" class="dost-logo"></center>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
             <center><img src="img/HCDC_Background.png" class="searchfor"></center>
          </div>
        </div>
    </div>
    <div class="col-lg-6 judge-contestant">
     <h3 class="page-header">Overall Record <span class="animated fadeInDown right-loged">
    <a href="index.php"><input type="button" class="backtohome" title="Back to home"></a> <a href="view.php"><input type="button" class="editrecord" title="Edit Record"></a> <a href="index.php?logout=1"><input type="button" class="logout" title="Logout"></a></span></h3>
    <div class="row">
      <div class="col-lg-12">
        <div class="form-group">
          <label>Title:</label>
            <?php
              include('config.php');
              $query = "SELECT * FROM title";
              $result = mysqli_query($dbcon, $query);
            ?>
            <select name="title" id="title" class="form-control">
              <option value="" style="color:#bbb;">-- Select Title --</option>    
            <?php
              while ($row = mysqli_fetch_array($result)) {
                echo "<option value=".$row['TitleID'].">".$row['TitleName']."</option>";
              } 
            ?> 
            </select>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="table-responsive">
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th>Contestant</th>
                <th>TotalScore</th>    
                <th>Rank</th>     
              </tr>
            </thead>
            <tbody id="overall">
                 <?php echo fill_record($dbcon); ?>  
            </tbody>
          </table>
        </div> 
      </div>
    </div>
    <div class="modal-footer">  
    <?php echo "<input type=text id=userid name=userid value=".$user." style='display:none'>"; ?>
    </div>
  </div>
  </div>
  </div>
</body>
</html>

<script>  
 $(document).ready(function(){  
      $('#title').change(function(){  
           var title = $(this).val(); 
           var userid = $('#userid').val();  
           $.ajax({  
                url:"overall_data.php",  
                method:"POST",  
                data:{title:title, userid:userid},  
                success:function(data){  
                     $('#overall').html(data);  
                }  
           });  
      });   
 });  
 </script>  