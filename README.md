# Integration-Engineer-Coding-Challenge

## Description

This project would get the data in XML from Senate.gov and convert it into JSON based on the list of members.

## Installation

### Run it on your own computer
1. Clone this project into your hard drive (anywhere).  It should include all folders such as api, core, css, files-json, files-xml, includes, and js.  Do not change folders' name.
2. Install your PHP server such as XAMPP or WAMP or LAMP.  It is your choice.  
3. Find httpd.conf file and be sure you point your DocumentRoot and Directory to the folder where you have clone from this project.  
  Example: I have my project on c:/webserver/mend/integration-coding-challenge.  Then I would write the following in httpd.conf:
  - DocumentRoot "C:/webserver/mend/integration-coding-challenge"
  - <Directory "C:/webserver/mend/integration-coding-challenge">
  - If you have other one, you may comment them out by adding '#' at the beginning of the line.  Example:
  - #DocumentRoot "C:/xampp/htdocs"
  - #<Directory "C:/xampp/htdocs">

