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
 * Implements hook_civicrm_enable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_enable
 */
function selectjobtitle_civicrm_enable() {
  selectjobtitle_setup_optiongroups();

  _selectjobtitle_civix_civicrm_enable();
}

function selectjobtitle_setup_optiongroups() {
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
    'value'                => '1',
    'name'                 => 'Sanitation Officer',
  ])->setMatch(['value'])->execute();
}

/**
 * Implements hook_civicrm_buildForm().
 */
function selectjobtitle_civicrm_buildForm($formName, &$form) {
  if ($formName == 'CRM_Contact_Form_Contact' || $formName == 'CRM_Contact_Form_Inline_ContactInfo' || $formName == 'CRM_Contact_Form_Search_Advanced') {
    $options = civicrm_api3('optionValue', 'get', [
      'option_group_id' => 'job_title',
      'is_active'       => 1,
      'options'         => ['limit' => 0, 'sort' => 'weight'],
    ]);
    $opts    = [];

    foreach ($options['values'] as $opt) {
      $opts[] = [
        'id'   => $opt['label'], // Label is the value that is saved in the Job Title text field, because Label is the editable field in the Option Group
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
