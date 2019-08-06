FROM dpilichiewicz/ubuntu:latest

ARG TS3_VERSION="3.8.0"
ARG TS3_BUILD="amd64"
ARG TS3_FILENAME="teamspeak3-server_linux_${TS3_BUILD}-${TS3_VERSION}.tar.bz2"

ENV DEBIAN_FRONTEND noninteractive

RUN wget http://dl.4players.de/ts/releases/${TS3_VERSION}/${TS3_FILENAME} -O /tmp/${TS3_FILENAME}
RUN mkdir -p /opt/teamspeak
RUN touch /opt/teamspeak/.ts3server_license_accepted
RUN tar xf /tmp/${TS3_FILENAME} -C /opt/teamspeak --strip-components=1
RUN rm -f /tmp/${TS3_FILENAME}

EXPOSE 10011/tcp 30033/tcp 9987/udp

# setup directory where user data is stored
VOLUME /var/ts3server/
WORKDIR /var/ts3server/


#  9987 default voice
# 10011 server query
# 30033 file transport
EXPOSE 9987/udp 10011 30033

COPY entrypoint.sh /opt/ts3server
ENTRYPOINT [ "entrypoint.sh" ]
CMD [ "ts3server" ]