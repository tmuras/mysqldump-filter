mysqldump-filter
================

Utility to process mysqldump created dumps.


mysqldump-edit
================

Use it to remove "CREATE DATABASE ..." and "USE ..." lines from your MySQL database dump in efficient way.
Those instructions are added to the dump when --databases or --all-databases option is used.
Script is optimized for edition of huge (e.g. GBs big) mysqld dumps. Instead of removing the lines
 it will overwrite them with spaces, so file save operiation should be quick. 
 