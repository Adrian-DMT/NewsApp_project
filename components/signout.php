<?php
require_once "../components/header.php";

session_destroy();

header('Location: /views/index.php');
