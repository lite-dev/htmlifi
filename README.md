# htmlifi
Wordpress plugin that takes SQL Tables and displays them as HTML

HTMLIFI STRUCTURE

5 Folders - admin, forms, includes, requests, and settings
  Admin - Creates backend menus for the plugin as well as contains the stylings and javascript of menu forms. Also contains front end stylings and javascript of html tables.
  Forms - Forms are needed to store post information (title and content) and table information (table name, column names, etc). Different files reuse the forms, thus are in separate files to be included later on.
  Includes - Holds Global variables and Functions that other files may use.
  Requests - Contains the files needed to process form posts or POST requests.
  Settings - Contains the files needed to create the database, pass php variables to javascript, and insert stylings and javascript to frontend, etc.

For admin, includes, requests, and settings folders, there are classes that manages the files of those folders, which in turn, the htmlifi_class has an object that has static properties that are instances of those folders' classes so any file can access the files of that folder.

4 Files - htmlifi, htmlifi_class, htmlifi_template, and uninstall
  htmlifi - initializes htmlifi_class and contains wordpress comments
  htmlifi_class - initializes static variables (any file access) for plugin's directory and url path as well as the classes for subfolders
  htmlifi_template - creates html tables, inserts database data, and places html tables at the end of wordpress posts
  uninstall - removes plugin
  
