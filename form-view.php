<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" type="text/css"
          rel="stylesheet"/>
    <title>Order food & drinks</title>
</head>
<body>

<?php
// define variables and set to empty values
$emailErr = $zipcodeErr = $cityErr = $streetnumberErr = $streetErr = "";
$email =  $zipcode = $city = $streetnumber = $street = "";

// This function is for refining input data :--------------------------------------------

function test_input($data) 
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}



if ($_SERVER["REQUEST_METHOD"] == "POST") 
{

// This is for Email :--------------------------------------------

  if (empty($_POST["email"])) 
    {
    $emailErr = "Email is required";
    } 
  else
   {
  
    if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) 
      {
       $email = ($_POST["email"]);
      } 
    else 
    {
      $emailErr = "Incorrect Email ID";
    }
    
  }

// This is for City :--------------------------------------------

  if (empty($_POST["city"])) {
    $cityErr = "City name is required";
  } else {
    $city = test_input($_POST["city"]);
  }

// This is for Street :--------------------------------------------

if (empty($_POST["street"])) {
  $streetErr = "Street name is required";
} else {
  $street = test_input($_POST["street"]);
}



// This is for Streetnumber :--------------------------------------------  

if (empty($_POST["streetnumber"])) 
{
  $streetnumberErr = "streetnumber is required";
} 
else 
{
if(is_numeric($_POST["streetnumber"]))
  {
    $streetnumber = $_POST["streetnumber"];
  }
else 
  {
    $streetnumberErr = "streetnumber must be numeric";
   }
}

// This is for Zipcode :--------------------------------------------  

  if (empty($_POST["zipcode"])) 
  {
    $zipcodeErr = "Zipcode is required";
  } 
 else 
 {
  if(is_numeric($_POST["zipcode"]))
    {
    $zipcode = $_POST["zipcode"];
    }
  else 
    {
      $zipcodeErr = "Zipcode must be numeric";
          }
 }
 
}


?>


<div class="container">
    <h1>Order food in restaurant "the Personal Ham Processors"</h1>

<!-- For the navigation of 2 links. -->
    <nav>
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link active" href="?food=1">Order food</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?food=0">Order drinks</a>
            </li>
        </ul>
    </nav>


<!--     <h2>PHP Form Validation </h2> -->
<p><span class="error">* required field</span></p>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
   
   
    <!-- For the email validation entered in the form -->

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="email">E-mail:</label>
                <input type="text"id="email" name="email" value ="<?php echo isset($_POST["email"])?$_POST["email"]:""; ?>" id="email" size="20"  class="form-control"/>
                <span class="error">* <?php echo $emailErr;?></span>
                <br><br>
            </div>
            <div></div>
        </div>



        <fieldset>
            <legend>Address</legend>

    <!-- For the street and street number validation entered in the form -->

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="street">Street:</label>
                    <input type="text" id="street" name="street" class="form-control" value ="<?php echo isset($_POST["street"])?$_POST["street"]:""; ?>" id="street" size="20" />
                    <span class="error">* <?php echo $streetErr;?></span>
                    <br><br>
                </div>
                <div class="form-group col-md-6">
                    <label for="streetnumber">Street number:</label>
                    <input type="text" id="streetnumber" name="streetnumber" class="form-control" value ="<?php echo isset($_POST["streetnumber"])?$_POST["streetnumber"]:""; ?>" id="streetnumber" size="20" />
                    <span class="error">* <?php echo $streetnumberErr;?></span>
                    <br><br>
                </div>
            </div>

    <!-- For the city and zipcode validation entered in the form -->

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="city">City:</label>
                    <input type="text" id="city" name="city" class="form-control" value ="<?php echo isset($_POST["city"])?$_POST["city"]:""; ?>" id="city" size="20" />
                    <span class="error">* <?php echo $cityErr;?></span>
                    <br><br>
                </div>
                <div class="form-group col-md-6">
                    <label for="zipcode">Zipcode</label>
                    <input type="text" id="zipcode" name="zipcode" class="form-control" value ="<?php echo isset($_POST["zipcode"])?$_POST["zipcode"]:""; ?>" id="zipcode" size="20" />
                    <span class="error">* <?php echo $zipcodeErr;?></span>
                    <br><br>
                </div>
            </div>
        </fieldset>

    <!-- For the products display as available in the index array -->


        <fieldset>
            <legend>Products</legend>

  <!-- Finding link between 2 URL -->

<?php
          if(isset($_GET['food']) AND $_GET['food'] == 1){
          $products = [
              ['name' => 'Club Ham', 'price' => 3.20],
              ['name' => 'Club Cheese', 'price' => 3],
              ['name' => 'Club Cheese & Ham', 'price' => 4],
              ['name' => 'Club Chicken', 'price' => 4],
              ['name' => 'Club Salmon', 'price' => 5]
                      ];
            $is_food=true;
          }
          else if(isset($_GET['food']) AND $_GET['food'] == 0)
              {
              $is_food=false;
              $products = [
                ['name' => 'Cola', 'price' => 2],
                ['name' => 'Fanta', 'price' => 2],
                ['name' => 'Sprite', 'price' => 2],
                ['name' => 'Ice-tea', 'price' => 3],
                          ];
              }
?>



            <?php foreach ($products AS $i => $product): ?>
                <label>
                    <input type="checkbox" value="1" name="products[<?php echo $i ?>]"/> <?php echo $product['name'] ?> -
                    &euro; <?php echo number_format($product['price'], 2) ?></label><br />
            <?php endforeach; ?>
        </fieldset>

    <!-- For the submit button -->


        <button type="submit" class="btn btn-primary">Order!</button>


    <?php
       if(isset($_POST['submit']))
        {
          if(!empty($_POST['products']))
               {
        // Counting number of checked checkboxes.
            $checked_count = count($_POST['products']);
            

                echo "You have selected following ".$checked_count." option(s): <br/>";
// Loop to store and display values of individual checked checkbox.
            foreach($_POST['products'] as $selected => $final_product )
            {
                echo "<p>".$selected."</p>";

/*                 $total_amount = array_sum($final_product['price'], 2);
                echo $total_amount; */
            }
                echo "<br/><b>Note :</b> <span>Similarily, You Can Also Perform CRUD Operations using These Selected Values.</span>";
            }
          else{
              echo "<b>Please Select Atleast One Option.</b>";
            }
        }
    ?>




    </form>

    <footer>You already ordered <strong>&euro; <?php echo $totalValue ?></strong> in food and drinks.</footer>
</div>

<style>
    footer {
        text-align: center;
    }
</style>
</body>
</html>