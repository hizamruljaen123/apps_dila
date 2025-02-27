<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
| AUTO-LOADER
| -------------------------------------------------------------------
| This file specifies which systems should be loaded by default.
| -------------------------------------------------------------------
*/

// Autoload Libraries
$autoload['libraries'] = array('database'); // Memuat library database

// Autoload Helper Files
$autoload['helper'] = array('url', 'form'); // Memuat helper URL dan form

// Autoload Drivers
$autoload['drivers'] = array();

// Autoload Models
$autoload['model'] = array('Roti_model'); // Memuat model Roti_model

// Autoload Config Files
$autoload['config'] = array();

// Autoload Language Files
$autoload['language'] = array();

// Autoload Packages
$autoload['packages'] = array();