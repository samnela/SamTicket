#!/bin/bash

mysql -u root -p$1  sam_ticket <  /var/www/SamTicket/dump/fixture.sql
