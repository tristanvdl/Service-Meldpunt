<?php
$action = isset($_GET['action']) ? $_GET['action'] : '';
if ($action == "logout") {
    session_destroy();
    echo("<script>window.location.assign(\"?page=login\")</script>");
}
if (isset($_SESSION['user'])) {
    echo "<div class='loginwarning'>Je bent al ingelogd!</div>";
} else {
    if (isset($_POST['submit_login'])) {
        $userService = new UserService($con);
        if ($userService->checkCredentialUser()) {
            $user = $userService->loginUser();
            echo("<script>window.location.assign(\"?page=home\")</script>");
        } else {
            //echo "Incorrect wachtwoord of email";
            $wronginfo = true;
        }
    }
    ?>
    <form method="post" action="?page=login" autocomplete="off" class="loginform">
    <table>
    <tr>
        <th class="iconth"><i class="fa fa-user" aria-hidden="true"></i></th>
        <th class="inputth"><input type="email" name="email" placeholder="E-mail"></th>
    </tr>
    <form method="post" action="?page=login" autocomplete="off" class="loginform">
        <h1> Login </h1>
        <?php
        if (isset($wronginfo) && $wronginfo) {
            echo "<p class=warning>Incorrect wachtwoord of email</p>";
        }
        ?>
        <table>
            <tr>
            <tr class="seperator"></tr>
            <tr>
                <th class="iconth"><i class="fa fa-key" aria-hidden="true"></i></th>
                <th class="inputth"><input type="password" name="password" placeholder="Wachtwoord"></th>
            </tr>
        </table>

        <a href="?page=register">Geen account? Klik hier!</a>
        <input type="submit" name="submit_login" class="btn btn-primary actionbutton loginbutton" value="Log In">
    </form>
<?php } ?>