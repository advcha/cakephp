<?php

/* File: /app/controllers/books_controller.php */

class BooksController extends AppController {

	var $name = 'Books';

	function index() {

		$this->set('books', $this->Book->find('all'));

	}

}

?>