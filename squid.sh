#!/bin/bash

# Get the "public" interface from the default route
NIC=$(ip -4 route ls | grep default | grep -Po '(?<=dev )(\S+)' | head -1)
  # initializing var
export DEBIAN_FRONTEND=noninteractive
OS=`uname -m`;
MYIP=$(wget -qO- ipv4.icanhazip.com);
MYIP2="s/aldiblues/$MYIP/g";

function LOGO() {
  clear
	echo -e ""
	echo -e " =====================================================" | lolcat
	echo -e " |           Script VPS Tunneling by jie-vpn          |" | lolcat
	echo -e " =====================================================" | lolcat
	echo -e ""
	echo -e " =====================================================" | lolcat
	echo -e ""
}

function squid() {
# install squid
apt-get -y install squid
rm -f /etc/squid/squid.conf
wget -O /etc/squid/squid.conf "https://github.com/jie-vpn/scriptvpn/raw/master/squid/squid.conf" >> /dev/null 2>&1
sed -i $MYIP2 /etc/squid/squid.conf
service squid restart

# setting vnstat
apt-get -y install vnstat
vnstat -u -i $NIC
vnstat -u -i tun0
vnstat -u -i tun1
service vnstat restart 
}
squid
