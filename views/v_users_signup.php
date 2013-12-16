<h2>Sign Up</h2>

<form method='POST' action='/users/p_signup'>

	First name: <input type='text' name='first_name' required title="Enter your first name"><br /> 
	Last name: <input type='text' name='last_name' required title="Enter your last name"><br />
	Email: <input type='email' name='email' required title="Enter your email"><br />
	Password: <input type='password' name='password' required title="Create a password"><br />
        <?php if(isset($error)): ?>
        <div class='error'>
            Sign up failed. E-Mail address already registered.
        </div>
        <br>
    <?php endif; ?>	
	<input type='submit' value='Sign Up'>
</form>
