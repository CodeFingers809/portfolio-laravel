# Deployment Guide

## Quick Deploy

To deploy your Laravel application to the FTP server, simply run:

```bash
composer deploy
```

Or directly:

```bash
./deploy.sh
```

## What It Does

The deployment script automatically:

1. ✅ Installs/updates Composer dependencies (production mode)
2. ✅ Builds frontend assets (npm run build)
3. ✅ Clears all Laravel caches
4. ✅ Optimizes Laravel for production
5. ✅ **Uploads ONLY changed/new files to FTP** (not all files)
6. ✅ Excludes unnecessary files (.git, node_modules, tests, etc.)

## FTP Configuration

Your FTP credentials are stored in `.env.deploy` (excluded from Git for security).

**Current Configuration:**
- Server: `82.25.125.95`
- Username: `u267166500.portfolio`
- Remote Directory: `/`

## How It Works (Smart Sync)

The script uses `lftp` with mirror mode, which:
- Only uploads files that have changed
- Only uploads new files that don't exist on the server
- Skips files that are identical (same size and timestamp)
- Deletes files on the server that no longer exist locally (can be disabled)

## Files Excluded from Upload

The following are automatically excluded:
- `.git/`, `.github/`
- `node_modules/`
- `storage/logs/`, `storage/framework/cache/`, etc.
- `.env`, `.env.*` (environment files)
- `tests/`, test configuration files
- `README.md`, `deploy.sh`
- Log files, `.DS_Store`

## First Time Setup

If you're setting this up on a new machine:

1. Install lftp (done automatically):
   ```bash
   brew install lftp
   ```

2. Copy the example env file:
   ```bash
   cp .env.deploy.example .env.deploy
   ```

3. Edit `.env.deploy` with your FTP credentials

4. Make the deploy script executable:
   ```bash
   chmod +x deploy.sh
   ```

## Troubleshooting

**Q: Script fails with permission denied?**
```bash
chmod +x deploy.sh
```

**Q: Want to see what will be uploaded before deploying?**
Add `--dry-run` to the mirror command in deploy.sh (line 61)

**Q: Don't want to delete files from server?**
Remove the `--delete` flag from the mirror command in deploy.sh (line 62)

**Q: Upload is too slow?**
Adjust the `set mirror:use-pget-n` value in deploy.sh (line 54) - higher = more parallel downloads

## Manual Deployment (Alternative)

If you prefer not to use the script, you can manually:
1. Run `composer install --no-dev --optimize-autoloader`
2. Run `npm run build`
3. Upload files via your preferred FTP client

---

**Note:** The `.env.deploy` file containing your FTP password is automatically excluded from Git for security.
