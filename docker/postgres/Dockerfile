FROM postgres:10.6

#COPY ./docker/create-extension.sql /docker-entrypoint-initdb.d/create-extension.sql
RUN apt-get update && apt-get install postgresql-contrib -y

EXPOSE 5432

CMD ["postgres"]
