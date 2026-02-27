> 🇩🇪 [Deutsche Version](components.de.md) | 🇬🇧 **English Version**

# Twig Components

The bundle provides 15 Symfony UX TwigComponents, all using the `Tabler:` prefix. Use them in templates with the `<twig:Tabler:ComponentName>` syntax.

All components are defined as `final` PHP classes in `src/Twig/Components/` with the `#[AsTwigComponent]` attribute. Templates live in `templates/components/`.

---

## Layout Components

### PageHeader

Full-featured page header with icon/avatar, title, breadcrumbs, status badge, meta info, progress bar, and an `actions` block.

| Property | Type | Default | Description |
|----------|------|---------|-------------|
| `title` | string | *(required)* | Main heading |
| `pretitle` | string or null | `null` | Small label above the title |
| `subtitle` | string or null | `null` | Description below the title |
| `icon` | string or null | `null` | Tabler icon name |
| `iconColor` | string | `'azure'` | Icon background color |
| `avatar` | string or null | `null` | Avatar image URL (replaces icon) |
| `avatarInitials` | string or null | `null` | Initials fallback for avatar |
| `avatarSize` | string | `'lg'` | Avatar/icon size |
| `variant` | string | `'default'` | `default`, `bordered`, `compact` |
| `container` | string | `'xl'` | `xl`, `fluid`, `none` |
| `breadcrumbs` | array | `[]` | `[{label, url?}, ...]` |
| `status` | string or null | `null` | Status badge text |
| `statusColor` | string | `'secondary'` | Badge color |
| `meta` | array | `[]` | `[{icon?, text, url?}, ...]` |
| `progress` | int or null | `null` | Progress bar (0-100) |
| `progressColor` | string | `'primary'` | Progress bar color |
| `class` | string | `''` | Additional CSS classes |

**Blocks:** `actions` -- place buttons or links in the header's right side.

```twig
<twig:Tabler:PageHeader
    title="Users"
    pretitle="Administration"
    subtitle="Manage your team members"
    icon="users"
    iconColor="blue"
    :breadcrumbs="[{label: 'Home', url: '/'}, {label: 'Users'}]"
>
    <twig:block name="actions">
        <a href="{{ path('user_new') }}" class="btn btn-primary">Add User</a>
    </twig:block>
</twig:Tabler:PageHeader>
```

### Panel

Generic card container with title, subtitle, icon, and a default content slot.

| Property | Type | Default | Description |
|----------|------|---------|-------------|
| `title` | string | *(required)* | Panel heading |
| `subtitle` | string or null | `null` | Text below the title |
| `icon` | string or null | `null` | Tabler icon name |
| `iconColor` | string | `'azure'` | Icon background color |
| `centered` | bool | `true` | Center the panel horizontally |
| `size` | string | `'md'` | Width: `sm`, `md`, `lg` |

```twig
<twig:Tabler:Panel title="Login" subtitle="Enter your credentials" icon="lock" size="sm">
    {{ form(loginForm) }}
</twig:Tabler:Panel>
```

### CollapsiblePanel

Expandable/collapsible panel with ARIA support, powered by the `collapsible` Stimulus controller.

| Property | Type | Default | Description |
|----------|------|---------|-------------|
| `title` | string | *(required)* | Panel heading |
| `icon` | string or null | `null` | Tabler icon name |
| `iconColor` | string | `'primary'` | Icon color |
| `expanded` | bool | `false` | Initially expanded |
| `panelId` | string or null | `null` | Unique ID (auto-generated) |
| `variant` | string | `'default'` | `default`, `bordered`, `card`, `subtle` |
| `subtitle` | string or null | `null` | Help text below the title |

```twig
<twig:Tabler:CollapsiblePanel title="Advanced Options" icon="settings" :expanded="true" variant="bordered">
    <p>Additional configuration options...</p>
</twig:Tabler:CollapsiblePanel>
```

---

## Data Display Components

### StatCard

Dashboard statistics card with label, value, icon, trend indicator, and optional link.

| Property | Type | Default | Description |
|----------|------|---------|-------------|
| `label` | string | *(required)* | Metric name |
| `value` | string | *(required)* | Metric value |
| `icon` | string or null | `null` | Tabler icon name |
| `iconColor` | string | `'azure'` | Icon background color |
| `hint` | string or null | `null` | Small text below the value |
| `trend` | string or null | `null` | `up`, `down`, or `null` |
| `url` | string or null | `null` | Clickable link target |

```twig
<twig:Tabler:StatCard
    label="Total Users"
    value="1,234"
    icon="users"
    iconColor="blue"
    hint="+12% from last month"
    trend="up"
/>
```

### FeatureCard

Feature showcase card for marketing pages or feature lists.

| Property | Type | Default | Description |
|----------|------|---------|-------------|
| `title` | string | *(required)* | Feature name |
| `text` | string | *(required)* | Feature description |
| `icon` | string or null | `null` | Tabler icon name |
| `iconColor` | string | `'primary'` | Icon color |
| `linkUrl` | string or null | `null` | Call-to-action URL |
| `linkText` | string or null | `null` | Call-to-action text |
| `variant` | string | `'default'` | `default`, `highlight`, `minimal`, `horizontal` |
| `fullHeight` | bool | `true` | Equal height in grid layouts |

```twig
<twig:Tabler:FeatureCard
    title="Secure Login"
    text="Enterprise-grade security for all your applications"
    icon="shield-lock"
    iconColor="blue"
    linkUrl="/docs/security"
    linkText="Learn more"
    variant="highlight"
/>
```

### CodeBlock

Code display with language class and optional copy-to-clipboard button (via the `clipboard` Stimulus controller).

| Property | Type | Default | Description |
|----------|------|---------|-------------|
| `language` | string | `'php'` | `php`, `twig`, `html`, `css`, `js`, `json`, `yaml`, `bash`, `sql`, `plaintext` |
| `title` | string or null | `null` | Title above the code block |
| `code` | string or null | `null` | Code content (alternative to slot) |
| `lineNumbers` | bool | `false` | Show line numbers |
| `compact` | bool | `false` | Reduced padding |

```twig
<twig:Tabler:CodeBlock language="php" title="Example">
    $builder->add('email', FloatingUnderlineType::class, [
        'icon' => 'mail',
    ]);
</twig:Tabler:CodeBlock>
```

---

## Feedback Components

### Alert

Notification banner with type-based auto-icon, optional title, and dismissible support.

| Property | Type | Default | Description |
|----------|------|---------|-------------|
| `type` | string | `'info'` | `success`, `info`, `warning`, `danger` |
| `title` | string or null | `null` | Alert heading |
| `text` | string or null | `null` | Alert body text |
| `icon` | string or null | `null` | Custom icon (auto-selected by type if null) |
| `dismissible` | bool | `false` | Show close button |
| `important` | bool | `false` | Filled background style |

Auto-selected icons: `success` = check, `warning` = alert-triangle, `danger` = alert-circle, `info` = info-circle.

```twig
<twig:Tabler:Alert type="warning" title="Warning" text="This action cannot be undone." :dismissible="true" />
```

### EmptyState

Placeholder for empty lists or search results with an optional call-to-action button.

| Property | Type | Default | Description |
|----------|------|---------|-------------|
| `title` | string | *(required)* | Heading |
| `text` | string or null | `null` | Description |
| `icon` | string | `'inbox'` | Tabler icon name |
| `iconColor` | string | `'secondary'` | Icon color |
| `actionUrl` | string or null | `null` | Button URL |
| `actionLabel` | string or null | `null` | Button text |
| `actionVariant` | string | `'primary'` | Button color variant |

```twig
<twig:Tabler:EmptyState
    title="No users yet"
    text="Add your first user to get started"
    icon="users"
    actionUrl="/users/new"
    actionLabel="Add User"
/>
```

### HelpTooltip

Inline info icon with a hover tooltip for contextual help.

| Property | Type | Default | Description |
|----------|------|---------|-------------|
| `text` | string | *(required)* | Tooltip content |
| `title` | string or null | `null` | Tooltip heading |
| `icon` | string | `'info-circle'` | Tabler icon name |
| `placement` | string | `'top'` | `top`, `right`, `bottom`, `left` |
| `color` | string | `'secondary'` | Icon color |

```twig
Redirect URI <twig:Tabler:HelpTooltip text="The URL where users are sent after login" />
```

---

## Navigation Components

### ActionList

Wrapper component for `ActionItem` elements, rendered as a card with a list group.

| Property | Type | Default | Description |
|----------|------|---------|-------------|
| `title` | string or null | `null` | List heading |
| `card` | bool | `true` | Wrap in a card |
| `flush` | bool | `true` | Flush style (no inner borders) |

### ActionItem

Individual navigation/action entry with icon, description, badge, and arrow.

| Property | Type | Default | Description |
|----------|------|---------|-------------|
| `label` | string | *(required)* | Main text |
| `description` | string or null | `null` | Secondary text |
| `url` | string or null | `null` | Link target |
| `icon` | string or null | `null` | Tabler icon name |
| `iconColor` | string | `'blue'` | Icon background color |
| `badge` | string or null | `null` | Badge text |
| `badgeColor` | string | `'azure'` | Badge color |
| `arrow` | bool | `true` | Show right arrow |
| `disabled` | bool | `false` | Disabled state |
| `size` | string | `'md'` | `sm`, `md`, `lg` |

```twig
<twig:Tabler:ActionList title="Quick Access">
    <twig:Tabler:ActionItem label="Profile" description="Edit personal data" url="/profile" icon="user" />
    <twig:Tabler:ActionItem label="Security" url="/security" icon="shield" iconColor="green" badge="3" badgeColor="red" />
    <twig:Tabler:ActionItem label="Billing" url="/billing" icon="credit-card" :disabled="true" />
</twig:Tabler:ActionList>
```

### Stepper

Process visualization with numbered steps, optional icons, and descriptions.

| Property | Type | Default | Description |
|----------|------|---------|-------------|
| `steps` | array | *(required)* | `[{title, text?, icon?, icon_color?}]` |
| `variant` | string | `'default'` | `default`, `compact`, `horizontal` |
| `columns` | int | `4` | Grid columns (1-4) |
| `showNumbers` | bool | `true` | Display step numbers |
| `showConnectors` | bool | `false` | Show connector lines between steps |

```twig
{% set steps = [
    {title: 'Discovery', text: 'Find endpoints', icon: 'ti-radar', icon_color: 'blue'},
    {title: 'Authorize', text: 'Start login flow', icon: 'ti-shield-lock', icon_color: 'green'},
    {title: 'Token', text: 'Exchange code for token', icon: 'ti-key', icon_color: 'purple'},
] %}
<twig:Tabler:Stepper :steps="steps" variant="default" :showConnectors="true" />
```

---

## Theming Components

### ThemeSwitch

Day/night toggle for light/dark mode switching. Uses the `theme` Stimulus controller.

| Property | Type | Default | Description |
|----------|------|---------|-------------|
| `variant` | string | `'toggle'` | `toggle` (2-state), `tristate` (light/auto/dark), `cycle` (click-through) |
| `size` | string | `'normal'` | `normal`, `compact` |
| `title` | string | `'Switch theme'` | Tooltip text |
| `showLabel` | bool | `false` | Show text label next to toggle |
| `label` | string | `'Theme'` | Label text |
| `class` | string | `''` | Additional CSS classes |

```twig
<twig:Tabler:ThemeSwitch />
<twig:Tabler:ThemeSwitch variant="tristate" size="compact" />
```

### ThemePicker

Combined color theme selector and dark/light mode toggle.

| Property | Type | Default | Description |
|----------|------|---------|-------------|
| `showModeToggle` | bool | `true` | Show the dark/light mode toggle |
| `showThemeSelector` | bool | `true` | Show color theme palette |
| `variant` | string | `'default'` | `default`, `compact`, `inline` |
| `themes` | array | *(6 built-in)* | `{key: {label, color}}` |

Built-in themes: EURIP (#0f3d91), Forest (#059669), Sunset (#ea580c), Ocean (#0891b2), Purple (#7c3aed), Rose (#e11d48).

```twig
<twig:Tabler:ThemePicker />
<twig:Tabler:ThemePicker variant="compact" :showModeToggle="false" />
```

---

## Decorative Components

### PatternBackground

Animated CSS background patterns for hero sections, headers, footers, cards, and more. Requires `pattern-backgrounds.css`.

| Property | Type | Default | Description |
|----------|------|---------|-------------|
| `pattern` | string | `'particles'` | See pattern list below |
| `theme` | string | `'dark'` | `dark`, `light`, `gradient`, `transparent` |
| `size` | string | `'auto'` | `hero`, `section`, `header`, `footer`, `card`, `compact`, `divider`, `auto` |
| `intensity` | string | `'medium'` | `subtle`, `medium`, `intense` |
| `speed` | string | `'normal'` | `slow`, `normal`, `fast`, `static` |
| `tag` | string | `'div'` | HTML element: `div`, `section`, `header`, `footer`, `aside` |
| `class` | string | `''` | Additional CSS classes |
| `ssoIcons` | array | *(10 defaults)* | Icons for `particles-sso` pattern |
| `particleCount` | int | `25` | Particle count (1-25) |
| `iconCount` | int | `20` | Icon count for SSO (1-20) |
| `nodeCount` | int | `12` | Node count for network (1-12) |
| `connectionType` | string | `'css'` | `css` or `svg` (network pattern) |
| `wavePosition` | string | `'bottom'` | `top`, `bottom`, `both` (waves pattern) |

**Available patterns:** `particles`, `particles-sso`, `particles-network`, `waves`, `geometric`, `blob`, `grid`, `topo`, `dots`, `circuit`, `stream`, `rain`, `sandstorm`, `autumn`.

```twig
<twig:Tabler:PatternBackground pattern="particles" theme="dark" size="hero">
    <div class="container py-5">
        <h1 class="text-white">Welcome</h1>
    </div>
</twig:Tabler:PatternBackground>
```

See the [Theming & CSS](theming.en.md) documentation for details on including the required CSS and performance considerations.

## See Also

- [Installation](installation.en.md) -- Setup and configuration
- [Form Types](form-types.en.md) -- Custom form types
- [Stimulus Controllers](stimulus-controllers.en.md) -- Controllers used by interactive components
- [Theming & CSS](theming.en.md) -- CSS files, themes, dark/light mode
- [Showcase](showcase.en.md) -- Live demos of all components
