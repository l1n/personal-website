#!/bin/sh
cd ../covid-19-data
git pull &> /dev/null
cat us-counties.csv | fgrep -e Alameda -e Contra\ Costa -e Marin -e Napa -e San\ Francisco -e San\ Mateo -e Santa\ Clara -e Solano -e Sonoma | cut -f 1,2,5 -d , > ../downloads/ca-covid.csv
cd ../downloads
sqlite3 --csv > ca-covid-window-denormalized.csv <<EOF
CREATE TABLE covid (date, region, count);
.import --csv ca-covid.csv covid
CREATE TABLE covid_denormalized (date, alameda, cc, m, n, sf, sm, sc, sol, son);
INSERT INTO covid_denormalized SELECT DISTINCT covid.date, alameda.count, cc.count, m.count, n.count, sf.count, sm.count, sc.count, sol.count, son.count
FROM covid
LEFT JOIN covid alameda ON covid.date = alameda.date AND alameda.region = "Alameda"
LEFT JOIN covid cc ON covid.date = cc.date AND cc.region = "Contra Costa"
LEFT JOIN covid m ON covid.date = m.date AND m.region = "Marin"
LEFT JOIN covid n ON covid.date = n.date AND n.region = "Napa"
LEFT JOIN covid sf ON covid.date = sf.date AND sf.region = "San Francisco"
LEFT JOIN covid sm ON covid.date = sm.date AND sm.region = "San Mateo"
LEFT JOIN covid sc ON covid.date = sc.date AND sc.region = "Santa Clara"
LEFT JOIN covid sol ON covid.date = sol.date AND sol.region = "Solano"
LEFT JOIN covid son ON covid.date = son.date AND son.region = "Sonoma"
;
SELECT date,
COALESCE(alameda-LEAD(alameda) OVER win, 0),
COALESCE(cc-LEAD(cc) OVER win, 0),
COALESCE(m-LEAD(m) OVER win, 0),
COALESCE(n-LEAD(n) OVER win, 0),
COALESCE(sf-LEAD(sf) OVER win, 0),
COALESCE(sm-LEAD(sm) OVER win, 0),
COALESCE(sc-LEAD(sc) OVER win, 0),
COALESCE(sol-LEAD(sol) OVER win, 0),
COALESCE(son-LEAD(son) OVER win, 0)
FROM covid_denormalized WINDOW win AS (ORDER BY date DESC) ORDER BY date DESC;
EOF

