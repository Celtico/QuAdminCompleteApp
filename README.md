Not have the functionalities to 100%, can be used for production, but watchful, and report the error and possible improvements
==================================

Tested the installation with the composer, ie had to make some adjustments to routes and something more, and now everything works properly!

This version has bugs that are small am waiting to solve.
Thank!

QuAdminCompleteApp
==================================

QuAdmin, complete app, demo admin and web for Zf2

Release Notes
========================

0.0.1-dev

- Initiation Demos QuAdmin

0.0.2-dev

- Initiation by composer for better maintenance of all the modules

0.0.3-dev

- Big changes, soon more documentation

Screen Shots
==================================

QuAdmin

![Example screenshot](http://qumodules.com/ww.png)
![Example screenshot](http://qumodules.com/OK.png)

QuDemoWeb
![QuDemo example screenshot](http://cenics.cat/quwebdemo.jpg)


Demo example
==================================
http://qumodules.com/quadmin


Modules Including
==================================
- Zf2
- ZendSkeletonApplication
- ZfcBase
- ZfcUser
- WebinoImageThumb
- CdliUserProfile
- CgmConfigAdmin
- Ratchet
- QuElFinder
- QuCKEditor
- QuPHPMailer
- QuTcPdf
- QuAdmin
- QuAdminDemo
- QuWebDemo
- QuSystem
- QuPlupload
- QuIcoMoon
- QuChat


Installation by Composer
========================
See the information if not known composer and clone git

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
- Once everything is set up enter http://your_domain/admin-demo/testdemo, it will ask you to login.
- The default user and password are Email:admin@admin.com Password:adminadmin
- Inside http://your_domain/web-demo you can test how administration of the web page works.

Config dir module.config
========================
- In QuAdminDemo (web.demo.config.php) - QuElFinder - QuPlupload (module.config) and permission dir upload 777
- In Module
'DirUploadAbsolute'  =>  dirname(dirname(dirname(__DIR__)))  . '/public/uploads/files/web-demo',
- In Vendor
'DirUploadAbsolute'  => dirname(dirname(dirname(dirname(__DIR__))))  . '/public/uploads/files/web-demo',



- Installation time in my case, 10 minutes

