<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
// Connect to the database using PDO
include '../connection.php';

$dsn = "mysql:servername=$servername;dbname=$dbname";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];
try {
    $connection = new PDO($dsn, $username, $password, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

// No need to use mysqli for the same database connection, so remove these lines
// $conn = new mysqli($servername, $username, $password, $dbname);
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }

$sql = "SELECT center_no, school_name FROM schools";
$stmt = $connection->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>New Guardian Registration</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <link rel="stylesheet" type="text/css" href="../css/styles.css" />
</head>
<body>
<!-- Begin Wrapper -->
<!-- Begin Left Column -->
<?php
include 'sidemenu.php';
?>
  <div id="wrapper">
  <!-- End Left Column -->
  <!-- Begin Right Column -->

  <div class="rightcolumn" id="rightcolumn">
  <form action="New_Guardian_Contacts.php" method="POST">
           <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">New Guardian Registration</h4>
                    <p class="card-description">
                        Fill In The Details Below:
                    </p>
                   
                    <div class="form-group" style="display: flex; align-items: flex-start;">
                 
                        <div style="flex: 1; margin-right: 30px;">
                        
                        <span class="text-input">First Name</span>
                            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Input First Name" required>
                        </div>

                        <div style="flex: 1;">
                        <span class="text-input">Middle Name</span>
                            <input type="text" class="form-control" id="middle_name" name="middle_name" placeholder="Input Middle Name" required>
                        </div>
                        </div>
                        <div class="form-group">
                        <span class="text-input">Last Name</span>
                        <input type="text" class="form-control" id="last_name" name="last_name" style="width:100%" placeholder="Input Last Name" required>
                        </div>

                   <br><br>
                   <div class="form-group">
                    <span class="text-input">ID/Passport Number</span>
                        <input type="text" class="form-control" id="id_number" name="id_number" placeholder="Enter Your ID/Passport Number"  required>
                    </div>
                    <div class="form-group" style="display: flex; align-items: flex-start;">
                 
                 <div style="flex: 1; margin-right: 30px;">                
                 
                 <span class="text-input">Nationality</span>
    <select class="form-control" id="nationality" name="nationality" required>
        <option selected disabled value="">Select Nationality</option>
        <option value="Botswana">Botswana</option>
        <option value="United States">United States</option>
        <option value="Canada">Canada</option>
        <option value="United Kingdom">United Kingdom</option>
        <option value="France">France</option>
        <option value="Germany">Germany</option>
        <option value="Australia">Australia</option>
        <option value="China">China</option>
        <option value="India">India</option>
        <option value="Brazil">Brazil</option>
        <option value="South Africa">South Africa</option>
        <option value="Russia">Russia</option>
        <option value="Japan">Japan</option>
        <option value="Argentina">Argentina</option>
        <option value="Mexico">Mexico</option>
        <option value="Spain">Spain</option>
        <option value="Italy">Italy</option>
        <option value="South Korea">South Korea</option>
        <!-- Add more countries above as needed -->
    </select>
</div>

                 <div style="flex: 1;">
                 <span class="text-input">Language</span>
    <select class="form-control" id="language" name="language" required>
        <option selected disabled value="">Select Language</option>
        <option value="Setswana">Setswana</option>
        <option value="English">English</option>
        <!-- Add more languages above as needed -->
    </select>
</div>

</div>

<div class="form-group" style="display: flex; align-items: flex-start;">
                 
                        <div style="flex: 1; margin-right: 30px;">
                        
                        <span class="text-input">Date Of Birth</span>
                        <input type="date" class="form-control" id="birth_date" name="birth_date" placeholder="Enter Date Of Birth" required>
                    </div>

                        <div style="flex: 1;">
                        <span class="text-input">Gender</span>
                            <select class="form-control" id="gender" name="gender" required>
                                <option selected disabled value="">Select Your Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>                                
                                <option value="Others">Others </option>                                
                                <option value="Rather Not Say">Rather Not Say</option> 
                            </select> </div>
                        </div>

                        
<div class="form-group" style="display: flex; align-items: flex-start;">
                 
                 <div style="flex: 1; margin-right: 30px;">
                 <span class="text-input">Occupation</span>
    <input type="Text" class="form-control" id="occupation" name="occupation" placeholder="Enter Your Occupational Area" required>

                
             </div>

                 <div style="flex: 1;">
                 <span class="text-input">Date Of Employment</span>
                 <input type="date" class="form-control" id="employment_date" name="employment_date" required>
                </div>
                 </div>

<br><br>
<div class="form-group">
    <span class="text-input">School Name</span>
    <select class="form-control" id="center_no" name="center_no">
        <option value="">--Select School--</option>
        <?php 
            foreach ($result as $row) { 
        ?>
            <option value="<?php echo $row['center_no']; ?>"><?php echo $row['school_name']; ?></option>
        <?php
            }
        ?>
    </select>
</div>
<div class="form-group">
    <span class="text-input">Selected School Center Number</span>
<input type="text" class="form-control" id="selected_school" readonly>
</div>
<div class="form-group" style="display: flex; align-items: flex-start;">
    <div style="flex: 1; margin-right: 30px;">
        <span class="text-input">Student Name</span>
        <select class="form-control" id="student" name="student">
            <option selected disabled value="">--Select Student Name--</option>
            <!-- Options will be populated dynamically using JavaScript -->
        </select>
    </div>



                        <div style="flex: 1;">
                        <span class="text-input">Relation To Student</span>
    <select class="form-control" id="relationship" name="relationship" required>
        <option selected disabled value="">Select the relationship</option>
        <option value="Father">Father</option>
        <option value="Mother">Mother</option>
        <option value="Step Father">Step Father</option>
        <option value="Step Mother">Step Mother</option>
        <option value="God Parent">God Parent</option>
        <option value="Uncle">Uncle</option>
        <option value="Auntie">Auntie</option>
        <option value="Grand Parent<">Grand Parent</option>
        <!-- Add more relationship below -->
        
    </select>
</div> 
                        </div>

                                              
                        <div class="form-group">
                        <span class="text-input">Marital Status</span>
                            <select class="form-control" id="m_status" name="m_status" required>
                                <option selected disabled value="">Select Marital Status</option>
                                <option value="Single">Single</option>
                                <option value="Married">Married</option>                                
                                <option value="Divorced">Divorced </option>                                
                                <option value="Complicated">Complicated</option> 
                            </select>
                        </div> 
                       
                    <p class="card-description">
                        NB: All fields in this form are reuired
                    </p>                   
                </div>
            </div>
        </div>

        <div  style="width:25%;  margin-left: 50%;">
            <div style="text-align: center;">
               <button type="submit" class="action-button next next-step">Next</button>
             </div>
        </div>
    
   

   
</form>
</div>

  
  <!-- End Right Column -->
  <!-- Begin Footer -->
  <div id="footer"style="text-align: center;">
  <p>© 2020 All Rights Reserved. <a href="https://forgewiz.co.bw/" style="color: white;">Forge Wiz</a></p>
</div>  <!-- End Footer -->
 </div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // When the first select box changes
    $("#center_no").change(function() {
        var selectedSchool = $(this).val(); // Get the selected school name
        $("#selected_school").val(selectedSchool); // Set the selected school name in the input field
    });
});

$(document).ready(function() {
    // Function to fetch student details based on selected school
    function fetchStudentDetails(selectedSchool) {
        // Send an AJAX request to retrieve student values based on the selected school
        $.ajax({
            url: "fetchstudent.php",
            method: "POST",
            data: { school: selectedSchool },
            dataType: "json",
            success: function(response) {
                // Clear the student dropdown
                $("#student").empty();
                $("#student").append('<option value="">--Select Student Name--</option>');

                // Populate the student dropdown with retrieved values
                $.each(response, function(index, data) {
                    $("#student").append('<option value="' + data.user_id + '">' + data.last_name + '</option>');
                });
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }

    // Listen for input changes in the selected_school field
    $("#selected_school").on('input', function() {
        var selectedSchool = $(this).val(); // Get the input value

        // Call the fetchStudentDetails function with the selected school value
        fetchStudentDetails(selectedSchool);
    });
});
</script>


</body>
</html>
