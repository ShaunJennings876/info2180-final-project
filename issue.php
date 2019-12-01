<!DOCTYPE html>
<html>
<head>
        <title> Create Issue </title>
		<link rel="stylesheet" type="text/css" href="main.css">
		<link rel="stylesheet" type="text/css" href="issue.css">
    <!--<script type = "text/javascript" src = "scripts/loadpages.js"></script>-->
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
                                <a href = "signin.html">Logout</a>
                        </div>
                </div>
                </div>

        <div id="main">
    			<h1>Create Issue</h1>

          <form action = "scripts/new_issue.php" method = "post">
            <p>Title</p>
      			<input type="text" id = "title" class="title" name = "title">
      			<p>Description</p>
      			<input type="text" id = "description" class="description" name = "desc">
      			<p>Assigned To</p>
      			<select name="assigned_to">
              <?php
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
                    $sth = $conn -> query('SELECT id FROM BugMeDB.Users');
                    $rows = $sth -> fetchAll(PDO::FETCH_ASSOC);
                        for ($x = 0; $x < sizeof($rows); $x++) {
                            echo '<option value =' .$rows[$x]['id'].'>' .$rows[$x]['id'].'</option>';
                        }

                ?>
      				  </select>
      			<p> Type</p>
      			<select name="type">
      					<option value="bug">Bug</option>
      					<option value="proposal">Proposal</option>
      					<option value="task">Task</option>
      				  </select>
      			<p>Priority</p>
      			<select name="priority" class="selector">
      					<option value="minor">Minor</option>
      					<option value="major">Major</option>
      					<option value="critical">Critical</option>
      				  </select>
      				  <br>
      			<button id = "btn" class="submit" name = "submit"> Submit </button>
        </form>
        </div>

</body>
</html>
