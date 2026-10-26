<?php
// apply.php - Job application form.
// Part 1 fields 1-6 (Job Reference, First Name, Last Name, Date of Birth, Gender, Street Address): Priyankha Sakthivel
// Part 1 fields 7-13 (Suburb, State, Postcode, Email, Phone, Skills, Other Skills): Kevin Tan
$page_title = "Apply | HireHub";
$body_class = "apply-page";
include 'header.inc';
?>
    <main>
        <h1>Job Application Page</h1>
        <p>Please fill out the form below to apply for a position via our company.</p>
        <p class="required-note"><strong>All fields marked with an asterisk (*) are required.</strong></p>

    <form method="post" action="process_eoi.php">
        <fieldset>
            <legend class="legend-spaced">Job Reference</legend>
            <p>
                <label for="jobRef">Job Reference Number *</label>
                <select id="jobRef" name="jobRef" required>
                    <option value="" selected disabled> Please select a position</option>
                <?php 
                    require_once 'settings.php';
                    $conn = @mysqli_connect($host, $user, $pwd, $sql_db);
                
                if ($conn) {
                    $query = "SELECT jobRef, title FROM jobs";
                    $result = mysqli_query($conn, $query);
                    $checkedJobRef = $_POST['jobRef'] ?? $_GET['job'] ?? '';
                    
                
                    while($row = mysqli_fetch_assoc($result)) {
                        $jobRef = htmlspecialchars($row['jobRef']);
                        $title = htmlspecialchars($row['title']);

                        $selected = ($checkedJobRef == $row['jobRef']) ? 'selected' : '';
                        echo "<option value=\"$jobRef\" $selected>$jobRef - $title</option>";
                    }

                    mysqli_free_result($result);
                    mysqli_close($conn);
                }
                ?> 
                </select>
            </p>
        </fieldset>

        <fieldset>
            <legend>Personal Information</legend>
       
            <p>
                <label for="firstName">First Name *&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                <input type="text" id="firstName" name="firstName" pattern="[A-Za-z]{1,20}" maxlength="20" value="<?php echo htmlspecialchars($_POST['firstName'] ?? ''); ?>" required style="width:1130px;">
            </p>

            <p>
                <label for="lastName">Last Name *</label>
                <input type="text" id="lastName" name="lastName" pattern="[A-Za-z]{1,20}" maxlength="20" value="<?php echo htmlspecialchars($_POST['lastName'] ?? ''); ?>" required style="width:1130px;">
            </p>

            <p>
                <label for="dob">Date of Birth *</label>
                <!-- GenAI (Claude) suggested adding inputmode="numeric" to trigger a numeric keypad on mobile devices for this date field -->
                <input type="text" id="dob" name="dob" placeholder="dd/mm/yyyy" value="<?php echo htmlspecialchars($_POST['dob'] ?? ''); ?>" inputmode="numeric" required style="width:1130px;">
            </p>
            
            <p>
                <label for="email">Email *</label>
                <input type="email" id="email" name="email" inputmode="email" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" required style="width:1130px;">
            </p>

            <p>
                <label for="phoneNum">Phone Number *</label>
                <input type="text" id="phoneNum" name="phoneNum" pattern="[0-9]{8,12}" maxlength="12" value="<?php echo htmlspecialchars($_POST['phoneNum'] ?? ''); ?>" inputmode="tel" required style="width:1130px;">
            </p>

        </fieldset>

        <fieldset>
            <legend>Gender *</legend>
            <?php $checkedGender = $_POST['gender'] ?? ''; ?>
            <p>
                <label for="gender1">Male</label>
                <input type="radio" id="gender1" name="gender" value="Male" <?php echo ($checkedGender == 'Male') ? 'checked' : ''; ?> required>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <label for="gender2">Female</label>
                <input type="radio" id="gender2" name="gender" value="Female" <?php echo ($checkedGender == 'Female') ? 'checked' : ''; ?>>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <label for="gender3">Other</label>
                <input type="radio" id="gender3" name="gender" value="Other" <?php echo ($checkedGender == 'Other') ? 'checked' : ''; ?>>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <label for="gender4">Prefer not to say</label>
                <input type="radio" id="gender4" name="gender" value="Prefer not to say" <?php echo ($checkedGender == 'Prefer not to say') ? 'checked' : ''; ?>>
            </p>
        </fieldset>
         
        <fieldset>
            <legend>Address</legend>
            <p>
            <label for="streetAddress">Street Address *&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input type="text" id="streetAddress" name="streetAddress" pattern="[A-Za-z0-9\s.,#'-]{2,40}" maxlength="40" value="<?php echo htmlspecialchars($_POST['streetAddress'] ?? ''); ?>" required style="width:1130px;">
            </p>
            <p>
              <label for="suburb">Suburb *</label>
              <input type="text" id="suburb" name="suburb" pattern="[A-Za-z0-9\s.,#'-]{2,40}" maxlength="40" value="<?php echo htmlspecialchars($_POST['suburb'] ?? ''); ?>" required style="width:1130px;">
            </p>
            <p>
              <label for="state">State *</label>
              <?php $checkedState = $_POST['state'] ?? ''; ?>
              <select id="state" name="state" required style="width:1130px;">
                <option value="" selected disabled>Select a state</option>
                <option value="VIC" <?php echo ($checkedState == 'VIC') ? 'selected' : ''; ?>>VIC</option>
                <option value="NSW" <?php echo ($checkedState == 'NSW') ? 'selected' : ''; ?>>NSW</option>
                <option value="QLD" <?php echo ($checkedState == 'QLD') ? 'selected' : ''; ?>>QLD</option>
                <option value="NT" <?php echo ($checkedState == 'NT') ? 'selected' : ''; ?>>NT</option>
                <option value="WA" <?php echo ($checkedState == 'WA') ? 'selected' : ''; ?>>WA</option>
                <option value="SA" <?php echo ($checkedState == 'SA') ? 'selected' : ''; ?>>SA</option>
                <option value="TAS" <?php echo ($checkedState == 'TAS') ? 'selected' : ''; ?>>TAS</option>
                <option value="ACT" <?php echo ($checkedState == 'ACT') ? 'selected' : ''; ?>>ACT</option>
              </select>
            </p>
            <p>
              <label for="postcode">Postcode * </label>
              <input type="text" id="postcode" name="postcode" pattern="[0-9]{4}" maxlength="4" value="<?php echo htmlspecialchars($_POST['postcode'] ?? ''); ?>" required style="width:1130px;">
            </p>
        </fieldset>

       <fieldset>
        <legend> Skills </legend>

        <?php $checkedSkills = $_POST['skills'] ?? ['adaptability']; ?>

        <p>
            <label for="skill1">Adaptability</label> 
        <input type="checkbox" id="skill1" name="skills[]" value="adaptability" <?php echo in_array('adaptability', $checkedSkills) ? 'checked' : ''; ?>>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <label for="skill2">Communication</label> 
        <input type="checkbox" id="skill2" name="skills[]" value="communication" <?php echo in_array('communication', $checkedSkills) ? 'checked' : ''; ?>>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <label for="skill3">Problem-Solving</label> 
        <input type="checkbox" id="skill3" name="skills[]" value="problem-solving" <?php echo in_array('problem-solving', $checkedSkills) ? 'checked' : ''; ?>>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <label for="skill4">Time Management</label> 
        <input type="checkbox" id="skill4" name="skills[]" value="time_Management" <?php echo in_array('time_Management', $checkedSkills) ? 'checked' : ''; ?>>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <label for="skill5">Conflict Resolution</label> 
        <input type="checkbox" id="skill5" name="skills[]" value="conflict_resolution" <?php echo in_array('conflict_resolution', $checkedSkills) ? 'checked' : ''; ?>>
      </p>

        <p>
            <label for="otherSkills">Other Skills</label><br>
            <textarea id="otherSkills" name="otherSkills" rows="4" cols="40" placeholder="Write about your skills here..."><?php echo htmlspecialchars($_POST['otherSkills'] ?? ''); ?></textarea>    
       </p>
      </fieldset>

      <div class="buttons">
        <input type="submit" value="Submit">
        <input type="reset" value="Reset Form">
      </div>
    </form>
    </main>

<?php include 'footer.inc'; ?>