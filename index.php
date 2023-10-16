<?php
    include('system/config.php');

    $table_name = 'record';
    $sql = "SELECT * FROM $table_name ORDER BY score DESC";
    $result = $conn->query($sql);

    if (!$result->num_rows > 0) {
        echo "No records found.";
    }

    function timeAgo($timestamp)
    {
        $current_time = time();
        $time_diff = $current_time - ($timestamp / 1000);

        if ($time_diff < 60) {
            return "Just now";
        } elseif ($time_diff < 3600) {
            $minutes = floor($time_diff / 60);
            return $minutes . " minute" . ($minutes > 1 ? "s" : "") . " ago";
        } elseif ($time_diff < 86400) {
            $hours = floor($time_diff / 3600);
            return $hours . " hour" . ($hours > 1 ? "s" : "") . " ago";
        } else {
            $days = floor($time_diff / 86400);
            return $days . " day" . ($days > 1 ? "s" : "") . " ago";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p>Elapsed Time: <span id="playtime"></span>s</p>
    <p>Score: <span id="score"></span></p>
    <button id="startButton" type="submit">Start Time</button>
    <button id="stopButton" type="submit">Stop Time</button>
    <button id="addScoreButton" type="submit">Add Score</button>
    
    <input id="username" type="text" placeholder="username">
    <button id="submitButton" type="submit">Submit</button>
    <button id="reloadButton" type="submit">Reload</button>

    <br><br>
    
    <table border="1">
        <tr>
            <th>id</th>
            <th>username</th>
            <th>time</th>
            <th>score</th>
            <th>created_at</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()):?>
        <tr>
            <td><?= $row['id']; ?></td>
            <td><?= $row['username']; ?></td>
            <td><?= $row['time']; ?></td>
            <td><?= $row['score']; ?></td>
            <td><?= timeAgo($row['created_at']); ?></td>
        </tr>
        <?php endwhile; ?>
    </table>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="./crud.js"></script>
</body>
</html>