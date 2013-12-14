<h2>Log in</h2>

<form method='POST' action='/users/p_login'>

    <p>Email</p>
    <input type='text' name='email' required>    

    <p>Password</p>
    <input type='password' name='password' required>
    
    <?php if(isset($error)): ?>
         	<div class='error'>
            	Login failed. Please double check your email and password.
        	</div>
    
    <?php endif; ?>

    <p><input type='submit' value='Log in'></p>

</form>

