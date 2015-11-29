#!/bin/bash

mysql -u root -p$1 -u root  samticket<  /var/www/SamTicket/dump/fixture.sql
