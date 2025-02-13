W celu poprawnego funkcjonowania serwisu należy uprzednio wykonać poniższe kroki: 
a) w pliku .env należy skonfigurować połączenie z bazą danych,
b) w pliku .env należy skonfigurować połączenie Mailer’a z zewnętrzną skrzynką pocztową,
c) należy zaimportować plik servicehub.sql do swojej bazy danych,
d) upewnij się, że posiadasz zainstalowany Composer,
e) należy w folderze z projektem wykonać aktualizację Composera przy pomocy "composer install",
f) aplikacja jest w trybie produkcyjnym, aby zmienić na tryb developerski w pliku .env zmień APP_ENV=prod na APP_ENV=dev,
g) wszystkie załączone pliki umieść na swoim serwerze lokalnym.

Testowe konto użytkownika:
email: test@test.com
hasło: 1234567