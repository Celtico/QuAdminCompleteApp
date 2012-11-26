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
Clone git and rename folder, ex. YourFolderProject

In my experience, to avoid errors
========================

- cd /Users/YourName/Desktop/YourFolderProject/
- /Applications/YourSever/bin/php/php5.3.6/bin/php  /Users/YourName/Desktop/YourFolderProject/composer.phar install

In the errors check and install
========================

- http://git-scm.com/downloads
- http://getcomposer.org/download

The end of the installation
========================
- Import the database which is inside the folder /db
- Configure the connection to the database in /config/autoload/global.php
- Create a virtual host in apache, that points to the folder /public
- Once everything is set up enter http://your_domain/admin-demo, it will ask you to login.
- The default user and password are admin@admin.com/adminadmin
- Inside http://your_domain/web-demo you can test how administration of the web page works


Attention with echo formatted server!
==================================
- echo / <?=

Coming soon
==================================
- Installation with Composer - OK!
- Loading the documents with drag and drop, and registering them on the data base
- Image resizing tool
- Small changes and corrections