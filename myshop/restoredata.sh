#!/bin/bash
cd /home/sb/myshop
DATE=$(date +%Y%m%d)
wget https://jdzcn.xyz/myshop/$DATE.sql
sudo mysql -uroot -psongbin myshop < $DATE.sql
echo "mysql restore finished."
