<?php
$this->load->view('layouts/header');
$this->load->view('layouts/header_js');
?>
<div id='wrapper'>
    <?php $this->load->view('layouts/leftmenu'); ?>
    <section id='content'>
        <div class='container'>
            <div class="row" style="margin-top: 10px;">
                <div class="col-sm-12">
                    <?php
                    if ($this->session->flashdata('error')) {
                        echo '<div class="alert alert-danger alert-dismissable">
                                <a class="close" href="#" data-dismiss="alert"> × </a>
                   ' .
                        $this->session->flashdata('error') .
                        '</div>';
                    } elseif ($this->session->flashdata('success')) {
                        echo '<div class="alert alert-success alert-dismissable">
                                 <a class="close" href="#" data-dismiss="alert"> × </a>
                               ' .
                        $this->session->flashdata('success') .
                        '</div>';
                    } else if ($this->session->flashdata('warning')) {
                        echo '<div class="alert alert-warning alert-dismissable">
                                <a class="close" href="#" data-dismiss="alert"> × </a>
                    ' .
                        $this->session->flashdata('warning') .
                        '</div>';
                    } else if ($this->session->flashdata('info')) {
                        echo '<div class="alert alert-info alert-dismissable">
                                   <a class="close" href="#" data-dismiss="alert"> × </a>
                                '
                        . $this->session->flashdata('info') .
                        '</div>';
                    }
                    ?>
                </div>
            </div>
            <div id="skillbody"> 
            <?php $this->load->view($view); ?>
            </div>
            <?php $this->load->view('layouts/footer'); ?>
        </div>
    </section>
</div>
<?php

$this->load->view('layouts/footer_html');
?>
        