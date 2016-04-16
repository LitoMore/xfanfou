<?php

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo json_encode($_GET);
} else {
    echo file_get_contents('php://input');
}
