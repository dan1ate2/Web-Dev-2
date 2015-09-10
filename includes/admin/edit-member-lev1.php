<form name="select-member" id ="select-member" action="admin.php" method="post">
	<label>Members</label>
	<select name="member-list" id="member-list">
		<?php populateMembersDropdown() ?>
	</select><br><br>
	<div class="form-buttons">
		<input type="submit" name="level-2-request" value="Member Details">
	</div>
</form>

<?php
	function populateMembersDropdown() {
		include_once ("includes/connectDB.php");
		$db = getDBConnection();
		$sql = "SELECT member_id, surname, other_name FROM member order by surname";
		
		foreach ($db->query($sql) as $row) {
			echo '<option value="'.$row["member_id"].'">'.$row["surname"].', '.$row["other_name"].'</option>';
		}
		$db = null;
	}