<?php
// Your MySQL hostname. Usualy named as 'localhost', so you're NOT necessary to change this even this script has already online on the internet.
$hostname = 'localhost';   
 
// Your database name.     
$dbname   = 'cs601'; 
 
// Your database username.
$username = 'root';   
 
// Your database password. If your database has no password, leave it empty.          
$pass     = '';                 
 
// Let's connect to host
mysql_connect($hostname, $username, $password) or DIE('Connection to host is failed, perhaps the service is down!');
 
// Select the database
mysql_select_db($dbname) or DIE('Database name is not available!');
 
//Get the term that user typed
$like = $_REQUEST['term'];
 
//MySQL Query to be executed
$query = "'SELECT ingredient_name FROM ingredients WHERE ingredient_name like '%".$like."%'";
 
//Execute the Query
$result = mysql_query($query);
 
//Create Array of returned results
if(mysql_num_rows($result)!=FALSE){
  while($row = mysql_fetch_array($result)){
  $row['ingredient_name']=htmlentities(stripslashes($row['ingredient_name']));
  $row_set[] = $row['ingredient_name'];	
  }
}
//if no results found return appropriate message
else{
$row_set[] = 'No Matching Records Found';
}
 
//Close Database Connection
mysql_close();
 
//Encode the array into JSON Format
echo json_encode($row_set);
?>