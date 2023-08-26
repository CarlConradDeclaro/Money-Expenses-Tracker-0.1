

var currentDate = new Date();
var day = currentDate.getDate();
var nextDay = currentDate.getDate()+1;
var month = currentDate.getMonth() + 1;  
var year = currentDate.getFullYear();


const category = document.getElementById("cars");
const productName = document.getElementById("productName");
const productPrice = document.getElementById("productPrice");




const Month= ["January","Febuary","March","April","May","June","July","August","September","October","November","December"];
document.getElementById("month").innerHTML = Month[month - 1];
document.getElementById("day").textContent =  Month[month-1] +" " + day ;
document.getElementById("year").innerText = year;


var dayAmt = document.getElementById("dAmt");
var dayMamt = document.getElementById("mamt");

var dayExpenses = 0;
var monthExpenses =0;
var yearExpenses = 0;


 

 

 
// update the date
document.getElementById("dashboard").addEventListener("click", ()=> {
    document.getElementById("expenses-dashboard").style.display = "block";
    document.getElementById("main").style.display = "none";
    document.getElementById("Expenses").style.display= "none";
    document.getElementById("profileUser").style.display= "none";

})

document.getElementById("expenses").addEventListener("click", ()=> {
    document.getElementById("expenses-dashboard").style.display = "none";
    document.getElementById("main").style.display= "block";
    document.getElementById("Expenses").style.display= "none";
    document.getElementById("profileUser").style.display= "none";

})

document.getElementById("expenses-report").addEventListener("click", ()=> {
    document.getElementById("expenses-dashboard").style.display = "none";
    document.getElementById("main").style.display = "none";
    document.getElementById("Expenses").style.display= "block";
    document.getElementById("profileUser").style.display= "none";

})


document.getElementById("profile").addEventListener("click",()=>{
    document.getElementById("expenses-dashboard").style.display = "none";
    document.getElementById("main").style.display = "none";
    document.getElementById("Expenses").style.display= "none";
    document.getElementById("profileUser").style.display= "block";
})


 

//close & Open
var isClose = true;
function closeNav(){

    if(isClose){
        document.getElementById("sideBar").style.width = "0px";
        isClose = false;    
    }else{
        document.getElementById("sideBar").style.width = "250px";
        isClose =true;        
    }

}
const table = document.getElementById("table3");


const currentDat = new Date().toLocaleDateString('en-CA');

// the first date 
let tableLength = table.rows.length;
const dateStart = table.rows[tableLength-1].cells[0].textContent;
const yearStart = dateStart.substring(0,4);
const montStart = dateStart.substring(5,7);
const dayStart = dateStart.substring(8,10);

 
const todayAmount = document.getElementById("dAmt");
const monthAmount = document.getElementById("mamt");
const yearAmount = document.getElementById("yAmt");

 

const currentDay=  currentDat.substring(8,10);
const currentMonth = currentDat.substring(5,7);
const currentYear = currentDat.substring(0,4);

function getTotal(currentMonth,x,y){
                
    let monthTotal = 0;

    for (let i = 0; i < table.rows.length; i++) {
        let dataCell = table.rows[i].cells[0];
        let date = dataCell.textContent.substring(x,y);

        if (date === currentMonth) {
            let priceCell = table.rows[i].cells[3];
            let price = parseInt(priceCell.textContent);
            monthTotal += price;
        }
    }
  return monthTotal
 }
 
 todayAmount.innerText  =getTotal(currentDay,8,10)
 monthAmount.innerText =getTotal(currentMonth,5,7);
 yearAmount.innerText = getTotal(currentYear,0,4);



 const TotableDay = document.getElementById("table4");
 const TotableMonth = document.getElementById("table5");
 const TotableYear = document.getElementById("table6");



let highestDay =0; 
let highestMonth =0;
let highestYear =0;

function displayTableDay(TotableDay,x,y) {
    let currentDay = "";
    let monthTotal = 0;
    let highestAmt = 0; // Initialize the highest amount outside the loop


    const newtr = document.createElement("tr");
       const newtdDay = document.createElement("th");
       newtdDay.textContent = "Date";
       const newtdPrice = document.createElement("th");
       newtdPrice.textContent = "Total";
       newtr.appendChild(newtdDay);
       newtr.appendChild(newtdPrice);
       TotableDay.appendChild(newtr);
       
       
    for (let i = 1; i < table.rows.length; i++) {
        const dataCell = table.rows[i].cells[0];
        const date = dataCell.textContent.substring(x,y);

        if (date === currentDay) {
            let priceCell = table.rows[i].cells[3];
            let price = parseInt(priceCell.textContent);
            monthTotal += price;
            
        } else {
            // Create a new row with the current day and its total
            if (currentDay !== "") {
                const newRow = document.createElement("tr");

                const dCell = document.createElement("td");
                dCell.textContent = currentDay;
                newRow.appendChild(dCell);

                const pCell = document.createElement("td");
                pCell.textContent = monthTotal;
                newRow.appendChild(pCell);

                TotableDay.appendChild(newRow);

                // Highest Amount
                 if (monthTotal > highestAmt) {
                highestAmt = monthTotal;
            }
            }

            // Update the current day and reset the monthTotal
            currentDay = date;
            let priceCell = table.rows[i].cells[3];
            monthTotal = parseInt(priceCell.textContent);
              
           
        }
    }

    // Create the last row for the last date
    if (currentDay !== "") {
        const newRow = document.createElement("tr");

        const dCell = document.createElement("td");
        dCell.textContent = currentDay;
        newRow.appendChild(dCell);

        const pCell = document.createElement("td");
        pCell.textContent = monthTotal;
        newRow.appendChild(pCell);

        TotableDay.appendChild(newRow);

          // Update the highest amount if needed
          if (monthTotal > highestAmt) {
            highestAmt = monthTotal;
        }

        
    }
    
    if(y == 4){
        highestYear = highestAmt;
    }else if(y== 7){
        highestMonth = highestAmt
    }else if(y ==10){
        highestDay = highestAmt;
    }
  
  }
 
  displayTableDay(TotableDay,0,10);
  displayTableDay(TotableMonth,0,7);
  displayTableDay(TotableYear,0,4);
   


  document.getElementById("table3").style.display= "block";
  
  document.getElementById("getStatsReport").addEventListener("click", ()=> {
    const choices = document.getElementById("Stats");
    const userChoice = choices.value;
    document.getElementById("table3").style.display= "block";
   
    if(userChoice == "Day"){      
        document.getElementById("table3").style.display= "none";
        document.getElementById("table4").style.display = "block";
        document.getElementById("table5").style.display = "none";
        document.getElementById("table6").style.display= "none";
    }else if(userChoice == "Month"){
        document.getElementById("table3").style.display= "none";
        document.getElementById("table4").style.display = "none";
        document.getElementById("table5").style.display = "block";
        document.getElementById("table6").style.display= "none";
    }else if(userChoice == "Year"){
        document.getElementById("table3").style.display= "none";
        document.getElementById("table4").style.display = "none";
        document.getElementById("table5").style.display = "none";
        document.getElementById("table6").style.display= "block";
    }else if(userChoice == "In-Day"){
        document.getElementById("table3").style.display= "block";
        document.getElementById("table4").style.display = "none";
        document.getElementById("table5").style.display = "none";
        document.getElementById("table6").style.display= "none";
      
    }

})



const reportYears = document.getElementById("reportYears");

function getReport(whatTable,x,y){

    for (let i = 1; i < whatTable.rows.length; i++) {
        const daysOption = document.createElement("option");
            let getday = whatTable.rows[i].cells[0];
            let setday = getday.textContent.substring(x,y);
            daysOption.textContent = setday;
            daysOption.value = setday;
            reportYears.appendChild(daysOption);
     }
}

getReport(TotableYear,0,4);


const reportMonth = document.getElementById("reportMonth");
function CreateMonths(){
    for (let i = 1; i <= 12; i++) {
        const creatMonth = document.createElement("option");
        creatMonth.textContent = Month[i-1];
        let x = i<10 ? "0"+i : i;
        creatMonth.value=x;
        reportMonth.appendChild(creatMonth);
    }
}
CreateMonths();


const reportDay = document.getElementById("reportDay");
function CreateDays(){
    for (let i = 1; i <= 31; i++) {
        const creatMonth = document.createElement("option");
        creatMonth.textContent = i;
        let x = i<10 ? "0"+i : i;
        creatMonth.value=x;
        reportDay.appendChild(creatMonth);
    }
}

CreateDays();




 

function getItems(){
   
    
  const selectedItem = document.getElementById("table2");  
  let itemYears = reportYears.value;
  let itemMonth = reportMonth.value;
  let itemtDay = reportDay.value;
 const  total = document.getElementById("track-expensTots");
  
   let totalX=0;
  while (selectedItem.rows.length > 1) {
    selectedItem.deleteRow(1); // Deleting rows starting from index 1 (excluding header row)
  }

  const dateSelected = itemYears+"-"+itemMonth+"-"+itemtDay;
 
  for (let i = 1; i < table.rows.length; i++) {
    const dataCell = table.rows[i].cells[0];
    const date = dataCell.textContent.substring(0,10);
   


    if (dateSelected === date ) {
       
        const newRow = document.createElement("tr");


        const dateCell = document.createElement("td");
        dateCell.textContent = table.rows[i].cells[0].textContent;
        newRow.appendChild(dateCell);

        const categoryCell = document.createElement("td");
        categoryCell.textContent = table.rows[i].cells[1].textContent;
        newRow.appendChild(categoryCell);

        const prodNameCell = document.createElement("td");
        prodNameCell.textContent = table.rows[i].cells[2].textContent;
        newRow.appendChild(prodNameCell);

        const priceCell = document.createElement("td");
        priceCell.textContent = table.rows[i].cells[3].textContent;
        newRow.appendChild(priceCell);
        let price = parseInt(priceCell.textContent);
         totalX+=price;
        selectedItem.appendChild(newRow);
    }
 }
    
     total.textContent = "Total: "  + totalX;
}

document.getElementById("highestDay").innerText = highestDay;
document.getElementById("highestMonth").innerText = highestMonth;
document.getElementById("highestYear").innerText = highestYear;























 
  