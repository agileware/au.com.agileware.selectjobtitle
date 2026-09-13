# Change Job Title to Select List (au.com.agileware.selectjobtitle)

This is a [CiviCRM](https://civicrm.org) extension that changes the Contact **Job Title** field
from a free-text field into a select list of pre-defined options. This solves the problem of
inconsistent, free-typed Job Title values (typos, variant spellings, near-duplicates) by
restricting Contact staff to choosing from a controlled list of options that your organisation
manages.

Existing Job Title values already stored on Contacts are **not** changed or removed by this
extension. The extension only replaces the input widget used to edit the field.

The extension is licensed under [AGPL-3.0](LICENSE.txt).

## Usage

Once installed, the **Job Title** field is rendered as a select2 dropdown (populated from the
`job_title` option group, sorted by weight, active options only) on:

* The Contact edit form (`CRM_Contact_Form_Contact`)
* The Contact Summary inline edit panel (`CRM_Contact_Form_Inline_ContactInfo`)
* Advanced Search (`CRM_Contact_Form_Search_Advanced`)

The value saved to the Contact's Job Title field is the option's **label** (not its internal
name/value), since the label is the field administrators edit when managing the option list.

_Note_: If a Contact's existing Job Title value is not present in the Job Title option group
(for example, historical free-text data), it will not appear as a selected/selectable option
in the dropdown when editing that Contact.

## Special configuration requirements

No API keys, credentials, or dependent extensions are required.

On install/enable, the extension automatically creates an option group named `job_title`
(title "Job Title") if it does not already exist, seeded with a single example option value,
"Sanitation Officer". You should review and replace this with the Job Title options relevant
to your organisation.

To manage the list of Job Titles available for selection:

1. Go to `Administer > CiviCRM Data > Option Groups` (Administer CiviCRM > Option Groups).
2. Open the **Job Title** option group.
3. Add, edit, remove, re-order (by weight), or activate/deactivate the Job Title options you
   want available in CiviCRM. Only active options are shown in the select list.

## Requirements

* CiviCRM 5.51 or later

## Installation (Web UI)

Learn more about installing CiviCRM extensions in the [CiviCRM Sysadmin
Guide](https://docs.civicrm.org/sysadmin/en/latest/customize/extensions/).

# About the Authors

This CiviCRM extension was developed by the team at
[Agileware](https://agileware.com.au).

[Agileware](https://agileware.com.au) provide a range of CiviCRM services
including:

* CiviCRM migration
* CiviCRM integration
* CiviCRM extension development
* CiviCRM support
* CiviCRM hosting
* CiviCRM remote training services

Support your Australian [CiviCRM](https://civicrm.org) developers, [contact
Agileware](https://agileware.com.au/contact) today!


![Agileware](logo/agileware-logo.png)
