function filterTableByBrand() {
    // Variables
    let dropdown, table, rows, cells, brand, filter;
    dropdown = document.getElementById("carsBrandDropdown");
    table = document.getElementById("cars");
    rows = table.getElementsByTagName("tr");
    filter = dropdown.value;

    // Loops through rows and hides those with countries that don't match the filter
    for (let row of rows) { // `for...of` loops through the NodeList
        cells = row.getElementsByTagName("td");
        brand = cells[0] || null; // gets the first `td` or nothing
        // if the filter is set to 'All', or this is the header row, or 2nd `td` text matches filter
        if (filter === "All" || !brand || (filter === brand.textContent)) {
            row.style.display = ""; // shows this row
        } else {
            row.style.display = "none"; // hides this row
        }
    }
}

function filterTableByManufacturer() {
    // Variables
    let dropdown, table, rows, cells, manufacturer, filter;
    dropdown = document.getElementById("carsManufacturerDropdown");
    table = document.getElementById("cars");
    rows = table.getElementsByTagName("tr");
    filter = dropdown.value;

    // Loops through rows and hides those with countries that don't match the filter
    for (let row of rows) { // `for...of` loops through the NodeList
        cells = row.getElementsByTagName("td");
        manufacturer = cells[2] || null; // gets the 2nd `td` or nothing
        // if the filter is set to 'All', or this is the header row, or 2nd `td` text matches filter
        if (filter === "All" || !manufacturer || (filter === manufacturer.textContent)) {
            row.style.display = ""; // shows this row
        } else {
            row.style.display = "none"; // hides this row
        }
    }
}

function filterTableByYear() {
    // Variables
    let dropdown, table, rows, cells, year, filter;
    dropdown = document.getElementById("carsYearDropdown");
    table = document.getElementById("cars");
    rows = table.getElementsByTagName("tr");
    filter = dropdown.value;

    // Loops through rows and hides those with countries that don't match the filter
    for (let row of rows) { // `for...of` loops through the NodeList
        cells = row.getElementsByTagName("td");
        year = cells[3] || null; // gets the 3rd `td` or nothing
        // if the filter is set to 'All', or this is the header row, or 2nd `td` text matches filter
        if (filter === "All" || !year || (filter === year.textContent)) {
            row.style.display = ""; // shows this row
        } else {
            row.style.display = "none"; // hides this row
        }
    }
}