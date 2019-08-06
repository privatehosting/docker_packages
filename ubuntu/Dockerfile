FROM ubuntu:bionic

ENV DEBIAN_FRONTEND noninteractive
ENV BUILDDATE "20190728"

RUN apt-get update
RUN apt-get -y upgrade

RUN apt-get -y install libc6 wget curl gnupg gnupg2 gnupg1 sudo build-essential apt-utils 

RUN curl -sL https://deb.nodesource.com/setup_10.x | bash -

RUN curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | sudo apt-key add -
RUN echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list

RUN apt-get -y install locales locales-all
RUN locale-gen --no-purge en_US.UTF-8
RUN update-locale LANG=en_US.UTF-8
RUN echo locales locales/locales_to_be_generated multiselect en_US.UTF-8 UTF-8 | debconf-set-selections
RUN echo locales locales/default_environment_locale select en_US.UTF-8 | debconf-set-selections
RUN dpkg-reconfigure locales

ENV LC_ALL en_US.UTF-8
ENV LANG en_US.UTF-8
ENV LANGUAGE en_US.UTF-8

RUN apt-get update
RUN apt-get -y install -y nodejs yarn

RUN apt-get -y install php php-cli php-ftp php-sockets php-xml php-curl php-zip php-mbstring php-mysqli php-gd php-gmp php-ldap php-json php-json php-intl php-imap php-sqlite3 php-bz2 php-soap
RUN apt-get -y install composer

RUN apt-get -y install software-properties-common

RUN apt-get -y install wget

RUN apt-get autoremove
RUN apt-get clean
