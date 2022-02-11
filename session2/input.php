<h1>I am a form!</h1>

<form name='my_form' method="POST" action="output.php" enctype='multipart/form-data'>
	<label for='number1'>First number</label>
	<input id='number1' type='text' name="number" />
	<br/>
	<label for='number2'>Second number</label>
	<input id='number2' type='text' name="number2" />
	<br/>
	<input type="file" name='my_file' />
	<br/>
	<input type='submit' name="submit" value="Submit" />
</form>