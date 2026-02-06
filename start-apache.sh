#!/bin/bash
set -e

# Cloud SQL instance connection
CLOUDSQL_INSTANCE=${CLOUDSQL_INSTANCE:-alter-consult-464302:us-central1:drupal-db}

# Start Cloud SQL Proxy
echo "Starting Cloud SQL Proxy for instance $CLOUDSQL_INSTANCE..."
./cloud_sql_proxy -dir=/cloudsql -instances=$CLOUDSQL_INSTANCE &

# Wait 2s for proxy to start
sleep 2

# Ensure Apache listens on $PORT
sed -i "s/^Listen .*/Listen ${PORT}/" /etc/apache2/ports.conf

echo "Starting Apache on port $PORT..."
exec apache2-foreground
