<h1>Register</h1>
<form action="#" method="post">
    <label for="">Username</label>
    <input type="text" name="username" id="username" placeholder="Your username..." required>

    <label for="">Email</label>
    <input type="text" name="email" id="email" placeholder="Your email..." required>

    <label for="">Password</label>
    <input type="password" name="password" id="password" placeholder="Your password..." required>
    <button type="submit">Submit</button>
</form>
<?php if (isset($error_value)): ?>
    <?php if ($error_value == "nodata"): ?>
        <p style="color: orangered;">Please, fill the field with your information.</p>
    <?php elseif ($error_value == "email"): ?>
        <p style="color: orangered;">This email is not valid.</p>

    <?php elseif ($error_value == "server"): ?>
        <p style="color: orangered;">Server response with an eror. Try again later.</p>

    <?php elseif ($error_value == "exist"): ?>
        <p style="color: orangered;">This user does exist.</p>

    <?php endif; ?>
<?php endif; ?>