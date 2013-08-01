<?php

/* File: /app/views/books/index.ctp */

?>

<h1><b>Daftar Buku</b></h1>

<table>

<tr>

<th><center>ID</center></th>

<th><center>Judul</center></th>

<th><center>Penulis</center></th>

<th><center>Harga</center></th>

<th><center>Deskripsi</center></th>

<th><center>Tgl Entri</center></th>

</tr>

<?php foreach ($books as $book): ?>

<tr>

<td><?php echo $book['Book']['id'] ?></td>

<td><?php echo $book['Book']['title'] ?></td>

<td><?php echo $book['Book']['author'] ?></td>

<td><?php echo $book['Book']['price'] ?></td>

<td><?php echo $book['Book']['description'] ?></td>

<td><?php echo $book['Book']['created'] ?></td>

</tr>

<?php endforeach ?>

</table>