#!/bin/bash
cd /home/john/public_html/filemanager/files/

sPrefix="file_backup"
sDate=`date +"%Y-%d-%m_(%I-%M-%S)"`
sPref_tar=".tar"
sPref_gz=".gz"
sFileName=$sPrefix$sDate
sDirectory="file_backup"

tar -cvf $sFileName$sPref_tar *
gzip $sFileName$sPref_tar

sBackupName=$sFileName$sPref_tar$sPref_gz

sServerHost='192.168.0.116'
sUsername='john'
sPassword='1111'

ftp -nv <<EOF
open $sServerHost
user $sUsername $sPassword
cd public_html/filemanager/
mkdir $sDirectory
cd $sDirectory
send $sBackupName
bye
EOF
rm -rf $sBackupName