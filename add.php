<html>
    <style>
        .span{
           border-style:outset; 
        }
        </style>
    <body>

<?php
$dvn=$_POST["dvn"];
$dpc=$_POST["dvp"];
$conn=mysqli_connect("localhost","root","","shopee");
if(!$conn) 
echo "ERROR IN CONNECTIONS";
$sql="insert into cart values('$dvn','$dpc')";
if(mysqli_query($conn,$sql))
{
    echo "<span class='span'>ITEM ADDED IN CART</span>"; 
}
    else{
 echo "ERROR IN ADDING";   
 $conn->close();
}?>
</body>
</html>