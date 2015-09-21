<h1 class="page-title">User login</h1>
<div class="center-hw-box bg-opacity">
	<h2 class="orange">Login to your DVD'sy account</h2>
	<p>This is strictly for DVD'sy members only!</p>
    <div id ="login-form">
        <form name="user-login" id="user-login" action="login.php" method="post" onsubmit="">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" maxlength="10" pattern=".{4,10}" title="Enter your name here"><br>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" maxlength="10" title="Enter your admin password here"><br>
            <div class="form-buttons">
                <input type="reset" value="Reset">
                <input type="submit" name="user-login" value="Login">
            </div>
        </form>
    </div>
</div>