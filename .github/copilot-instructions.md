# Copilot Instructions for Alter Consult Drupal 11 Site

## Project Overview

This is a **Drupal 11** site built with **Composer** package management, deployed via **Pantheon** and **Google Cloud Build**. The site includes custom AI and React integration modules for client intake and interactive UI.

**Key Tech Stack:**
- Drupal 11 with PHP 8.3 (requires 8.1+)
- Composer-managed dependencies (no core in version control)
- MariaDB 10.11 for database
- Docker containerized environment
- Custom modules: `alter_ai_agent`, `react_integration`
- Pantheon platform deployment
- Google Cloud Build CI/CD pipeline

## Architecture & Key Components

### Directory Structure
- **`web/`** - Drupal root (corresponds to "WEBROOT" in Pantheon)
  - `core/` - Drupal core (installed via Composer, don't edit)
  - `modules/` - Modules directory
    - `contrib/` - 3rd party modules installed via Composer
    - `custom/` - Custom modules for this site
  - `themes/` - Theme directory (contrib themes in subdirs)
  - `sites/default/` - Site configuration (settings.php, services.yml)
- **`vendor/`** - Composer dependencies (managed by composer.json)
- **`config/`** - Pantheon-specific recipes
- **`upstream-configuration/`** - Base Pantheon upstream configuration

### Custom Modules

#### `alter_ai_agent` (web/modules/custom/alter_ai_agent/)
- **Purpose**: AI-powered client intake form and project analysis
- **Database Tables**: 
  - `alter_ai_clients` - Client info, contact details, project description
  - `alter_ai_interactions` - Interaction history/logs
- **Key Files**:
  - `alter_ai_agent.info.yml` - Module metadata
  - `alter_ai_agent.module` - Hook implementations (defines schema)
  - `alter_ai_agent.permissions.yml` - Custom permissions
  - `alter_ai_agent.routing.yml` - URL routes
  - `src/Controller/`, `src/Service/`, `src/Form/` - Business logic

#### `react_integration` (web/modules/custom/react_integration/)
- **Purpose**: React component integration with Drupal
- **Build Process**: Webpack + Babel transpilation
- **Key Files**:
  - `webpack.config.js` - Bundler config (outputs to `dist/bundle.js`)
  - `package.json` - Node dependencies (React 18, Babel 7)
  - `.babelrc` - JavaScript transpilation config
  - `react_integration.libraries.yml` - Declares Drupal library to attach React bundle
  - `src/index.js` - React entry point

## Developer Workflows

### Setup & Installation
```bash
# Install Drupal dependencies
composer install

# For react_integration module development
cd web/modules/custom/react_integration
npm install
npm run build  # Compiles webpack to dist/bundle.js
```

### Local Development (Docker)
```bash
# Start containerized environment
docker-compose up -d

# Access:
# - Drupal: http://localhost:8080
# - phpMyAdmin: http://localhost:8081 (user: drupaluser / drupalpass)

# Run Drush commands inside container
docker exec -it alter-consult-drupal11 drush [command]

# View logs
docker logs -f alter-consult-drupal11
```

### Module Management
- **Enable/disable modules**: Use Drupal admin UI at `/admin/modules` or `drush en/dis`
- **Clear caches after module changes**: `drush cr` (critical for configuration changes)
- **Database updates**: Run `drush updatedb` after enabling modules with schema changes

### Deployment
- **Pantheon**: Changes pushed to `master` branch are auto-deployed via Pantheon's Integrated Composer
- **Google Cloud**: `cloudbuild.yaml` orchestrates Docker build → GCR push → Cloud Run deploy
  - Triggered on commits to repository
  - Builds image, pushes to Google Container Registry
  - Deploys to Cloud Run in us-central1 region

## Project-Specific Patterns & Conventions

### Drupal Configuration
- **Configuration as code**: Config stored in YAML in `web/sites/default/` and version-controlled
- **Service files**: `web/sites/default/services.yml` (custom Drupal services)
- **Settings overrides**: Environment-specific settings in Pantheon config (settings.pantheon.php)

### Database & Schema
- Custom tables defined via `hook_schema()` in `.module` files
- Database initialized via `alter_ai_clients` and `alter_ai_interactions` tables
- Drush migrations for data changes (if applicable)

### Module Dependencies
- `alter_ai_agent` depends on `drupal:openai` (external API integration)
- `react_integration` requires Node.js for build step
- Always run `composer install` after `composer.json` changes

### Frontend Assets
- React components built with webpack (`dist/bundle.js`)
- Drupal attaches via `*.libraries.yml` - declare library, reference JS/CSS
- Separate `node_modules` workflow from Drupal's vendor management

## Critical Files & Their Purpose

| File | Purpose |
|------|---------|
| `composer.json` | PHP dependencies, autoload config, Drupal scaffold settings |
| `web/sites/default/settings.php` | Active site configuration (generated, don't commit customizations) |
| `pantheon.yml` | Pantheon platform configuration overrides |
| `cloudbuild.yaml` | Google Cloud Build pipeline definition |
| `Dockerfile` | Docker image definition (PHP 8.3, Apache, Drupal setup) |
| `docker-compose.yml` | Local dev environment (Drupal, MariaDB, phpMyAdmin) |

## Common Maintenance & Debugging

- **Module not appearing**: Clear Drupal cache (`drush cr`) and check module's .info.yml syntax
- **Database table missing**: Run `drush updatedb` or manually enable module (invokes schema hooks)
- **React bundle outdated**: Rebuild with `npm run build` in react_integration directory
- **Pantheon deployment fails**: Check `composer.json` validity and ensure no PHP syntax errors in custom code
- **Cloud Build fails**: Review logs in Google Cloud Console; common issues: Docker layer caching, image size limits

## Key Commands Reference

```bash
# Drupal (Drush)
drush status              # Check Drupal health
drush en module_name      # Enable module
drush dis module_name     # Disable module
drush cr                  # Clear all caches
drush updatedb            # Run pending database updates
drush sql-dump > backup.sql  # Backup database

# Composer
composer install          # Install locked versions
composer update           # Update to latest allowed versions
composer require drupal/module_name  # Add new module

# Docker
docker-compose up -d      # Start services
docker-compose down       # Stop services
docker-compose logs -f    # Stream logs
```

## Notes for AI Agents

1. **Drupal best practices apply**: Use Drupal APIs (service container, hooks) rather than direct code execution
2. **Configuration over code**: Store site settings in database config, not hardcoded values
3. **Composer-first**: New dependencies go in `composer.json`, not copied into vendor
4. **Test locally first**: Use docker-compose environment before pushing to Pantheon/Cloud
5. **Backwards compatibility**: Drupal modules must support Drupal 11 features; use Drupal coding standards
