# Ski Club WordPress Theme — Implementation Plan

## Context
Build a brand-new custom WordPress classic PHP theme for the Little Heiskell Ski Club. The reference design is at https://v0-ski-club-website-nu.vercel.app/. WordPress 6.9 is installed locally at `t:\Ski Club Website\playground\app\public`. The current Twenty Twenty-Five theme should be fully replaced. ACF Free plugin will be installed for custom field management. Both Trips and Events will be managed as Custom Post Types in the WP admin. Logo will be a text placeholder ("LHSC") swappable later via Customizer.

---

## Theme Structure

**Theme slug:** `ski-club`  
**Theme directory:** `wp-content/themes/ski-club/`

```
ski-club/
├── style.css              ← Theme header + CSS design tokens (:root vars)
├── functions.php          ← Master includes + theme setup hooks
├── index.php              ← Required WP fallback
├── header.php             ← Sticky nav with logo + 6 links + "Apply Now" button
├── footer.php             ← 4-column footer (brand, links, activities, contact)
├── front-page.php         ← Home page (6 sections)
├── page-about.php         ← About page (slug-matched, 6 sections)
├── page-trips.php         ← Trips page (queries trip CPT)
├── page-events.php        ← Events page (queries event CPT)
├── page-join.php          ← Placeholder: "Join — coming soon"
├── page-contact.php       ← Placeholder: "Contact — coming soon"
├── single-trip.php        ← Optional: individual trip detail page
├── inc/
│   ├── cpt.php            ← Register `trip` + `event` CPTs + ACF field groups in PHP
│   ├── customizer.php     ← Customizer: hero image + 3 gallery photos
│   └── enqueue.php        ← wp_enqueue_scripts for styles and JS
└── assets/
    ├── css/
    │   ├── main.css       ← All component styles (14 organized sections)
    │   └── responsive.css ← Media queries: 1024px, 768px, 480px
    ├── js/
    │   └── main.js        ← Mobile nav toggle, sticky header scroll class
    └── images/
        └── hero-fallback.jpg  ← Compressed mountain photo for hero before Customizer is set
```

---

## Checklist

### Phase 1 — Theme Bootstrap
- [x] Create `style.css` with theme header comment + CSS custom properties (colors, typography, spacing, shadows, transitions)
- [x] Create `index.php` (required WordPress fallback)
- [x] Create `inc/enqueue.php` — enqueue Inter from Google Fonts, style.css, main.css, responsive.css, main.js (footer)
- [x] Create `inc/cpt.php` — register `trip` and `event` custom post types + ACF field groups in PHP
- [x] Create `inc/customizer.php` — register hero image setting + 3 gallery photo settings
- [x] Create `functions.php` — require inc files, add_theme_support, register nav menus, add_image_size, helper functions

### Phase 2 — Shared Templates
- [x] Create `header.php` — sticky nav: "LHSC" text logo, Home/About/Trips/Events/Join/Contact links, "Apply Now" button, mobile hamburger toggle
- [x] Create `footer.php` — 4-column grid: branding, quick links, activities, contact info + copyright bar

### Phase 3 — CSS
- [x] Create `assets/css/main.css` with 14 sections: layout utils, buttons, cards, header/nav, hero, activity cards, trip cards, gallery, about page, trips page, events page, footer, CTA, SVG icon size
- [x] Create `assets/css/responsive.css` — breakpoints at 1024px, 768px, 480px

### Phase 4 — JavaScript
- [x] Create `assets/js/main.js` — mobile nav toggle (aria-expanded), sticky header `.scrolled` class, smooth scroll for anchor links

### Phase 5 — Page Templates

#### Home (`front-page.php`) — 6 sections
- [x] Section 1: Hero — full-viewport, Customizer-driven background image, overlay, headline, tagline, 2 CTA buttons, service area text
- [x] Section 2: Year-Round Activities — 4-card grid (Skiing, Biking, Kayaking, Social Events) with inline SVG icons
- [x] Section 3: About blurb — "More Than Just a Ski Club" card with link to /about
- [x] Section 4: 2026 Ski Trips — WP_Query for `trip` CPT where `trip_featured = 1`, display cards with image, dates, location badge
- [x] Section 5: Beyond the Slopes — 3 gallery images from Customizer with overlay labels (Biking, Kayaking, Social)
- [x] Section 6: CTA — "Ready for Your Next Adventure?" with two buttons

#### About (`page-about.php`) — 6 sections
- [x] Section 1: Hero — "A Legacy of Adventure Since 1967" heading
- [x] Section 2: Stats grid — 4 cards: 1967 / 5,000+ / 3 / 57+ with inline SVG icons
- [x] Section 3: Our History — 2-column: 3 history paragraphs left, image placeholder right
- [x] Section 4: Legend of Little Heiskell — full-width card with origin story text
- [x] Section 5: Blue Ridge Ski Council — centered text + external link button
- [x] Section 6: CTA — "Join Our Community" with "Become a Member" button

#### Trips (`page-trips.php`) — 5 sections
- [x] Section 1: Hero — "2026 Ski Season" heading
- [x] Section 2: Trip cards — WP_Query ALL published trips ordered by menu_order; each card: image, title, dates, location, highlights list, inquiry button
- [x] Section 3: Service Overview — 3 hardcoded cards: Travel Arrangements, Group Accommodations, Lift Passes
- [x] Section 4: Past Destinations — hardcoded badge tags (Timberline, Jay Peak, Zermatt, Whistler, Steamboat Springs)
- [x] Section 5: CTA — "Ready to Hit the Slopes?"

#### Events (`page-events.php`) — 5 sections
- [x] Section 1: Hero — "Year-Round Adventure" heading
- [x] Section 2: Upcoming Events — WP_Query for `event` CPT ordered by `event_date ASC`, display cards with date, time, location, description, category badge
- [x] Section 3: Activities — 4 alternating image/text rows (Skiing, Biking, Kayaking, Social Events)
- [x] Section 4: Monthly Meetings info card — "Third Thursday, 7:00 PM, Ledo Pizza, Hagerstown MD"
- [x] Section 5: CTA — "Become a Member" + "View Ski Trips" buttons

#### Placeholders
- [x] Create `page-join.php` — minimal placeholder with "Join" heading + "coming soon" text
- [x] Create `page-contact.php` — minimal placeholder with "Contact" heading + "coming soon" text

### Phase 6 — Plugin & Admin Setup
- [x] Install ACF Free plugin (`wp-content/plugins/`)
- [x] Activate ACF via WP Admin → Plugins
- [x] Activate `ski-club` theme via WP Admin → Appearance → Themes
- [x] Create 6 Pages in WP Admin with correct slugs: home, about, trips, events, join, contact
- [x] Set Reading Settings → Static Front Page → "Home"
- [x] Set Permalinks → "Post name" structure → Save (flushes rewrite rules)
- [x] Add 2 sample trips: "Verbier, Switzerland" (Jan 24–31, featured) + "Park City, Utah" (Feb 28–Mar 7, featured)
- [x] Add 4 sample events: Monthly Club Meeting (Mar 19), Spring Bike Ride (Apr 12), Annual Spring Picnic (May 3), Kayaking Adventure (Jun 7)
- [x] Upload hero image and 3 gallery photos via Customizer

---

## Dynamic Content Architecture

### `event` Custom Post Type
Fields (registered via `acf_add_local_field_group()` in `inc/cpt.php`):

| Label | Field Name | ACF Type |
|---|---|---|
| Event Date | `event_date` | Date Picker |
| Event Time | `event_time` | Text (e.g. "7:00 PM") |
| Event Location | `event_location` | Text |
| Event Category | `event_category` | Select (Meeting, Biking, Kayaking, Social, Skiing) |

### `trip` Custom Post Type
Fields (registered via `acf_add_local_field_group()` in `inc/cpt.php`):

| Label | Field Name | ACF Type |
|---|---|---|
| Trip Start Date | `trip_start_date` | Date Picker |
| Trip End Date | `trip_end_date` | Date Picker |
| Location / Resort Name | `trip_location` | Text |
| Region / Area | `trip_region` | Text |
| Trip Highlights | `trip_highlights` | Textarea (one per line) |
| Inquiry Button Text | `trip_inquiry_text` | Text |
| Inquiry Button URL | `trip_inquiry_url` | URL |
| Featured on Homepage | `trip_featured` | True/False |

### Customizer Settings (`inc/customizer.php`)
Panel: **"Ski Club Theme Options"**
- Section "Hero Settings": `ski_club_hero_image` (WP_Customize_Media_Control)
- Section "Beyond the Slopes Gallery": `ski_club_gallery_image_1/2/3` (WP_Customize_Media_Control × 3)

### Helper Functions (`functions.php`)
- `ski_club_get_hero_image_url($fallback)` — returns hero URL from Customizer or fallback
- `ski_club_get_gallery_image_url($index, $fallback)` — returns gallery image URL
- `ski_club_get_trip_field($field, $post_id)` — ACF-aware field getter with meta fallback
- `ski_club_icon($name, $class)` — returns inline SVG string from icon library

---

## Key Technical Decisions
- **Classic PHP theme** (not FSE/block theme) — better suited for CPT-driven dynamic content
- **Slug-based page templates** (`page-{slug}.php`) — no manual template assignment needed in WP admin
- **Logo:** text placeholder "LHSC" (swap later via Customizer → Site Identity)
- **Inline SVG icons** — no external icon CDN dependency
- **ACF Free** for trip and event custom fields — industry standard, clean admin UI
- **No CSS preprocessor** — plain CSS with custom properties
- **`front-page.php` takes priority** over `home.php` when a static front page is set

---

## Verification / Testing
1. Activate theme → confirm no PHP fatal errors in WP admin
2. Check homepage renders all 6 sections
3. Add a test trip in WP Admin → Trips, mark as Featured → confirm it appears on homepage
4. Add a non-featured trip → confirm it appears on /trips but not homepage
5. Add a test event → confirm it appears on /events
6. Visit Customizer → upload hero image → confirm homepage hero updates
7. Upload 3 gallery photos → confirm Beyond the Slopes section renders correctly
8. Check all 6 pages are accessible: /, /about, /trips, /events, /join, /contact
9. Resize browser to 768px — confirm mobile nav toggle works
10. Check footer renders on all pages with correct links
