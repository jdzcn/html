#!/bin/bash
cd /var/www/html
git add .
git commit -m 'backup'
git push github
git push gitee
#rclone sync -P --exclude '.git/' /var/www/html/ md:html/
echo "backup successfully!"
