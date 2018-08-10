# com.jlacey.civicrmogp

Simple module that adds Open Graph (OGP) tags on PCP pages for Facebook and other sites where you can share links.

Author: Mathieu Lutfy <mathieu@bidon.ca>

Ported [from a Drupal module](https://github.com/mlutfy/civicrmogp) to a CiviCRM extension: Joseph Lacey <joseph@mayfirst.org>

The extension is licensed under [AGPL-3.0](LICENSE.txt).

## Requirements

* PHP v5.6+
* CiviCRM 4.6, 5.x

## Installation (Web UI)

This extension has not yet been published for installation via the web UI.

## Installation (CLI, Zip)

Sysadmins and developers may download the `.zip` file for this extension and install it with the command-line tool [cv](https://github.com/civicrm/cv).

```bash
cd <extension-dir>
cv dl com.jlacey.civicrmogp@https://github.com/josephlacey/com.jlacey.civicrmogp/archive/master.zip
```

## Installation (CLI, Git)

Sysadmins and developers may clone the [Git](https://en.wikipedia.org/wiki/Git) repo for this extension and install it with the command-line tool [cv](https://github.com/civicrm/cv).

```bash
git clone https://github.com/josephlacey/com.jlacey.civicrmogp.git
cv en civicrmogp
```

## Usage

Once the module is enabled, it will automatically generate the tags for PCP pages, no further configuration is required. It supports the page title, description and PCP image.

For more information: http://ogp.me/
