		<div class="tab">
				<div class="row">
					<div class="col-lg-6 form-group">
						<label for="userSurname" class="input-label">Surname</label>
						<input type="text" id="userSurname" name="userSurname" class="cust-input " oninput="checkSurname()"  placeholder="Enter Surname">
						<div class="error-message"></div>
					</div>
					<div class="col-lg-6 form-group">
						<label for="userName" class="input-label">Full Name</label>
						<input type="text" name="userName" id="userName" oninput="checkName()"  class="cust-input " placeholder="Enter Full Name">
						<div class="error-message"></div>
					</div>
					<div class="col-lg-6 form-group">
						<label for="userEmail" class="input-label">Email</label>
						<input type="text" name="userEmail" id="userEmail" oninput="checkEmail()" class="cust-input " placeholder="Enter Email Address">
						<div class="error-message"></div>
					</div>
					<div class="col-lg-6 form-group">
						<label for="userCell" class="input-label">Mobile Number</label>
						<input type="text" id="userCell" name="userCellphone" oninput="checkCell()" class="cust-input " placeholder="Enter Mobile Number">
						<div class="error-message"></div>
					</div>
					<div class="col-lg-6 form-group">
						<label for="userPassword"class="input-label">Password</label>
						<input type="Password" id="userPassword" name="userPassword" oninput="checkPassword()" class="cust-input " placeholder="Enter Password">
						<div id="error_m" class="error-message">
							<h5>Password must contain the following:</h5>
							  <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
							  <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
							  <p id="number" class="invalid">A <b>number</b></p>
							  <p id="chars" class="invalid">A <b>special character</b></p>
							  <p id="length" class="invalid">Minimum <b>8 characters</b></p>
						</div>

					</div>

					<div class="col-lg-6 form-group">
						<label for="userConfPassword" class="input-label">Confirm Password</label>
						<input type="password" id="userConfPassword" name="userConfPassword" oninput="checkConfirmPassword()" class="cust-input " placeholder="Confirm Password">
						<div class="error-message"></div>
					</div>
					
					</div>
				</div>