<html>
<head>
<Title>Search Page</Title>
<style type="text/css">
    body { background-color: #fff; border-top: solid 10px #000;
        color: #333; font-size: .85em; margin: 20; padding: 20;
        font-family: "Segoe UI", Verdana, Helvetica, Sans-Serif;
    }
    h1, h2, h3,{ color: #000; margin-bottom: 0; padding-bottom: 0; }
    h1 { font-size: 2em; }
    h2 { font-size: 1.75em; }
    h3 { font-size: 1.2em; }
    table { margin-top: 0.75em; }
    th { font-size: 1.2em; text-align: left; border: none; padding-left: 0; }
    td { padding: 0.25em 2em 0.25em 0em; border: 0 none; }
</style>
</head>
<body>
<h1>Search!</h1>
<p>You  may search by name.</p>
<form method="post" action="index.php" enctype="multipart/form-data" >
      Search:  <input type="text" name="name" id="name"/></br>
      <input type="submit" name="submit" value="Submit" />
</form>


<?php
    //just a comment, to test that deployment to git works

    // DB connection info
    //TODO: Update the values for $host, $user, $pwd, and $db
    //using the values you retrieved earlier from the portal.
    $host = "eu-cdbr-azure-west-b.cloudapp.net";
    $user = "b4b8f40507061d";
    $pwd = "1efe0b7d";
    $db = "kareemdbtest";
    // Connect to database.
    try {
        $conn = new PDO( "mysql:host=$host;dbname=$db", $user, $pwd);
        $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    }
    catch(Exception $e){
        die(var_dump($e));
    }
    // Insert registration info
    if(!empty($_POST)) {
    try {
              // Retrieve data
              $name = $_POST['name'];
              $sql_select = "SELECT * FROM registration_tbl WHERE name LIKE '%" . $name .  "%' OR email LIKE '%" . $name ."%'  OR company LIKE '%" . $name ."%'";
              $stmt = $conn->query($sql_select);
              $registrants = $stmt->fetchAll(); 
              if(count($registrants) > 0) {
                  echo "<h2>Search results:</h2>";
                  echo "<table>";
                  echo "<tr><th>Name</th>";
                  echo "<th>Email</th>";
                  echo "<th>Date</th>";
                  echo "<th>Company</th></tr>";
                  foreach($registrants as $registrant) {
                      echo "<tr><td>".$registrant['name']."</td>";
                      echo "<td>".$registrant['email']."</td>";
                      echo "<td>".$registrant['date']."</td>";
                      echo "<td>".$registrant['company']."</td></tr>";
                  }
                  echo "</table>";
              } else {
                  echo "<h3>No search results found.</h3>";
              }
    }
    catch(Exception $e) {
        die(var_dump($e));
    }
    echo "<h3>search completed</h3>";
    }

?>
</body>
</html>