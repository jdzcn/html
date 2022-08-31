---
layout: post
title: imagemagick常用命令


当前目录文件生成缩略图
``` shell
mogrify  -format gif -path thumbs -thumbnail 100x100 *.jpg
```

旋转图片
``` shell
convert 1.jpg -rotate 90 1.jpg
```