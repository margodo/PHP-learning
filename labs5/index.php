<?php
// Task 1
// Сформировать массив из 10 случайных дат в формате ДД-ММ-ГГГГ. Далее при помощи регулярных выражений 
// преобразовать эти даты в формат ГГГГ.ДД.ММ (10 минут - 30 баллов - 15 баллов)
echo 'Task 1';
function generateRandomDate() {
    $date = mt_rand(strtotime('1990-01-01'),strtotime('2024-12-31'));
    return date('d-m-Y',$date);
}

$dates = [];
for ($i=0;$i<10;$i++) {
    $dates[] = generateRandomDate();
}
echo "<pre>";
print_r($dates);

$formattedDates = [];
for ($j=0;$j<10;$j++) {
    $formattedDates[] = preg_replace('/(\d{2})-(\d{2})-(\d{4})/u','$3.$1.$2',$dates[$j]);
}
print_r($formattedDates);
echo '<hr>';

// Task 2 
// Распознать все mac-адресы. (10 мин - 30 баллов - 15 баллов)
echo 'Task 2<br>';
$text = 'Jan 13 00:48:59: DROP service 68->67(udp) from 213.92.153.167 to 69.43.107.219, prefix: "spoof iana-0/8" (in: eth0 69.43.112.233(38:f8:b7:90:45:92):68 -> 217.70.100.113(00:21:87:79:9c:d9):67 UDP len:576 ttl:64)
Jan 13 12:02:48: ACCEPT service dns from 74.125.186.208 to firewall(pub-nic-dns), prefix: "none" (in: eth0 74.125.186.208(00:1a:e3:52:5d:8e):36008 -> 140.105.63.158(00:1a:9a:86:2e:62):53 UDP len:82 ttl:38)
Jan 13 17:44:52: DROP service 68->67(udp) from 172.45.240.237 to 217.70.177.60, prefix: "spoof iana-0/8" (in: eth0 216.34.90.16(00:21:91:fe:a2:6f):68 -> 69.43.85.253(00:07:e1:7c:53:db):67 UDP len:328 ttl:64)
Jan 13 17:52:08: ACCEPT service http from 213.121.184.130 to firewall(pub-nic), prefix: "none" (in: eth0 213.121.184.130(00:05:2e:6a:a4:14):8504 -> 140.105.63.164(00:60:11:92:ed:1b):80 TCP flags: ****S* len:52 ttl:109)
Jan 14 04:56:08: DROP service 68->67(udp) from 217.70.196.185 to 217.70.92.217, prefix: "spoof iana-0/8" (in: eth0 69.43.195.65(00:26:f4:fd:77:d1):68 -> 172.45.101.249(bc:b8:52:d0:55:33):67 UDP len:576 ttl:64)
Jan 14 06:03:01: DROP service 68->67(udp) from 217.70.20.228 to 213.92.27.87, prefix: "spoof iana-0/8" (in: eth0 216.34.214.4(0c:71:5d:52:6f:65):68 -> 172.45.70.44(00:00:6b:ed:5e:cf):67 UDP len:328 ttl:64)
Jan 12 17:19:19: DROP service 68->67(udp) from 213.92.192.102 to 216.34.131.104, prefix: "spoof iana-0/8" (in: eth0 213.92.247.248(00:26:0c:9c:60:d1):68 -> 69.43.186.115(00:00:9a:48:ab:b8):67 UDP len:576 ttl:64)
Jan 13 10:03:14: DROP service 68->67(udp) from 213.92.20.178 to 216.34.129.47, prefix: "spoof iana-0/8" (in: eth0 213.92.173.212(00:18:12:c1:5a:a4):68 -> 172.45.188.138(3c:83:b5:65:85:ba):67 UDP len:328 ttl:64)
Jan 13 13:53:53: DROP service 68->67(udp) from 213.92.94.147 to 172.45.117.37, prefix: "spoof iana-0/8" (in: eth0 213.92.191.188(00:50:a6:df:da:0e):68 -> 213.92.8.108(08:00:8c:1a:3d:d9):67 UDP len:328 ttl:64)
Jan 13 22:37:54: ACCEPT service dns from 65.55.37.37 to firewall(pub-nic-dns), prefix: "none" (in: eth0 65.55.37.37(00:24:33:8e:ae:b2):12031 -> 140.105.63.158(00:06:f8:c3:60:a4):53 UDP len:69 ttl:51)
Jan 14 03:39:10: ACCEPT service dns from 66.249.66.127 to firewall(pub-nic-dns), prefix: "none" (in: eth0 66.249.66.127(00:18:f5:63:84:7c):46293 -> 140.105.63.158(00:0f:07:cb:10:91):53 UDP len:68 ttl:42)
Jan 14 06:23:28: DROP service 68->67(udp) from 216.34.233.123 to 217.70.226.162, prefix: "spoof iana-0/8" (in: eth0 217.70.30.115(cc:b2:55:30:fd:ff):68 -> 69.43.103.96(00:03:10:58:1c:f9):67 UDP len:328 ttl:64)';

$pattern = '/([0-9A-Fa-f]{2}:){5}([0-9A-Fa-f]{2})/u';

preg_match_all($pattern,$text,$matches);
print_r($matches[0]);
echo '<hr>';

// Task 3
// Дана база клиентов в файле в одну строку. Распознать данную базу и вывести на экран 
// клиентов в виде таблицы. (10 мин - 40 баллов - 30 баллов)

echo 'Task 3';
$file = 'client.txt';
$content = file_get_contents($file);
$clients = explode(';',$content);
echo '<table border = 1px>';
echo '<th>Name</th><th>Date of Birth</th><th>Contacts</th>';
for ($ind = 0;$ind<count($clients)-2;$ind+=3) {
    echo '<tr>';
    echo '<td>'.$clients[$ind].'</td>';
    echo '<td>'.$clients[$ind+1].'</td>';
    echo '<td>'.$clients[$ind+2].'</td>';
    echo '</tr>';
}
echo '</table>';