> 🇬🇧 [English Version](components.en.md) | 🇩🇪 **Deutsche Version**

# Twig-Komponenten

Das Bundle liefert 15 Symfony UX TwigComponents. Alle verwenden das Prefix `Tabler:` und werden
als `<twig:Tabler:KomponentenName>` genutzt. Die PHP-Klassen befinden sich in
`Jostkleigrewe\TablerBundle\Twig\Components`, die Templates unter `@Tabler/components/`.

---

## Layout-Komponenten

### PageHeader

Seitenkopf mit Icon, Titel, Breadcrumbs, Status-Badge, Meta-Informationen und optionalen Actions.

| Eigenschaft | Typ | Standard | Beschreibung |
|-------------|-----|----------|--------------|
| `title` | string | *(erforderlich)* | Haupttitel |
| `pretitle` | string\|null | `null` | Ueberschrift ueber dem Titel |
| `subtitle` | string\|null | `null` | Beschreibung unter dem Titel |
| `icon` | string\|null | `null` | Tabler Icon Name |
| `iconColor` | string | `'azure'` | Icon-Hintergrundfarbe |
| `avatar` | string\|null | `null` | Avatar-Bild-URL (ersetzt Icon) |
| `avatarInitials` | string\|null | `null` | Avatar-Initialen als Fallback |
| `avatarSize` | string | `'lg'` | Avatar/Icon-Groesse |
| `variant` | string | `'default'` | `default`, `bordered`, `compact` |
| `container` | string | `'xl'` | `xl`, `fluid`, `none` |
| `breadcrumbs` | array | `[]` | `[{label, url?}, ...]` |
| `status` | string\|null | `null` | Status-Badge Text |
| `statusColor` | string | `'secondary'` | Status-Badge Farbe |
| `meta` | array | `[]` | `[{icon?, text, url?}, ...]` |
| `progress` | int\|null | `null` | Fortschrittsanzeige (0-100) |
| `progressColor` | string | `'primary'` | Fortschritts-Farbe |
| `class` | string | `''` | Zusaetzliche CSS-Klassen |

**Block:** `actions` — Platzhalter fuer Buttons rechts im Header.

```twig
{# Einfacher Header #}
<twig:Tabler:PageHeader title="Dashboard" icon="dashboard" />

{# Mit Breadcrumbs und Actions #}
<twig:Tabler:PageHeader
    title="Benutzer bearbeiten"
    pretitle="Administration"
    icon="user-edit"
    :breadcrumbs="[
        {label: 'Home', url: '/'},
        {label: 'Benutzer', url: '/users'},
        {label: 'Bearbeiten'}
    ]"
>
    <twig:block name="actions">
        <a href="/users" class="btn btn-outline-secondary">Zurueck</a>
        <button class="btn btn-primary">Speichern</button>
    </twig:block>
</twig:Tabler:PageHeader>
```

### Panel

Generisches Panel/Card mit Titel, optionalem Icon und zentriertem Layout.

| Eigenschaft | Typ | Standard | Beschreibung |
|-------------|-----|----------|--------------|
| `title` | string | *(erforderlich)* | Panel-Titel |
| `subtitle` | string\|null | `null` | Untertitel |
| `icon` | string\|null | `null` | Tabler Icon Name |
| `iconColor` | string | `'azure'` | Icon-Farbe |
| `centered` | bool | `true` | Zentriertes Layout |
| `size` | string | `'md'` | `sm`, `md`, `lg` |

```twig
<twig:Tabler:Panel title="Anmeldung" icon="login" size="sm">
    {{ form(loginForm) }}
</twig:Tabler:Panel>
```

### CollapsiblePanel

Ausklappbares Panel mit ARIA-Attributen. Nutzt intern den `collapsible` Stimulus Controller.

| Eigenschaft | Typ | Standard | Beschreibung |
|-------------|-----|----------|--------------|
| `title` | string | *(erforderlich)* | Panel-Titel |
| `icon` | string\|null | `null` | Tabler Icon Name |
| `iconColor` | string | `'primary'` | Icon-Farbe |
| `expanded` | bool | `false` | Initial ausgeklappt |
| `panelId` | string\|null | `null` | Eindeutige ID (automatisch generiert) |
| `variant` | string | `'default'` | `default`, `bordered`, `card`, `subtle` |
| `subtitle` | string\|null | `null` | Hilfetext unter dem Titel |

```twig
<twig:Tabler:CollapsiblePanel title="Erweiterte Einstellungen" icon="settings" variant="bordered">
    <p>Hier stehen zusaetzliche Optionen...</p>
</twig:Tabler:CollapsiblePanel>
```

---

## Datenanzeige

### StatCard

Statistik-Karte fuer Dashboards mit Label, Wert, Icon und Trend-Indikator.

| Eigenschaft | Typ | Standard | Beschreibung |
|-------------|-----|----------|--------------|
| `label` | string | *(erforderlich)* | Beschriftung |
| `value` | string | *(erforderlich)* | Anzeigewert |
| `icon` | string\|null | `null` | Tabler Icon Name |
| `iconColor` | string | `'azure'` | Icon-Farbe |
| `hint` | string\|null | `null` | Hinweistext unter dem Wert |
| `trend` | string\|null | `null` | `up`, `down` oder `null` |
| `url` | string\|null | `null` | Link-Ziel fuer die gesamte Card |

```twig
<div class="row">
    <div class="col-md-3">
        <twig:Tabler:StatCard
            label="Benutzer"
            value="1.234"
            icon="users"
            iconColor="blue"
            hint="+12% diesen Monat"
            trend="up"
        />
    </div>
</div>
```

### FeatureCard

Feature-Card fuer Marketing-Seiten mit Icon, Titel, Beschreibung und optionalem Link.

| Eigenschaft | Typ | Standard | Beschreibung |
|-------------|-----|----------|--------------|
| `title` | string | *(erforderlich)* | Card-Titel |
| `text` | string | *(erforderlich)* | Beschreibungstext |
| `icon` | string\|null | `null` | Tabler Icon Name |
| `iconColor` | string | `'primary'` | Icon-Farbe |
| `linkUrl` | string\|null | `null` | Link-URL |
| `linkText` | string\|null | `null` | Link-Text |
| `variant` | string | `'default'` | `default`, `highlight`, `minimal`, `horizontal` |
| `fullHeight` | bool | `true` | Volle Hoehe im Grid |

```twig
<twig:Tabler:FeatureCard
    title="Sichere Anmeldung"
    text="Enterprise-Sicherheit fuer alle Anwendungen"
    icon="shield-lock"
    iconColor="blue"
    linkUrl="/docs/security"
    linkText="Mehr erfahren"
    variant="highlight"
/>
```

### CodeBlock

Code-Block mit Sprach-Klasse und Copy-Button. Nutzt intern den `clipboard` Stimulus Controller.

| Eigenschaft | Typ | Standard | Beschreibung |
|-------------|-----|----------|--------------|
| `language` | string | `'php'` | `php`, `twig`, `html`, `css`, `js`, `json`, `yaml`, `bash`, `sql`, `plaintext` |
| `title` | string\|null | `null` | Titel ueber dem Code-Block |
| `code` | string\|null | `null` | Code-Inhalt als Property |
| `lineNumbers` | bool | `false` | Zeilennummern anzeigen |
| `compact` | bool | `false` | Kompakte Darstellung |

Code kann als `code`-Property oder als Slot-Inhalt uebergeben werden.

```twig
{# Als Property #}
<twig:Tabler:CodeBlock language="bash" :code="'composer require jostkleigrewe/symfony-tabler-bundle'" />

{# Als Slot-Inhalt #}
<twig:Tabler:CodeBlock language="php" title="Beispiel">
$builder->add('email', FloatingUnderlineType::class, [
    'icon' => 'mail',
]);
</twig:Tabler:CodeBlock>
```

---

## Feedback-Komponenten

### Alert

Alert-Komponente fuer Benachrichtigungen mit automatischem Icon je nach Typ.

| Eigenschaft | Typ | Standard | Beschreibung |
|-------------|-----|----------|--------------|
| `type` | string | `'info'` | `success`, `info`, `warning`, `danger` |
| `title` | string\|null | `null` | Alert-Titel |
| `text` | string\|null | `null` | Alert-Text |
| `icon` | string\|null | `null` | Eigenes Icon (sonst automatisch) |
| `dismissible` | bool | `false` | Schliessbar |
| `important` | bool | `false` | Ausgefuellter Hintergrund |

Automatische Icons: `success` = check, `warning` = alert-triangle, `danger` = alert-circle, `info` = info-circle.

```twig
<twig:Tabler:Alert type="success" title="Gespeichert!" text="Aenderungen wurden uebernommen." />

<twig:Tabler:Alert type="warning" :dismissible="true" :important="true">
    Diese Aktion kann <strong>nicht rueckgaengig</strong> gemacht werden.
</twig:Tabler:Alert>
```

### EmptyState

Leerer Zustand fuer Listen ohne Eintraege mit optionalem Action-Button.

| Eigenschaft | Typ | Standard | Beschreibung |
|-------------|-----|----------|--------------|
| `title` | string | *(erforderlich)* | Titel |
| `text` | string\|null | `null` | Beschreibungstext |
| `icon` | string | `'inbox'` | Icon Name |
| `iconColor` | string | `'secondary'` | Icon-Farbe |
| `actionUrl` | string\|null | `null` | Button-URL |
| `actionLabel` | string\|null | `null` | Button-Text |
| `actionVariant` | string | `'primary'` | Button-Variante |

```twig
<twig:Tabler:EmptyState
    title="Keine Ergebnisse"
    text="Versuche andere Suchkriterien"
    icon="search"
    actionUrl="/items/new"
    actionLabel="Neuen Eintrag erstellen"
/>
```

### HelpTooltip

Hover-Tooltip mit Info-Icon fuer kontextuelle Hilfe.

| Eigenschaft | Typ | Standard | Beschreibung |
|-------------|-----|----------|--------------|
| `text` | string | *(erforderlich)* | Tooltip-Text |
| `title` | string\|null | `null` | Tooltip-Titel |
| `icon` | string | `'info-circle'` | Icon Name |
| `placement` | string | `'top'` | `top`, `right`, `bottom`, `left` |
| `color` | string | `'secondary'` | Icon-Farbe |

```twig
Redirect URI <twig:Tabler:HelpTooltip text="Die URL zu der nach der Anmeldung weitergeleitet wird." />
```

---

## Navigation

### ActionList / ActionItem

Schnellzugriff-Liste mit klickbaren Elementen. `ActionList` umschliesst `ActionItem`-Komponenten.

**ActionList:**

| Eigenschaft | Typ | Standard | Beschreibung |
|-------------|-----|----------|--------------|
| `title` | string\|null | `null` | Listen-Titel |
| `card` | bool | `true` | Als Card rendern |
| `flush` | bool | `true` | Flush-Style |

**ActionItem:**

| Eigenschaft | Typ | Standard | Beschreibung |
|-------------|-----|----------|--------------|
| `label` | string | *(erforderlich)* | Haupttext |
| `description` | string\|null | `null` | Beschreibung |
| `url` | string\|null | `null` | Link-Ziel |
| `icon` | string\|null | `null` | Icon Name |
| `iconColor` | string | `'blue'` | Icon-Farbe |
| `badge` | string\|null | `null` | Badge-Text |
| `badgeColor` | string | `'azure'` | Badge-Farbe |
| `arrow` | bool | `true` | Pfeil rechts |
| `disabled` | bool | `false` | Deaktiviert |
| `size` | string | `'md'` | `sm`, `md`, `lg` |

```twig
<twig:Tabler:ActionList title="Schnellzugriff">
    <twig:Tabler:ActionItem label="Profil" description="Persoenliche Daten" url="/profile" icon="user" />
    <twig:Tabler:ActionItem label="Sicherheit" url="/security" icon="shield" badge="3" badgeColor="red" />
    <twig:Tabler:ActionItem label="Einstellungen" url="/settings" icon="settings" />
</twig:Tabler:ActionList>
```

### Stepper

Prozess-Visualisierung mit nummerierten Schritten.

| Eigenschaft | Typ | Standard | Beschreibung |
|-------------|-----|----------|--------------|
| `steps` | array | *(erforderlich)* | `[{title, text?, icon?, icon_color?}]` |
| `variant` | string | `'default'` | `default`, `compact`, `horizontal` |
| `columns` | int | `4` | Spalten pro Zeile (1-4) |
| `showNumbers` | bool | `true` | Nummern anzeigen |
| `showConnectors` | bool | `false` | Verbindungslinien anzeigen |

```twig
{% set steps = [
    {title: 'Registrierung', text: 'Account anlegen', icon: 'ti-user-plus', icon_color: 'blue'},
    {title: 'Verifizierung', text: 'E-Mail bestaetigen', icon: 'ti-mail-check', icon_color: 'green'},
    {title: 'Konfiguration', text: 'Profil einrichten', icon: 'ti-settings', icon_color: 'purple'},
] %}
<twig:Tabler:Stepper :steps="steps" variant="default" :columns="3" />
```

---

## Theming-Komponenten

### ThemeSwitch

Dark/Light Mode Toggle mit drei Varianten. Nutzt intern den `theme` Stimulus Controller.

| Eigenschaft | Typ | Standard | Beschreibung |
|-------------|-----|----------|--------------|
| `variant` | string | `'toggle'` | `toggle` (2-State), `tristate` (3-Positionen), `cycle` (Durchklicken) |
| `size` | string | `'normal'` | `normal`, `compact` |
| `title` | string | `'Switch theme'` | Tooltip-Text |
| `showLabel` | bool | `false` | Label anzeigen |
| `label` | string | `'Theme'` | Label-Text |
| `class` | string | `''` | Zusaetzliche CSS-Klassen |

```twig
<twig:Tabler:ThemeSwitch />
<twig:Tabler:ThemeSwitch variant="tristate" />
<twig:Tabler:ThemeSwitch variant="cycle" size="compact" />
```

### ThemePicker

Farbthema-Auswahl mit 6 eingebauten Themes und optionalem Dark/Light Toggle.

| Eigenschaft | Typ | Standard | Beschreibung |
|-------------|-----|----------|--------------|
| `showModeToggle` | bool | `true` | Dark/Light Toggle anzeigen |
| `showThemeSelector` | bool | `true` | Farbauswahl anzeigen |
| `variant` | string | `'default'` | `default`, `compact`, `inline` |
| `themes` | array | *(6 Themes)* | `{name: {label, color}}` |

Eingebaute Themes: EURIP (#0f3d91), Forest (#059669), Sunset (#ea580c), Ocean (#0891b2),
Purple (#7c3aed), Rose (#e11d48).

```twig
<twig:Tabler:ThemePicker />
<twig:Tabler:ThemePicker variant="compact" :showModeToggle="false" />
```

---

## Dekorative Komponenten

### PatternBackground

Animierte Hintergrund-Muster fuer Hero-Sections, Headers, Cards und mehr. 14 verschiedene
Muster mit konfigurierbarem Theme, Groesse, Intensitaet und Geschwindigkeit.

| Eigenschaft | Typ | Standard | Beschreibung |
|-------------|-----|----------|--------------|
| `pattern` | string | `'particles'` | Muster-Typ (siehe unten) |
| `theme` | string | `'dark'` | `dark`, `light`, `gradient`, `transparent` |
| `size` | string | `'auto'` | `hero`, `section`, `header`, `footer`, `card`, `compact`, `divider`, `auto` |
| `intensity` | string | `'medium'` | `subtle`, `medium`, `intense` |
| `speed` | string | `'normal'` | `slow`, `normal`, `fast`, `static` |
| `tag` | string | `'div'` | HTML-Tag: `div`, `section`, `header`, `footer`, `aside` |
| `class` | string | `''` | Zusaetzliche CSS-Klassen |
| `ssoIcons` | array | *(10 Icons)* | Icons fuer `particles-sso` |
| `particleCount` | int | `25` | Partikel-Anzahl (1-25) |
| `iconCount` | int | `20` | Icon-Anzahl fuer SSO (1-20) |
| `nodeCount` | int | `12` | Netzwerk-Knoten (1-12) |
| `connectionType` | string | `'css'` | Verbindungstyp: `css`, `svg` |
| `wavePosition` | string | `'bottom'` | Wellen-Position: `top`, `bottom`, `both` |

**Verfuegbare Muster:** `particles`, `particles-sso`, `particles-network`, `waves`, `geometric`,
`blob`, `grid`, `topo`, `dots`, `circuit`, `stream`, `rain`, `sandstorm`, `autumn`.

```twig
<twig:Tabler:PatternBackground pattern="particles" theme="dark" size="hero">
    <div class="container py-5 text-center text-white">
        <h1>Willkommen</h1>
    </div>
</twig:Tabler:PatternBackground>

<twig:Tabler:PatternBackground pattern="waves" theme="gradient" size="section" speed="slow" />
```

Fuer CSS-Einbindung und Performance-Hinweise siehe [Theming & CSS](theming.de.md#pattern-hintergruende).

---

## Siehe auch

- [Installationsanleitung](installation.de.md) — Setup und CSS-Einbindung
- [Stimulus Controller](stimulus-controllers.de.md) — JavaScript-Funktionalitaet der Komponenten
- [Theming & CSS](theming.de.md) — Farbthemen und Dark Mode
- [Showcase / Demo](showcase.de.md) — Alle Komponenten live ansehen
