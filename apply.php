
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
                <input type="text" id="jobRef" name="jobRef" value="<?php echo htmlspecialchars($_POST['jobRef'] ?? ''); ?>" required>
            </p>
        </fieldset>

        <fieldset>
            <legend>Personal Information</legend>
       
            <p>
                <label for="firstName">First Name *</label>
                <input type="text" id="firstName" name="firstName" value="<?php echo htmlspecialchars($_POST['firstName'] ?? ''); ?>" required>
            </p>

            <p>
                <label for="lastName">Last Name *</label>
                <input type="text" id="lastName" name="lastName" value="<?php echo htmlspecialchars($_POST['lastName'] ?? ''); ?>" required>
            </p>

            <p>
                <label for="dob">Date of Birth *</label>
                <!-- GenAI (Claude) suggested adding inputmode="numeric" to trigger a numeric keypad on mobile devices for this date field -->
                <input type="text" id="dob" name="dob" placeholder="dd/mm/yyyy" pattern="[0-9]{2}/[0-9]{2}/[0-9]{4}" inputmode="numeric" title="Please enter a valid date of birth" required>
            </p>
            
            <p>
                <label for="email">Email *</label>
                <input type="email" id="email" name="email" inputmode="email" title="Please enter your email" required>
            </p>

            <p>
                <label for="phoneNum">Phone Number *</label>
                <input type="text" id="phoneNum" name="phoneNum" pattern="[0-9]{8,12}" maxlength="12" inputmode="tel" title="Please enter your phone number" required>
            </p>

        </fieldset>

        <fieldset>
            <legend>Gender *</legend>
            <p>
                <label for="gender1">Male</label>
                <input type="radio" id="gender1" name="gender" value="Male" required>
                 
                <label for="gender2">Female</label>
                <input type="radio" id="gender2" name="gender" value="Female">

                <label for="gender3">Other</label>
                <input type="radio" id="gender3" name="gender" value="Other">

                <label for="gender4">Prefer not to say</label>
                <input type="radio" id="gender4" name="gender" value="Prefer not to say">
            </p>
        </fieldset>
         
        <fieldset>
            <legend>Address</legend>
            <p>
            <label for="streetAddress">Street Address *</label>
            <input type="text" id="streetAddress" name="streetAddress" pattern="[A-Za-z0-9\s.,#'-]{2,40}" title="Please enter a valid street address" required>
            </p>
            <p>
              <label for="suburb">Suburb *</label>
              <input type="text" id="suburb" name="suburb" pattern="[A-Za-z0-9]{2,40}" title="Please enter a valid suburb" required>
            </p>
            <p>
              <label for="state">State *</label>
              <select id="state" name="state" required>
                <option value="" selected disabled>Select a state</option>
                <option value="VIC">VIC</option>
                <option value="NSW">NSW</option>
                <option value="QLD">QLD</option>
                <option value="NT">NT</option>
                <option value="WA">WA</option>
                <option value="SA">SA</option>
                <option value="TAS">TAS</option>
                <option value="ACT">ACT</option>
              </select>
            </p>
            <p>
              <label for="postcode">Postcode * </label>
              <input type="text" id="postcode" name="postcode" pattern="[0-9]{4}" maxlength="4" required>
            </p>
        </fieldset>

       <fieldset>
        <legend> Skills </legend>

        <p>
            <label for="skill1">Adaptability</label> 
        <input type="checkbox" id="skill1" name="skills[]" value="adaptabilty" checked="checked">
        <label for="skill2">Communication</label> 
        <input type="checkbox" id="skill2" name="skills[]" value="communication">
        <label for="skill3">Problem-Solving</label> 
        <input type="checkbox" id="skill3" name="skills[]" value="problem-solving">
        <label for="skill4">Time Management</label> 
        <input type="checkbox" id="skill4" name="skills[]" value="time_Management">
        <label for="skill5">Conflict Resolution</label> 
        <input type="checkbox" id="skill5" name="skills[]" value="conflict_resolution">
      </p>

        <p>
            <label for="otherSkills">Other Skills</label><br>
            <textarea id="otherSkills" name="otherSkills" rows="4" cols="40" placeholder="Write about your skills here..."></textarea>    
       </p>
      </fieldset>

      <div class="buttons">
        <input type="submit" value="Submit">
        <input type="reset" value="Reset Form">
      </div>
    </form>
    </main>

<?php include 'footer.inc'; ?>
