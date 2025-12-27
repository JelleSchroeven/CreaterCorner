
# Laravel Project 1 - Dynamische Website

## Inleiding
Dit is een dynamische Laravel-website ontwikkeld voor Project 1. De website bevat functionaliteiten zoals een login-systeem, profielbeheer, evenementen, shops, shopping cart, FAQ en contactformulier. Het project is opgezet met Laravel (laatste beschikbare versie bij de start van de lessen) en volgt best practices zoals resource controllers, middleware en Eloquent modellen.

### Huidige functionaliteiten
De website bevat tot nu toe de volgende onderdelen:

1. **Authenticatie**
   - Bezoekers kunnen zich registreren en inloggen
   - Wachtwoord reset functionaliteit aanwezig
   - Logout knop aanwezig
   - Vier accounttypes: `user`, `seller` (creator), `admin`, `moderator`
   - Testaccounts aangemaakt: admin, seller, user

2. **Dashboard**
   - Momenteel leeg, kan dienen als overzicht van events/shops/nieuws

3. **Events**
   - Lijst van evenementen uit de database
   - CRUD via resource controller aanwezig voor verdere uitbreiding

4. **Shops & Producten**
   - Lijst van shops
   - Individuele shoppagina met producten als kaartjes
   - Toevoegen van producten aan de shopping cart
   - Seller functies: `Edit Shop` en `Edit Products` zichtbaar bij ingelogde sellers

5. **Shopping Cart**
   - Items in de cart gesorteerd per shop
   - Totaalberekening aanwezig

6. **Profielpagina**
   - Eigen profiel aanpassen mogelijk: username, profielfoto, bio, verjaardag
   - Publieke profielpagina toegankelijk via `/users/{username}`

7. **FAQ**
   - Lijst van vragen en antwoorden uit de database
   - Gelinkt in de navigatiebalk
   - Beheer van categorieën en vragen/antwoorden door admins nog te implementeren

8. **Contactpagina**
   - Formulier met velden: naam, e-mail, onderwerp, bericht
   - Formulier “verstuurd” naar log (Mail driver: `log`) voor testing
   - Server-side validatie en CSRF-bescherming aanwezig
   - Voldoet aan de functionele eisen van de opdracht

---

## Technische aspecten
- **Routes**: Alle routes via controller methods, gegroepeerd waar logisch, middleware toegepast
- **Controllers**: Resource controllers gebruikt voor CRUD operaties
- **Models & Database**: Eloquent models voor users, shops, products, events, FAQ
- **Views**: Basis layouts aanwezig, componenten gebruikt waar logisch
- **Beveiliging**: CSRF-bescherming, server-side validatie, middleware voor rolbeheer aanwezig

---

## Installatie
Volg de onderstaande stappen om het project lokaal te draaien:

1. Clone de repository:
   ```bash
   git clone <GITHUB_REPO_URL>
   cd <PROJECT_FOLDER>
````

2. Installeer dependencies:

   ```bash
   composer install
   npm install
   npm run dev
   ```

3. Kopieer het `.env.example` bestand naar `.env` en configureer:

   ```bash
   cp .env.example .env
   ```

   Voor development kan de mail driver `log` blijven:

   ```env
   MAIL_MAILER=log
   ```

4. Genereer de application key:

   ```bash
   php artisan key:generate
   ```

5. Migreer en seed de database:

   ```bash
   php artisan migrate:fresh --seed
   ```

6. Start de lokale server:

   ```bash
   php artisan serve
   ```

---

## Testaccounts

* **Admin**

  * Email: [admin@ehb.be](mailto:admin@ehb.be)
  * Wachtwoord: 

* **Seller** (creator)

  * Email: [seller@test.com](mailto:seller@test.com)
  * Wachtwoord: 

* **User**

  * Email: [user@test.com](mailto:user@test.com)
  * Wachtwoord: 

---

## Bronvermelding

* Laravel documentatie: [https://laravel.com/docs](https://laravel.com/docs)
* Voorbeeld implementatie Mailables en resource controllers: Laravel Docs en tutorials
* Componenten en layout ideeën gebaseerd op cursusmateriaal en standaard Laravel practices

---

## Opmerkingen

* Dashboard is nog leeg en kan verder worden uitgebreid met overzichtswidgets
* Admin functionaliteiten (beheer van gebruikers, nieuws, FAQ) zijn nog niet geïmplementeerd
* Nieuwsitems moeten nog worden toegevoegd

```
```
