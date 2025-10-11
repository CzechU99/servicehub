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
      <img alt="HTML" src="https://img.shields.io/badge/HTML5-E34F26?logo=html5&logoColor=white">
      <img alt="CSS" src="https://img.shields.io/badge/CSS3-1572B6?logo=css3&logoColor=white">
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
- **System wiadomości prywatnych**  
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

> Poniżej wklej przykładowe obrazy z aplikacji – np. widok strony głównej, formularz dodawania usługi, czat, panel użytkownika.

| Widok | Podgląd |
|-------|----------|
| Strona główna | ![Strona główna](./img/screen-home.png) |
| Lista usług | ![Lista usług](./img/screen-list.png) |
| Widok szczegółów usługi | ![Szczegóły usługi](./img/screen-details.png) |
| Panel użytkownika | ![Panel użytkownika](./img/screen-profile.png) |
| Wiadomości | ![Wiadomości](./img/screen-messages.png) |

---

## 💡 Architektura logiczna

- `User` → dane użytkownika, profil, powiadomienia  
- `Service` → ogłoszenie usługi (nazwa, opis, cena, lokalizacja)  
- `Reservation` → rezerwacja danej usługi  
- `Message` → system wiadomości między użytkownikami  
- `Favorite` → lista obserwowanych ogłoszeń  

---

## 🔧 Instrukcja uruchomienia

Aby uruchomić aplikację **ServiceHUB** na własnym środowisku, należy wykonać poniższe kroki konfiguracyjne:

1. **Skonfiguruj połączenie z bazą danych**  
   W pliku `.env` uzupełnij dane dostępowe do swojej bazy MySQL:
   ```bash
   DATABASE_URL="mysql://user:password@127.0.0.1:3306/nazwa_bazy"
