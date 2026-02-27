> 🇬🇧 [English Version](installation.en.md) | 🇩🇪 **Deutsche Version**

# Installationsanleitung

Das `jostkleigrewe/symfony-tabler-bundle` stellt FormTypes, TwigComponents und Stimulus Controller
fuer das [Tabler](https://tabler.io) Design System bereit. Das Bundle liefert **keine** Tabler CSS-
oder Icon-Dateien mit — diese muessen in der Host-Applikation separat installiert werden.

**Voraussetzungen:** PHP >= 8.4, Symfony 7.0+ oder 8.0+

---

## 1. Composer Installation

```bash
composer require jostkleigrewe/symfony-tabler-bundle
```

## 2. Bundle-Registrierung

Mit **Symfony Flex** wird das Bundle automatisch registriert. Ohne Flex muss es manuell in
`config/bundles.php` eingetragen werden:

```php
return [
    // ...
    Jostkleigrewe\TablerBundle\TablerBundle::class => ['all' => true],
];
```

## 3. Tabler installieren (Pflicht)

Das Bundle setzt voraus, dass Tabler CSS und Icons in der Host-App verfuegbar sind.

```bash
npm install @tabler/core @tabler/icons-webfont
```

Einbindung im Base-Template (`templates/base.html.twig`):

```twig
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{% block title %}App{% endblock %}</title>

    {# Tabler CSS #}
    <link rel="stylesheet" href="{{ asset('bundles/tabler/css/tabler.min.css') }}">
    {# Oder via CDN / node_modules je nach Setup #}

    {# Tabler Icons #}
    <link rel="stylesheet" href="{{ asset('bundles/tabler/css/tabler-icons.min.css') }}">

    {% block stylesheets %}{% endblock %}
</head>
<body>
    {% block body %}{% endblock %}

    {# Tabler JS #}
    <script src="{{ asset('bundles/tabler/js/tabler.min.js') }}"></script>
    {% block javascripts %}{% endblock %}
</body>
</html>
```

## 4. Form Themes registrieren

In `config/packages/twig.yaml` die Bundle-Form-Themes hinzufuegen:

```yaml
twig:
    form_themes:
        - 'bootstrap_5_layout.html.twig'
        - '@Tabler/form/floating_underline.html.twig'
        - '@Tabler/form/switch.html.twig'
        - '@Tabler/form/choice_card.html.twig'
        - '@Tabler/form/card_select.html.twig'
```

Das Bootstrap 5 Layout wird als Basis empfohlen, da Tabler auf Bootstrap 5 aufbaut.

## 5. CSS-Dateien einbinden

Das Bundle liefert vier CSS-Dateien mit:

| Datei | Groesse | Zweck |
|-------|---------|-------|
| `tabler-forms.css` | ~18 KB | Styling fuer alle FormTypes |
| `pattern-backgrounds.css` | ~35 KB | 14 animierte Hintergrund-Muster |
| `tabler-themes.css` | ~11 KB | 6 Farbthemen (EURIP, Forest, Sunset, Ocean, Purple, Rose) |

### Methode A: AssetMapper (empfohlen)

Das Bundle registriert seine Assets automatisch im AssetMapper. Einbindung per `asset()`:

```twig
<link rel="stylesheet" href="{{ asset('@jostkleigrewe/tabler-bundle/styles/tabler-forms.css') }}">
<link rel="stylesheet" href="{{ asset('@jostkleigrewe/tabler-bundle/styles/tabler-themes.css') }}">
```

### Methode B: Manuelles Kopieren

Die CSS-Dateien aus `vendor/jostkleigrewe/symfony-tabler-bundle/assets/styles/` in das
`public/`-Verzeichnis der Host-App kopieren und per `<link>` einbinden.

### Methode C: Webpack Encore / Vite

Die CSS-Dateien koennen ueber den jeweiligen Bundler importiert werden:

```js
// assets/app.js (Encore)
import '../../vendor/jostkleigrewe/symfony-tabler-bundle/assets/styles/tabler-forms.css';
```

## 6. Stimulus Controller (optional)

Wenn das `symfony/stimulus-bundle` installiert ist, werden die Stimulus Controller des Bundles
automatisch erkannt und stehen zur Verfuegung. Sechs Controller sind enthalten — Details in der
[Stimulus Controller Dokumentation](stimulus-controllers.de.md).

```bash
composer require symfony/stimulus-bundle
```

## 7. Showcase-Routes (optional)

Fuer Entwicklungszwecke kann die eingebaute Showcase-Demo aktiviert werden.
Erstelle `config/routes/tabler.yaml`:

```yaml
tabler_bundle:
    resource: '@TablerBundle/config/routes.yaml'
```

Die Demo ist dann unter `/tabler/showcase` erreichbar. Weitere Informationen
in der [Showcase Dokumentation](showcase.de.md).

**Hinweis:** Diese Routes sollten nur in Entwicklungsumgebungen importiert werden.

## 8. Fehlerbehebung

**Tabler CSS fehlt:** Die Komponenten und FormTypes rendern HTML, das Tabler CSS-Klassen verwendet.
Ohne Tabler CSS sieht alles unstyled aus. Stelle sicher, dass `@tabler/core` installiert und
eingebunden ist.

**Icons nicht sichtbar:** Das Bundle verwendet Tabler Icons mit dem Prefix `ti ti-`. Stelle
sicher, dass `@tabler/icons-webfont` installiert und das CSS eingebunden ist.

**AssetMapper findet CSS nicht:** Pruefe, ob das Bundle korrekt registriert ist und ob
`framework.asset_mapper` in der Konfiguration aktiv ist. Das Bundle registriert seine Pfade
automatisch in `prependExtension()`.

**Form Themes greifen nicht:** Stelle sicher, dass die Themes in der richtigen Reihenfolge
eingetragen sind und `bootstrap_5_layout.html.twig` als Basis vorhanden ist.

---

## Siehe auch

- [Formular-Typen](form-types.de.md) — Alle 5 FormTypes im Detail
- [Twig-Komponenten](components.de.md) — Alle 15 TwigComponents
- [Stimulus Controller](stimulus-controllers.de.md) — Alle 6 JavaScript Controller
- [Theming & CSS](theming.de.md) — Farbthemen und Dark Mode
- [Data-Attribute](data-attributes.de.md) — Card-Typ Attribute Referenz
- [Showcase / Demo](showcase.de.md) — Eingebaute Demo aktivieren
