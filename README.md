# Invoice Membership Contact (au.com.agileware.invoice-membership-contact)

This is a [CiviCRM](https://civicrm.org) extension which ensures that Contributions linked to a
Membership are always invoiced to the Membership's own contact, rather than whichever contact
happened to be recorded on the Contribution.

## Purpose

Normally, a Membership Contribution is recorded against the contact who submitted/paid for it. In
some setups — most notably [Webform CiviCRM](https://www.drupal.org/project/webform_civicrm)
forms where a Membership is being purchased for someone other than the person filling in the
form — the Contribution can end up recorded against the *submitter's* contact rather than the
*membership's* contact. This causes the invoice to be addressed to the wrong contact.

This extension corrects that automatically: whenever a MembershipPayment is created linking a
Membership to a Contribution, if the Contribution's contact does not match the Membership's
contact, the Contribution is updated to belong to the Membership's contact, and a soft credit is
recorded back to the original (paying) contact for the full contribution amount so that the
original payer is still credited for the transaction.

The extension is licensed under [AGPL-3.0](LICENSE.txt).

## Usage

There is no user interface, settings page, or configuration required. Once the extension is
enabled, it works automatically in the background:

1. A Membership Contribution is created (e.g. via the Contribution/Membership forms, or via
   Webform CiviCRM), producing a `MembershipPayment` record linking the Contribution to the
   Membership.
2. The extension checks whether the Contribution's `contact_id` matches the Membership's
   `contact_id`.
3. If they differ:
   * The Contribution is updated so its `contact_id` becomes the Membership's contact.
   * A `ContributionSoft` (soft credit) record is created against the original Contribution
     contact, for the Contribution's full `total_amount`, so the original payer is still
     acknowledged.
4. If they already match, nothing happens.

This only runs once per Contribution (per page request) — the extension tracks which
Contributions it has already processed to avoid updating the same Contribution multiple times if
several MembershipPayment records are created for it.

## Special configuration requirements

None. The extension has no settings page, no scheduled jobs, no CiviRules actions, and no new
menu items. It requires no API keys, credentials, or dependent extensions — simply enabling it is
sufficient.

## Known Issues

CiviCRM versions before 5.11.0 can have trouble with tax amount in the soft credit created back to
the original contact; it is added a second time to the soft credit and the payment.

## Requirements

* PHP v7.4+
* CiviCRM 5.51+

## Installation (Web UI)

Learn more about installing CiviCRM extensions in the [CiviCRM Sysadmin
Guide](https://docs.civicrm.org/sysadmin/en/latest/customize/extensions/).

## Installation (CLI, Zip)

Sysadmins and developers may download the `.zip` file for this extension and install it with the
command-line tool [cv](https://github.com/civicrm/cv).

```bash
cd <extension-dir>
cv dl au.com.agileware.invoice-membership-contact@https://github.com/agileware/au.com.agileware.invoice-membership-contact/archive/master.zip
```

## Installation (CLI, Git)

Sysadmins and developers may clone the [Git](https://en.wikipedia.org/wiki/Git) repo for this
extension and install it with the command-line tool [cv](https://github.com/civicrm/cv).

```bash
git clone https://github.com/agileware/au.com.agileware.invoice-membership-contact.git
cv en invoice_membership_contact
```

# About the Authors

This CiviCRM extension was developed by the team at
[Agileware](https://agileware.com.au).

[Agileware](https://agileware.com.au) provide a range of CiviCRM
services including:

* CiviCRM migration
* CiviCRM integration
* CiviCRM extension development
* CiviCRM support
* CiviCRM hosting
* CiviCRM remote training services

Support your Australian [CiviCRM](https://civicrm.org) developers,
[contact Agileware](https://agileware.com.au/contact) today!

![Agileware](logo/agileware-logo.png)
