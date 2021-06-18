---
layout: post
title: debian中使用scrcpy操作手机投屏
---



scrcpy是linux系统操作手机和手机投屏常用软件，安装方法如下：

### 安装

``` shell
sudo apt update
sudo apt install snapd
sudo snap install core

sudo snap install scrcpy
```

### 运行
打开手机设置->我的设备->全部参数,单击miui版本5次打开开发者模式。
打开设置->开发者选项->USB调试，数据线连接手机电脑。
```shell
/snap/bin/scrcpy
```
