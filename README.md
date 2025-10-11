<p align="center">
  <img src="./img/logo.png" alt="ServiceHUB logo" width="180"/>
</p>

<h2 align="center"><strong>ServiceHUB – Platforma ogłoszeń i wymiany usług</strong></h2>

<div align="center">
    <p><img alt="Status" src="https://img.shields.io/badge/status-stabilna%20wersja-brightgreen">
    <img alt="Licencja" src="https://img.shields.io/badge/licencja-prywatna-lightgrey"></p>
    <p>
      <img alt="PHP" src="https://img.shields.io/badge/PHP-777BB4?logo=php&logoColor=white">
      <img alt="Symfony" src="https://img.shields.io/badge/Symfony-000000?logo=symfony&logoColor=white">
      <img alt="Twig" src="https://img.shields.io/badge/Twig-68A063?logo=twig&logoColor=white">
      <img alt="MySQL" src="https://img.shields.io/badge/MySQL-4479A1?logo=mysql&logoColor=white">
      <img alt="API Nominatim" src="https://img.shields.io/badge/Nominatim_API-0A66C2?logo=openstreetmap&logoColor=white">
      <img alt="SortableJS" src="https://img.shields.io/badge/SortableJS-FFCA28?logo=javascript&logoColor=black">
      <img alt="Animate.css" src="https://img.shields.io/badge/Animate.css-FF69B4?logo=css3&logoColor=white">
    </p>
</div>

---

## 🎯 Cel projektu

Celem aplikacji **ServiceHUB** jest stworzenie nowoczesnej platformy internetowej, która umożliwia użytkownikom:
- ogłaszanie usług oraz wyszukiwanie ofert innych osób,
- rezerwację usług w oparciu o stawkę godzinową, całkowity koszt lub zasadę **„usługa za usługę”**,
- komunikację i budowanie społeczności opartej na wymianie umiejętności.

Aplikacja łączy prostotę obsługi z wszechstronnością zastosowań, dzięki czemu sprawdza się zarówno wśród osób prywatnych, jak i przedsiębiorców.

---

## 👤 Rola użytkownika

| Rola  | Uprawnienia |
|-------|--------------|
| Użytkownik | Rejestracja i logowanie, dodawanie i edycja własnych usług, wyszukiwanie i rezerwacja usług, wysyłanie wiadomości, obserwowanie ogłoszeń, zarządzanie profilem i powiadomieniami e-mail. |

---

## 🧱 Stack technologiczny

### Backend:
- **PHP (Symfony)** – logika biznesowa i obsługa zapytań HTTP  
- **MySQL** – relacyjna baza danych  
- **API Nominatim (OpenStreetMap)** – integracja lokalizacji i map

### Frontend:
- **Twig** – generowanie szablonów widoków  
- **HTML + CSS** – struktura i styl aplikacji  
- **Animate.css** – animacje interfejsu  
- **SortableJS** – interaktywne sortowanie elementów  

### Inne funkcje:
- **Powiadomienia e-mail** (np. o rezerwacjach i wiadomościach)  
- **Wyszukiwarka usług z filtrami**  
- **Bezpieczny system logowania i rejestracji**

---

## 🧩 Moduły i funkcjonalności

| Moduł | Opis |
|-------|------|
| 📝 **Rejestracja i logowanie** | Bezpieczne uwierzytelnianie i tworzenie kont użytkowników. |
| 📋 **Wszystkie ogłoszenia** | Przegląd dostępnych usług z możliwością filtrowania i sortowania. |
| 🔍 **Wyszukiwarka** | Znajdź usługę po nazwie, kategorii lub lokalizacji. |
| 💬 **Wiadomości** | System komunikacji pomiędzy użytkownikami. |
| 🕓 **Rezerwacje** | Rezerwacja usług na określony czas lub w oparciu o cenę całkowitą. |
| 👁 **Obserwowanie** | Dodawanie usług do listy obserwowanych. |
| 🧑‍💼 **Panel użytkownika** | Edycja profilu, zarządzanie usługami, podgląd rezerwacji. |
| 🛠 **Zarządzanie usługami** | Dodawanie, edytowanie i usuwanie własnych ogłoszeń. |
| 📧 **Powiadomienia e-mail** | Informowanie o nowych wiadomościach i rezerwacjach. |

---

## 📸 Zrzuty ekranu

| Widok | Podgląd |
|-------|----------|
| Strona główna | ![Strona główna](./img/screen-home.png) |
| Lista usług | ![Lista usług](./img/screen-list.png) |
| Widok szczegółów usługi | ![Szczegóły usługi](./img/screen-details.png) |
| Panel użytkownika | ![Panel użytkownika](./img/screen-profile.png) |
| Wiadomości | ![Wiadomości](./img/screen-messages.png) |

---

## 🔧 Instrukcja uruchomienia

Aby uruchomić aplikację **ServiceHUB** na własnym środowisku, należy wykonać poniższe kroki konfiguracyjne:

**a) Skonfiguruj połączenie z bazą danych**  
     - W pliku `.env` uzupełnij dane dostępowe do swojej bazy MySQL:
       ```sh
       DATABASE_URL="mysql://user:password@127.0.0.1:3306/nazwa_bazy"
       ```

**b) W pliku .env skonfiguruj połączenie Mailer’a z zewnętrzną skrzynką pocztową (SMTP):**
     ```env
     MAILER_DSN=smtp://user:password@smtp.example.com:587
     ```

**c) Zaimportuj plik servicehub.sql do swojej bazy danych, aby utworzyć wymagane tabele i dane początkowe.**

**d) Upewnij się, że posiadasz zainstalowanego Composera.**

**e) W katalogu projektu zaktualizuj zależności przy pomocy:**
     ```env
     composer install
     ```
   
**f) Domyślnie aplikacja działa w trybie produkcyjnym (APP_ENV=prod). Aby uruchomić tryb developerski, w pliku .env zmień:**
     ```env
     APP_ENV=dev
     ```
   
**g) Wszystkie pliki projektu umieść na swoim serwerze lokalnym.**

**Dane przykładowego konta użytkownika:**
   ```env
   Email: test@test.com
   ```
   ```env
   Pasword: 1234567
   ```

---

## 🔐 Dostęp i licencja

Aplikacja **ServiceHUB** ma charakter **prywatny**. Dostęp do wersji demonstracyjnej lub kodu źródłowego można uzyskać **po indywidualnym uzgodnieniu z autorem**.

---

## 👨‍💻 Autorzy

Aplikacja opracowana jako projekt dyplomowy

Autor: Denis Czech

Rok: 2025

---

> © 2025 **ServiceHUB** – Platforma ogłoszeń i wymiany usług


