#!/bin/bash


if [ -f /home/guest/Covenant/clickCAPTURE/*.zip ]; then
	cd /home/guest/Covenant/clickCAPTURE
	unzip *.zip
	rm config.csv
	php clickCAPTURE.php
	php sendreport.php
	rm *.csv
	rm *.xlsx
	mv *.zip archive
fi

if [ -f /home/guest/Covenant/Score/*.zip ]; then
	cd /home/guest/Covenant/Score
	unzip *.zip
	php score.php *.csv
	php sendreport.php scoring.csv
	rm *.csv
	mv *.zip archive
fi

if [ -f /home/guest/Covenant/Inquiries/*.zip ]
	 then
		cd /home/guest/Covenant/Inquiries
		unzip *.zip
		php sendreport.php *.csv
		rm *.csv
		mv *.zip archive
	else
		cd /home/guest/Covenant/Inquiries
		php sendreport.php false
fi
