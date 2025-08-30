#!/bin/bash

#/////////////////////////////////////
#//    DEVELOPPEUR : PCTRONIQUE     //
#/////////////////////////////////////

folder_main=${0%/*}/../../project/docs/
all_file=$(ls $folder_main)
all_file=$(echo ${all_file})
IFS=' ' read -r -a list_file <<< "$all_file"

for file_name in "${list_file[@]}"
do
    if [[ ( "${file_name}" != "." && "${file_name}" != ".." && "${file_name}" != "README" ) ]];then
        sudo rm -rf $folder_main${file_name}
    fi
done
