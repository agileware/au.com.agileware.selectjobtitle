<?php

require_once 'selectjobtitle.civix.php';

// phpcs:disable
use Civi\Api4\OptionGroup;
use Civi\Api4\OptionValue;
use CRM_Selectjobtitle_ExtensionUtil as E;

// phpcs:enable

/**
 * Implements hook_civicrm_config().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_config/
 */
function selectjobtitle_civicrm_config(&$config) {
  _selectjobtitle_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_install
 */
function selectjobtitle_civicrm_install() {
  selectjobtitle_setup_optiongroups();

  _selectjobtitle_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_postInstall().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_postInstall
 */
function selectjobtitle_civicrm_postInstall() {
  _selectjobtitle_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_uninstall
 */
function selectjobtitle_civicrm_uninstall() {
  _selectjobtitle_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_enable
 */
function selectjobtitle_civicrm_enable() {
  selectjobtitle_setup_optiongroups();

  _selectjobtitle_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_disable
 */
function selectjobtitle_civicrm_disable() {
  _selectjobtitle_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_upgrade
 */
function selectjobtitle_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _selectjobtitle_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_entityTypes().
 *
 * Declare entity types provided by this module.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_entityTypes
 */
function selectjobtitle_civicrm_entityTypes(&$entityTypes) {
  _selectjobtitle_civix_civicrm_entityTypes($entityTypes);
}

/**
 * Create the required Activity Category and Activity Category, CiviMobile
 * option
 */

function selectjobtitle_setup_optiongroups() {
  // Check that the Activity Category Option exists
  $optionGroups = OptionGroup::save(FALSE)->addRecord([
    'name'        => 'job_title',
    'title'       => 'Job Title',
    'description' => 'Job Title options',
    'data_type'   => 'String',
    'is_active'   => TRUE,
  ])->setMatch(['name'])->execute();

  $optionValues = OptionValue::save(FALSE)->addRecord([
    'option_group_id.name' => 'job_title',
    'label'                => 'Sanitation Officer',
    'value'                => 'Sanitation Officer',
    'name'                 => 'Sanitation Officer',
  ])->setMatch(['value'])->execute();
}

/**
 * Implements hook_civicrm_buildForm().
 */
function selectjobtitle_civicrm_buildForm($formName, &$form) {

  // Display category option for activity types and activity statuses.
  if ($formName == 'CRM_Contact_Form_Contact' || $formName == 'CRM_Contact_Form_Inline_ContactInfo' || $formName == 'CRM_Contact_Form_Search_Advanced') {
    $options = civicrm_api3('optionValue', 'get', [
      'option_group_id' => 'job_title',
      'is_active'       => 1,
      'options'         => ['limit' => 0, 'sort' => 'weight'],
    ]);
    $opts    = [];

    foreach ($options['values'] as $opt) {
      $opts[] = [
        'id'   => $opt['name'],
        'text' => $opt['label'],
      ];
    }

    $form->add('select2', 'job_title', ts('Job Title'), $opts, FALSE, [
      'class'    => 'crm-select2',
      'placeholder' => ts('- select -'),
      'multiple' => FALSE,
    ]);
  }
}