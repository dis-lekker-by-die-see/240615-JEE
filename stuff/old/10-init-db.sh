# #!/bin/bash

# echo "1 ---------Starting MySQL initialization script..."

# # Increase the wait time and add detailed debugging information
# until mysql -h"mysql" -u"${DB_USERNAME}" -p"${DB_PASSWORD}" -e "SHOW DATABASES;" 2>&1; do
#   echo "2 ---------Waiting for MySQL service at mysql with user ${DB_USERNAME}..."
#   sleep 10 # Increase sleep time to 10 seconds
# done

# echo "3 -----------MySQL service is up - executing command..."

# # Run Laravel migrations and seeders
# cd /var/www/html
# php artisan migrate --force
# php artisan db:seed --force

# echo "4 --------------Database migration and seeding completed."
