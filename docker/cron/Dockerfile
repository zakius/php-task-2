FROM ubuntu:latest
MAINTAINER docker@ekito.fr

RUN apt-get update && apt-get -y install cron curl

# Copy hello-cron file to the cron.d directory
COPY import /etc/cron.d/import

# Give execution rights on the cron job
RUN chmod 0644 /etc/cron.d/import

# Apply cron job
RUN crontab /etc/cron.d/import

# Create the log file to be able to run tail
RUN touch /var/log/cron.log

# Run the command on container startup
CMD ["cron", "-f"]
