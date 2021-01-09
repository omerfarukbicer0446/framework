<?php
// Bu script @omerfarukbicer tarafından Cibza için yapılmıştır ve halka açık bir şekilde sunulmuştur.
$dotenv = Dotenv\Dotenv::createUnsafeImmutable(dirname('.'));
$dotenv->load();

$class_files = glob('core/classes/*');
foreach ($class_files as $class_file) {
    require $class_file;
}

$helper_files = glob('core/helpers/*');
foreach ($helper_files as $helper_file) {
    require $helper_file;
}

require 'public/web.php';