#!/bin/bash
cd /var/nginx/
if [ -f /var/nginx/sites/need_restart ]; then
rm /var/nginx/sites/need_restart
/etc/init.d/nginx stop
/etc/init.d/nginx start
fi

if [ -f /var/nginx/sites/need_user_manage ]; then
LINES=()
while IFS='' read -r line || [[ -n $line ]]; do
	LINES+=("$line")
done < "/var/nginx/sites/need_user_manage"
rm /var/nginx/sites/need_user_manage
/etc/init.d/php5-fpm stop
for i in ${!LINES[@]}; do
	IFS=' ' read -a array <<< "${LINES[i]}"
	if [ "${array[0]}" == "add" ]; then
		groupadd "${array[1]}"
		useradd -p $(openssl passwd -1 "${array[2]}") "${array[1]}" -g "${array[1]}"
	fi
	if [ "${array[0]}" == "del" ]; then
		userdel "${array[1]}"
		groupdel "${array[1]}"
	fi
done
/etc/init.d/php5-fpm start
fi
