#!/bin/bash
set -e

# Default to Cloud Run's $PORT, fallback to 8080 if not set
PORT=${PORT:-8080}

# Update Apache configs to use Cloud Run's $PORT
sed -i "s/Listen 80/Listen ${PORT}/" /etc/apache2/ports.conf
sed -i "s/:80/:${PORT}/" /etc/apache2/sites-available/000-default.conf

echo "Starting Apache on port ${PORT}..."
exec apache2-foreground
