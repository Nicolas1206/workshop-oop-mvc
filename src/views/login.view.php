<h1>Login</h1>
<form action="#" method="post">
    <label for="email">Email</label>
    <input type="email" name="email" id="email" placeholder="Your email..." required>
    <label for="password">Password</label>
    <input type="password" name="password" id="password" placeholder="Your password..." required>
    <button type="submit">Send</button>
</form>
<?php if (isset($error_value)): ?>
    <?php if ($error_value == "nodata"): ?>
        <p style="color: orangered;">Please, fill the field with your information.</p>
    <?php elseif ($error_value == "email"): ?>
        <p style="color: orangered;">This email is not valid.</p>

    <?php elseif ($error_value == "pwd"): ?>
        <p style="color: orangered;">This password is not valid.</p>

    <?php elseif ($error_value == "nodb"): ?>
        <p style="color: orangered;">This user doesn't exist.</p>

    <?php endif; ?>
<?php endif; ?>