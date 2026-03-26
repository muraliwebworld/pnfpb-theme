# PNFPB Theme

Official WordPress theme for **[pnfpb.com](https://pnfpb.com)** — the home of the *Push Notification for Post and BuddyPress* (PNFPB) WordPress plugin.

---

## Overview

PNFPB Theme is a custom, privacy-respecting WordPress community theme built from the ground up for [pnfpb.com](https://pnfpb.com). It provides a social-media-style experience powered by [BuddyPress](https://buddypress.org/) — activity streams, group discussions, member profiles, and real-time push notifications via the PNFPB plugin.

| Detail | Value |
|---|---|
| **Theme Name** | PNFPB |
| **Version** | 1.0.0 |
| **Author** | Muralidharan Ramasamy / Indiacitys.com Technologies |
| **Author URI** | https://www.muraliwebworld.com |
| **Theme URI** | https://pnfpb.com |
| **Requires WordPress** | 6.2+ |
| **Requires PHP** | 8.1+ |
| **Tested up to** | 6.6 |
| **License** | GNU General Public License v2 or later |
| **Text Domain** | `pnfpb-theme` |

---

## Features

- **BuddyPress Nouveau** — full integration with activity streams, groups, member directories, messages, and notifications
- **Responsive layout** — CSS Grid-based two-column layout (content + sidebar) that collapses gracefully from desktop → tablet → mobile
- **Activity & Groups directory nav counts** — server-side PHP count fallback ensures counts always appear (even if BP Nouveau AJAX fails)
- **Front-page hero slider** — customizable hero with slide title, description, image, and CTA buttons
- **Widget sidebar** — overflow-safe widgets with word-break and image containment
- **Custom page templates** — Contact, Privacy Policy, Terms & Conditions, Full Width, Activity directory, Groups directory
- **Customizer integration** — colors, footer text, social links, hero content
- **SEO helpers** — `<title>` tag support, clean markup
- **Security hardened** — `ABSPATH` checks, `esc_*`/`wp_kses_*` throughout, nonce on contact form, honeypot anti-spam
- **PWA / push notification ready** — designed to work alongside the PNFPB plugin
- **Translation ready** — full `.pot` file support via `pnfpb-theme` text domain
- **Accessibility** — skip-link, ARIA roles, screen-reader text, `alt` attributes enforced

---

## Requirements

| Dependency | Minimum Version | Notes |
|---|---|---|
| WordPress | 6.2 | Required |
| PHP | 8.1 | Required |
| BuddyPress | 11.0+ | Required for community features |
| BuddyPress Nouveau template pack | any | Activated inside BuddyPress settings |

---

## Installation

1. Download or clone this repository.
2. Copy the `pnfpb-theme/` folder into your WordPress installation at `wp-content/themes/pnfpb-theme`.
3. In the WordPress admin go to **Appearance → Themes** and activate **PNFPB**.
4. Ensure BuddyPress is installed, activated, and the **Nouveau** template pack is selected under **Settings → BuddyPress → Options**.

---

## Directory Structure

```
pnfpb-theme/
├── style.css                  # Theme declaration + all front-end styles
├── functions.php              # Entry point — loads all includes
├── index.php                  # Blog / fallback template
├── page.php                   # Default page template
├── single.php                 # Single post template
├── archive.php                # Archive template
├── search.php                 # Search results template
├── 404.php                    # 404 error template
├── front-page.php             # Front page (hero slider + features)
├── header.php                 # Site header
├── footer.php                 # Site footer
├── sidebar.php                # Sidebar (selects correct widget area)
├── comments.php               # Comments template
│
├── assets/
│   ├── css/
│   │   ├── buddypress.css     # All BuddyPress-specific styles
│   │   └── editor-style.css   # Block editor styles
│   └── js/
│       ├── main.js            # General JS (mobile menu, misc)
│       ├── navigation.js      # Keyboard-accessible navigation
│       └── slider.js          # Front-page hero slider
│
├── buddypress/
│   ├── activity/
│   │   └── entry.php          # Activity stream item override
│   ├── groups/
│   │   └── single/            # Group single-page overrides
│   └── members/               # Member-page overrides
│
├── inc/
│   ├── setup.php              # Theme support, image sizes, nav menus, widget areas
│   ├── enqueue.php            # Script/style enqueue (conditional BP stylesheet)
│   ├── buddypress.php         # BP integration: template stack, body classes, count fallback
│   ├── seo.php                # Breadcrumbs (disabled), document title helpers
│   ├── security.php           # Content Security Policy, login hardening
│   ├── template-functions.php # pnfpb_has_sidebar(), pnfpb_content_area_class(), pagination
│   ├── customizer.php         # Customizer panels: colors, hero, footer, social
│   └── widgets.php            # Custom widget registrations
│
├── page-templates/
│   ├── page-activity.php      # BuddyPress activity directory
│   ├── page-groups.php        # BuddyPress groups directory
│   ├── page-full-width.php    # Full-width (no sidebar)
│   ├── page-contact.php       # Contact Us page
│   ├── page-privacy.php       # Privacy Policy page
│   └── page-terms.php         # Terms & Conditions page
│
├── template-parts/
│   ├── content-page.php       # Generic page content
│   ├── content-single.php     # Single post content
│   ├── content-post.php       # Post card (loop)
│   └── content-none.php       # No results found
│
└── languages/
    └── pnfpb-theme.pot        # Translation template
```

---

## Customizer Options

| Panel | Setting | Description |
|---|---|---|
| **Colors** | Primary color | Used for nav underlines, badges, buttons, links |
| **Colors** | Header background / text | Site header colors |
| **Colors** | Footer background / text | Site footer colors |
| **Front Page — Hero** | Slide 1–3 title, text, image, CTA URL/label | Hero slider content |
| **Footer** | About text | Short description in footer brand column |
| **Social Links** | Twitter, GitHub, WordPress.org | URLs for footer social icons |

---

## BuddyPress Integration Notes

- **Template stack**: The theme adds its own `buddypress/` directory to the BP template stack, allowing granular overrides without modifying plugin files.
- **Nav count fallback**: BP Nouveau renders `—` dashes as placeholders for all directory nav counts and replaces them via Backbone AJAX. If AJAX fails (caching, JS conflict), `pnfpb_bp_nav_count_fallback()` in `inc/buddypress.php` primes the correct counts from PHP on `wp_footer` and also via a 1 500 ms JS retry.
- **Sidebar on BP pages**: The sidebar is hidden on all BuddyPress pages by default (BP provides its own navigation). It can be re-enabled per page via the customizer.

---

## Development

```bash
# Clone
git clone <repo-url> pnfpb-theme

# No build step required — vanilla PHP/CSS/JS only
# All styles are in style.css and assets/css/buddypress.css
# All scripts are in assets/js/
```

There is no npm/webpack build process — all CSS and JS are hand-authored vanilla files for maximum site-speed and zero build dependencies.

---

## Changelog

### 1.0.0
- Initial release
- Full BuddyPress Nouveau integration (activity, groups, members, messages, notifications)
- Responsive two-column CSS Grid layout
- Front-page hero slider
- Custom page templates (contact, privacy, terms, full-width, activity, groups)
- Customizer support (colors, hero, footer, social)
- Security hardening (CSP, escaping, nonce, honeypot)
- BP directory nav count fallback (PHP + JS, zero extra DB queries)
- Translation-ready (`pnfpb-theme.pot`)

---

## License

This theme is licensed under the [GNU General Public License v2 or later](https://www.gnu.org/licenses/gpl-2.0.html).

---

## Author

**Muralidharan Ramasamy**  
[muraliwebworld.com](https://www.muraliwebworld.com) · [indiacitys.com](https://www.indiacitys.com)  
Plugin: [Push Notification for Post and BuddyPress](https://wordpress.org/plugins/push-notification-for-post-and-buddypress/)
