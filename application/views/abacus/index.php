<?php

$this->load->view('abacus/header_open');
$this->load->view('abacus/header_close');
$this->load->view('element/top_header');
$this->load->view('element/wrapper_header');
$this->load->view('element/left_panel');

if($parent=='ABACUS'){
    $this->load->view('abacus/main_panel');
}

?>

<?php
$this->load->view('element/wrapper_footer');
$this->load->view('abacus/footer');
$this->load->view('layout/footer');

?>