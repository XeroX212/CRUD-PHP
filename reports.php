<?php
require 'inc/functions.php';

$page = "reports";
$pageTitle = "Reports | Time Tracker";
$filter = 'all';

if (!empty($_GET['filter'])) {
    $filter = explode(':', filter_input(INPUT_GET, 'filter', FILTER_SANITIZE_STRING));
}

include 'inc/header.php';
?>
<div class="col-container page-container">
    <div class="col col-70-md col-60-lg col-center">
        <div class="col-container">
            <h1 class='actions-header'>Reports</h1>
            <form class='form-container form-report' action='reports.php' method='get'>
                <label for='filter'>Filter:</label>
                <select name="filter" id="filter">
                <option value="">Select One</option>
                <?php
                    foreach(get_project_list() as $item) {
                        echo '<option value="project:'. $item['project_id'].'">';
                        echo $item['title'] ."</option>\n";
                    }
                ?>
                </select>
                <input class="button" type="submit" value="Run" />
            </form>
        </div>
        <div class="section page">
            <div class="wrapper">
                <table>
                    <?php
                    $total = $project_id = $project_total = 0;
                    foreach (get_task_list($filter) as $item) {
                        if ($project_id != $item['project_id']) {
                            if ($project_id > 0 ) {
                                echo "<tr>\n";
                                echo "<th class='project-total-label' colspan='2'>Project Total</th>\n";
                                echo "<th class='project-total-number'>$project_total</th>\n";
                                echo "</tr>\n";
                                $project_total = 0;
                            }
                            $project_id = $item['project_id'];
                            echo "<thead>\n";
                            echo "<tr>\n";
                            echo "<th>" . $item['project'] . "</th>\n";
                            echo "<th>Date</th>\n";
                            echo "<th>Time</th>\n";
                            echo "</tr>\n";
                            echo "</thead>\n";
                        }
                        $project_total += $item['time']; // x$porject_total = $project_total + $item['time'];
                        $total += $item['time'];
                        echo "<tr>\n";
                        echo "<td>". $item['title']."</td>\n";
                        echo "<td>". $item['date']."</td>\n";
                        echo "<td>". $item['time']."</td>\n";
                        echo "<tr>\n";
                    } 
                    ?>
                    <tr>
                        <th class='grand-total-label' colspan='2'>Grand Total</th>
                        <th class='grand-total-number'><?php echo $total; ?></th>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include "inc/footer.php"; ?>
