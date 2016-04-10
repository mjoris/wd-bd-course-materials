<html>
    <body>
        <h1>Fruit pricelist</h1>
		<table>
@foreach ($fruits as $fruit => $price)
			<tr>
				<td>{{ $fruit }}</td>
				<td>{{ $price }} &euro;</td>
			</tr>
@endforeach
		</table>
    </body>
</html>