#!/bin/bash

# Fast Laravel FTP Deployment Script
# This skips vendor directory - use only after first full deploy

set -e

echo "🚀 Starting FAST deployment (skipping vendor)..."

# Load FTP Configuration
if [ -f ".env.deploy" ]; then
    source .env.deploy
else
    echo "❌ Error: .env.deploy file not found!"
    exit 1
fi

GREEN='\033[0;32m'
BLUE='\033[0;34m'
YELLOW='\033[1;33m'
NC='\033[0m'

echo -e "${BLUE}🔨 Building assets...${NC}"
if [ -f "package.json" ]; then
    npm run build
fi

echo -e "${BLUE}🧹 Clearing Laravel caches...${NC}"
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

echo -e "${YELLOW}📤 Uploading changed files (SKIPPING VENDOR)...${NC}"

URL_ENCODED_PASS=$(python3 -c "import urllib.parse; print(urllib.parse.quote('$FTP_PASS', safe=''))")

cat > /tmp/lftp_script.txt << LFTP_SCRIPT
set ftp:ssl-allow yes
set ftp:ssl-force no
set ftp:ssl-protect-data no
set ssl:verify-certificate no
set net:max-retries 3
set net:timeout 30

# Speed optimizations
set mirror:use-pget-n 10
set mirror:parallel-transfer-count 10
set cmd:parallel 10

open ftp://${FTP_USER}:${URL_ENCODED_PASS}@${FTP_HOST}

mirror --reverse \
       --parallel=10 \
       --exclude-glob .git/ \
       --exclude-glob .github/ \
       --exclude-glob vendor/ \
       --exclude-glob node_modules/ \
       --exclude-glob storage/logs/ \
       --exclude-glob storage/framework/cache/ \
       --exclude-glob storage/framework/sessions/ \
       --exclude-glob storage/framework/views/ \
       --exclude-glob database/database.sqlite \
       --exclude-glob .env \
       --exclude-glob .env.* \
       --exclude-glob .gitignore \
       --exclude-glob .gitattributes \
       --exclude-glob README.md \
       --exclude-glob DEPLOYMENT.md \
       --exclude-glob deploy.sh \
       --exclude-glob deploy-fast.sh \
       --exclude-glob server-setup.sh \
       --exclude-glob tests/ \
       --exclude-glob phpunit.xml \
       --exclude-glob .phpunit.* \
       --exclude-glob *.log \
       --exclude-glob .DS_Store \
       ./ ${REMOTE_DIR}

bye
LFTP_SCRIPT

lftp -f /tmp/lftp_script.txt
rm /tmp/lftp_script.txt

echo -e "${GREEN}✅ Fast deployment completed!${NC}"
echo -e "${YELLOW}Note: Vendor directory was skipped. Run full deploy if dependencies changed.${NC}"
