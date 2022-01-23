<?php
 print("
<table border='1'>
	<tbody>
		<tr>
			<td colspan='2'>Dodaj raport</td>
		</tr>
    <tr>
        <td>Tytuł</td>
        <td>Treść</td>
    </tr>
		<tr>
			<form action='' method='get'>
				<td>
					<input name='tytul' type='text' value=''/>
				</td>
				<td>
					<textarea name='tresc' style='height: 500px; width: 1000px'></textarea>
				</td>
			</tr>
			<tr>
				<td colspan='2'>
					<input name='ar' type='submit' value='Dodaj raport' />
				</td>
			</tr>
		</form>
	</tbody>
</table>");    

?>
