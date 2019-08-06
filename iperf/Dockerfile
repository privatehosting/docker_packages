FROM alpine:latest

# Define iperf version
ENV IPERF_VERSION 2.0.13-r1

# Install iperf
RUN apk add --update iperf=${IPERF_VERSION}
RUN rm -rf /var/cache/apk/*

# Install nginx


CMD ["iperf", "-s"]