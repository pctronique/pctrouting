#!/bin/bash

#/////////////////////////////////////
#//    DEVELOPPEUR : PCTRONIQUE     //
#/////////////////////////////////////

msg_help() {
    echo "$ ./perceprogress.sh percentage text [is_echo_no_n=false]"
    echo "percentage : number"
    echo "text : text"
    echo "is_echo_no_n : true or false [option]"
    echo "##################"
    echo "in file bash : perceprogress.sh percentage [folder_start]"
}

nbArgs="$#"

if [[ ( $# -ne 2 &&  $# -ne 3 ) ]]
then
    msg_help
    exit 0
fi

progress_num=$1
progress_text=$2
is_echo_no_n="false"
color_text='\e[1;34m'

if [[ ( $nbArgs -eq 3 ) ]]
then
    is_echo_no_n=$3
    is_echo_no_n="$(echo "${is_echo_no_n}" | tr ‘[A-Z]’ ‘[a-z]’)"
fi

progress_not_n() {
    space_nb=
    if [[ $progress_num -lt 100 ]]
    then
        space_nb=$space_nb" "
    fi
    if [[ $progress_num -lt 10 ]]
    then
        space_nb=$space_nb" "
    fi
    space_vide="                                                                                  "
    echo -en "\r""$space_vide"
    echo -en "\r[""$space_nb"$progress_num"%] ${color_text}"$progress_text"\e[0m"
    if [[ $progress_num -eq 100 ]]
    then
        echo ""
    fi
}

progress() {
    space_nb=
    if [[ $progress_num -lt 100 ]]
    then
        space_nb=$space_nb" "
    fi
    if [[ $progress_num -lt 10 ]]
    then
        space_nb=$space_nb" "
    fi
    echo -e "[""$space_nb"$progress_num"%] ${color_text}"$progress_text"\e[0m"
}

if [ "$is_echo_no_n" = "true" ];then
    progress_not_n
else
    progress
fi
