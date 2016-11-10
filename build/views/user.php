<?php
if (isset($_SESSION['user'])) {
    $ticket = new Ticket($con);
    $personal_tickets = $ticket->getUserPersonalTickets();

    ?>
    <div class="container">
        <table class="table table-bordered">
            <tr>
                <th>Procedure</th>
                <th>Beschrijving</th>
                <th>Locatie</th>
                <th>Specifieke Locatie</th>
                <th>Spoed</th>
                <th>Tijd aangemaakt</th>
                <th>Ticket progress</th>
            </tr>
            <?php foreach ($personal_tickets as $value) { ?>
                <tr>
                    <td><?php echo $value['onderwerp'] ?></td>
                    <td><?php echo $value['beschrijving'] ?></td>
                    <td><?php echo $value['locatie'] ?></td>
                    <td><?php echo $value['specifieke_locatie'] ?></td>
                    <td><?php echo $value['spoed'] ?></td>
                    <td><?php echo $value['time_stamp'] ?></td>
                    <td><?php echo $value['progress'] ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>
    <?php
} else {
    echo "dacht het niet he";
} ?>