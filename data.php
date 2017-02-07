<table border="1">
	<tr>
		<td colspan="5">data barang</td>
	</tr>
	<tr>
		<td></td><td></td><td></td><td></td><td></td>
	</tr>
	<tr>
		<td>no</td>
		<td>nama barang</td>
		<td>modal</td>
		<td>jual</td>
		<td>jumlah</td>
	</tr>
	<tr>
	<?php include 'koneksi.php';
	$q="SELECT * FROM data_barang";
	$s=mysqli_query($link,$q);
	$no=1;
	while($row=mysqli_fetch_assoc($s)){?>
		<td><?php echo $no; ?></td>
		<td><?php echo $row['nama_barang']; ?></td>
		<td><?php echo number_format($row['modal']); ?></td>
		<td><?php echo number_format($row['harga_jual']); ?></td>
		<td><?php echo $row['jumlah']; ?></td><br>
	</tr>	
		<?php $no++; } ?>
</table>