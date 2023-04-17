<?php
function display_welcome() {
    print("Welcome, ");
    print($_POST['user_name']);
}
function display_empty_form() {
    print('_HTML_
    <form method="POST" action="$_SERVER[\'PHP_SELF\']">
    Enter your name: <input type="text" name="user_name">
    <br>
    <input type="submit" value="Submit Name">
    </form>
    _HTML_');
}
if ($_POST['user_name']) {
    display_welcome();
} else {
    display_empty_form();
}
?>