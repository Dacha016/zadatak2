/////////////////////////////////////////////////////////
Linux

xampp set up: 

###############################################
/opt/lampp/etc/extra/httpd-vhosts.conf

<VirtualHost *:80>
    DocumentRoot "/opt/lampp/htdocs/zadtak2/src/Public/index.php"
    ServerName zadatak2.com
</VirtualHost>

#################################################
/opt/lampp/etc/httpd.conf

uncomment line 488

#################################################
/etc/hosts

127.0.0.1       zadatak2.com
////////////////////////////////////////////////////////////////
Windows

xampp set up:


open notepad as admin!!!!!!!!!!!!

#################################################
/xampp/apache/conf/extra/httpd-vhosts.conf

<VirtualHost *:80>
    DocumentRoot "/opt/lampp/htdocs/zadtak2/src/Public/index.php"
    ServerName zadatak2.com
</VirtualHost>


##################################################
/Windows/Sistem32/drivers/etc/hosts

127.0.0.1       zadatak2.com