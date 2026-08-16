# Global Nyhedsoversigt (PHP + HTML/CSS)

En komplet, moderne webapplikation skrevet i ren PHP og HTML/CSS, der samler og præsenterer opdaterede nyheder fra hele verden.

## Funktioner
- 🌍 **Globale nyheder**: Dækker Danmark, Sverige, Europa, USA, Latinamerika (Brasilien), Afrika, Asien (Japan & Kina) m.fl.
- 🗣️ **8 sprog**: Dansk, Engelsk, Spansk, Fransk, Svensk, Italiensk, Hollandsk og Portugisisk.
- ⚡ **Live datahåndtering**: Trækker direkte fra officielle RSS-feeds (DR, TV 2, BBC, El País, Le Monde, SVT, NOS, Corriere della Sera m.fl.) med indbygget 3-minutters cache, så feeds opdateres løbende.
- 📰 **Overskuelig præsentation**:
  - Overskrift & resumé
  - Kilde- og medielogo/navn
  - Land/region & sprog-tags
  - Udgivelsestidspunkt / dato (f.eks. "For 15 min. siden")
  - Direkte link til den fulde artikel
- 🔙 **Navigation**: Knap i toppen og bunden til `../controller/frontpage.php`.

---

## Installation i Localhost / htdocs

### Mulighed 1: XAMPP / WAMP / MAMP (Windows, macOS, Linux)
1. Kopiér hele mappen `php_project` ind i din `htdocs`-mappe:
   - F.eks. `C:/xampp/htdocs/nyheder/`
2. Sørg for at webserveren (Apache) og PHP er startet.
3. Åbn din browser og gå til:
   ```
   http://localhost/nyheder/index.php
   ```
4. Kontrollér at mappen `cache/` har skriveadgang (sker automatisk i PHP).

### Mulighed 2: Indbygget PHP Dev Server
Hvis du har PHP installeret i din terminal:
```bash
cd php_project
php -S localhost:8000
```
Åbn derefter `http://localhost:8000/index.php` i din browser.

---

## GitHub Opsætning
Du kan nemt committe og pushe denne mappe til GitHub:
```bash
git init
git add .
git commit -m "Initial commit: Global Nyhedsoversigt i PHP"
git branch -M main
git remote add origin https://github.com/DIT_BRUGERNAVN/DIT_REPO.git
git push -u origin main
```
