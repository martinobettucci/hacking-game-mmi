FROM alpine:edge
MAINTAINER Martino BETTUCCI <mmi.iut-laval>

# Add basics first
RUN apk update && apk upgrade && apk add bash apache2 php7-apache2 php7 tzdata

RUN ln -s /usr/bin/php7 /usr/bin/php && rm -f /var/cache/apk/*

RUN mkdir -p /var/www/localhost/htdocs/uploaded_files && chown -R apache:apache /var/www/localhost/htdocs && chmod -R u+w /var/www/localhost/htdocs/uploaded_files
RUN mkdir bootstrap
ADD start.sh /bootstrap/
RUN chmod +x /bootstrap/start.sh

COPY ./apache2 /etc/apache2
#COPY ./apache2/httpd.min.conf /etc/apache2/httpd.conf
COPY ./htdocs/* /var/www/localhost/htdocs/

EXPOSE 80
ENTRYPOINT ["/bootstrap/start.sh"]
