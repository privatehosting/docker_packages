FROM alpine:latest

RUN apk update
RUN apk add "icecast=2.4.3-r6"

EXPOSE 8000

CMD ["icecast", "-c", "/etc/icecast/icecast.xml"]
