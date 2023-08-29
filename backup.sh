#!/bin/bash
cd /var/www/html
git add .
git commit -m 'backup'
git push github
git push gitee
rclone sync -P --exclude '.git/' /var/www/html/ md:html/
rclone sync -P --exclude '.git/' /var/www/html/ gd:html/
#00 18 * * * sh /var/www/html/backup.sh 
echo "backup successfully!"
