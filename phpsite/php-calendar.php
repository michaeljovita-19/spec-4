<?php
    date_default_timezone_set("Asia/Manila");

    $time = date("h-i-s A");

    if($_GET){
        $currentDate = getdate($_GET["timestamp"]);
        $currentTimeStamp = intval($_GET["timestamp"]);

        $today = strtotime("today");
        $lastMonthDate = mktime(0, 0, 0, $currentDate["mon"]-1, $currentDate["mday"], $currentDate["year"]);
        $nextMonthDate = mktime(0, 0, 0, $currentDate["mon"]+1, $currentDate["mday"], $currentDate["year"]);
        
        $numOfDayForThisMonth = ($nextMonthDate - $currentTimeStamp) /3600 /24;
        $startingWeekDay = getdate(mktime(0, 0, 0, $currentDate["mon"],1, $currentDate["year"]));
    }else{
        $currentDate = getdate();
        $currentTimeStamp = time();

        $lastMonthDate = strtotime("last month");
        $nextMonthDate = strtotime("next month");
        
        $numOfDayForThisMonth = ($nextMonthDate - $currentTimeStamp) /3600 /24;
        $startingWeekDay = getdate(mktime(0, 0, 0, $currentDate["mon"],1, $currentDate["year"]));
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Calendar</title>
    <style>
        #cal-table{
            margin: 0 auto;
            width: 99vw;
            font-family: verdana, geneva, tahoma, sans-serif;
            font-size: 1.8rem;
            table-layout: fixed;
        }

        #cal-table tr:first-of-type{
            background-color: skyblue;
            font-size: 2rem;
            text-align: center;
        }

        tr:first-of-type{
            /* display: inline-block; */
            width: 100%;
            text-decoration: none;
            color: black;
        }

        tr:first-of-type a:hover{
            color: white;
            background-color: blue;
        }

        .day-headings{
            text-align: center;
            font-weight: 0;
            border-bottom: 1px solid black;
        }

        .day-cells{
            /* width: 2.5rem; */
            height: 4em;
            line-height: 4em;
            vertical-align: center;
            border: 1px solid black;
            text-align: center;
        }

        .day-cell{
            height: 4em;
            line-height: 4em;
            vertical-align: center;
            border: 1px solid black;
            text-align: center;
            background-color: gray;
        }

        .day-cell:hover{
            background-color: pink;
            transition: .9s;
        }
    </style>
</head>
<body>
    <table id="cal-table">
        <tr>
            <td><a href="<?php echo $_SERVER["PHP_SELF"]. "?timestamp=".$lastMonthDate ?>"><< Previous</a></td>
            <td><a href="<?php echo $_SERVER["PHP_SELF"]. "?timestamp=".$today ?>">Today</a></td>
            <th colspan="3"><?php echo $currentDate["month"].",".$currentDate["year"] ?></th>
            <td><?php echo $time?></td>
            <td><a href="<?php echo $_SERVER["PHP_SELF"]."?timestamp=".$nextMonthDate ?>">Next >></a></td>
        </tr>
        <tr>
            <td class="day-headings">Sunday</td>
            <td class="day-headings">Monday</td>
            <td class="day-headings">Tuesday</td>
            <td class="day-headings">Wednesday</td>
            <td class="day-headings">Thursday</td>
            <td class="day-headings">Friday</td>
            <td class="day-headings">Saturday</td>
        </tr>

        <?php 
        function renderColumn($repeat = null, $dayOfWeek = null){
            $today = date("d");
            if($repeat > 0 || $repeat !== null){
                for($repetition = 0; $repetition < $repeat; $repetition++){
                    echo "\t<td class=\"day-cells\">\n";
                    if($repetition === ($repeat)){
                        echo "\t\t".$dayOfWeek."\n";
                    }else{
                        echo "&nbsp;";
                    }
                    echo "\t</td>\n";
                }
            }else{
                if($today == $dayOfWeek){
                    echo "\t<td class=\"day-cell\" style=\"font-size: 2rem;\"><b>\n";
                    echo "\t\t".$dayOfWeek."\n";
                    echo "\t</b></td>\n";
                }else{
                    echo "\t<td class=\"day-cells\">\n";
                    echo "\t\t".$dayOfWeek."\n";
                    echo "\t</td>\n";
                }
            }
        }

        $dayCounter = 1;
        $daysInWeek = 7;
        $endRendering = false;


        while($dayCounter <= $numOfDayForThisMonth){
            $colCounter = 0;
            echo "<tr>\n";
            while($colCounter < $daysInWeek){
                if($colCounter === 0 && $dayCounter === 1){
                    match($startingWeekDay["wday"]){
                        0 => renderColumn(0, $dayCounter),
                        1 => renderColumn(1, $dayCounter),
                        2 => renderColumn(2, $dayCounter),
                        3 => renderColumn(3, $dayCounter),
                        4 => renderColumn(4, $dayCounter),
                        5 => renderColumn(5, $dayCounter),
                        6 => renderColumn(6, $dayCounter),
                    };
                    $colCounter += $startingWeekDay["wday"];
                }
                if($dayCounter === $numOfDayForThisMonth){
                renderColumn(null, $dayCounter);
                $endRendering = true;
                break;
                }else{
                    renderColumn(null, $dayCounter);
                    $colCounter++;
                    $dayCounter++;
                }
            }
            echo "</tr>\n";
            if($endRendering){
                break;
            }
        }
        ?>
    </table>
    
</body>
</html>