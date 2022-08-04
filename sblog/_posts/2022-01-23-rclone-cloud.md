---
layout: post
title: rclone 管理云盘
tags: [linux]
---

### Install
``` shell
sudo apt install rclone
or
curl https://rclone.org/install.sh | sudo bash
```
### Config
``` shell
rclone config
```
### Sync

``` shell
#test sync
rclone sync --dry-run md:paint/ ~/paint/
#show progress
rclone sync -P md:paint/ ~/paint/
```
### Mount
``` shell
rclone mount md: ~/onedrive/ --vfs-cache-mode full
```

### Reference
- [rclone.org](https://rclone.org/)