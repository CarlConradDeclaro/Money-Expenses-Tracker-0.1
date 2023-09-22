<?php

include 'connect.php'; 
   

 if (isset($_POST['submit'])) {
    
    $Category = $_POST['cat'];
    $ProductName = $_POST['prodName'];
    $Price = $_POST['prodPrice'];

    // Prepare the INSERT query   Category, ProductName , Price
    if ($Category != "" && $ProductName != "" && $Price != "") {
        $sql = "INSERT INTO user (category, productName, price) VALUES ('$Category', '$ProductName', '$Price')";

    }else{
        header("Location: expensesTracker.php");
        exit();
    }
    
   // Execute the query
    if ($conn->query($sql) === TRUE) {
    header("Location: expensesTracker.php");
    exit();   
  } else {}
    $firstName = "";
    
}







$sql = 'SELECT * FROM user' ;// need to edit this
$result = mysqli_query($conn, $sql);
$feedback = mysqli_fetch_all($result,MYSQLI_ASSOC);
$feedback = array_reverse($feedback);

   
$total = 0;
foreach ($feedback as $item) {
    $price = (int) $item['price']; 
   $total += $price;
}


$Date = date('F d, Y');
$currentDate = $Date;
$nextDay = date('F d, Y', strtotime($currentDate . ' +1 day'));
 


$totalForDay = 0;

foreach ($feedback as $itemFDay) {
    $tprice = (int) $itemFDay['price']; 
    $totalForDay += $tprice;

} 
if ($currentDate == $nextDay) {
    // Use prepared statement with parameterized query
    $stmt = $conn->prepare("INSERT INTO day (dayS, daysTotal) VALUES (?, ?)");
    $stmt->bind_param("si", $currentDate, $totalForDay);
    $stmt->execute();
    $totalForDay = 0;
}

 
if (isset($_GET['delete_id'])) {
    $dateToDelete = $_GET['delete_id'];

    // Prepare the DELETE query
                     //need to edit this
    $sql = "DELETE FROM user WHERE id = '$dateToDelete'";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        header("Location: expensesTracker.php");
        exit();
    } else {
        // Handle errors if needed
    }
}


// Check if the update form was submitted
if (isset($_POST['submitt'])) {

    // Get the ID of the user that is being updated
    $Id = $_POST['id'];
    $Cat =$_POST['cat2'];
    $prodName = $_POST['Prodname'];
    $prodPrice = $_POST['price'];


    // Prepare the UPDATE query
    
    if ($Cat != "" && $prodName != "" && $prodPrice != "") {
             //  need to edit this
        $sql = "UPDATE user SET category='$Cat', productName='$prodName', price='$prodPrice' WHERE id='$Id'";
    }else{
        header("Location: expensesTracker.php");
        exit();
    }  

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        header("Location: expensesTracker.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}





?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="expensesTracker.css?v=<?php echo time() ?>">
    <link rel="stylesheet" href="insert.css?v=<?php echo time() ?>">
   <link rel="stylesheet" href="updateForm.css?v=<?php echo time() ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />

    <title>Expenses Tracker</title>
</head>
<body>
 
    <div class="container"    >
    
   
            <div class="sideBar" id="sideBar">
                            <h1>Menu</h1>               
                            <li id="dashboard">Dashboard</li>
                            <li id="expenses">Expenses</li>
                            <li id="expenses-report">Expenses Report</li>
                            <li id="profile">Profle</li> 
             </div>

             <div class="menubar" id="menuBar"  >     
                            <button  onclick="closeNav()"> ☰</button>
            </div>   

            <div class="main" id="main" style="display: block;" >
            <div class="php" id="php">
                 <?php  include 'insert.php' ?> 
            </div>   
            <div class="updateForm" id="updateForm">
            <?php  include 'updateForm.php' ?> 
            </div>        
                     <div class="table">
                            <table >
                                    <tr>
                                        <th>Id</th>
                                        <th>Date</th>   
                                        <th>Category</th>       
                                        <th>Product name</th>
                                        <th>Price</th>
                                        
                                    </tr>

                                    <?php foreach ($feedback as $item) : ?>
                                        <tr>                                          

                                            <td> <?php echo $item['id']; ?> </td>
                                            <td> <?php echo $item['date']; ?> </td>
                                            <td> <?php echo $item['category']; ?> </td>
                                            <td> <?php echo $item['productName']; ?> </td>
                                            <td> <?php echo $item['price']; ?> </td>
                                            <td>



                                                <div class="edit">
                                                            <!-- Pass the item's date as a parameter in the URL for deletion -->
                                                <a href='expensesTracker.php?delete_id=<?php echo $item['id']; ?>' class="btnDelete">Delete</a>
                                                <!-- Link to the updateForm.php page with the corresponding record ID and the feedback array -->
                                                <a href='#' class="updateLink" data-id="<?php echo $item['id']; ?>">Update</a>
                                            
                                                </div>
                                              
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                            </table>
                    </div>    
                    
                    
             </div>

        
             
            <div class="Expenses" id="Expenses"  >
                                     
                    <div class="flexs">
                        
                             <div id="track-expenses">
                                        <div>
                                                <h1>Select a Category:</h1>
                                                <label for="reportYears">Choose a Year:</label>
                                                <select name="reportYears" id="reportYears"></select>

                                                <label for="reportMonth">Choose a Month</label>
                                                <select name="reportMonth" id="reportMonth">
                                                </select>

                                                <label for="reportDay">Choose a Day</label>
                                                <select name="reportDay" id="reportDay">
                                                </select>

                                                <div>
                                                    <button id="getItems" onclick="getItems()">Get Items</button>
                                                </div>
                                        </div>
                             </div>
                                
                             <div class="selected-item" id="selected-item">      
                                    <h1 id="track-expensTots">Total: 0</h1>
     
                                    <table  class="table2"  id="table2" >
                                        <tr>
                                            <th>Date</th>
                                            <th>Category</th>
                                            <th>Product name</th>
                                            <th>Price</th>
                                        </tr>         
                                    </table>
                             </div>
                    </div>
                
            </div>

            <div class="expenses-dashboard" id="expenses-dashboard">
                            <div class="date-tracker">                         
                                        <div>                                                                                 
                                            <h1 class="Day" id="day" > </h1>                                      
                                            <p class="amount" id="dAmt" >  </p>
                                        </div>
                                        
                                        <div>                                      
                                            <h1 class="Month" id="month"> </h1>                                   
                                            <p class="amount" id="mamt"> </p>                                 
                                        </div>
                                                        
                                        <div>                                    
                                            <h1 class="Year" id="year"></h1>                                    
                                            <p class="amount" id="yAmt"></p>                                  
                                        </div>
                            </div>

                        
                    <div class="getStats" id="getStats"> 
                                <label for="Stats">Category:</label>
                                <select name="Stats" id="Stats">
                                <option value="In-Day">In-Day</option>
                                <option value="Day">Day</option>
                                <option value="Week" disabled>  Week</option>
                                <option value="Month">Month</option>
                                <option value="Year">Year</option>
                                </select>
                    
                                <button id="getStatsReport" >Proceed</button>
                    </div>
                        
                        
                    <div class="statsReport">
                            <div class="dashSelect" id="dashSelect">
                            
                                <table  class="table3" id="table3"      >
                                
                                <tr id="dataFromPhp">

                                                                                                                   
                                        <th>Date</th>
                                        <th>Category</th>
                                        <th>Product name</th>
                                        <th>Price</th>
                                </tr>
                                    <?php
                                            $currentPrice = 0;
                                            foreach ($feedback as $item):
                                                $prodPrice = (int) $item['price'];
                                                $X = $prodPrice;
                                                $tdFourContent = '';
                                                if ($X > $currentPrice) {
                                                    $tdFourContent = '<i class="fa-solid fa-caret-right fa-rotate-270 fa-xl" style="color: green;"></i>' . "      " . $prodPrice;
                                                    $currentPrice = $X;
                                                } else {
                                                    $tdFourContent = '<i class="fa-solid fa-caret-right fa-rotate-90 fa-xl" style="color: red;"></i>' . "      " . $prodPrice;
                                                    $currentPrice = $X;
                                                }
                                            ?>
                        
                                            <tr id="dataFromPhp">
                                                                                 
                                                
                                                <td><?php echo $item['date']; ?></td>
                                                <td><?php echo $item['category']; ?></td>
                                                <td><?php echo $item['productName']; ?></td>
                                                <td><?php echo $tdFourContent; ?></td>


                                            </tr>

                                    <?php endforeach; ?>
                                    
                                </table>

                                <table class="table4" id="table4"></table>
                                <table class="table5" id="table5"></table>
                                <table class="table6" id="table6"></table>

                            </div>
                    </div> 
            </div>
             

             <div class="profileUser" id="profileUser">

                   <div class="urProfile" id="urProfile">
                          <div id="b">
                                 
                          <div class="profile">
                                    <div id="proId">
                                        <i class="fa-solid fa-user-check fa-5xl"></i>                          
                                    </div>                                                                                 
                           </div>
                                    <div class="userData" id="userData">
                                        <h1 class="userName" id="uesrId" >Carl Conrad Declaro</h1>
                                    </div>
                                     
                                <div id="userStats" class="userStats">

                                            <div class="spendAday">
                                                <h2>Highest Spend A Day</h2> 
                                                <h4 id="highestDay">1200</h4> 
                                            </div>  
                                            <div class="spendAMonth">
                                                <h2>Highest Spend A Month</h2> 
                                                <h4 id="highestMonth">1200</h4> 
                                            </div>  
                                            <div class="spendAYear">
                                                <h2>Highest Spend A Year</h2> 
                                                <h4 id="highestYear">1200</h4> 
                                            </div>    
                                    
                               </div>
                         </div>

                            
                   </div>

                  

             </div>

    </div>





    <script src="expensesTracker.js?v=<?php echo time() ?>"></script>
    <script src="UpdateData.js?v=<?php echo time() ?>"></script>
</body>
</html>
 