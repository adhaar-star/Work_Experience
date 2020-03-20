<?php include_once $this->getPart('/admin/common/header.php'); ?>

<link rel="stylesheet" href="<?= $app['base_assets_admin_url']; ?>css/dataTables.bootstrap.min.css">
<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
<script src="<?= $app['base_assets_admin_url']; ?>js/jquery.validate.min.js "></script>
<script src="<?= $app['base_assets_admin_url']; ?>js/jquery.dataTables.min.js"></script>
<script src="<?= $app['base_assets_admin_url']; ?>js/dataTables.bootstrap.min.js "></script>

<?php include_once $this->getPart('/admin/sideMenu.php'); ?>

<div class="admin_page_outer">
    <div class="side-body">
        <div class="admin_header_outer">
            <div class="page_name_heading">
                <h1>Session "<?= $session_name ?>" </h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="panel-group date-accordin" id="accordion" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-default view-activity-log">
                        <div class="panel-heading" role="tab" id="headingOne">
                            <h4 class="panel-title">
                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Participants of "<?= $session_name; ?>" Session
                                </a>
                            </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                            <div class="panel-body">
                                <table class="table table-striped table-bordered ">
                                    <thead class="inner-view">
                                        <tr>
                                            <th>User Id</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Username</th>
                                            <th>Contact no.</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (empty($session_users)) {// if no session participants is available
                                            ?>
                                            <tr>
                                                <td colspan="5" style="text-align:center">No participants available.</td>
                                            </tr>
                                            <?php
                                        } else { // if session participants available
                                            foreach ($session_users as $s_key => $s_value) { 
                                                ?>
                                                <tr>
                                                    <td><?= $s_value['user_id'] ?></td>
                                                    <td><?= $s_value['first_name'] . ' ' . $s_value['last_name']; ?></td>
                                                    <td><?= $s_value['email'] ?></td>
                                                    <td><?= $s_value['username'] ?> </td>
                                                    <td><?= '+' . $s_value['phone_code'] . '-' . $s_value['phone_number'] ?></td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
                <?php if (isset($archive_url)) { // url set?>

                    <div class="video_inner">
                        <video controls>
                            <source src="<?= $archive_url?>" type="video/mp4">
                            <source src="movie.ogg" type="video/ogg">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                <?php } else { ?>
                    <div class="no_video">
                        <img src="<?= $app['base_assets_admin_url'] . 'images/no_video.png' ?>" alt="no-video">
                    </div>
                <?php } ?>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="chat_box">
                    <div class="chat-outer">
                        <h3>View Chat</h3>
                        <ul>
                            <?php
                            if (isset($previous_chat)) { // chat exist
                                foreach ($previous_chat as $p_key => $p_value) {
                                    ?>

                                    <li class="user">
                                        <div class="msg common_msg">
                                            <div class="name_time">
                                                <p><span class="time"><?= date('h:i A', strtotime($p_value['date_time'])) ?></span><span class="chat_name"><?= $p_value['name'] ?></span></p>
                                            </div>
                                            <div class="chat_dec">
                                                <p><?= $p_value['msg'] ?></p>
                                            </div>
                                        </div>
                                    </li>

                                    <?php
                                }
                            } else { // no chat exist
                                ?>
                                <div class="not_available">No chat available.</div>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="loader_img-outer loader" style="display:none;">
    <div class="loader_img">
        <img src="<?= $app['base_assets_admin_url']; ?>images/loading-icon.gif">
    </div>
</div>
</body>

</html>
