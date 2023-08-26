 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User Information</title>
    <link rel="stylesheet" href="updateForm.css?v=<?php echo time() ?>">
</head>
<body>
  
<div class="updateFormContainer">

 
<h2>Update Data</h2>

    <form method="post" action="expensesTracker.php" id="updateForm">
        <label>Id:</label>
        <input type="number" name="id" id="id"><br>
        <label>Product Name:</label>
        <input type="text" name="Prodname" ><br>      
        <label>Price:</label>
        <input type="number" name="price"><br>
        <label for="cat2"> Category </label>
        <select name="cat2" id="cat2"     >
            <option value="Food">Food</option>
            <option value="Transportation">Transportation</option>
            <option value="Drinks">Drinks</option>
            <option value="Online Expenses">Online Expenses</option>
            <!-- Add more options as needed -->
        </select>
       
        <div class="insert_btn" style="display: flex; justify-content: space-between;">
            <button type="submit" name="submitt" id="submit">Submit</button>      
        </div>
    </form>
    </div>  
    <script src="UpdateData.js"></script>
</body>
</html>