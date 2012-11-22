QuAdminCompleteApp
==================================

QuAdmin, complete app, demo admin and web for Zf2

Beta Version 1.0.0 Created by Cel Ticó Petit

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
- QuAdminDemo
- QuWebDemo

Installation
==================================
- Download and unzip
- Import the database which is inside the folder /db
- Configure the connection to the database in /config/autoload/global.php
- Create a virtual host in apache, that points to the folder /public
- Once everything is set up enter http://your_domain/admin-demo, it will ask you to login.
- The default user and password are admin@admin.com/admin
- Inside http://your_domain/web-demo you can test how administration of the web page works

Coming soon
==================================
- Installation with Composer
- Loading the documents with drag and drop, and registering them on the data base
- Image resizing tool
- Small changes and corrections