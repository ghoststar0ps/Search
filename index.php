<!-- 
########################################################################################
## Search V1.0beta - A PHP search engine                                              ##
########################################################################################
##  Copyright (C) 2017 G Vaishno Chaitanya                                            ##
##  SEARCH                                                                            ##
##  https://github.com/gvaishno/Search                                                ##
##                                                                                    ##
########################################################################################

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU Affero General Public License as
    published by the Free Software Foundation, either version 3 of the
    License, or any later version.

1. YOU MUST NOT CHANGE THE LICENSE FOR THE SOFTWARE OR ANY PARTS HEREOF! IT MUST REMAIN AGPL.
2. YOU MUST NOT REMOVE THIS COPYRIGHT NOTES FROM ANY PARTS OF THIS SOFTWARE!
3. NOTE THAT THIS SOFTWARE CONTAINS THIRD-PARTY-SOLUTIONS THAT MAY EVENTUALLY NOT FALL UNDER (A)GPL!
4. PLEASE READ THE LICENSE OF THE CUNITY SOFTWARE CAREFULLY!

  You should have received a copy of the GNU Affero General Public License
    along with this program (under the folder LICENSE).
  If not, see <http://www.gnu.org/licenses/>.

   If your software can interact with users remotely through a computer network,
   you have to make sure that it provides a way for users to get its source.
   For example, if your program is a web application, its interface could display
   a "Source" link that leads users to an archive of the code. There are many ways
   you could offer source, and different solutions will be better for different programs;
   see section 13 of the GNU Affero General Public License for the specific requirements.

   #####################################################################################
   */
 -->
<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost", "root", "password", "mysearch");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Print host information
echo "Connect Successfully. Host info: " . mysqli_get_host_info($link);

ob_start();
  session_start();
  require_once 'account/dbconnect.php';
  
  // if session is not set this will redirect to login page
  //if( !isset($_SESSION['user']) ) {
    //header("Location: account/index.php");
    //exit;
  //}
  // select loggedin users detail
  $res=mysql_query("SELECT * FROM users WHERE userId=".$_SESSION['user']);
  $userRow=mysql_fetch_array($res);

  $title = $_POST['title'];
  $desc = $_POST['description'];
  $url = $_POST['url'];
  $search = $_POST['keywords'];
  $url1 = $_POST['url1'];

  $title = mysql_real_escape_string($title);
  $desc = mysql_real_escape_string($desc);
  $url = mysql_real_escape_string($url);
  $search = mysql_real_escape_string($search);
  $url1 = mysql_real_escape_string($url1);
  $userName = mysql_real_escape_string($userName);
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome - <?php echo $userRow['userEmail']; ?></title>
<link rel="stylesheet" href="account/assets/css/bootstrap.min.css" type="text/css"  />
<link rel="stylesheet" href="account/style.css" type="text/css" />
</head>
<body>

	<nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">Search</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="account/home.php">Add Website</a></li>
            
          </ul>
          <ul class="nav navbar-nav navbar-right">
            
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
			  <span class="glyphicon glyphicon-user"></span>&nbsp;Hi <?php echo $userRow['userName']; ?>&nbsp;<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="account/logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Sign In / Sign Out</a></li>
              </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav> 

	<div id="wrapper">

	<div class="container">
    
    	<div class="page-header">
    	</div>
        
        <div class="row">
        <div class="col-lg-12">
        <h1>Search</h1>
    <form action="search.php">
             <div class="row">
               <div class="col-lg-6">
                 <div class="input-group">
                    <input type="text" id="search" name="search" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                 <button class="btn btn-default" type="submit" name='submit' value='search' >Search!</button>
                 </span>
               </div><!-- /input-group -->
             </div><!-- /.col-lg-6 -->
          </div><!-- /.row -->
</form>
        </div>
        </div>
    
    </div>
    
    </div>
    
    <script src="account/assets/jquery-1.11.3-jquery.min.js"></script>
    <script src="account/assets/js/bootstrap.min.js"></script>
    
</body>