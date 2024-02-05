while read line  
do   
   rm -Rf ${0%/*}/../$line
done < ${0%/*}/../.gitignore
