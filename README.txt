 _ _ _ _   _ _ _ _    _ _ _ _    _ _ _ _   _ _ _ _   _ _ _ _   _ _ _ _ _ _   _      _
|         |          |       |  |             |     |               |         \    /
|_ _ _    |_ _ _ _   |       |  |             |     |_ _ _          |          \  /
|                 |  |       |  |             |     |               |           \/ 
|          _ _ _ _|  |_ _ _ _|  |_ _ _ _   _ _|_ _  |_ _ _ _        |           ||


blog post url -> https://fsocietylk.wordpress.com/2017/05/15/facebook-app-with-oauth-2-0/

instructions for locally setting up the website

#prerequisites
  web server installed in local computer(apache, tomcat or iis etc.)

if not download apache web server at http://directory.apache.org/studio/download/download-windows.html

-windows-

1.go to the web server directory
for apache c:/program files/apache/htdocs (if it is the wamp server this would be c:/wamp/www)
2.place fbapp folder inside htdocs directory
3.start the apache http server
  a.start cmd and cd into the c:\program files\apache software foundation\apache2.4\bin
  b.type httpd.exe
4.start the web browser and type http://localhost/fbapp/callback.php

-linux environment-

1.go to /var/www/html directory
2.place fb directory inside html direcotry
3.start the terminal and type service apache2 start
4.start the web browser and type http://localhost/fbapp/callback.php
