<?php
/**
 * Created by PhpStorm.
 * User: Sshucchi
 * Date: 01/05/2017
 * Time: 13:19
 */
/*
  Plugin Name: Facebook answer sharing
  Plugin URI: https://github.com/Sshuichi/q2a-donations-payzone
  Plugin Description: Shares answers on page's name when an expert answers.
  Plugin Version: 1.0
  Plugin Date: 2017-01-01
  Plugin Author: Sshuicchi
  Plugin Author URI:
  Plugin License: GPLv2
  Plugin Minimum Question2Answer Version: 1.7
  Plugin Update Check URI:
*/

if (!defined('QA_VERSION')) { // don't allow this page to be requested directly from browser
    header('Location: ../../');
    exit;
}
qa_register_plugin_module('event', 'q2a-answer-event.php','q2a_answer_event',' Post to FB page when expert answers.');
qa_register_plugin_phrases(
    'q2a-answer-event-lang-*.php', // pattern for language files
    'plugin_answer_sharing' // prefix to retrieve phrases
);