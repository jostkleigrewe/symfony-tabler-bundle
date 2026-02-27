> 🇬🇧 [English Version](showcase.en.md) | 🇩🇪 **Deutsche Version**

# Showcase / Demo

Das Bundle enthaelt eine eingebaute Showcase-Demo, die alle Komponenten, Formular-Typen, Themes
und Stimulus Controller in Aktion zeigt. Sie dient als Referenz waehrend der Entwicklung und kann
in der Host-App aktiviert werden.

---

## Was ist die Showcase

Die Showcase ist ein `ShowcaseController` mit sieben Routes, der alle Features des Bundles
visuell demonstriert. Die Templates erweitern `base.html.twig` der Host-App — dadurch werden
die Komponenten im echten Layout-Kontext dargestellt.

---

## Aktivierung

Erstelle die Datei `config/routes/tabler.yaml` in der Host-App:

```yaml
tabler_bundle:
    resource: '@TablerBundle/config/routes.yaml'
```

Die Showcase ist danach unter `/tabler/showcase` erreichbar.

**Voraussetzung:** Tabler CSS und Icons muessen in der Host-App installiert und im Base-Template
eingebunden sein (siehe [Installationsanleitung](installation.de.md)).

---

## Verfuegbare Seiten

| Route | URL | Beschreibung |
|-------|-----|--------------|
| `tabler_showcase_index` | `/tabler/showcase` | Uebersicht mit Dashboard-Statistiken |
| `tabler_showcase_form_types` | `/tabler/showcase/form-types` | Alle 5 FormTypes |
| `tabler_showcase_components` | `/tabler/showcase/components` | Alle 15 TwigComponents |
| `tabler_showcase_page_headers` | `/tabler/showcase/page-headers` | PageHeader-Varianten |
| `tabler_showcase_patterns` | `/tabler/showcase/patterns` | 14 animierte Hintergrund-Muster |
| `tabler_showcase_themes` | `/tabler/showcase/themes` | 6 Farbthemen mit Live-Preview |
| `tabler_showcase_controllers` | `/tabler/showcase/controllers` | Stimulus Controller Dokumentation |

### Uebersicht (/tabler/showcase)

Die Startseite zeigt ein Dashboard mit StatCard-Komponenten, die verschiedene Metriken darstellen
(Benutzer, Umsatz, Bestellungen, Tickets). Dient als Beispiel fuer ein typisches Dashboard-Layout.

### FormTypes (/tabler/showcase/form-types)

Interaktive Demonstration aller fuenf FormTypes: FloatingUnderlineType, SwitchType,
ChoiceCardType, EntityCardType und CardSelectType. Zeigt verschiedene Konfigurationen und
Data-Attribute.

### Components (/tabler/showcase/components)

Galerie aller 15 TwigComponents mit verschiedenen Props und Varianten. Jede Komponente wird
mit Beispiel-Code und Live-Preview dargestellt.

### Page Headers (/tabler/showcase/page-headers)

Alle Varianten des PageHeader: Standard, Bordered, Compact, mit Breadcrumbs, Avatar, Status-Badge,
Meta-Informationen und Fortschrittsbalken.

### Patterns (/tabler/showcase/patterns)

Live-Preview aller 14 animierten Hintergrund-Muster mit konfigurierbaren Themes (Dark/Light),
Groessen und Intensitaeten.

### Themes (/tabler/showcase/themes)

Vorschau aller sechs Farbthemen (EURIP, Forest, Sunset, Ocean, Purple, Rose) mit Farbpaletten
und Live-Umschaltung.

### Controllers (/tabler/showcase/controllers)

Dokumentation und interaktive Beispiele fuer alle Stimulus Controller. Jeder Controller hat
eine Detail-Seite mit Values, Targets, Actions und Verwendungsbeispielen.

---

## Nur fuer Entwicklung

Die Showcase-Routes sollten ausschliesslich in Entwicklungsumgebungen importiert werden.
Um sie in Produktion zu deaktivieren, kann die Route-Datei in einem umgebungsspezifischen
Verzeichnis abgelegt werden:

```yaml
# config/routes/dev/tabler.yaml
tabler_bundle:
    resource: '@TablerBundle/config/routes.yaml'
```

Alternativ kann der Import mit einer `when@dev`-Bedingung versehen werden (Symfony 6.1+):

```yaml
# config/routes/tabler.yaml
when@dev:
    tabler_bundle:
        resource: '@TablerBundle/config/routes.yaml'
```

---

## Hinweis zum Base-Template

Die Showcase-Templates erweitern `base.html.twig` der Host-App, nicht ein Bundle-eigenes
Base-Template. Dadurch wird sichergestellt, dass die Komponenten im realen Layout-Kontext
der Anwendung dargestellt werden. Gleichzeitig bedeutet das, dass Tabler CSS im Base-Template
eingebunden sein muss, damit die Showcase korrekt gerendert wird.

---

## Siehe auch

- [Installationsanleitung](installation.de.md) — Tabler CSS und Bundle einrichten
- [Formular-Typen](form-types.de.md) — Alle 5 FormTypes im Detail
- [Twig-Komponenten](components.de.md) — Alle 15 TwigComponents
- [Stimulus Controller](stimulus-controllers.de.md) — Alle 6 JavaScript Controller
- [Theming & CSS](theming.de.md) — Farbthemen und Dark Mode
