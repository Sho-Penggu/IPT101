<?php
    include('config.php');

    if(isset($_POST['categoryID'])) {
        $selectedCategoryID = $_POST['categoryID'];
        
        if ($selectedCategoryID === '') {
            // If "Select A Category" is chosen, fetch all data from the contestantcategory table
            $query = "SELECT * FROM contestantcategory 
                      JOIN contestant ON contestant.ContestantID = contestantcategory.ContestantID 
                      JOIN category ON category.CategoryID = contestantcategory.CategoryID 
                      ORDER BY TitleID, ContestantName, CategoryName ASC";
        } else {
            // Fetch data based on the selected category
            $query = "SELECT * FROM contestantcategory 
                      JOIN contestant ON contestant.ContestantID = contestantcategory.ContestantID 
                      JOIN category ON category.CategoryID = contestantcategory.CategoryID 
                      WHERE category.CategoryID = $selectedCategoryID 
                      ORDER BY TitleID, ContestantName, CategoryName ASC";
        }

        $result = mysqli_query($dbcon, $query);

        // Generate HTML for filtered table rows
        $output = '';
        while ($row = mysqli_fetch_array($result)) {
            $output .= "<tr>";
            $output .= "<td>".$row['ContestantCategoryID']."</td>";
            $output .= "<td>".$row['ContestantName']."</td>";
            $output .= "<td>".$row['CategoryName']."</td>";
            $output .= "<td style=display:none;>".$row['TitleID']."</td>";
            $output .= "</tr>";
        }

        echo $output;
    }
?>
