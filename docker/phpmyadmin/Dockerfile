FROM phpmyadmin/phpmyadmin

# Fix "Could not reliably determine the server's fully qualified domain name..." warning.
# https://askubuntu.com/questions/256013/apache-error-could-not-reliably-determine-the-servers-fully-qualified-domain-n/256018#256018
# https://help.ubuntu.com/community/ApacheMySQLPHP#Troubleshooting_Apache

# this fails with: https://monosnap.com/direct/QAdqU5VM7UqaYuheqEfW7LzmkTeakr
# RUN echo "ServerName localhost" | tee /etc/apache2/conf-available/fqdn.conf && a2enconf fqdn
