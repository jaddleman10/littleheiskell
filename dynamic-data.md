# Dynamic Data in WordPress — Implementation Guide

## Context

This document covers the best strategies for making structured, repeatable data editable directly in the WordPress admin — without touching source files. It is written for a **classic PHP WordPress theme** (not FSE/block-based) with **ACF Free** installed. The patterns here apply to any number of pages or data types: contact directories, trip highlights, activity descriptions, officer lists, etc.

---

## The Core Problem

Many pieces of site content are *structured and repeatable* — a list of officers, a set of trip highlights, a row of service cards. Hardcoding these in PHP templates works initially, but it means a non-developer must edit source files to update them. The goal is to move that data into the WordPress admin so it is editable through a normal UI.

---

## Critical Constraint: ACF Repeater is Pro-Only

The most natural ACF solution — the **Repeater field** — is **not available in ACF Free**. It requires ACF Pro (~$149/year single site). Do not attempt to use it without a Pro license.

ACF Free includes 35+ field types: text, textarea, email, URL, select, checkbox, radio, true/false, image, file, wysiwyg, group, tab, and more — but **not** repeater or flexible content.

This constraint shapes all recommendations below.

---

## Chosen Approach for This Site: Fixed-Slot ACF Fields ✅

After evaluating all options, the chosen approach for this site is **fixed-slot individual ACF fields** registered per page. This means:

- The number of records (e.g. 7 officers) is agreed upon upfront
- Each slot gets its own set of ACF fields (`contact_1_name`, `contact_1_position`, `contact_1_email`, etc.)
- All fields appear directly in the WP Admin page editor — no separate screens
- The admin edits names, positions, and emails directly in form fields, inline on the page
- Adding more slots (e.g. an 8th officer) requires a developer to add fields in `inc/cpt.php` — acceptable since org structure rarely changes
- Slots with no data filled in are simply skipped by the template

**Why this over the alternatives:**
- No ACF Pro needed
- No JavaScript/React needed (vs. Gutenberg blocks)
- Editing is inline on the page itself (vs. Custom Post Types which use a separate screen)
- Proper typed fields with validation (vs. delimited textarea which is fragile)

---

## Available Approaches (for reference)

### Option 1 — Fixed-Slot ACF Fields ✅ CHOSEN APPROACH

**How it works:** Register individual ACF fields for each slot, attached to a specific page by slug. Fields appear directly in the page editor. The template loops through slots and skips empty ones.

```php
// In inc/cpt.php, inside ski_club_register_acf_fields()
acf_add_local_field_group( [
    'key'   => 'group_contact_page',
    'title' => 'Contact Directory',
    'fields' => [
        // Slot 1
        [ 'key' => 'field_cp_tab_1',      'label' => 'Contact 1',  'type' => 'tab' ],
        [ 'key' => 'field_cp_name_1',     'label' => 'Name',       'name' => 'cp_name_1',     'type' => 'text' ],
        [ 'key' => 'field_cp_position_1', 'label' => 'Position',   'name' => 'cp_position_1', 'type' => 'text' ],
        [ 'key' => 'field_cp_email_1',    'label' => 'Email',      'name' => 'cp_email_1',    'type' => 'email' ],
        // Slot 2 ... repeat for each person
    ],
    'location' => [ [ [
        'param'    => 'post_type',
        'operator' => '==',
        'value'    => 'page',
    ], [
        'param'    => 'page',
        'operator' => '==',
        'value'    => 'contact',  // page slug
    ] ] ],
] );
```

```php
// In page-contact.php — loop up to max slots, skip empty
$page_id = get_the_ID();
$contacts = [];
for ( $i = 1; $i <= 10; $i++ ) {
    $name = ski_club_get_field( "cp_name_{$i}", $page_id );
    if ( ! $name ) continue;  // skip unfilled slots
    $contacts[] = [
        'name'     => $name,
        'position' => ski_club_get_field( "cp_position_{$i}", $page_id ),
        'email'    => ski_club_get_field( "cp_email_{$i}",    $page_id ),
    ];
}
```

**Admin experience:** Open the page in WP Admin → edit. Scroll down to the field group. Each slot has a tab (Contact 1, Contact 2, etc.) with Name, Position, and Email fields. Fill in, save. Done.

**Pros:**
- Fully inline on the page editor
- Works with ACF Free
- Proper typed fields (email validation, etc.)
- No separate admin screen
- No JavaScript required

**Cons:**
- Max slot count fixed at registration time (developer needed to add more)
- No drag-and-drop reordering (reorder by manually swapping values between slots)
- Requires pre-planning how many slots to register

**Best for:** Stable lists where count rarely changes — officer directories, board members, fixed service cards, a set number of FAQ items.

---

### Option 2 — Custom Post Type (CPT) per Data Set

**How it works:** Register a CPT for each data type. Each record is its own WP post. ACF Free adds structured fields. Templates query the CPT.

**Admin experience:** Each person/record is edited as a separate post. Admin goes to e.g. "Contacts" in the menu, clicks "Add New", fills in fields, saves.

**Pros:** Scales to any count, full WP UI, no slot limit  
**Cons:** Editing is on a separate screen (not inline on the page), slightly more overhead

**Best for:** Large or frequently changing lists (trips, events — already used for these).

---

### Option 3 — Delimited Textarea

**How it works:** Single ACF `textarea` field, one record per line, pipe-separated. Template parses on render.

```
Carol Carbaugh|President|president@example.com
Gwen Hard|Vice President|vp@example.com
```

**Pros:** Zero setup, unlimited rows, inline  
**Cons:** Fragile, no validation, poor UX for non-developers

**Best for:** Developer-maintained sites or temporary solutions only.

---

### Option 4 — ACF Pro Repeater

The best admin UX if budget allows. True add/remove/reorder UI, inline on any page. Requires ACF Pro (~$149/year). Not currently installed on this site.

---

### Option 5 — Gutenberg Blocks

Custom blocks built with React/JavaScript. Each contact card is a draggable block. Admin adds/removes/reorders blocks directly on the page — fully WYSIWYG.

**Pros:** Best possible admin UX, truly dynamic count, visual editing  
**Cons:** Requires JavaScript (React) to build, meaningfully more complex than PHP-only approaches

**Best for:** Long-term investment, or if the site later migrates to a block-based theme.

---

## Decision Guide

| Situation | Use |
|---|---|
| Stable list, known count, inline editing needed | **Option 1 — Fixed-slot ACF fields** ← current choice |
| List may grow over time, separate screen is OK | Option 2 — Custom Post Type |
| Developer-maintained, quick solution | Option 3 — Delimited textarea |
| Budget available, best admin UX | Option 4 — ACF Pro Repeater |
| Long-term investment, full WYSIWYG | Option 5 — Gutenberg blocks |

---

## Applying This to Specific Pages

### Contact Directory
**Approach:** Option 1 — Fixed-slot ACF fields  
**Slots:** 7 (current officer count), register up to 10 for headroom  
**Fields per slot:** `cp_name_N` (text), `cp_position_N` (text), `cp_email_N` (email)  
**Location:** page slug = `contact`  
**Template:** Loop 1–10, skip slots where name is empty

### Events Page — Activity Sections (Skiing, Biking, Kayaking, Social)
**Approach:** Option 1 — Fixed fields on the Events page  
**Already implemented** in `inc/cpt.php` under `group_events_page`

### Events Page — Monthly Meeting Details
**Approach:** Option 1 — Fixed fields on the Events page  
**Already implemented** in `inc/cpt.php` under `group_events_page`

### Trips
**Approach:** Option 2 — Custom Post Type (`trip`)  
**Already implemented** — trips are CPT posts with ACF fields

### Events
**Approach:** Option 2 — Custom Post Type (`event`)  
**Already implemented** — events are CPT posts with ACF fields

### Trip Highlights
**Approach:** Option 3 — Delimited textarea (one highlight per line)  
Already in place on the `trip` CPT. Works well for simple string lists.

---

## Implementation Checklist (for any new dynamic section)

1. **Decide the approach** using the decision guide above.
2. **Count the records** and register that many slots (plus a few extras for headroom).
3. **Register the field group** in `inc/cpt.php` inside `ski_club_register_acf_fields()`.
4. **Use `ski_club_get_field( $field_name, $post_id )`** in templates — this helper works with or without ACF active.
5. **Loop up to the max slot count** in the template; use `continue` to skip empty slots.
6. **Provide fallback values** where appropriate so the page doesn't break before admin fills in data.
7. **Document the expected format** in the ACF field's `instructions` property — admins see this inline.
8. **Test with no data** to confirm empty slots are skipped cleanly.
9. **Test filling in and saving** each field from WP Admin to confirm the template updates.

---

## Notes for AI Agents Implementing This

- This is a **classic PHP theme** — do not use block editor patterns, `block.json`, or `render_callback` unless explicitly asked.
- All ACF field groups are **registered in PHP** in `inc/cpt.php`, not through the ACF UI. This keeps configuration in version control.
- The helper `ski_club_get_field( $field_name, $post_id )` in `functions.php` calls `get_field()` if ACF is active, falls back to `get_post_meta()` otherwise. Always use this instead of calling `get_field()` directly.
- ACF Free field types available: text, textarea, number, range, email, url, password, image, file, wysiwyg, oembed, select, checkbox, radio, button_group, true_false, link, post_object, page_link, relationship, taxonomy, user, google_map, date_picker, date_time_picker, time_picker, color_picker, message, accordion, tab, group.
- **Repeater and Flexible Content are Pro-only.** Do not use them without confirming the site has ACF Pro installed.
- When attaching a field group to a specific page, use both conditions: `post_type == page` AND `page == {slug}` (page slug, not page title).
- When attaching to a CPT, use: `post_type == {cpt_slug}`.
- Field keys must be globally unique across all field groups. Use a consistent prefix per group (e.g. `field_cp_` for contact page, `field_ep_` for events page).
- Register slightly more slots than currently needed (e.g. 10 slots for 7 people) so the admin has headroom without requiring a code change.
