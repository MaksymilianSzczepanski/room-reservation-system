# Room Reservation System

System rezerwacji sal zbudowany w Laravelu z wykorzystaniem PostgreSQL oraz biblioteki FullCalendar do prezentacji kalendarza rezerwacji.

## Cel projektu

Aplikacja ma umozliwiac zarzadzanie salami oraz ich rezerwowanie przez dwa typy kont:

- student
- pracownik

Dodatkowo w systemie wystepuja role administracyjne i organizacyjne:

- admin - zarzadza calym systemem oraz dodaje konta uzytkownikow
- opiekun sali - zarzadza przypisana sala
- zwykly pracownik - moze przegladac sale i tworzyc rezerwacje

Nowi uzytkownicy nie rejestruja sie samodzielnie. Konta sa tworzone przez administratora w panelu administracyjnym.

## Glowny zakres funkcjonalny

- logowanie do systemu
- zarzadzanie uzytkownikami przez administratora
- zarzadzanie salami
- przypisywanie opiekuna do sali
- tworzenie, edycja i anulowanie rezerwacji
- przeglad kalendarza rezerwacji w widoku FullCalendar
- kontrola dostepu zalezna od typu konta i roli

## Dokumentacja

Szczegolowa specyfikacja znajduje sie w pliku [docs/specyfikacja-projektu.md](C:/sudia_2026/projektowanie_wielowarstwowych_aplikacji/room-reservation-system/docs/specyfikacja-projektu.md).

## Sugerowany stos

- Laravel
- PostgreSQL
- FullCalendar
- Blade lub prosty frontend oparty o Vite

## Status

Repozytorium zawiera obecnie bazowy szkielet Laravel. Kolejnym krokiem powinna byc implementacja:

1. uwierzytelniania i autoryzacji
2. modelu danych sal i rezerwacji
3. panelu administratora
4. integracji kalendarza
