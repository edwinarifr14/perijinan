<?php

function requesturl() {
    return sprintf(
        "%s://%s%s",
        isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
        $_SERVER['HTTP_HOST'],
        $_SERVER['REQUEST_URI']
    );
}

function rupiah($angka){
	return 'Rp. '.number_format($angka, 2, ',', '.');
}
