<?php
function userIsLoggedIn() {
    return isset($_SESSION["user_id"]);
}
?>