<?php
  require_once "upper.php";
?>
<div id="form_wrapper">
	<table>
		<tr>
			<th>교수 이름</th>
			<td><?php echo="$name";?></td>
		</tr>
		<tr>
			<th>학교</th>	<!-->어떤식으로 해야할지 몰라서 이렇게 남겨둠<-->
			<td><?php echo="$name";?></td>
		</tr>
		<tr>
			<th>학과</th>
			<td><?php echo="$major_id";?></td>
		</tr>
	</table>
	<input type="button" name="vote" value="투표하기">
</div>
<?php
  require_once "beneath.php";
?>