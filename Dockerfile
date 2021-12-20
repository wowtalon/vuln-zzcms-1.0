From codenvy/php56_apache2
COPY src/app/ /var/www/html/
RUN sudo chown -R www-data:www-data /var/www/html/ && \
	sudo service mysql start && \
	sudo mysql -e "use mysql; update user set password=password('root') where user='root'; create database zzcms;"
EXPOSE 80
