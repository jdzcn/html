---
layout: post
title: 远程桌面Linux remote desktop
---


### Server:

```shell
x11vnc -passwd PASSWORD -display :0 -forever
```
### Client:

```shell
vinagre
```
### Creating x11vnc system service

```shell
# x11vnc -storepasswd YOURPASSWORD /etc/x11vnc.pwd
# vi /etc/systemd/system/x11vnc.service
```
x11vnc.service
```shell
[Unit]
Description=Start x11vnc at startup.
After=multi-user.target

[Service]
Type=simple
ExecStart=/usr/bin/x11vnc -auth guess -forever -loop -noxdamage -repeat -rfbauth /etc/x11vnc.pwd -rfbport 5900 -shared -o /var/log/x11vnc.log

[Install]
WantedBy=multi-user.target
```
Now enable the above, start it and verify its running and listening properly
```shell
# systemctl enable x11vnc
# systemctl start x11vnc
```
### 参考
- [Setup x11vnc server with systemd auto start up](https://jasonschaefer.com/setup-x11vnc-server-with-systemd-auto-start-up/)