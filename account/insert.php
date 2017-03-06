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

$link = mysqli_connect("localhost", "root", "password", "mysearch");
 
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
  $title = $_POST['title'];
  $desc = $_POST['description'];
  $url = $_POST['url'];
  $search = $_POST['keywords'];
  $url1 = $_POST['url1'];
  $name = $_POST['name'];

  $title = mysql_real_escape_string($title);
  $desc = mysql_real_escape_string($desc);
  $url = mysql_real_escape_string($url);
  $search = mysql_real_escape_string($search);
  $url1 = mysql_real_escape_string($url1);
  $name = mysql_real_escape_string($name);

$sql = "INSERT INTO search (title, description, url, keywords, url1, name) VALUES ('$title', '$desc', '$url', '$search', '$url1', '$name')";
if(mysqli_query($link, $sql)){
    echo "Records inserted successfully.
     <a href='home.php'>Go Back</a> | <a href='index.php'>Go Home</a>";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
mysqli_close($link);
?>