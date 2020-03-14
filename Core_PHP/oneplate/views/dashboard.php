<div class="row">
    <?php display_alerts(); ?>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Active Listings <small>Getting expired (At most 10)</small> &nbsp;&nbsp;
                    <button type="button" class="btn btn-xs btn-primary" onclick="window.location='<?php echo BASE_URL ?>active-listings.php'">Complete List</button>
                </h3>
            </div>
            <div class="table-responsive">
                <table id="active_list" class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th title="User who listed this meal" style="width:12%"><span class="glyphicon glyphicon-user"></span> User</th>
                            <th title="Location of meal" style="width:15%"><span class="glyphicon glyphicon-map-marker"></span> Location</th>
                            <th title="Category of meal" style="width:15%"><span class="glyphicon glyphicon-list"></span> Category</th>
                            <th title="Time left to expire for this meal" style="width:15%"><span class="glyphicon glyphicon-time"></span> Time Left</th>
                            <th title="Description added by user for this meal" style="width:20%"><span class="glyphicon glyphicon-comment"></span> Desc..</th>
                            <th title="contact number of user" style="width:10%"><span class="glyphicon glyphicon-phone-alt"></span> Contact</th>
                            <th title="contact number of user" style="width:12%"><span class="glyphicon glyphicon-eye-open"></span> Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $active_listings = $db->get_active_listings($limit = 10);
                        if (!empty($active_listings)) {
                            $calc_at = $active_listings['calc_at'];
                            unset($active_listings['calc_at']);
                            foreach ($active_listings as $record) {
                                echo '<tr ' . $db->get_listing_warning($record['expire_after']) . '>';
                                echo '<td>' .
                                anchor(['href' => 'user-detail.php?id=' . $record['user_id'],
                                    'text' => $record['user_name'],
                                    'attr' => [
                                        'title' => 'See user profile',
                                        'target' => '_blank'
                                    ]], $return = true) .
                                '</td>';
                                echo '<td>' .
                                anchor(['href' => 'location-detail.php?id=' . $record['location_id'],
                                    'text' => $record['location'],
                                    'attr' => [
                                        'title' => 'See all listing of this location',
                                        'target' => '_blank'
                                    ]], $return = true) .
                                '</td>';
                                echo '<td>' .
                                anchor(['href' => 'meal-cat-detail.php?id=' . $record['meal_cat_id'],
                                    'text' => $record['meal_name'],
                                    'attr' => [
                                        'title' => 'See all listing in this meal category',
                                        'target' => '_blank'
                                    ]], $return = true) .
                                '</td>';
                                echo '<td title="Calculated on ' . $calc_at . '">' . $db->get_remaining_time($record['expire_after']) . '</td>';
                                echo '<td>' . substr($record['description'], 0, 100) . '...</td>';
                                echo '<td>' . $record['telephone'] . '</td>';
                                echo '<td><button type="button" class="btn btn-xs btn-primary center-block"><span class="glyphicon glyphicon-fullscreen"></span></button></td>';
                                echo '</tr>';
                            }
                        } else {
                            echo '<tr>'
                            . '<td colspan="7" class="bg-warning text-center"><h4>No Record Found</h4></td>'
                            . '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>