<?php

require_once 'invoice_membership_contact.civix.php';
use CRM_InvoiceMembershipContact_ExtensionUtil as E;

/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function invoice_membership_contact_civicrm_config(&$config) {
  _invoice_membership_contact_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function invoice_membership_contact_civicrm_install() {
  _invoice_membership_contact_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_postInstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_postInstall
 */
function invoice_membership_contact_civicrm_postInstall() {
  _invoice_membership_contact_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function invoice_membership_contact_civicrm_uninstall() {
  _invoice_membership_contact_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function invoice_membership_contact_civicrm_enable() {
  _invoice_membership_contact_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function invoice_membership_contact_civicrm_disable() {
  _invoice_membership_contact_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function invoice_membership_contact_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _invoice_membership_contact_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_entityTypes().
 *
 * Declare entity types provided by this module.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_entityTypes
 */
function invoice_membership_contact_civicrm_entityTypes(&$entityTypes) {
  _invoice_membership_contact_civix_civicrm_entityTypes($entityTypes);
}

/**
 * Implements hook_civicrm_post().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_post
 */
function invoice_membership_contact_civicrm_post($op, $objectName, $objectId, &$objectRef) {
  // Defer to specific object method in CRM_InvoiceMembershipContact_Post
  if(method_exists('CRM_InvoiceMembershipContact_Post', $objectName)) {
    CRM_InvoiceMembershipContact_Post::{$objectName}($op, $objectId, $objectRef);
  }
}
