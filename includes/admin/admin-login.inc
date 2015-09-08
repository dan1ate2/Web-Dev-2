<h1 class="page-title">Admin login</h1>
<div class="center-hw-box bg-opacity">
	<h2 class="orange">Login to your admin account</h2>
	<p>This is strictly for DVD'sy staff only!</p>
    <div id ="login-form">
        <form name="admin-login" id="admin-login" action="" method="post" onsubmit="">
            <label for="staff-name">Staff member</label>
            <input type="text" name="staff-name" id="staff-name" maxlength="10" pattern=".{4,10}" title="Enter your name here"><br>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" maxlength="10" title="Enter your admin password here"><br>
            <div class="form-buttons">
                <input type="reset" value="Reset">
                <input type="submit" name="admin-login" value="Submit">
            </div>
        </form>
    </div>
</div>