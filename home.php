<!DOCTYPE html>
<html>
<head>
        <title>Home</title>
		<link rel="stylesheet" type="text/css" href="main.css">
		<link rel="stylesheet" type="text/css" href="home.css">
    <link rel="stylesheet" type="text/css" href="newUserScreen.css">
    <link rel="stylesheet" type="text/css" href="issue.css">
    <script type = "text/javascript" src = "scripts/load_desc.js"></script>
</head>
<body>

    <div class="header">
        <a href="newUserScreen.html"><img id="logo" src= "bug.png" width= 40px height=40px></a>
        <h2>BugMe Issue Tracker</h2>
    </div>

    <div class="sidebar">
                <div class="sidebar_container">
                        <div class="sideItems">
                                <img id="home" src= "home.png" width= 20px height=20px>
                                <a href = "home.php" id = "homelink">Home</a>
                        </div>

                        <div class="sideItems">
                                <img id="phone" src= "addUser.png" width= 20px height=20px>
                                <a href = "newUserScreen.html" id = "userlink">Add User</a>
                        </div>
                        <div class="sideItems">
                                <img id="phone" src= "plus.png" width= 20px height=20px>
                                <a href = "issue.php" id = "issuelink">New Issue</a>
                        </div>
                        <div class="sideItems">
                                <img id="phone" src= "logout.png" width= 20px height=20px>
                                <a href = "signin.html" id = 'logout'>Logout</a>
                        </div>
                </div>
                </div>

    <div class="main">
        <div class="top">
			<h1>Issues</h1>
			<button  class="newIssue" onclick="window.location.href= 'issue.php';">Create New Issue</button>
        </div>

        <ul id="aboveTitles">
    			<li>Filter by: </li>
    			<li id="activeTicket">all</li>
    			<li>open</li>
    			<li>my tickets</li>
        </ul>

        <table>
          <!--Table Heading-->
          <tr class = "tablehead">
            <th>Title</th>
            <th>Type</th>
            <th>Status</th>
            <th>Assigned To</th>
            <th>Created</th>
          </tr>


          <?php
            session_start();
            $dbname = 'BugMeDB';
            $host = 'localhost';
            $username = '';
            $password = '';
                try {
                  $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
                  // set the PDO error mode to exception
                  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                  }
                catch(PDOException $e)
                    {
                    echo "Connection failed: " . $e->getMessage();
                    }
                $sth = $conn -> query('SELECT id,title,type,status,assigned_to,created,description FROM BugMeDB.Issues');
                $rows = $sth -> fetchAll(PDO::FETCH_ASSOC);
                    for ($x = 0; $x < sizeof($rows); $x++) {
                        echo '<tr>';
                        echo '<form action = "description.php" action = "post">';
                        echo '<td>#'. $rows[$x]['id'] .'<a href = "#" class = "title">'.$rows[$x]['title'].'</a></td>';
                        echo '</form>';
                        echo '<td>'. $rows[$x]['type'] .'</td>';
                        echo '<td>'. $rows[$x]['status'] .'</td>';
                        echo '<td>'. $rows[$x]['assigned_to'] .'</td>';
                        echo '<td>'. $rows[$x]['created'] .'</td>';
                        echo '</tr>';
                    }

            ?>

        </table>

        <!--<ul class="titles">
                <li>Title</li>
                <li>Type</li>
                <li>Status</li>
                <li>Assigned To</li>
                <li>Created</li>
        </ul>-->

    </div>

</body>
</html>
