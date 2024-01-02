<?php
class ContactController {
    public function index() {
        session_start();
        include_once 'app/views/users/contact.php';
    }
}