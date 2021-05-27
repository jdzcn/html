#!/bin/bash
#DATE=$(date +%Y%m%d)
cd /var/www/html/myshop
rm -f *.sql
mysqldump -uroot -psongbin myshop > myshop.sql
mysqldump -uroot -psongbin store > store.sql
echo "$DATE.sql backup finished."
