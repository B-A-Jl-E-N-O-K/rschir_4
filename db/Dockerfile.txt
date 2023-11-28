FROM mysql

ENV MYSQL_ROOT_PASSWORD root
ENV MYSQL_ROOT_USER root
ENV MYSQ_USER user
ENV MYSQL_PASSWORD password
ENV MYSQL_DATABASE appDB

ADD init.sql /docker-entrypoint-initdb.d
EXPOSE 3306