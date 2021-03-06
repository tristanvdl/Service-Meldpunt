<?php
$user = isset($_GET['dienst']) ? $_GET['dienst'] : "";

if (isset($_POST['onderwerp'])) {
    $pushData = new Ticket($con);
    $keys = $pushData->PushTicketData();
    echo("<script>window.location.assign(\"?page=user\")</script>");
}
if (!isset($_SESSION['user'])) {
    echo "<div class='loginwarning'><a href='?page=login'>Log in</a> om een melding te maken</div>";
} else {
    ?>
    <div class="container ticket-content">
        <div class="ticket-child">
            <h4 class="title-ticket">Melding indienen</h4>
            <form name="myform" action="?page=ticket" method="post" autocomplete="off">
                <input type="text" name="onderwerp" value="<?php echo $user; ?>" placeholder="Probleem"><br>
                <textarea name="beschrijving" id="" placeholder="Beschrijving" cols="30" rows="10"></textarea><br>
                <select name="locatie"><br>
                    <option value="Contactweg">Contactweg</option>
                    <option value="Dintelstraat">Dintelstraat</option>
                </select><br>
                <input type="text" name="specifieke_locatie" placeholder="Specifieke locatie (lokaal, ruimte, etc.)"><br>
                <select name="spoed"><br>
                    <option value="Direct" class="spoedoption">Direct</option>
                    <option value="Vandaag" class="spoedoption">Vandaag</option>
                    <option value="Binnen een week" class="spoedoption">Binnen een week</option>
                    <option value="Geen spoed" class="spoedoption">Geen spoed</option>
                </select><br>
                <input type="hidden" name="dienst" value="">
                <button form="cmsform" type="button" onclick="myform.submit()"
                        class="aanvraagbutton btn btn-default actionbutton">Vraag aan
                </button>
            </form>
        </div>
    </div>
    <?php
}
