document.addEventListener("DOMContentLoaded", () => {
    // Get all the "Update" links by class
    const updateLinks = document.querySelectorAll(".updateLink");
    const idVal = document.getElementById("id");
     // Attach a click event listener to each "Update" link
    updateLinks.forEach(updateLink => {
        updateLink.addEventListener("click", (event) => {
            event.preventDefault(); // Prevent default link behavior
            const id = updateLink.getAttribute("data-id"); // Get the ID from the data-id attribute
             idVal.value = id;
             document.getElementById("php").style.display = "none";
             document.getElementById("updateForm").style.display = "block"
        });
    });
});
