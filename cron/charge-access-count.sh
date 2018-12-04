#!/bin/sh
echo $((`fgrep "GET /charge HTTP" /pub/lin/nginx/logs/personal/access.log | wc -l` - 4))
