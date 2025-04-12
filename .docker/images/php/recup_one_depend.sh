#!/bin/bash

#/////////////////////////////////////
#//    DEVELOPPEUR : PCTRONIQUE     //
#/////////////////////////////////////

if [ -z ${PHP_FOLDER_PROJECT} ]
then
    PHP_FOLDER_PROJECT=/usr/local/apache2/www/
fi

if [ -z ${PHP_FOLDER_TMP} ]
then
    PHP_FOLDER_TMP="/var/tmp/docker/php/"
fi

if [ -z ${PHP_FOLDER_INIT} ]
then
    PHP_FOLDER_INIT="/var/docker/php/"
fi

msg_help() {
    echo "$ ./recup_one_depend.sh name_project [folder_start]"
    echo "name_project : name_project"
    echo "folder_start : folder_start [option]"
    echo "##################"
    echo "in file bash : recup_one_depend.sh name_project [folder_start]"
}

nbArgs="$#"

if [[ ( $# -ne 1 &&  $# -ne 2 ) ]]
then
    msg_help
    exit 0
fi

name_project=$1
start_folder=`pwd`

if [[ ( $nbArgs -eq 2 ) ]]
then
    start_folder=$start_folder/$2
    if [[ $2 =~ ^\/ ]]
    then
        start_folder=$2
    fi
fi

def_progress=16

folder_ini=${PHP_FOLDER_INIT}

#000
num_progress=0
perceprogress.sh $num_progress "recup depends var(${name_project})"
# start recup var
server_all=$(filereadini.sh $folder_ini/projects_depends.ini server_all allproject)
name_package_all=$(filereadini.sh $folder_ini/projects_depends.ini name_package_all allproject)
name_folder_all=$(filereadini.sh $folder_ini/projects_depends.ini name_folder_all allproject)
file_cp_all=$(filereadini.sh $folder_ini/projects_depends.ini file_cp_all allproject)
empl_all=$(filereadini.sh $folder_ini/projects_depends.ini empl_all allproject)
name_class_folder_all=$(filereadini.sh $folder_ini/projects_depends.ini name_class_folder_all allproject)

server=$(filereadini.sh $folder_ini/projects_depends.ini server $name_project)
name=$(filereadini.sh $folder_ini/projects_depends.ini name $name_project)
name_folder_prj=$(filereadini.sh $folder_ini/projects_depends.ini name_folder_prj $name_project)
version=$(filereadini.sh $folder_ini/projects_depends.ini version $name_project)
name_package=$(filereadini.sh $folder_ini/projects_depends.ini name_package $name_project)
name_folder=$(filereadini.sh $folder_ini/projects_depends.ini name_folder $name_project)
file_cp=$(filereadini.sh $folder_ini/projects_depends.ini file_cp $name_project)
empl=$(filereadini.sh $folder_ini/projects_depends.ini empl $name_project)
name_class_folder=$(filereadini.sh $folder_ini/projects_depends.ini name_class_folder $name_project)



if [ -z ${server} ]
then
    server=$server_all
fi

if [ -z ${name_package} ]
then
    name_package=$name_package_all
fi

if [ -z ${name_folder} ]
then
    name_folder=$name_folder_all
fi

if [ -z ${file_cp} ]
then
    file_cp=$file_cp_all
fi

if [ -z ${empl} ]
then
    empl=$empl_all
fi

if [ -z ${name_class_folder} ]
then
    name_class_folder=$name_class_folder_all
fi

if [ -z ${name_class_folder} ]
then
    name_class_folder=$name
fi

txt_rpl=""

rpl_txt(){
    txt_rpl="$(echo "${txt_rpl/\%name\%/"$name"}")"
    txt_rpl="$(echo "${txt_rpl/\%version\%/"$version"}")"
    txt_rpl="$(echo "${txt_rpl/\%name_package\%/"$name_package"}")"
    txt_rpl="$(echo "${txt_rpl/\%name_folder\%/"$name_folder"}")"
    txt_rpl="$(echo "${txt_rpl/\%name_class_folder\%/"$name_class_folder"}")"
    txt_rpl="$(echo "${txt_rpl/\%folder_project\%/"$PHP_FOLDER_PROJECT"}")"
}

txt_rpl=$server
rpl_txt
server=$txt_rpl

txt_rpl=$name_package
rpl_txt
name_package=$txt_rpl

txt_rpl=$name_folder
rpl_txt
name_folder=$txt_rpl

txt_rpl=$name_folder
rpl_txt
name_folder=$txt_rpl

txt_rpl=$empl
rpl_txt
empl=$txt_rpl

txt_rpl=$file_cp
rpl_txt
file_cp=$txt_rpl

cd /tmp

curl -sL ${server}/${name_package} | tar xz
cp -r ${name_folder}/${file_cp} ${empl}/
rm -rf ${name_folder}

#000
num_progress=100
perceprogress.sh $num_progress "end recup depend (${name_project})"
