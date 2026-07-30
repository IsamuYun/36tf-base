# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## What this is

`36tf-base` is a WordPress **Full-Site-Editing (FSE) block theme** — a minimal skeleton for SME marketing sites, targeting WordPress 7.0 / PHP 8.3 (declares support from 6.7 / PHP 7.4). There is **no build step, no bundler, no test suite, no npm dependencies**. The theme is plain PHP + `theme.json` + block-markup HTML/PHP files, loaded directly by WordPress.

Note: the codebase (comments, labels, README) is written in Chinese. Match that language when editing inline comments and user-facing strings; keep them wrapped in `__( ..., '36tf-base' )` for translation.

## One codebase, two brands

The core design idea: **one set of templates + swappable design tokens**. The default palette/fonts are "36 Tech Freedom"; `styles/fire-blocker.json` is a style variation for "Fire Blocker Material". Switching brands is a click in the Site Editor (Appearance → Editor → Styles → Browse styles), not a code change. Style variations are **files**, so they version-control and travel with the theme.

## Architectural discipline (the most important rule)

**Everything that can live in `theme.json` must live in `theme.json`.** Colors, font sizes, spacing, and per-block default styles all belong there. `assets/css/theme.css` is the *only* supplemental stylesheet and may contain only what `theme.json` cannot express: pseudo-elements, `:focus-visible`, block style variations (`.is-style-*`), and a few component-level details. Never hard-code colors or spacing in `theme.css` — always use the `theme.json`-generated CSS variables (`var(--wp--preset--color--*)`, `var(--wp--preset--spacing--*)`) so brand switches propagate automatically. Breaking this rule degrades the theme into "a classic theme written with FSE tooling", where two styling systems fight each other.

## Structure & load order

`functions.php` is the bootstrap: it defines constants (`TF36_VERSION`, `TF36_DIR`, `TF36_URI`) and `require_once`s the `inc/` files in order. `inc/woocommerce.php` loads only if the `WooCommerce` class exists.

- **`theme.json`** — design tokens (v3 schema). Palette, font families/sizes, spacing scale, shadows, and per-element/per-block default styles. Also declares `customTemplates` and `templateParts`. Edit this *first* for any styling change.
- **`inc/setup.php`** — `add_theme_support`, enqueues `theme.css` (front end + editor), and strips weight: removes core duotone SVG filters and disables emoji scripts.
- **`inc/post-types.php`** — registers two CPTs and their taxonomies (see below) plus post meta. Flushes rewrite rules on theme activation.
- **`inc/fonts.php`** — LCP-only. `@font-face` registration is owned by `theme.json` `fontFace` declarations (`src: file:./assets/fonts/*.woff2`); the style variation declares its own faces. This file keeps just a `<link rel="preload">` for the default body font (Manrope), guarded by `file_exists` so a stripped binary won't emit a 404 preload.
- **`inc/blocks.php`** — registers custom block *styles* (`card`, `bordered`, `eyebrow`, `lead`, `spec`, `checks`, `framed`; CSS for these lives in `theme.css`) and narrows the allowed block list for `page`/`post` editors via `tf36_allowed_block_types` (Site Editor and CPTs are unaffected).
- **`inc/patterns.php`** — registers pattern categories (`tf36-hero`, `tf36-section`, `tf36-page`) and disables the remote WordPress.org pattern directory. Pattern *files* auto-register; see below.
- **`inc/woocommerce.php`** — theme-level Woo support; dequeues Woo CSS + cart-fragments on non-commerce pages. **Deliberately provides no `single-product.html` / `archive-product.html`** — Woo's built-in block templates already pull in this theme's header/footer and tokens.
- **`templates/`** — page templates as block-markup `.html`. `parts/` — template parts (`header`, `footer`, `cta`). Both are static HTML with WordPress block comments (`<!-- wp:... -->`).
- **`patterns/`** — block patterns as `.php` files. **WordPress auto-scans and registers them** from a header comment block (`Title:`, `Slug:`, `Categories:`, etc.) — do not write `register_block_pattern()` calls. Follow the existing header format (see `patterns/hero-home.php`) when adding a pattern.
- **`styles/`** — style variations (`theme.json`-shaped partial overrides).

## Custom content types

Two CPTs replace plain Pages where filtering/archives/long-term growth are needed:

- **`tf_project`** ("Gallery") — archive at `/gallery/`, taxonomy `tf_project_type` (`/gallery-type/`), meta `tf_project_location`.
- **`tf_resource`** ("Resources") — archive at `/resources/`, taxonomy `tf_resource_type` (`/resource-type/`), meta `tf_resource_file` (a downloadable URL).

Meta is registered with `show_in_rest` so it binds to blocks via **Block Bindings** (`core/post-meta` source) — no ACF. Example in `single-tf_resource.html`: a button's `url` is bound to `tf_resource_file`. Do **not** create Pages named Gallery/Resources/Products — they would collide with these archive slugs / WooCommerce's generated pages.

## Working in this repo

- No build/lint/test commands exist. Changes to `.php` / `.html` / `theme.json` take effect on page reload in a running WordPress install.
- **Local dev** uses `wp-env` (Docker) — not committed here. See README §5: create a `.wp-env.json` pinning `WordPress/WordPress#7.0` + PHP 8.3 with this theme, then `wp-env start`.
- After changing CPT/taxonomy/rewrite registration, permalinks must be re-flushed (Settings → Permalinks → Save, or reactivate the theme) or `/gallery/` `/resources/` will 404.
- **The FSE Git trap**: Site Editor edits are stored in the **database** (`wp_template` / `wp_template_part` / `wp_global_styles`), not files. To version-control them, export with the **Create Block Theme** plugin back into `templates/*.html` and commit. Anything not exported is lost on a staging→production DB swap.
- Fonts (5 `.woff2`) are **committed** under `assets/fonts/` so a GitHub ZIP install works with zero extra steps. `.gitignore` still excludes raw `.ttf`/`.otf` sources — convert to `.woff2` before committing (e.g. `fonttools` with `brotli`: load the ttf, set `flavor = "woff2"`, save). Registration is via `theme.json`/variation `fontFace`, keyed by the file's real variable weight axis.
