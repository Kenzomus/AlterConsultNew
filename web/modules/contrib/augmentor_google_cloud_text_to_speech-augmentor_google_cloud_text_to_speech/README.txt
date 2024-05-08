CONTENTS OF THIS FILE
---------------------

 * Introduction
 * Requirements
 * Installation
 * Configuration
 * Troubleshooting
 * Maintainers


INTRODUCTION
------------

The Augmentor Google Cloud Text-To-Speech is a submodule of Augmentor.
It provides implementation of multiple Augmentor plugins to allow Augmentor to 
interface with Google Cloud's Text-To-Speech REST APIs.

REQUIREMENTS
------------

This module requires the following modules:

 * [Augmentor](https://www.drupal.org/project/augmentor)


INSTALLATION
------------

 * Install as you would normally install a contributed Drupal module. Visit
   https://www.drupal.org/node/1897420 for further information.


CONFIGURATION
-------------

 * Configure the user permissions in Administration » People » Permissions:

   - Administer augmentors

     Users with this permission will see the webservices > augmentors
     configuration list page. From here they can add, configure, delete, enable
     and disabled augmentors.

     Warning: Give to trusted roles only; this permission has security
     implications. Allows full administration access to create and edit
     augmentors.

TROUBLESHOOTING
---------------

 * If you are not receiving data back for your user.

   - Check the recent log messages report for exception messages.


MAINTAINERS
-----------

Current maintainers:
 * Jaromír Šmahel (jardasmahel) - https://www.drupal.org/u/jardasmahel
 * Eleo Basili (eleonel) - https://www.drupal.org/u/eleonel
 * Naveen Valecha (naveenvalecha) - https://www.drupal.org/u/naveenvalecha

This project has been sponsored by:
 * Morpht Pty Ltd
   We are a team of dedicated and enthusiastic designers, programmers and site
   builders who know how to get the most from Drupal.
   We work for a variety of clients in government, education, media and
   pharmaceutical sectors.
