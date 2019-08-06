FROM dpilichiewicz/ubuntu:latest

ARG ATM3_VERSION="5.12.1"

ENV DEBIAN_FRONTEND noninteractive

RUN apt-get -y update
RUN apt-get -y install libc6 wget unzip openjdk-11-jdk
RUN mkdir -p /opt/minecraft
RUN wget https://minecraft.curseforge.com/projects/all-the-mods-3/files/2699829/download -O /tmp/ATM3-${ATM3_VERSION}_Server-FULL.zip
RUN unzip /tmp/ATM3-${ATM3_VERSION}_Server-FULL.zip -d /opt/minecraft

EXPOSE 10011/tcp 30033/tcp 9987/udp

# setup directory where user data is stored
VOLUME /opt/minecraft/world
WORKDIR /opt/minecraft

ADD settings.cfg /opt/minecraft/settings.cfg

# 25565 server query
# 25565 file transport
EXPOSE 25565/udp 25565

# Startup script
CMD ["/bin/bash", "ServerStart.sh"]
