
This version has bugs, I'll update soon
==================================

QuAdminCompleteApp
==================================

QuAdmin, complete app, demo admin and web for Zf2

Release Notes
========================

0.0.1-dev

- Initiation Demos QuAdmin

0.0.2-dev

- Initiation by composer for better maintenance of all the modules

Screen Shots
==================================

QuDemoAdmin

![QuDemo example screenshot](http://cenics.cat/quadmin1.png)
![QuDemo example screenshot](http://cenics.cat/quadmin2.png)

QuDemoWeb
![QuDemo example screenshot](http://cenics.cat/quwebdemo.jpg)

Modules Including
==================================
- Zf2
- ZendSkeletonApplication
- ZfcBase
- ZfcUser
- WebinoImageThumb
- CdliUserProfile
- CgmConfigAdmin
- QuElFinder
- QuCKEditor
- QuPHPMailer
- QuTcPdf
- QuAdmin
- QuAdminDemo
- QuWebDemo

Installation by Composer
========================
See the information if not known composer and clone git
=========================================================
- http://git-scm.com
- http://getcomposer.org

```
cd /Users/YourName/Desktop/YourFolderProject/
git clone git://github.com/Celtico/QuAdminCompleteApp.git
cd QuAdminCompleteApp
php composer.phar self-update
php composer.phar install
```

The end of the installation
========================
- Import the database which is inside the folder /db
- Configure the connection to the database in /config/autoload/global.php
- Create a virtual host in apache, that points to the folder /public
- Once everything is set up enter http://your_domain/admin-demo, it will ask you to login.
- The default user and password are admin@admin.com/adminadmin
- Inside http://your_domain/web-demo you can test how administration of the web page works


Notes (<?=)
==================================
PHP < 5.4.0 short_open_tag On
http://php.net/manual/en/ini.core.php

Coming soon
==================================
- Installation with Composer - OK!
- Loading the documents with drag and drop, and registering them on the data base
- Image resizing tool
- Small changes and corrections
