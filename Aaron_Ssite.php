 <!DOCTYPE html>
<html>
 <head>
 <title></title>
 <h1>Gas Cost Calculator</h1>
 <hr>
 <meta charset="utf-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 </head>
 <body>

 <div class="container">

<ol>
  <li>Enter Miles Traveled</li>
  <li>Enter your vehicle's Miles Per Gallon</li>
</ol>

 <?php


 if(isset($_POST['submit']))
 {

 if(is_numeric($_POST['number1']) && is_numeric($_POST['number2']))
 {

 }
 if($_POST['operation'] == 'divided by')
 {
 $total = $_POST['number1'] / $_POST['number2'];
 }

 echo "<h1> Your Gallons Used is: {$total}</h1>";

 } else {

 echo 'Numeric values are required';

 }

 ?>

 <form method="post" action="site.php">
     <input name="number1" type="text" class="form-control" style="width: 150px; display: inline" />
     <select name="operation">
         <option value="divided by">Divide</option>
     </select>
     <input name="number2" type="text" class="form-control" style="width: 150px; display: inline" />
     <input name="submit" type="submit" value="Calculate" class="btn btn-primary" />
 </form>

 <ol>
   <li>The calculated number from the previous equation</li>
   <li>Enter the cost of gas per gallon on your trip</li>
 </ol>

 <?php


 if(isset($_POST['submit']))
 {

 if(is_numeric($_POST['number1']) && is_numeric($_POST['number2']))
 {

 if($_POST['operation'] == 'multiply')
 {
 $total2 = $_POST['number1'] * $_POST['number2'];
 }


 echo "<h1> Your Total Amount Spent on Gas Is:$ {$total2}</h1>";

 } else {

 echo 'Numeric values are required';

 }
 }

 ?>
 <form method="post" action="site.php">
     <input name="number1" type="text" class="form-control" style="width: 150px; display: inline" />
     <select name="operation">
         <option value="multiply">Multiply</option>
     </select>
     <input name="number2" type="text" class="form-control" style="width: 150px; display: inline" />
     <input name="submit" type="submit" value="Calculate" class="btn btn-primary" />
 </form>

 </div>



 </body>
</html>
