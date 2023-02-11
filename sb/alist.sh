#!/bin/bash
cd /home/sb/Downloads
/usr/bin/rclone mount ali:/ ~/ali --vfs-cache-mode writes --cache-dir ~/alicache --network-mode --no-check-certificate --default-permissions --header "Referer:https://www.aliyundrive.com/" --vfs-read-chunk-size-limit 1G --vfs-read-chunk-size 64M --dir-cache-time 12h --buffer-size 32M &
pcmanfm /home/sb/ali &
./alist server
