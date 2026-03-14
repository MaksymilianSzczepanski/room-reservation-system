# Specyfikacja projektu

## 1. Opis systemu

System sluzy do rezerwacji sal przez studentow i pracownikow. Aplikacja bedzie prezentowala dostepnosc sal w kalendarzu oraz pozwoli na zarzadzanie salami, uzytkownikami i rezerwacjami zgodnie z uprawnieniami.

Wazna uwaga: FullCalendar nie jest wtyczka PHP, tylko biblioteka JavaScript. W praktyce zintegrujemy ja z aplikacja Laravel po stronie widoku.

## 2. Typy kont i role

### Typ konta

- student
- pracownik

### Role w systemie

- admin
- opiekun_sali
- pracownik

Uwagi:

- student moze byc zwyklym uzytkownikiem bez roli administracyjnej
- pracownik moze miec role zwyklego pracownika albo opiekuna sali
- administrator ma najszersze uprawnienia

## 3. Uprawnienia

### Admin

- dodaje nowych uzytkownikow
- edytuje dane uzytkownikow
- blokuje lub aktywuje konta
- dodaje, edytuje i usuwa sale
- przypisuje opiekuna do sali
- przeglada wszystkie rezerwacje
- zatwierdza lub odrzuca rezerwacje, jesli taki proces bedzie wymagany

### Opiekun sali

- przeglada przypisane sale
- zarzadza danymi przypisanej sali
- przeglada rezerwacje swojej sali
- moze akceptowac lub odrzucac rezerwacje dla swojej sali
- moze zablokowac terminy niedostepnosci sali

### Zwykly pracownik

- przeglada liste sal
- sprawdza dostepnosc w kalendarzu
- tworzy rezerwacje
- edytuje lub anuluje swoje rezerwacje, o ile rezerwacja nie zostala juz zrealizowana albo zatwierdzona wedlug regul biznesowych

### Student

- przeglada sale dostepne do rezerwacji
- sprawdza kalendarz zajetosci
- tworzy rezerwacje, jesli polityka systemu na to pozwala
- przeglada swoje rezerwacje

## 4. Glowne moduly systemu

### Modul logowania

- logowanie uzytkownika do systemu
- brak publicznej rejestracji
- reset hasla opcjonalnie, zaleznie od wymagan projektu

### Modul uzytkownikow

- lista uzytkownikow
- formularz dodawania i edycji kont
- przypisywanie typu konta i roli
- aktywacja i dezaktywacja kont

### Modul sal

- nazwa sali
- lokalizacja
- pojemnosc
- opis i wyposazenie
- status aktywnosci
- przypisany opiekun sali

### Modul rezerwacji

- wybor sali
- data
- godzina rozpoczecia
- godzina zakonczenia
- cel rezerwacji
- status rezerwacji

Proponowane statusy:

- pending
- approved
- rejected
- cancelled

### Modul kalendarza

- miesieczny, tygodniowy i dzienny widok rezerwacji
- filtrowanie po sali
- podglad szczegolow wydarzenia
- oznaczanie konfliktow terminow

## 5. Reguly biznesowe

- uzytkownik nie moze zarezerwowac sali w terminie, ktory nachodzi na inna aktywna rezerwacje
- tylko admin dodaje nowe konta
- opiekun sali zarzadza tylko salami, do ktorych zostal przypisany
- zwykly uzytkownik moze edytowac tylko swoje rezerwacje
- system powinien zapisywac autora rezerwacji oraz czas utworzenia i aktualizacji
- mozna wprowadzic maksymalny czas trwania rezerwacji, jesli to wymagane

## 6. Propozycja modelu danych

### Tabela users

- id
- name
- email
- password
- account_type
- role
- is_active
- created_at
- updated_at

### Tabela rooms

- id
- name
- building
- floor
- capacity
- description
- equipment
- guardian_id
- is_active
- created_at
- updated_at

### Tabela reservations

- id
- room_id
- user_id
- title
- description
- starts_at
- ends_at
- status
- created_at
- updated_at

### Tabela room_unavailabilities

- id
- room_id
- starts_at
- ends_at
- reason
- created_by
- created_at
- updated_at

## 7. Propozycja ekranow

- ekran logowania
- dashboard po zalogowaniu
- lista sal
- szczegoly sali z kalendarzem
- formularz rezerwacji
- lista moich rezerwacji
- panel administratora
- panel opiekuna sal

## 8. MVP projektu

Na pierwsza wersje warto wdrozyc:

1. logowanie
2. panel administratora do dodawania uzytkownikow
3. CRUD sal
4. tworzenie rezerwacji
5. walidacje konfliktow terminow
6. widok kalendarza FullCalendar
7. podstawowy podzial uprawnien: admin, opiekun_sali, uzytkownik

## 9. Proponowana kolejnosc implementacji

1. przygotowanie migracji i modeli
2. dodanie logowania i autoryzacji
3. implementacja zarzadzania salami
4. implementacja rezerwacji i walidacji konfliktow
5. integracja FullCalendar
6. dodanie panelu administratora i opiekuna sal
7. testy funkcjonalne
