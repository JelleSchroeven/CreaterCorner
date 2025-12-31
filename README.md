# Laravel Project 1 - Creater Corner

## Inleiding
Dit is een dynamische Laravel-website ontwikkeld voor Project 1. De website bevat functionaliteiten zoals een login-systeem, profielbeheer, evenementen, shops, shopping cart, FAQ en contactformulier. Het project is opgezet met Laravel (laatste beschikbare versie bij de start van de lessen) en volgt best practices zoals resource controllers, middleware en Eloquent modellen.

### Huidige functionaliteiten
De website bevat tot nu toe de volgende onderdelen:

---

### **Main Website**

1. **Authenticatie**
   - Bezoekers kunnen zich registreren en inloggen
   - Wachtwoord reset functionaliteit aanwezig
   - Logout knop aanwezig
   - Vier accounttypes: `user`, `seller` (creator), `admin`, `moderator`
   - Testaccounts aangemaakt: admin, seller, user

2. **Dashboard (User)**
   - Momenteel leeg, kan dienen als overzicht van events/shops/nieuws

3. **Events**
   - Lijst van evenementen uit de database voor gebruikers
   - Admin CRUD functionaliteit toegevoegd via admin-gedeelte

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

7. **FAQ – User Page**
   - Lijst van vragen en antwoorden uit de database
   - Toggle voor antwoorden
   - Realtime zoeken en filteren op categorie via AJAX

8. **Contactpagina**
   - Formulier met velden: naam, e-mail, onderwerp, bericht
   - Formulier “verstuurd” naar log (Mail driver: `log`) voor testing
   - Server-side validatie en CSRF-bescherming aanwezig

---

### **Admin Gedeelte**

1. **Admin Dashboard**
   - Toont aantal users, shops en events
   - Knop “Manage Users” naar `/admin/userManagement`  

2. **Manage Users**
   - Gebruikerslijst zichtbaar
   - Gebruikers kunnen worden aangemaakt, bewerkt en verwijderd

3. **Manage Events**
   - Admin CRUD functionaliteit: create, edit, delete, manage
   - Dynamische updates via resource controllers

4. **FAQ – Admin Page**
   - Beheer van FAQ’s en categorieën (create, edit, delete)
   - Realtime filteren en zoeken via AJAX
   - Dynamische updates van de lijst na wijzigingen zonder pagina-refresh

---

## Technische aspecten
- **Routes**: Alle routes via controller methods, gegroepeerd waar logisch, middleware toegepast  
- **Controllers**: Resource controllers gebruikt voor CRUD operaties (Users, FAQ, Events)  
- **Models & Database**: Eloquent models voor users, shops, products, events, FAQ; One-to-many relatie FAQ/Categorieën aanwezig  
- **Views**: Basis layouts aanwezig, componenten gebruikt waar logisch  
- **Beveiliging**: CSRF-bescherming, server-side validatie, middleware voor rolbeheer aanwezig  

---

## Installatie
Volg de onderstaande stappen om het project lokaal te draaien:

1. Clone de repository:
   ```bash
   git clone <GITHUB_REPO_URL>
   cd <PROJECT_FOLDER>
Installeer dependencies:

bash
Copy code
composer install
npm install
npm run dev
Kopieer het .env.example bestand naar .env en configureer:

bash
Copy code
cp .env.example .env
Voor development kan de mail driver log blijven:

env
Copy code
MAIL_MAILER=log
Genereer de application key:

bash
Copy code
php artisan key:generate
Migreer en seed de database:

bash
Copy code
php artisan migrate:fresh --seed
Start de lokale server:

bash
Copy code
php artisan serve

## Testaccounts

* **Admin**
  - Email: [admin@ehb.be](mailto:admin@ehb.be)
  - Wachtwoord: `Password!321`

* **Seller** (creator)
  - Email: [seller@test.com](mailto:seller@test.com)
  - Wachtwoord: `<wachtwoord hier>`

* **User**
  - Email: [user@test.com](mailto:user@test.com)
  - Wachtwoord: `<wachtwoord hier>`


## Bronvermelding
Laravel documentatie: https://laravel.com/docs

Voorbeeld implementatie Mailables en resource controllers: Laravel Docs en tutorials

Componenten en layout ideeën gebaseerd op cursusmateriaal en standaard Laravel practices

## Opmerkingen / To-Do
Dashboard kan verder worden uitgebreid met overzichtswidgets/statistieken

Nieuwsitems functionaliteit nog niet toegevoegd

Many-to-many relaties nog op te zetten (technische vereiste)

Eindtest en screencast/demo voorbereiden voor inlevering
