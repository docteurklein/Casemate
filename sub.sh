#!/bin/bash

for cfg in `git config -f $1 -l`
do
    url=`echo $cfg | awk -F"submodule.*.url=" '{print $2}'`;

    if [ -n "$url" ]; then 

        echo "git submodule add $url $path";
        git submodule add $url $path;

        url="";
    else
        path=`echo $cfg | awk -F"submodule.*.path=" '{print $2}'`;
    fi
done
