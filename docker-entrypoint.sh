#!/bin/bash
set -e

# Wait for DB to be ready
if [ -n "$DB_HOST" ]; then
  echo "Waiting for database at $DB_HOST..."
  until mysqladmin ping -h "$DB_HOST" --silent; do
    echo -n "."
    sleep 2
  done
  echo "Database is up!"
fi

# Execute the original CMD (apache2-foreground)
exec "$@"
