<?php

if (isset($_SESSION['user']) && $_SESSION['user_level'] == 0) {
    $action = isset($_GET['action']) ? $_GET['action'] : "";
    $ticket = isset($_GET['ticket']) ? $_GET['ticket'] : "";
    $ticket_service = new Ticket($con);
    if (isset($_POST['locatie'])) {
        $result = $ticket_service->ticketSort();
    } else {
        $result = $ticket_service->getAllTickets();
    }
    if (isset($_POST['betrokken_werknemer']) || isset($_POST['status'])) {
        $ticket_service->updateTicket();
        echo("<script>window.location.assign(\"?page=ticket_overzicht\")</script>");
    }

    if ($action == 'delete') {
        $ticket_service->deleteTicket();
        echo("<script>window.location.assign(\"?page=ticket_overzicht\")</script>");
    }
    ?>
    <div class="container-fluid usercontent">
        <form action="?page=ticket_overzicht" autocomplete="off" method="POST">
            <div class="row">
                <!-- start sort -->
                <div class="sorting">
                    <h2>Sorteer op locatie:</h2>
                    <select name="locatie">
                        <option>Kies locatie</option>
                        <option value="Contactweg">Contactweg</option>
                        <option value="Dintelstraat">Dintelstraat</option>
                    </select>
                    <input type="submit" value="sorteer" class="btn btn-primary actionbutton sortbutton">
                </div>
                <!-- end sort -->
            </div>
            <div class="row">
                <div style="overflow-x:auto;">
                    <table class="tickettable">
                        <tr class="toprow">
                            <td class="number"> </td>
                            <td><div class="whitespace"> </div>Procedure</td>
                            <td>Beschrijving</td>
                            <td>Instuurder</td>
                            <td>Locatie</td>
                            <td>Specifieke Locatie</td>
                            <td>Spoed</td>
                            <td>Tijd aangemaakt</td>
                            <td>Tijd afgehandeld</td>
                            <td>Betrokken werknemer</td>
                            <td>Ticket progress</td>
                        </tr>
                        <?php
                        $count = 1;
                        foreach ($result as $value) { ?>
                            <tr>
                                <td class="number"><?php echo $count; ?></td>
                                <?php $count++; ?>
                                <td><div class="whitespace"><?php echo $value['onderwerp'] ?></td>
                                <td><?php echo $value['beschrijving'] ?></td>
                                <td><?php echo $value['instuurder'] ?></td>
                                <td><?php echo $value['locatie'] ?></td>
                                <td><?php echo $value['specifieke_locatie'] ?></td>
                                <td><?php echo $value['spoed'] ?></td>
                                <td><?php echo $value['time_stamp'] ?></td>
                                <td>
                                    <?php if ($value['progress'] != "Afgehandeld") { ?>
                                        Ticket nog in behandeling
                                    <?php } else {
                                        echo $value['tijd_afgehandeld'];
                                    }
                                    ?>
                                </td>
                                <td>

                                    <?php if ($action == "edit" && $ticket == $value['id']) { ?>
                                        <input type="text" name="betrokken_werknemer"
                                               value="<?php echo $value['betrokken_werknemer']; ?>">
                                        <input type="hidden" name="ticket_id" value="<?php echo $ticket; ?>">
                                    <?php } else { ?>
                                        <?php echo $value['betrokken_werknemer'];
                                    } ?>
                                </td>
                                <td>
                                    <?php if ($action == "edit" && $ticket == $value['id']) { ?>
                                        <select name="status">
                                            <option value="Aangemaakt">Aangemaakt</option>
                                            <option value="In behandeling">In behandeling</option>
                                            <option value="Afgehandeld">Afgehandeld</option>
                                        </select>
                                    <?php } else { ?>
                                        <?php echo $value['progress'];
                                    } ?>
                                </td>
                                <td>
                                    <?php if ($action == "edit" && $ticket == $value['id']) { ?>
                                        <input type="submit" value="Opslaan"><br>
                                    <?php } else { ?>
                                        <a href="?page=ticket_overzicht&action=edit&ticket=<?php echo $value['id'] ?>">Bewerken</a>
                                    <?php } ?>
                                </td>

                                <?php if ($action == "edit" && $ticket == $value['id']) { ?>
                                    <td>
                                        <a href="?page=ticket_overzicht&action=delete&ticket=<?php echo $value['id'] ?>">Verwijderen</a>
                                    </td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </form>
    </div>
    <?php
} else {
    echo "dacht het niet he";
} ?>
