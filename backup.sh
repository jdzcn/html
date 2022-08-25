#!/bin/bash
git add .
git commit -m 'backup'
git push
rclone sync -P --exclude '.git/' /var/www/html/ md:html/
echo "backup successfully!"
