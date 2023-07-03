<?php

$this->load->view('merged_flights/header_open');
$this->load->view('merged_flights/header_close');
$this->load->view('element/top_header');
$this->load->view('element/wrapper_header');
$this->load->view('element/left_panel');

if($parent=='ABACUS'){
    $this->load->view('merged_flights/main_panel');
}

?>

<?php
$this->load->view('element/wrapper_footer');
$this->load->view('merged_flights/footer');
$this->load->view('layout/footer');

?>