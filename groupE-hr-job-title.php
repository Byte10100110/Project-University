<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Phalanx Security Job Title Search - Results</title>
   <link rel="stylesheet" type="text/css" href="groupE-hr-style.css">              
</head>

<body>
        <div class="container">
        <?php
        //declare database connection credential variables. We are using the database file hr.sql, so hr used for db. Including credentials in the php file is a security risk in the real world
        $server = "localhost";
        $user = "cti110";
        $pw = "wtcc";
        $db = "hr";

        //calling the mysqli_connect function to connect to the db. This function evaluates as true/false. True = connected
        $connect = mysqli_connect($server, $user, $pw, $db);

        //testing to see if connection is successful. If not successful, then the connection dies. 
        if(!$connect) {
            die("ERROR: Cannot connect to the database $db on the server $server using the username $user (".mysqli_connect_errno() . ", " .mysqli_connect_error().")");
        }

        //Setting up the SQL query as a string, including the inputs from the form page. CHANGE THIS TO CHANGE THE SQL QUERY
        //note the single quotes around the field values
        $job_title_search = $_POST['job_title_search'];
    
        $query = "SELECT employees.employee_id, employees.first_name, employees.last_name, employees.job_id, jobs.job_title, employees.salary, AVG(employees.salary)
                 FROM employees
                 JOIN jobs ON employees.job_id = jobs.job_id
                 WHERE job_title =  '$job_title_search'";
             
                  
        //to display results from multiple tables at once, the above JOIN clause joins the tables by their common field, the first table's primary key, found in the second table as a foreign key

    

        //calling mysqli_query() function to run the query and putting the results of the function into a variable named $result
        $result = mysqli_query($connect, $query);

        //test if the query has been executed successfully. If there was an error in the result's logic or syntax, then $!(result) = true, otherwise if there's no errors then the result will have data, and so !(result) = false
        if (!$result) {
            die("ERROR: Could not successfully run the query ($query) from $db: " . 
            mysqli_error($connect));
        }

        /* calling fetch_assoc() function to grab results and the average salary calculation from our SQL query
        then checking to see how many rows are returned in the user's query, and providing an apporpriate message to indicate the result status.
        If there are 0 records that meet the SELECT statement requirmement, print an error message.
        Otherwise if there are rows in the query results, we begin printing the result title */
        $avg_salary = "$".number_format(mysqli_fetch_assoc($result)['AVG(employees.salary)'], 2);
  
    
        if (mysqli_num_rows($result) == 0) {
            print ("No records found with the query $query");
        }
       else {
           print("
            <header>
            <h1>List of $job_title_search</h1>
            </header>" 
            . 
            "<main>
                   <table>
                        <caption>Average Salary Wage: $avg_salary </caption>
                <thead>
                    <tr><th>EMP ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Job Code</th>
                        <th>Job Title</th>
                        <th>Salary</th></tr>
                </thead>");

        /* next, we print the table rows using the fetch_assoc() function which puts the results into an associative array. 
        This way, we can use a while loop to loop through information from each desired column until there is no more data to display.
        Note that the concantenation symbol . is included */
       $row = mysqli_fetch_assoc($result);
        while ($row = mysqli_fetch_assoc($result)) 
        {
            //printing each column in the header row of the results table, then printing column of each row of the results table
            print 
            ("
            
                <tbody>
                        <tr><td>".$row['employee_id']."</td>" 
                          ."<td>".$row['first_name']."</td>"
                          ."<td>".$row['last_name']."</td>"
                          ."<td>".$row['job_id']."</td>"
                          ."<td>".$row['job_title']."</td>"
                          ."<td>".$row['salary']."</td></tr>
                </tbody>"
            );
        }

        //printing the end tag for the table only after the 'while' loop printing all the rows has finished
        print("</main></table>");

       }
        
       //close the connection
        mysqli_close($connect);

        ?>

         <br /> 
         <footer class="fctr">
          <p><a href="groupE-hr-job-title.html" class="white">Back to Search page</a></p>
          <p class="white">&copy;2022 by Group E</p>
        </footer>
      </div>
</body>
</html>