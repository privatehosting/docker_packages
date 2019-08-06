FROM debian:jessie
LABEL AUTHOR="D.Pilichiewicz <dev@pilichiewicz>"

ENV DEBIAN_FRONTEND noninteractive
ARG AIRTIME_VERSION=2.5.2.1

# RUN apt-get -y install wget sudo postgresql python-virtualenv apache2 coreutils \
#    curl ecasound flac gzip libcamomile-ocaml-data \
#    liquidsoap locales lsof monit multitail patch pwgen \
#    python rabbitmq-server silan sudo sysv-rc tar unzip \
#    vorbisgain vorbis-tools

RUN apt-get update
RUN apt-get -y install wget apt-utils
RUN cd /tmp; wget --quiet -P /tmp https://github.com/sourcefabric/airtime/archive/airtime-${AIRTIME_VERSION}.tar.gz
RUN tar -xvzf /tmp/airtime-${AIRTIME_VERSION}.tar.gz -C /usr/src/
RUN apt-get install -y icecast2 apache2 liquidsoap libapache2-mod-php5 python rabbitmq-server
RUN /usr/src/airtime-airtime-${AIRTIME_VERSION}/install -fiap
