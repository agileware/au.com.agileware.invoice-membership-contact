# CiviCRM Invoice Membership Contact extension

Alters Contributions on memberships so that they are always invoiced to the
(first) membership contact.

This is primarily useful for webform_civicrm setups where the membership could
be assigned to a contact other than the first one configured in the webform.

The extension is licensed under [AGPL-3.0](LICENSE.txt).

## Requirements

* PHP v5.6+
* CiviCRM 5.11+

## Installation (Web UI)

[Download the extension](https://github.com/agileware/au.com.agileware.invoice-membership-contact/archive/1.0.0.zip),
and extract into your custom extensions directory, then enable via the
Extensions admin page (normally Administer » System Settings » Extensions)


## Installation (CLI, Zip)

Sysadmins and developers may download the `.zip` file for this extension and
install it with the command-line tool [cv](https://github.com/civicrm/cv).

```bash
cd <extension-dir>
cv dl au.com.agileware.invoice-membership-contact@https://github.com/agileware/au.com.agileware.invoice-membership-contact/archive/1.0.0.zip
```

## Installation (CLI, Git)

Sysadmins and developers may clone the [Git](https://en.wikipedia.org/wiki/Git)
repo for this extension and install it with the command-line tool
[cv](https://github.com/civicrm/cv).

```bash
git clone https://github.com/agileware/au.com.agileware.invoice-membership-contact.git
cv en invoice_membership_contact
```

## Usage

Enable the extension. All membership contributions are now invoiced to the
primary contact of the first listed membership.

## Known Issues

CiviCRM versions before 5.11.0 can have trouble with tax amount in the soft
credit created back to the original contact; it is added a second time to the
soft credit and the payment.
