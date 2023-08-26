<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="insert.css?v=<?php echo time() ?>">
</head>
<body>
    
<div class="insert">
<h2>Insert Data</h2>

    <form action="expensesTracker.php" method="post" >

                
                
        <label for="prodName"> Product Name  </label>
        <input type="text" name="prodName" id=""      >
        
        <label for="prodPrice"> Price  </label>
        <input type="number" name="prodPrice" id=""     >

        <label for="cat"> Category </label>
        <select name="cat" id="cat"     >
            <option value="Food">Food</option>
            <option value="Transportation">Transportation</option>
            <option value="Drinks">Drinks</option>
            <option value="Online Expenses">Online Expenses</option>
            <!-- Add more options as needed -->
        </select>

            <div class="insert_btn" style="display: flex; justify-content: space-between;">
                <button type="submit" name="submit" id="submit">Submit</button>
                
            </div>

      

    </form>

</div>



</body>
</html>