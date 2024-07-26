<?php

/*
 * Load the core classes
 */
require_once 'core/App.php';
require_once 'core/Controller.php';
require_once 'core/Database.php';
require_once 'core/Session.php';
require_once 'core/Flasher.php';

/*
 * Load the helper classes
 */
require_once 'helpers/DateHelper.php';

/*
 * Load the configuration file
 */
require_once 'config/config.php';

/*
 * Start the session
 */
Session::init();

/*
 * Initialize the database
 */
Database::init();
