<html>
    <body>
        <h1>Fruit pricelist</h1>
		<table>
			<?php foreach ($fruits as $fruit => $price) { ?>
			<tr>
				<td><?php echo htmlentities($fruit); ?></td>
				<td><?php echo htmlentities($price); ?> &euro;</td>
			</tr>
			<?php } ?>
		</table>
    </body>
</html>