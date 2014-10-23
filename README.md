Symfony Standard Edition
========================

Welcome to the Symfony Standard Edition - a fully-functional Symfony2
application that you can use as the skeleton for your new applications.

This document contains information on how to download, install, and start
using Symfony. For a more detailed explanation, see the [Installation][1]
chapter of the Symfony Documentation.

1) Installing the Standard Edition
----------------------------------

When it comes to installing the Symfony Standard Edition, you have the
following options.

### Use Composer (*recommended*)

As Symfony uses [Composer][2] to manage its dependencies, the recommended way
to create a new project is to use it.

If you don't have Composer yet, download it following the instructions on
http://getcomposer.org/ or just run the following command:

    curl -s http://getcomposer.org/installer | php

Then, use the `create-project` command to generate a new Symfony application:

    php composer.phar create-project symfony/framework-standard-edition path/to/install

Composer will install Symfony and all its dependencies under the
`path/to/install` directory.

### Download an Archive File

To quickly test Symfony, you can also download an [archive][3] of the Standard
Edition and unpack it somewhere under your web server root directory.

If you downloaded an archive "without vendors", you also need to install all
the necessary dependencies. Download composer (see above) and run the
following command:

    php composer.phar install

2) Checking your System Configuration
-------------------------------------

Before starting coding, make sure that your local system is properly
configured for Symfony.

Execute the `check.php` script from the command line:

    php app/check.php

The script returns a status code of `0` if all mandatory requirements are met,
`1` otherwise.

Access the `config.php` script from a browser:

    http://localhost/path/to/symfony/app/web/config.php

If you get any warnings or recommendations, fix them before moving on.

3) Browsing the papillon Application
--------------------------------

Congratulations! create now your database.

    php app/console doctrine:schema:update --force;

4) Cleaning and granting permissions to cache and logs
-------------------------------

    sudo ./script.sh -d -i -c

Usage: ./script [-u][-b][-d][-i][-s][-f][-c][-t][-h][-r]

Additional options:

	 [-u] => composer self[u]pdate & update
	 [-b] => bower install & update
	 [-d] => assetic:[d]ump
	 [-i] => assets:[i]nstall
	 [-c] => cache:[c]lear
	 [-h] => [h]elp
	 [-r] => service apachectl [r]estart


Default it [rm -rf /cache/d* /cache/p*] + [chmod -R 777 /cache /logs]


All libraries and bundles included in the Symfony Standard Edition are
released under the MIT or BSD license.

Enjoy!
