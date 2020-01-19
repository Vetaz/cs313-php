<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylesheets.css">
    <link href="https://fonts.googleapis.com/css?family=Special+Elite&display=swap" rel="stylesheet">
    <title>Team Activity</title>
</head>

<body>
    <!-- Main header -->
    <h1 style="text-align:center; font-family: 'Special Elite', cursive;">PHP Team Activity</h1>
    <div class="container">
        <!--Creating the main content of the exercise-->
        <?php function multiDiv(){?>
            <h2>PHP Team Activity</h2>
        <?php
            for($i = 0; $i < 10; $i++){
                if ($i % 2 == 0) {
                    echo "<div style='color:red; font-family: 'Special Elite', cursive;'> This is div #" . $i . "</div>";
                } else {
                    echo "<div style='font-family: 'Special Elite', cursive;'> This is div #" . $i . "</div>";
                }
            }
        }
        ?> 
        <div class=contain>
            <?php multiDiv();?>
        </div>
        <div class=contain>
            <?php multiDiv();?>
        </div>
    </div>
    
</body>
</html>