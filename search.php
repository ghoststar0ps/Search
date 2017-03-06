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
    
$button = $_GET ['submit'];
$search = $_GET ['search']; 
  

if(strlen($search)<=1)
echo "Search term too short";
else{
echo "     <div class='col-lg-12'>
<nav class='navbar navbar-default navbar-fixed-top'>

    <div class='container'>
    	
    <div id='navbar' class='navbar-collapse collapse'>

    <a class='navbar-brand' href='index.php'>Search</a>
    
        <form action='search.php'>
            <div class='col-lg-6' style='padding-top: 10px;width: 40%;'>
            <div class='input-group'>
            <input type='text' id='search' name='search' class='form-control' placeholder='Search for...''>
            <span class='input-group-btn'>
            <button class='btn btn-default' type='submit' name='submit' value='search' >Search</button>
            </span>
            </div>
            
       </form>
       </div>
            <ul class='nav navbar-nav'>
                <li class='active'><a href='account/home.php'>Add Website</a></li>
            </ul>
        <ul class='nav navbar-nav navbar-right'>
            
            <li class='dropdown'>
                <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>
			        <span class='glyphicon glyphicon-user'></span>&nbsp;Hi &nbsp;<span class='caret'></span></a>
                <ul class='dropdown-menu'>
                    <li><a href='account/logout.php?logout'><span class='glyphicon glyphicon-log-out'></span>&nbsp;Sign In / Sign Out</a></li>
                </ul>
            </li>
        </ul>
    </div>
    </div>
    </div>
</nav> 
You searched for <b>$search</b> <hr size='1'>";
mysql_connect("localhost","root","password");
mysql_select_db("mysearch");
    
$search_exploded = explode (" ", $search);
 
$x = "";
$construct = "";  
    
foreach($search_exploded as $search_each)
{
$x++;
if($x==1)
$construct .="title LIKE '%$search_each%'";
else
$construct .="AND title LIKE '%$search_each%'";
    
}
  
$constructs ="SELECT * FROM mysearch.search WHERE $construct";
$run = mysql_query($constructs);
    
$foundnum = mysql_num_rows($run);
    
if ($foundnum==0)
echo "
<div class='container'>
Sorry, there are no matching result for <b>$search</b>.</br></br>1. 
Try more general words. for example: If you want to search 'how to create a website'
then use general keyword like 'create' 'website'</br>2. Try different words with similar
 meaning</br>3. Please check your spelling
 </div>";
else
{ 
  
echo "
<div class='container'>
You searched for <b>$search</b> <hr size='1'> $foundnum results found !<p>
</div>";
  
$per_page = 2;
$start = isset($_GET['start']) ? $_GET['start']: '';
$max_pages = ceil($foundnum / $per_page);
if(!$start)
$start=0; 
$getquery = mysql_query("SELECT * FROM mysearch.search WHERE $construct LIMIT $start, $per_page");
  
while($runrows = mysql_fetch_assoc($getquery))
{
$id = $runrows['id'];
$title = $runrows ['title'];
$desc = $runrows ['description'];
$url = $runrows ['url'];
$url1 = $runrows ['url1'];
$userName = $runrows ['userName'];
   
echo "
<div class='container'>
<a href='$url'><b>$title</b></a><br>
$desc<br>
<span><a title='Search domain $url'><img title='Search domain $title' height='20' width='20' src='$url1' style='vertical-align: middle;
    padding-right: 4px;'></a></span><a href='$url'><span>$url</span></a><span style='padding-left: 1%; color: #b5b5b5;' title='Result ID: $id' data-toggle='tooltip' data-placement='left'><span class='glyphicon glyphicon-user' aria-hidden='true'></span>&nbsp;$userName &nbsp;</span>
</div><br>
";
    
}
  
echo "<center>";
  
$prev = $start - $per_page;
$next = $start + $per_page;
                       
$adjacents = 3;
$last = $max_pages - 1;
  
if($max_pages > 1)
{   
//previous button
if (!($start<=0)) 
echo " <a href='search.php?search=$search&submit=&start=$prev'>Prev</a> ";    
          
//pages 
if ($max_pages < 7 + ($adjacents * 2))   //not enough pages to bother breaking it up
{
$i = 0;   
for ($counter = 1; $counter <= $max_pages; $counter++)
{
if ($i == $start){
echo " <a href='search.php?search=$search&submit=&start=$i'><b>$counter</b></a> ";
}
else {
echo " <a href='search.php?search=$search&submit=&start=$i'>$counter</a> ";
}  
$i = $i + $per_page;                 
}
}
elseif($max_pages > 5 + ($adjacents * 2))    //enough pages to hide some
{
//close to beginning; only hide later pages
if(($start/$per_page) < 1 + ($adjacents * 2))        
{
$i = 0;
for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
{
if ($i == $start){
echo " <a href='search.php?search=$search&submit=&start=$i'><b>$counter</b></a> ";
}
else {
echo " <a href='search.php?search=$search&submit=&start=$i'>$counter</a> ";
} 
$i = $i + $per_page;                                       
}
                          
}
//in middle; hide some front and some back
elseif($max_pages - ($adjacents * 2) > ($start / $per_page) && ($start / $per_page) > ($adjacents * 2))
{
echo " <a href='search.php?search=$search&submit=&start=0'>1</a> ";
echo " <a href='search.php?search=$search&submit=&start=$per_page'>2</a> .... ";
 
$i = $start;                 
for ($counter = ($start/$per_page)+1; $counter < ($start / $per_page) + $adjacents + 2; $counter++)
{
if ($i == $start){
echo " <a href='search.php?search=$search&submit=&start=$i'><b>$counter</b></a> ";
}
else {
echo " <a href='search.php?search=$search&submit=&start=$i'>$counter</a> ";
}   
$i = $i + $per_page;                
}
                                  
}
//close to end; only hide early pages
else
{
echo " <a href='search.php?search=$search&submit=&start=0'>1</a> ";
echo " <a href='search.php?search=$search&submit=&start=$per_page'>2</a> .... ";
 
$i = $start;                
for ($counter = ($start / $per_page) + 1; $counter <= $max_pages; $counter++)
{
if ($i == $start){
echo " <a href='search.php?search=$search&submit=&start=$i'><b>$counter</b></a> ";
}
else {
echo " <a href='search.php?search=$search&submit=&start=$i'>$counter</a> ";   
} 
$i = $i + $per_page;              
}
}
}
          
//next button
if (!($start >=$foundnum-$per_page))
echo " <a href='search.php?search=$search&submit=&start=$next'>Next</a> ";    
}   
echo "</center>";
} 
} 
?>
<title>Welcome - <?php echo $userRow['userEmail']; ?></title>
<link rel="stylesheet" href="account/assets/css/bootstrap.min.css" type="text/css"  />
<link rel="stylesheet" href="account/style.css" type="text/css" />
<script src="account/assets/jquery-1.11.3-jquery.min.js"></script>
    <script src="account/assets/js/bootstrap.min.js"></script>