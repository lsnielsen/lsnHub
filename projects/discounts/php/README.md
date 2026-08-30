# Tilbudsoversigt (PHP + HTML & CSS)

Denne mappe indeholder den rene **PHP**, **HTML** og **CSS** udgave af **Tilbudsoversigt**, som er designet til at blive pushet til GitHub og kørt direkte i din lokale `htdocs` mappe på localhost (f.eks. med XAMPP, MAMP, WAMP eller Laragon).

---

## 🚀 Sådan kører du applikationen lokalt:

### Mulighed 1: Git Clone til htdocs
```bash
cd /sti/til/din/htdocs  # F.eks. C:\xampp\htdocs eller /Applications/MAMP/htdocs
git clone <dit-github-repo-url> tilbud
```

### Mulighed 2: Manuel kopiering
Kopier filerne fra denne mappe til:
- **XAMPP (Windows)**: `C:\xampp\htdocs\tilbud\`
- **MAMP (macOS)**: `/Applications/MAMP/htdocs/tilbud/`
- **WAMP (Windows)**: `C:\wamp64\www\tilbud\`
- **Laragon**: `C:\laragon\www\tilbud\`

### Start og test i browser:
1. Start **Apache** i dit XAMPP / MAMP kontrolpanel.
2. Åbn din browser og gå til:
   ```
   http://localhost/tilbud/index.php
   ```

---

## 📦 Filstruktur:
- **`data.php`**: Indeholder alle tilbudsdata statisk i et struktureret PHP array med navn, mærke, variant, butik, tilbudspris, førpris, besparelse (kr. og %), enhedspris, gyldighedsdato, tilbudsavis-links og billeder. Ingen databasekrævet!
- **`index.php`**: Frontend skrevet i ren PHP og semantisk HTML5 med hurtig søgning og kategorifiltrering.
- **`style.css`**: Moderne, overskueligt og fuldt responsivt CSS-design.

---

## 🛍️ Varer i oversigten:
1. **Ritter Sport** (f.eks. Ritter Sport Chokolade i Rema 1000 - Spar 52%)
2. **Coca Cola** (f.eks. 1,5L i Netto & 24-pak dåser i Bilka - Spar op til 58%)
3. **Chokolade** (f.eks. Marabou Premium & Mælkechokolade, Toms Kæmpe Skildpadder & Guld Barre)
4. **Mathilde Kakaomælk** (f.eks. Mathilde Original 1L i Netto til halv pris & Mathilde Øko i Coop 365)
5. **Blandede frosne grøntsager** (f.eks. 750g Wokmix/Suppegrønt i Coop 365 & REMA 1000 Frost)
6. **Protein drinks** (f.eks. Barebells Protein Milkshake 330ml & Arla Protein Drik 500ml)
7. **Murphy Energi Bar** (f.eks. Murphy's Big Energy Flapjack Bar & Power Oat Bar - Spar op til 53%)
8. **Æble Juice** (f.eks. Rynkeby 100% Ren Æblejuice 1,75L & God Morgen Koldpresset Æblejuice)
