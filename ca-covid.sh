#!/bin/sh
cd ../covid-19-data
git pull &> /dev/null
cat us-counties.csv | fgrep -e Alameda -e Contra\ Costa -e Marin -e Napa -e San\ Francisco -e San\ Mateo -e Santa\ Clara -e Solano -e Sonoma | cut -f 1,2,5 -d ,
