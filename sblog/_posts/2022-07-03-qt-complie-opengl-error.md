---
layout: post
title: 解决Qt cannot find -lGL错误


1.查找opengl库

``` shell
find /usr -name libGL*
```

2.根据搜索结果，建立连接：

``` shell
sudo  ln -s /usr/lib/x86_64-linux-gnu/libGL.so.1 /usr/lib/libGL.so
```