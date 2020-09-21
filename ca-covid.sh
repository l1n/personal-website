#!/bin/sh
curl -s https://raw.githubusercontent.com/nytimes/covid-19-data/master/us-counties.csv | fgrep -e Alameda -e Contra\ Costa -e Marin -e Napa -e San\ Francisco -e San\ Mateo -e Santa\ Clara -e Solano -e Sonoma | cut -f 1,2,5 -d ,
