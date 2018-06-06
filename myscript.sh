#!/bin/bash

for i in `cat listaSNMP.txt`
do
	valaux=`echo $i | cut -d '-' -f 1`
	val2=`echo $i | cut -d '-' -f 2`
	#valaux=`echo $i | cut -d ':' -f 2`
	#val1=`echo $valaux | cut -d '.' -f 1`
	#echo $val1
	#val2=`echo $i | rev | cut -d ':' -f 1 | rev`
	valGet=`snmpbulkwalk $1 $valaux | cut -d '=' -f 2`;
	echo "$val2:$valGet"

	#val5=`echo $i | cut -d '*' -f 5`
	#val2=`egrep :$valaux: /etc/passwd | cut -d ':' -f1` 
	#val3=`echo $i | cut -d '*' -f 9`
	#val4=`echo $i | cut -d '*' -f 10- | tr '*' ' '`
	#echo "$val1*$val2*$val3*EXEC*$val4"
done
