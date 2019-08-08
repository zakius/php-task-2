


Minimalne API zbierające wyniki Lotto i prezentujące je oraz statystyki.

Demo dostępne pod adresem [http://zakius.nazwa.pl:8080](http://zakius.nazwa.pl:8080)

 [/number/1](http://zakius.nazwa.pl:8080/number/1) zwraca liczbę wystąpień zadanej liczby w historycznych wynikach oraz daty jej wystąpienia. Dla liczb spoza dostępnego przedziału zwraca błąd.
 
 [/date/2012-10-30](http://zakius.nazwa.pl:8080/date/2012-10-30) zwraca liczby wylosowane w danym dniu. Dla dat bez danych o wynikach zwraca błąd.
 
 pod adresem [/import/TOKEN](http://zakius.nazwa.pl:8080/import/TOKEN) jest dostępny endpoint wywołujący import danych z zewnętrznego API, TOKEN jest sekretem zdefiniowanym w pliku .env
 
 
 aby uruchomić API należy wywołać polecenie `docker-compose up -d`
