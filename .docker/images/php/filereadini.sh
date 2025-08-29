#!/bin/bash

#/////////////////////////////////////
#//    DEVELOPPEUR : PCTRONIQUE     //
#/////////////////////////////////////

msg_help() {
    echo "$ ./filereadini.sh file key [section]"
    echo "file : name file ini"
    echo "key : name key"
    echo "section : name section [option]"
    echo "##################"
    echo "in file bash : var=\$(filereadini.sh file key [section])"
}

trim(){
    line=$(echo $line | sed 's/^[   ]*//;s/[    ]*$//')
}

txtvalue=""

textvalue() {
    txtvalue="$(echo -e "${txtvalue}" | sed -e 's/^[[:space:]]*//' -e 's/[[:space:]]*$//')"
    txtvalue="$(echo -e "${txtvalue}" | sed -e "s/^[']*//" -e "s/[']*$//")"
    txtvalue="$(echo -e "${txtvalue}" | sed -e 's/^["]*//' -e 's/["]*$//')"
}

trimtxt(){
    txtvalue=$(echo $txtvalue | sed 's/^[   ]*//;s/[    ]*$//')
    textvalue
    txtvalue=$(echo $txtvalue | sed 's/^[   ]*//;s/[    ]*$//')
}

iscomm=false

comm() {
    iscomm=false
    regex_v='^;'
    if  [[ "$line" =~ $regex_v ]] ;
    then
        iscomm=true
    fi
}

issection=false
isnosecti=true
namesecti=""

section() {
    issection=false
    if [[ $iscomm == false ]]
    then
        regex_v='^\[(.)*\]'
        if  [[ "$line" =~ $regex_v ]] ;
        then
            issection=true
            IFS=']' read -ra ADDR <<< "$line"
            txtvalue="${ADDR[0]//[/}"
            trimtxt
            namesecti=$txtvalue
        fi
    fi
}

iskey=false
namekey=""
valuekey=""

key() {
    iskey=false
    if [[ $iscomm == false ]]
    then
        regex_v='(.)*=(.)*'
        if  [[ "$line" =~ $regex_v ]] ;
        then
            iskey=true
            if [ ! -z "$line" ]
            then
                txtvalue=${line%=*}
                trimtxt
                namekey=$txtvalue
                txtvalue=${line#*=}
                trimtxt
                valuekey=$txtvalue
            fi
        fi
    fi
}

defsection=""
defkey=""
thefile=""
valueout=""

readini() {
    while read line  
    do
        trim
        comm
        section
        if [[ ( ( ! -z "$line" ) && $iscomm == false && $issection == false ) ]]
        then
            if [[ ( $isnosecti == true || ( ( ! -z "$defsection" ) && "$defsection" == "$namesecti" ) ) ]]
            then
                key
                if [[ "$defkey" == "$namekey" ]]
                then
                    valueout=$valuekey
                fi
            fi
        fi
    done < $thefile
}

nbArgs="$#"

if [[ ( $# -ne 2 && $# -ne 3 ) ]]
then
    msg_help
    exit 0
fi

folder_file=${0%/*}
thefile=$folder_file/$1
defkey=$2

if [[ $1 =~ ^\/ ]]
then
    thefile=$1
fi

if [[ ( $nbArgs -eq 3 ) ]]
then
    defsection=$3
    isnosecti=false
fi

readini

echo $valueout
