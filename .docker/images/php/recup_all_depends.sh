#!/bin/bash

#/////////////////////////////////////
#//    DEVELOPPEUR : PCTRONIQUE     //
#/////////////////////////////////////

if [ -z ${PHP_FOLDER_TMP} ]
then
    PHP_FOLDER_TMP="/var/tmp/docker/php/"
fi

if [ -z ${PHP_FOLDER_INIT} ]
then
    PHP_FOLDER_INIT="/var/docker/php/"
fi

folder=${0%/*}/

all_projects=$(filereadini.sh ${PHP_FOLDER_INIT}/projects_depends.ini list_depends_pct allproject)
IFS=',;' read -r -a list_projects <<< "$all_projects"

if [ ! -f "${PHP_FOLDER_TMP}depends_lock.ini" ]; then
    for element in "${list_projects[@]}"
    do

        printf '%s\n' "############################################################" >&2
        printf '%s\n' "###******************************************************###" >&2
        printf '%s\n' "depend : ${element}" >&2

        contenu="$(echo -e "${element}" | sed -e 's/^[[:space:]]*//' -e 's/[[:space:]]*$//')"
        $folder/recup_one_depend.sh $contenu "$folder"

        printf '%s\n' "###******************************************************###" >&2
        printf '%s\n' "############################################################" >&2

    done
    echo "" >> ${PHP_FOLDER_TMP}depends_lock.ini
fi
